<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status']="Please login to Access Userdashboard";
    header("location: login.php");
    exit(0);

}



?>