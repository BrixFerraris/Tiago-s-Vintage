<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/server/includes/dbCon.php'; 
// require __DIR__ . '/client/includes/clientFunctions.php'; 


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use React\EventLoop\Factory;
use React\Socket\Server as SocketServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class ProductLoader implements MessageComponentInterface {
    protected $clients;
    protected $db;

    public function __construct($db) {
        $this->clients = new \SplObjectStorage;
        $this->db = $db;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        date_default_timezone_set('Asia/Manila');
        $data = json_decode($msg, true);
        if ($data['type'] === 'loadProducts') {
            $this->loadProducts($from);
        } elseif ($data['type'] === 'deleteProduct') {
            $this->deleteProduct($from, $data['id']);
        } elseif ($data['type'] === 'editProduct') {
            $this->editProduct($from, $data['id'], $data['title'], $data['price'], $data['category'], $data['subCategory']);
        } elseif ($data['type'] === 'loadEdits') {
            $this->loadEditProducts($from, $data['id']);
        } elseif ($data['type'] === 'loadCategories') {
            $this->loadCategories($from);
        } elseif ($data['type'] === 'deleteCategory') {
            $this->deleteCategory($from, $data['id']);
        } elseif ($data['type'] === 'updateCategory') {
            $this->editCategory($from, $data['id'], $data['newValue']);
        } elseif ($data['type'] === 'loadParentCategory') {
            $this->loadParentCategory($from);
        } elseif ($data['type'] === 'loadSingleProduct') {
            $this->loadEditProducts($from, $data['id']);
        } elseif ($data['type'] === 'loadCart') {
            $this->loadCart($from, $data['user_id']);
        } elseif ($data['type'] === 'order') {
            $this->editCart($from,  $data['address'],$data['user_id'], $data['variationID'], $data['qty']);
        } elseif ($data['type'] === 'loadPurchaseOrders') {
            $this->getTransactions($from);
        } elseif ($data['type'] === 'loadPODetails') {
            $this->getTransactionOrderItems($from, $data['transaction_id']);
        } elseif ($data['type'] === 'searchProducts') {
            $this->searchProducts($from, $data['title'], $data['category']);
        } elseif ($data['type'] === 'loadEditVariation') {
            $this->loadEditVariation($from, $data['id']);
        } elseif ($data['type'] === 'removeCart') {
            $this->removeFromCart($from, $data['transactionID']);
        } elseif ($data['type'] === 'checkOut') {
            $this->checkOut($from, $data['quantity'], $data['total'], $data['transactionID']);
        }  elseif ($data['type'] === 'getProductsByCategory') {
            $this->sendProductsByCategory($from, $data['category']);
        }
    }

    private function editCart(ConnectionInterface $conn, $address, $userId, $variationData, $qtyData) {
        $queryUpdateVariations = "UPDATE tbl_variations SET quantity = quantity - ? WHERE id = ?";
        $stmtUpdateVariations = $this->db->prepare($queryUpdateVariations);
        
        $queryUpdateTransaction = "UPDATE tbl_transactions SET address = ?, status = 'Pending', transaction_id = ? WHERE user_id = ? AND status = 'Cart'";
        $stmtUpdateTransaction = $this->db->prepare($queryUpdateTransaction);
        
        $this->db->autocommit(FALSE); 
        $success = true;
    
        $transactionId = time() . "_" . $userId; 
    
        try {
            foreach ($variationData as $index => $variationID) {
                $qty = $qtyData[$index]; 
                $stmtUpdateVariations->bind_param("ii", $qty, $variationID);
                if (!$stmtUpdateVariations->execute()) {
                    $success = false; 
                    break; 
                }
            }
            if ($success) {
                $stmtUpdateTransaction->bind_param("ssi", $address, $transactionId, $userId);
                if (!$stmtUpdateTransaction->execute()) {
                    $success = false; 
                }
            }
    
            if ($success) {
                $this->db->commit();
                $conn->send(json_encode(['type' => 'editCart', 'status' => 'success', 'message' => 'Cart updated successfully.']));
            } else {
                $this->db->rollback();
                $conn->send(json_encode(['type' => 'editCart', 'status' => 'error', 'message' => 'Failed to update cart.']));
            }
        } catch (Exception $e) {
            $this->db->rollback();
            $conn->send(json_encode(['type' => 'editCart', 'status' => 'error', 'message' => 'Error: ' . $e->getMessage()]));
        } finally {
            $stmtUpdateVariations->close();
            $stmtUpdateTransaction->close();
            $this->db->autocommit(TRUE); 
        }
    }

    private function sendProductsByCategory(ConnectionInterface $conn, $category) {
        $stmt = $this->db->prepare('SELECT * FROM tbl_products WHERE category = ?');
        $stmt->bind_param('s', $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
        $conn->send(json_encode([
            'type' => 'categoryProducts',
            'products' => $products
        ]));
    }

    
    private function checkOut(ConnectionInterface $conn, $quantity, $total, $transactionID) {
        $query = "UPDATE tbl_transactions SET quantity = ?, total = ? WHERE id = '$transactionID'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $quantity, $total);
        $stmt->execute();
        $conn->send(json_encode(value: ['type' => 'checkout', 'transactionID' => $transactionID]));
        $stmt->close();
    }

    private function removeFromCart(ConnectionInterface $conn, $transactionID) {
        $query = "DELETE FROM tbl_transactions WHERE id = '$transactionID'";
        $this->db->query($query);
        $conn->send(json_encode(['type' => 'cartItemRemoved', 'TransactionID' => $transactionID]));
    }

    private function loadEditVariation(ConnectionInterface $conn, $id) {
        $variations = loadVariation($this->db, $id);
        $response = [
            'type' => 'variation',
            'variation' => $variations
        ];
        $conn->send(json_encode($response));
    }
    

    private function deleteProduct(ConnectionInterface $conn, $id) {
        $query = "DELETE FROM tbl_products WHERE id = '$id'";
        $this->db->query($query);
        $conn->send(json_encode(['type' => 'productDeleted', 'id' => $id]));
    }

    private function searchProducts(ConnectionInterface $conn, $title, $category) {
        $stmt = $this->db->prepare('SELECT * FROM tbl_products WHERE title LIKE ? AND category = ?');
        $searchTerm = "%{$title}%";
        $stmt->bind_param('ss', $searchTerm, $category); 
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        $stmt->close();
    
        $conn->send(json_encode([
            'type' => 'searchResults',
            'products' => $products
        ]));
    }
    

    private function deleteCategory(ConnectionInterface $conn, $id) {
        $query = "DELETE FROM tbl_categories WHERE id = '$id'";
        $this->db->query($query);
        $conn->send(json_encode(['type' => 'categoryDeleted', 'id' => $id]));
    }

    private function editCategory(ConnectionInterface $conn, $id, $child) {
        $query = "UPDATE tbl_categories SET child = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $child, $id);
        $stmt->execute();
        $conn->send(json_encode(['type' => 'CategoryEdited', 'id' => $id]));
        $stmt->close();
    }
    

    private function getTransactions(ConnectionInterface $conn){
        $transactions = loadPurchaseOrders($this->db);
        foreach ($transactions as $transaction) {
            $transaction['type'] = 'purchase-order';
            $conn->send(json_encode($transaction));
        }
    }



    private function getTransactionOrderItems(ConnectionInterface $conn, $transactionId) {
        $query = $this->db->prepare('SELECT t.*, p.*, u.* FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id WHERE transaction_id = ?');
        $query->bind_param('s', $transactionId);
        $query->execute();
        $result = $query->get_result();
        $orderItems = [];
        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $orderItems[] = $row;
            $total += $row['total'];
            $name = $row["firstName"]." ".$row["lastName"];
            $address = $row["address"];
            $contact = $row["contact"];
            $id = $row["id"];
            $status = $row["status"];
        }
        $conn->send(json_encode(['order_items' => $orderItems, 'order_total' => $total, 'name' => $name, 'address' => $address, 'contact' => $contact, 'id' => $id, 'status' => $status])); 
    }

    private function loadProducts(ConnectionInterface $conn) {
        $products = getProducts($this->db);
        foreach ($products as $product) {
            $product['type'] = 'product';
            $conn->send(json_encode($product));
        }
    }


    private function loadCart(ConnectionInterface $conn, $user_id) {
        $cart = array_map(function ($product) {
            $product['type'] = 'cart-items';
            return $product;
        }, getCart($this->db, $user_id));
        $conn->send(json_encode($cart));
    }

    private function loadCategories(ConnectionInterface $conn) {
        $categories = array_map(function($category) {
            $category['type'] = 'categories';
            return $category;
        }, getCategories($this->db));
        $conn->send(json_encode($categories));
    }

    private function loadEditProducts(ConnectionInterface $conn, $id) {
        $product = getSingleProduct($this->db, $id);
        if ($product) {
            $product['type'] = 'edit-product';
            $conn->send(json_encode($product));
        }
    }

    private function editProduct(ConnectionInterface $conn, $id, $title, $price, $category, $subCategory) {
        $query = "UPDATE tbl_products SET title = ?, price = ?, category = ?, sub_category = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sissi", $title, $price, $category, $subCategory, $id);
        $stmt->execute();
        $conn->send(json_encode(['type' => 'productEdited', 'id' => $id]));
        $stmt->close();
    }

    
    private function addVariation(ConnectionInterface $conn, $id, $name, $width, $length, $quantity){
        $query = "INSERT INTO tbl_variation(product_id, name, width, length, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isiii", $id, $name, $width, $length, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$loop = Factory::create();
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ProductLoader($conn)
        )
    ),
    8080
);

$server->run();

function getProducts($db) {
    $result = $db->query('SELECT * FROM tbl_products LIMIT 15');
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

function getSingleProduct($db, $id) {
    $query = "SELECT * FROM tbl_products WHERE id =?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    return $product;
}


function getCart($db, $user_id) {
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
    t.id  AS transactionId,
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
    t.user_id = ? AND t.status = 'Cart';";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart = [];
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
    }
    return $cart;
}

function getSingleOrder($db, $transactionId) {
    $query = $db->query("SELECT t.*, p.*, u.* FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id WHERE transaction_id = '$transactionId'");
    $transaction = [];
    while ($row = $query->fetch_assoc()) {
      $transaction[] = $row;
    }
    return $transaction;
  }

function loadPurchaseOrders($db) {
    $query = $db->query('SELECT t.*, p.*, u.* FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id');
    $transaction = [];
    while ($row = $query->fetch_assoc()) {
        $transaction[] = $row;
    }
    return $transaction;
}


