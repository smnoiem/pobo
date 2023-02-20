<?php
	include("dbcon.php");
	if(isset($_POST['postId']) && isset($_POST['userId'])) {
		$postId = $_POST['postId'];
	  $userId = $_POST['userId'];
	  $name = mysqli_real_escape_string($db, $_POST['name']);
	  $title = mysqli_real_escape_string($db, $_POST['title']);
	  $email = mysqli_real_escape_string($db, $_POST['email']);
	  $description = mysqli_real_escape_string($db, $_POST['description']);
	  $qstr="
	  	INSERT INTO blogcomments
	  	(postid, userid, guestname, guestemail, title, comment)
	  	VALUES
	  	('$postId', '$userId', '$name', '$email', '$title', '$description')
	  ";
	  if(mysqli_query($db, $qstr)) echo "ok";
		else echo "not";
	}
	else echo"nopostuserid";
?>