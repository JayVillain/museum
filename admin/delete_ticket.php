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
    <title>Delete Ticket</title>
    <link rel="stylesheet" href="../css/delete.css">
</head>
<body>
    <h1>Delete Ticket</h1>
    <p>Are you sure you want to delete this ticket?</p>
    <p><strong><?php echo $ticket['name']; ?></strong></p>
    <form action="process_delete_ticket.php" method="post">
        <input type="hidden" name="id" value="<?php echo $ticket['id']; ?>">
        <input type="submit" value="Yes, Delete">
        <a href="dashboard.php">No, Go Back</a>
    </form>
</body>
</html>
