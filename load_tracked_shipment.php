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
    $a = mysqli_query($dbc,"SELECT * FROM eta_web_track_view");

    if(mysqli_num_rows($a)>0){
      
        echo "
        <div id='sample_tbl'>
        <table>
            <thead class='tbl_th_tr'>
                <th>MAIN BL</th>
                <th>STATUS</th>
                <th>ETA</th>
                <th>ACTION</th>
            </thead>
        ";
      while($an = mysqli_fetch_assoc($a)){
        echo "
            <tr class='tracked_shipment'>
                <td>".$an['MainBL']."</td>
                <td>".$an['ArrivalStatus']."</td>
                <td><input type='text' id='".$an['MainBL']."_eta' class='form-control form-control-user datepicker' value='".strftime('%d/%m/%Y', strtotime($an['ETA']))."'/></td>
                <td>
                    <select class='form-control form-control-user' id='".$an['MainBL']."_status'>
                        <option id='".$an['Status']."'>".$an['ArrivalStatus']."</option>
                        <option id='1'>On The Way</option>
                        <option id='2'>Arrived</option>
                        <option id='3'>Arrived and Discharged</option>
                        <option id='4'>Arrived and Unstuffed</option>
                    </select>
                </td>
                <td style='border:0px solid black;'><button  class='tracked_shipping_btn' id='".$an['MainBL']."'>Update</button></td>
            </tr>

        ";
      }
      echo "
        </table>
        </div>
      ";
    }else{
        die('');

    }
}


?>

<script>
      $(".datepicker").datepicker();
</script>

<style>
    #sample_tbl{
        position: relative;
        min-width: 100px;
        min-height: 100px;
    }
    .spinner_div{
        height: 100px;
        width: 100px;
        position: absolute;
        top:20%;
        left:50%;
    }
    .tbl_th_tr th{
        border:1px solid #bbb;
        color:white;background:black;
        text-align:center; 
        font-weight:bold;
        padding:5px;
        width:15vw;
    }
    .tracked_shipment td{
        border:1px solid #eee;
        text-align: center;
    }
    .tracked_shipping_btn{
        color: white;
        background-color: green;
        padding: 1px;
        cursor: pointer;
        font-weight: bold;
    }
</style>

<script>

$('.tracked_shipping_btn').click(function(){
    let bl =$.trim($(this).attr('id'));
    let newETA = $.trim($(`#${bl}_eta`).val());
    let status=$.trim($(`#${bl}_status`).val());
    let status_code=$.trim($(`#${bl}_status :selected`).attr('id'));

    $('.tracked_shipping_btn').prop('disabled',true).css('background-color','gray');
    $("body").append(
        '<div class="progress-loader"><i class="fa fa-hourglass faa-tada animated fa-2x"></i></div>'
      );

    $.post('update_shipment_tracker.php',{bl:bl, newETA, newETA, status:status, status_code:status_code},function(res){
        var data = JSON.parse(res)
        if(data.code==200){
            alert(data.msg);
            $('#display_tracked_shipment_status').load('load_tracked_shipment.php');
            $('#tracked_shipping_count').load('load_tracked_shipping_count.php');
            $(".progress-loader").remove();
            //$('.tracked_shipping_btn').removeAttr('disabled').css('background-color','green')
        }else{
            alert(data.msg);
            $(".progress-loader").remove();
            $('.tracked_shipping_btn').removeAttr('disabled').css('background-color','green')
        }
        
    })
    
})
</script>