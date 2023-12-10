<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<?php 
$pageTitle = "VoteUp";
include("header.php"); 
?>
    <main>
     
    </main>
<?php include("footer.php"); ?>