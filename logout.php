<?php
session_start();
require 'config.php';
$_SESSION['username'] = '';
header('Location:'.SITE_URL.'login.php?message=logout');
exit();