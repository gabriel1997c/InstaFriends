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
	<title>Viewing single post</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/mystyle.css">
</head>
<body>
	<div class="row">
		<div class="col-sm-12">
			<center><h2>Single post</h2><br></center>
			<?php single_post(); ?>
			
		</div>

	</div>
</body>
</html>