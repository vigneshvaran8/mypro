<?php
session_start();
require "../connect.php";
if( $_SESSION['username'] != '' )
{
    header('Location:'.ADMIN_URL.'dashboard.php');
    exit();
}
else{
    header('Location:'.ADMIN_URL.'login.php');
    exit();
}
