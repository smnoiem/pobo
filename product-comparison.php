<?php
	include("dbcon.php");
	$preDataArr=array();
	if(isset($_COOKIE['comparison'])){
		$preData = stripcslashes($_COOKIE['comparison']);
		$preDataArr = json_decode($preData, true);
	}
	$numOfItem = count($preDataArr);
	$compData = array();
	$i=0;
	foreach ($preDataArr as $key => $value) {
		$prodQ = mysqli_query($db, "SELECT * FROM products WHERE id='$key' ");
		if(mysqli_num_rows($prodQ)>0){
			$i++;
			$compData[$i] = array();
			$prodRow = mysqli_fetch_assoc($prodQ);
			$compData[$i]['id'] = $prodRow['id'];
			$compData[$i]['name'] = $prodRow['name'];
			$compData[$i]['cover'] = $prodRow['cover'];
			$compData[$i]['price'] = $prodRow['price'];
			$compData[$i]['oldprice'] = $prodRow['oldprice'];
			$compData[$i]['description'] = $prodRow['description'];
			$compData[$i]['available'] = $prodRow['available'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>POBO</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/blue.css">
<link rel="stylesheet" href="assets/css/owl.carousel.css">
<link rel="stylesheet" href="assets/css/owl.transitions.css">
<link rel="stylesheet" href="assets/css/rateit.css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="assets/css/font-awesome.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<?php include("header-section.php"); ?>
<!-- ============================================== HEADER : END ============================================== --> 

 <div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Compare</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-ts">
	<div class="container">
    <div class="row">
 			<div class="col-md-12">
     
    		<div class="product-comparison">
					<div>
						<h1 class="page-title text-center heading-title">Product Comparison</h1>
						<div class="table-responsive">

							<table class="table compare-table inner-top-vs">
								<tr>
									<th>Products</th>
								<?php
									for($j=1; $j<=$i; $j++){
										echo"
											<td>
												<div class=\"product\">
													<div class=\"product-image\">
														<div class=\"image\">
															<a href=\"/deals-detail.php?id=".$compData[$j]['id']."\">
															    <img alt=\"\" src=\"".$compData[$j]['cover']."\">
															</a>
														</div>

														<div class=\"product-info text-left\">
															<h3 class=\"name\"><a href=\"/deals-detail.php?id=".$compData[$j]['id']."\">".$compData[$j]['name']."</a></h3>
															<div class=\"action\">
															    <a class=\"lnk btn btn-primary\" href=\"/add-to-cart.php?id=".$compData[$j]['id']."\">Add To Cart</a>
															</div>

														</div>
													</div>
												</div>
											</td>
										";
									}
								?>


								</tr>

								<tr>
									<th>Price</th>
								<?php
									for($j=1; $j<=$i; $j++){
										echo"
											<td>
												<div class=\"product-price\">
													<span class=\"price\"> $".$compData[$j]['price']." </span>
													<span class=\"price-before-discount\"> $".$compData[$j]['oldprice']."</span>
												</div>
											</td>
										";
									}
								?>
								</tr>

								<tr>
									<th>Description</th>
								<?php
									for($j=1; $j<=$i; $j++){
										echo"
											<td><p class=\"text\">".$compData[$j]['description']."</p></td>
										";
									}
								?>
								</tr>

								<tr>
									 <th>Availability</th>
								<?php
									for($j=1; $j<=$i; $j++){
										echo"<td><p class=\"in-stock\">".
										(((int)($compData[$j]['available'])>0)? "In Stock" :"Out of Stock" )
										."</p></td>";
									}
								?>
								</tr>

								<tr >
									<th>Remove</th>
								<?php
									for($j=1; $j<=$i; $j++){
										echo"
											<td class=\"text-center\"><a href=\"/comp-add-remove.php?id=".
											$compData[$j]['id']
											. "&remove=yes\" class=\"remove-icon\"><i class=\"fa fa-times\"></i></a></td>
										";
									}
								?>
								</tr>
							</table>


						</div><!--/.table-comparison-->
			    </div>
				</div><!--/.product-comparison-->

			</div><!--/.col-->
		</div><!-- /. row -->
	</div><!-- /.container -->
    
    <!-- ============================================================= FOOTER ============================================================= -->
<?php include("footer-section.php"); ?>

     

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="assets/js/jquery-1.11.1.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script> 
<script src="assets/js/echo.min.js"></script> 
<script src="assets/js/jquery.easing-1.3.min.js"></script> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/jquery.rateit.min.js"></script> 
<script type="text/javascript" src="assets/js/lightbox.min.js"></script> 
<script src="assets/js/bootstrap-select.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/scripts.js"></script>
</body>
</html>