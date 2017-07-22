<?php $pageTitle = 'Assets'; ?>
<?php include 'includes/header.php'; ?>
 
  <main class="content-wrapper">
    <article class="site-content">
 		<form class="form-validation" method="post" action="#">

            
            <div class="form-row">
                <label>
                    <span>Network Name</span>
                    <select onchange="getCampaigninNetwork(this);" name="network_id" id="network-id">
                        <option>Choose Network</option>
                        <?php if( count(getAllnetwork()) > 0 ): ?>
                            <?php foreach( getAllnetwork() as $network ): ?>    
                            <option value="<?php echo $network['network_id'] ?>" 
                                <?php if( ($campaignData['network_id']) == $network['network_id'] )echo "selected"; ?> >
                                <?php echo $network['network_name'] ?>
                            </option>
                            <?php endforeach; ?>
                        <?php endif; ?>    
                    </select>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Campaign ID</span>
                    <select onchange="getAssetsinCampaign(this);" name="campaign_id" id="campaign-id">
                        <option>Choose Campaign</option>
                    </select>
                </label>
            </div>
            <div class="assets-data">
            	
            </div>
        </form>     
    </article>
  </main>
<?php include 'includes/footer.php'; ?>