<?php $pageTitle = 'Assets'; ?>
<?php require "includes/header.php"; ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Assets</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <form id="configuration-form" action="" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="network-id">Choose Network
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="network_id" id="network-id"
                                                onchange="getCampaigninNetwork(this);" required>
                                            <option value="">Choose Network</option>
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
                            <div class="form-group" id="campaign-container" style="display: none">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="campaign-id">Campaign ID
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" onchange="getAssetsinCampaign(this);" name="campaign_id" id="campaign-id" data-live-search="true">
                                            <option value="">Choose Campaign</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="assets-data"></div>
                        </form>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
<?php require "includes/footer.php"; ?>