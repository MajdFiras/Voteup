<?php 
$pageTitle = "Open Polls";
include("header.php"); 
?>
    <main>
      <style >
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
        .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
         }

       .pagination a {
        color: #007BFF;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #007BFF;
        border-radius: 4px;
        margin: 0 4px;
        transition: background-color 0.3s ease;
       }

      .pagination a:hover {
        background-color: #007BFF;
         color: white;
       }
   
      .pagination .disabled {
          color: #ccc;
        pointer-events: none;
        border: 1px solid #ccc;
        background-color: #f7f7f7;
       }
    </style>
        <h1> All the Polls that are Available</h1>
        
        <?php
        require("connection.php");
        $recordsPerPage = 10;
        $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $start = ($current_page - 1) * $recordsPerPage;
        $stmt = $db->prepare('SELECT question, poll_id FROM poll WHERE status = 0 ORDER BY poll_id LIMIT :start, :recordsPerPage');
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
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
        $stmt = $db->prepare('SELECT COUNT(*) as total FROM poll WHERE status = 0');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPages = ceil($result['total'] / $recordsPerPage);
        if ($totalPages > 1) {
            echo '<div class="pagination">';
            if ($current_page > 1) {
                echo '<a href="?page=' . ($current_page - 1) . '">Previous</a>';
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }

            if ($current_page < $totalPages) {
                echo '<a href="?page=' . ($current_page + 1) . '">Next</a>';
            }
            echo '</div>';
        }
    } else {
        echo '<p>No polls for now. : )</p>';
    }
    ?>


    </main>
<?php include("footer.php"); ?>