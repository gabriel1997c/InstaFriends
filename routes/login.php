<?php
session_start();

	// variable declaration
	$errors = array(); 
	$_SESSION['success'] = "";

include("connection.php");

	if (isset($_POST['loginb'])) {

		$usern = htmlentities(mysqli_real_escape_string($con, $_POST['username']));
		$passw = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));
		$passwo = md5($passw);
			

		$select_user = "select * from users where username='$usern' AND password='$passwo'";
		$query= mysqli_query($con, $select_user);
		$check_user = mysqli_num_rows($query);

		if($check_user == 1){
			$_SESSION['username'] = $usern;
			echo"<script>alert('Logged in succesfully.')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			echo"<script>alert('Your Email or Password is incorrect.')</script>";
		}	
	
	}
?>