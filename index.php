<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voteup</title>
</head>
<body>
    <h1> Welcome</h1>  
    <a href="logout.php">Logout</a>
</body>
</html>