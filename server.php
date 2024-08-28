<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/server/includes/dbCon.php'; // Include your dbCon.php file

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

