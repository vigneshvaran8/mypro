<?php
include '../config.php';
include 'includes/adminfunctions.php';
if(isset($_POST))
{
    $datafilesLabel = $_POST['datafiles_label'];
    if( trim($datafilesLabel) == '' ){
        header('Location:'.ADMIN_URL.'addeditdatafiles.php?message=empty');
        exit();
    }
    if( $_POST['isp_id'] == '' ){
        header('Location:'.ADMIN_URL.'addeditdatafiles.php?message=ispempty');
        exit();
    }
    $datafilesLabel = explode("\n",$datafilesLabel);
    $datafilesLabel = json_encode($datafilesLabel);
    $datafilesData = array(
        'datafiles_label' => $datafilesLabel,
        'isp_id' => $_POST['isp_id'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
    );
    $datafilesID = '';
    if( $_POST['datafiles_id'] ){
        $datafilesID = $_POST['datafiles_id'];
        unset($datafilesData['created_at']);
    }
    saveDatafiles($datafilesData,$datafilesID);
    header('Location:'.ADMIN_URL.'datafiles.php?message=success');
    exit();
}
else
{
    header('Location:'.ADMIN_URL.'addeditdatafiles.php?message=failure');
    exit();
}