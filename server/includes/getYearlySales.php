<?php
header('Content-Type: application/json');
include_once './dbCon.php'; 

$query = "
    SELECT 
        DATE_FORMAT(date, '%Y') AS year,
        SUM(total) AS total_sales
    FROM 
        tbl_transactions
    WHERE 
        status = 'Completed'
    GROUP BY 
        year
    ORDER BY 
        year ASC;
";

$result = $conn->query($query);

$salesData = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $salesData[] = [
            'year' => $row['year'],
            'sales' => (float)$row['total_sales'] 
        ];
    }
}

echo json_encode($salesData);

$conn->close();