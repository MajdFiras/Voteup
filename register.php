<?php
session_start();
require("connection.php");

$namesRegex = '/[^a-zA-Z]/';
$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
$error_msg = "The password should contain:\\n • minimum 8 characters in length\\n• At least one uppercase English letter\\n • At least one lowercase English letter\\n • At least one digit \\n • At least one special character";

$fname = isset($_POST["fname"]) ? $_POST["fname"] : '';
$lname = isset($_POST["lname"]) ? $_POST["lname"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';

if (isset($_POST["signup"])) {
    $fname = $_POST["fname"];
    $fname = trim($fname);
    $lname = $_POST["lname"];
    $lname = trim($lname);
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($fname) || empty($lname) || empty($password)) {
        echo "<h3> All fields are required </h3>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h3> Invalid email format </h3>";
    } elseif (preg_match($namesRegex, $fname)) {
        echo " <h3> First name contains non-letters <h3>";
    } elseif (preg_match($namesRegex, $lname)) {
        echo " <h3> Last name contains non-letters <h3>";
    } elseif (!preg_match($password_regex, $password)) {
        echo "<script> alert('$error_msg') </script>";
    } else {
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h3> Email is already Exists</h3>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (fname, lname, email, password) VALUES (:fname, :lname, :email, :password)");
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            $db = null;
            echo " <h3> Your Registration was successful <h3>";
        }
    }
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
        <hr>

    <h4>You Already Have an account? <a href="login.php">login</a></h4>

    <form action="#" method="post">
        <input type="text" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars($fname); ?>" required>
        <input type="text" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars($lname); ?>" required>
        <div id="emailAvailability"></div>
        <input name="email" type="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required onkeyup="checkEmailAvailability();">
        <input name="password" type="password" placeholder="Password" required><br>
        <input name="signup" type="submit" value="Signup">
    </form>
</div>
<div class="new"></div>

</body>
</html>


<script>
    // Function to check email availability
    function checkEmailAvailability() {
        var email = document.getElementById('email').value;

        // Send an AJAX request to check email availability
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('emailAvailability').innerHTML = xhr.responseText;
            }
        };
        xhr.open('POST', 'check_email_availability.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('email=' + email);
    }
</script>
