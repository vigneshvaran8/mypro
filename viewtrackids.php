<?php session_start(); ?>
<?php $pageTitle = 'View Track IDs'; ?>
<?php require "includes/header.php"; ?>
<link href="<?php echo SITE_URL; ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>View Track ID's</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Track ID</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Track ID</th>
                                <th>Sub ID</th>
                                <th>Landing Page URL</th>
                                <th>Optout Page URL</th>
                                <th>Unsubscribe Page URL</th>
                                <th>Created at</th>
                                <th style="display: none">Track ID Submitted Data</th>
                                <th>View Details</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAlltrackids($_SESSION['employee_id'])) == 0 ): ?>
                                <tr>
                                    <td colspan="8">There are no track ids.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAlltrackids($_SESSION['employee_id']) as $trackid ): ?>
                                    <tr>
                                        <td><?php echo $trackid['trackid'] ?></td>
                                        <td><?php echo $trackid['sub_id'] ?></td>
                                        <td><?php echo $trackid['landing_page_url'] ?></td>
                                        <td><?php echo $trackid['optout_url'] ?></td>
                                        <td><?php echo $trackid['unsubscribe_url'] ?></td>
                                        <td><?php echo date('d-m-Y H:i:s',strtotime($trackid['created_at'])) ?></td>
                                        <td style="display: none" class="here">
                                            <?=getTrackIdsubmitteddatabytrackid($trackid['trackid'])?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="showTrackIdsubmittedinfo(this);">View Details</a>
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
<script src="<?php echo SITE_URL; ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SITE_URL; ?>assets/js/dataTables.bootstrap.min.js"></script>
