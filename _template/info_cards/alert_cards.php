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
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Consignment</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><span>0</span></div>
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
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Overdue Consignment</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Popup model for tracked shipment-->
<?php
  require("_template/modals/tracked_shipment.view.php");
?>


<?php
  fetchDisbursementAuthorisor() ?  require("_template/info_cards/unauth_disbursement_analysis_modal.php") : '';
?>