<?php
include_once 'dbCon.php';
if (isset($_POST['id'])) {
    $adminId = intval($_POST['id']);
    $query = "SELECT * FROM tbl_users WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode([
                'id' => $data['id'],
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'role' => $data['role'],
                'username' => $data['username'],
            ]);
        } else {
            echo json_encode(['error' => 'No user found']);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare the SQL statement']);
    }
    $conn->close();
} else {
    echo json_encode(['error' => 'ID not set']);
}
