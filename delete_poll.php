<?php
session_start();
require("connection.php");

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['poll_id'])) {
    $pollId = $_GET['poll_id'];
    
    // Add additional validation if needed to ensure the user has the right to delete this poll

    $stmt = $db->prepare('DELETE FROM poll WHERE poll_id = :poll_id AND creator_id = :user_id');
    $stmt->bindParam(':poll_id', $pollId);
    $stmt->bindParam(':user_id', $_SESSION['id']);
    
    if ($stmt->execute()) {
        echo "Poll deleted successfully.";
    } else {
        echo "Error deleting poll.";
    }
} else {
    echo "Invalid request.";
}
?>
