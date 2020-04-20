<?php

include_once("./database/constants.php");
if(!isset($_SESSION["userid"])){
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asset Management System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
		<?php
		include_once("./templates/header.php");
		?>
		<br/><br/>
		<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card" style="width: 18rem;">
				  <div class="card-body">
				    <h5 class="card-title">Your Profile</h5>
				    <p class="card-text">Name: <?php echo $_SESSION["username"] ?></p>
				    <p class="card-text">Usertype: Admin</p>
				    <p class="card-text">Last Login: <?php echo $_SESSION["last_login"] ?></p>
				    <a href="#" class="btn btn-primary">Edit Profile</a>
				  </div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="jumbotron">
					<h1>Welecome Admin,</h1>
						<div class="card">
						  <div class="card-body">
						    <h5 class="card-title">Modify Quantity</h5>
						    <p class="card-text">You can increment or decrement product quantities here</p>
						    <a href="#" class="btn btn-success">Increase</a>
						    <a href="#" class="btn btn-danger">Decrease</a>
						  </div>
						</div>
				</div>
			</div>
		</div>	
		</div>
		<p></p>
		<p></p>
		<div class="container">
			<div class="row" style="padding-left: 20%">
				<div class="col-md-5">
					<div class="card">
					  <div class="card-body">
					    <h5 class="card-title">Categories</h5>
					    <p class="card-text">Here you can manage your categories and add new</p>
					    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#category">Add</a>
					    <a href="manage_categories.php" class="btn btn-primary">Manage</a>
					  </div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card">
					  <div class="card-body">
					    <h5 class="card-title">Products</h5>
					    <p class="card-text">Here you can manage your products and add new</p>
					    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#products">Add</a>
					    <a href="manage_product.php" class="btn btn-primary">Manage</a>
					  </div>
					</div>
				</div>
			</div>
		</div>

		<?php include_once("./templates/category.php"); ?>
		<?php include_once("./templates/products.php"); ?>
</body>
</html>
