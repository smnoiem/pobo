<?php
	include("dbcon.php");
	if(isset($_GET['id']) && $_GET['id']!=""){
		$productId = $_GET['id'];
		$productQ = mysqli_query($db, "SELECT id FROM products WHERE id='$productId' ");
		if(mysqli_num_rows($productQ)>0){
			$preDataArr = array();
			if(isset($_COOKIE['comparison'])){
				$preData = stripcslashes($_COOKIE['comparison']);
				$preDataArr = json_decode($preData, true);
			}
			foreach ($preDataArr as $key => $value) {
				if(count($preDataArr)>4) unset($preDataArr[$key]);
				else break;
			}
			if(isset($_GET['add']) && $_GET['add']=="yes"){
				if(!isset($preDataArr[$productId])) $preDataArr[$productId] = 1;
			}
			foreach ($preDataArr as $key => $value) {
				if(count($preDataArr)>5) unset($preDataArr[$key]);
				else break;
			}
			if(isset($_GET['remove']) && $_GET['remove']=="yes"){
				if(isset($preDataArr[$productId])) unset($preDataArr[$productId]);
			}
			$newData = json_encode($preDataArr);
			if(setcookie("comparison", $newData, time()+(86400*30))) header("location:product-comparison.php");
			else echo"not";
		}
		else echo"noproduct";
	}
	else echo"noid";
?>