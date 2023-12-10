<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Make sure to stop execution after redirect
}
?>
<?php
$pageTitle = "My Polls";
include("header.php");
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
    <style>
        .card {
                border: 1px solid #ddd;
                border-radius: 8px;
                margin: 10px;
                padding: 15px;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: box-shadow 0.3s ease;
            }

        .card:hover {
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

        .card-title {
                font-size: 18px;
                margin-bottom: 10px;
            }

        .result-button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
        }
        .stop-button{
            background-color: #E13535; /* Green */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
        }
    </style>


    <main>
        <?php
        require("connection.php");
        $uid = $_SESSION['id'];
        $stmt = $db->prepare('SELECT question,poll_id FROM poll WHERE creator_id = :id');
        $stmt->bindParam(':id', $uid);
        $stmt->execute();

        // Fetch all rows as an associative array
        $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if there are any polls
        if ($polls) {
            foreach ($polls as $poll) {
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title"><?php echo $poll['question']; ?></h5>
                            <div class="card-buttons">
                                <button class="result-button">See Results</button>
                                <button class="stop-button">Stop</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p>No polls found.</p>';
        }
        ?>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>
