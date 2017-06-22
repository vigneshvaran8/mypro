<?php require "includes/header.php"; ?>
<?php
switch ($_GET['message'])
{
    case 'success':
        $message = 'Changes done successfully.';
        $msgClass = 'alert alert-success';
        break;
    case 'deleted':
        $message = 'Campaign deleted successfully.';
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
                    <h3>Campaign</h3>
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
                            <h2>All Campaign
                            <small>
                            <button class="btn" type="button" 
                                onclick="location.href='<?php echo ADMIN_URL.'addeditcampaign.php' ?>';">Add Campaign</button>
                            </small>
                                </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Campaign Name</th>
                                    <th>Campaign ID</th>
                                    <th>Network</th>
                                    <th>Supp File Name</th>
                                    <th>Landing Page URL</th>
                                    <th>Optout URL</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                <?php if( count(getAllcampaign()) == 0 ): ?>
                                <tr>
                                    <td colspan="8">There are no campaigns.</td>
                                </tr>
                                <?php else: ?>
                                    <?php foreach( getAllcampaign() as $campaigns ): ?>
                                        <tr>
                                        <td><?php echo $campaigns['campaign_name'] ?></td>
                                        <td><?php echo $campaigns['campaign_name_id'] ?></td>
                                        <td><?php echo getNetworknamebyid($campaigns['network_id']) ?></td>
                                        <td><?php echo $campaigns['supp_file'] ?></td>
                                        <td><?php echo $campaigns['landing_page_url'] ?></td>
                                        <td><?php echo $campaigns['optout_url'] ?></td>
                                        <td>
                                        <a href="<?php echo ADMIN_URL.'addeditcampaign.php?campaign_id='.$campaigns['campaign_id'].'' ?>">Edit</a>
                                        </td>
                                        <td>
                                        <a href="<?php echo ADMIN_URL.'delete.php?campaign_id='.$campaigns['campaign_id'].'' ?>"
                                        onclick="return confirm('Are you sure you want to delete this Campaign?');"
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
