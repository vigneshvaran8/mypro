<?php
error_reporting(1);
set_time_limit(0);
ini_set("memory_limit",-1);
require_once __DIR__ . '/vendor/autoload.php';
require "connect.php";
require 'adminbackend/includes/adminfunctions.php';
require 'includes/functions.php';

if( $_POST )
{
	if( getOptionbykey('host_server_data_file_folder_path') == '' || getOptionbykey('supp_folder_path') == '' || 
	getOptionbykey('destination_server_data_file_folder_path') == '' ){
		header('Location:'.SITE_URL.'datasuppression.php?message=filepathempty');
    	exit();		
	}
	$from_server = $_POST['from_server'];
	$from_data_file = $_POST['from_data_file'];
	$to_server = $_POST['to_server'];
	$to_data_file = $_POST['to_data_file'];
	if( $from_data_file == '' || $to_data_file == '' ){
		header('Location:'.SITE_URL.'datatransfer.php?message=filenameempty');
    	exit();		
	}
	$fromServerdetails = getServerdetailbyid($from_server);
	$toServerdetails = getServerdetailbyid($to_server);
	if( $fromServerdetails['server_ip'] == '' || $toServerdetails['server_ip'] == '' ){
		header('Location:'.SITE_URL.'datatransfer.php?message=serverdetailempty');
    	exit();		
	}
	$ssh = new \phpseclib\Net\SSH2($toServerdetails['server_ip']);
	if (!$ssh->login($toServerdetails['server_username'], $toServerdetails['server_password'])) {
		header('Location:'.SITE_URL.'datatransfer.php?message=serverloginfailed');
		exit();
	}
	$ssh->exec('pwd');
	$destinationServerpath = getOptionbykey('destination_server_data_file_folder_path');
	$destinationServerfile = $destinationServerpath.$to_data_file;
	$tempDestinationserver = explode('/',$destinationServerpath);
	$dataFilefoldername = '';
	if( end($tempDestinationserver) != '' ){
		$dataFilefoldername = end($tempDestinationserver);
	}
	else{
		$dataFilefoldername = $tempDestinationserver[count($tempDestinationserver)-2];
	}
	$fromFileUrl = 'http://'.$fromServerdetails['ht_username'].':'.
					$fromServerdetails['ht_password'].'@'.$fromServerdetails['server_ip'].'/'.$dataFilefoldername.'/'.$to_data_file;
	$output = $ssh->exec('wget -O '.$destinationServerfile.' '.$fromFileUrl.'');
	$ssh->exec("chmod 0777 $destinationServerfile");
	if( preg_match('/saving to:.{4}([a-z0-9\.-_]*)/i', $output, $match) ){
		header('Location:'.SITE_URL.'datatransfer.php?message=success');
		exit();
	}
	else{
		header('Location:'.SITE_URL.'datatransfer.php?message=datatransferfailure');
		exit();	
	}
}
else
{
	header('Location:'.SITE_URL.'datatransfer.php');
    exit();
}