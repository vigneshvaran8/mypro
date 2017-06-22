<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $options = $_POST;
    foreach ($options as $optionkey=>$optionvalue)
    {
        saveOptions($optionkey,$optionvalue);
    }
    header('Location:'.ADMIN_URL.'configuration.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'configuration.php?message=empty');
    exit();
}