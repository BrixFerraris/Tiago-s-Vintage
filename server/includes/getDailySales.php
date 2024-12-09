<?php
header('Content-Type: application/json');
include_once './dbCon.php';

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$query = "
    SELECT 
        shipping,
        COUNT(*) AS transaction_count,
        SUM(grand_total) AS total_amount
    FROM 
        tbl_transactions
    WHERE 
        status = 'Completed'
        AND DATE(date) = ?
    GROUP BY 
        shipping;
";

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $date);
$stmt->execute();
$result = $stmt->get_result();

$salesData = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $shipping = $row['shipping'];
        $salesData[$shipping] = [
            'count' => (int)$row['transaction_count'],
            'total' => (float)$row['total_amount']
        ];
    }
}

echo json_encode($salesData);

$conn->close();