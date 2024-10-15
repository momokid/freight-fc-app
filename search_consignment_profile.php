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
    $result = mysqli_query($dbc,"SELECT * FROM  consignment_profile_view WHERE (BL LIKE '%$e%') ");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results cons_search_profile_1 hide_div_note' id='$f[BL]' ><b>".$f['BL']."</b> <em style='color:red;'> ".$f['ShipperName']."</em> </div>";
  }
   
  
}


?>

<script>
    $('.cons_search_profile_1').click(function(){
        
       var cns = $(this).attr('id');
       var m = $(this).text();
       //$('.ep').text('');
       
       $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
       $.post('load_consignment_details_search_profile.php',{cns:cns},function(a){
                 
                $('#cons_profile_recent_activity').html(a);
                                
                $('#search_consignment_profile_rpt').val(m);
                $('#cns_id_profile_search').text(cns);
                $('.progress-loader').remove();
                //$('#invoice_pmt_amt').focus();                
            
       });
       
       $.post('load_client_recent_activity_profile.php',{cns:cns},function(b){
           $('#cosignee_profile_recent_activity').html(b);
       });       
       
       $('.cons_search_profile_1').toggle();
    });
</script>
