<!DOCTYPE html>
<?php
session_start();
include("header.php");

if(!isset($_SESSION['username'])){
	header("location: index.php");
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['username'];
		$get_user = "select * from users where email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$username = $row['username'];
	?>
	<title>Instafriends</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/mystyle.css">
</head>
<body>
<div class="row">
	<div id="insert_post" class="col-sm-2 col-sm-offset-2">
		
		


		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
		
		<input type="file" name="upload_image" size="30">
	
		</form>

		
	</div>
	<div id="insert_post" class="col-sm-4">
		<center>
		<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="fg" enctype="multipart/form-data">
		<textarea class="form-control" id="content" rows="4" name="content" 
		placeholder="What's on your mind?"></textarea><br>
		<label class="btn btn-warning" id="upload_image_button">Select Image
		<input type="file" name="upload_image" size="30">
		</label>
		<button id="btn-post" class="btn btn-success" name="gg">Post</button>
		</form>
		<center>
	</div>	
	<?php 

		insertPost(); ?>
</div>
<div class="row">
	<div class="col-sm-12">
		<center><h2><strong>News Feed</strong></h2><br></center>
		<?php echo get_posts(); ?>
	</div>
</div>
</body>
</html>