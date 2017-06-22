<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save Server Details. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
        $message = 'Values should not be empty.';
        $msgClass = 'alert alert-danger';
        break;
}
$serverdetailData = array(
    'server_name' => '',
    'server_ip' => '',
    'server_username' => '',
    'server_password' => '',
    'ht_username' => '',
    'ht_password' => ''
);
if( $_GET['server_detail_id'] ){
    $serverdetailID = $_GET['server_detail_id'];
    $serverdetailData = getServerdetailbyid($serverdetailID);
}
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php if( !$serverdetailID ): ?>
                        <h3>Add Server Detail</h3>
                    <?php else: ?>
                        <h3>Edit Server</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form id="configuration-form" action="<?php echo ADMIN_URL.'saveserver.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                <?php if($message): ?>
                                    <div class="<?php echo $msgClass ?>">
                                        <?=$message?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="server-name">Server Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="server-name" name="server_name"
                                               value="<?php echo $serverdetailData['server_name'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="server-ip">Server IP
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="server-ip" name="server_ip"
                                               value="<?php echo $serverdetailData['server_ip'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="server-username">Server Username
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="server-username" name="server_username"
                                               value="<?php echo $serverdetailData['server_username'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="server-password">Server Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="server-password" name="server_password"
                                               value="<?php echo $serverdetailData['server_password'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ht-username">HT Username
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ht-username" name="ht_username"
                                               value="<?php echo $serverdetailData['ht_username'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ht-password">HT Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ht-password" name="ht_password"
                                               value="<?php echo $serverdetailData['ht_password'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <?php if( $serverdetailID ): ?>
                                    <input type="hidden" name="server_detail_id" value="<?= $serverdetailID ?>">
                                <?php endif; ?>
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