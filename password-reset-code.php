<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function send_password_reset($get_name,$get_email,$token)
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
    $mail->setFrom("midoprof92@gmail.com",$get_name);
    $mail->addAddress($get_email);     //Add a recipient
        
    
        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password to My Login System';
    $email_tempelate="
        <h2>Email to Reset Password</h2>
        <h5>Reset Your Password given link</h5>
        <br/><br/>
        <a href='http://localhost/login-system/password-change.php?token=$token'>click</a>

    ";

    $mail->Body= $email_tempelate;
    
    $mail->send();
    echo 'Message has been sent';
}

if(isset($_POST['password_reset_btn']))
{
    $email = mysqli_real_escape_string($con , $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1 ";
    $check_email_run = mysqli_query($con,$check_email);

    if(mysqli_num_rows($check_email_run) > 0 )
    {
        $row= mysqli_fetch_array($check_email_run);
        $get_name=$row['name'];
        $get_email=$row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email ='$get_email' LIMIT 1 ";
        $update_token_run = mysqli_query($con,$update_token);
        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status']="Reset Password Link has been Sent to your Email";
            header("location: password-reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status']="Something went wrong Please try again";
            header("location: password-reset.php");
            exit(0);
        }

    }
    else
    {
        $_SESSION['status']="No Email Found";
        header("location: password-reset.php");
        exit(0);
    }
}

if(isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($con , $_POST['email']);
    $new_password = mysqli_real_escape_string($con , $_POST['new-password']);
    $confirm_password = mysqli_real_escape_string($con , $_POST['confirm-password']);
    $token =  mysqli_real_escape_string($con , $_POST['pass-token']);

    if($token)
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            $check_token= "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1 ";
            $check_token_run=mysqli_query($con,$check_token);
            if(mysqli_num_rows($check_token_run) > 0 )
            {
                if($new_password == $confirm_password)
                {
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con,$update_password);

                    if($update_password_run)
                    {
                        $_SESSION['status']="New Password updated Please log in ";
                        header("location: login.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status']="Invalid Please try again";
                        header("location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                $_SESSION['status']="Passwords doesn't match";
                header("location: password-change.php?token=$token&email=$email");
                exit(0);
                }
            }
            else
            {
                $_SESSION['status']="Invalid Please try again";
                header("location: password-change.php?token=$token&email=$email");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status']="All Fields are required";
            header("location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status']="No token available";
        header("location: password-change.php?token=$token&email=$email");
        exit(0);
    }
}

?>