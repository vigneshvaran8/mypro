<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ((isset($pageTitle)?$pageTitle:'')); ?></title>
    <?php
    require "connect.php";
    require "adminbackend/includes/adminfunctions.php";
    if(checkUsercapability($_SESSION['userid'])!= 'employee'){
        header('Location:'.SITE_URL.'login.php?message=timedout');
        exit();
    }
    ?>
    <link href="<?php echo SITE_URL; ?>assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/font-awesome.css">
</head>
<div class="site">
  <nav class="user-navigation">
        <ul>
        <li>
            Welcome,
            <strong><?= getUserdisplayname() ?></strong>
        </li>
        <li><a href="<?php echo SITE_URL.'logout.php'; ?>">Logout</a></li>
  </nav>  
  <header class="site-header">
    <h1 class="site-title"><?=$pageTitle ?></h1>
    
    <nav class="site-navigation">
      <ul>
        <li><a href="#">Data Suppression</a></li>
        <li><a href="#">Data Transfer</a></li>
        <li><a href="#">Track ID Generation</a></li>
        <li><a href="<?php echo SITE_URL.'assets.php'; ?>">Assets</a></li>
      </ul>
    </nav><!-- .site-navigation -->
  </header><!-- .site-header -->