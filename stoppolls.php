<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Make sure to stop execution after redirect
}
?>


<?php
if (isset($_GET['poll_id'])) {
    $poll_id = $_GET['poll_id'];
    require("connection.php");
    $stmt = $db->prepare('SELECT poll_id, creator_id,question, options FROM poll WHERE poll_id = :poll_id');
    $stmt->bindParam(':poll_id', $poll_id);
    $stmt->execute(); 
    $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($polls)) {
        $poll = $polls[0]; 
        $creator_id = $poll['creator_id'];
        $poll_id = $poll['poll_id'];
        $question = $poll['question'];
        $options = $poll['options'];
        
        $sql = "INSERT INTO en_polls(poll_id, creator_id, question, options) VALUES (:poll_id, :creator_id, :question, :options)";
        $stmt = $db->prepare($sql);

        $stmt->execute(array(
            ":poll_id" => $poll_id,
            ":creator_id" => $creator_id,
            ":question" => $question,
            ":options" => $options
        ));

        $stmt = $db->prepare('DELETE FROM poll WHERE poll_id = :poll_id');
        $stmt->bindParam(':poll_id', $poll_id);
        $stmt->execute(); 

        header("Location: mypolls.php");
        exit();
    } else {
        echo "Poll not found";
    }
} else {
    // Handle the case where no poll_id is provided
    echo "Invalid request";
}

?>