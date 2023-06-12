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
    $result = mysqli_query($dbc,"SELECT * FROM manifest_bl_tracking_1 WHERE MainBL Like '%$e%'");
    
  while( $f = mysqli_fetch_assoc($result)){
            
      echo "<div class='return_search_results form_master_search hide_div_note' id='$f[ConsignmentID]' bl='$f[MainBL]' eta='$f[ETA]'><b>".$f['MainBL']."</b> <i class='fas fa-plus text-success new_bl_tracking mr-3' title='click to add BL to tracking list' ></i></div>";
  }
   
  
} 


?>

<script>
     $('.form_master_search').click(function(){
        
       var id = $(this).attr('id');
       var bl = $(this).attr('bl');
       var eta = $(this).attr('eta');
        
         
        $('#searchMainBLTracking').val(bl);

        $("body").append(
        '<div class="progress-loader"><i class="fa fa-hourglass faa-tada animated fa-2x"></i></div>'
      );

        $.post('insert_new_tracking_bl.php',{id,bl, eta},(e)=>{
            let response = JSON.parse(e);

            if(response.code==200){
                $(".progress-loader").remove();
                $('#display_tracked_shipment_status').load('load_tracked_shipment.php');
                $('#tracked_shipping_count').load('load_tracked_shipping_count.php');
                alert(response.msg);
                $('#searchMainBLTracking').val('').focus();
            }else{
                alert(response.msg)
                $(".progress-loader").remove();
            }
            
        })
        
       $('.form_master_search').toggle();
    });
</script>
