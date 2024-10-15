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
    $result = mysqli_query($dbc,"SELECT * FROM consignee_main WHERE (FullName LIKE '%$e%') OR (TelNo LIKE '%$e%') ");
    
  while( $f = mysqli_fetch_assoc($result)){
       //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
         //      . '<div class="wrap-details"></div></div><br>';
      
      echo "<div class='return_search_results consignee_profile_search_0 hide_div_note' id='$f[ConsigneeID]' ><b>".$f['FullName']."</b> <e style='color:red;'> [".$f['TelNo']."]</e> <b style='color:blue;'> ".$f['Address3']."</b></div>";
  }
   
  
}


?>

<script>
    $('.consignee_profile_search_0').click(function(){
        
        $(".progress-loader").remove();
        
       var cns = $(this).attr('id');
       var m = $(this).text();
       //$('.ep').text('');
       
       $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
       $.post('load_client_track_options.php',{cns:cns},function(a){
                 
                $('#cosignee_profile_option_details').html(a);
                                
                $('#search_client_profile_rpt').val(m);
                $('#client_id_profile_search').text(cns);
                $(".progress-loader").remove();
                $('#invoice_pmt_amt').focus();                
            
       });
       
       $.post('load_client_recent_activity_profile.php',{cns:cns},function(b){
           $('#cosignee_profile_recent_activity').html(b);
       });       
       
       $('.consignee_profile_search_0').toggle();
    });
</script>
