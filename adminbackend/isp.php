<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'deleted':
        $message = 'ISP deleted successfully.';
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
                <h3>ISP</h3>
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
                        <h2>All ISP
                            <small>
                                <button class="btn" type="button"
                                        onclick="location.href='<?php echo ADMIN_URL.'addeditisp.php' ?>';">Add ISP</button>
                            </small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ISP</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAllisp()) == 0 ): ?>
                                <tr>
                                    <td colspan="4">There are no ISP's</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAllisp() as $isp ): ?>
                                    <tr>
                                        <td><?php echo $isp['isp_id']; ?></td>
                                        <td><?php echo $isp['isp_name']; ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'addeditisp.php?isp_id='.$isp['isp_id'].'' ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'delete.php?isp_id='.$isp['isp_id'].'' ?>"
                                               onclick="return confirm('Are you sure you want to delete this ISP and its related datafiles?');"
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
