<?php 
	include("dbcon.php");
	session_start();
  if(isset($_SESSION['id'])) echo"User Dashboard is Under Construction<br>";
  else header("location: sign-in.php");
?>