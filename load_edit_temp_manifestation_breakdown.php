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
        
        $b = mysqli_query($dbc, "select * from  temp_manifestation_breakdown_view where HouseBL='$an[Sub_ClassID]'");
        
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
                    <span class="mbl-details-head">Bill of Lading</span>
                    <br>
                    <span class="mbl-details-body" id="edit_hbl_mbl"><?php echo $bn['MainBL']; ?></span>
                    <span class="mbl-details-body sr-only" id="edit_hbl_cid"><?php echo $bn['ConsignmentID']; ?></span>
                </div>
                
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">House BL</span>
                    <br>
                    <span class="mbl-details-body sr-on" id="edit_hbl_hbl"><?php echo $bn['HouseBL']; ?></span>
                </div>
                
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Consignee</span>
                    <br>
                    <select class="custom-select custom-select-sm sl-form-ctrl edit-var" id="edit_hbl_cn1">
                        <option id="<?php echo $bn['CosigneeID']; ?>" ><?php echo $bn['FullName']; ?></option>
                        <?php 
                            $a = mysqli_query($dbc, "select * from consignee_main where ConsigneeID<>'$bn[ConsigneeID]' order by FullName");
                            while($an = mysqli_fetch_assoc($a)){?>
                        <option id="<?php echo $an['ConsigneeID']; ?>" ><?php echo $an['FullName']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Nortify Party</span>
                    <br>
                    <select id="edit_hbl_cn2" class="custom-select custom-select-sm sl-form-ctrl edit-var">
                        <option id="<?php echo $bn['Cosignee2_ID']; ?>" ><?php echo $bn['FullName2']; ?></option>
                        <?php 
                            $a = mysqli_query($dbc, "select * from consignee_main where ConsigneeID<>'$bn[Cosignee2_ID]' order by FullName");
                            while($an = mysqli_fetch_assoc($a)){?>
                        <option id="<?php echo $an['ConsigneeID']; ?>" ><?php echo $an['FullName']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Weight (KG)</span>
                    <br>
                    <input type="text" id="edit_hbl_weight" class="form-control form-control-user edit-var" value="<?php echo $bn['Weight']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Package</span>
                    <br>
                    <input type="text" id="edit_hbl_pkg" class="form-control form-control-user edit-var" value="<?php echo $bn['Package']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Unit</span>
                    <br>
                    <select id="edit_hbl_unt" class="custom-select custom-select-sm sl-form-ctrl edit-var">
                        <option id="<?php echo $bn['Unit']; ?>" ><?php echo $bn['Unit']; ?></option>
                        <?php 
                            $a = mysqli_query($dbc, "select * from package_unit where Unit<>'$bn[Unit]' ");
                            while($an = mysqli_fetch_assoc($a)){?>
                        <option id="<?php echo $an['Unit']; ?>" ><?php echo $an['Unit']; ?></option>
                           <?php }?>
                    </select>
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Item Type</span>
                    <br>
                    <select id="edit_hbl_itp" class="custom-select custom-select-sm sl-form-ctrl edit-var">
                        <option><?php echo $bn['ItemType']; ?></option>
                        <option>GOODS</option>
                        <option>VEHICLE</option>
                    </select>
                </div>
            </td>
            
        </tr>
        <tr>
            <td class="mbl-details-td" colspan="2">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Description*</span>
                    <br>
                    <input type="text" id="edit_hbl_dsc" class="form-control form-control-user edit-var" value="<?php echo $bn['Description']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">VIN**</span>
                    <br>
                    <input type="text" id="edit_hbl_vin" class="form-control form-control-user edit-var" value="<?php echo $bn['VIN']; ?>" >
                </div>
            </td>
            <td class="mbl-details-td">
                <div class="div-mbl-view-2">
                    <span class="mbl-details-head">Other Information**</span>
                    <br>
                    <input type="text" id="edit_hbl_oif" class="form-control form-control-user edit-var" value="<?php echo $bn['OtherInfo']; ?>" >
                </div>
            </td>
        </tr>
        
        <tr>
            <td colspan="5">
                <button type="button" class="btn btn-danger col-12" id="btn-update-hbl-details">Update House BL Details</button>
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
        border:1px solid red;
        border-radius: 0px;
    }
    #btn-update-hbl-details{
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
  
  $('#btn-update-hbl-details').click(function(){
      let cn1 = $.trim($('#edit_hbl_cn1 :selected').attr('id'));
      let cn2 = $.trim($('#edit_hbl_cn2 :selected').attr('id'));
      let pkg = $.trim($('#edit_hbl_pkg').val());
      let gwt = $.trim($('#edit_hbl_wgt').val());
      let unt = $.trim($('#edit_hbl_unt').val());
      let mbl = $.trim($('#edit_hbl_mbl').text());
      let hbl = $.trim($('#edit_hbl_hbl').text());
      let itp = $.trim($('#edit_hbl_itp').val());
      let cid = $.trim($('#edit_hbl_cid').text());
      let dsc = $.trim($('#edit_hbl_dsc').val());
      let vin = $.trim($('#edit_hbl_vin').val());
      let oif = $.trim($('#edit_hbl_oif').val());
      let wgt = $.trim($('#edit_hbl_weight').val());
      
      let q = confirm('Proceed to update House BL details?');
       
      if(q){
          $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
          $.post('run_update_housebl_details_temp.php',{wgt:wgt,hbl:hbl,cid:cid,cn1:cn1,cn2:cn2,pkg:pkg,gwt:gwt,unt:unt,mbl:mbl,itp:itp,dsc:dsc,vin:vin,oif:oif},function(a){
              if(a==1){
                  $('.alert_success_banner').text('House BL details updated successfully!!!').fadeIn(500).fadeOut(7000);
                  $('#cosignee_house_bl_display_details').load('load_cosignee_manifestation_temp.php');
                  $('.progress-loader').remove();
                  $('.table-edit-prvw').hide();
                  $('#search_housebl_profile_rpt').val('').focus();
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

