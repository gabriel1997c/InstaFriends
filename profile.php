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
		global $con;

			if(isset($_GET['u_id'])){
					$u_id = $_GET['u_id'];
			}

				$get_user = "select * from users where user_id='$u_id'";
				$run_user = mysqli_query($con,$get_user);
				$row = mysqli_fetch_array($run_user);
				$username = $row['username'];
				$bio = $row['bio'];
				$user_image = $row['user_image'];

	?>			
	<title><?php echo "$username"; ?></title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="stylee.css">
	<link rel="stylesheet" type="text/css" href="style/mystyle.css">

</head>
<style>
	input[type="file"]{
		display: none;
	}
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
		color: #e95950;
		top: 60px;
		cursor: pointer;
		left: 335px;
		border-radius: 4px;
		
		transform: translate(-50%, -50%);
	}
	#button_profile{
		position: relative;
		top: 75px;
		left: 335px;
		cursor: pointer;
		
		color:#e95950;
		transform: translate(-50%, -50%);
		background: none;
    	border: none;
	}
	h2{
		color:#8a3ab9;
	}
	#own_posts{
		border: 3px solid #F5F5F5;
		padding: 40px 40px;

	}
	
	#profile{
		background: linear-gradient(rgba(255,255,255,.4), rgba(255,255,255,.4)), url("default_cover.png") no-repeat;
    	background-size: 100%;
    	
	}
	#follow{
		background-color:#e95950;
		
	}
	
	
	
</style>
<body>
	<div class="container" id="container">

		<div class="profile" id="profile">

			<div class="profile-image">
				<?php
				global $con;


					if(isset($_GET['u_id'])){
						$u_id = $_GET['u_id'];
					}

					$get_user = "select * from users where user_id='$u_id'";
					$run_user = mysqli_query($con,$get_user);
					$row = mysqli_fetch_array($run_user);
					$username = $row['username'];
					$bio = $row['bio'];
					$user_image = $row['user_image'];
				echo"
				
				<img src='users/$user_image' alt='Profile'  width='155px' height='155px'>
				<form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
				<div id='profile-img'>
				<label id='update_profile'>Select Profile Picture
				<input type='file' name='u_image' size='50' />
				</label>
				<button id='button_profile' name='update' class='btn btn-info'><h4><strong>Update Profile Picture</strong></h4></button>
				</form>
				</div><br>
				";
				?>

			</div>


			<div class="profile-user-settings" id="follow-div">
				<?php
				global $con;


					if(isset($_GET['u_id'])){
						$u_id = $_GET['u_id'];
					}
				echo"
				<h1 class='profile-user-name' id='userdisplay'>$username</h1>
				";
				?>

				<button class="btn profile-follow-btn" id="follow">Following</button>
				

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

				<p><span class="profile-real-name"><?php
				echo"
				$bio
				";
				?>
				<br>

			</div>

		</div>
		<!-- End of profile section -->

	</div>
	<br>
<div class="row">
	

	<!--display user's posts -->
	<div class="col-sm-6 col-sm-offset-3">
		<?php
		global $con;


			if(isset($_GET['u_id'])){
				$u_id = $_GET['u_id'];
			}

			$get_posts = "select * from posts where user_id = '$u_id' ORDER BY 5 DESC";
			$get_posts = "SELECT p.post_id, p.user_id, p.post_content, p.upload_image, p.post_date
							FROM posts p LEFT JOIN likes L ON p.post_id = L.post_id 
							WHERE p.user_id = '$u_id' GROUP BY p.post_id ORDER BY COUNT(L.post_id) DESC, p.post_date DESC
						";

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
					$userna = $_SESSION['username'];
					$get_user = "select * from users where username='$userna'";
					$run_user = mysqli_query($con,$get_user);
					$row = mysqli_fetch_array($run_user);
					$user_idtest = $row['user_id'];
					$bio = $row['bio'];
					if($user_idtest == $u_id){
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
								<h4><small style='color:black;'>Uploaded a photo on <strong>$post_date</strong>
									</small></h4>
							</div>
							<div class='col-sm-2'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h4><p>$content</p></h4>
							</div>
						</div><br>
						<div class='row'>
							<div class='col-sm-12'>
								<img id='posts-img' src='imagepost/$upload_image'
									style='height:450px; width:550px'>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
						<a href='single.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-success' id='bview'>View</button></a>
						<a href='functions/delete_post.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-danger' id='bdelete'>Delete</button></a>
					</div><br><br>
					";

				} 

				else{
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
								<h4><small style='color:black;'>Uploaded a photo on <strong>$post_date</strong>
									</small></h4>
							</div>
							<div class='col-sm-2'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h4><p>$content</p></h4>
							</div>
						</div><br>
						<div class='row'>
							<div class='col-sm-12'>
								<img id='posts-img' src='imagepost/$upload_image'
									style='height:450px; width:550px'>
							</div>
						</div><br>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
						<a href='single.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-success' id='bview'>View</button></a>
					</div><br><br>
					";

				}


			}
				include("functions/delete_post.php");

			}
			?>
		
	</div>
	<div class='col-sm-2'>
		

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
					echo "<script>alert('Your profile picture has been updated.')</script>";
					echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
					}
				}

			}
	?>
	
</div>

</body>
</html>