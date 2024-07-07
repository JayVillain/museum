<?php
include('../includes/config.php');

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$query = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
