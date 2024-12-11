<?php
session_start();
include_once './dbCon.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userId = $_SESSION['uID'];
$transactionId = $_POST['transaction_id'] ?? null;
$type = $_POST['type'] ?? null;
$issue = $_POST['issue'] ?? null;
$description = $_POST['description'] ?? null;
$replacement = $_POST['replacement'] ?? null;

if (!isset($userId)) {
    echo json_encode(["status" => "error", "message" => "User  not authenticated."]);
    exit;
}

if ($type === 'payment') {
    $status = 'Check Payment';
} elseif ($type === 'complete') {
    $status = 'Completed';
} elseif ($type === 'cancel') {
    $status = 'Cancelled';
} elseif ($type === 'replace') {
    $status = 'For Replacement';
} else {
    echo json_encode(["status" => "error", "message" => "Invalid type specified."]);
    exit;
}

$stmt = $conn->prepare("UPDATE tbl_transactions SET status = ? WHERE transaction_id = ? AND user_id = ?");
$stmt->bind_param("ssi", $status, $transactionId, $userId);

if ($stmt->execute()) {
    if ($type === 'complete') {
        $countQuery = $conn->prepare("SELECT COUNT(*) as completed_count FROM tbl_transactions WHERE transaction_id = ? AND user_id = ? AND status = 'Completed'");
        $countQuery->bind_param("si", $transactionId, $userId);
        $countQuery->execute();
        $countResult = $countQuery->get_result();
        $row = $countResult->fetch_assoc();
        $completedCount = intval($row['completed_count'] ?? 0);
        $countQuery->close();

        if ($completedCount > 0) {
            $pointsQuery = $conn->prepare("UPDATE tbl_users SET points = ? WHERE id = ?");
            $pointsQuery->bind_param("ii", $completedCount, $userId);

            if ($pointsQuery->execute()) {
                error_log("Points updated successfully. Added Points: $completedCount");
                echo json_encode(["status" => "success", "message" => "Points updated successfully."]);
            } else {
                error_log("Failed to update points: " . $pointsQuery->error);
                echo json_encode(["status" => "error", "message" => "Failed to update points."]);
            }
            $pointsQuery->close();
        } else {
            echo json_encode(["status" => "info", "message" => "No completed transactions found."]);
        }
    } elseif ($type === 'replace') {
        $targetDir = "uploads/";
        $uploadedImages = [];

        if (!empty($_FILES['uploadImages']['name'][0])) {
            foreach ($_FILES['uploadImages']['name'] as $key => $name) {
                $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
                $uniqueFileName = time() . "_" . uniqid('', true) . '.' . $fileExtension;
                $targetFilePath = $targetDir . $uniqueFileName;
                if (move_uploaded_file($_FILES['uploadImages']['tmp_name'][$key], $targetFilePath)) {
                    $uploadedImages[] = $uniqueFileName;
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to upload image: $name."]);
                    exit;
                }
            }
        }

        $img1 = $uploadedImages[0] ?? null;
        $img2 = $uploadedImages[1] ?? null;

        $insertQuery = $conn->prepare("INSERT INTO tbl_replacements (transaction_id, issue, description, img1, img2) VALUES(?, ?, ?, ?, ?)");
        $insertQuery->bind_param('sssss', $transactionId, $issue, $description, $img1, $img2);

        if ($insertQuery->execute()) {
            echo json_encode(["status" => "success", "message" => "Replacement logged successfully."]);
        } else {
            error_log("Failed to insert replacement record: " . $insertQuery->error);
            echo json_encode(["status" => "error", "message" => "Failed to log replacement."]);
        }
        $insertQuery->close();
    }
} else {
    error_log("Failed to update transaction status: " . $stmt->error);
    echo json_encode(["status" => "error", "message" => "Failed to update status."]);
}

$stmt->close();
$conn->close();