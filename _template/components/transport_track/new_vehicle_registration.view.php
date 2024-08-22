 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-vehicle-reegistration-panel">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">New Vehicle Registration</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle Details</h6>
      </div>
      <div class="card-body">
        
        <div class="form-group row">

          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Brand*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_brand">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Model*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_model">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Year*</label>
            <input type="text" min="1900" max="2100" step="1" placeholder="YYYY" class="form-control form-control-user ef" id="new_vehicle_year">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">License Plate*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_license_plate">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">VIN*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_vin">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Cost Of Vehicle*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_cost">
          </div>
          
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Amount Paid*</label>
            <input type="text" class="form-control form-control-user ef" id="new_vehicle_amount_paid">
          </div>
          <div class="col-sm-3 mb-3">
            <label for="exampleFormControlInput1">Credit Account*</label>
            <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_vehicle_credit_account">
              <option></option>
            </select>
          </div>
          <form class="col-sm-4 mb-3 user">
            <label for="exampleFormControlInput1"></label>
            <a class="btn btn-warning btn-user btn-block" id="btn_new_vehicle_registration">
              Add New Vehicle
            </a>
          </form>

        </div>
      </div>
    </div>

  </div>

  <div class="col-lg-12 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registered Vehicles</h6>
      </div>
      <div class="card-body" id="display_registered_vehicles">

      </div>
    </div>
  </div>
</div>

</div>
<!-- /. End of New consignmentContent -->