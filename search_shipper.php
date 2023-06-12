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
    $result = mysqli_query($dbc,"select * from shipper_main where ShipperName like '%$e%'");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results form_master_search hide_div_note' id='$f[ShipperID]'><b>".$f['ShipperName']."</b></div>";
  }
   
  
}


?>

<script>
    $('.form_master_search').click(function(){
        
       var e = $(this).attr('id');
       var m = $(this).text();
        
       //$('#edit_std_info_display_board').html(e);
       $('#shipper_new_conisgnment').val(m);
       $('#shpperid_new_consignment').text(e);
 
       // $('#mapp_StaffClass').load('load_staff_class_map.php');
      //  $('#mapp_StaffSubject').load('load_staff_subject_map.php');
        
       $('.form_master_search').toggle();
       $('#vessel_new_conisgnment').focus();
    });
</script>
