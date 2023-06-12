<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Username']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e= mysqli_real_escape_string($dbc,$_POST['e']);

if(!isset($_SESSION['Uname'])){
	
	header('Location: login');
	
}elseif($e==''){
    die('');
}elseif(!isset ($e)){
    die('Search key not found'); 
}else{
    $result = mysqli_query($dbc,"select * from container_exp_pmt_3 where  (MainBL like '%$e%')");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results consignee_invoice_debt_details hide_div_note' cns='$f[ConsignmentID]' mbl='$f[MainBL]' ><b>".$f['ShipperName']."</b> <e style='color:red;'> ".$f['MainBL']."</e> <e style='color:green;'> [".$f['ConsCount']."]</e></div>";
  }
   
  
}


?>

<script>
    $('.consignee_invoice_debt_details').click(function(){
        
       var cns = $(this).attr('cns');
       var mbl = $(this).attr('mbl');
       var m = $(this).text();
       //$('.ep').text('');
       
       $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
       $.post('insert_recno_rpt.php',{ldt:cns,cid:mbl},function(a){
            if(a==1){
                $('#hBL_rcpt_id_invoice').text(a);
                
               
             
                //Display Consignee manifestation details
                $.post('load_consignee_exp_pmt_details_tbl.php',{cns:cns,mbl:mbl},function(a){
                     $('#cosignee_exp_pmt_display_details').html(a);
                });
               /** 
                //Display Consignee handling charges
                $.post('load_consignee_handling_charges_temp_tbl.php',{cns:cns},function(a){
                     $('#cosignee_hbl_invoice_charges_display').html(a);
                });
                
                $('#sel_hBL_acc_invoice').load('load_sel_billing_account.php');**/
                
                $('#consignee_invoice_rcv').val(m);
                $('#consignee_id_pmt_expense').text(cns);
                $('#invoice_pmt_exp_mblid').text(mbl);
                $('#invoice_pmt_exp_sel_cash_acc').load('load_sel_cash_account.php');
                $('#invoice_pmt_exp_sel_cash_acc1').load('load_sel_expenditure_account.php');
                $('.progress-loader').remove();
                $('#invoice_pmt_exp_amt').focus();                
            }else{
                $('.progress-loader').remove();
                 alert(a);  
            }
            
            
       });
       
       // $('#mapp_StaffClass').load('load_staff_class_map.php');
      //  $('#mapp_StaffSubject').load('load_staff_subject_map.php');
        
       $('.consignee_invoice_debt_details').toggle();
    });
</script>
