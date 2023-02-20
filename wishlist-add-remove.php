<?php
	include("dbcon.php");
	if(isset($_POST['id']) && $_POST['id']!=""){
		$productId = $_POST['id'];
		$productQ = mysqli_query($db, "SELECT id FROM products WHERE id='$productId' ");
		if(mysqli_num_rows($productQ)>0){
			$preDataArr = array();
			if(isset($_COOKIE['wishlist'])){
				$preData = stripcslashes($_COOKIE['wishlist']);
				$preDataArr = json_decode($preData, true);
			}
			if(isset($_POST['add']) && $_POST['add']=="yes"){
				if(!isset($preDataArr[$productId])) $preDataArr[$productId] = 1;
			}
			if(isset($_POST['remove']) && $_POST['remove']=="yes"){
				if(isset($preDataArr[$productId])) unset($preDataArr[$productId]);
			}
			$newData = json_encode($preDataArr);
			if(setcookie("wishlist", $newData, time()+(86400*30*6))) echo"ok";
			else echo"not";
		}
		else echo"noproduct";
	}
	else echo"noid";
?>