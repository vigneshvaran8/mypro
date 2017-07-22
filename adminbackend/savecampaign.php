<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $campaignName = $_POST['campaign_name'];
    if( trim($campaignName) == '' ){
 		header('Location:'.ADMIN_URL.'addeditcampaign.php?message=empty');
    	exit();   	
    }
    if( $_POST['network_id'] == '' ){
        header('Location:'.ADMIN_URL.'addeditcampaign.php?message=networkempty');
        exit();     
    }
    $campaignData = array(
        'campaign_name' => $campaignName,
        'campaign_name_id' => $_POST['campaign_name_id'],
        'network_id' => $_POST['network_id'],
        'supp_file' => $_POST['supp_file_name'],
        'landing_page_url' => $_POST['landing_page_url'],
        'optout_url' => $_POST['optout_url'],
        'unsubscribe_url' => $_POST['unsubscribe_url'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
        );
    $campaignID = '';
    if( $_POST['campaign_id'] ){
        $campaignID = $_POST['campaign_id'];
        unset($campaignData['created_at']);
    }
    saveCampaign($campaignData,$campaignID);
    header('Location:'.ADMIN_URL.'campaign.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditnetwork.php?message=failure');
    exit();
}