
<?php 
$pageTitle = "Results";
include("header.php"); 
?>

<style>
    main {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        color: #333;
        margin-bottom: 20px;
        font-family: 'Open Sans', sans-serif;
        text-align: center;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
        transition: background-color 0.3s;
        cursor: pointer;
        font-family: 'Open Sans', sans-serif;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    li:hover {
        background-color: #e0e0e0;
    }

    button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Open Sans', sans-serif;
        transition: background-color 0.3s;
        width: 100%;
    }

    button:hover {
        background-color: #45a049;
    }

    label {
        font-weight: bold;
    }
</style>

<main>
    <?php
    require("connection.php");

    $poll_id = $_GET['poll_id'];

    // Fetch question and options from the poll table
    $stmt = $db->prepare('SELECT question, options FROM poll WHERE poll_id = :poll_id');
    $stmt->bindParam(':poll_id', $poll_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "<h2>{$result['question']}</h2>";

       
        if (isset($result['options']) && !empty($result['options'])) {
            
            $options = explode(',', $result['options']);

            
            $voteCounts = array();
            foreach ($options as $option) {
                $stmt = $db->prepare('SELECT COUNT(*) AS count FROM vote WHERE poll_id = :poll_id AND choice = :choice');
                $stmt->bindParam(':poll_id', $poll_id);
                $stmt->bindParam(':choice', $option);
                $stmt->execute();
                $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                $voteCounts[$option] = $count;
            }

            // Display the options along with vote counts in a form
            echo "<form>";
            echo "<ul>";
            foreach ($options as $option) {
                echo "<li><label>$option</label> {$voteCounts[$option]} votes</li>";
            }
            echo "</ul>";
            echo "</form>";
        } else {
            echo "No options available for this poll.";
        }
    } else {
       
        echo "Poll not found.";
    }
    ?>
</main>

<?php 
include("footer.php")
?>
