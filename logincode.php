<?php
include('dbcon.php');


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (isset($_POST['Login_now_btn']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $login_query="SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1 ";
        $login_query_run = mysqli_query($con,$login_query);

        if(mysqli_num_rows($login_query_run) > 0 )
        {
            $row = mysqli_fetch_array($login_query_run);
            if($row['verify_status'] === "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user']=[
                    'username'=> $row['name'],
                    'phone'=> $row['phone'],
                    'email'=> $row['email'],
                ];
                $_SESSION['status'] ="You are logged in Sucsessfully";
                header("location: Dashboard.php");
                exit(0);

            }
            else
            {
                $_SESSION['status'] ="Please verify email adress to login .!";
                header("location: login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] ="invalid Email or password";
            header("location: login.php");
            exit(0);
        }



    }
    else
    {
        $_SESSION['status'] ="all fields are required";
        header("location: login.php");
        exit(0);
    }
}






?>