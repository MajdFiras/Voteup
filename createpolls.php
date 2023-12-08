<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<?php include("header.php"); ?>
    <main>
        <h1 style="margin: auto;text-align:center; margin-top:-100px"> Create Polls</h1>
    </main>
<?php include("footer.php"); ?>