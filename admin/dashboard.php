<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include('../includes/config.php');
$query = "SELECT * FROM tickets";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="add_ticket.php">Tambah Tiket</a>
            <a href="view_orders.php">Lihat Data Pemesan</a>
            <a href="logout.php">Log Out</a>
        </nav>
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
                        <td><img src="../images/<?php echo $ticket['image']; ?>" width="50" height="50"></td>
                        <td>
                            <a href="edit_ticket.php?id=<?php echo $ticket['id']; ?>">Edit</a>
                            <a href="delete_ticket.php?id=<?php echo $ticket['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
