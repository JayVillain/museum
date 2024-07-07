<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ticket</title>
    <link rel="stylesheet" href="../css/addtiket.css">
</head>
<body>
    <h1>Add Ticket</h1>
    <form action="process_add_ticket.php" method="post" enctype="multipart/form-data">
        <label for="ticket_name">Ticket Name:</label>
        <input type="text" id="ticket_name" name="ticket_name" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>
        <input type="submit" value="Add Ticket">
        <input type="button" value="Back to Dashboard" onclick="window.location.href='dashboard.php';" class="back-button">
    </form>
</body>
</html>
