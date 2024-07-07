<?php
include('includes/config.php');
$query = "SELECT * FROM tickets";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Ticket Booking</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <h1>Welcome to Museum Ticket Booking</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($ticket = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $ticket['id']; ?></td>
                    <td><?php echo $ticket['name']; ?></td>
                    <td><?php echo $ticket['description']; ?></td>
                    <td><?php echo $ticket['price']; ?></td>
                    <td><img src="images/<?php echo $ticket['image']; ?>" width="50" height="50"></td>
                    <td>
                        <a href="book.php?id=<?php echo $ticket['id']; ?>">Book</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
