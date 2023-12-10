<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/regStyle.css">
    <title>Login</title>
    
</head>
<body>

    <div class="container">
        <h1>Login</h1>
        <h4>You dont Have an account? <a href="register.php">SIGNUP</a></h4>

        <form action="#" method="post">
            <input name="email" type="email" placeholder="Email" required><br>
            <input name="password" type="password" placeholder="Password" required><br>
            <input name="login" type="submit" value="Login">
        </form>
    </div>
    <div class="new">
<?php
require("connection.php");
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user"] = "yes";

            header("location:index.php");
        } else {
            echo "<h3>Password does not match</h3>";
        }
    } else {
        echo "<h3>Email does not exist</h3>";
    }
}
?>


    </div>

</body>
</html>


<?php 
$stmt = $db->prepare('SELECT fname, lname,id FROM users WHERE email = :email');
$stmt->bindParam(':email', $email);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($userData) {
    $_SESSION['fname'] = $userData['fname'];
    $_SESSION['lname'] = $userData['lname'];
    $_SESSION['id'] = $userData['id'];
} else {
    // Handle the case where no user with the specified email is found
    // You may want to set default values or display an error message
}
?>
