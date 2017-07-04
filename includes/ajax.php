<?php
include '../adminbackend/includes/adminfunctions.php';
$ajaxOutput = [];
$ajaxOutput['msg'] = '';
if( $_POST['action'] == 'getCampaigninNetwork' )
{
    $ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getCampaignsIDandNameinnetwork($_POST['networkid']);
}
echo json_encode($ajaxOutput);
die();