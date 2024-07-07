<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tickets = $_POST['tickets'];
    $ticket_id = $_POST['ticket_id'];

    // Insert booking into database
    $query = "INSERT INTO bookings (ticket_id, name, email, tickets) 
              VALUES ($ticket_id, '$name', '$email', $tickets)";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Retrieve booking ID
        $booking_id = mysqli_insert_id($conn);

        // Store booking ID in session
        $_SESSION['booking_id'] = $booking_id;

        // Redirect to payment page
        header("Location: payment.php");
        exit();
    } else {
        echo "Error booking: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}
?>
