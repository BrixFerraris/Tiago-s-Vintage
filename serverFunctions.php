<?php
require './server/includes/dbCon.php';

function getProducts($conn, $search = '')
{
    $search = $conn->real_escape_string($search);
    $query = "SELECT * FROM tbl_products";
    if ($search) {
        $query .= " WHERE title LIKE '%$search%'";
    }
    $query .= " LIMIT 15";
    $result = $conn->query($query);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

function loadPurchaseOrders($conn, $transactionId)
{
    if ($transactionId) {
        $query = $conn->prepare('SELECT t.*, p.*, u.* FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id WHERE t.transaction_id = ?');
        $query->bind_param('s', $transactionId);
    }

    $orderItems = [];
    $total = 0;
    $name = '';
    $address = '';
    $contact = '';
    $id = '';
    $status = '';

    if ($transactionId) {
        $query->execute();
        $result = $query->get_result();

        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
            $total += $row['total'];
            $name = $row["firstName"] . " " . $row["lastName"];
            $address = $row["address"];
            $contact = $row["contact"];
            $id = $row["id"];
            $status = $row["status"];
        }
        return [
            'order_items' => $orderItems,
            'order_total' => $total,
            'name' => $name,
            'address' => $address,
            'contact' => $contact,
            'id' => $id,
            'status' => $status
        ];
    }
}

function getCart($conn, $user_id)
{
    $query = "SELECT 
        p.img1, 
        p.title, 
        v.variationName, 
        p.price, 
        p.id, 
        t.quantity, 
        u.firstName, 
        u.lastName, 
        u.contact, 
        t.total, 
        u.id AS userId, 
        t.id AS transactionId,
        v.quantity AS variantQuantity,
        v.id AS variationId
    FROM 
        tbl_transactions t 
    INNER JOIN 
        tbl_products p ON t.product_id = p.id 
    INNER JOIN 
        tbl_variations v ON t.product_id = v.product_id AND t.variation_id = v.id 
    INNER JOIN 
        tbl_users u ON t.user_id = u.id 
    WHERE 
        t.user_id = ? AND t.status = 'Cart'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = [];
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
    }
    return $cart;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type === 'loadProducts') {
        try {
            $products = getProducts($conn);
            echo json_encode($products);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    if ($type === 'searchProducts') {
        $search = $_POST['title'] ?? '';
        try {
            $products = getProducts($conn, $search);
            echo json_encode(['type' => 'searchResults', 'products' => $products]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    if ($type === 'deleteProduct' && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM tbl_products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo json_encode(['type' => 'productDeleted']);
            } else {
                echo json_encode(['type' => 'error', 'message' => 'Product not found or could not be deleted.']);
            }
        } catch (Exception $e) {
            echo json_encode(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    if ($type === 'loadCart') {
        $user_id = $_POST['user_id'] ?? '';
        try {
            $cart = getCart($conn, $user_id);
            echo json_encode($cart);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } elseif ($type === 'removeCart') {
        $transactionID = $_POST['transactionID'] ?? '';
        try {
            $stmt = $conn->prepare("DELETE FROM tbl_transactions WHERE id = ?");
            $stmt->bind_param("i", $transactionID);
            $stmt->execute();
            echo json_encode(['type' => 'itemRemoved']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } elseif ($type === 'updateQuantity') {
        $transactionID = $_POST['transactionID'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        try {
            $stmt = $conn->prepare("UPDATE tbl_transactions SET quantity = ? WHERE id = ?");
            $stmt->bind_param("ii", $quantity, $transactionID);
            $stmt->execute();
            echo json_encode(['type' => 'quantityUpdated']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    if ($type === 'order') {
        $type = $_POST['type'] ?? '';
        $userId = $_POST['user_id'] ?? null;
        $address = $_POST['address'] ?? '';
        $variationIDs = $_POST['variationID'] ?? [];
        $quantities = $_POST['qty'] ?? [];
        $shippingMethod = $_POST['shipping_method'] ?? '';
        $discountMethod = $_POST['discount_method'] ?? '';
        $queryUpdateVariations = "UPDATE tbl_variations SET quantity = quantity - ? WHERE id = ?";
        $stmtUpdateVariations = $conn->prepare($queryUpdateVariations);
        $queryUpdateVariations = "UPDATE tbl_variations SET quantity = quantity - ? WHERE id = ?";
        $stmtUpdateVariations = $conn->prepare($queryUpdateVariations);
        $queryUpdateTransaction = "UPDATE tbl_transactions SET address = ?, status = 'Pending', transaction_id = ?, discount = ?, shipping = ? WHERE user_id = ? AND status = 'Cart'";
        $stmtUpdateTransaction = $conn->prepare($queryUpdateTransaction);

        $conn->autocommit(FALSE);
        $success = true;

        $transactionId = time() . "_" . $userId;

        try {
            foreach ($variationIDs as $index => $variationID) {
                $qty = $quantities[$index];
                $stmtUpdateVariations->bind_param("ii", $qty, $variationID);
                if (!$stmtUpdateVariations->execute()) {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                $stmtUpdateTransaction->bind_param("ssssi", $address, $transactionId, $discountMethod, $shippingMethod, $userId);
                if (!$stmtUpdateTransaction->execute()) {
                    $success = false;
                }
            }

            if ($success) {
                $conn->commit();
                echo json_encode(['type' => 'orderPlaced', 'status' => 'success', 'message' => 'Order placed successfully.']);
            } else {
                $conn->rollback();
                echo json_encode(['type' => 'orderPlaced', 'status' => 'error', 'message' => 'Failed to place order.']);
            }
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['type' => 'orderPlaced', 'status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        } finally {
            $stmtUpdateVariations->close();
            $stmtUpdateTransaction->close();
            $conn->autocommit(TRUE);
        }
    }

    if ($type === 'loadPurchaseOrders') {
        try {
            $purchaseOrders = loadPurchaseOrders($conn);
            echo json_encode($purchaseOrders);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    if ($type === 'loadPODetails' && isset($_POST['transaction_id'])) {
        $transactionId = $_POST['transaction_id'];
        try {
            $orderDetails = loadPurchaseOrders($conn, $transactionId);
            echo json_encode($orderDetails);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
