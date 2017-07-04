<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    if( trim($_POST['subject']) == '' || trim($_POST['from']) == ''
        || trim($_POST['image_name']) == ''){
        header('Location:'.ADMIN_URL.'addeditassets.php?message=empty');
        exit();
    }
    $subject = $_POST['subject'];
    $subject = explode("\n",$subject);
    $subject = json_encode($subject);
    $from = $_POST['from'];
    $from = explode("\n",$from);
    $from = json_encode($from);
    $imagename = $_POST['image_name'];
    $imagename = explode("\n",$imagename);
    $imagename = json_encode($imagename);
    $assetsData = array(
        'subject' => $subject,
        'from' => $from,
        'image_name' => $imagename,
        'network_id' => $_POST['network_id'],
        'campaign_id' => $_POST['campaign_id'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    );
    $assetsID = '';
    if( $_POST['assets_id'] ){
        $assetsID = $_POST['assets_id'];
        unset($assetsData['created_at']);
    }
    saveAssets($assetsData,$assetsID);
    header('Location:'.ADMIN_URL.'assets.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditassets.php?message=failure');
    exit();
}
