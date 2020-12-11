<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || !isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true){
  header('location: http://localhost/AR/Login_mini.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Training_Programmes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous">
    <title>Models</title>
  </head>
  <body class='back'>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><i class="fas fa-stroopwafel"></i> Model3D</a>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
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
<!-- Not able to position text -->
    
    <div class="infon">
              <img src="https://images.unsplash.com/photo-1520468164108-7f393c152c59?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" alt="">
              <h2 style="color: burlywood;font: 40px Mission Gothic">EVERYTHING YOU<br>NEED IN ONE SPOT</h2>
              <p style="color: burlywood; font: 20px EB Garamond, serif;">Get Ready to use models.<br>Directly into your project.</h2>
          </div>
      </div>


<div class="parent">

<?php
$db = mysqli_connect('localhost','root','','ar') or 
  die('Error connecting to MySQL server.');  
  
  $sql = "SELECT * FROM models";
  $result = mysqli_query($db,$sql);
  
  if ($result->num_rows > 0) {
    while($model = $result->fetch_assoc()) {

?>
    <div class="container">
        <img src="<?php echo $model["image"]; ?>" alt="Avatar" class="image">
        <div class="overlay">
          <div class="text">
              <a href="models/<?php echo $model["name"]; ?>.html"><button type="button" class="btn btn-dark btn-sm"><?php echo $model["name"]; ?></button></a>
                </div>
        </div>
    </div>
    
    <?php
    }
  }
    ?>


  </div>
            
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
