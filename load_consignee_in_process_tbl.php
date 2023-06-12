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
   $a = mysqli_query($dbc, "select distinct ConsigneeID,FullName,Description,Weight,Package,Unit,HouseBL,MainBL,ConsignmentID,Username from  hbl_invoice_consignee_temp_view");
   
  
   if(mysqli_num_rows($a)==0){
       echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">FULL NAME</th>
                        <th scope="col">HOUSE BL</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">WEIGHT (KG)</th>
                        <th scope="col">USERNAME</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>';
   }else{
      
  // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
             echo '<table class="table table-bordered table-stripered" style="padding:0px;" id="ConsigneeInProcessTbl">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">FULL NAME</th>
                        <th scope="col">HOUSE BL</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">WEIGHT (KG)</th>
                        <th scope="col">USERNAME</th>
                      </tr>
                    </thead>
                   <tbody>';
       //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
         while($an = mysqli_fetch_assoc($a)){
            echo '
                <tr>
                  <td scope="col">'.$an['FullName'].'</td>
                  <td scope="col">'.$an['HouseBL'].'</td>
                  <td scope="col">'.$an['Description'].'</td>
                  <td scope="col">'.$an['Weight'].'</td>
                  <td scope="col">'.$an['Username'].' <i class="fa fa-trash text-danger float-right del-cns-process" cns="'.$an['ConsigneeID'].'" mbl="'.$an['MainBL'].'" hbl="'.$an['HouseBL'].'" cnm="'.$an['ConsignmentID'].'" usr="'.$an['Username'].'"></i></td>
                </tr> '; 
            
         }
      
         echo '</tbody>
             </table>';
       
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
    
    $('#ConsigneeInProcessTbl').DataTable();
    
    $('.del-cns-process').click(function(){
       let cns =$.trim($(this).attr('cns'));
       let cnm =$.trim($(this).attr('cnm'));
       let mbl =$.trim($(this).attr('mbl'));
       let hbl =$.trim($(this).attr('hbl'));
       let usr =$.trim($(this).attr('usr'));
       
       q = confirm('Cancel consignee invoice process?');
       
       if(q){
          $('#consigneeInProcessModal').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
            $.post('remove_temp_process_cosignee.php',{cnm:cnm,cns:cns,mbl:mbl,hbl:hbl,usr:usr},function(a){
                if(a==1){
                    alert('Consignee Invoice process cancelled successfully');
                    $('#display_consignee_in_process').load('load_consignee_in_process_tbl.php');
                    $('.progress-loader').remove();
                }else{
                    alert(a);
                    $('.progress-loader').remove();
                }
            });  
       }else{
           return false;
       }
           
    });
</script>