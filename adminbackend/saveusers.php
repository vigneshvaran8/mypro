<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $userName = $_POST['user_name'];
    if( trim($userName) == '' ){
        header('Location:'.ADMIN_URL.'addeditusers.php?message=empty');
        exit();
    }
    if ( preg_match('/\s/',$userName) ){
        header('Location:'.ADMIN_URL.'addeditusers.php?message=whitespace');
        exit();
    }
    if( !$_POST['user_id'] ){
        if(!checkUsernameavailable($_POST['user_name'])){
            header('Location:'.ADMIN_URL.'addeditusers.php?message=usernamenotavail');
            exit();
        }
    }
    $userData = array(
        'user_name' => $userName,
        'user_pass' => hash('sha512',$_POST['user_pass']),
        'user_email' => '',
        'user_registered' => date("Y-m-d H:i:s"),
        'user_status' => $_POST['user_status'],
        'display_name' => $_POST['display_name'],
        'user_capability' => $_POST['user_capability'],
        'employee_id' => $_POST['user_employee_id']
    );
    $userID = '';
    if( $_POST['user_id'] ){
        $userID = $_POST['user_id'];
        unset($userData['user_registered']);
        unset($userData['user_pass']);
    }
    saveUser($userData,$userID);
    header('Location:'.ADMIN_URL.'users.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditusers.php?message=failure');
    exit();
}