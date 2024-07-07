<?php
include('../includes/config.php');

$id = $_POST['id'];
$ticket_name = $_POST['ticket_name'];
$description = $_POST['description'];
$price = $_POST['price'];

if ($_FILES['image']['name']) {
    $image = $_FILES['image']['name'];
    $target = "../images/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $query = "UPDATE tickets SET name='$ticket_name', description='$description', price='$price', image='$image' WHERE id=$id";
} else {
    $query = "UPDATE tickets SET name='$ticket_name', description='$description', price='$price' WHERE id=$id";
}

$result = mysqli_query($conn, $query);

if ($result) {
    echo "Ticket updated successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
header("Location: dashboard.php");
        exit();
?>
