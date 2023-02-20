<?php
    include("dbcon.php");
    session_start();
    session_destroy();
    if(isset($_POST['email'])) {
        $email= $_POST['email'];
        $usQ = "SELECT email FROM users WHERE email='$email'";
        $usR = mysqli_query($db, $usQ);
        if(mysqli_num_rows($usR)>0){
            $usRow=mysqli_fetch_array($usR, MYSQLI_ASSOC);
            $tok = md5(3968*2+$email);
           $substr = substr(md5(uniqid(rand(),1)),3,10);
           $token = $tok . $substr;
           $expFormat = mktime(
                date("H"), date("i")+90, date("s"), date("m") ,date("d"), date("Y")
           );
           $expDate = date("Y-m-d H:i:s",$expFormat);
           $tokenQ="UPDATE users SET token = '$token', token_exp = '$expDate' WHERE email='$email'";
            // current time date("Y-m-d H:i:s")
            if(mysqli_query($db, $tokenQ)){
                $to = $email;
                $subject = "POBO - Reset Password";
                $headers = "From: Quickon Rentals";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $txt = "
                    Hello,
                    <br>
                    You are receiving this email because a request was made to reset your password. If this was not you, you may disregard this email.
                    <br>
                    If this was you, click the link below to continue with the password reset process.
                    <br>
                    <a href=\"http://butabox.com/forgot-password-reset.php?email=$email&vericode=$token\" >Reset Password</a>
                    <br>
                    Sincerely,
                    <br>
                    -POBO Team-
                    <br>
                    <small>Please note, Password links expire in 90 minutes.</small>
                    ";

                if(mail($to,$subject,$txt,$headers)){
                    $note="Check email for password reset link.";
                }
                else{
                    $note="There is a problem with sending email.";
                }



            }
            else{
                $note="There is a problem with database update.";
            }

        }
        else {
            $note="That email does not exist in our database.";
        }
    }
    else $note="No email given.";
?>
<?php header("location: forgot-password.php?notice=$note");