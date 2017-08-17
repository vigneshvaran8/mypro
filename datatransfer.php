<?php $pageTitle = 'Data Transfer'; ?>
<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Data Transferred successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'serverdetailempty':        
        $message = 'Either From or To server details are empty.';
        $msgClass = 'alert alert-danger';
        break;
    case 'filenameempty':
        $message = 'File name is empty.';
        $msgClass = 'alert alert-danger';
        break;
    case 'serverloginfailed':        
        $message = 'Not able to login to the server. Please contact the admin.';
        $msgClass = 'alert alert-danger';
        break;
    case 'filepathempty':
        $message = 'Data File Path of destination server is empty. Please contact the admin.';
        $msgClass = 'alert alert-danger';
        break;
    case 'datatransferfailure':    
        $message = 'Not able to transfer file.';
        $msgClass = 'alert alert-danger';
        break;            
}
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    
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
                            <h2>Data Transfer</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <form id="configuration-form" action="<?php echo SITE_URL.'datatransferpost.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_server">From Server
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="from_server" id="from_server"
                                                onchange="fromServerChanged(this);" required>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_data_file">Data File
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="from_data_file" name="from_data_file" 
                                    value="" class="form-control col-md-7 col-xs-12" onkeyup="writetoToserverdatafile(this);" required>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_server">To Server
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="to_server" id="to_server"
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_data_file">Data File
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="to_data_file" name="to_data_file" 
                                    value="" class="form-control col-md-7 col-xs-12" readonly="">
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