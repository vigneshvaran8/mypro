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
/*Delete ISP*/
if( isset($_GET['isp_id']) )
{
    deleteIsp( $_GET['isp_id'] );
    header('Location:'.ADMIN_URL.'isp.php?message=deleted');
    exit();
}
/*Delete Datafiles*/
if( isset($_GET['datafiles_id']) )
{
    deleteDatafiles( $_GET['datafiles_id'] );
    header('Location:'.ADMIN_URL.'datafiles.php?message=deleted');
    exit();
}
/*Delete Users*/
if( isset($_GET['user_id']) )
{
    deleteUser( $_GET['user_id'] );
    header('Location:'.ADMIN_URL.'users.php?message=deleted');
    exit();
}

