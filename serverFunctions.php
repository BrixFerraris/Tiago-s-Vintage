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

function loadPurchaseOrders($conn, $transactionId = null)
{
    if ($transactionId) {
        $query = $conn->prepare('SELECT t.*, p.*, u.firstName, u.lastName, u.id, u.username, u.points, u.contact FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id WHERE t.transaction_id = ?');
        $query->bind_param('s', $transactionId);
    } else {
        $query = $conn->query('SELECT t.*, p.*, u.firstName, u.lastName, u.id, u.username, u.points, u.contact FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id');
    }

    $orderItems = [];
    $total = 0;
    $name = '';
    $address = '';
    $contact = '';
    $id = '';
    $status = '';
    $username = '';
    $points = '';
    $discount = '';
    $shipping = '';



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
            $username = $row["username"];
            $points = $row["points"];
            $discount = $row["discount"];
            $shipping = $row["shipping"];
        }

        return [
            'order_items' => $orderItems,
            'order_total' => $total,
            'name' => $name,
            'address' => $address,
            'contact' => $contact,
            'id' => $id,
            'status' => $status,
            'username' => $username,
            'points' => $points,
            'discount' => $discount,
            'shipping' => $shipping,
        ];
    } else {
        while ($row = $query->fetch_assoc()) {
            $orderItems[] = $row;
        }
        return $orderItems;
    }
}

function getCart($conn, $user_id)
{
    $query = "SELECT 
    p.img1, 
    p.title, 
    v.variationName, 
    p.retail_price, 
    p.id, 
    t.quantity, 
    u.firstName, 
    u.lastName, 
    u.contact,
    COALESCE(completed.completedTransactions, 0) AS completedTransactions,
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
LEFT JOIN 
    (
        SELECT user_id, COUNT(*) AS completedTransactions
        FROM tbl_transactions
        WHERE status = 'Completed'
        GROUP BY user_id
    ) completed ON completed.user_id = t.user_id 
WHERE 
    t.user_id = ? AND t.status = 'Cart'
";
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

function getProductsByCategory($conn, $category)
{
    $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);

    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();

    return $products;
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
        $shippingMethod = $_POST['shipMethod'];
        $discountMethod = $_POST['discount_method'] ?? '';
        $grandTotal = $_POST['grandTotal'];
        $pending = $_POST['status'];
        $queryUpdateVariations = "UPDATE tbl_variations SET quantity = quantity - ? WHERE id = ?";
        $stmtUpdateVariations = $conn->prepare($queryUpdateVariations);

        $queryUpdateTransaction = "UPDATE tbl_transactions SET address = ?, grand_total = ?, transaction_id = ?, shipping = ?, discount = ?, status = ? WHERE user_id = ? AND status = 'Cart'";
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
                $stmtUpdateTransaction->bind_param("sissssi", $address, $grandTotal, $transactionId, $shippingMethod, $discountMethod, $pending, $userId);
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
    if (isset($_POST['type']) && $_POST['type'] === 'updateReview' && isset($_POST['id']) && isset($_POST['visible'])) {
        $reviewId = $_POST['id'];
        $visible = $_POST['visible'];

        $sql = "UPDATE tbl_reviews SET visible = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "si", $visible, $reviewId);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to update review visibility: ' . mysqli_error($conn)]);
        }

        mysqli_stmt_close($stmt);
        exit();
    }
}
if (isset($_GET['action']) && $_GET['action'] === 'getReviews') {
    $sql = "SELECT * FROM tbl_reviews";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo json_encode(['error' => 'Database query failed: ' . mysqli_error($conn)]);
        exit();
    }

    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }

    if (empty($reviews)) {
        echo json_encode(['error' => 'No visible reviews found']);
        exit();
    }

    echo json_encode($reviews);
    exit();
}