<?php
session_start();  // Mulai sesi
include('../includes/config.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admins WHERE username='$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $admin = mysqli_fetch_assoc($result);
    if (password_verify($password, $admin['password'])) {
        // Set session
        $_SESSION['admin'] = $admin['username'];
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Invalid username.";
}
?>
