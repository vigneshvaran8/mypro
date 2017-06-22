<?php
session_start();
require '../config.php';
$_SESSION['username'] = '';
header('Location:'.ADMIN_URL.'login.php?message=logout');
exit();