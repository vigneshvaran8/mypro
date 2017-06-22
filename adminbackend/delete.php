<?php
include 'includes/adminfunctions.php';
/*Delete Campign*/
if( isset($_GET['campaign_id']) )
{
	deleteCampaign( $_GET['campaign_id'] );
	header('Location:'.ADMIN_URL.'campaign.php?message=deleted');
    exit();
}
/*Delete Network*/
if( isset($_GET['network_id']) )
{
    deleteNetwork( $_GET['network_id'] );
	header('Location:'.ADMIN_URL.'network.php?message=deleted');
    exit();	
}
/*Delete Server Details*/
if( isset($_GET['server_detail_id']) )
{
    deleteServer( $_GET['server_detail_id'] );
    header('Location:'.ADMIN_URL.'server.php?message=deleted');
    exit();
}
