<?php
session_start();
require 'connect.php';
require 'adminbackend/includes/adminfunctions.php';
$username = $_POST['username'];
$password = $_POST['password'];
if( $username == '' || $password == '' ){
    header('Location:'.SITE_URL.'login.php?message=failure');
    exit();
}
$password = hash('sha512',$_POST['password']);
$query = "SELECT * FROM `users` WHERE `user_name`='$username' and `user_pass`='$password'";
try{
    $result = $db->query($query,1);
    if( count($result) > 0 ){
        $userId = $result[0]['user_id'];
        if(checkUsercapability($userId)){
            $userCapability = checkUsercapability($userId);
            if($userCapability === 'employee'){
            $_SESSION['username'] = $username;
            $_SESSION['userid']   = $userId;
            header('Location:'.SITE_URL.'dashboard.php');
            exit();
            }
            else{
            header('Location:'.SITE_URL.'login.php?message=denied');
            exit();
            }
        }
        else{
            header('Location:'.SITE_URL.'login.php?message=incorrect');
            exit();
        }
    }
    else{
    header('Location:'.SITE_URL.'login.php?message=incorrect');
    exit();
    }
}
catch (Exception $e){
    header('Location:'.SITE_URL.'login.php?message=exception');
    exit();
}
