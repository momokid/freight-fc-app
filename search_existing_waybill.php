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
    $result = mysqli_query($dbc,"select * from waybill_main where Consignee like '%$e%' or VehicleNo like '%$e%'");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results existing_waybill_search hide_div_note' dt='$f[WaybillDate]' cnm='$f[Consignee]' cns='$f[id]' vcl='$f[VehicleNo]' ><b>".$f['Consignee']."</b> ".$f['VehicleNo']."</div>";
  }
   
  
}


?>

<script>
    $('.existing_waybill_search').click(function(){
        
       var cns = $(this).attr('cns');
       var cnm = $(this).attr('cnm');
       var mbl = $(this).attr('mbl');
       var dt = $(this).attr('dt');
       var m = $(this).text();
       $('.ep').text('');
       
       $('#txt_housebl_customer_waybill').val(cnm);

       //Display Consignee manifestation details
        $.post('insert_multi_values_0.php',{e1:cns},function(a){
            window.open(
            "customer_waybill_printable.php",
            "_blank"
            );
        });

      // $('#new-house-bl-invoice-panel').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
            // if(a==1){
                //Display Consignee manifestation details
                // $.post('load_consignee_invoice_temp_tbl.php',{cns:cns,hbl:hbl},function(a){
                //      $('#cosignee_hbl_invoice_display_details').html(a);
                // });
                
            //     //Display Consignee manifestation details
            //     $.post('load_consignee_invoice_temp_tbl.php',{cns:cns,hbl:hbl},function(a){
            //          $('#cosignee_hbl_invoice_display_details').html(a);
            //     });
                
            //     $('#search_hbl_consignee2_fname').focus();
                
            //     $('.progress-loader').remove();
            // }else{
            //     $('.progress-loader').remove();
            //      alert(a);  
            // }

        
       $('.existing_waybill_search').toggle();
    });
</script>
