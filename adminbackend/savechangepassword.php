<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $userId = $_POST['user_id'];
    if( $userId == '' ){
        header('Location:'.ADMIN_URL.'users.php?message=useridempty');
        exit();
    }
    $userData = array(
        'user_pass' => hash('sha512',$_POST['user_pass']),
    );
    changePassword($userData,$userId);
    header('Location:'.ADMIN_URL.'users.php?message=passchangesuccess');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'users.php?message=failure');
    exit();
}