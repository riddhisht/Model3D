<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
</head>
<body>
    
    <?php
        $email=$_POST["email"];
        $password=$_POST["password"];
        $username=$_POST["username"];

        $message="";
        if(count($_POST)>0) {
            $conn = $db = mysqli_connect('localhost','root','','ar') or die('Error connecting to MySQL server.');
            $result = mysqli_query($conn,"SELECT * FROM signin WHERE username='" .$_POST["username"] . "' and email='" . $_POST["email"] . "' and password = '". $_POST["password"]."'");
            $count  = mysqli_num_rows($result);
            if($count==0) {
                $message = "Invalid Credentials!";
                header('location: http://localhost/AR/Login_mini.php');
            } else {
                $message = "You are successfully authenticated!";
                // Password is correct, so start a new session
                session_start();
                        
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;   
                $_SESSION["username"] = $username; 
                header('location: http://localhost/AR/Training_Programmes.php');
            }
        }
    ?>


</body>
</html>
