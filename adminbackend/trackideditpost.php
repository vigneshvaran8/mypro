<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $updateDatas = $_POST;
    updateTrackid($updateDatas);
    header('Location:'.ADMIN_URL.'viewtrackids.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'viewtrackids.php?message=failure');
    exit();
}