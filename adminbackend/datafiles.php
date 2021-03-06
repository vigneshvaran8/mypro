<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'deleted':
        $message = 'Data Files deleted successfully.';
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
                <h3>Data Files</h3>
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
                        <h2>All Data Files
                            <small>
                                <button class="btn" type="button"
                                        onclick="location.href='<?php echo ADMIN_URL.'addeditdatafiles.php' ?>';">Add Data Files</button>
                            </small>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>DataFiles Label</th>
                                <th>ISP</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAlldatafiles()) == 0 ): ?>
                                <tr>
                                    <td colspan="5">There are no datafiles.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAlldatafiles() as $datafiles ): ?>
                                    <tr>
                                        <td><?php echo $datafiles['datafiles_id'] ?></td>
                                        <td><?php echo jsonTostring($datafiles['datafiles_label']); ?></td>
                                        <td><?php echo getIspnamebyid($datafiles['isp_id']) ?></td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'addeditdatafiles.php?datafiles_id='.$datafiles['datafiles_id'].'' ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo ADMIN_URL.'delete.php?datafiles_id='.$datafiles['datafiles_id'].'' ?>"
                                               onclick="return confirm('Are you sure you want to delete these Datafiles?');"
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
