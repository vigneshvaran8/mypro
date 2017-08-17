<?php $pageTitle = 'Mailing Interface'; ?>
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
                            <h2>Mailing Interface</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <form id="configuration-form" action="<?php echo SITE_URL.'saveassets.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="suppression_file">Suppression File
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="suppression_file" name="suppression_file" 
                                    value="" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="server_name">Server Name
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="server_name" id="server_name"
                                            required>
                                        <option value="">Choose Server</option>
                                        <?php if( count(getAllserverdetails()) > 0 ): ?>
                                            <?php foreach( getAllserverdetails() as $server ): ?>    
                                            <option value="<?php echo $server['server_detail_id'] ?>">
                                                <?php echo $server['server_name'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isp_id">Choose ISP
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="isp_id" id="isp_id" required <?php echo (isset($datafilesID)?'disabled':'') ?> onchange="getDataFilesinisp(this);">
                                        <option value="">Choose option</option>
                                        <?php if( count(getAllisp()) > 0 ): ?>
                                            <?php foreach( getAllisp() as $isp ): ?>
                                                <option value="<?php echo $isp['isp_id'] ?>">
                                                    <?php echo $isp['isp_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="datafile-container" style="display: none">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="datafile">Data File
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="datafile" id="datafile" data-live-search="true">
                                        <option value="">Choose Data File</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="output_suppression_file_name">Output File
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="output_suppression_file_name" name="output_suppression_file_name" 
                                    value="" class="form-control col-md-7 col-xs-12" required>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
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