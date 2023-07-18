<?php 
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


function resend_email_verify($name,$email,$verify_token)
{

    $mail = new PHPMailer(true);
    
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'midoprof92@gmail.com';                     //SMTP username
    $mail->Password   = 'dtlxhsszlarrxfpb';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
    $mail->setFrom("midoprof92@gmail.com",$name);
    $mail->addAddress($email);     //Add a recipient
        
    
        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend Email verification to My Login System';
    $email_tempelate="
        <h2>You have registered with my system</h2>
        <h5>Verify email address to log in given link</h5>
        <br/><br/>
        <a href='http://localhost/login-system/verifyemail.php?token=$verify_token'>click</a>

    ";

    $mail->Body= $email_tempelate;
    
    $mail->send();
    echo 'Message has been sent';    
}








if(isset($_POST['resend_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email= mysqli_real_escape_string($con,$_POST['email']);

        $checkemail_query="SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkemail_query_run=mysqli_query($con,$checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0" )
            {
                $name=$row['name'];
                $email=$row['email'];
                $verify_token=$row['verify_token'];
                resend_email_verify($name,$email,$verify_token);
                $_SESSION['status'] ="verification Email Link has been sent to your email address";
                header("location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email is already verified please log in now";
                header("location: resend-email.php");
                exit(0);

            }
        }
        else
        {
            $_SESSION['status'] = "Email is not registerd please register now";
            header("location: login.php");
            exit(0);


        }



    }
    if(empty($_POST['email']))
    {
        $_SESSION['status'] = "Please enter the email field";
        header(" location: resend-email.php");
        exit(0);
    }
}
?>