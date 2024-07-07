<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['booking_id'])) {
    header("Location: index.php");
    exit();
}

$booking_id = $_SESSION['booking_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle payment proof upload
    $target_dir = "images/payment_proof/";
    $target_file = $target_dir . basename($_FILES["payment_proof"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["payment_proof"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["payment_proof"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["payment_proof"]["name"])) . " has been uploaded.";
            
            // Update payment_proof path in bookings table
            $query = "UPDATE bookings SET payment_proof = '$target_file' WHERE id = $booking_id";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<script>alert('Payment proof uploaded successfully');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
                exit();
            } else {
                echo "Error updating payment proof: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Payment</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="payment_proof">Upload Payment Proof:</label>
        <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required><br>
        <input type="submit" name="submit" value="Upload Proof">
    </form>
</body>
</html>
