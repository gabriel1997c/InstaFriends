<?php
	$get_postid = $_GET['post_id'];

	$get_likes = "select count(*) as number_of_likes from likes  where post_id = '$get_postid'";

	$run_likes = mysqli_query($con, $get_likes);
	$row = mysqli_fetch_array($run_likes);

	$likesno = $row['number_of_likes'];


		
?>