<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save Network. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
    	$message = 'Please don\'t save empty network values.';
    	$msgClass = 'alert alert-danger';
    	break;
    case 'networknameexists';
        $message = 'Network name already exists Please choose another one.';
        $msgClass = 'alert alert-danger';
        break;
}
if( $_GET['network_id'] ){
	$networkID = $_GET['network_id'];
}
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            	<?php if( !$networkID ): ?>
                <h3>Add Network</h3>
            	<?php else: ?>
            	<h3>Edit Network</h3>	
            	<?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="configuration-form" action="<?php echo ADMIN_URL.'savenetwork.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <?php if($message): ?>
                            <div class="<?php echo $msgClass ?>">
                                <?=$message?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="network-name">Network Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="network-name" name="network_name" 
                                    value="<?php echo getNetworknamebyid($networkID) ?>" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                            <?php if( $networkID ): ?>
                            	<input type="hidden" name="network_id" value="<?= $networkID ?>">
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