<?php
/**
 * This File contains common functions required.
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/mailing/connect.php');
global $db;

/**
 * @param $userId
 * @return bool || string
 */
function checkUsercapability($userId)
{
    global $db;
    $query = "SELECT * FROM `users_metadata`
                WHERE `meta_key`='user_capability' and 
                  `user_id`=$userId";
    $result = $db->query($query,1);
    if (count($result) > 0) {
        return $result[0]['meta_value'];
    } else {
        return false;
    }
}

function getUserdisplayname()
{
    global $db;
    $userId = $_SESSION['userid'];
    $query = "SELECT `display_name` FROM `users` WHERE `user_id`=$userId";
    $result = $db->query($query,1);
    if (count($result) > 0) {
        return $result[0]['display_name'];
    } else {
        return false;
    }
}

function saveOptions($optionkey, $optionvalue)
{
    global $db;
    $tableName = 'options';
    $insertData = array(
                    "option_name"  => $optionkey,
                    "option_value" => $optionvalue
                  );
    $optionId = $db->insert($tableName,$insertData);
    if(!$optionId){
        $db->where('option_name', $optionkey)->update($tableName, ['option_value' => $optionvalue]);
    }
}

function getOptionbykey($optionkey)
{
    global $db;
    $tableName = 'options';
    $db->where ("option_name", $optionkey);
    $option = $db->getOne ($tableName);
    return $option['option_value'];
}

function saveNetwork($networkName, $networkID=null)
{
    global $db;
    $tableName = 'network';
    /*if(checkNetworknamealreadyexists($networkName)){
        header('Location:'.ADMIN_URL.'addeditnetwork.php?message=networknameexists');
        exit();
    }*/
    if( $networkID ){
        $network = $db->where('network_id', $networkID)->update($tableName, ['network_name' => $networkName,'updated_at' => date("Y-m-d H:i:s")]);
    }
    else{
        $insertData = array(
                    "network_name"  => $networkName,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                  );
        $network = $db->insert($tableName,$insertData);
    }
    if( !$network ){
        $errormsg = $db->getLastError();
        $_SESSION['msg'] = $errormsg;
        header('Location:'.ADMIN_URL.'network.php?message=error');
        exit();
    }
    return;
}

function checkNetworknamealreadyexists($networkName)
{
    global $db;
    $tableName = 'network';
    $db->where("network_name", $networkName);
    $network = $db->getOne ($tableName);
    if(is_array($network)){
        return true;
    }
    else{
        return false;
    }
}

function getAllnetwork()
{
    global $db;
    $tableName = 'network';
    $network = $db->get($tableName);
    return $network;
}

function getNetworknamebyid($networkID)
{
    if( $networkID == '' )return '';
    global $db;
    $tableName = 'network';
    $db->where ("network_id", $networkID);
    $network = $db->getOne ($tableName);
    return $network['network_name'];
}

function getAllcampaign()
{
    global $db;
    $tableName = 'campaign';
    $campaign = $db->get($tableName);
    return $campaign;
}

function saveCampaign($campaignData, $campaignID=null)
{
    global $db;
    $tableName = 'campaign';
    if( $campaignID ){
        $campaign = $db->where('campaign_id', $campaignID)
                      ->update($tableName, $campaignData);
    }
    else{
        $campaign = $db->insert($tableName,$campaignData);
    }
    if( !$campaign ){
        $errormsg = $db->getLastError();
        $_SESSION['msg'] = $errormsg;
        header('Location:'.ADMIN_URL.'campaign.php?message=error');
        exit();
    }
    return;
}

function getCampaigndatabyid($campaignID)
{
    global $db;
    $tableName = 'campaign';
    $db->where("campaign_id", $campaignID);
    $campaign = $db->getOne ($tableName);
    return $campaign;
}

function getCampaignsinnetwork($networkID)
{
    global $db;
    $allCampaigns = array();
    $tableName = 'campaign';
    $db->where("network_id",$networkID);
    $campaigns = $db->get ($tableName, null, array('campaign_id'));
    if ($db->count > 0) {
        foreach ($campaigns as $campaign) {
            $allCampaigns[] = $campaign['campaign_id'];
        }
    }
    return $allCampaigns;
}

function getCampaignnamebyid($campaignID)
{
    if( $campaignID == '' )return '';
    global $db;
    $tableName = 'campaign';
    $db->where ("campaign_id", $campaignID);
    $campaign = $db->getOne ($tableName);
    return $campaign['campaign_name'];
}

function getCampaignIdnamebycampaignId($campaignID)
{
    if( $campaignID == '' )return '';
    global $db;
    $tableName = 'campaign';
    $db->where ("campaign_id", $campaignID);
    $campaign = $db->getOne ($tableName);
    return $campaign['campaign_name_id'];
}


function deleteCampaign($campaignID)
{
    global $db;
    /*Delete Related Assets with the campaign*/
    $tableName = 'assets';
    $db->where('campaign_id',$campaignID);
    $db->delete($tableName);
    /*Delete Campaign*/
    $tableName = 'campaign';
    $db->where('campaign_id', $campaignID);
    $db->delete($tableName);
    return;
}

function deleteNetwork($networkID)
{
    global $db;
    /*Delete Related Assets with the network*/
    $tableName = 'assets';
    $db->where('network_id',$networkID);
    $db->delete($tableName);
    /*Delete Related Campaigns with the network*/
    $campaigns = getCampaignsinnetwork($networkID);
    if(count($campaigns) > 0)
    {
        foreach ($campaigns as $campaign)
        {
            deleteCampaign($campaign);
        }
    }
    /*Delete Network*/
    $tableName = 'network';
    $db->where('network_id', $networkID);
    $db->delete($tableName);
    return;
}

function getAllserverdetails()
{
    global $db;
    $tableName = 'server_detail';
    $serverDetail = $db->get($tableName);
    return $serverDetail;
}

function getServerdetailbyid($serverdetailID)
{
    global $db;
    $tableName = 'server_detail';
    $db->where("server_detail_id", $serverdetailID);
    $serverDetail = $db->getOne ($tableName);
    return $serverDetail;
}

function saveServer($serverdetailData,$serverdetailID)
{
    global $db;
    $tableName = 'server_detail';
    if( $serverdetailID ){
        $serverDetail = $db->where('server_detail_id', $serverdetailID)
                            ->update($tableName, $serverdetailData);
    }
    else{
        $serverDetail = $db->insert($tableName,$serverdetailData);
    }
    if( !$serverDetail ){
        $errormsg = $db->getLastError();
        $_SESSION['msg'] = $errormsg;
        header('Location:'.ADMIN_URL.'server.php?message=error');
        exit();
    }
    return;
}

function deleteServer($serverdetailID)
{
    global $db;
    $tableName = 'server_detail';
    $db->where('server_detail_id', $serverdetailID);
    $db->delete($tableName);
    return;
}

function getAllisp()
{
    global $db;
    $tableName = 'isp';
    $isp = $db->get($tableName);
    return $isp;
}

function getIspnamebyid($ispID)
{
    if( $ispID == '' )return '';
    global $db;
    $tableName = 'isp';
    $db->where ("isp_id", $ispID);
    $isp = $db->getOne ($tableName);
    return $isp['isp_name'];
}

function saveIsp($ispName,$ispID=null)
{
    global $db;
    $tableName = 'isp';
    if( $ispID ){
        $isp = $db->where('isp_id', $ispID)->update($tableName, ['isp_name' => $ispName,'updated_at' => date("Y-m-d H:i:s")]);
    }
    else{
        $insertData = array(
            "isp_name"  => $ispName,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        );
        $isp = $db->insert($tableName,$insertData);
    }
    if( !$isp ){
        $errormsg = $db->getLastError();
        $_SESSION['msg'] = $errormsg;
        header('Location:'.ADMIN_URL.'isp.php?message=error');
        exit();
    }
    return;
}

function getAlldatafiles()
{
    global $db;
    $tableName = 'datafiles';
    $datafiles = $db->get($tableName);
    return $datafiles;
}

function getIspdatabyid($datafilesID)
{
    global $db;
    $tableName = 'datafiles';
    $db->where("datafiles_id", $datafilesID);
    $datafiles = $db->getOne ($tableName);
    return $datafiles;
}

function saveDatafiles($datafilesData,$datafilesID=null)
{
    global $db;
    $tableName = 'datafiles';
    if( $datafilesID ){
        $db->where('datafiles_id', $datafilesID)
            ->update($tableName, $datafilesData);
    }
    elseif ($updateddatafilesData = checkDuplicateispdatafilestable($datafilesData['isp_id'],$datafilesData)){
        $db->where('isp_id', $updateddatafilesData['isp_id'])
            ->update($tableName, $updateddatafilesData);
    }
    else{
        $datafiles = $db->insert($tableName,$datafilesData);
    }
    return;
}

function checkDuplicateispdatafilestable($ispId,$datafilesData)
{
    global $db;
    $tableName = 'datafiles';
    $db->where("isp_id", $ispId);
    $datafiles = $db->getOne ($tableName);
    if(is_array($datafiles)){
        $updateddatafilesLabel = array();
        $newdatafilesLabel = json_decode($datafilesData['datafiles_label']);
        $olddatafilesLabel = json_decode($datafiles['datafiles_label']);
        $updateddatafilesLabel = array_merge($olddatafilesLabel,$newdatafilesLabel);
        unset($datafilesData['datafiles_label']);
        $datafilesData['datafiles_label'] = json_encode($updateddatafilesLabel);
        return $datafilesData;
    }
    else{
        return false;
    }
}

function deleteIsp($ispID)
{
    global $db;
    $tableName = 'isp';
    $datafileId = getDatafilesinisp($ispID);
    if($datafileId != '')
    deleteDatafiles($datafileId);
    $db->where('isp_id', $ispID);
    $db->delete($tableName);
    return;
}

function getDatafilesinisp($ispID)
{
    global $db;
    $tableName = 'datafiles';
    $db->where("isp_id", $ispID);
    $datafiles = $db->getOne ($tableName);
    return $datafiles['datafiles_id'];
}

function deleteDatafiles($datafilesID)
{
    global $db;
    $tableName = 'datafiles';
    $db->where('datafiles_id', $datafilesID);
    $db->delete($tableName);
    return;
}

function get_user_meta($option,$userId)
{
    global $db;
    $tableName = 'users_metadata';
    $db->where('meta_key',$option);
    $db->where('user_id',$userId);
    $user = $db->getOne($tableName);
    return $user['meta_value'];
}

function getAllusers()
{
    global $db;
    $tableName = 'users';
    $users = $db->get($tableName);
    return $users;
}

function getUserdatabyid($userId)
{
    global $db;
    $tableName = 'users';
    $db->where("user_id", $userId);
    $user = $db->getOne($tableName);
    return $user;
}

function checkUsernameavailable($userName)
{
    global $db;
    $tableName = 'users';
    $db->where("user_name", $userName);
    $user = $db->getOne($tableName);
    if( is_array($user) )return false;
    else return true;
}

function saveUser($userData,$userId=null)
{
    global $db;
    $tableName = 'users';
    if( $userId ){
        $db->where('user_id', $userId)
            ->update($tableName, ['user_name' => $userData['user_name'],'user_status' => $userData['user_status'],'display_name' => $userData['display_name']]);
        save_user_meta('user_capability',$userData['user_capability'],$userId);
    }
    else{
        $insertData = array(
            "user_name"  => $userData['user_name'],
            "user_pass"  => $userData['user_pass'],
            "user_email" => '',
            "user_registered" => $userData['user_registered'],
            "user_status" => $_POST['user_status'],
            "display_name" => $_POST['display_name']
        );
        $user = $db->insert($tableName,$insertData);
        save_user_meta('user_capability',$userData['user_capability'],$user);
    }
    return;
}

function save_user_meta($optionkey,$optionvalue,$userId)
{
    global $db;
    $tableName = 'users_metadata';
    $data = ['meta_key'=>$optionkey,'meta_value'=>$optionvalue,'user_id'=>$userId];
    if(get_user_meta($optionkey,$userId)){
        $db->where('user_id',$userId);
        $db->where('meta_key',$optionkey);
        $db->update($tableName,$data);
    }
    else{
        $db->insert($tableName,$data);
    }
}

function deleteUser($userId)
{
    global $db;
    $tableName = 'users';
    deleteUsermeta($userId);
    $db->where('user_id', $userId);
    $db->delete($tableName);
    return;
}

function deleteUsermeta($userId)
{
    global $db;
    $tableName = 'users_metadata';
    $db->where('user_id', $userId);
    $db->delete($tableName);
    return;
}

function changePassword($userData,$userId)
{
    global $db;
    $tableName = 'users';
    if( $userId ){
        $db->where('user_id', $userId)
            ->update($tableName, ['user_pass' => $userData['user_pass']]);
    }
    return;
}

function getAllassets()
{
    global $db;
    $tableName = 'assets';
    $assets = $db->get($tableName);
    return $assets;
}

function jsonTostring($json)
{
    if($json == '')return '';
    $json = json_decode($json);
    $output = '';
    if(is_array($json)){
        foreach ($json as $item){
            $output .= $item."<br>";
        }
    }
    return $output;
}

function jsonTostringhtmlparse($json)
{
    if($json == '')return '';
    $json = json_decode($json);
    $json = array_filter($json,'trim');
    $output = '';
    foreach ($json as $item){
        $output .= "\n".$item;
    }
    return htmlspecialchars($output);
}


function getAssetsdatabyid($assetsID)
{
    global $db;
    $tableName = 'assets';
    $db->where("assets_id", $assetsID);
    $assets = $db->getOne ($tableName);
    return $assets;
}

function getCampaignsIDandNameinnetwork($networkID)
{
    global $db;
    $allCampaigns = array();
    $tableName = 'campaign';
    $db->where("network_id",$networkID);
    $campaigns = $db->get ($tableName, null, array('campaign_id','campaign_name','campaign_name_id'));
    if ($db->count > 0) {
        foreach ($campaigns as $campaign) {
            $allCampaigns[$campaign['campaign_id']] = $campaign['campaign_name_id'].'( '.
                    $campaign['campaign_name'].' )';
        }
    }
    return $allCampaigns;
}

function saveAssets($assetsData,$assetsID)
{
    global $db;
    $tableName = 'assets';
    if( $assetsID ){
        $db->where('assets_id', $assetsID)
            ->update($tableName, $assetsData);
    }
    elseif ($updateddatafilesData = checkNetworkCampaignexistsalreadyAssets($assetsData)){
        header('Location:'.ADMIN_URL.'addeditassets.php?message=networkcampaignexists');
        exit();
    }
    else{
        $assets = $db->insert($tableName,$assetsData);
    }
    return;
}

function checkNetworkCampaignexistsalreadyAssets($assetsData)
{
    global $db;
    $tableName = 'assets';
    $db->where("network_id", $assetsData['network_id']);
    $db->where("campaign_id", $assetsData['campaign_id']);
    $assets = $db->getOne ($tableName);
    if(is_array($assets)){
        return true;
    }
    else{
        return false;
    }
}

function deleteAssests($assetsId)
{
    global $db;
    $tableName = 'assets';
    $db->where('assets_id', $assetsId);
    $db->delete($tableName);
    return;
}

