var ajax_url = jQuery('#ajax-url').val();
function getCampaigninNetwork(e)
{
    var networkid = jQuery(e).find(':selected').val();
    jQuery('#campaign-container').css('display','none');
    if(networkid != ''){
        var dataParams = {};
        dataParams['action'] = 'getCampaigninNetwork';
        dataParams['networkid'] = networkid;
        dataParams = JSON.stringify(dataParams);
        jQuery.ajax({
            url: ajax_url,
            type: 'POST',
            dataType: 'json',
            data: jQuery.parseJSON(dataParams),
            success: function (data) {
                if(data.msg == 'success') {
                    jQuery('.assets-data').html('');
                    if(data.Values == '' || data.Values == undefined){
                        jQuery('#network-name').val('');
                        jQuery('#campaign-container').css('display','none');
                        alert('There are no campaigns in that network please choose another one.');
                        jQuery('#campaign-id').empty();
                        jQuery('#campaign-id').append("<option value=''>Choose Campaign</option>");
                        return false;
                    }
                    jQuery('#campaign-container').css('display','block');
                    var campaignOptions = "";
                    campaignOptions += "<option value=''>Choose Campaign</option>";
                    jQuery.each( data.Values, function( key, value ) {
                        campaignOptions += "<option value='" + key + "'>" + value + "</option>";
                    });
                    jQuery('#campaign-id').empty();
                    jQuery('#campaign-id').append(campaignOptions);
                }
            }
        });
    }
}
function getAssetsinCampaign(e)
{
    var campaignid  = jQuery(e).find(':selected').val();
    var dataParams = {};
    dataParams['action'] = 'getAssetsinCampaign';
    dataParams['campaignid'] = campaignid;
    dataParams = JSON.stringify(dataParams);
    jQuery.ajax({
        url: ajax_url,
        type: 'POST',
        dataType: 'json',
        data: jQuery.parseJSON(dataParams),
        success: function(data) {
            jQuery('.assets-data').html(data.Values);
        }
    });
}