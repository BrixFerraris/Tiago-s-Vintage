<?php
header('Content-Type: application/json');
include_once './dbCon.php';

$monthYear = isset($_GET['monthYear']) ? $_GET['monthYear'] : 'Overall';

if ($monthYear !== 'Overall') {
    list($month, $year) = explode('-', $monthYear);
    $query = "
        SELECT 
            p.id AS product_id,
            p.title AS product_name,
            COUNT(t.product_id) AS count
        FROM 
            tbl_transactions t
        INNER JOIN 
            tbl_products p ON t.product_id = p.id
        WHERE 
            t.status = 'Completed' 
            AND MONTH(t.date) = ? 
            AND YEAR(t.date) = ?
        GROUP BY 
            p.id, p.title
        ORDER BY 
            count DESC
        LIMIT 5;
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "
        SELECT 
            p.id AS product_id,
            p.title AS product_name,
            COUNT(t.product_id) AS count
        FROM 
            tbl_transactions t
        INNER JOIN 
            tbl_products p ON t.product_id = p.id
        WHERE 
            t.status = 'Completed'
        GROUP BY 
            p.id, p.title
        ORDER BY 
            count DESC
        LIMIT 5;
    ";

    $result = $conn->query($query);
}

$products = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode($products);

$conn->close();
