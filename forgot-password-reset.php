<?php
    include("dbcon.php");
    session_start();
    $currDT = time();
    if(isset($_POST['email'])&&isset($_POST['vericode'])&&isset($_POST['password'])&&isset($_POST['confirm'])){
        //reset pass
        session_destroy();
        $pass=$_POST['password'];
        $pas2=$_POST['confirm'];
        if($pass!=$pas2) $output = "

                <div id=\"page-wrapper\">
                <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-xs-12 col-md-4 col-md-offset-4\">
                        <h2 class=\"text-center\" style=\"font-size:28px;\">Hello,</h2>
                        <p class=\"text-center\">Please reset your password.</p>
                        <form action=\"forgot-password-reset.php\" method=\"post\">
                            <div class=\"alert alert-danger\">
                                <ul class=\"\">
                                    <li class=\"text-center\">New Password and Confirm Password must match</li>
                                </ul>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"password\">New Password:</label>
                                <input type=\"password\" name=\"password\" value=\"\" id=\"password\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"confirm\">Confirm Password:</label>
                                <input type=\"password\" name=\"confirm\" value=\"\" id=\"confirm\" class=\"form-control\">
                            </div>
                            <input type=\"hidden\" name=\"email\" value=\""
                            . $_POST['email'] .
                            "\">
                            <input type=\"hidden\" name=\"vericode\" value=\""
                            . $_POST['vericode'] .
                            "\">
                            <input type=\"submit\" name=\"resetPassword\" value=\"Reset\" class=\"btn btn-common log-btn\">
                        </form>
                        <br/>
                    </div>
                    </div>
                </div>
                </div>

            ";
        else{
          $output="";
          $email = $_POST['email'];
          $vericode = mysqli_real_escape_string($db, $_POST['vericode']);
          $pwdH = password_hash($pass, PASSWORD_DEFAULT);
          $pwdH = mysqli_real_escape_string($db, $pwdH);
          $uQ = "SELECT * FROM users WHERE email='$email'
            AND token = '$vericode'";
          $uR = mysqli_query($db, $uQ);
          $color = "danger";
          if(mysqli_num_rows($uR)==1){
            $updQ = "UPDATE users SET password = '$pwdH', token='' WHERE email='$email'
            AND token = '$vericode'
            ";
            if(mysqli_query($db, $updQ)) {
              $note="Password Updated";
              $color = "success";
            }
            else $note = "Something Went Wrong";
          }
          else{
            $note = "Link Expired";
            $color = "danger";
          }

            $output = "

                <div id=\"page-wrapper\">
                <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-xs-12 col-md-4 col-md-offset-4\">
                        <h2 class=\"text-center\" style=\"font-size:28px;\">Hello,</h2>
                            <div class=\"alert alert-". $color ."\">
                                <ul class=\"\">
                                    <li class=\"text-center\">". $note ."</li>
                                </ul>
                            </div>
                        <br/>
                    </div>
                    </div>
                </div>
                </div>
            ";



        }


    }
    else if(isset($_GET['email'])&&isset($_GET['vericode'])){
        $email = $_GET['email'];
        $token = $_GET['vericode'];
        //validate
        $usQ = "SELECT * FROM users WHERE email='$email' and token='$token'";
        $usR = mysqli_query($db, $usQ);
        $usRow = mysqli_fetch_array($usR, MYSQLI_ASSOC);
        if(mysqli_num_rows($usR)==1&& strtotime($usRow['token_exp'])>=$currDT){
            session_destroy();
            $output = "

                <div id=\"page-wrapper\">
                <div class=\"container\">
                    <div class=\"row\">
                    <div class=\"col-xs-12 col-md-4 col-md-offset-4\">
                        <h2 class=\"text-center\" style=\"font-size:28px;\">Hello,</h2>
                        <p class=\"text-center\">Please reset your password.</p>
                        <form action=\"forgot-password-reset.php\" method=\"post\">
                            <div class=\"form-group\">
                                <label for=\"password\">New Password:</label>
                                <input type=\"password\" name=\"password\" value=\"\" id=\"password\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"confirm\">Confirm Password:</label>
                                <input type=\"password\" name=\"confirm\" value=\"\" id=\"confirm\" class=\"form-control\">
                            </div>
                            <input type=\"hidden\" name=\"email\" value=\""
                            . $_GET['email'] .
                            "\">
                            <input type=\"hidden\" name=\"vericode\" value=\""
                            . $_GET['vericode'] .
                            "\">
                            <button type=\"submit\" name=\"resetPassword\" value=\"Reset\" class=\"btn btn-common log-btn\">RESET</button>
                        </form>
                        <br/>
                    </div>
                    </div>
                </div>
                </div>

            ";
        }
        else{
            $output = "
            <section class=\"section-padding\">
               <div class=\"container\">
                  <div class=\"row justify-content-center\">
                     <div class=\"col-lg-5 col-md-12 col-xs-12\">

                    <div class=\"alert alert-danger\">
                         The linked you clicked is not valid or expired.
                    </div>
                        </div>
                  </div>
               </div>
            </section>
            ";
        }
    }
    else{
        header("Location: /index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">

	<title>Reset Forgotten Password</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="/users/css/color_schemes/bootstrap.min.css" rel="stylesheet">
	<link href="/users/css/sb-admin.css" rel="stylesheet">
	<link href="/users/css/datatables.css" rel="stylesheet">

	<link href="/users/css/custom.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/fonts/line-icons.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/slicknav.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/nivo-lightbox.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
	<link rel="shortcut icon" type="image/png" href="/assets/favicon.png"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="/assets/js/jquery-min.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>


<style>
.nounderline{text-decoration: none !important}

@media screen and (max-width: 767px) {
body {
  padding-top: 11px;
}
}
@media screen and (min-width: 768px) and (max-width: 1199px){
body {
  padding-top: 60px;
}
}
@media screen and (min-width: 1200px){
body {
  padding-top: -80px !important;
}
}
</style>
<!-- End of bootstrap corrections -->
<style>
@media screen and (max-width: 767px) {
  body {
    padding-top: 11px;
  }
}
@media screen and (min-width: 768px) and (max-width: 1199px){
  body {
    padding-top: 60px;
  }
}
@media screen and (min-width: 1200px){
  body {
    padding-top: -80px !important;
  }
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/1.6.1/fingerprint2.min.js" integrity="sha256-goBybI2a+FUEO9n1gkRyIYOwLPq6fO8z192AxA9O54I=" crossorigin="anonymous"></script>

</head>

<body class="nav-md">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/css/bootstrap-editable.css" integrity="sha256-YsJ7Lkc/YB0+ssBKz0c0GTx0RI+BnXcKH5SpnttERaY=" crossorigin="anonymous" />
	<style>
	.editableform-loading {
	    background: url('https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/img/loading.gif') center center no-repeat !important;
	}
	.editable-clear-x {
	   background: url('https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap-editable/img/clear.png') center center no-repeat !important;
	}
	</style>

<div class="page-header">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Reset Password</h2>
               <ol class="breadcrumb">
                  <li><a href="/home.php">Home </a></li>
                  <li class="current">Reset Password</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $output; ?>
