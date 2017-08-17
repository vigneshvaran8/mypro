<?php session_start(); ?>
<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
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
                <h3>View Track ID's</h3>
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
                        <h2>Track ID</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Track ID</th>
                                <th>Employee ID</th>
                                <th>Sub ID</th>
                                <th>Landing Page URL</th>
                                <th>Optout Page URL</th>
                                <th>Unsubscribe Page URL</th>
                                <th>Created at</th>
                                <th style="display: none">Track ID Submitted Data</th>
                                <th>View Details</th>
                                <th>Edit</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if( count(getAlltrackids()) == 0 ): ?>
                                <tr>
                                    <td colspan="8">There are no track ids.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach( getAlltrackids() as $trackid ): ?>
                                    <tr>
                                        <td><?php echo $trackid['trackid'] ?></td>
                                        <td><?php echo $trackid['employee_id'] ?></td>
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
                                        <td>
                                            <form name="trackidform-<?=$trackid['trackid']?>" id="trackidform-<?=$trackid['trackid']?>">
                                                <input type="hidden" name="subid" value="<?=$trackid['sub_id']?>">
                                                <input type="hidden" name="landingpageurl" value="<?=$trackid['landing_page_url']?>">
                                                <input type="hidden" name="optoutpageurl" value="<?=$trackid['optout_url']?>">
                                                <input type="hidden" name="unsubsribepageurl" value="<?=$trackid['unsubscribe_url']?>">
                                                <input type="hidden" name="trackid" value="<?=$trackid['trackid']?>">
                                            </form>
                                            <a href="javascript:void(0)" data-toggle="modal" data-formid="trackidform-<?=$trackid['trackid']?>" data-target="#trackeditModal">Edit</a>
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
<?php include('trackidedit.php'); ?>
<script type="text/javascript">
    jQuery(document).on('click', '[data-target]', function() {
        var formId = jQuery(this).attr('data-formid');
        jQuery('#subId').val('');
        jQuery('#landingpageurl').val('');
        jQuery('#optoutpageurl').val('');
        jQuery('#unsubsribepageurl').val('');
        jQuery('#trackid').val('');
        jQuery('#subId').val(jQuery('#'+formId+' input[name=subid]').val());
        jQuery('#landingpageurl').val(jQuery('#'+formId+' input[name=landingpageurl]').val());
        jQuery('#optoutpageurl').val(jQuery('#'+formId+' input[name=optoutpageurl]').val());
        jQuery('#unsubsribepageurl').val(jQuery('#'+formId+' input[name=unsubsribepageurl]').val());
        jQuery('#trackid').val(jQuery('#'+formId+' input[name=trackid]').val());
    });
</script>