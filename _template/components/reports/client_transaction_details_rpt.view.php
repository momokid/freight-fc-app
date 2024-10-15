       <!-- Begin Cargo manifestation Content -->
       <div class="container-fluid sub-basic-setup" id="new-client-trans-details">

         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Client Transaction Details</h1>
         </div>

         <!-- Content Row -->
         <div class="row">

           <!-- Content Column -->
           <div class="col-sm-8 mb-2">
             <!-- Project Card Example -->
             <div class="card shadow mb-4">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Client Profile</h6>
               </div>
               <div class="card-body">

                 <div class="form-group row">
                   <div class="col-sm-12 mb-3 mb-sm-0">
                     <label for="exampleFormControlInput1">Client Name or TIN#</label>
                     <label type="text" class="form-control ep" hidden='' id='client_id_profile_search'></label>
                     <input type="text" class="form-control form-control-user ep" id="search_client_profile_rpt" placeholder="Enter Consignee Name/ House BL#" autocomplete="off">
                     <div id='display_client_profile_search_info' class='div_search_box'></div>
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <div class="col-sm-4 mb-2">
             <!-- Project Card Example -->
             <div class="card shadow text-bg-primary mb-3">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
               </div>
               <div class="card-body" id="cosignee_profile_option_details">
                
               </div>
             </div>
           </div>

           <div class="col-sm-12 mb-1">
             <!-- Approach -->
             <div class="card shadow mb-1" id="manifestation_breakdown_card">
               <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
               </div>
               <div class="card-body">

                 <div class="form-group row">
                   <div class="col-sm-12 mb-1 mb-sm-0 ep"  id="cosignee_profile_recent_activity">

                   </div>
                 </div>
               </div>
             </div>

           </div>

         </div>

       </div>
       <!-- /. End of Cargo manifestation Content -->