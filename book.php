<?php
include('includes/config.php');

$id = $_GET['id'];
$query = "SELECT * FROM tickets WHERE id=$id";
$result = mysqli_query($conn, $query);
$ticket = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <link rel="stylesheet" href="css/book.css">
</head>
<body>
    <h1>Book Ticket</h1>
    <form action="process_booking.php" method="post">
        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="tickets">Number of Tickets:</label>
        <input type="number" id="tickets" name="tickets" required><br>
        <input type="submit" value="Book Now">
    </form>
</body>
</html>
