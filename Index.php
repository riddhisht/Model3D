<?php
    // Include config file
    require_once "config.php";

    $fname=$lname=$age=$gender=$email=$password=$username=$city=$country=$zipcode="";
    $fnameErr=$lnameErr=$ageErr=$genderErr=$emailErr=$usernameErr=$passwordErr=$confirmpasswordErr=$cityErr=$countryErr=$zipcodeErr="";


    //Input fields validation  
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {  
            //Fist Name Validation  
            if (empty($_POST["fname"])) 
                {  
                    $fnameErr = "Name is required";  
                } else 
                {  
                    $fname = input_data($_POST["fname"]);  
                // check if name only contains letters and whitespace  
                if (!preg_match("/^[a-zA-Z ]*$/",$fname)) 
                {  
                    $fnameErr = "Only alphabets and white space are allowed";  
                }  
        }  
        
        // Last Name Validation
        if (empty($_POST["lname"])) 
        {  
            $lnameErr = "Name is required";  
        } else 
        {  
            $lname = input_data($_POST["lname"]);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$lname)) 
            {  
                $lnameErr = "Only alphabets and white space are allowed";  
            }  
        }
        
        //Number Validation  
        if (empty($_POST["age"])) 
        {  
            $ageErr = "Age is required";  
        } else 
        {  
            $age = input_data($_POST["age"]);    
            if (!preg_match ("/^[0-9]*$/", $age) ) 
            {  
                $ageErr = "Only numeric value is allowed.";  
            }  
            
        }  

        //Empty Field Validation  
        if (empty ($_POST["gender"])) {  
            $genderErr = "Gender is required";  
        } else {  
            $gender = input_data($_POST["gender"]);  
        }
        
        //Email Validation   
        if (empty($_POST["email"])) {  
            $emailErr = "Email is required";  
        } else {  
            $email = input_data($_POST["email"]);  
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                $emailErr = "Invalid email format";  
            }  
        }  
    
        //Username Validation  
        if (empty($_POST["username"])) {
            $usernmameErr = "Username is required";
        } else {
            $username = input_data($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
                $usernameErr = "Only alphanumeric characters and underscore allowed";
            }
        }
        
        //Password Validation      
        if (empty($_POST["password"])) {  
            $password = "Password cannot be empty";  
        } else {  
                $password = input_data($_POST["password"]);  
                 
                if (!preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/",$password)) {  
                    $passwordErr = "Invalid password";  
                }      
        }  
    
        // Confirm Password
        if(empty(trim($_POST["confirmpassword"]))){
            $confirmpassworderr = "Please confirm password.";     
        } else{
            $confirmpassword = trim($_POST["confirmpassword"]);
            if(empty($passworderr) && ($password != $confirmpassword)){
                $confirmpassworderr = "Password did not match.";
            }
        }

        //City Validation  
        if (empty($_POST["city"])) 
        {  
            $cityErr = "City is required";  
        } else 
        {  
            $city = input_data($_POST["city"]);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$city)) 
            {  
                $cityErr = "Only alphabets and white space are allowed";  
            }  
        }
        
        //Country Validation  
        if (empty($_POST["country"])) 
        {  
            $countryErr = "Country is required";  
        } else 
        {  
            $country = input_data($_POST["country"]);  
            // check if name only contains letters and whitespace  
            if (!preg_match("/^[a-zA-Z ]*$/",$country)) 
            {  
                $countryErr = "Only alphabets and white space are allowed";  
            }  
        }

        // Zip code validation
        if (is_numeric($_POST["zipcode"])) {
            if(strlen((string)$zipcode <= 6)){
                $zipcode = input_data($_POST["zipcode"]);
            }
        } else {
            $zipcodeErr = "*Zipcode Invalid";
        }

    }
    


    function input_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>


<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Create Account</title>
  </head>
  <body class="back">

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><i class="fas fa-stroopwafel"></i> Model3D </a>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Login_mini.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Training_Programmes.php"><i class="fas fa-cube"></i> Models</a>
                </li>
            </ul>
    </nav>

    <div class="jumbotron">
        <br><br><br><br>
        <div>
            <h1 class="display-4" >WELCOME TO Model3D!</h1>
            <p class="lead">Start with a 7-day free trial, cancel any time</p>
            <hr class="my-4">
            <p>-Hundreds of 3D models</p>
            <p>-Access to blender files.</p>
        </div>
    </div>
    
    

    <div class="form"> 
        <h2 class="display-4" style="color: burlywood;">Personal Info</h2>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-row">
                <div class="col">
                <input type="text" class="form-control" placeholder="First name" name="fname" required>
                <span class="error"><?php echo $fnameErr;?></span>
                
                    </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Last name" name="lname" required>
                <span class="error"><?php echo $lnameErr;?></span>
                </div>
            </div>
            <br>

            <div class="form-group">
                <label for="exampleInputEmail1">Age</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="age" required>
                <span class="error"><?php echo $ageErr;?></span>
            </div>
            <br>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0" style="color: burlywood;">Gender</legend>
                    <div class="col-sm-10">
                        <input type="radio" name="gender" value="male"> <label>Male</label>  
                        <input type="radio" name="gender" value="female"> <label>Female</label>  
                        <input type="radio" name="gender" value="other"><label>Other</label>  
                        <span class="error"><?php echo $genderErr; ?> </span>
                    </div>
                </div>  
            </fieldset>

            <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="-username@gmail.com" name="email" required>
            <small id="emailHelp" class="form-text text-muted">*We'll never share your email with anyone else.</small>
            <span class="error"><?php echo $emailErr;?></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="-user1234" name="username" required>
                <small id="emailHelp" class="form-text text-muted">*Username should be unique.</small>
                <span class="error"><?php echo $usernameErr;?></span>
            </div>

            <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            <small id="emailHelp" class="form-text text-muted">*Atleast 8-10 characters including 1 uppercase,1 special character and 1 number.</small>
            <span class="error"><?php echo $passwordErr;?></span>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Re-Enter Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="confirmpassword" required>
                <small id="emailHelp" class="form-text text-muted">*Should match the above entered password.</small>
                <span class="error"><?php echo $confirmpasswordErr;?></span>
            </div>
            <p class="lead" style="color: burlywood;">Location</p>
            <div class="form-row">
                <div class="col-7">
                <input type="text" class="form-control" placeholder="City" name="city">
                <span class="error"><?php echo $cityErr;?></span>
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Country" name="country">
                <span class="error"><?php echo $countryErr;?></span>
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Zip" name="zipcode">
                <span class="error"><?php echo $zipcodeErr;?></span>
                </div>
            </div>

            <br>
            <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
            <label class="form-check-label" for="exampleCheck1">I Agree to the terms and conditions</label>
            </div>

            <div class="but">
            <button type="submit" class="btn btn-dark btn-lg">CREATE MY ACCOUNT</button>
            </div>
            
        </form>
    </div>

    <?php
        #Store to database
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $fnameErr=='' && $lnameErr=='' && $ageErr=='' && $emailErr=='' && $passwordErr=='' && $usernameErr=='' && $confirmpasswordErr=='' && $cityErr=='' && $countryErr=='' && $zipcodeErr==""){
            $fname=$_POST["fname"];
            $lname=$_POST["lname"];
            $email=$_POST["email"];
            $username=$_POST["username"];
            $password=$_POST["password"];
            $age=$_POST["age"];
            $gender=$_POST["gender"];
            $city=$_POST["city"];
            $country=$_POST["country"];
            $zipcode=$_POST["zipcode"];

            // $hash_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $db = mysqli_connect('localhost','root','','ar') or 
                die('Error connecting to MySQL server.');

            $order = "INSERT INTO signin
                        (fname,lname,age,gender,email,username,password,city,country,zipcode)
                        VALUES
                        ('$fname','$lname','$age','$gender','$email','$username','$password','$city','$country','$zipcode')";

            $result = mysqli_query($db,$order);	//order executes

            header("location: http://localhost/AR/Login_mini.php");

            mysqli_close($db);
        }
        else{
            alert("Invalid form data!");
        }
    ?>   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>


