<?php
include('../includes/config.php');

$ticket_name = $_POST['ticket_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_FILES['image']['name'];
$target = "../images/".basename($image);

$query = "INSERT INTO tickets (name, description, price, image) VALUES ('$ticket_name', '$description', '$price', '$image')";
$result = mysqli_query($conn, $query);

if ($result) {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo "Ticket added successfully!";
    } else {
        echo "Failed to upload image.";
    }
    header("Location: dashboard.php");
        exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
