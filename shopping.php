<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || !isset($_SESSION["username"]) || $_SESSION["loggedin"] !== true){
    header('location: http://localhost/AR/Login_mini.php');
    exit;
}
?>
<?php
// session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM models WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous">
</HEAD>
<BODY class="back">
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><i class="fas fa-stroopwafel"></i> Model3D</a>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Training_Programmes.php"><i class="fas fa-cube"></i> Models</a>
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
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="shopping.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th class="txt-head" style="text-align:left;">Name</th>
<th class="txt-head" style="text-align:left;">Code</th>
<th class="txt-head" style="text-align:right;" width="5%">Quantity</th>
<th class="txt-head" style="text-align:right;" width="10%">Unit Price</th>
<th class="txt-head" style="text-align:right;" width="10%">Price</th>
<th class="txt-head" style="text-align:center;" width="5%">Remove</th>
</tr>	

<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "Rs. ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "Rs. ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="shopping.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
				$code=$item["code"];	
				
		}
?>


<tr>
<td class="txt-head" colspan="2" align="right">Total:</td>
<td class="txt-head" align="right"><?php echo $total_quantity; ?></td>
<td class="txt-head" align="right" colspan="2"><strong><?php echo "Rs. ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>

<?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<button style="float:right; margin-top:10px" type="submit" class="btn btn-success btn-lg">Purchase</button>		
</form>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" ){
		$username=$_SESSION["username"];
		$db = mysqli_connect('localhost','root','','ar') or 
		die('Error connecting to MySQL server.');
		$order = "INSERT INTO purchases
					(username,code)
					VALUES
					('$username','$code')";

		$result = mysqli_query($db,$order);	//order executes
		
		// $sql = "SELECT email FROM signin WHERE username = '" . $_SESSION['username'] . "'";
		// $result = mysqli_query($db,$sql);
		// $row = $result->fetch_assoc();

		// // the message
		// $msg = "Purchase successful\nAdded to your purchases";

		// // use wordwrap() if lines are longer than 70 characters
		// $msg = wordwrap($msg,70);
		
		// // send email
		// mail($row['email'],"Nutrifit",$msg);
		mysqli_close($db);
	
		}
	
?>

	

<br>
<br>
<br>
<div id="product-grid">
	<div class="txt-heading">Models</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM models ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item mb-5">
			<form method="post" action="shopping.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "Rs.".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /> <input type="submit" value="Add to Cart" class="btnAddAction" /> </div>
			</div>
			</form>
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
</BODY>
</HTML>