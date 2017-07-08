<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'deleted':
        $message = 'Server Details deleted successfully.';
        $msgClass = 'alert alert-success';
        break;
}
if( $_SESSION['msg'] ){
    $message = $_SESSION['msg'];
    $msgClass = 'alert alert-danger';
    $_SESSION['msg'] = '';
}
?>
<link href="<?php echo ADMIN_URL; ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Server</h3>
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
                        <h2>All Server Details
                            <small>
                                <button class="btn" type="button"
                                        onclick="location.href='<?php echo ADMIN_URL.'addeditserver.php' ?>';">Add Server</button>
                            </small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Server Name</th>
                                <th>Server IP</th>
                                <th>Server Username</th>
                                <th>Server Password</th>
                                <th>HT Username</th>
                                <th>HT Password</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAllserverdetails()) == 0 ): ?>
                                <tr>
                                    <td colspan="9">There are no server details.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAllserverdetails() as $serverdetails ): ?>
                                    <tr>
                                        <td><?php echo $serverdetails['server_detail_id'] ?></td>
                                        <td><?php echo $serverdetails['server_name'] ?></td>
                                        <td><?php echo $serverdetails['server_ip'] ?></td>
                                        <td><?php echo $serverdetails['server_username'] ?></td>
                                        <td><?php echo $serverdetails['server_password'] ?></td>
                                        <td><?php echo $serverdetails['ht_username'] ?></td>
                                        <td><?php echo $serverdetails['ht_password'] ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'addeditserver.php?server_detail_id='.$serverdetails['server_detail_id'].'' ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'delete.php?server_detail_id='.$serverdetails['server_detail_id'].'' ?>"
                                               onclick="return confirm('Are you sure you want to delete this Server Details?');"
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
