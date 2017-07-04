<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $ispName = $_POST['isp_name'];
    if( trim($ispName) == '' ){
        header('Location:'.ADMIN_URL.'addeditisp.php?message=empty');
        exit();
    }
    $ispID = '';
    if( $_POST['isp_id'] )
        $ispID = $_POST['isp_id'];
    saveIsp($ispName,$ispID);
    header('Location:'.ADMIN_URL.'isp.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditisp.php?message=failure');
    exit();
}