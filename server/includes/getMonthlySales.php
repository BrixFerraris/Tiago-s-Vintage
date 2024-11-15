<?php
header('Content-Type: application/json');
include_once './dbCon.php'; 

$query = "
    SELECT 
        DATE_FORMAT(date, '%Y-%m') AS month,
        SUM(total) AS total_sales
    FROM 
        tbl_transactions
    WHERE 
        status = 'Completed'
    GROUP BY 
        month
    ORDER BY 
        month ASC;
";

$result = $conn->query($query);

$salesData = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $salesData[] = [
            'month' => $row['month'],
            'sales' => (float)$row['total_sales'] 
        ];
    }
}

echo json_encode($salesData);

$conn->close();