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
        
        $b = mysqli_query($dbc, "select * from consignment_profile_view where ConsignmentID='$an[LDate]' and BL='$an[SubjectID]'");
        
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

        <div style="position:absolute;width: 100%;color: #d8d9dc26;z-index: 100;font-size: 7rem;margin-top: -9%;font-family:'Arial Black';transform: rotate(-40deg);">PREVIEW</div>
       
        <table class="table table-bordered">
            <thead>
                
            </thead>
            <tbody>
                <tr>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Date of transaction</span>
                            <br>
                            <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['Date'])) ; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">ETA</span>
                            <br>
                            <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['ETA'])); ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Shipping Line</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['CarrierName']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td" colspan="2">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Shipper</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['ShipperName']; ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Vessel</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['VesselName']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Shipper</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['ShipperName']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Bill of Laden</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['BL']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Seal No</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['SealNo']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Voyage No</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['VoyageNo']; ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Container No.</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['ContainerNo']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Place Of Issue</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['POIS']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Date Of Issue</span>
                            <br>
                            <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['DOIS'])); ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Shipped On Board</span>
                            <br>
                            <span class="mbl-details-body"><?php echo strftime("%d %b, %Y", strtotime($bn['SOB'])); ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Container No.</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['ContainerNo']; ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">P.O.L.</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['POL_Name']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">P.O.D.</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['POD_Name']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Rotation #</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['Rotation']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Gross Weight (KG)</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['ContWeight']; ?></span>
                        </div>
                    </td>
                    <td class="mbl-details-td">
                        <div class="div-mbl-view-2">
                            <span class="mbl-details-head">Handling Cost</span>
                            <br>
                            <span class="mbl-details-body"><?php echo $bn['Charges']; ?></span>
                        </div>
                    </td>
                </tr>
                
            </tbody>
            
            
        </table>
        <div style="height: 0px;" class="mb-3 sr-only">
            <!-- here we call the function that makes PDF -->
            <input class="btn btn-dark no-print" type="button" onClick="window.print()" value="Donwload PDF">
            <input class="btn btn-primary no-print" type="button" value="View Invoice" id="btn_view_invoice_rcpt">
        </div>
     
<style>
    th,tr,td{
        border: 0px solid black;
        padding-left: 5px;
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
    @media print{@page {size: portrait}}
    
    @media print{
        .no-print{
            display: none;
        }
    }
</style>
<script src="vendor/jquery/jquery.min.js"></script>
<script>
   
    $('#btn_view_invoice_rcpt').click(function(){
       window.open("invoice_housebl_charges.php", "_blank"); 
    });
    
    $('.prvw-manifest-breakdown').click(function(){
       let mbl=$.trim($(this).attr('id'));
       
       $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
       $.post('insert_recno_rpt.php',{cid:mbl},function(a){
           if(a==1){
               window.open("rpt_manifestation_breakdown_consignee.php", "_blank");
               $('.progress-loader').remove(); 
           }else{
               $('.progress-loader').remove(); 
               alert(a);
               return false;
           }
       });
    });
 
</script>

