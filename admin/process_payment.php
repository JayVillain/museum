<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Update payment status in database
    $query = "UPDATE bookings SET payment_status = 1 WHERE id = $booking_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Payment status updated successfully');</script>";
        echo "<script>window.location.href = 'view_orders.php';</script>";
        exit();
    } else {
        echo "Error updating payment status: " . mysqli_error($conn);
    }
} else {
    echo "Booking ID is not set.";
}
?>
