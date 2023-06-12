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
    $result = mysqli_query($dbc,"select * from  consignment_profile_view where BL like '%$e%'");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results cons_search_edit_profile_1 hide_div_note' id='$f[BL]' ><b>".$f['VesselName']."</b> <e style='color:red;'> [".$f['BL']."]</e> <b style='color:blue;'> ".$f['ContainerNo']."</b></div>";
  }
   
  
}


?>

<script>
    $('.cons_search_edit_profile_1').click(function(){
        
       var cns = $(this).attr('id');
       var m = $(this).text();
       //$('.ep').text('');
       
       $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php',{ldt:cns},function(){
            $('#cons_profile_edit_search_result').load('load_consignment_edit_details_1.php');
          
            $('#search_consignment_profile_edit').val(m);
            $('#cns_id_profile_edit_search').text(cns);
            $('.progress-loader').remove();
       });
       
       $('.cons_search_edit_profile_1').toggle();
    });
</script>
