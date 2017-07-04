<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'failure':
        $message = 'Not able to save Datafiles. Please try again later.';
        $msgClass = 'alert alert-danger';
        break;
    case 'empty':
        $message = 'Datafiles should not be empty.';
        $msgClass = 'alert alert-danger';
        break;
    case 'ispempty':
        $message = 'Please choose a ISP.';
        $msgClass = 'alert alert-danger';
        break;
}
$datafilesData = array(
    'datfiles_label' => '',
    'isp_id' => '',
);
if( $_GET['datafiles_id'] ){
    $datafilesID = $_GET['datafiles_id'];
    $datafilesData = getIspdatabyid($datafilesID);
}
?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php if( !$datafilesID ): ?>
                        <h3>Add Datafiles</h3>
                    <?php else: ?>
                        <h3>Edit Datafiles</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form id="configuration-form" action="<?php echo ADMIN_URL.'savedatafiles.php' ?>" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                <?php if($message): ?>
                                    <div class="<?php echo $msgClass ?>">
                                        <?=$message?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="datafiles-label">Datafiles Label
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control" id="datafiles-label" name="datafiles_label" rows="3"
                                                  placeholder="" required><?php echo jsonTostringhtmlparse($datafilesData['datafiles_label']) ?></textarea>
                                        <div class="" style="color: red">
                                            Please enter one datalabel per line.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isp-id">Choose ISP
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="isp_id" id="isp-id" required>
                                            <option value="">Choose option</option>
                                            <?php if( count(getAllisp()) > 0 ): ?>
                                                <?php foreach( getAllisp() as $isp ): ?>
                                                    <option value="<?php echo $isp['isp_id'] ?>"
                                                        <?php if( ($datafilesData['isp_id']) == $isp['isp_id'] )echo "selected"; ?> >
                                                        <?php echo $isp['isp_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if( $datafilesID ): ?>
                                    <input type="hidden" name="datafiles_id" value="<?= $datafilesID ?>">
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