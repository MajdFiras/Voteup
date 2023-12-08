

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
        <h1>SIGNUP</h1>
        <h4>You Already Have an account? <a href="login.php">login</a></h4>

        <form action="#" method="post">
        <input type="text" name="fname" placeholder="First Name" required>    
        <input type="text" name="lname" placeholder="Last Name" required>    
        
        <input name="email" type="email" placeholder="Email" required><br>
        <input name="password" type="password" placeholder="Password" required><br>
        <input name="signup" type="submit" value="Signup">
        </form>
    </div>
    <div class="new">
    <?php
require("connection.php");
$namesRegex = '/[^a-zA-Z]/';
$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
$error_msg = "The password should contain:\\n • minimum 8 characters in length\\n• At least one uppercase English letter\\n • At least one lowercase English letter\\n • At least one digit \\n • At least one special character";
 if(isset($_POST["signup"])) {

    $fname = $_POST["fname"];
    $fname = $fname.trim(" ");
    $lname = $_POST["lname"];
    $lname = $lname.trim(" ");
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    

    
    if($stmt->rowCount() > 0){
        echo "<h3> Email is already Exists</h3>";
    }
    elseif(preg_match($namesRegex,$fname)){
      echo " <h3> First name contains non-letters <h3>";
       
    }
    elseif(preg_match($namesRegex,$lname)){
        echo " <h3> Last name contains non-letters <h3>";
    }

    elseif(!preg_match($password_regex,$password)) {
        echo "<script> alert('The password should contain:\\n • minimum 8 characters in length\\n • At least one uppercase English letter\\n • At least one lowercase English letter\\n • At least one digit \\n • At least one special character') </script>";
    }
    else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (fname, lname, email, password) VALUES (:fname, :lname, :email, :password)");
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();   

        $db = null;
        echo " <h3> Your Registeration was successful <h3>";
    }
 }
?>
    </div>

</body>
</html>