<?php
include '../adminbackend/includes/adminfunctions.php';
include 'functions.php';
$ajaxOutput = [];
$ajaxOutput['msg'] = '';
if( $_POST['action'] == 'getCampaigninNetwork' )
{
    $ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getCampaignsIDandNameinnetwork($_POST['networkid']);
}
if( $_POST['action'] == 'getAssetsinCampaign' )
{
	$ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getAssetsinCampaign($_POST['campaignid']);	
}
echo json_encode($ajaxOutput);
die();