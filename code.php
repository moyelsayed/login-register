<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';



function sendemail_verify($name,$email,$verify_token)
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
    $mail->Subject = 'Email verification to My Login System';
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




if(isset($_POST['register_btn'])){
    $name= $_POST['name'];
    $phone= $_POST['phone'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $conpass=$_POST['confirm_password'];
    $verify_token=md5(rand());




    //Email exist or not 
    $check_email_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con,$check_email_query);
    
    if(mysqli_num_rows($check_email_query_run) > 0 ){

        $_SESSION['status']="Email id already exists";
        header("location: register.php");
    }
    else{
        $query="INSERT INTO users (	name,phone,email,password,verify_token) VALUES ('$name','$phone','$email','$password','$verify_token')";
        $query_run = mysqli_query($con,$query);
        if($query_run){
            sendemail_verify("$name","$email","$verify_token");

            $_SESSION['status']="Registration sucsessfull , Please verify your Email Address ";
            header("location: register.php");

        }
        else{
            $_SESSION['status']="Registration Faild";
            header("location: register.php");
        }
    }



}



?>