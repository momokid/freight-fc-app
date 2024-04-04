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
  
       $a = mysqli_query($dbc, "select * from disbursement_accounts_view order by AccountName");
        if(mysqli_num_rows($a)==0){
            echo '<table class="table table-bordered table-responsive" style="padding:0px;" id="dataTables">
                         <thead class="thead-lig">
                           <tr>
                             <th scope="col">ACCOUNT ID</th>
                             <th scope="col">ACCOUNT NAME</th>
                             <th scope="col"></th>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>';
        }else{

       // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
                  echo '<table class="table table-bordered" style="padding:0px;" id="HandlingChargeTbl">
                         <thead class="thead-dark">
                           <tr>
                             <th scope="col">ACCOUNT ID</th>
                             <th scope="col">ACOUNT NAME</th>
                             <th scope="col"></th>
                           </tr>
                         </thead>
                         <tbody>';
            //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
              while($an = mysqli_fetch_assoc($a)){
                 echo '
                     <tr>
                       <td scope="col">'.$an['AccountNo'].'</td>
                       <td scope="col">'.$an['AccountName'].'</td>
                       <td scope="col"><i class="fa fa-trash text-danger del_hc" id="'.$an['AccountNo'].'"></i></td>
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
    $(document).ready(function() {
        $('#HandlingChargeTbls').DataTable();
     
     $('.del_hc').click(function(){
      let cid=$.trim($(this).attr('id'));
      
      q = confirm("Remove handling fee?");
      if(q){
          $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
            $.post('remove_handling_charge_account.php',{cid:cid},function(a){
                if(a==1){
                    $('.progress-loader').remove();
                    $('#display_handling_charges').load('load_handling_charge_tbl.php');
                    
                }else{
                    alert(a);
                    $('.progress-loader').remove();
                }
            });
      }else{
          return false;
      }
      
      
     });
     
    });
</script>