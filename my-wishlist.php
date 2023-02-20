<?php
	include("dbcon.php");
	$preDataArr=array();
	if(isset($_COOKIE['wishlist'])){
		$preData = stripcslashes($_COOKIE['wishlist']);
		$preDataArr = json_decode($preData, true);
	}
	$cartData = array();
	$i=0;
	foreach ($preDataArr as $key => $value) {
		if($key==""||$value=="") {
			continue;
		}
		$prodQ = mysqli_query($db, "SELECT * FROM products WHERE id='$key' ");
		if(mysqli_num_rows($prodQ)>0){
			$i++;
			$cartData[$i] = array();
			$prodRow = mysqli_fetch_assoc($prodQ);
			$cartData[$i]['id'] = $prodRow['id'];
			$cartData[$i]['name'] = $prodRow['name'];
			$cartData[$i]['cover'] = $prodRow['cover'];
			$cartData[$i]['price'] = (double)($prodRow['price']);
			$cartData[$i]['oldprice'] = $prodRow['oldprice'];
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
				<li><a href="home.php">Home</a></li>
				<li class="active">Wishlist</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-ts">
	<div class="container">
    <div class="row">
 <div class="col-md-12"> 

<div class="my-wishlist-page">
			<div class="row">
				<div class="col-md-12 my-wishlist">
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th colspan="4" class="heading-title">My Wishlist</th>
				</tr>
			</thead>
			<tbody>
				<?php
					for($j=1; $j<=$i; $j++){
						$reviewQ = mysqli_query($db, "
			        SELECT COUNT(id) AS numofrvw, (AVG(quality+price+value))/3.0 AS rating
			        FROM reviews WHERE product = '".$cartData[$j]['id']."'
			      ");
			      $rating = 0;
			      $numOfRvw = 0;
				    if(mysqli_num_rows($reviewQ)>0){
				      $reviewRow = mysqli_fetch_assoc($reviewQ);
				      if($reviewRow['rating']!=null) $rating = $reviewRow['rating'];
				      if($reviewRow['numofrvw'] != null) $numOfRvw = $reviewRow['numofrvw'];
				    }
			      $ratingBlock = "
			        <div class=\"rating rateit-small\" data-rateit-backingfld=\"#".$cartData[$j]['id']
			        ."\" ></div>
			          <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"".$cartData[$j]['id']
			        ."\">

			      ";
						echo'
							<tr>
								<td class="col-md-2"><img src="'.$cartData[$j]['cover'].'" alt="photo"></td>
								<td class="col-md-7">
									<div class="product-name"><a href="/deals-details.php?id='.$cartData[$j]['id'].'">'.$cartData[$j]['name'].'</a></div>'
									. $ratingBlock .
									'
					        <span class="review">( '.$numOfRvw.' Reviews )</span>
									<div class="price">
										$'.$cartData[$j]['price'].'
										<span>$'.$cartData[$j]['oldprice'].'</span>
									</div>
								</td>
								<td class="col-md-2">
									<a onclick="addToCart('.$cartData[$j]['id'] .')" href="" class="btn-upper btn btn-default">Add to cart</a>
								</td>

								<td class="col-md-1 close-btn">
									<a onclick="removeFromWishlist('. $cartData[$j]['id'] .')" href="" class=""><i class="fa fa-times"></i></a>
								</td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
	</div>
</div>			</div><!-- /.row -->
		</div>
</div>
</div>
</div>
    
    <!-- ============================================================= FOOTER ============================================================= -->
<?php include("footer-section.php"); ?>
<!-- ============================================================= FOOTER : END============================================================= --> 



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
  <script>
    function addToCart(prodId) {
      $.ajax({
        url: "cart-add-remove.php",
        method:"POST",
        data:{
          id: prodId,
          add: "yes"
        },
        success:function(data){
          if(data!="ok") alert(data);
          viewcartid = '.cartprod' + prodId;
          //alert(viewcartid);
          $(viewcartid).css('display','block');
          //alert(vr);
        }
      });
    };
  </script>
  <script>
    function removeFromCart(prodId) {
      $.ajax({
        url: "cart-add-remove.php",
        method:"POST",
        data:{
          id: prodId,
          remove: "yes"
        },
        success:function(data){
          if(data!="ok") alert('something went wrong');
          location.reload();
        }
      });
    };
  </script>
    <script>
    function removeFromWishlist(prodId) {
      $.ajax({
        url: "wishlist-add-remove.php",
        method:"POST",
        data:{
          id: prodId,
          remove: "yes"
        },
        success:function(data){
          if(data!="ok") alert('something went wrong');
          location.reload();
        }
      });
    };
  </script>
</html>