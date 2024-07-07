<?php
include('../includes/config.php');

$id = $_POST['id'];
$query = "DELETE FROM tickets WHERE id=$id";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "Ticket deleted successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
header("Location: dashboard.php");
        exit();
?>
