<div class="modal fade" id="trackedShipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TRACKED SHIPMENTS</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">

          <!--<div class="col-sm-8 mb-3 mb-sm-0">
             <label for="exampleFormControlInput1">Search Main BL</label>
            <input type="text" class="form-control form-control-user ep" id="searchMainBLTracking">
            <div id='display_mainbl_tracking_search' class='div_search_box'></div>
          </div>

          <div class="col-sm-12 mb-3 mb-sm-0 pt-1">
            <button class="btn btn-success" type="button" id="btn_add_new_carrier">Search</button>
          </div> -->

            <div class="input-group mb-3">
              <input type="text" class="form-control ep" placeholder="BL# Or Container#" id="txt-tracked-shipment-container-details" aria-label="Recipient's username" aria-describedby="button-addon2">
              <div id='display_mainbl_tracking_search' class='div_search_box'></div>
              <button class="btn btn-primary" type="button" id="btn-search-container-details">Search</button>
            </div>

          </div>

          <div class="form-group row">
            <hr class="sidebar-divider my-0">
            <div class="col-lg-12 mb-4" style="height:70vh;overflow-y:scroll;" id="display_tracked_shipment_status">
              <!-- Approach -->
              <p>...Loading data</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>