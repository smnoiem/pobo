<?php
  include("dbcon.php");
  $perPage = 10;
  $page = 1;
  if(isset($_GET['page']) && $_GET['page']!="") $page = (int)($_GET['page']);
  $offset = ($page-1)*$perPage;
  $searchKey ="";
  if(isset($_GET['searchKey'])) $searchKey = $_GET['searchKey'];
  $cat = "%";
  if(isset($_GET['cat']) && $_GET['cat']!="") $cat = $_GET['cat'];
  $subcat = "%";
  if(isset($_GET['subcat']) && $_GET['subcat']!="") $subcat = $_GET['subcat'];

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
<?php include("header-section.php"); ?>
<!-- ============================================== HEADER : END ============================================== --> 


<!-- /.breadcrumb -->
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class="active"><a href="/coupons.php">Coupons</a></li></li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<div class="body-content blog-page outer-top-ts">
  <div class='container'>
    <div class='row'>
      <div class="col-md-9 rht-col"> 
      

        <div class="category-product coupons-section coupons-section-inner">
          <div class="row coupons-deals">
      <?php
          $curDate = date("Y-m-d");
          $qstr = "
              SELECT * FROM coupons 
              WHERE 
              end>$curDate
              AND title LIKE '%$searchKey%'
              LIMIT $offset , $perPage
            ";
        $cpnQ = mysqli_query($db, $qstr);
        if($cat="%") $cat="";
        if($subcat=="%") $subcat = "";
        if(mysqli_num_rows($cpnQ)>0){
          while($cpnRow = mysqli_fetch_assoc($cpnQ)){
            $cpnId = $cpnRow['id'];
            $cpnTitle = $cpnRow['title'];
            $cpnType = $cpnRow['type'];
            $cpnOff = $cpnRow['off'];
            $cpnEnd = $cpnRow['end'];
            $cpnCode = $cpnRow['code'];
            $cpnIcon = $cpnRow['icon'];
            $cpnApplicableTo = $cpnRow['applicableto'];
            $cpnDealLink = $cpnRow['deallink'];

            echo"
              <div class=\"col-sm-6 col-md-6 col-lg-6 wow fadeInUp\">
                <div class=\"item\">
                  <div class=\"products\">
                    <div class=\"product\">
                      <div class=\"product-image\">
                        <div class=\"image\"> 
                          <img class=\"img-responsive\" src=\"$cpnIcon\" alt=\"\">
                          <div class=\"brand\">$cpnApplicableTo</div>
                          <h3 class=\"name\"><a href=\"$cpnDealLink\">$cpnTitle</a></h3>
                              
                        </div>
                        <!-- /.image -->
                      </div>
                      <!-- /.product-image -->
                      
                      <div class=\"product-info text-left\">
                        <div class=\"discount\">$cpnOff% <span>OFF</span></div>
                        <div class=\"show-code\"><a href=\"#\" data-toggle=\"modal\" data-target=\"#modal$cpnId\">Show Code</a></div>
                        <p class=\"exp-date\"><i class=\"fa fa-clock-o\"></i> Expires on $cpnEnd</p>  
                      </div>
                
                    </div>
                    <!-- /.product --> 
                  </div>
                  <!-- /.products --> 
                </div>
              </div>
              <!-- /.item -->
            ";
          }
          $cpnQ = mysqli_query($db, $qstr);
          while($cpnRow = mysqli_fetch_assoc($cpnQ)){
            $cpnId = $cpnRow['id'];
              $cpnTitle = $cpnRow['title'];
              $cpnDescription = $cpnRow['description'];
              $cpnType = $cpnRow['type'];
              $cpnOff = $cpnRow['off'];
              $cpnEnd = $cpnRow['end'];
              $cpnCode = $cpnRow['code'];
              $cpnIcon = $cpnRow['icon'];
              $cpnApplicableTo = $cpnRow['applicableto'];
              $cpnDealLink = $cpnRow['deallink'];
              $cpnStoreLink = $cpnRow['storelink'];
              $cpnStoreLinkBlock = "";
              if($cpnStoreLink != "") 
                $cpnStoreLinkBlock = "
                  <span style=\"color: #ed6663; display:block; margin-top:10px;\">
                    <a style=\"color: #ed6663; text-decoration:underline\" href=\"$cpnStoreLink\" target=\"_blank\">Visit our Store</a>
                  </span>
                  ";
            echo"
              <div id=\"modal$cpnId\" class=\"modal fade\" role=\"dialog\">
                <div class=\"modal-dialog\">
                  <!-- Modal content-->
                  <div class=\"modal-content\">
                    <div class=\"modal-body\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                      <div>
                        <img class=\"img-responsive\" src=\"cpnIcon\" alt=\"\">
                        <h3 class=\"mb-20\">$cpnTitle</h3>
                        <div class=\"coupon-content\">$cpnDescription
                          $cpnStoreLinkBlock
                        </div>

                      </div>
                      <div>
                        <h6 class=\"color-mid\">Click below to get your coupon code</h6>
                        <div class=\"copy-coupon-wrap\">
                          <input type=\"text\" value=\"$cpnCode\" id=\"$cpnCode\" class=\"coupon-code\">
                        </div>
                      </div>
                    </div>
                    
                    <div class=\"modal-footer\">
                      <h4>Subscribe to Mail</h4>
                      <p>Get our Daily email newsletter with Special Services, Updates, Offers and more!</p>
                      <form id=\"mc4wp-form-2\" class=\"mc4wp-form mc4wp-form-1257\" method=\"post\" data-id=\"1257\" data-name=\"dealdots\">
                        <div class=\"mc4wp-form-fields\">
                          <div id=\"container_form_news\">
                            <div id=\"container_form_news2\">
                              <input type=\"email\" id=\"newsletter1\" name=\"EMAIL\" placeholder=\"Your email address\" required>
                              <button type=\"submit\" class=\"button subscribe\"><span>Subscribe</span></button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                   
                  </div>
                  <!-- /.modal-content -->

                </div>
              </div>

            ";
          }
        }
        else echo"
                <div class=\"blog-post outer-top-vs\">
                <h3> No Coupons Found! </h3>
                </div>
              ";
      ?>


                  
            

          </div>
          <!-- /.row --> 
        </div>
        <!-- /.category-product --> 
              
          <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">
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
                          /coupons.php?page=". (((int)($page))-1) ."
                          \">
                        <i class=\"fa fa-angle-left\"></i></a></li>";
                    }
                    for ($navPage=$pageStarts; $navPage<($pageStarts+$navRange) ; $navPage++) { 
                      $activePage = "";
                      if($navPage == $page) $activePage = "class=\"active\"";
                      echo"<li $activePage><a href=\"
                          /coupons.php?page=$navPage
                          \">$navPage</a></li>";
                    }
                  ?>
                  <li class="next">
                    <a href="
                          /coupons.php?page=<?=$page+1?>
                          ">
                      <i class="fa fa-angle-right"></i>
                    </a></li>
                </ul><!-- /.list-inline --> 
              </div><!-- /.pagination-container -->
            </div><!-- /.text-right --> 
          </div><!-- /.filters-container -->
          
</div>
      <!-- /.col --> 
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-md-3 sidebar"> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
          <div class="sidebar-module-container">
          <div class="sidebar-filter"> 

            <div class="search-area outer-bottom-small">
              <form action="coupons.php" method="GET">
                <div class="control-group">
                    <input type="text" name="searchKey" 
                    <?php echo (($searchKey=="")?"placeholder=\"Search Coupons..\"":"value=\"$searchKey\"");  ?>
                     class="search-field">
                    <input type="hidden" name="cat" value="<?=$cat?>">
                    <input type="hidden" name="subcat" value="<?=$subcat?>">
                    <input type="hidden" class="search-button" value="Search">   
                </div>
              </form>
            </div>  
          </div><!-- blog-page -->
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget outer-bottom-xs">
            <h3 class="section-title">Category</h3>
            <div class="sidebar-widget-body m-t-10">
              <div class="accordion">

                <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $catName = $catRow['name'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '$catId' AND id !=2 ");
                  if(mysqli_num_rows($subCatQ)>0 ) {
                    echo"
                      <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a href=\"#collapse$catId\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
                               $catName
                            </a>
                        </div><!-- /.accordion-heading -->
                    ";
                    echo"
                      <div class=\"accordion-body collapse\" id=\"collapse$catId\" style=\"height: 0px;\">
                            <div class=\"accordion-inner\">
                                <ul>
                    ";
                    while ($subCatRow = mysqli_fetch_assoc($subCatQ) ) {
                      $subCatId = $subCatRow['id'];
                      $subCatName = $subCatRow['name'];
                      echo"
                        <li><a href=\"coupons.php?cat=$catId&subcat=$subCatId\">$subCatName</a></li>
                      ";
                    }
                    echo"

                                </ul>
                            </div><!-- /.accordion-inner -->
                        </div><!-- /.accordion-body -->

                    ";
                    echo("
                          </div><!-- /.accordion-group -->
                    ");
                  }
                }
              ?>

              <?php
                $catQ = mysqli_query($db, "SELECT * FROM category");
                while ($catRow = mysqli_fetch_assoc( $catQ ) ) {
                  $catId = $catRow['id'];
                  $catName = $catRow['name'];
                  $subCatQ = mysqli_query($db, "SELECT * FROM subcategory WHERE category = '$catId' AND id !=2 ");
                  if(mysqli_num_rows($subCatQ)==0 ) {
                    echo"
                      <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a href=\"/coupons.php?cat=$catId\"  class=\"accordion-toggle collapsed\">
                               $catName
                            </a>
                        </div><!-- /.accordion-heading -->
                    ";
                    echo("
                          </div><!-- /.accordion-group -->
                    ");
                  }
                }
              ?>

                </div><!-- /.accordion -->
            </div><!-- /.sidebar-widget-body -->
          </div><!-- /.sidebar-widget -->
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            
            
           
          <!----------- Testimonials------------->
            <?php include("testimonials.php"); ?>
            
            <!-- ============================================== Testimonials: END ============================================== -->
            
            
          </div>
          <!-- /.sidebar-filter --> 
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidemenu-holder --> 
      <!-- ============================================== SIDEBAR : END ============================================== --> 
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
</body>
</html>