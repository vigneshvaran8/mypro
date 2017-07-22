<?php
session_start();
require "connect.php";
if( $_SESSION['username'] != '' )
{
    header('Location:'.SITE_URL.'dashboard.php');
    exit();
}
else{
    header('Location:'.SITE_URL.'login.php');
    exit();
}
