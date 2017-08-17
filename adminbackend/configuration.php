<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes Saved Successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'empty':
        $message = 'Please enter something to save.';
        $msgClass = 'alert alert-danger';
        break;
}
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Configuration</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="configuration-form" action="<?php echo ADMIN_URL.'saveoptions.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <?php if($message): ?>
                            <div class="<?php echo $msgClass ?>">
                                <?=$message?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supp-folder-path">Supp Folder Path</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="supp-folder-path" name="supp_folder_path" value="<?php echo getOptionbykey('supp_folder_path') ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="host-server-data-file-folder-path">Host Server Data File Folder Path</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="host-server-data-file-folder-path" name="host_server_data_file_folder_path" value="<?php echo getOptionbykey('host_server_data_file_folder_path') ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="host-server-data-file-url">Host Server Data File URL</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="host-server-data-file-url" name="host_server_data_file_url" value="<?php echo getOptionbykey('host_server_data_file_url') ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destination-server-data-file-folder-path">Destination Server Data File Folder Path</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="destination-server-data-file-folder-path" name="destination_server_data_file_folder_path" value="<?php echo getOptionbykey('destination_server_data_file_folder_path') ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php require "includes/footer.php"; ?>