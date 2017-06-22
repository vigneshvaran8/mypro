<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $serverdetailData = array(
        'server_name' => $_POST['server_name'],
        'server_ip' => $_POST['server_ip'],
        'server_username' => $_POST['server_username'],
        'server_password' => $_POST['server_password'],
        'ht_username' => $_POST['ht_username'],
        'ht_password' => $_POST['ht_password'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    );
    $serverdetailID = '';
    if( $_POST['server_detail_id'] ){
        $serverdetailID = $_POST['server_detail_id'];
        unset($serverdetailData['created_at']);
    }
    saveServer($serverdetailData,$serverdetailID);
    header('Location:'.ADMIN_URL.'server.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditserver.php?message=failure');
    exit();
}