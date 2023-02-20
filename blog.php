<?php
	include("dbcon.php");
	$perPage = 5;
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
<?php
  include("header-section.php");
?>
<!-- ============================================== HEADER : END ============================================== --> 
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
		    		<li><a href="/home.php">Home</a></li>
					<li class="active"><a href="/blog.php">Blog</a></li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div>
	</div>

<div class="body-content blog-page outer-top-ts">
	<div class="container">
		<div class="row">
      <div class="col-xs-12 col-sm-12 col-md-9"> 
      	<!-- /.container -->
				<div>
					<?php
            $qstr = "
                SELECT * FROM blog 
                WHERE
                title LIKE '%$searchKey%' 
                AND category LIKE '$cat' 
                AND subcategory LIKE '$subcat' 
                ORDER BY postedon DESC
                LIMIT $offset , $perPage
              ";
              $blgQ = mysqli_query($db, $qstr);
              if($cat="%") $cat="";
              if($subcat=="%") $subcat = "";
              if(mysqli_num_rows($blgQ)>0){
              	while($blgRow=mysqli_fetch_assoc($blgQ)){
              		$blgId = $blgRow['id'];
              		$blgImg = $blgRow['cover'];
              		$blgTitle = $blgRow['title'];
              		$blgAuthorId = $blgRow['userid'];
              		$blgAuthorName="";
              		if($blgAuthorId==1){
              			//posted as guest user
              			$blgAuthorName = $blgRow['guestname'];
              		}
              		else{
              			$authorQ = mysqli_query($db, "SELECT fname FROM users WHERE id='$blgAuthorId' ");
              			if(mysqli_num_rows($authorQ)>0){
              				$authorRow = mysqli_fetch_assoc($authorQ);
              				$blgAuthorName = $authorRow['fname'];
              			}
              		}
              		$blgNumOfComments = 0;
              		$cmntQ = mysqli_query($db, "SELECT id FROM blogcomments WHERE postid='$blgId' ");
              		$blgNumOfComments = mysqli_num_rows($cmntQ);
              		$blgPostedon = $blgRow['postedon'];
              		$blgDescription = $blgRow['postbody'];
              		echo"
										<div class=\"blog-post outer-top-vs\">
											<a href=\"blog-details.php?id=$blgId\"><img class=\"img-responsive\" src=\"$blgImg\" alt=\"\"></a>
											<h1><a href=\"blog-details.php?id=$blgId\">$blgTitle</a></h1>
											<span class=\"author\">$blgAuthorName</span>
											<span class=\"review\">$blgNumOfComments</span>
											<span class=\"date-time\">$blgPostedon</span>
											<p>$blgDescription</p>
											<a href=\"/blog-details.php?id=$blgId\" class=\"btn btn-upper btn-primary read-more\">read more</a>
										</div>
									";
								}
							}
							else echo"
								<div class=\"blog-post outer-top-vs\">
								<h3> No Post Found! </h3>
								</div>
							";
					?>

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
                          /blog.php?cat=$cat&subcat=$subcat&page=". (((int)($page))-1) ."
                          \">
                        <i class=\"fa fa-angle-left\"></i></a></li>";
                    }
                    for ($navPage=$pageStarts; $navPage<($pageStarts+$navRange) ; $navPage++) { 
                      $activePage = "";
                      if($navPage == $page) $activePage = "class=\"active\"";
                      echo"<li $activePage><a href=\"
                          /blog.php?cat=$cat&subcat=$subcat&page=$navPage
                          \">$navPage</a></li>";
                    }
                  ?>
                  <li class="next">
                    <a href="
                          /blog.php?cat=<?=$cat?>&subcat=<?=$subcat?>&page=<?=$page+1?>
                          ">
                      <i class="fa fa-angle-right"></i>
                    </a></li>
                </ul><!-- /.list-inline --> 
              </div><!-- /.pagination-container -->
          	</div><!-- /.text-right --> 
					</div><!-- /.filters-container -->

				</div>
			</div><!-- col -->
            
      <!-- SIDEBAR COLUMN STARTS -->
      <?php include("blog-sidebar.php"); ?>
      <!-- SIDEBAR COLUMN ENDS -->
    </div>   
            
	</div>
        
          <!-- ============================================================= FOOTER ============================================================= -->
	<?php
	  include("footer-section.php");
	?>
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
</html>