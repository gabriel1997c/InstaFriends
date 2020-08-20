<!DOCTYPE html>
<?php
include("header.php");

if(!isset($_SESSION['username'])){
	header("location: index.php");
}
?>
<html>
<head>
	<?php
		$user = $_SESSION['username'];
		$get_user = "select * from users where username='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$username = $row['username'];
	?>
	<title><?php echo "$username"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	<link rel="stylesheet" type="text/css" href="stylee.css">.
</head>
<style>

	#cover-img{
		height: 420px;
		width: 100%;
	}#profile-img{
		position: absolute;
		top: 160px;
		left: 40px;
	}
	#update_profile{
		position: relative;
		color:#ffffff;
		top: -33px;
		cursor: pointer;
		left: 180px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%, -50%);
	}
	#button_profile{
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}
	h2{
		color:#8a3ab9;
	}
	#own_posts{
		border: 5px solid #c9c7c7;
		padding: 40px 50px;
	}
	#post_img{
		height: 300px;
		width: 300px;
	}
</style>
<body>
	<div class="container">

		<div class="profile">

			<div class="profile-image">
				<?php
				echo"
				
				<img src='users/$user_image' alt='Profile'  width='155px' height='155px'>
				<form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
				<div id='profile-img'>
				<label id='update_profile'>Select Profile Picture
				<input type='file' name='u_image' size='50' />
				</label><br><br>
				<button id='button_profile' name='update' class='btn btn-info'>Update Profile Picture</button>
				</form>
			</div><br>
				";
				?>

			</div>

			<div class="profile-user-settings">
				<?php
				echo"
				<h1 class='profile-user-name'>$username</h1>
				";
				?>

				<button class="btn profile-follow-btn">Following</button>

				<button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

			</div>

			<div class="profile-stats">

				<ul>
					<?php
					global $con;


					if(isset($_GET['u_id'])){
						$u_id = $_GET['u_id'];
					}

					$getnumber = "select count(*) AS counter from posts where user_id = '$u_id'";

					$results = mysqli_query($con, $getnumber);
					$row = mysqli_fetch_array($results);
					$counter = $row['counter'];
					
					echo"
					<li><span class='profile-stat-count'>$counter</span> posts</li>
					"
					?>
					<li><span class="profile-stat-count">188</span> followers</li>
					<li><span class="profile-stat-count">206</span> following</li>
				</ul>

			</div>

			<div class="profile-bio">

				<p><span class="profile-real-name">Solid Snake</span> wow 📷✈️🏕️</p>

			</div>

		</div>
		<!-- End of profile section -->

	</div>
	
<div class="row">
	<div class="col-sm-1">	
	</div>
	<div class="col-sm-10">
		<?php
			echo"
			<div>
				<div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
				<form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>

				<ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
					<li class='dropdown'>
						<button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
						<div class='dropdown-menu'>
							<center>
							<p>Click <strong>Select Cover</strong> and then click the <br> <strong>Update Cover</strong></p>
							<label class='btn btn-info'> Select Cover
							<input type='file' name='u_cover' size='60' />
							</label><br><br>
							<button name='submit' class='btn btn-info'>Update Cover</button>
							</center>
						</div>
					</li>
				</ul>

				</form>
			</div>
			<div id='profile-img'>
				<img src='users/$user_image' alt='Profile' class='img-circle' width='210px' height='190px'>
				<form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>

				<label id='update_profile'>Select Profile Picture
				<input type='file' name='u_image' size='50' />
				</label><br><br>
				<button id='button_profile' name='update' class='btn btn-info'>Update Profile Picture</button>
				</form>
			</div><br>
			";
		?>
		<?php

			if(isset($_POST['submit'])){

				$u_cover = $_FILES['u_cover']['name'];
				$image_tmp = $_FILES['u_cover']['tmp_name'];
				$random_number = rand(1,100);

				if($u_cover==''){
					echo "<script>alert('Select Cover Image')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
					$update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>alert('Your Cover Image has been updated.')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					}
				}

			}

		?>
	</div>

	<!--display user's posts -->
	<div class="col-sm-6">
		<?php
		global $con;


			if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
			}

			$get_posts = "select * from posts where user_id = '$u_id' ORDER BY 5 DESC";

			$run_posts = mysqli_query($con, $get_posts);

			while($row_posts = mysqli_fetch_array($run_posts)){
				$post_id = $row_posts['post_id'];
				$user_id = $row_posts['user_id'];
				$content = $row_posts['post_content'];
				$upload_image = $row_posts['upload_image'];
				$post_date = $row_posts['post_date'];

				$user = "select * from users where user_id = '$user_id' AND posts = 'yes'";

				$run_user = mysqli_query($con, $user);
				$row_user = mysqli_fetch_array($run_user);
				$user_name = $row_user['username'];
				$user_image = $row_user['user_image'];


				//displaying photos

				if(strlen($upload_image) >= 1){
					echo"

					<div id='own_posts'>
						<div class='row'>
							<div class='col-sm-1'>
								<p><img src='users/$user_image' class='img-circle' width='100px'
										height='100px'></p>
							</div>
							<div class='col-sm-7 col-sm-offset-2'>
								<h3><a style='text-decoration: none; cursor:pointer; color: #3897f0;'
									href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong>
									</small></h4>
							</div>
							<div class='col-sm-2'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<img id='posts-img' src='imagepost/$upload_image'
									style='height:350px;'>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-success'>View</button></a>
						<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-danger'>Delete</button></a>
					</div><br><br>
					";
				}
			}
		?>
		
	</div>


	<?php
		if(isset($_POST['update'])){

				$u_image = $_FILES['u_image']['name'];
				$image_tmp = $_FILES['u_image']['tmp_name'];
				$random_number = rand(1,100);

				if($u_image==''){
					echo "<script>alert('Select a profile image.')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, "users/$u_image.$random_number");
					$update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";

					$run = mysqli_query($con, $update);

					if($run){
					echo "<script>alert('Your Profile Updated')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					}
				}

			}
	?>
	<div class="col-sm-1">
	</div>
</div>

</body>
</html>