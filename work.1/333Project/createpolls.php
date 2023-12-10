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
    <link rel="stylesheet" href="style/createpoll.css">
    <title>createpolls</title>
    
</head>
<body>
<?php include("header.php"); ?>
    <main>
    <div class="container">
        <h2>Create a Poll</h2>
        <form action="#" method="post">
            
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" required>
            
            <div id="options-container">
                    <div>
                        <label for="option1">Option 1:</label>
                        <input type="text" name="options[]" required>
                    </div>
                    
                    <div>
                        <label for="option2">Option 2:</label>
                        <input type="text" name="options[]" required>
                    </div>
            </div>

            <div class="btn">
            <button type="button" onclick="addOption()">Add Option</button>
            </div>

            
            <label for="end_date">End Date:</label>
            <input type="datetime-local" id="end_date" name="end_date" requird>

            <input name="create" type="submit" value="create">
            
        </form>
    </div>
    </main>
    
<?php include("footer.php"); ?>
</body>

<?php 

$pdo = new PDO("mysql:host=localhost;dbname=users;charset=utf8", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["create"])) {

    $user_id = $_SESSION['id'] ;
    $question = $_POST['question'];
    $options = $_POST['options'];
    $options_str = is_array($options) ? implode(', ', $options) : $options;
    $end_date = $_POST['end_date'];

    $sql = "INSERT INTO poll(creator_id, question, options, end_date) VALUES (:creator_id, :question, :options, :end_date)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
        ":creator_id" => $user_id,
        ":question" => $question,
        ":options" => $options_str,
        ":end_date" => $end_date
    ));

    echo "<script> alert('poll created successfully') </script>";

    $db = null;

    

}

?>

<script>
        function addOption() {
            var optionsContainer = document.getElementById("options-container");
            
            var newOptionDiv = document.createElement("div");
            
            var optionNumber = optionsContainer.children.length + 1;
            
            newOptionDiv.innerHTML = `
                <label for="option${optionNumber}">Option ${optionNumber}:</label>
                <input type="text" name="options[]" required>
            `;
            
            optionsContainer.appendChild(newOptionDiv);
        }
    </script>
