<?php 
            session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style/mainstyle.css">
</head>
<body>
    
<div class="container">
    <header>
        <a href="index.php"><img src="style/logo.png" alt="logo" width="400px" height="150px"></a>
    </header>
    <nav>
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']); 

        if (isset($_SESSION["user"])) {
            ?>
            <a <?php if ($currentPage == 'createpolls.php') echo 'class="active"'; ?> href='createpolls.php'>Create Poll</a>
            <a <?php if ($currentPage == 'mypolls.php') echo 'class="active"'; ?> href='mypolls.php'>My Polls</a>
            <a <?php if ($currentPage == 'openpolls.php') echo 'class="active"'; ?> href='openpolls.php'>Open Polls</a>
            <a <?php if ($currentPage == 'endedpolls.php') echo 'class="active"'; ?> href='endedpolls.php'>Ended Polls</a>
            <a <?php if ($currentPage == 'logout.php') echo 'class="active"'; ?> href='logout.php'>Logout</a>
            <?php
        } else {
            ?>
            <a <?php if ($currentPage == 'createpolls.php') echo 'class="active"'; ?> href='createpolls.php'>Create Poll</a>
            <a <?php if ($currentPage == 'mypolls.php') echo 'class="active"'; ?> href='mypolls.php'>My Polls</a>
            <a <?php if ($currentPage == 'openpolls.php') echo 'class="active"'; ?> href='openpolls.php'>Open Polls</a>
            <a <?php if ($currentPage == 'endedpolls.php') echo 'class="active"'; ?> href='endedpolls.php'>Ended Polls</a>
            <a <?php if ($currentPage == 'register.php') echo 'class="active"'; ?> href='register.php'>Signup</a>
            <a <?php if ($currentPage == 'login.php') echo 'class="active"'; ?> href='login.php'>Login</a>
            <?php
        }
        ?>
    </nav>