<?php
if (isset($_POST['submit'])) {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $paymentMethod = htmlspecialchars($_POST['payment-method']);

    // Handle receipt upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image
    $check = getimagesize($_FILES["receipt"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["receipt"]["size"] > 2000000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
            $message = "Order received! Your file has been uploaded.";
            // Further processing can be done here (e.g., store order details in a database)
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }

    // Redirect back to the checkout page with a message
    header("Location: checkout.php?message=" . urlencode($message));
    exit();
}
?>
