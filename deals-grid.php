<?php
  include("dbcon.php");
  $searchKey = "";
  if(isset($_GET['srckey'])) $cat=$_GET['srckey'];
  $cat = "";
  if(isset($_GET['cat'])) $cat=$_GET['cat'];
  $subcat ="";
  if(isset($_GET['subcat'])) $subcat=$_GET['subcat'];
  $sale = "no";
  if(isset($_GET['sale'])&&($_GET['sale']=="yes")) $sale=$_GET['sale'];
  //$order 1:latest, 2:lowest, 3:highest, 4: rating
  $order=1;
  if(isset($_GET['order'])) $order=$_GET['order'];
  $page = 1;
  if(isset($_GET['page']) && $_GET['page']>0) $page=$_GET['page'];
  $perPage = 15;
  if(isset($_GET['perpage'])) $perPage=$_GET['perpage'];
  $minmax = "0,1000000000";
  if(isset($_GET['minmax'])) $minmax=$_GET['minmax'];
  $priceMin = 0;
  $priceMax = 1000000000;
  if($minmax!=""){
    $minmaxArr = explode(',', $minmax);
    $priceMin = $minmaxArr[0];
    $priceMax = $minmaxArr[1];
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
<body>
<!-- ============================================== HEADER ============================================== -->
<?php
  include("header-section.php");
?>
<!-- ============================================== HEADER : END ============================================== --> 


<!-- /.breadcrumb -->
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li class="active"><a href="/home.php">Home</a></li>
        <li class=""><a href="/deals-grid.php">Products</a></li>
        <?php
          if($sale=='yes') 
            echo"<li class=\"\"><a href=\"/deals-grid.php?sale=$sale\">Sale</a></li>";
          if($cat!=""){
            $catNameQ = mysqli_query($db, "SELECT name FROM category WHERE id='$cat'");
            if(mysqli_num_rows($catNameQ)>0) {
              $catNameRow = mysqli_fetch_assoc($catNameQ);
              $catName = $catNameRow['name'];
              echo"<li class=\"\"><a href=\"/deals-grid.php?sale=$sale&cat=$cat\">$catName</a></li>";
              if($subcat!=""){
                $subCatNameQ = mysqli_query($db, "SELECT name FROM subcategory WHERE id='$subcat'");
                echo mysqli_error($db);
                if(mysqli_num_rows($subCatNameQ)>0){
                  $subCatNameRow = mysqli_fetch_assoc($subCatNameQ);
                  $subCatName = $subCatNameRow['name'];
                  echo"<li class=\"\"><a href=\"/deals-grid.php?sale=$sale&cat=$cat&subcat=$subcat\">$subCatName</a></li>";
                }
              }
            }
          }
        ?>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<div class="body-content outer-top-ts">
  <div class='container'>
  
    <div class='row'>
            <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-md-3 sidebar"> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        <?php include("deals-category.php"); ?>
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container">
          <div class="sidebar-filter">

            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <form action="/deals-grid.php" method="GET">
                <div class="sidebar-widget-body m-t-10">
                  <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$0.00</span> <span class="pull-right">$1000.00</span> </span>
                    <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                    <input name="minmax" type="text" class="price-slider" value="300,600" data="value: '300, 600'" style="display: none;">
                  </div>
                  <input type="hidden" name="cat" value="<?=$cat?>">
                  <input type="hidden" name="subcat" value="<?=$subcat?>">
                  <input type="hidden" name="sale" value="<?=$sale?>">
                  <input type="hidden" name="perpage" value="<?=$perPage?>">
                  <input type="hidden" name="page" value="<?=$page?>">
                  <input type="hidden" name="order" value="<?=$order?>">
                  <!-- /.price-range-holder --> 
                  <!--<a href="#" class="lnk btn btn-primary">Show Now</a> -->
                  <button type="submit" class="lnk btn btn-primary"> Show Now</button>
                </div>
                <!-- /.sidebar-widget-body -->
              </form>
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== PRICE SILDER : END ============================================== --> 

          <!----------- Testimonials------------->
            <?php include("testimonials.php"); ?>
            
            <!-- ============================================== Testimonials: END ============================================== -->
            <?php
              $sidebarBannerQ = mysqli_query($db, "SELECT * FROM dealsgridsidebarbanner WHERE publish = 'yes' LIMIT 1");
              if(mysqli_num_rows($sidebarBannerQ)>0){
                while ($bannerRow = mysqli_fetch_assoc($sidebarBannerQ)) {
                  $bsBanner = $bannerRow['banner'];
                  $bsAddress = $bannerRow['address'];
                  $bsImg = "";
                  if($bsAddress=="") $bsImg = "
                    <div class=\"home-banner\"><img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"> </div>
                  ";
                  else $bsImg = "
                    <div class=\"home-banner\"> <a href=\"$bsAddress\" target=\"_blank\"> <img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"></a> </div>
                    ";

                  echo $bsImg;
                }
              }
            ?>
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
      
      <div class="col-md-9 rht-col"> 
      
        <!-- ========================================== SECTION – HERO ========================================= -->
        
<?php
  $bigSaleQ = mysqli_query($db, "SELECT * FROM bigsale WHERE publish = 'yes' LIMIT 1");
  if(mysqli_num_rows($bigSaleQ)>0){
    while ($bigSaleRow = mysqli_fetch_assoc($bigSaleQ)) {
      $bsBanner = $bigSaleRow['banner'];
      $bsBigText = $bigSaleRow['bigtext'];
      $bsNormalText = $bigSaleRow['normaltext'];
      $bsSmallText = $bigSaleRow['smalltext'];
      $bsAddress = $bigSaleRow['address'];
      $bsImg = "";
      if($bsAddress=="") $bsImg = "<div class=\"image\"> <img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"> </div>";
      else $bsImg = "<div class=\"image\"><a href=\"$bsAddress\" target=\"_blank\"> <img src=\"$bsBanner\" alt=\"\" class=\"img-responsive\"></a> </div>";

      echo"
        <div id=\"category\" class=\"category-carousel hidden-xs\">
          <div class=\"item\">
            $bsImg
            <div class=\"container-fluid\">
              <div class=\"caption vertical-top text-left\">
                <div class=\"big-text\"> $bsBigText </div>
                <div class=\"excerpt hidden-sm hidden-md\"> $bsNormalText </div>
                <div class=\"excerpt-normal hidden-sm hidden-md\"> $bsSmallText</div>
                <div class=\"buy-btn\"><a href=\"$bsAddress\" class=\"lnk btn btn-primary\">Show Now</a>
                </div>
              </div>
              <!-- /.caption --> 
            </div>
            <!-- /.container-fluid --> 
          </div>
        </div>
      ";
    }
  }
?>
        
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-3 col-lg-3 col-xs-6">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                  <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                  <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-bars"></i>List</a></li>
                </ul>
              </div>
              <!-- /.filter-tabs --> 
            </div>
            <!-- /.col -->
            
            <div class="col col-sm-12 col-md-5 col-lg-5 hidden-sm">
              <div class="col col-sm-6 col-md-12 col-lg-7 no-padding">
                <div class="lbl-cnt">
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 
                        <?php
                          if($order==1) echo"Sort by latest";
                          else if($order==2) echo"Sort by price: low to high";
                          else if($order==3) echo"Sort by price: high to low";
                          else if($order==4) echo"Sort by average rating";
                        ?>
                       <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li 
                        <?php if($order==1) echo("class = \"active\""); ?>
                          role="presentation">
                          <a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&perpage=<?=$perPage?>&page=<?=$page?>&minmax=<?=$minmax?>&order=1
                          ">Sort by latest</a>
                        </li>
                        <li 
                        <?php if($order==2) echo("class = \"active\""); ?>
                          role="presentation">
                          <a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&perpage=<?=$perPage?>&page=<?=$page?>&minmax=<?=$minmax?>&order=2
                          ">Sort by price: low to high</a>
                        </li>
                        <li 
                        <?php if($order==3) echo("class = \"active\""); ?>
                          role="presentation">
                          <a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&perpage=<?=$perPage?>&page=<?=$page?>&minmax=<?=$minmax?>&order=3
                          ">Sort by price: high to low</a>
                        </li>
                        <li 
                        <?php if($order==4) echo("class = \"active\""); ?>
                          role="presentation">
                          <a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&perpage=<?=$perPage?>&page=<?=$page?>&minmax=<?=$minmax?>&order=4
                          ">Sort by average rating</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-6 col-md-5 col-lg-5 no-padding hidden-sm hidden-md">
                <div class="lbl-cnt"><span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> <?=$perPage?> <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&order=<?=$order?>&page=<?=$page?>&perpage=15&minmax=<?=$minmax?>
                          ">15</a></li>
                        <li role="presentation"><a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&order=<?=$order?>&page=<?=$page?>&perpage=30&minmax=<?=$minmax?>
                          ">30</a></li>
                        <li role="presentation"><a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&order=<?=$order?>&page=<?=$page?>&perpage=60&minmax=<?=$minmax?>
                          ">60</a></li>
                        <li role="presentation"><a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&order=<?=$order?>&page=<?=$page?>&perpage=90&minmax=<?=$minmax?>
                          ">90</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row --> 
        </div>

        <div class="search-result-container ">
          <?php
            $offset = ($page-1)*$perPage;
            if($cat=="") $cat="%";
            if($subcat=="") $subcat = "%";
            if($sale=='no') $sale = "%";
            $ordby = "";
            $ratingCol ="";
            if($order==1) $ordby = "ORDER BY dateadded DESC";
            else if($order==2) $ordby = "ORDER BY prod.price";
            else if($order==3) $ordby = "ORDER BY prod.price DESC";
            else if($order==4) {
              $ordby = "ORDER BY rvs DESC";
              $ratingCol = ", (SELECT AVG(rvs.quality+rvs.price+rvs.value)/3.0 AS avgrate FROM reviews AS rvs WHERE prod.id = rvs.product GROUP BY rvs.product) AS rvs";
            }
            $qstr = "
                SELECT prod.*

                $ratingCol

                FROM products AS prod 

                WHERE
                prod.name LIKE '%$searchKey%' 
                AND prod.category LIKE '$cat' 
                AND prod.subcategory LIKE '$subcat' 
                AND prod.sale LIKE '$sale'
                AND prod.price>= '$priceMin' 
                AND prod.price<= '$priceMax'
                $ordby 
                LIMIT $offset , $perPage
              ";
            $prodQ = mysqli_query($db, $qstr);
            $itemsFound = mysqli_num_rows($prodQ);
            if($cat=="%") $cat="";
            if($subcat=="%") $subcat = "";
            if($sale=='%') $sale = "no";
            if(mysqli_num_rows($prodQ)>0){
              echo"
                <div id=\"myTabContent\" class=\"tab-content category-list\">
              ";
              echo"
                  <div class=\"tab-pane active \" id=\"grid-container\">
                    <div class=\"category-product\">
                      <div class=\"row\">
              ";
              while ($tabItemsRow = mysqli_fetch_assoc($prodQ)) {
                $prodRating = 0;
                if(isset($prodRow['rvs'])) $prodRating = $prodRow['rvs'];
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
                  <div class=\"rating rateit-small\" data-rateit-backingfld=\"#$prodId\" ></div>
                    <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"$prodId\">
                  ";
                $productTag = "";
                if($sale=="yes") $productTag = "<div class=\"tag sale\"><span>sale</span></div>";
                else if($price<$oldPrice) {
                  $percentage = (int)((($oldPrice-$price)*100.0)/$oldPrice) ;
                  $productTag = "<div class=\"tag new\"><span>-$percentage% </span></div>";
                }
                echo"

                  <div class=\"col-sm-6 col-md-4 col-lg-4 wow fadeInUp\">
                  <div class=\"item\">
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
                        <div class=\"store\">
                          <a href=\"store-detail.php?id=$vendorId\">$vendorName</a>
                        </div>
                          <h3 class=\"name\"><a href=\"deals-detail.php?id=$prodId\">$prodName</a></h3>
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
                  </div>
                  <!-- /.item -->
                ";
              }
              echo"
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.category-product --> 
                  
                </div>
                <!-- /.tab-pane -->
              ";

              //list pane starts
              $prodQ = mysqli_query($db, $qstr);
              echo"
                <div class=\"tab-pane \"  id=\"list-container\">
                <div class=\"category-product\">
              ";
              while ($tabItemsRow = mysqli_fetch_assoc($prodQ)) {
                $prodRating = 0;
                if(isset($prodRow['rvs'])) $prodRating = $prodRow['rvs'];
                $prodId = $tabItemsRow['id'];
                $prodName = $tabItemsRow['name'];
                $prodDescription = $tabItemsRow['description'];
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
                  <div class=\"rating rateit-small\" data-rateit-backingfld=\"#row$prodId\" ></div>
                    <input type=\"range\" min=\"0\" max=\"5\" value=\"$rating\" step=\"0.10\" id=\"row$prodId\">
                  ";
                $productTag = "";
                if($sale=="yes") $productTag = "<div class=\"tag sale\"><span>sale</span></div>";
                else if($price<$oldPrice) {
                  $percentage = (int)((($oldPrice-$price)*100.0)/$oldPrice) ;
                  $productTag = "<div class=\"tag new\"><span>-$percentage% </span></div>";
                }
                //printing items in list view
                echo"
                  <div class=\"category-product-inner wow fadeInUp\">
                    <div class=\"products\">
                      <div class=\"product-list product\">
                        <div class=\"row product-list-row\">
                          <div class=\"col col-sm-3 col-lg-3\">
                            <div class=\"product-image\">
                              <div class=\"image\"> <img src=\"$coverUrl\" alt=\"\"> </div>
                            </div>
                            <!-- /.product-image --> 
                          </div>
                          <!-- /.col -->
                          <div class=\"col col-sm-9 col-lg-9\">
                            <div class=\"product-info\">
                              <h3 class=\"name\"><a href=\"deals-detail.php?id=$prodId\">$prodName</a></h3>
                              $ratingBlock
                              <div class=\"product-price\"> <span class=\"price\">$$price </span> <span class=\"price-before-discount\">$$oldPrice</span> </div>
                              <!-- /.product-price -->
                              <div class=\"description m-t-10\">$prodDescription</div>
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
                            <!-- /.product-info --> 
                          </div>
                          <!-- /.col --> 
                        </div>
                        <!-- /.product-list-row -->
               
                      </div>
                      <!-- /.product-list --> 
                    </div>
                    <!-- /.products --> 
                  </div>
                  <!-- /.category-product-inner --> 
                ";
              }
              echo"
                  </div>
                  <!-- /.category-product --> 
                </div>
                <!-- /.tab-pane #list-container --> 
              ";
              //list pane part ends
              echo"
                </div>
                <!-- /.tab-content -->
              ";
            }
            else echo"
                <div id=\"myTabContent\" class=\"tab-content category-list\">
                <div class=\"tab-pane active \" id=\"grid-container\">
                <div class=\"category-product\">
                <div class=\"row\">
                  <div class=\"col-sm-6 col-md-4 col-lg-4 wow fadeInUp\">
                  <div class=\"item\">
                    <div class=\"products\">
                      <div class=\"product\">
                        <div class=\"product-info text-left\">                        
                          <h3 class=\"name\">No Products Found!</h3>
                        </div>
                      </div>
                      <!-- /.product --> 
                      
                    </div>
                    <!-- /.products --> 
                    </div>
                  </div>
                  <!-- /.item -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.category-product --> 
              
            </div>
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            ";

          ?>


          <div class="clearfix filters-container bottom-row">
            <div class="text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">

                  <?php
                    $navRange = 5; 
                    $pageStarts = ($page - (int)($navRange/2));
                    if($pageStarts<1) $pageStarts = 1;
                    if($pageStarts>1){
                      echo"
                        <li class=\"prev\"><a href=\"
                          /deals-grid.php?cat=$cat&subcat=$subcat&sale=$sale&order=$order&page=". (((int)($page))-1) ."&perpage=$perPage&minmax=$minmax
                          \">
                        <i class=\"fa fa-angle-left\"></i></a></li>";
                    }
                    for ($navPage=$pageStarts; $navPage<($pageStarts+$navRange) ; $navPage++) { 
                      $activePage = "";
                      if($navPage == $page) $activePage = "class=\"active\"";
                      echo"<li $activePage><a href=\"
                          /deals-grid.php?cat=$cat&subcat=$subcat&sale=$sale&order=$order&page=$navPage&perpage=$perPage&minmax=$minmax
                          \">$navPage</a></li>";
                    }
                  ?>
                  <li class="next">
                    <a href="
                          /deals-grid.php?cat=<?=$cat?>&subcat=<?=$subcat?>&sale=<?=$sale?>&order=<?=$order?>&page=<?=$page+1?>&perpage=<?=$perPage?>&minmax=<?=$minmax?>
                          ">
                      <i class="fa fa-angle-right"></i>
                    </a></li>
                </ul>
                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        <!-- /.search-result-container --> 

   
      </div>
      <!-- /.col --> 
    </div>
    </div>

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
<script type="text/javascript">
jQuery(function () {
  // Price Slider
  if (jQuery('.price-slider').length > 0) {
      jQuery('.price-slider').slider({
          min: 0,
          max: 1000,
          step: 10,
          value: [<?=$minmax?>],
          handle: "square"
      });
  }
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