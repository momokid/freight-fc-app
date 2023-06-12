<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
   $a = mysqli_query($dbc, "SELECT * FROM waybill_main ORDER BY WaybillDate DESC");
   
   echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="existingWaybill">';
  
   if(mysqli_num_rows($a)==0){
       echo '
                    <tbody>
                        <tr>
                            <td>No waybill found.</td>
                        </tr>
                    </tbody>
                  </table>';
   }else{

         while($an = mysqli_fetch_assoc($a)){
            echo '
                <tr>
                  <td scope="col">'.$an['Consignee'].'</td>
                  <td scope="col">'.$an['VehicleNo'].'</td>
                  <td scope="col">'. strftime("%d %b, %Y",strtotime($an['WaybillDate'])) .'</td>
                  <td><span class="fas fa-eye text-success float-right"></span> </td>
                  <td> <span class="fas fa-trash"></span></td>
                </tr> '; 
            
         }
      
         echo '
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
    $(document).ready(function() {
        $('#existingWaybill').DataTable();
    });
</script>