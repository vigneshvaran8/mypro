<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save Campaign. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
    	$message = 'Campaign Name should not be empty.';
    	$msgClass = 'alert alert-danger';
    	break;
    case 'networkempty':
        $message = 'Please choose a network.';
        $msgClass = 'alert alert-danger';
        break;    
}
$campaignData = array(
        'campaign_name' => '',
        'network_id' => '',
        'supp_file' => '',
        'landing_page_url' => '',
        'optout_url' => '',
        'unsubscribe_url' => ''
        );
if( $_GET['campaign_id'] ){
	$campaignID = $_GET['campaign_id'];
    $campaignData = getCampaigndatabyid($campaignID);
}
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            	<?php if( !$campaignID ): ?>
                <h3>Add Campaign</h3>
            	<?php else: ?>
            	<h3>Edit Campaign</h3>	
            	<?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="configuration-form" action="<?php echo ADMIN_URL.'savecampaign.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <?php if($message): ?>
                            <div class="<?php echo $msgClass ?>">
                                <?=$message?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="campaign-name">Campaign Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="campaign-name" name="campaign_name" 
                                    value="<?php echo $campaignData['campaign_name'] ?>" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="campaign-name-id">Campaign ID
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="campaign-name-id" name="campaign_name_id"
                                           value="<?php echo $campaignData['campaign_name_id'] ?>" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="network-name">Choose Network
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="network_id" id="network-name" required <?php echo (isset($campaignID)?'disabled':'') ?> >
                                        <option value="">Choose option</option>
                                    <?php if( count(getAllnetwork()) > 0 ): ?>
                                        <?php foreach( getAllnetwork() as $network ): ?>    
                                        <option value="<?php echo $network['network_id'] ?>" 
                                            <?php if( ($campaignData['network_id']) == $network['network_id'] )echo "selected"; ?> >
                                            <?php echo $network['network_name'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supp-file-name">Supp File Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="supp-file-name" name="supp_file_name" 
                                    value="<?php echo $campaignData['supp_file'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="landing-page-url">Landing Page URL</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="landing-page-url" name="landing_page_url" 
                                    value="<?php echo $campaignData['landing_page_url'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optout-url">Optout URL</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="optout-url" name="optout_url" 
                                    value="<?php echo $campaignData['optout_url'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optout-url">Unsubscribe URL</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="unsubscribe-url" name="unsubscribe_url"
                                    value="<?php echo $campaignData['unsubscribe_url'] ?>" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <?php if( $campaignID ): ?>
                            	<input type="hidden" name="network_id" value="<?= $campaignData['network_id'] ?>">
                            	<input type="hidden" name="campaign_id" value="<?= $campaignID ?>">
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