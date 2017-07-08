<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save Assets. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
        $message = 'Please fill all values in form.';
        $msgClass = 'alert alert-danger';
        break;
    case 'networkempty':
        $message = 'Please choose a Network.';
        $msgClass = 'alert alert-danger';
        break;
    case 'campaignempty':
        $message = 'Please choose a Campaign.';
        $msgClass = 'alert alert-danger';
        break;
    case 'networkcampaignexists';
        $message = 'Assets already exists for that Campaign. Please choose that and update';
        $msgClass = 'alert alert-danger';
        break;
}
$assetsData = array(
    'datfiles_label' => '',
    'isp_id' => '',
);
if( $_GET['assets_id'] ){
    $assetsID = $_GET['assets_id'];
    $assetsData = getAssetsdatabyid($assetsID);
}
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php if( !$assetsID ): ?>
                        <h3>Add Assets</h3>
                    <?php else: ?>
                        <h3>Edit Assets</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form id="configuration-form" action="<?php echo ADMIN_URL.'saveassets.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                <?php if($message): ?>
                                    <div class="<?php echo $msgClass ?>">
                                        <?=$message?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" id="subject" name="subject" rows="3"
                                                  placeholder="" required><?php echo jsonTostringhtmlparse($assetsData['subject']) ?></textarea>
                                        <div class="" style="color: red">
                                            Please enter one subject per line.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from">From
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" id="from" name="from" rows="3"
                                                  placeholder="" required><?php echo jsonTostringhtmlparse($assetsData['from']) ?></textarea>
                                        <div class="" style="color: red">
                                            Please enter one from message per line.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image-name">Image Name
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" id="image-name" name="image_name" rows="3"
                                                  placeholder="" required><?php echo jsonTostringhtmlparse($assetsData['image_name']) ?></textarea>
                                        <div class="" style="color: red">
                                            Please enter one image names per line.
                                        </div>
                                    </div>
                                </div>
                                <?php if( !$assetsID ): ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="network-id">Choose Network
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="network_id" id="network-id"
                                                onchange="getCampaigninNetwork(this);" required>
                                            <option value="">Choose option</option>
                                            <?php if( count(getAllnetwork()) > 0 ): ?>
                                                <?php foreach( getAllnetwork() as $network ): ?>
                                                    <option value="<?php echo $network['network_id'] ?>"
                                                        <?php if( ($assetsData['network_id']) == $network['network_id'] )echo "selected"; ?> >
                                                        <?php echo $network['network_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php else: ?>
                                <input type="hidden" name="network_id" value="<?= $assetsData['network_id'] ?>">
                                <?php endif; ?>
                                <?php if( !$assetsID ): ?>
                                <div class="form-group" id="campaign-container" style="display: none">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="campaign-id">Choose Campaign
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="campaign_id" id="campaign-id" required>
                                            <option value="">Choose option</option>
                                        </select>
                                    </div>
                                </div>
                                <?php else: ?>
                                <input type="hidden" name="campaign_id" value="<?= $assetsData['campaign_id'] ?>">
                                <?php endif; ?>
                                <?php if( $assetsID ): ?>
                                    <input type="hidden" name="assets_id" value="<?= $assetsID ?>">
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