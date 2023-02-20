<?php
	include("dbcon.php");
	$successMsg="";
	if(isset($_POST['snbutton']) && $_POST['snbutton']=="sbmt"){
		$email = mysqli_real_escape_string($db, $_POST['email'] );
		$name = mysqli_real_escape_string($db,$_POST['name']);
		$address = mysqli_real_escape_string($db,$_POST['address']);
		$org = mysqli_real_escape_string($db,$_POST['organization']);
		$isowner = mysqli_real_escape_string($db,$_POST['isowner']);
		$business = mysqli_real_escape_string($db,$_POST['business']);
		$otherbusiness = mysqli_real_escape_string($db,$_POST['otherbusiness']);
		if($otherbusiness!="") $business = $otherbusiness;
		$qstr = "INSERT INTO comingsoonform
			(email, name, address, organization, isowner, category)
			VALUES
			('$email', '$name', '$address', '$org', '$isowner', '$business')
		";
		if(mysqli_query($db, $qstr)) $successMsg = '<p class="text title-tag-line" style="font-size: 20px; font-weight: 600">Thanks for Submitting!</p>';
		else $successMsg = '<p class="text title-tag-line" style="font-size: 20px; font-weight: 600"> Submission Failed! </p>';
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
<title>POBO - Coming Soon</title>

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
<!-- ============================================== HEADER : END ============================================== --> 

<div class="body-content outer-top-ts">

	<!--BANNER STARTS -->

	<div class="wide-banners wow fadeInUp outer-bottom-bs animated" style="max-width: 550px; margin: auto">
    <div class="row">

      <!--WIDE BANNER ITEM STARTS-->

      <div class="col-md-12">
        <div class="cnt-strip">
          <div class="image1">
              <img class="img-responsive" src="/assets/images/pobo-for-landing-page.jpeg" alt="">
          </div>
          <!-- texts and labels

          <div class="strip strip-text">
            <div class="strip-inner">
              <h2 class="text-right">bigtext<br>
                <span class="shopping-needs">smalltext</span></h2>
            </div>
          </div>
          <div class="new-label">
            <div class="text">LABEL</div>
          </div> <\!-- /.new-label --\> 
        -->
        </div> <!-- /.wide-banner --> 
      </div><!-- /.col -->
    
			<!--WIDE BANNER ITEM ENDS-->

		</div><!-- /.row --> 
	</div>

	<!--BANNER ENDS -->

	<br><br>
	<div class="container" style="max-width: 800px">
    <div class="row">
			<div class="col-md-12"> 

      <div class="sign-in-page">
			<div class="row" style="margin: 0 auto; width: 80%;">

				<!-- create a new account -->
				<div class="create-new-account" style="margin:auto; width: 100%;">
					<?=$successMsg?>
					<h1 class="checkout-subtitle">
						Product Of Black Origin (POBO) registration
					</h1>
					<p class="coming-soon-subtitle" style="font-size: 19px; color: black">
						POBO is the new marketplace for all of your black owned products. Website & App launching Aug 20. If you own a black run business then sign up below.
					</p>
					<form class="register-form outer-top-xs" role="form" method="POST">
						<div class="form-group">
					    	<label class="info-title" for="email">Email Address <span>*</span></label>
					    	<input name="email" type="email" class="form-control unicase-form-control text-input" id="email" placeholder="Your email" required>
					  	</div>
				        <div class="form-group">
						    <label class="info-title" for="name">Name <span>*</span></label>
						    <input name="name" type="text" class="form-control unicase-form-control text-input" id="name" placeholder="Your name" required>
						</div>
				    <div class="form-group">
					    <label class="info-title" for="address">Address <span>*</span></label>
					    <input  name="address" type="text" class="form-control unicase-form-control text-input" id="address" placeholder="Your address" required>
						</div>
				    <div class="form-group">
					    <label class="info-title" for="organization">Organization <span>*</span></label>
					    <input name="organization" type="text" class="form-control unicase-form-control text-input" id="organization" placeholder="Your rganization" required>
						</div>
				    <div class="form-group">
					    <label class="info-title" for="isowner">Are you the owner of the business or product? <span>*</span></label>
					    <br>
					    <label>
					    	<input type="radio" id="owneryes" value="yes" name="isowner" required>&nbsp;Yes
					    </label>
					    <br>
					    <input type="radio" id="ownerno" value="no" name="isowner">
					    <label for="ownerno">&nbsp;No</label>
					    <br>
					    <input type="radio" id="ownerother" value="other" name="isowner">
					    <label for="ownerother">&nbsp;Other</label>
					  </div>
				    <div class="form-group">
					    <label class="info-title">Business category <span>*</span></label>
					    <br>
					    <label><input type="radio" value="Food and Drinks" name="business" required>&nbsp;Food and Drinks</label>
					    <br>
					    <label>
					    <input type="radio" value="Fashion & Clothing" name="business" required>&nbsp;Fashion & Clothing</label>
					    <br>
					    <label>
					    <input type="radio" value="Finance and Banking" name="business" required>&nbsp;Finance and Banking</label>
					    <br>
					    <label>
					    <input type="radio" value="Entertainment and Hospitality" name="business" required>&nbsp;Entertainment and Hospitality</label>
					    <br>
					    <label>
					    <input type="radio" value="Services and Supplies" name="business" required>&nbsp;Services and Supplies</label>
					    <br>
					    <label>
					    <input type="radio" value="Decoration and furnishing" name="business" required>&nbsp;Decoration and furnishing</label>
					    <br>
					    <label>
					    <input type="radio" value="Printing and Publishing" name="business" required>&nbsp;Printing and Publishing</label>
					    <br>
					    <label>
					    <input type="radio" value="Beauty and Cosmetics" name="business" required>&nbsp;Beauty and Cosmetics</label>
					    <br>
					    <label>
					    <input type="radio" value="Music and Movies" name="business" required>&nbsp;Music and Movies</label>
					    <br>
					    <label>
					    <input type="radio" value="other" name="business" required>&nbsp;Other&nbsp;</label>
					    <input type="text" name="otherbusiness" size="60">
					  </div>
				    <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">I am happy to join POBO upon launching <span>*</span></label>
					    <br>
					    <input type="checkbox" value="yes" required>
					    <label for="">&nbsp;Yes&nbsp;</label>
						</div>


					  	<button name="snbutton" value="sbmt" type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit</button>
					</form>
				</div><!-- create a new account -->			
			</div><!-- /.row -->
		</div>
        
</div>
</div>
</div>
  

<!-- ============================================================= FOOTER : END============================================================= --> 
  

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="assets/js/jquery-1.11.1.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script> 
<script src="assets/js/bootstrap-select.min.js"></script> 
</body>
</html>