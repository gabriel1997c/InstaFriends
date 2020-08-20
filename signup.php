<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
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
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}
	.well{
		background-color: #187FAB;
	}
	#signup{
		width: 60%;
		border-radius: 30px;
		background-color:#8a3ab9;
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
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Make an InstaFriends account</strong></h3>
				<hr>
			</div>
			<div class="l-part">
				<form action="" method="post">

					<!--email -->
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="Email" name="email" required="required">
					</div><br>
					<!--username -->
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						<input type="text" class="form-control" placeholder="Username" name="username" required="required">
					</div><br>
					<!--password -->
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="pass1" type="password" class="form-control" placeholder="Password" name="pass1" required="required">
					</div><br>
					<!--confirm password -->
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="pass2" type="password" class="form-control" placeholder="Confirm Password" 
						name="pass2" required="required">
					</div><br>
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Login" 
					href="signin.php">Already have an account?</a><br><br>

					<center><button id="signup" class="btn btn-info btn-lg" name="register_user">Sign Up</button></center>
					<?php include("insert_user.php"); ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>