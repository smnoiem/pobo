<?php
	include("dbcon.php");
	if(isset($_POST['prodId'])){
		$prodId = $_POST['prodId'];
		$prodValue = $_POST['value'];
		$prodQuality = $_POST['quality'];
		$prodPrice = $_POST['price'];
		$userId = $_POST['userId'];
		$userName = $_POST['name'];
		$rvwSummary = $_POST['summary'];
		$rvwDescription = $_POST['review'];;
		$rvwDescription = mysqli_real_escape_string($db, $rvwDescription);
		$rvwSummary = mysqli_real_escape_string($db, $rvwSummary);
		$userName = mysqli_real_escape_string($db, $userName);
		$insertRvwQStr = "INSERT INTO reviews 
			(product, username, userid, summary, description, quality, price, value)
			VALUES 
			('$prodId', '$userName', '$userId', '$rvwSummary', '$rvwDescription', '$prodQuality', '$prodPrice', '$prodValue')
			";
		if(mysqli_query($db, $insertRvwQStr)) echo "ok";
		else echo "not";
	}
	else echo"noid";
?>