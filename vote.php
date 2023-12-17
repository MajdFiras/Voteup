
<?php

$pageTitle = "Vote";
include("header.php");

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}





$poll_id = $_GET['poll_id'];
$u_id = $_SESSION['id'];

require("connection.php");
$errorMsg = '';
$successMsg = '';


try {
    $stmt = $db->prepare('SELECT question,options FROM poll WHERE poll_id = :poll_id');
    $stmt->bindParam(':poll_id', $poll_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['selected_option'])) {
            $selected_option = $_POST['selected_option'];
            $old_so = $selected_option;

           
            $sql = "INSERT INTO vote(poll_id,u_id,choice) VALUES (:poll_id, :u_id, :choice)";
            $stmt = $db->prepare($sql);

            $stmt->execute(array(
                ":u_id" => $u_id,
                ":poll_id" => $poll_id,
                ":choice" => $selected_option
            ));

        $successMsg = "Your vote was submitted.";


        }
    }
} catch (PDOException $e) {

    $stmt = $db->prepare('SELECT choice FROM vote WHERE poll_id = :poll_id');
    $stmt->bindParam(':poll_id', $poll_id);
    $stmt->execute();
    $cho = $stmt->fetch(PDO::FETCH_ASSOC);
    $errorMsg = "You Already Voted for " . $cho['choice'] . ". You can't vote more than once.";
    
}
?>


<script>
   document.addEventListener('DOMContentLoaded', function () {
    var radioButtons = document.querySelectorAll('input[type="radio"]');

    radioButtons.forEach(function (radio) {
        radio.addEventListener('click', function () {
            radioButtons.forEach(function (otherRadio) {
                var label = otherRadio.parentNode;
                label.classList.remove('selected'); 
            });

            var selectedLabel = radio.parentNode;
            selectedLabel.classList.add('selected'); 
        });
    });
});
</script>

<style>
      @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;1,300;1,400&family=Roboto:ital,wght@0,300;0,400;1,100;1,300&display=swap');

        body {
            background-color: #f4f4f4;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

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

        input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        label {
            cursor: pointer;
            width: 100%;
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

    
        input[type="radio"]:checked + label {
            background-color: #bcbcbc;
            color: #bcbcbc;
        }
     label.selected {
        background-color: #bcbcbc; 
        color: #fff;
        transition: background-color 0.3s, color 0.3s; 
        padding: 20px; 
        border-radius: 8px; 
}

.error-message {
        background-color: #ffdddd;
        color: #dc3545;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #dc3545;
        border-radius: 8px;
    }
.success-message {
    background-color: #d9ead3;
    color: #6aa84f;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid ##6aa84f;
    border-radius: 8px;
}
</style>

<main>

    <?php if ($successMsg !== '') : ?>
    <div class="success-message"><?php echo $successMsg; ?></div>
    <?php endif; ?>
    <?php
    if ($errorMsg !== '') {
        // Display error message in a styled div
        echo "<div class='error-message'>$errorMsg</div>";
    }
    if ($result) {
        
        echo "<h2>{$result['question']}</h2>";

        // Check if options are present before attempting to display them
        if (isset($result['options']) && !empty($result['options'])) {
            // Display the options (assuming options are stored as a comma-separated string)
            $options = explode(',', $result['options']);
            echo "<form method='post'>";
            echo "<ul>";
            foreach ($options as $option) {
                echo "<li><label><input type='radio' name='selected_option' value='$option'>$option</label></li>";
            }
            echo "</ul>";
            echo "<button type='submit'>Vote</button>";
            echo "</form>";
        } else {
            echo "No options available for this poll.";
        }
    } else {
        // Handle the case where the poll is not found
        echo "Poll not found.";
    }
    ?>
</main>

<?php include("footer.php"); ?>
