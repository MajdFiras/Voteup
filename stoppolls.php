<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$poll_id = $_GET['poll_id'];
require("connection.php");
$stmt = $db->prepare('UPDATE poll SET status = 1 WHERE poll_id = :poll_id');
$stmt->execute(array(
    ":poll_id" => $poll_id
)); 

header("Location: mypolls.php"); 
exit();
?>
