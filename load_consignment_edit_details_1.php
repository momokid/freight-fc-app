<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');



$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if(!isset( $_SESSION['Uname'])){	
	header('Location: case-login');
}else{
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values where Username='$Uname'");
   // $b = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");
    
    if(mysqli_num_rows($a)==0){
       die('Error detected: Consignment Details not recorded.');
    }else{
        $an = mysqli_fetch_assoc($a);
        
        $b = mysqli_query($dbc, "select * from consignment_profile_view where BL='$an[LDate]'");
        
        if(mysqli_num_rows($b)==0){
            die('Records not found');
        }elseif(mysqli_num_rows($b)<>1){
            die('Multiple records detected');
        }else{
            $bn = mysqli_fetch_assoc($b);
            
        }
    }
}


?>


<div class="alert alert-danger text-danger font-weight-bold alert_danger_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div>   
<div class="alert alert-success text-succes font-weight-bold alert_success_banner" role="alert">
    <span aria-hidden="true">&times;</span>
</div> 

<table class="table table-edit-prvw">
    <thead>

    </thead>
    <tbody>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">D.O.T.</span>
                    <br>
                    <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['Date'])); ?></span>
                    <span class="mbl-details-body sr-only" id="edit_cns_id"><?php echo $bn['ConsignmentID']; ?></span>
                </div>
                
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">ETA</span>
                    <br>
                    <input id="edit_cns_eta" type="text" class="form-control form-control-user dtp edit-var" value="<?php echo strftime("%d %b, %Y", strtotime($bn['ETA'])); ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Shipping Line</span>
                    <br>
                    <select id="edit_cns_car" class="custom-select custom-select-sm sl-form-ctrl edit-var" id="sel_shipper_new_conisgnment">
                        <option id="<?php echo $bn['CarrierID']; ?>" ><?php echo $bn['CarrierName']; ?></option>
                        <?php 
                            $a = mysqli_query($dbc, "select * from ship_carrier where CarrierID<>'$bn[CarrierID]' order by CarrierName");
                            while($an = mysqli_fetch_assoc($a)){?>
                        <option id="<?php echo $an['CarrierID']; ?>" ><?php echo $an['CarrierName']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
            <td class="mbl-details-td" colspan="2">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Shipper</span>
                    <br>
                    <select id="edit_cns_shp" class="custom-select custom-select-sm sl-form-ctrl edit-var" id="sel_shipper_new_conisgnment">
                        <option id="<?php echo $bn['ShipperID']; ?>" ><?php echo $bn['ShipperName']; ?></option>
                        <?php 
                            $aa = mysqli_query($dbc, "select * from shipper_main where ShipperID<>'$bn[ShipperID]' order by ShipperName");
                            while($an = mysqli_fetch_assoc($aa)){?>
                        <option id="<?php echo $an['ShipperID']; ?>" ><?php echo $an['ShipperName']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Vessel</span>
                    <br>
                    <input type="text" id="edit_cns_vsl" class="form-control form-control-user edit-var" value="<?php echo $bn['VesselName']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Bill of Laden</span>
                    <br>
                    <input id="edit_cns_mbl_edit" type="text" class="form-control form-control-user edit-var" value="<?php echo $bn['BL']; ?>" >
                    <label hidden id="edit_cns_mbl"><?php echo $bn['BL']; ?></label>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Seal No</span>
                    <br>
                    <input id="edit_cns_sln" type="text" class="form-control form-control-user edit-var" value="<?php echo $bn['SealNo']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">POL</span>
                    <br>
                    <select id="edit_cns_pol" class="custom-select custom-select-sm sl-form-ctrl edit-var" id="sel_shipper_new_conisgnment">
                        <option id="<?php echo $bn['POL_ID']; ?>"><?php echo $bn['POL_Name']; ?></option>
                        <?php 
                            $ab = mysqli_query($dbc, "select * from pol where POL_ID<>'$bn[POL_ID]' order by POL_Name");
                            while($an = mysqli_fetch_assoc($ab)){?>
                        <option id="<?php echo $an['POL_ID']; ?>" ><?php echo $an['POL_Name']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
            
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">POD</span>
                    <br>
                    <select id="edit_cns_pod" class="custom-select custom-select-sm sl-form-ctrl edit-var" id="sel_shipper_new_conisgnment">
                        <option id="<?php echo $bn['POD_ID']; ?>"><?php echo $bn['POD_Name']; ?></option>
                        <?php 
                            $ac = mysqli_query($dbc, "select * from pod where POD_ID<>'$bn[POD_ID]' order by POD_Name");
                            while($an = mysqli_fetch_assoc($ac)){?>
                        <option id="<?php echo $an['POD_ID']; ?>" ><?php echo $an['POD_Name']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Container No.</span>
                    <br>
                    <input type="text" id="edit_cns_cnt" class="form-control form-control-user edit-var" value="<?php echo $bn['ContainerNo']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Place Of Issue</span>
                    <br>
                    <input type="text" id="edit_cns_pos" class="form-control form-control-user edit-var" value="<?php echo $bn['POIS']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Date Of Issue</span>
                    <br>
                    <input type="text" id="edit_cns_dis" class="form-control form-control-user dtp edit-var" value="<?php echo strftime("%d %b, %Y", strtotime($bn['DOIS'])); ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Shipped On Board</span>
                    <br>
                    <input type="text" id="edit_cns_sob" class="form-control form-control-user dtp edit-var" value="<?php echo strftime("%d %b, %Y", strtotime($bn['SOB'])); ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Voyage No</span>
                    <br>
                    <input type="text" id="edit_cns_vyg" class="form-control form-control-user edit-var" value="<?php echo $bn['VoyageNo']; ?>" >
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Container Size</span>
                    <br>
                    <input type="text" id="edit_cns_cnz" class="form-control form-control-user edit-var" value="<?php echo $bn['ContainerSize']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Rotation #</span>
                    <br>
                    <input type="text" id="edit_cns_rtn" class="form-control form-control-user edit-var" value="<?php echo $bn['Rotation']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Gross Weight (KG)</span>
                    <br>
                    <input type="number" id="edit_cns_gwt" class="form-control form-control-user edit-var" value="<?php echo $bn['ContWeight']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Handling Cost</span>
                    <br>
                    <input type="number" id="edit_cns_hcahrge" class="form-control form-control-user edit-var" value="<?php echo $bn['Charges']; ?>" >
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-success col-12" id="btn-update-cons-details">Update Consignment Details</button>
            </td>
        </tr>
    </tbody>            
</table>
        
     
<style>
    th,tr,td{
        border: 0px solid black;
        padding-left: 5px;
    }
    .table-edit-prvw .table th, table-edit-prvw .table td {
        border-right: 1px solid #e3e6f0;
    }
    .div-mbl-view-2{
        padding-left: 5px;
        min-height: 20px;
    }
    .div-mbl-details-3{
         border: 1px solid black;
    }
    .mbl-details-td{
        border: 0px solid black;
    }
    .mbl-details-head{
        font-size: 12px;
        font-weight:bold;
    }
    .mbl-details-body{
        font-weight: bold;
        font-size: 18px;
    }
    .prvw-manifest-breakdown{
        cursor: pointer;
    }
    .edit-var{
        border:1px solid green;
        border-radius: 0px;
    }
    #btn-update-cons-details{
        padding: 1rem;
        border-radius: 4rem;
        font-weight: bold;
    }
</style>
<script>
   $(".dtp").datepicker({
        showButtonPanel: false
  });
  //$('.alert').fadeIn(1000).fadeOut(3000);
  
  $('#btn-update-cons-details').click(function(){
      let pol = $.trim($('#edit_cns_pol :selected').attr('id'));
      let pod = $.trim($('#edit_cns_pod :selected').attr('id'));
      let eta = $.trim($('#edit_cns_eta').val());
      let vsl = $.trim($('#edit_cns_vsl').val());
      let mble = $.trim($('#edit_cns_mbl_edit').val());
      let mbl = $.trim($('#edit_cns_mbl').text());
      let sln = $.trim($('#edit_cns_sln').val());
      let cnt = $.trim($('#edit_cns_cnt').val());
      let csz = $.trim($('#edit_cns_cnz').val());
      let pis = $.trim($('#edit_cns_pos').val());
      let dis = $.trim($('#edit_cns_dis').val());
      let sob = $.trim($('#edit_cns_sob').val());
      let vyg = $.trim($('#edit_cns_vyg').val());
      let rtn = $.trim($('#edit_cns_rtn').val());
      let gwt = $.trim($('#edit_cns_gwt').val());
      let cid =$.trim($('#edit_cns_id').text());
      let hct = $.trim($('#edit_cns_hcahrge').val());
      let car = $.trim($('#edit_cns_car :selected').attr('id'));
      let shp = $.trim($('#edit_cns_shp :selected').attr('id'));
     // alert(mbl+" "+mble+" ish")
      let q = confirm('Proceed to update consignment details?');
      
      if(q){
          $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
          $.post('run_update_consginment_details.php',{ble:mble,cid:cid,sob:sob,vyg:vyg,rtn:rtn,gwt:gwt,hct:hct,car:car,shp:shp,pol:pol,pod:pod,eta:eta,vsl:vsl,mbl:mbl,sln:sln,cnt:cnt,csz:csz,pis:pis,dis:dis},function(a){
              if(a==1){
                  $('.alert_success_banner').text('Consignment details updated successfully!!!').fadeIn(500).fadeOut(7000);
                  $('.progress-loader').remove();
                  $('.table-edit-prvw').hide();
                  $('#search_consignment_profile_edit').val('').focus();
              }else{
                  $('.progress-loader').remove(); 
                 $('.alert_danger_banner').text(a).append('***').fadeIn(500).fadeOut(7000);
              }
           });
          
      }else{
          return false;
      }
      
  });
</script>

