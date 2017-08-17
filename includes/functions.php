<?php
/**
 * This File contains common functions required.
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/mailing/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/mailing/adminbackend/includes/adminfunctions.php');
global $db;

function getAssetsinCampaign($campaignId)
{
	global $db;
    $tableName = 'assets';
    $db->where("campaign_id", $campaignId);
    $assets = $db->getOne ($tableName);
    $output = '';
    if( $assets ){
    	$output .= '<table class="table">';
    	$output .= '<tr class="row1">';
    	$output .= '<td class="col1">Campaign ID</td>';
    	$output .= '<td>'.getCampaignIdnamebycampaignId($assets['campaign_id']).'</td>';
    	$output .= '</tr>';
    	$output .= '<tr class="row2">';
    	$output .= '<td class="col1">Campaign Name</td>';
    	$output .= '<td>'.getCampaignnamebyid($assets['campaign_id']).'</td>';
    	$output .= '</tr>';
    	$output .= '<tr class="row3">';
    	$output .= '<td class="col1">Subject</td>';
    	$output .= '<td>'.nl2br(jsonTostringhtmlparse($assets['subject'])).'</td>';
    	$output .= '</tr>';
    	$output .= '<tr class="row4">';
    	$output .= '<td class="col1">From</td>';
    	$output .= '<td>'.nl2br(jsonTostringhtmlparse($assets['from'])).'</td>';
    	$output .= '</tr>';
    	$output .= '<tr class="row5">';
    	$output .= '<td class="col1">Images</td>';
    	$output .= '<td>'.nl2br(jsonTostringhtmlparse($assets['image_name'])).'</td>';
    	$output .= '</tr>';
    	$output .= '</table>';
    }	
    else{
        $output .= '<table class="table">';
    	$output .= '<tr colspan="2"><td>There are no assets for this Campaign.</td></tr>';
        $output .= '</table>';
    }
    return $output;
}

function getNumberoflinesdatafile($datafilelabel)
{
    $datafilePath = getOptionbykey('host_server_data_file_folder_path');
    $datalabelFullname = $datafilePath.$datafilelabel;
    $linecount = 0;
    $file = trim($datalabelFullname);
    if( file_exists($file) ){
        $linecount = getLinecount($file);        
    }
    else{
        $file = $file.".txt";
        if( file_exists($file) )
        $linecount = getLinecount($file);
    }
    return $linecount;
}

function getLinecount($fileName)
{
    $nooflines = 0;
    $handle = fopen($fileName, "r");
    while(!feof($handle)){
      $line = fgets($handle);
      $nooflines++;
    }
    fclose($handle);
    if( $nooflines > 0 )$nooflines = $nooflines - 1;
    return $nooflines;
}

function getSuppressionfileofcampaign($campaignId)
{
    $campaignData = getCampaigndatabyid($campaignId);
    return $campaignData['supp_file'];
}