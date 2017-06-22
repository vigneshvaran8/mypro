<?php
error_reporting(1);
require 'MysqliDb.php';
require 'config.php';

//Hostname
$dbhostName = 'localhost';
//Database Username
$dbUsername = 'root';
//Database Password
$dbPassword = 'welcome';
//Database Name
$dbName = 'mailing';

$db = new MysqliDb($dbhostName, $dbUsername, $dbPassword, $dbName);
try
{
    $db->connect();
}
catch (Exception $e)
{
    echo 'Error: '.$e->getMessage();
}


