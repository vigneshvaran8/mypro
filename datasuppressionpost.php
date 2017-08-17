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
	if( $_POST['output_suppression_file_name'] == '' ){
		header('Location:'.SITE_URL.'datasuppression.php?message=outputfileempty');
    	exit();	
	}
	if( getOptionbykey('host_server_data_file_folder_path') == '' || getOptionbykey('supp_folder_path') == '' || 
	getOptionbykey('destination_server_data_file_folder_path') == '' ){
		header('Location:'.SITE_URL.'datasuppression.php?message=filepathempty');
    	exit();		
	}
	$network_id = $_POST['network_id'];
	$campaign_id = $_POST['campaign_id'];
	$suppression_file = trim($_POST['suppression_file']);
	$serverId = $_POST['server_name'];
	if( $serverId == '' ){
		header('Location:'.SITE_URL.'datasuppression.php?message=serverempty');
    	exit();			
	}
	$server = getServerdetailbyid($serverId);
	$isp_id = $_POST['isp_id'];
	$datafile = trim($_POST['datafile']);
	$output_suppression_file_name = trim($_POST['output_suppression_file_name']);
	$completedestinationOutputfile = getOptionbykey('destination_server_data_file_folder_path').$output_suppression_file_name;
	$completeSupressionfile = getOptionbykey('supp_folder_path').$suppression_file;
	$completeDatafile = getOptionbykey('host_server_data_file_folder_path').$datafile;
	/*Check Data File Exists and do the data compression logic and create final Email List*/
	if( file_exists($completeDatafile) && file_exists($completeSupressionfile) ){
		$suppressionContents = file_get_contents($completeSupressionfile);
		$datafileContents = file_get_contents($completeDatafile);
		$datafileLines = array_map('trim', explode(PHP_EOL,$datafileContents));
		$suppressionEmailhash = array_map('trim', explode(PHP_EOL,$suppressionContents));
		$suppressionEmailhash = array_flip($suppressionEmailhash);
		$finalEmaillist = '';
		if( is_array($datafileLines) ){
			foreach ($datafileLines as $datafilefileContent) {
				$tempdatafileContent = explode('|',$datafilefileContent);
				if( filter_var($tempdatafileContent[1],FILTER_VALIDATE_EMAIL) ){
					// if( !in_array( md5($tempdatafileContent[1]), $suppressionEmailhash) )
					if( !isset( $suppressionEmailhash[md5($tempdatafileContent[1])]) )
					{
						$finalEmaillist .= $datafilefileContent."\n";
					}
				}
			}
		}
		/*Create Email List Using SSH and wget start*/
		// if( $finalEmaillist == '' )$finalEmaillist = "\n";
		/*Create DataList Emails in our Server*/
		/*if(file_put_contents($completedestinationOutputfile, $finalEmaillist)!=false){
			$ssh = new \phpseclib\Net\SSH2($server['server_ip']);
			if (!$ssh->login($server['server_username'], $server['server_password'])) {
				unlink($completedestinationOutputfile);
			    header('Location:'.SITE_URL.'datasuppression.php?message=serverloginfailed');
	    		exit();
			}
			$ssh->exec('pwd');
			$hostdataFileurl = getOptionbykey('host_server_data_file_url').$output_suppression_file_name;
			$output = $ssh->exec('wget -O '.$completedestinationOutputfile.' '.$hostdataFileurl.'');
			if( preg_match('/saving to:.{4}([a-z0-9\.-_]*)/i', $output, $match) ){
				unlink($completedestinationOutputfile);
				header('Location:'.SITE_URL.'datasuppression.php?message=success');
	    		exit();
			}
			else{
				unlink($completedestinationOutputfile);
				header('Location:'.SITE_URL.'datasuppression.php?message=datatransferfailure');
	    		exit();	
			}
		}
		else{
			header('Location:'.SITE_URL.'datasuppression.php?message=hostfilewriteaccessdenied');
    		exit();		
		}*/
		/*Create Email List Using SSH and wget end*/
		/*Create Email List Using SSH and SCP start*/
		$ssh = new \phpseclib\Net\SSH2($server['server_ip']);
	    if ( !$ssh->login($server['server_username'], $server['server_password']) ){
	        header('Location:'.SITE_URL.'datasuppression.php?message=serverloginfailed');
	    	exit();
	    }
	    $scp = new \phpseclib\Net\SCP($ssh);
	    if($scp->put($completedestinationOutputfile, $finalEmaillist)){
	    	$ssh->exec("chmod 0777 $completedestinationOutputfile");
	    	header('Location:'.SITE_URL.'datasuppression.php?message=success');
	    	exit();
	    }
	    else{
	    	header('Location:'.SITE_URL.'datasuppression.php?message=datatransferfailure');
	    	exit();	
	    }
		/*Create Email List Using SSH and SCP end*/
	}
	else{
		header('Location:'.SITE_URL.'datasuppression.php?message=filenotexists');
    	exit();		
	}
}
else
{
	header('Location:'.SITE_URL.'datasuppression.php');
    exit();
}