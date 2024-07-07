<?php
include('../includes/config.php');
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
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="../css/edittiket.css">
</head>
<body>
    <h1>Edit Ticket</h1>
    <form action="process_edit_ticket.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $ticket['id']; ?>">
        <label for="ticket_name">Ticket Name:</label>
        <input type="text" id="ticket_name" name="ticket_name" value="<?php echo $ticket['name']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $ticket['description']; ?></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $ticket['price']; ?>" required><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>
        <input type="submit" value="Update Ticket">
        <input type="button" value="Back to Dashboard" onclick="window.location.href='dashboard.php';" class="back-button">
    </form>
</body>
</html>
