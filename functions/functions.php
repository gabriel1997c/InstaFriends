<?php

$con = mysqli_connect("localhost","root","","instagram") or die("Connection could not be made.");

//function for inserting post

function insertPost(){
	if(isset($_POST['gg'])){
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

				if($upload_image=='' || $content==''){
					echo "<script>alert('You need to input both a caption and an image.')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id',
						'$content','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
						
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);

						exit();
					}
				}
		
	}
}

function get_posts(){
	global $con;
	$per_page = 6;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,40);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['username'];
		$user_image = $row_user['user_image'];

		//now displaying posts from database

		

		if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; padding-left: 10px; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black; padding-left: 10px;'>Uploaded an image on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:450px; width:550px'>
						</div>
					</div><br>
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a>
					<a href='single.php?post_id=$post_id' style='float:right;'>
						<button class='btn btn-success'>View</button></a>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

		
	}

	include("pagination.php");
}


function single_post(){
	if(isset($_GET['post_id'])){
		
		global $con;
		include ("likes.php");
		$get_id = $_GET['post_id'];
		$get_posts = "select * from posts where post_id = '$get_id'";
		$run_posts = mysqli_query($con, $get_posts);
		$row_posts = mysqli_fetch_array($run_posts);
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];


		$user = "select * from users where user_id = '$user_id' AND posts = 'yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['username'];
		$user_image = $row_user['user_image'];

		$user_com = $_SESSION ['username'];
		$get_com = "select * from users where username = '$user_com'";

		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['username'];


		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
		}

		$get_posts = "select post_id from users where post_id = '$post_id' ";
		$run_user = mysqli_query($con, $get_posts);

		$post_id = $_GET ['post_id'];

		$post = $_GET ['post_id'];

		$get_user = "select * from posts where post_id = '$post'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$p_id = $row['post_id'];

	/*	if($p_id != $post_id){
			echo "<script>alert('error')</script>";
			echo"<script>window.open('home.php', '_self')</script>";

		}

		else{*/
			if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
					<div class='row'>
						<div class='col-sm-2'>
						<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
						</div>
						<div class='col-sm-6'>
							<h3><a style='text-decoration:none; padding-left: 10px; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
							<h4><small style='color:black; padding-left: 10px;'>Uploaded an image on <strong>$post_date</strong></small></h4>
						</div>
						<div class='col-sm-4'>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-12'>
							<br>
							<p>$content</p>
							<img id='posts-img' src='imagepost/$upload_image' style='height:450px; width:550px'>
							<br><br>
							<form action='single.php?post_id=<$post_id' method='POST'
							id = 'f' enctype = 'multipart/form-data'>
							
							</form>
							<form action='single.php?post_id=$post_id' method='POST'
							id = 'f' enctype = 'multipart/form-data'>
							<button class='btn btn-info pull-right' name='daulike'>LIKE</button>
							</form>
							<p class='text-primary'
								style='padding-left:10px; float:left;'><strong>$likesno like(s).</strong></p>
						</div>
					</div><br>
					
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
		
		$logged_user = $_SESSION ['username'];
		$get_logged = "select * from users where username = '$logged_user'";

		$run_logged = mysqli_query($con, $get_logged);
		$row_logged = mysqli_fetch_array($run_logged);

		$logged_id = $row_logged['user_id'];
		$testlike = "select * from likes 
						where user_id = '$logged_id' AND
						post_id = '$post_id'";
		$run_testlike = mysqli_query($con,$testlike);
		$checked = mysqli_num_rows($run_testlike);
		if($checked >= 1){
			if(isset($_POST['daulike'])){

			
				$unlikepost = "delete from likes where user_id = '$logged_id'
												and post_id = '$post_id'";

				$run = mysqli_query($con, $unlikepost);

				echo "<script>alert('You unliked this post.')</script>";
				echo "<script> window.open('single.php?post_id=$post_id', '_self')</script>";
			
			}
		}

		else{
		if(isset($_POST['daulike'])){

			
				$likepost = "insert into likes (user_id, post_id)
				values('$logged_id', '$post_id')";

				$run = mysqli_query($con, $likepost);

				echo "<script>alert('You liked this post.')</script>";
				echo "<script> window.open('single.php?post_id=$post_id', '_self')</script>";
			
			}

		}
	

		include ("comments.php");


		echo "
		<div class='row'>
			<div class='col-md-6 col-md-offset-3'>
				<div class='panel panel-info'>
					<div class='panel-body'>
						<form action='' method='post' class='form-inline'>
						</form>
						<form action='' method='post' class='form-inline'>
						<textarea placeholder='Type here.' class='pb-cmnt-textarea'
						name='comment2' id='comarea'></textarea>
						<button class='btn btn-info pull-right' name='co'>Comment</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		";

		if(isset($_POST['co'])){
			$comment = htmlentities($_POST['comment2']);
			if($comment == ""){
				echo "<script>alert('Comment field is empty.')</script>";
				echo "<script> window.open('single.php?post_id=$post_id', '_self')</script>";

			}
			else{
				$insert = "insert into comments (post_id, user_id, comment, comment_author, date)
				values('$post_id', '$user_id', '$comment', '$user_com_name', NOW())";

				$run = mysqli_query($con, $insert);

				echo "<script>alert('Your comment has been submitted.')</script>";
				echo "<script> window.open('single.php?post_id=$post_id', '_self')</script>";
			}
		}
	}
}


function search_user(){
	global $con;

	if(isset($_GET['search_user'])){
		$search_query = htmlentities($_GET['search_user']);
		$get_user = "SELECT * FROM users where username like '%$search_query%'";
	}
	else{
		$get_user = "SELECT * FROM users";
	}

	$run_user = mysqli_query($con, $get_user);

	while($row_user = mysqli_fetch_array($run_user)){
		$user_id = $row_user['user_id'];
		$username = $row_user['username'];
		$user_image = $row_user['user_image'];

		echo"
		<div class='row'>
			
			<div class='col-sm-6 col-sm-offset-4'>
				<div class='row' id='find_people'>
					<div class='col-sm-4'>
						<a href='user_profile.php?u_id=$user_id'>
						<img src='users/$user_image' width='150px' height='150px' title='$username'
						style='float:left; margin:1px;'/>
						</a>
					</div><br><br>
					<div class='col-sm-6'>
						<a style='text-decoration:none;cursor:pointer;color:#3897f0' 
						href='profile.php?u_id=$user_id'>
						<strong><h2>$username</h2></strong>
						</a>
					</div>
					<div class='col-sm-3'>
					</div>
				</div>
			</div>
		</div>
		";
	}
}





?>