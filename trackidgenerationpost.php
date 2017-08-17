<?php
session_start();
require "connect.php";
require 'adminbackend/includes/adminfunctions.php';
require 'includes/functions.php';

if( $_POST )
{
    $employeeId = $_POST['employee_id'];
    if($employeeId == ''){
        header('Location:'.SITE_URL.'trackidgeneration.php?message=empidempty');
        exit();
    }
    $trackingDatas = $_POST;
    $trackId = trackidPost($trackingDatas);
    if($trackId){
        $_SESSION['trackid'] = $trackId;
        header('Location:'.SITE_URL.'trackidgeneration.php?message=success');
        exit();
    }
}
else{
    header('Location:'.SITE_URL.'trackidgeneration.php');
    exit();
}