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
                    jQuery('#campaign-id').selectpicker('refresh');
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
function getSuppressionfileofcampaign(e)
{
    var campaignid = jQuery(e).find(':selected').val();
    var dataParams = {};
    dataParams['action'] = 'getSuppressionfileofcampaign';
    dataParams['campaignid'] = campaignid;
    dataParams = JSON.stringify(dataParams);
    if(jQuery('#output_suppression_file_name').length){
        jQuery('#output_suppression_file_name').val('');
    }
    jQuery.ajax({
        url: ajax_url,
        type: 'POST',
        dataType: 'json',
        data: jQuery.parseJSON(dataParams),
        success: function(data) {
            if( data.Values == null || data.Values == '' ){
                jQuery('#campaign-id').val('');
                jQuery('#campaign-id').selectpicker('refresh');
                alert('There is no Supression File for the selected Campaign.');
                return;
            }
            jQuery('#suppression_file').val(data.Values);
        }
    });   
}
function getDataFilesinisp(e)
{
    var ispid = jQuery(e).find(':selected').val();
    jQuery('#datafile-container').css('display','none');
    jQuery('#datafile-lines').val(0);
    if(ispid != ''){
        var dataParams = {};
        dataParams['action'] = 'getDataFilesinisp';
        dataParams['ispid'] = ispid;
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
                        jQuery('#datafile').val('');
                        jQuery('#datafile-container').css('display','none');
                        alert('There are no data files in that isp please choose another one.');
                        jQuery('#datafile').empty();
                        jQuery('#datafile').append("<option value=''>Choose DataFile</option>");
                        return false;
                    }
                    jQuery('#datafile-container').css('display','block');
                    var campaignOptions = "";
                    campaignOptions += "<option value=''>Choose DataFile</option>";
                    jQuery.each( data.Values, function( key, value ) {
                        campaignOptions += "<option value='" + value + "'>" + value + "</option>";
                    });
                    jQuery('#datafile').empty();
                    jQuery('#datafile').append(campaignOptions);
                    jQuery('#datafile').selectpicker('refresh');
                }
            }
        });
    }
}
function fromServerChanged(e)
{
    var fromServer = jQuery(e).find(':selected').val();
    jQuery('#to_server').val('');
    if( fromServer != '' ){
        jQuery('#to_server').children().removeAttr('disabled');
        jQuery('#to_server option[value="'+fromServer+'"]').prop('disabled','disabled');
    }
}
function getNumberoflinesdatafile(e)
{
    var datafilelabel = jQuery(e).find(':selected').html();
    if(datafilelabel != ''){
        var dataParams = {};
        dataParams['action'] = 'getNumberoflinesdatafile';
        dataParams['datafilelabel'] = datafilelabel;
        dataParams = JSON.stringify(dataParams);
        jQuery.ajax({
            url: ajax_url,
            type: 'POST',
            dataType: 'json',
            data: jQuery.parseJSON(dataParams),
            success: function (data) {
                if(data.msg == 'success') {
                    jQuery('#datafile-lines').val(data.Values);
                    if( data.Values > 0 )
                    displayDatasppropfilename();
                    else
                    jQuery('#output_suppression_file_name').val('');                    
                }
            }
        });
    }
}
function displayDatasppropfilename()
{
    var datafilelabel = jQuery('#datafile').find(':selected').html();
    var campaignid = jQuery('#campaign-id').find(':selected').html();
    var employee_id = jQuery('#employee_id').val();
    var current_date = jQuery('#current_date').val();
    var output_suppression_file_name = datafilelabel+'_'+employee_id+'_'+campaignid.substring(0,campaignid.indexOf("("))+'_'+current_date;
    jQuery('#output_suppression_file_name').val(output_suppression_file_name);
}
function writetoToserverdatafile(e)
{
    jQuery('#to_data_file').val(jQuery(e).val());
}
function checkOutputdatafilematched(e) {
    var outputDatafile = jQuery(e).val();
    if( outputDatafile != '' )
    {
        var campaign = jQuery('#campaign-id').find(':selected').val();
        if (campaign == '') {
            jQuery(e).val('');
            alert('Please choose the Network and the respective Campaign before entering Output Data File.');
        }
        var campaignId = jQuery('#campaign-id').find(':selected').html();
        campaignId = campaignId.substring(0, campaignId.indexOf("("));
        var result = outputDatafile.split("_");
        if( campaignId != result[result.length - 2] ){
            jQuery(e).val('');
            alert('Output Data File you have entered not match with the Campaign ID you have selected.');
        }
    }
}
function showTrackIdsubmittedinfo(e) {
    var newTr = '<tr><td colspan="7">'+jQuery(e).closest('td').prev('td').html()+'</td></tr>';
    jQuery(newTr).insertAfter(jQuery(e).closest('tr'));
    jQuery(e).closest('td').html('<a href="javascript:void(0)" onclick="hideTrackIdsubmittedinfo(this);">Hide Details</a>');
}
function hideTrackIdsubmittedinfo(e) {
    jQuery(e).closest('tr').next().remove();
    jQuery(e).closest('td').html('<a href="javascript:void(0)" onclick="showTrackIdsubmittedinfo(this);">View Details</a>');
}