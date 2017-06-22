<?php
/**
 * This File contains common functions required in admin side.
 */
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

function saveNetwork($networkName, $networkID=null){
    global $db;
    $tableName = 'network';
    if( $networkID ){
        $db->where('network_id', $networkID)->update($tableName, ['network_name' => $networkName,'updated_at' => date("Y-m-d H:i:s")]);
    }
    else{
        $insertData = array(
                    "network_name"  => $networkName,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                  );
        $network = $db->insert($tableName,$insertData);
    }
    return;
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
        $db->where('campaign_id', $campaignID)
            ->update($tableName, $campaignData);
    }
    else{
        $campaign = $db->insert($tableName,$campaignData);
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

function deleteCampaign($campaignID)
{
    global $db;
    $tableName = 'campaign';
    $db->where('campaign_id', $campaignID);
    $db->delete($tableName);
    return;
}

function deleteNetwork($networkID)
{
    global $db;
    $tableName = 'network';
    $campaigns = getCampaignsinnetwork($networkID);
    if(count($campaigns) > 0)
    {
        foreach ($campaigns as $campaign)
        {
            deleteCampaign($campaign);
        }
    }
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
        $db->where('server_detail_id', $serverdetailID)
            ->update($tableName, $serverdetailData);
    }
    else{
        $serverDetail = $db->insert($tableName,$serverdetailData);
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