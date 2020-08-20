<!DOCTYPE html>
<html>
<head>
	<title>Instagram</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
	body{
		overflow-x: hidden;
	}
	#signup{
		width: 60%;
		border-radius: 30px;
		background-color: #8a3ab9;
	}
	#login{
		width: 60%;
		background-color: #e95950;
		border: 1px solid #1da1f2;
		border-radius: 30px;
	}
	#login:hover{
		width: 60%;
		background-color: #fff;
		color: #1da1f2;
		border: 2px solid #1da1f2;
		border-radius: 30px;
	}
	.well{
		background-color: #187FAB;
	}

</style>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;">InstaFriends</h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5" style="left:1%;">
			<img src="images/friends.jpg" class="img-rounded" title="InstaFriends" width="620px" height="575px">
		</div>
		<div class="col-sm-2">
		</div>
		<div class="col-sm-4" style="left:50%:">
			<img src="images/logo.png" class="img-rounded" title="InstaFriends" width="85px" height="85px">
			<h2><strong>Connect with friends and the<br>world around you on InstaFriends.</strong></h2><br><br>
			<h4><strong>Join InstaFriends now.</strong></h4>
			<form method="post" action="">
				<button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br><br>
				<?php
					if(isset($_POST['signup'])){
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
				<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>
				<?php
					if(isset($_POST['login'])){
						echo "<script>window.open('signin.php','_self')</script>";
					}
				?>
			</form>
		</div>
	</div>
</body>
</html>