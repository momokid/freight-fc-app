 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-truck-incident-panel">


     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Vehicle Incident Register</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Content Column -->
         <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Incident Details</h6>
                 </div>
                 <div class="card-body">

                     <div class="form-group row">

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Vehicle*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_incident_vehicle">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Driver*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_incident_driver">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Incident Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_incident_date">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Incident Type*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_incident_type">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Location*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_incident_location">
                         </div>
                         <div class="col-sm-6 mb-3">
                             <label for="exampleFormControlInput1">Description*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_incident_description">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Damage Estimation*</label>
                             <input type="number" class="form-control form-control-user ef" id="new_incident_damage_estimate">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Resolution Status*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_incident_resolution_status">
                                 <option></option>
                                 <option>Resolved</option>
                                 <option>Pending</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Resolution Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_incident_resolution_date">
                         </div>
                         <div class="col-sm-6 mb-3">
                             <label for="exampleFormControlInput1">Notes*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_incident_notes">
                         </div>
                         <form class="col-sm-12 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-danger btn-user btn-block" id="btn_new_cargo_incident">
                                 Save Vehicle Incident
                             </a>
                         </form>

                     </div>
                 </div>
             </div>

         </div>

         <div class="col-lg-12 mb-4 sr-only">
             <!-- Approach -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Cargo Schedules Details</h6>
                 </div>
                 <div class="card-body" id="display_cargo_schedule_trip">

                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /. End of New consignmentContent -->