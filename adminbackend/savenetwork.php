<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $networkName = $_POST['network_name'];
    if( trim($networkName) == '' ){
 		header('Location:'.ADMIN_URL.'addeditnetwork.php?message=empty');
    	exit();   	
    }
    $networkID = '';
    if( $_POST['network_id'] )
    	$networkID = $_POST['network_id'];
    saveNetwork($networkName,$networkID);
    header('Location:'.ADMIN_URL.'network.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditnetwork.php?message=failure');
    exit();
}