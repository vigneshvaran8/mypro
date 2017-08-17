<!-- line modal -->
<div class="modal fade" id="trackeditModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Edit Track ID</h3>
            </div>
            <div class="modal-body">

                <!-- content goes here -->
                <form name="trackidedit" method="post" action="<?php echo ADMIN_URL.'trackideditpost.php' ?>">
                    <div class="form-group">
                        <label for="subId">Sub ID</label>
                        <input type="text" class="form-control" id="subId" name="subId">
                    </div>
                    <div class="form-group">
                        <label for="landingpageurl">Landing Page URL</label>
                        <input type="text" class="form-control" id="landingpageurl" name="landingpageurl">
                    </div>
                    <div class="form-group">
                        <label for="optoutpageurl">Optout Page URL</label>
                        <input type="text" class="form-control" id="optoutpageurl" name="optoutpageurl">
                    </div>
                    <div class="form-group">
                        <label for="unsubsribepageurl">Unsubscribe Page URL</label>
                        <input type="text" class="form-control" id="unsubsribepageurl" name="unsubsribepageurl">
                    </div>
                    <input type="hidden" name="trackid" id="trackid" value="">
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>