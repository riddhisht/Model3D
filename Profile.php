<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header('location: http://localhost/AR/Login_mini.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous">
  
</head>
<body class="back" style="color:Burlywood;">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><i class="fas fa-stroopwafel"></i> Model3D</a>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="Training_Programmes.php"><i class="fas fa-cube"></i> Models</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shopping.php"><i class="fas fa-shopping-cart"></i> Purchase</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username']; ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="Profile.php"><i class="fas fa-user"></i> Profile</a>
                    <a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i> Logout</a>
                    
                  </div>
                </li>
            </ul>
    </nav>

    <?php
        $db = mysqli_connect('localhost','root','','ar') or 
            die('Error connecting to MySQL server.');        
        $sql = "SELECT * FROM signin WHERE username = '" . $_SESSION['username'] . "'";
        $result = mysqli_query($db,$sql);
    
        if (mysqli_num_rows($result) > 0) {
            $i=0;
            while($row = mysqli_fetch_array($result)) {
    ?>
    <div style="color:burlywood;"class="container1" id="form" style="width:90%">
    
    <!-- <h1 style="margin-bottom:40px;">Personal Details</h1>
    
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label>First Name</label>
              <input type="text" class="form-control" value="<?php echo $row["fname"]; ?>">
              
            </div>
            <div class="form-group col-md-6">
              <label>Last Name</label>
              <input type="text" class="form-control" value="<?php echo $row["lname"]; ?>">
              
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Email ID</label>
              <input type="text" class="form-control" value="<?php echo $row["email"]; ?>">
              
            </div>
            <div class="form-group col-md-6">
              <label>Username</label>
              <input type="text" class="form-control" value="<?php echo $row["username"]; ?>">
              
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
              <label>Age</label>
              <input type="text" class="form-control" value="<?php echo $row["age"]; ?>">
              
            </div>
            <div class="form-group col-md-6">
              <label>Gender</label>
              <input type="text" class="form-control" value="<?php echo $row["gender"]; ?>">
              
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
              <label>City</label>
              <input type="text" class="form-control" value="<?php echo $row["city"]; ?>">
              
            </div>
            <div class="form-group col-md-4">
              <label>Country</label>
              <input type="text" class="form-control" value="<?php echo $row["country"]; ?>">
              
            </div>
            <div class="form-group col-md-4">
              <label>Zipcode</label>
              <input type="text" class="form-control" value="<?php echo $row["zipcode"]; ?>">
              
            </div>

        </div>
            
        </form>
    </div>
    <?php
        $i++;
        }
        ?>
        </table>
        <?php
        }
        else{
            echo "No result found";
        }
    ?> -->


	<h1>My Purchases</h1>


<?php

  $db = mysqli_connect('localhost','root','','ar') or 
  die('Error connecting to MySQL server.');  
  
  $sql = "SELECT Distinct username,code FROM purchases WHERE username = '" . $_SESSION['username'] . "'";

  $result = mysqli_query($db,$sql);
  
  if ($result->num_rows > 0) {
    while($code = $result->fetch_assoc()) {
      $order = "SELECT * FROM models WHERE code = '" . $code['code'] . "'";
        $product = mysqli_query($db,$order);
          $array = $product->fetch_assoc();
        ?>
      <div class="container">
        <img src="<?php echo $array["image"]; ?>" alt="Avatar" class="image">
        <div class="overlay">
              <a href="<?php echo $array["drive"]; ?>"><button type="button" class="btn btn-dark btn-sm"><?php echo $array["name"]; ?></button></a>
        </div>
    </div>
  
    <?php
    }
  }
  else{
    ?>  
  
  <h2>No Purchases Yet!</h2>
  
  <?php
}
?> 

  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</body>
</html>