

<?php 
$pageTitle = "VoteUp";
include("header.php"); 
?>
    <main>

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
        .vote-button{
            background-color: #2987A7; 
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
        p{
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            font-size: 20px;
        }
    </style>
        <h1> Latest 5 Polls</h1>
        
        <?php
        require("connection.php");
        $stmt = $db->prepare('SELECT question, poll_id FROM poll WHERE status = 0 ORDER BY poll_id DESC LIMIT 5');
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
                                    <a href="vote.php?poll_id=<?php echo $poll['poll_id'];?>"><button class="vote-button">Vote</button></a>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
    } else {
        echo '<p>No polls for now. : )</p>';
    }
    ?>
       

    </main>
<?php include("footer.php"); ?>