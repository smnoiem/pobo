<?php
  include("dbcon.php");
  session_start();
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
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/rateit.css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="assets/css/font-awesome.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googphpleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home" id='boodi'>
<!-- ============================================== HEADER ============================================== -->
<?php
  include("header-section.php");
?>

<!-- ============================================== HEADER : END ============================================== --> 
<?php
  $topBannerQ = mysqli_query($db, "SELECT * FROM topbanner WHERE active = 'yes' ");
  if(mysqli_num_rows($topBannerQ)>0){
    while($topBannerRow = mysqli_fetch_assoc($topBannerQ)){
      $bannerUrl = $topBannerRow['banner'];
      $vendorId = $topBannerRow['vendor'];
      echo"
        <div class=\"outer-top-ts top-banner\">
          <div class=\"container\">
            <a href=\"/deals-grid.php?vendor=". $vendorId ."\">
              <img class=\"img-responsive\" src=\"". $bannerUrl ."\" alt=\"TOP BANNER\">
            </a>
          </div> <!--INTRODUCING-->
        </div>
        <!--top banner ended-->
      ";
    }
  }
?>


<div class="body-content outer-top-ts" id="top-banner-and-menu">


  <div class="container">
<div class="slider-section">
 
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-3 col-md-2 sidebar"> 
        
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu side-menu-inner animate-dropdown outer-bottom-xs">
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">
              <?php
                //counting sale
                $saleQ = mysqli_query($db, "SELECT id FROM products WHERE sale='yes' ");
                $saleCount = mysqli_num_rows($saleQ);
                if($saleCount>0){
                  echo"
                    <li class=\"menu-item\"> <a href=\"deals-grid.php?sale=yes\">
                    On Sale!  <span>" . $saleCount . "</span></a></li>
                  ";
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '" . $catId . "' ");
                  if(mysqli_num_rows($subCatQ)>0 ) {
                    echo "<li class='dropdown menu-item'> <a href='#' class='dropdown-toggle' data-toggle='dropdown' > ";
                    echo $catRow['name'];
                    echo "</a> \n";
                    echo ("
                            <ul class=\"dropdown-menu mega-menu\">
                              <li class=\"yamm-content\">
                                <!--row started-->
                                  <div class=\"row\"> 
                          ");
                    $subCatCounter = 0;
                    while ($subCatRow = mysqli_fetch_assoc($subCatQ) ) {
                              if($subCatCounter == 0) {
                                echo("
                                    <div class=\"col-sm-12 col-md-3\">
                                      <ul class=\"links list-unstyled\">
                                  ");
                              }
                              echo("
                                <li>
                                <a href=\"deals-grid.php?cat="
                                . $catId .
                                "&subcat="
                                . $subCatRow['id'] .
                                "\">"
                                . $subCatRow['name'] . 
                                "</a></li>\n ");

                              if($subCatCounter == 7){
                                echo("
                                        </ul>
                                     </div>
                                ");
                                $subCatCounter = 0;
                              }
                              else $subCatCounter++;
                    }
                    if($subCatCounter != 0) {
                      echo ("
                                        </ul>
                                     </div>

                        ");
                    }
                    $categoryBanner = $catRow['banner'];
                    if($categoryBanner != ""){
                      echo"
                          <div class=\"dropdown-banner-holder\">
                            <a href=\"/deals-grid.php?cat="
                              . $catId .
                              "\">
                              <img alt=\"\" src=\""
                              . $categoryBanner .
                              "\">
                            </a>
                          </div>
                      ";
                    }
                    echo("
                          </div>
                          <!-- /.row --> 


                          </li>
                          <!-- /.yamm-content -->
                        </ul>
                        <!-- /.dropdown-menu --> </li>
                      <!-- /.menu-item -->

                    ");
                  }
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '" . $catId . "' ");
                  if(mysqli_num_rows($subCatQ) == 0 ) {
                    echo("
                      <li class=\"menu-item\"> <a href=\"/deals-grid.php?cat=". $catRow['id'] ."\">". $catRow['name'] ."</a> </li>
                      <!-- /.menu-item -->
                      ");
                  }
                }
              ?>
              
            </ul>
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
			
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== --> 
       </div>
	   
      <!-- /.sidemenu-holder --> 
      
       
      
      <!-- ============================================== SIDEBAR : END ============================================== --> 
  
      <div class="col-xs-12 col-sm-9 col-md-10 homebanner-holder"> 
      <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            <!--HERO SLIDER ITEM STARTS-->

            <?php
              $heroSlideQ = mysqli_query($db, "SELECT * FROM heroslider WHERE active='yes' ");
              if(mysqli_num_rows($heroSlideQ)>0){
                while($heroSlideRow = mysqli_fetch_assoc($heroSlideQ)){
                  $bannerUrl = $heroSlideRow['banner'];
                  $productId = $heroSlideRow['product'];
                  $sliderHeader = $heroSlideRow['header'];
                  $bigText = $heroSlideRow['bigtext'];
                  $excerpt = $heroSlideRow['excerpt'];
                  echo"
                    <div class=\"item\" style=\"background-image: url("
                        . $bannerUrl .
                        ");\">
                      <div class=\"container-fluid\">
                        <div class=\"caption bg-color vertical-center text-left\">
                          <div class=\"slider-header fadeInDown-1\">"
                          . $sliderHeader .
                          "</div>
                          <div class=\"big-text fadeInDown-1\">"
                          . $bigText .
                          "</div>
                          <div class=\"excerpt fadeInDown-2 hidden-xs\"> <span>"
                          . $excerpt .
                          "</span> </div>
                          <div class=\"button-holder fadeInDown-3\">
                            <a href=\"deals-detail.php?product="
                          . $productId .
                          "\" class=\"btn-lg btn btn-uppercase btn-primary shop-now-button\">Shop Now</a> </div>
                        </div>
                        <!-- /.caption --> 
                      </div>
                      <!-- /.container-fluid --> 
                    </div>
                    <!-- /.item -->
                    ";
                }
              }
            ?>

            <!--HERO SLIDER ITEM ENDS-->

            
          </div>
          <!-- /.owl-carousel --> 
        </div>
      </div>
    </div>
     </div>
     <div class="container">
      <div class="row">
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-12"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        
        
        <!-- ========================================= SECTION – HERO : END ========================================= --> 
        
        
          <!-- ============================================== STORES SECTION ============================================== -->
        <section class="section featured-section wow fadeInUp">
        <h2>Stores For You</h2>
        <div class="featured-product">
          <div class="owl-carousel homepage-owl-carousel custom-carousel owl-theme outer-top-xs">

            <!-- STORE ITEM STARTED-->
            <?php
              $storeQ = mysqli_query($db, "SELECT * FROM vendors WHERE approved='yes' ");
              if(mysqli_num_rows($storeQ)>0){
                while($storeRow = mysqli_fetch_assoc($storeQ)){
                  $storeId = $storeRow['id'];
                  $storeIcon = $storeRow['icon'];
                  $storeName = $storeRow['name'];
                  echo"
                    <div class=\"item item-carousel\">
                      <div class=\"products\">
                        <div class=\"product\">
                          <div class=\"product-image\">
                            <div class=\"image\"> 
                                <a href=\"/store-detail.php?store="
                                  . $storeId .
                                  "\">
                                  <img src=\""
                                  . $storeIcon .
                                  "\" alt=\"\"> 
                                </a>
                              </div>
                            <!-- /.image -->
                          </div>
                          <div class=\"product-info\">
                            <h3 class=\"name\">
                              <a href=\"/store-detail.php?store="
                                . $storeId .
                                "\">"
                                . $storeName .
                              "</a></h3>
                          </div>
                        </div>
                        <!-- /.product --> 
                      </div>
                      <!-- /.products --> 
                    </div>
                    <!-- /.item -->
                  ";
                }
              }
            ?>
            <!-- STORE ITEM ENDED -->

          </div>

          <!-- /.home-owl-carousel --> 
        </div>
        <!-- /.featured products-->
        </section>
        <!-- /.section --> 
        <!-- ============================================== stores : END ============================================== -->
        
        
         <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-bs">
          <div class="row">
            <!--WIDE BANNER ITEM STARTS-->
            <?php
              $wideBannerQ = mysqli_query($db, "SELECT * FROM wideproducts WHERE publish='yes' ");
              if(mysqli_num_rows($wideBannerQ)>0){
                while($wideBannerRow = mysqli_fetch_assoc($wideBannerQ)){
                  $bannerUrl = $wideBannerRow['banner'];
                  echo"
                    <div class=\"col-md-6 col-sm-6\">
                      <div class=\"wide-banner cnt-strip\">
                        <div class=\"image\"> <img class=\"img-responsive\" src=\""
                        . $bannerUrl .
                        "\" alt=\"\"> </div>
                      </div>
                      <!-- /.wide-banner --> 
                    </div>
                  ";
                }
              }
            ?>
            <!--WIDE BANNER ITEM ENDED-->
          </div>

        </div>
        <!-- /.wide-banners --> 
        
        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        

        <!-- ============================================== SCROLL TABS ============================================== -->

        <!-- ====== LATEST DEALS SLIDER STARTS ==== -->
        <?php
          include("latest-deals-slider.php");
        ?>

        <!-- ====== LATEST DEADLS SLIDER ENDS ==== -->
        <!-- ============================================== SCROLL TABS : END ============================================== --> 
       
       
        <!-- ============================================== WIDE PRODUCTS ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-bs">
          <div class="row">

            <!--WIDE BANNER ITEM STARTS-->

            <?php
              $wideBannerQ = mysqli_query($db, "SELECT * FROM wideproductslarge WHERE publish='yes' ");
              if(mysqli_num_rows($wideBannerQ)>0){
                while ($wideBannerRow = mysqli_fetch_assoc($wideBannerQ)) {
                  $productId = $wideBannerRow['product'];
                  $bigText = $wideBannerRow['bigtext'];
                  $smallText = $wideBannerRow['smalltext'];
                  $label = $wideBannerRow['label'];
                  $hoverText = $wideBannerRow['hovertext'];
                  $bannerUrl = $wideBannerRow['banner'];
                  echo"
                    <div class=\"col-md-12\">
                      <div class=\"cnt-strip\">
                        <div class=\"image1\">
                          <a href=\"deals-detail.php?product="
                          . $productId .
                          "\" target=\"_blank\" title=\""
                          . $hoverText .
                          "\">
                            <img class=\"img-responsive\" src=\""
                            . $bannerUrl .
                            "\" alt=\"\">
                          </a>
                        </div>
                        <div class=\"strip strip-text\">
                          <div class=\"strip-inner\">
                            <h2 class=\"text-right\">"
                            . $bigText .
                            "<br>
                              <span class=\"shopping-needs\">"
                              . $smallText .
                              "</span></h2>
                          </div>
                        </div>
                        <div class=\"new-label\">
                          <div class=\"text\">"
                          . $label .
                          "</div>
                        </div>
                        <!-- /.new-label --> 
                      </div>
                      <!-- /.wide-banner --> 
                    </div>
                    <!-- /.col -->
                  ";
                }
              }
            ?>

            <!--WIDE BANNER ITEM ENDS-->
            
            
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 

        <!-- ============================================== WIDE PRODUCTS : END ============================================== --> 
        </div>
        </div>
        </div>
        
    
<!-- ============================================== Coupons  ============================================== -->
        <?php include("coupon-slider.php"); ?>
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 
          <div class="container">  
          <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12"> 
        <!-- ============================================== BLOG SLIDER ============================================== -->
        <?php include("latest-blog-slider.php"); ?>
        <!-- ============================================== BLOG SLIDER : END ============================================== --> 
        
        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <?php include("flash-deals-slider.php") ?>
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== --> 
        </div>
       </div> 
       </div>


    <!-- ============================================================= FOOTER ============================================================= -->
<?php
  include("footer-section.php");
?>
<!-- ============================================================= FOOTER : END============================================================= --> 
  
      <!-- /.homebanner-holder --> 
      

 
    <!-- /.row --> 
   

</div>
<!-- /#top-banner-and-menu --> 

 



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
<script src="assets/js/countdown.js"></script> 
  <script>
      var dthen1 = new Date("<?php echo date("m/d/y h:i:s A", $fdEnd); ?>");
      start = "<?php echo date("m/d/y h:i:s A"); ?>";
      start_date = Date.parse(start);
      var dnow1 = new Date(start_date);
      if (CountStepper > 0)
      ddiff = new Date((dnow1) - (dthen1));
      else
      ddiff = new Date((dthen1) - (dnow1));
      gsecs1 = Math.floor(ddiff.valueOf() / 1000);
      
      var iid1 = "countbox_1";
      CountBack_slider(gsecs1, "countbox_1", 1);
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
          $(viewwishlistid).css('display','block');
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