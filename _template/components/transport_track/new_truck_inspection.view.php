 <!-- Begin New Consignment Page Content -->
 <div class="container-fluid sub-basic-setup" id="new-truck-inspection-panel">

     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Vehicle Inspection</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Content Column -->
         <div class="col-lg-12 mb-4">

             <!-- Project Card Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Inspection Details</h6>
                 </div>
                 <div class="card-body">

                     <div class="form-group row">

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Select Vehicle*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_vehicle">
                                 <option></option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Inspector Name*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_inspection_inspector_name">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Inspection Type*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_type">
                                 <option></option>
                                 <option>Routine</option>
                                 <option>Pre-trip</option>
                                 <option>Post-trip</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Odometer Reading*</label>
                             <input type="number" class="form-control form-control-user ef" id="new_inspection_odometer">
                         </div>

                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Tire Condition*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_tire_condition">
                                 <option></option>
                                 <option>Good</option>
                                 <option>Worn out</option>
                                 <option>Needs replacement</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Brake Condition*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_brake_condition">
                                 <option></option>
                                 <option>Good</option>
                                 <option>Worn out</option>
                                 <option>Needs replacement</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Lights Condition*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_light_condition">
                                 <option></option>
                                 <option>Working</option>
                                 <option>Faulty</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Engine Condition*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_engine_condition">
                                 <option></option>
                                 <option>Good</option>
                                 <option>Requires maintenance</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Fluid Levels*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_fluid_levels">
                                 <option></option>
                                 <option>Adequate</option>
                                 <option>Low</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Body Condition*</label>
                             <select class="custom-select custom-select-sm sl-form-ctrl form-control-lg" id="new_inspection_body_condition">
                                 <option></option>
                                 <option>Good</option>
                                 <option>Damage</option>
                             </select>
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Inspection Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_inspection_date">
                         </div>
                         <div class="col-sm-3 mb-3">
                             <label for="exampleFormControlInput1">Next Inspection Date*</label>
                             <input type="text" class="form-control form-control-user ef datepicker" id="new_inspection_date_next">
                         </div>
                         <div class="col-sm-12 mb-3">
                             <label for="exampleFormControlInput1">Additional Notes*</label>
                             <input type="text" class="form-control form-control-user ef" id="new_inspection_additional_notes">
                         </div>
                         <form class="col-sm-12 mb-3 user">
                             <label for="exampleFormControlInput1"></label>
                             <a class="btn btn-danger btn-user btn-block" id="btn_new_vehicle_inspection">
                                 Save Vehicle Inspection
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
                     <h6 class="m-0 font-weight-bold text-primary">Vehicle Inspection Analysis</h6>
                 </div>
                 <div class="card-body" id="display_vehicle_inspection_details">

                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /. End of New consignmentContent -->