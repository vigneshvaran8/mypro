<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'deleted':
        $message = 'User deleted successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'useridempty':
        $message = 'Please choose a User ID to edit or change password.';
        $msgClass = 'alert alert-danger';
        break;
    case 'failure':
        $message = 'Not able to save changes.';
        $msgClass = 'alert alert-danger';
        break;
    case 'passchangesuccess':
        $message = 'Password changed successfully';
        $msgClass = 'alert alert-success';
        break;
}
?>
<link href="<?php echo ADMIN_URL; ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <?php if($message): ?>
                <div class="<?php echo $msgClass ?>">
                    <?=$message?>
                </div>
            <?php endif; ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Users
                            <small>
                                <button class="btn" type="button"
                                        onclick="location.href='<?php echo ADMIN_URL.'addeditusers.php' ?>';">Add Users</button>
                            </small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Display Name</th>
                                <th>Registered On</th>
                                <th>User Status</th>
                                <th>User Capability</th>
                                <th>Change Password</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAllusers()) == 0 ): ?>
                                <tr>
                                    <td colspan="8">There are no users</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAllusers() as $user ): ?>
                                    <tr>
                                        <td><?php echo $user['user_id']; ?></td>
                                        <td><?php echo $user['user_name']; ?></td>
                                        <td><?php echo $user['display_name']; ?></td>
                                        <td><?php echo date('d M y H:i:s',strtotime($user['user_registered'])); ?></td>
                                        <td><?php echo (($user['user_status'] === 1)?'Active':'Not Active'); ?></td>
                                        <td><?php echo get_user_meta('user_capability',$user['user_id']) ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'changepassword.php?user_id='.$user['user_id'].'' ?>">Change Password</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'addeditusers.php?user_id='.$user['user_id'].'' ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'delete.php?user_id='.$user['user_id'].'' ?>"
                                               onclick="return confirm('Are you sure you want to delete this User?');"
                                            >Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php require "includes/footer.php"; ?>
<script src="<?php echo ADMIN_URL; ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>assets/js/dataTables.bootstrap.min.js"></script>
