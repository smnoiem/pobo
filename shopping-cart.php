<?php
	include("dbcon.php");
	$preDataArr=array();
	if(isset($_COOKIE['cart'])){
		$preData = stripcslashes($_COOKIE['cart']);
		$preDataArr = json_decode($preData, true);
	}
	$cartData = array();
	$i=0;
	$subTotal=0;
	$cpnType="";
	$cpnMsg="";
	$cpnOrderAmount=0;
	if(isset($_POST['coupon']) && $_POST['coupon']!=""){
		$couponCode = $_POST['coupon'];
		$couponQ = mysqli_query($db, "SELECT * FROM coupons WHERE code='$couponCode'");
		if(mysqli_num_rows($couponQ)<=0){
			$cpnMsg = "This coupons doesn't exist";
		}
		else{
			$cpnRow = mysqli_fetch_assoc($couponQ);
			$cpnExpires = $cpnRow['end'];
			$cpnType = $cpnRow['type'];
			$cpnApplicableTo = $cpnRow['applicableto'];
			$cpnOffPercentage = $cpnRow['off'];
			$cpnMinOrder = $cpnRow['minorder'];
			$cpnMaxDiscount = $cpnRow['maxdiscount'];
		}
	}
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
			$cartData[$i]['quantity'] = (double)($value);
			$cartData[$i]['subtotal'] =  ($cartData[$i]['price']*$cartData[$i]['quantity']);
			$subTotal += $cartData[$i]['subtotal'];
			$cartData[$i]['oldprice'] = $prodRow['oldprice'];
			$cartData[$i]['description'] = $prodRow['description'];
			$cartData[$i]['available'] = $prodRow['available'];
			$cartData[$i]['vendor'] = $prodRow['vendor'];
			$cartData[$i]['category'] = $prodRow['category'];
			$cartData[$i]['subcategory'] = $prodRow['subcategory'];
			if(
				($cpnType=="all")||
				($cpnType=="category"&&$cartData[$i]['category']==$cpnApplicableTo)||
				($cpnType=="subcategory" && $cartData[$i]['subcategory']==$cpnApplicableTo)||
				($cpnType=="vendor"&&$cartData['vendor']==$cpnApplicableTo)
			) $cpnOrderAmount += $cartData[$i]['subtotal'];
		}
	}
	$cpnAllowed="no";
	$cpnDeduct=0.0;
	$cpnDiscountDiv = "";
	if($cpnType!=""){
		if(time()>=strtotime($cpnExpires)) $cpnMsg="This coupon has expired.";
		else if((double)($cpnMinOrder)>$cpnOrderAmount) $cpnMsg="Order $$cpnMinOrder to apply this coupon";
		else{
			$cpnDeduct= ($cpnOrderAmount)*(double)($cpnOffPercentage)/100.0;
			if((double)($cpnMaxDiscount)>0 && (double)($cpnMaxDiscount)<$cpnDeduct){
				$cpnDeduct= (double)($cpnMaxDiscount);
			}
			$cpnAllowed="yes";
			$cpnDiscountDiv="
				<div class=\"cart-sub-total\">
					Coupon ($couponCode)<span class=\"inner-left-md\"> -&nbsp;$$cpnDeduct</span>
				</div>
			";
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
				<li><a href="/home.php">Home</a></li>
				<li class='active'><a href="/shopping-cart.php">Shopping Cart</a></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div>
<div class="body-content outer-top-ts">
	<div class="container">


		<div class="row ">
        
      <div class="col-md-12">
      <!-- /.breadcrumb --> 
			<div class="shopping-cart">
				<div class="shopping-cart-table ">
					<h4><?=$cpnMsg?></h4>
	<div class="table-responsive">
		<form action="/cart-add-remove.php" method="POST">
			<input type="hidden" name="update" value="yes">
		<table class="table">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product</th>
					<th class="cart-sub-total item">Price</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-total last-item">Subtotal</th>
				</tr>
			</thead><!-- /thead -->
			
			<tbody>
			<?php
				if($i>0){
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
						echo "
							<tr>
								<td class=\"romove-item\">
									<a href=\"\" id=\"rmv".$cartData[$j]['id']."\" 
									onclick=\"removeFromCart(".$cartData[$j]['id'].")\" 
									title=\"cancel\" class=\"icon\"><i class=\"fa fa-trash-o\"></i></a>

								</td>
								<td class=\"cart-image\">
									<a class=\"entry-thumbnail\" href=\"deals-detail.php?id=".$cartData[$j]['id']."\">
									    <img src=\"". $cartData[$j]['cover'] ."\" alt=\"\">
									</a>
								</td>
								<td class=\"cart-product-name-info\">
									<h4 class='cart-product-description'><a href=\"deals-detail.php?id="
									.$cartData[$j]['id'].
									"\">"
									. $cartData[$j]['name'] .
									"</a></h4>
									<div class=\"row\">
										<div class=\"col-sm-12\">
											$ratingBlock
										</div>
										<div class=\"col-sm-12\">
											<div class=\"reviews\">
												($numOfRvw Reviews)
											</div>
										</div>
									</div><!-- /.row -->
									<!--
									<div class=\"cart-product-info\">
														<span class=\"product-color\">COLOR:<span>Blue</span></span>
									</div>
									-->
								</td>
								<td class=\"cart-product-sub-total\"><span class=\"cart-sub-total-price\">$". $cartData[$j]['price'] ."</span></td>
								<td class=\"cart-product-quantity\">
									<div class=\"quant-input\">
							      <input name=\"cartquan".$cartData[$j]['id']."\" type=\"number\" value=\"". $cartData[$j]['quantity'] ."\" min=\"1\">
						      </div>
					      </td>
								<td class=\"cart-product-grand-total\"><span class=\"cart-grand-total-price\">$". $cartData[$j]['subtotal'] ."</span></td>
							</tr>
						";
					}
				}
				else{
					echo'
						<tr>
							<td class=\"cart-product-name-info\" colspan="6" align="center">
										<h4 class="cart-product-description">
											Your cart is currently empty.
										</h4>
							</td>
						</tr>
					';
				}
			?>


			</tbody><!-- /tbody -->
            
      <tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="/deals-grid.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<?php
									if($i>0){
										echo'
											<button id="updateCartButton"  class="btn btn-upper btn-primary pull-right outer-right-xs" type="submit">Update shopping cart</button>
										';
									}
								?>
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
		</table><!-- /table -->
	</form>
	</div>
</div><!-- /.shopping-cart-table -->				
<?php
	if(false){
		echo'
			<div class="col-md-4 col-sm-12 estimate-ship-tax">
				<table class="table">
					<thead>
						<tr>
							<th>
								<span class="estimate-title">Estimate shipping and tax</span>
								<p>Enter your destination to get shipping and tax.</p>
							</th>
						</tr>
					</thead><!-- /thead -->
					<tbody>
							<tr>
								<td>
									<div class="form-group">
										<label class="info-title control-label">Country <span>*</span></label>
										<select class="form-control unicase-form-control selectpicker">
											<option>--Select options--</option>
											<option>India</option>
											<option>SriLanka</option>
											<option>united kingdom</option>
											<option>saudi arabia</option>
											<option>united arab emirates</option>
										</select>
									</div>
									<div class="form-group">
										<label class="info-title control-label">State/Province <span>*</span></label>
										<select class="form-control unicase-form-control selectpicker">
											<option>--Select options--</option>
											<option>TamilNadu</option>
											<option>Kerala</option>
											<option>Andhra Pradesh</option>
											<option>Karnataka</option>
											<option>Madhya Pradesh</option>
										</select>
									</div>
									<div class="form-group">
										<label class="info-title control-label">Zip/Postal Code</label>
										<input type="text" class="form-control unicase-form-control text-input" placeholder="">
									</div>
									<div class="pull-right">
										<button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
									</div>
								</td>
							</tr>
					</tbody>
				</table>
			</div><!-- /.estimate-ship-tax -->
		';
	}
?>	
<?php
	if($i>0){
		echo'
			<div class="col-md-4 col-sm-12 estimate-ship-tax">
				<table class="table">
					<thead>
						<tr>
							<th>
								<span class="estimate-title">Discount Code</span>
								<p>Enter your coupon code if you have one..</p>
							</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td>
									<div class="form-group">
										<form action="" method="POST">
											<input name="coupon" type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
											<div class="clearfix pull-right">
												<button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
											</div>
										</form>
									</div>
								</td>
							</tr>
					</tbody><!-- /tbody -->
				</table><!-- /table -->
			</div><!-- /.estimate-ship-tax COUPON -->
		';
	}
?>
<?php
	if($i>0){
		echo'
			<div class="col-md-4 col-sm-12 cart-shopping-total">
				<table class="table">
					<thead>
						<tr>
							<th>
								<div class="cart-sub-total">
									Subtotal<span class="inner-left-md">$'.$subTotal.'</span>
								</div>
								'.
								$cpnDiscountDiv
								.
								'<div class="cart-grand-total">
									Grand Total<span class="inner-left-md">$'.($subTotal-$cpnDeduct).'</span>
								</div>
							</th>
						</tr>
					</thead><!-- /thead -->
					<tbody>
							<tr>
								<td>
									<div class="cart-checkout-btn pull-right">
										<button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button>
										<span class="">Checkout with multiples address!</span>
									</div>
								</td>
							</tr>
					</tbody><!-- /tbody -->
				</table><!-- /table -->
			</div><!-- /.cart-shopping-total -->			
		';
	}
?>

</div><!-- /.shopping-cart -->
</div>
</div>
</div>
    <!-- ============================================================= FOOTER ============================================================= -->
<?php include("footer-section.php"); ?>
<!-- ============================================================= FOOTER : END============================================================= --> 

	

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="assets/js/jquery-1.11.1.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script> 
<script src="assets/js/echo.min.js"></script> 
<script src="assets/js/jquery.easing-1.3.min.js"></script> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/jquery.rateit.min.js"></script> 
<script src="assets/js/lightbox.min.js"></script> 
<script src="assets/js/bootstrap-select.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/scripts.js"></script>

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

</body>
</html>