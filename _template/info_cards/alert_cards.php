<!-- Tracked Shipment -->
<div class="col-xl-3 col-md-6 mb-4 freight_alerts" data-toggle="modal" data-target="#trackedShipment" id="logistic_tracker">
  <div class="card border-left-success shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tracked Shipment</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800" id="tracked_shipping_count">Loading...</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-pen-square fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Disbursement Analysis -->
<div class="col-xl-3 col-md-6 mb-4 freight_alerts disbursement_analysis" data-toggle="modal" <?php if ($disbursement_auth) { ?> data-target="#disbursementAnalysis" <?php } ?>>
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">disbursement analysis</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="disbursement-analysis-count">Loading...</div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Pending Manifest-->
<div class="col-xl-3 col-md-6 mb-4 freight_alerts">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Manifest</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><span>10</span></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-calendar fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4 freight_alerts">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Popup model for tracked shipment-->
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
          <div class="col-sm-12 mb-3 mb-sm-0">
            <label for="exampleFormControlInput1">Search Main BL</label>
            <input type="text" class="form-control form-control-user ep" id="searchMainBLTracking">
            <div id='display_mainbl_tracking_search' class='div_search_box'></div>
          </div>
          <div class="col-sm-12 mb-3 mb-sm-0 pt-1 sr-only">
            <button class="btn btn-success" type="button" id="btn_add_new_carrier">Add</button>
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

<?php
  fetchDisbursementAuthorisor() ?  require("_template/info_cards/unauth_disbursement_analysis_modal.php") : '';
?>