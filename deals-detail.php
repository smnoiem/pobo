<?php
  include("dbcon.php");
  $userId = 1; //dummy user id for guests
  if(isset($_GET['id']) && $_GET['id']!=""){
    $prodId = $_GET['id'];
    $prodQ = mysqli_query($db, "SELECT * FROM products WHERE id='$prodId' LIMIT 1");
    if(mysqli_num_rows($prodQ)>0){
      $prodRow = mysqli_fetch_assoc($prodQ);
      $prodName = $prodRow['name'];
      $prodDescription = $prodRow['description'];
      $prodAvailable = $prodRow['available'];
      $catId = $prodRow['category'];
      $subCatId = $prodRow['subcategory'];
      $price = $prodRow['price'];
      $oldPrice = $prodRow['oldprice'];
      $vendorId = $prodRow['vendor'];
      $prodCover = $prodRow['cover'];
      $catQ = mysqli_query($db, "SELECT name FROM category WHERE id = '$catId' ");
      $catRow = mysqli_fetch_assoc($catQ);
      $catName = $catRow['name'];
      $subCatQ = mysqli_query($db, "SELECT name FROM subcategory WHERE id='$subCatId'");
      $subCatRow = mysqli_fetch_assoc($subCatQ);
      $subCatName = $subCatRow['name'];
      $vendorQ = mysqli_query($db, "SELECT name, logo, description, email FROM vendors WHERE id='$vendorId' ");
      $vendorRow = mysqli_fetch_assoc($vendorQ);
      $vendorName = $vendorRow['name'];
      $vendorEmail = $vendorRow['email'];
      $vendorLogo = $vendorRow['logo'];
      $vendorDescription = $vendorRow['description'];
      $reviewQ = mysqli_query($db, "
        SELECT COUNT(id) AS numofrvw, (AVG(quality+price+value))/3.0 AS rating
        FROM reviews WHERE product = '$prodId'
      ");
      $rating = 0;
      $numOfRvw = 0;
      $reviewRow = mysqli_fetch_assoc($reviewQ);
      if($reviewRow['rating']!=null) $rating = $reviewRow['rating'];
      if($reviewRow['numofrvw'] != null) $numOfRvw = $reviewRow['numofrvw'];
      $ratingBlock = "
        <div class=\"rating rateit-small\" data-rateit-backingfld=\"#$prodId\" ></div>
          <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"$prodId\">
        ";
    }
    else header("location: deals-grid.php");
  }
  else header("location: deals-grid.php");
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
<link href="assets/css/lightbox.css" rel="stylesheet">
<!-- Icons/Glyphs -->
<link rel="stylesheet" href="assets/css/font-awesome.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- ============================================== HEADER ============================================== -->
<?php include("header-section.php"); ?>

<!-- ============================================== HEADER : END ============================================== --> 
<div class="breadcrumb">
  <div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
        <li><a href="/home.php">Home</a></li>
        <li><a href="/deals-grid.php">Products</a></li>
				<li><a href="/deals-grid.php?cat=<?=$catId?>"><?=$catName?></a></li>
				<?php
          if($subCatId!=2) echo "
            <li><a href=\"/deals-grid.php?cat=$catId&subcat=$subCatId\">$subCatName</a></li>
          "; 
        ?>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-ts">
	<div class='container'>
		<div class='row single-product'>
			<!-- /.sidebar -->
			<div class='col-md-12'>

        <div class="detail-block">
				  <div class="row  wow fadeInUp">
                
            <div class="col-xs-12 col-sm-5 col-md-4 gallery-holder">
              <div class="product-item-holder size-big single-product-gallery small-gallery">

                <div id="owl-single-product">
                  <?php
                    $imgQ = mysqli_query($db, "SELECT * FROM productimages
                        WHERE product ='$prodId' and publish='yes' 
                        ORDER BY uploadtime
                      ");
                    if(mysqli_num_rows($imgQ)>0){
                      while($imgRow=mysqli_fetch_assoc($imgQ)){
                        $imgId = $imgRow['id'];
                        $imgSource = $imgRow['source'];
                        echo"
                          <div class=\"single-product-gallery-item\" id=\"slide$imgId\">
                              <a data-lightbox=\"image-1\" data-title=\"Gallery\" href=\"$imgSource\">
                                  <img class=\"img-responsive\" alt=\"\" src=\"assets/images/blank.gif\" data-echo=\"$imgSource\" />
                              </a>
                          </div><!-- /.single-product-gallery-item -->
                        ";
                      }
                    }
                  ?>

                </div><!-- /.single-product-slider -->

                <div class="single-product-gallery-thumbs gallery-thumbs">
                  <div id="owl-single-product-thumbnails">
                  <?php
                    $imgQ = mysqli_query($db, "SELECT * FROM productimages
                        WHERE product ='$prodId' and publish='yes' 
                        ORDER BY uploadtime
                      ");
                    if(mysqli_num_rows($imgQ)>0){
                      while($imgRow=mysqli_fetch_assoc($imgQ)){
                        $imgId = $imgRow['id'];
                        $imgSource = $imgRow['source'];
                        $imgActive="";
                        if($imgRow['cover']=="yes") $imgActive="active";
                        echo"
                          <div class=\"item\">
                              <a class=\"horizontal-thumb $imgActive\" data-target=\"#owl-single-product\" data-slide=\"1\" href=\"#slide$imgId\">
                                  <img class=\"img-responsive\" alt=\"\" src=\"assets/images/blank.gif\" data-echo=\"$imgSource\" />
                              </a>
                          </div>
                        ";
                      }
                    }
                  ?>


                  </div><!-- /#owl-single-product-thumbnails -->
                </div><!-- /.gallery-thumbs -->

              </div><!-- /.single-product-gallery -->
            </div><!-- /.gallery-holder -->        			
  					<div class='col-sm-7 col-md-5 product-info-block'>
  						<div class="product-info">
  							<h1 class="name"><?=$prodName?></h1>
  							
  							<div class="rating-reviews m-t-20">
  								<div class="row">
                    <div class="col-lg-12">
    									<div class="pull-left">
    										<?=$ratingBlock?>
    									</div>
    									<div class="pull-left">
    										<div class="reviews">
    											<a data-toggle="tab" href="#review" class="lnk"> (<?=$numOfRvw?> Reviews)
                          </a>
    										</div>
    									</div>
                    </div>
  								</div><!-- /.row -->		
  							</div><!-- /.rating-reviews -->

  							<div class="stock-container info-container m-t-10">
  								<div class="row">
                    <div class="col-lg-12">
    									<div class="pull-left">
    										<div class="stock-box">
    											<span class="label">Availability :</span>
    										</div>	
    									</div>
    									<div class="pull-left">
    										<div class="stock-box">
    											<span class="value">
                          <?php
                            if($prodAvailable>0) echo"In Stock";
                            else echo"Out of Stock";
                          ?>           
                          </span>
    										</div>	
    									</div>
                    </div>
  								</div><!-- /.row -->	
  							</div><!-- /.stock-container -->

  							<div class="price-container info-container m-t-20">
  								<div class="row">
  									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
  										<div class="price-box">
  											<span class="price">$<?=$price?></span>
  											<?php
                          if($oldPrice>0)
                            echo"<span class=\"price-strike\">$$oldPrice</span>";
                        ?>
  										</div>
  									</div>
  									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
  										<div class="favorite-button">

  											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" onclick="addToWishlist('<?=$prodId?>')">
  											    <i class="fa fa-heart"></i>
  											</a>

                        <a style="display: none;" class="btn btn-primary wishlistprod<?=$prodId?>" data-toggle="tooltip" data-placement="right" title="View Wishlist" href="/my-wishlist.php">
                            <i class="fa fa-check"></i>
                        </a>

                        <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="comp-add-remove.php?id=<?=$prodId?>&add=yes">
                           <i class="fa fa-signal"></i>
                        </a>

  											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="mailto:<?=$vendorEmail?>">
  											    <i class="fa fa-envelope"></i>
  											</a>
  										</div>
  									</div>
  								</div><!-- /.row -->
  							</div><!-- /.price-container -->

                <?php
                  if($prodAvailable>0){
                    echo"
        							<div class=\"quantity-container info-container\">
        								<div class=\"row\">
        									<div class=\"qty\">
        										<span class=\"label\">Qty :</span>
        									</div>
        									
        									<div class=\"qty-count\">
        										<div class=\"cart-quantity\">
        											<div class=\"quant-input\">
      					                <div class=\"arrows\">
      					                  <div class=\"arrow plus gradient\"><span class=\"ir\"><i class=\"icon fa fa-sort-asc\"></i></span></div>
      					                  <div class=\"arrow minus gradient\"><span class=\"ir\"><i class=\"icon fa fa-sort-desc\"></i></span></div>
      					                </div>
      					                <input type=\"text\" value=\"1\">
      					              </div>
                            </div>
        									</div>

        									<div class=\"add-btn\">
        										<a href=\"#\" class=\"btn btn-primary\"><i class=\"fa fa-shopping-cart inner-right-vs\"></i> Buy Product</a>
        									</div>
        								</div><!-- /.row -->
        							</div><!-- /.quantity-container -->
                      ";
                    }
                  ?>
  						</div><!-- /.product-info -->
  					</div><!-- /.col-sm-7 -->
            <div class="col-lg-3 col-sm-12 col-md-3">
              <div class="store-details">
                <img alt="" src="<?=$vendorLogo?>"/>
                <h2><a href="store-detail.php?id=<?=$vendorId?>"><?=$vendorName?></a></h2>
                <p><?=$vendorDescription?></p>
              </div>
            </div>
            <!-- all columns ended -->
          </div><!-- /.row -->
        </div><!-- /.detail-block -->
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">

						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">Description</a></li>
                                <li><a data-toggle="tab" href="#vendor">Vendor</a></li>
								<li><a data-toggle="tab" href="#review">Review</a></li>
								<li><a data-toggle="tab" href="#tags">Tags</a></li>
                                <li><a data-toggle="tab" href="#offers">More Offers</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>

						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?=$prodDescription?></p>
									</div>	
								</div>
                <!-- /.tab-pane -->
                <div id="vendor" class="tab-pane">
									<div class="product-tab">
                    <h3><?=$vendorName?></h3>
										<p class="text">
                      <?=$vendorDescription?><br><br>
                      <a href="/store-detail.php?id=<?=$vendorId?>">More Products from <?=$vendorName?></a>
                    </p>
									</div>	
								</div>
								<div id="review" class="tab-pane">
									<div class="product-tab">
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>
											<div class="reviews">
                        <?php
                          $reviewQ = mysqli_query($db, "SELECT * FROM reviews WHERE product='$prodId' AND approved='yes' ORDER BY time DESC ");
                          if(mysqli_num_rows($reviewQ)>0){
                            while($reviewRow = mysqli_fetch_assoc($reviewQ)){
                              $rvwSummary = $reviewRow['summary'];
                              $rvwDescription = $reviewRow['description'];
                              $rvwPostedOn = $reviewRow['time'];
                              $dateDiff = time() - strtotime($rvwPostedOn);
                              $rvwDayDiff = round($dateDiff/(60*60*24.0));
                              echo"
        												<div class=\"review\">
        													<div class=\"review-title\">
                                    <span class=\"summary\">$rvwSummary</span>
                                    <span class=\"date\"><i class=\"fa fa-calendar\"></i><span>$rvwDayDiff days ago</span></span>
                                  </div>
        													<div class=\"text\">
                                    $rvwDescription
                                  </div>
        												</div>
                              ";
                            }
                          }
                        ?>
                        <div class="review" id="reviewadded" style="display: none;">
                          <div class="review-title">
                            <span class="summary">Review Added</span>
                            <span class="date"><i class="fa fa-calendar"></i><span>0 days ago</span></span>
                          </div>
                          <div class="text">
                            It will be public after being approved.
                          </div>
                        </div>


											</div>
                      <!-- /.reviews -->
										</div>
                    <!-- /.product-reviews -->
										
										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											<div class="review-table">
                        <form class="cnt-form" id="addComment">
                          <input id="prodId" type="hidden" name="prodId" value="<?=$prodId?>">
                          <input id="userId" type="hidden" name="userId" value="<?=$userId?>">
  												<div class="table-responsive">
  													<table class="table">	
  														<thead>
  															<tr>
  																<th class="cell-label">&nbsp;</th>
  																<th>1 star</th>
  																<th>2 stars</th>
  																<th>3 stars</th>
  																<th>4 stars</th>
  																<th>5 stars</th>
  															</tr>
  														</thead>	
  														<tbody>
  															<tr>
  																<td class="cell-label">Quality</td>
  																<td><input id="quality" type="radio" name="quality" class="radio" value="1" required></td>
  																<td><input id="quality" type="radio" name="quality" class="radio" value="2"></td>
  																<td><input id="quality" type="radio" name="quality" class="radio" value="3"></td>
  																<td><input id="quality" type="radio" name="quality" class="radio" value="4"></td>
  																<td><input id="quality" type="radio" name="quality" class="radio" value="5"></td>
  															</tr>
  															<tr>
  																<td class="cell-label">Price</td>
  																<td><input id="price" type="radio" name="price" class="radio" value="1" required></td>
  																<td><input id="price" type="radio" name="price" class="radio" value="2"></td>
  																<td><input id="price" type="radio" name="price" class="radio" value="3"></td>
  																<td><input id="price" type="radio" name="price" class="radio" value="4"></td>
  																<td><input id="price" type="radio" name="price" class="radio" value="5"></td>
  															</tr>
  															<tr>
  																<td class="cell-label required">Value</td>
  																<td><input id="value" type="radio" name="value" class="radio" value="1" required></td>
  																<td><input id="value" type="radio" name="value" class="radio" value="2"></td>
  																<td><input id="value" type="radio" name="value" class="radio" value="3"></td>
  																<td><input id="value" type="radio" name="value" class="radio" value="4"></td>
  																<td><input id="value" type="radio" name="value" class="radio" value="5"></td>
  															</tr>
  														</tbody>
  													</table><!-- /.table .table-bordered -->
  												</div><!-- /.table-responsive -->
  											</div><!-- /.review-table -->
  											
  											<div class="review-form">
  												<div class="form-container">
														
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group">
																	<label for="exampleInputName">Your Name <span class="astk">*</span></label>
																	<input name="name" id="name" type="text" class="form-control txt" id="exampleInputName" placeholder="" required>
																</div><!-- /.form-group -->
																<div class="form-group">
																	<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
																	<input id="summary" name="summary" type="text" class="form-control txt" id="exampleInputSummary" placeholder="" required>
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Review <span class="astk">*</span></label>


																	<textarea id="newRvwtxt" name="review" type="text" class="form-control txt" required></textarea>


																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->
														
														<div class="action text-right">
															<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
                  </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

								<div id="tags" class="tab-pane">
									<div class="product-tag">
										
										<h4 class="title">Product Tags</h4>
										<form class="form-inline form-cnt">
											<div class="form-container">
									
												<div class="form-group">
													<label for="exampleInputTag">Add Your Tags: </label>
													<input type="email" id="exampleInputTag" class="form-control txt">
													

												</div>

												<button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
											</div><!-- /.form-container -->
										</form><!-- /.form-cnt -->

										<form class="form-inline form-cnt">
											<div class="form-group">
												<label>&nbsp;</label>
												<span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
											</div>
										</form><!-- /.form-cnt -->

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
                <div id="offers" class="tab-pane">
									<div class="product-tab">
										<p class="text">Sorry no more offers available</p>
									</div>	
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->

						</div><!-- /.col -->

					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

        <!-- ============================================== RELATED PRODUCTS ============================================== -->
          

          <?php
            $tabItemsQ = mysqli_query($db, "SELECT * FROM products WHERE category=$catId AND id!='$prodId' ORDER BY dateadded DESC");
              if(mysqli_num_rows($tabItemsQ)>0){
                echo"
                  <section class=\"section wow fadeInUp\">
                  <h3 class=\"section-title\">Related Products</h3>
                  
                  <div class=\"new-arriavls\">
                  <div class=\"owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs\">
                ";

                while($tabItemsRow = mysqli_fetch_assoc($tabItemsQ)){
                  $prodId = $tabItemsRow['id'];
                  $prodName = $tabItemsRow['name'];
                  $sale = $tabItemsRow['sale'];
                  $coverUrl = $tabItemsRow['cover'];
                  $vendorId = $tabItemsRow['vendor'];
                  $vendorQ = mysqli_query($db, "SELECT name FROM vendors WHERE id=".$vendorId." LIMIT 1");
                  $vendorRow = mysqli_fetch_assoc($vendorQ);
                  $vendorName = $vendorRow['name'];
                  $price = $tabItemsRow['price'];
                  $oldPrice = $tabItemsRow['oldprice'];
                  $oldPriceOutput = "<span class=\"price-before-discount\">$$oldPrice</span> ";
                  if($oldPrice==0) $oldPriceOutput = "";
                  //calculate rating
                  $ratingQ = mysqli_query($db, "SELECT AVG(quality+price+value) as avg FROM reviews WHERE product = ".$prodId );
                  $ratingRow = mysqli_fetch_assoc($ratingQ);
                  $rating = $ratingRow['avg']/3.0 ;
                  $ratingBlock = "
                    <div class=\"rating rateit-small\" data-rateit-backingfld=\"#own$catId$prodId\" ></div>
                      <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"own$catId$prodId\">
                    ";
                  $productTag = "";
                  if($sale=="yes") $productTag = "<div class=\"tag sale\"><span>sale</span></div>";
                  else if($price<$oldPrice) {
                    $percentage = (int)((($oldPrice-$price)*100.0)/$oldPrice) ;
                    $productTag = "<div class=\"tag new\"><span>-$percentage% </span></div>";
                  }
                  //PRINTING ITEMS IN HTML
                  echo"
                    <div class=\"item item-carousel\">
                      <div class=\"products\">
                        <div class=\"product\">
                          <div class=\"product-image\">
                            <div class=\"image\"> 
                              <a href=\"deals-detail.php?id=$prodId\">
                                <img src=\"$coverUrl\" alt=\"\"> 
                              </a> 
                            </div>
                            <!-- /.image -->
                            $productTag
                          </div>
                          <!-- /.product-image -->
                          
                          <div class=\"product-info text-left\">
                            <div class=\"brand\"> $vendorName </div>
                            <h3 class=\"name\"><a href=\"deals-detail.php?id=$prodId \">$prodName</a></h3>
                            $ratingBlock
                            <div class=\"description\"></div>
                            <div class=\"product-price\"> <span class=\"price\"> $$price </span> $oldPriceOutput </div>
                            <!-- /.product-price --> 
                          </div>
                          <!-- /.product-info -->
                          <div class=\"cart clearfix animate-effect\">
                            <div class=\"action\">
                              <ul class=\"list-unstyled\">

                                <li class=\"add-cart-button btn-group\">
                                        <button onclick=\"addToCart('$prodId')\"  data-toggle=\"tooltip\" class=\"btn btn-primary icon\" type=\"button\" title=\"Add Cart\"> <i class=\"fa fa-shopping-cart\"></i> </button>
                                      </li>

                                      <li style=\"display:none\" class=\"lnk wishlist cartprod$prodId\"> 
                                        <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"shopping-cart.php\" title=\"View Cart\"> <i class=\"fa fa-check\"></i> 
                                        </a>
                                       </li>


                                    <li class=\"add-cart-button btn-group\"> <button data-toggle=\"tooltip\" class=\"btn btn-primary icon\" type=\"button\" onclick=\"addToWishlist('$prodId')\"  title=\"Wishlist\"> <i class=\"icon fa fa-heart\"></i> </button> </li>


                                      <li style=\"display:none\" class=\"lnk wishlist wishlistprod$prodId\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"my-wishlist.php\" title=\"View Wishlist\"> <i class=\"fa fa-check\"></i> </a> </li>


                                      <li class=\"lnk\"> <a data-toggle=\"tooltip\" class=\"add-to-cart\" href=\"comp-add-remove.php?id=$prodId&add=yes\" title=\"Compare\"> <i class=\"fa fa-signal\" aria-hidden=\"true\"></i> </a> </li>

                              </ul>
                            </div>
                            <!-- /.action --> 
                          </div>
                          <!-- /.cart --> 
                        </div>
                        <!-- /.product --> 
                        
                      </div>
                      <!-- /.products --> 
                    </div>
                    <!-- /.item -->

                  ";
                }
                echo"
                    </div>
                  <!-- /.home-owl-carousel --> 
                  </div>
                </section>
                <!-- /.section --> 
                ";
              }
            ?>

        <!-- ============================================== RELATED PRODUCTS : END ============================================== --> 
      </div><!-- /.col -->
    </div><!-- /.row single-product -->
  </div><!-- /.container -->
  <!-- ============================================================= FOOTER ============================================================= -->
  <?php include("footer-section.php"); ?>	
			

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
  <script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#addComment").submit(function(event) {
      event.preventDefault();
      prodId = $('#prodId').val();
      userId = $('#userId').val();
      quality = $("input[name='quality']:checked").val();
      price = $("input[name='price']:checked").val();
      value = $("input[name='value']:checked").val();
      name = $('#name').val();
      summary = $('#summary').val();
      review = $('#newRvwtxt').val();
      $.ajax({
        url: "add-review.php",
        method:"POST",
        data:{
          prodId: prodId,
          userId: userId,
          quality: quality,
          price: price, 
          value: value,
          name: name,
          summary: summary,
          review: review
        },
        success:function(data){
          if(data!="ok") alert("someting went wrong");
          $("#reviewadded").attr("style","display:block");
          $([document.documentElement, document.body]).animate({
            scrollTop: $("#reviewadded").offset().top
          }, 900);
        }
      });
    });
  </script>
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
    function addToWishlist(prodId) {
      $.ajax({
        url: "wishlist-add-remove.php",
        method:"POST",
        data:{
          id: prodId,
          add: "yes"
        },
        success:function(data){
          if(data!="ok") alert(data);
          viewwishlistid = '.wishlistprod' + prodId;
          //alert(viewcartid);
          $(viewwishlistid).css('display','inline-block');
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
</body>
</html>