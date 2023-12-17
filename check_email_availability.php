<?php
session_start();
require("connection.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo '<span style="color: red;">Email is already taken</span>';
    } else {
        echo '<span style="color: green;">Email is available</span>';
    }
}
?>
