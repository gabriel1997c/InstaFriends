<?php
include("connection.php");
$errors = array();
	if(isset($_POST['register_user'])){

		
		$username = htmlentities(mysqli_real_escape_string($con,$_POST['username']));
		$pass1 = htmlentities(mysqli_real_escape_string($con,$_POST['pass1']));
		$pass2 = htmlentities(mysqli_real_escape_string($con,$_POST['pass2']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
		$check_username_query = "select username from users where email='$email'";
		$run_username = mysqli_query($con,$check_username_query);
		$check_email = "select * from users where email='$email'";
		$run_email = mysqli_query($con,$check_email);
		$check = mysqli_num_rows($run_email);
		$check_user = "select * from users where username='$username'";
		$run_user= mysqli_query($con,$check_user);
		$check2 = mysqli_num_rows($run_user);


		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($pass1)) { array_push($errors, "Password is required"); }
	

		if ($pass1 != $pass2) {
			echo "<script>alert('Passwords do not match.')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		if($check >= 1){
			echo "<script>alert('This email is already assigned to an account. Please use another email.')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		if($check2 >= 1){
			echo "<script>alert('This username is already taken. Please pick another username.')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}


		if (count($errors) == 0) {
			$passw = md5($pass1);//encrypt the password before saving in the database
			$insert = "insert into users (email,username,password,user_image)
					values('$email','$username','$passw','default_profile.png')";
		
			$query = mysqli_query($con, $insert);
			if($query){
			echo "<script>alert('Your account has been created.')</script>";
			$_SESSION['success'] = "Your account has been created.";
			echo "<script>window.open('signin.php', '_self')</script>";
		}
		else{
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
		}

	}
?>