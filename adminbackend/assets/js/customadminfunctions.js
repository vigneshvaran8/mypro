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
            url : ajax_url,
            type: 'POST',
            dataType: 'json',
            data: jQuery.parseJSON(dataParams),
            success: function (data) {
                if(data.msg == 'success') {
                    if(data.Values == '' || data.Values == undefined){
                        jQuery('#network-name').val('');
                        jQuery('#campaign-container').css('display','none');
                        alert('There are no campaigns in that network please choose another one.');
                        return false;
                    }
                    jQuery('#campaign-container').css('display','block');
                    var campaignOptions = "";
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
function showTrackIdsubmittedinfo(e) {
    var newTr = '<tr><td colspan="8">'+jQuery(e).closest('td').prev('td').html()+'</td></tr>';
    jQuery(newTr).insertAfter(jQuery(e).closest('tr'));
    jQuery(e).closest('td').html('<a href="javascript:void(0)" onclick="hideTrackIdsubmittedinfo(this);">Hide Details</a>');
}
function hideTrackIdsubmittedinfo(e) {
    jQuery(e).closest('tr').next().remove();
    jQuery(e).closest('td').html('<a href="javascript:void(0)" onclick="showTrackIdsubmittedinfo(this);">View Details</a>');
}
