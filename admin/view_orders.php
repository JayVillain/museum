<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include('../includes/config.php');

// Proses penghapusan pesanan jika ada permintaan penghapusan satu per satu
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM bookings WHERE id = $delete_id";
    $result_delete = mysqli_query($conn, $query_delete);
    if ($result_delete) {
        echo "<script>alert('Order deleted successfully');</script>";
        // Redirect back to view_orders.php or refresh the page
        echo "<script>window.location.href = 'view_orders.php';</script>";
        exit();
    } else {
        echo "Error deleting order: " . mysqli_error($conn);
    }
}

// Proses penghapusan semua pesanan jika ada permintaan
if (isset($_POST['delete_all'])) {
    $query_delete_all = "DELETE FROM bookings";
    $result_delete_all = mysqli_query($conn, $query_delete_all);
    if ($result_delete_all) {
        echo "<script>alert('All orders deleted successfully');</script>";
        // Redirect back to view_orders.php or refresh the page
        echo "<script>window.location.href = 'view_orders.php';</script>";
        exit();
    } else {
        echo "Error deleting all orders: " . mysqli_error($conn);
    }
}

$query = "SELECT bookings.id, tickets.name AS ticket_name, bookings.name, bookings.email, bookings.tickets, bookings.created_at, bookings.payment_proof
          FROM bookings
          JOIN tickets ON bookings.ticket_id = tickets.id
          ORDER BY bookings.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="../css/vieworder.css">
</head>
<body>
    <h1>View Orders</h1>
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete all orders? This action cannot be undone.');">
        <input type="submit" name="delete_all" value="Delete All Orders">
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Ticket Name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tickets</th>
                <th>Order Date</th>
                <th>Payment Proof</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['ticket_name']; ?></td>
                    <td><?php echo $order['name']; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td><?php echo $order['tickets']; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                    <td>
                        <?php if (!empty($order['payment_proof'])) { ?>
                            <a href="../<?php echo $order['payment_proof']; ?>" target="_blank">View Proof</a>
                        <?php } else { ?>
                            No proof uploaded
                        <?php } ?>
                    </td>
                    <td>
                        <a href="view_orders.php?delete_id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <hr>
    <hr>
    <input type="button" value="Back to Dashboard" onclick="window.location.href='dashboard.php';" class="back-button">
</body>
</html>
