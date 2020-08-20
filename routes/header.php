<?php
include("connection.php");
include("functions/functions.php");

?>
<style>


#allst{
	list-style-type: none;
  	margin: 0;
  	padding: 0;
  	overflow: hidden;
  	background-color: #22313f;
  	overflow: hidden;
  	height:50px;
  	position: sticky;
  	z-index: 9999;
  	top: 0;
}

.navbar-brand>img {
  height: 25px;
  padding: 0px;
  width: 25px;
}

#searchbt{
	position:relative;
	top:-39px;
	background-color: #22a7f0;
}
#searchbt:hover{
	background-color: #00b5cc;
}

#searchfield{
	position: relative;
	top:10px;
	left:-200px;
}

</style>
<nav class="navbar navbar-default" id="allst">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="home.php">InstaFriends</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	
	      	<?php 
				$user = $_SESSION['username'];
				$get_user = "select * from users where username='$user'"; 
				$run_user = mysqli_query($con,$get_user);
				$row=mysqli_fetch_array($run_user);
						
				$user_id = $row['user_id']; 
				$username = $row['username'];
				$password = $row['password'];
				$email = $row['email'];
				$user_image = $row['user_image'];		
						
				$user_posts = "select * from posts where user_id='$user_id'"; 
				$run_posts = mysqli_query($con,$user_posts); 
				$posts = mysqli_num_rows($run_posts);
		
			?>

			<li><a class="navbar-brand" href='profile.php?<?php echo "u_id=$user_id" ?>'>
				<?php echo"
				<img src='users/$user_image' alt='Profile'  width='25px' height='25px'>
				<form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
				<div id='profile-img'>" ?></a></li>
			
	        <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo "$username"; ?></a></li>
	       	<li><a href="home.php">Home</a></li>
			<li><a href="members.php">Find People</a></li>
			
					<?php
					echo"

								
								<li>
									<a href='logout.php'>Logout</a>
								</li>
							
						
						";
					?>
			</ul>
			
		</div>
	</div>
</nav>