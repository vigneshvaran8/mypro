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
if( $_POST['action'] == 'getDataFilesinisp' )
{
    $ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getDatafilelabelinisp($_POST['ispid']);
}
if( $_POST['action'] == 'getAssetsinCampaign' )
{
	$ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getAssetsinCampaign($_POST['campaignid']);	
}
if( $_POST['action'] == 'getNumberoflinesdatafile' )
{
	$ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getNumberoflinesdatafile($_POST['datafilelabel']);		
}
if( $_POST['action'] == 'getSuppressionfileofcampaign' )
{
	$ajaxOutput['msg'] = 'success';
    $ajaxOutput['Values'] = getSuppressionfileofcampaign($_POST['campaignid']);	
}
echo json_encode($ajaxOutput);
die();