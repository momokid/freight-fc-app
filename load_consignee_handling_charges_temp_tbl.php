<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
   $a = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp_view_0 where Username='$Uname' order by AccountName");
   
   echo '<table class="table table-bordered table-stripered" style="padding:0px;" id="LedgerControlTbl">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ACCOUNT NAME</th>
              <th scope="col">CHARGE</th>
              <th scope="col">21% TAX</th>
              <th scope="col"></th>
            </tr>
          </thead>';

   if(mysqli_num_rows($a)==0){
       echo '
                <tbody>
                  
                </tbody>
              </table>';
   }else{
      
  // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
             echo '
                      <tbody>';
       //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
       if(mysqli_num_rows($a)==1){
          while($an = mysqli_fetch_assoc($a)){
            $Total =$an['GetFund']+$an['VAT'] ;
          echo '
              <tr>
                <td scope="col">'.$an['AccountName'].'</td>
                <td scope="col">'.number_format($an['Amount'],2,'.',',').'</td>
                <td scope="col">'.number_format($Total,2,'.',',').'</td>
                <td scope="col"></td>
              </tr> '; 
          
        }
       }else{
        while($an = mysqli_fetch_assoc($a)){
          $Total =$an['GetFund']+$an['VAT'] ;
          echo '
              <tr>
                <td scope="col">'.$an['AccountName'].'</td>
                <td scope="col">'.number_format($an['Amount'],2,'.',',').'</td>
                <td scope="col">'.number_format($Total,2,'.',',').'</td>
                <td scope="col"><i class="fa fa-trash text-danger rm-cns-charges" cns="'.$an['ConsigneeID'].'" acc="'.$an['AccountNo'].'" hbl="'.$an['HouseBL'].'" mbl="'.$an['MainBL'].'" cnm="'.$an['ConsignmentID'].'"></i></td>
              </tr> '; 
          
        }
       }
       
      
         $c = mysqli_query($dbc, "select round(sum(SubTotalTax),2) as Total from hbl_invoice_consignee_temp_view_0 where Username='$Uname'");
         while($cn = mysqli_fetch_assoc($c)){
            echo '
                <tr>
                  <td scope="col" class="text-right">TOTAL CHARGES:</td>
                  <td scope="col" colspan="2"><b>'.number_format($cn['Total'],2,'.',',').'</b></td>
                  <td scope="col"></td>
                </tr> '; 
            
         }
      
         echo '</tbody>
             </table>';
         
         echo '
                <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-success btn-user btn-block" id="btn_save_consignee_invoice">
                        Save Consignee Invoice
                      </a>
                    </form>
                </div>';
       
        }
         
       
   
  
}
?>

<style>
.thead-lig{
   background:green;
   color:white;
}
.table-r0:hover{
    background: black;
    color: white;
    cursor: pointer;
}
</style>

<script>
 
  $('#btn_save_consignee_invoice').click(function(){
    let rid=$.trim($('#hBL_rcpt_id_invoice').text()); 
    let rno=$.trim($('#hBL_rcpt_no_invoice').text());
    
    $('#manifestation_breakdown_card').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
    q = confirm("Save consignment handling charges?");
    
    if(q){
        $.post('add_new_consignee_handling_charges.php',{rid:rid,rno:rno},function(a){
            if(a==1){
                $('.ep').text('');
                $('.ep').val('');
                $.post('load_consignee_handling_charges_temp_tbl.php',{},function(a){
                    $('#cosignee_hbl_invoice_charges_display').html(a);
                });
                $.post('load_consignee_invoice_temp_tbl.php',{},function(a){
                         $('#cosignee_hbl_invoice_display_details').html(a);
                 });
                 
                    q = confirm('Proceed to generate House BL and Invoice?');
                    if(q){
                        $.post('insert_recno_rpt.php',{sid:rno},function(){
                           var win = window.open();
                            win.location = "rpt_consignee_housebl_invoice.php", "_blank";
                            win.opener = null;
                            win.blur();
                            window.focus();
                           $('.progress-loader').remove(); 
                        });
                    }else{
                       return false; 
                    }
                    
                
                $('#btn_consignee_manifestation').focus();
            }else{
               alert(a);
               $('.progress-loader').remove();
            }

        });  
    }else{
        return false;
    }
    
    
    
 });
 
 $('.rm-cns-charges').click(function(){
    let cns=$.trim($(this).attr('cns')); 
    let cnm=$.trim($(this).attr('cnm'));
    let acc=$.trim($(this).attr('acc'));
    let hbl=$.trim($(this).attr('hbl'));
    let mbl=$.trim($(this).attr('mbl'));
    
    q = confirm('Remove account?');
    
    if(q){
        $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('remove_handling_charge_account_temp.php',{cns:cns,cnm:cnm,acc:acc,hbl:hbl,mbl:mbl},function(a){
            if(a==1){
                //Display Consignee handling charges
                $.post('load_consignee_handling_charges_temp_tbl.php',{cns:cns},function(a){
                     $('#cosignee_hbl_invoice_charges_display').html(a);
                     $('.progress-loader').remove();
                     
                });
                
            }else{
                alert(a);
                $('.progress-loader').remove();
            }
        });
    }
 });
 

</script>