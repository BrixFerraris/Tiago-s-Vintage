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
        $data = json_decode($msg, true);
        if ($data['type'] === 'loadProducts') {
            $this->loadProducts($from);
        } elseif ($data['type'] === 'deleteProduct') {
            $this->deleteProduct($from, $data['id']);
        } elseif ($data['type'] === 'editProduct') {
            $this->editProduct($from, $data['id'], $data['title'], $data['price'], $data['category']);
        } elseif ($data['type'] === 'loadEdits') {
            $this->loadEditProducts($from, $data['id']);
        } elseif ($data['type'] === 'qeqeq') {
            $this->loadCategories($from);
        }
    }
    
    private function deleteProduct(ConnectionInterface $conn, $id) {
        $query = "DELETE FROM tbl_products WHERE id = '$id'";
        $this->db->query($query);
        $conn->send(json_encode(['type' => 'productDeleted', 'id' => $id]));
    }


    private function loadProducts(ConnectionInterface $conn) {
        $products = getProducts($this->db);
        foreach ($products as $product) {
            $product['type'] = 'product';
            $conn->send(json_encode($product));
        }
    }

    private function loadCategories(ConnectionInterface $conn) {
        $categories = getCategories($this->db);
        foreach ($categories as $category) {
            $category['type'] = 'categories';
            $conn->send(json_encode($category));
        }
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

<<<<<<< Updated upstream
    private function addVariation(ConnectionInterface $conn, $id, $name, $width, $length, $quantity){
        $query = "INSERT INTO tbl_variation(product_id, name, width, length, quantity) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isiii", $id, $name, $width, $length, $quantity);
        $stmt->execute();
        $stmt->close();
    }
=======

    

>>>>>>> Stashed changes

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