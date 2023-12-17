<?php
$pageTitle = "My Polls";
include("header.php");
?>
<?php
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Make sure to stop execution after redirect
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
            background-color: #4CAF50; 
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
            background-color: #E13535; 
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
            text-decoration: none;
        }

        a{ 
            text-decoration: none;
            color: inherit;
        }
        p{
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            font-size: 20px;
            
        }
    </style>


    <main>
        <?php
        require("connection.php");
        $uid = $_SESSION['id'];
        $stmt = $db->prepare('SELECT question,poll_id FROM poll WHERE creator_id = :id AND status = 0');
        $stmt->bindParam(':id', $uid);
        $stmt->execute();

        
        $polls = $stmt->fetchAll(PDO::FETCH_ASSOC);

       
        if ($polls) {
            foreach ($polls as $poll) {
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-content">
                            <h5 class="card-title"><?php echo $poll['question']; ?></h5>
                            <div class="card-buttons">
                                <a href="results.php?poll_id=<?php echo $poll['poll_id'];?>"><button class="result-button">See Results</button></a> 
                                <button class="stop-button"><a href="stoppolls.php?poll_id=<?php echo $poll['poll_id'];?>">Stop</a></button></a>
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
