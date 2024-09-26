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
            $this->editProduct($from, $data['id'], $data['title'], $data['price'], $data['category']);
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
            $this->editCart($from,  $data['address'], $data['user_id']);
        }
    }
    
    private function deleteProduct(ConnectionInterface $conn, $id) {
        $query = "DELETE FROM tbl_products WHERE id = '$id'";
        $this->db->query($query);
        $conn->send(json_encode(['type' => 'productDeleted', 'id' => $id]));
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
    

    private function loadParentCategory(ConnectionInterface $conn) {
        $categories = getParentCategories($this->db);
        foreach ($categories as $category) {
            $category['type'] = 'parentCategory';
            $conn->send(json_encode($category));
        }
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

    private function editProduct(ConnectionInterface $conn, $id, $title, $price, $category) {
        $query = "UPDATE tbl_products SET title = ?, price = ?, category = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisi", $title, $price, $category, $id);
        $stmt->execute();
        $conn->send(json_encode(['type' => 'productEdited', 'id' => $id]));
        $stmt->close();
    }

    private function editCart(ConnectionInterface $conn, $address, $user_id) {
        $timestamp = time();
        $transactionId = $timestamp . '_' . $user_id;
        $query = "UPDATE tbl_transactions SET status = 'Pending', address = ?, transaction_id = ? WHERE user_id =? AND status = 'Cart'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $address, $transactionId, $user_id);
        $stmt->execute();
        $conn->send(json_encode(['type' => 'successPlace', 'id' => $user_id, 'transaction_id' => $transactionId]));
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
function getCategories($db) {
    $result = $db->query('SELECT * FROM tbl_categories');
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}

function getParentCategories($db) {
    $result = $db->query('SELECT parent FROM tbl_categories');
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    return $categories;
}

function getCart($db, $user_id) {
    $query = "SELECT t.*, p.*, u.* FROM tbl_transactions t INNER JOIN tbl_products p ON t.product_id = p.id INNER JOIN tbl_users u ON t.user_id = u.id WHERE t.user_id = ? AND t.status = 'Cart'";
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

function loadPurchaseOrders() {
    
}