<?php
	include("dbcon.php");
	//for sidebar operations
	$cat="";
	$subcat="";
	$searchKey = "";
	if(isset($_GET['cat'])) $cat=$_GET['cat'];
  if(isset($_GET['subcat'])) $subcat=$_GET['subcat'];
  if(isset($_GET['searchKey'])) $searchKey = $_GET['searchKey'];
	//for sidebar operations
	$userId = 1;
	$postId = 0;
	$postCover="";
	$postTitle="";
	$postDescription="";
	$postAuthorId="";
	$postAuthorName="";
	$authorDesignation="";
	$authorDescription="";
	$postedOn="";
	$postNumOfComments=0;
	if(!isset($_GET['id']) || $_GET['id']=="" ) header("location: blog.php");
	else{
		$postId = $_GET['id'];
		$postQ = mysqli_query($db, "SELECT * FROM blog WHERE id='$postId' ");
		if(mysqli_num_rows($postQ)>0){
			$postRow = mysqli_fetch_assoc($postQ);
			$postCover= $postRow['cover'];
			$postTitle= $postRow['title'];
			$postDescription= $postRow['postbody'];
			$postAuthorId= $postRow['userid'];
			$postAuthorName= $postRow['guestname'];
			$postedOn = $postRow['postedon'];
			$postAuthorLastName="";
			if($postAuthorId!=1){
				$authorQ = mysqli_query($db, "SELECT * FROM users WHERE id='$postAuthorId' ");
  			if(mysqli_num_rows($authorQ)>0){
  				$authorRow = mysqli_fetch_assoc($authorQ);
  				$postAuthorName = $authorRow['fname'];
  				$postAuthorLastName = $authorRow['lname'];
  				$authorDesignation = $authorRow['designation'];
  				$authorDescription = $authorRow['description'];
  			}
			}
			$cmntQ = mysqli_query($db, "SELECT * FROM blogcomments WHERE postid='$postId' ORDER BY postedon DESC ");
      $postNumOfComments = mysqli_num_rows($cmntQ);
		}
		else header("location: blog.php");
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
<?php include("header-section.php"); ?>
<!-- ============================================== HEADER : END ============================================== --> 
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/home.php">Home</a></li>
				<li><a href="/blog.php">Blog</a></li>
				<li class="active"><?=$postTitle?></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div>
</div>
<div class="body-content blog-page outer-top-ts">
	<div class="container">
		<div class="row">
 			<div class="col-xs-12 col-sm-9 col-md-9"> 
        <!-- /.container -->


				<div class="blog-post wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
					<img class="img-responsive" src="<?=$postCover?>" alt="">
					<h1><?=$postTitle?></h1>
					<span class="author"><?=$postAuthorName?></span>
					<span class="review"><?=$postNumOfComments?></span>
					<span class="date-time"><?=$postedOn?></span>
					<p><?=$postDescription?></p>
					<div class="social-media">
						<span>share post:</span>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
						<a href=""><i class="fa fa-rss"></i></a>
						<a href="" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
					</div>
				</div>


<div class="blog-post-author-details wow fadeInUp" style="visibility: hidden; animation-name: none;">
	<div class="row">
		<div class="col-md-2 col-xs-12 col-sm-12">
			<img src="assets/images/testimonials/member3.png" alt="Responsive image" class="img-circle img-responsive">
		</div>
		<div class="col-md-10">
			<h4><?=$postAuthorName?> <?=$postAuthorLastName?></h4>
			<div class="btn-group author-social-network pull-right">
				<span>Follow me on</span>
			    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
			    	<i class="twitter-icon fa fa-twitter"></i>
			    	<span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    	<li><a href="#"><i class="icon fa fa-facebook"></i>Facebook</a></li>
			    	<li><a href="#"><i class="icon fa fa-linkedin"></i>Linkedin</a></li>
			    	<li><a href=""><i class="icon fa fa-pinterest"></i>Pinterst</a></li>
			    	<li><a href=""><i class="icon fa fa-rss"></i>RSS</a></li>
			    </ul>
			</div>
			<span class="author-job"><?=$authorDesignation?></span>
			<p><?=$authorDescription?></p>
		</div>
	</div>
</div>
<div class="blog-review wow fadeInUp" style="visibility: hidden; animation-name: none;">
	<div class="row" id="commentadded">
		<div class="col-md-12 col-xs-12">
			<h3 class="title-review-comments"><?=$postNumOfComments?> Comments</h3>
		</div>

		<!-- STARTS -->
		<?php
			if($postNumOfComments>0){
				while($cmtRow = mysqli_fetch_assoc($cmntQ)){
					$cmtId = $cmtRow['id'];
					$cmtUserId = $cmtRow['userid'];
					$cmtUserName = $cmtRow['guestname'];
					$cmtUserLastName = "";
					$cmtPostedOn = $cmtRow['postedon'];
					$cmtTitle = $cmtRow['title'];
					$cmtComment = $cmtRow['comment'];
					$daysAgo = floor( ( abs(time()-strtotime($cmtPostedOn)) /86400.0) );
					echo"
						<div class=\"col-md-2 col-sm-2\">
							<img src=\"assets/images/testimonials/member1.png\" alt=\"Responsive image\" class=\"img-rounded img-responsive\">
						</div>
						<div class=\"col-md-10 col-sm-10 blog-comments outer-bottom-xs\">
							<div class=\"blog-comments inner-bottom-xs\">
								<h4>$cmtUserName $cmtUserLastName</h4>
								<span class=\"review-action pull-right\">
									$daysAgo Day ago <!-- /   
									<a href=\"\"> Repost</a> /
									<a href=\"\"> Reply</a> -->
								</span>
								<p>$cmtComment</p>
							</div>
						</div>
					";
				}
			}
		?>
		<!-- /.Comment ends -->


			<!-- Comment response STARTS
			develop this feature later
			Include this on div
			before closing class="col-md-10 col-sm-10 blog-comments outer-bottom-xs"
			in every comment
			 -->
			<!--
			<div class="blog-comments-responce outer-top-xs ">
				<div class="row">
					<div class="col-md-2 col-sm-2">
						<img src="assets/images/testimonials/member2.png" alt="Responsive image" class="img-rounded img-responsive">
					</div>
					<div class="col-md-10 col-sm-10 outer-bottom-xs">
						<div class="blog-sub-comments inner-bottom-xs">
							<h4>Sarah Smith</h4>
							<span class="review-action pull-right">
								03 Day ago /   
								<a href=""> Repost</a> /
								<a href=""> Reply</a>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<img src="assets/images/testimonials/member3.png" alt="Responsive image" class="img-rounded img-responsive">
					</div>
					<div class="col-md-10 col-sm-10">
						<div class=" inner-bottom-xs">
							<h4>Stephen</h4>
							<span class="review-action pull-right">
								03 Day ago /   
								<a href=""> Repost</a> /
								<a href=""> Reply</a>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
						</div>
					</div>
				</div>
			</div>
			-->
			<!--Comment response ENDS -->


		

		<!-- <div class="post-load-more col-md-12"><a class="btn btn-upper btn-primary" href="#">Load more</a></div> -->

	</div>

</div>					
<div class="blog-write-comment outer-bottom-xs outer-top-vs">
	<div class="row">
		<div class="col-md-12">
			<h4>Leave A Comment</h4>
		</div>
		<div class="col-md-4">
			<form class="register-form" role="form" id="addComment">
				<input type="hidden" name="userId" id="userId" value="<?=$userId?>">
				<input type="hidden" name="postId" id="postId" value="<?=$postId?>">
				<div class="form-group">
			    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
			    <input name="name" type="text" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="" required>
			  </div>
				<div class="form-group">
			    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
			    <input name="email" type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="" required>
			  </div>
				<div class="form-group">
			    <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
			    <input name="title" type="text" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="" required>
			  </div>
				<div class="form-group">
			    <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
			    <textarea name="comment" class="form-control unicase-form-control" id="exampleInputComments" required></textarea>
			  </div>
				<div class="col-md-12  m-t-20">
					<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
				</div>
			</form>
		</div>
  </div>
</div>
</div>
            
			<?php include("blog-sidebar.php"); ?>
          
       </div>
       </div>
       </div>     
	
   


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
  <script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#addComment").submit(function(event) {
      event.preventDefault();
      postId = $('#postId').val();
      userId = $('#userId').val();
      name = $('#exampleInputName').val();
      title = $('#exampleInputTitle').val();
      email = $('#exampleInputEmail1').val();
      description = $('#exampleInputComments').val();
      $.ajax({
        url: "add-comment.php",
        method:"POST",
        data:{
		      postId : postId,
		      userId : userId,
		      name : name,
		      title : title,
		      email : email,
		      description : description
        },
        success:function(data){
          if(data!="ok") alert("someting went wrong");
          else{
	          $("#commentadded").append("<div id='newcommentadded' class='col-md-2 col-sm-2'><img src=\"assets/images/testimonials/member1.png\" alt=\"Responsive image\" class=\"img-rounded img-responsive\"></div><div class=\"col-md-10 col-sm-10 blog-comments outer-bottom-xs\"><div class=\"blog-comments inner-bottom-xs\"><h4>"+name+"</h4><span class=\"review-action pull-right\">0 Day ago <!-- /<a href=\"\"> Repost</a> /<a href=\"\"> Reply</a> --></span><p>"+description+"</p></div>			</div>");
	          $('#exampleInputName').val("");
      			$('#exampleInputTitle').val("");
    				$('#exampleInputEmail1').val("");
      			$('#exampleInputComments').val("");

	          $([document.documentElement, document.body]).animate({
	            scrollTop: $("#newcommentadded").offset().top
	          }, 900);
      		}
        }
      });
    });
  </script>
</body>
</html>