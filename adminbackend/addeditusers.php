<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save User. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
        $message = 'Please don\'t save empty values.';
        $msgClass = 'alert alert-danger';
        break;
    case 'usernamenotavail':
        $message = 'The username you have chosen is not available. Please choose another one.';
        $msgClass = 'alert alert-danger';
        break;
    case 'whitespace':
        $message = 'Username should not contain any white spaces';
        $msgClass = 'alert alert-danger';
        break;
}
$userData = array(
    'user_name' => '',
    'user_pass' => '',
    'user_email' => '',
    'user_status' => '',
    'display_name' => '',
    'employee_id' => ''
);
if( $_GET['user_id'] ){
    $userID = $_GET['user_id'];
    $userData = getUserdatabyid($userID);
}

?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php if( !$userID ): ?>
                        <h3>Add User</h3>
                    <?php else: ?>
                        <h3>Edit User</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form id="configuration-form" action="<?php echo ADMIN_URL.'saveusers.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                <?php if($message): ?>
                                    <div class="<?php echo $msgClass ?>">
                                        <?=$message?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-name">User Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="user-name" name="user_name"
                                               value="<?php echo $userData['user_name'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <?php if( !$_GET['user_id'] ): ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-pass">User Password
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="user-pass" name="user_pass"
                                               value="" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="display-name">User Display Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="display-name" name="display_name"
                                               value="<?php echo $userData['display_name'] ?>" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-employee-id">User / Employee ID
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="user-employee-id" name="user_employee_id"
                                               value="<?php echo $userData['employee_id'] ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-status">User Status
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="user_status" id="user-status" required>
                                            <option value="">Choose Status</option>
                                            <option value="1" <?php echo (($userData['user_status'] === 1)?'selected':''); ?>>Active</option>
                                            <option value="0" <?php echo (($userData['user_status'] === 0)?'selected':''); ?>>Not Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-capability">User Capability
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="user_capability" id="user-capability" required>
                                            <option value="">Choose User Capability</option>
                                            <option value="administrator" <?php echo ((get_user_meta('user_capability',$userData['user_id']) === 'administrator')?'selected':''); ?>>Administrator</option>
                                            <option value="employee" <?php echo ((get_user_meta('user_capability',$userData['user_id']) === 'employee')?'selected':''); ?>>Employee</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if( $userID ): ?>
                                    <input type="hidden" name="user_id" value="<?= $userID ?>">
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