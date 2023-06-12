<?php
//start the session
session_start();

//Database connection
include ('cn/cn.php');


$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

function showImg($img){
    ($img == "NA") ? $img = "noimage.gif" : $img;

    return  "
        <a class='thumbnail' href='#thumb'>
            <img class='payment_proof_cover' src='images/pmt_proof/".$img."' border='0' />
            <span>
                <img src='images/pmt_proof/".$img."' height='400px' width='400px'/>
            </span>
        </a>
    ";
}

if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}else{
    $a = mysqli_query($dbc,"SELECT * FROM e_payment_confirmation_view WHERE Status<>0 ORDER BY Time Desc");

    if(mysqli_num_rows($a)>0){
      
        echo "
        <div id='tbl_confirm_payment_proof'>
        <table>
            <thead class='tbl_th_tr'>
                <th>HOUSE BL</th>
                <th>PAYMENT MODE</th>
                <th>PAYMENT DETAILS</th>
                <th>PAYMENT PROOF</th>
                <th>CONTACT DETAILS</th>
                <th>DATE</th>
                <th>ACTION</th>
            </thead>
        ";
      while($an = mysqli_fetch_assoc($a)){
        echo "
            <tr class='tr_payment_confirmation' id='".$an[HouseBL]."'>
                <td>".$an['HouseBL']."</td>
                <td>".$an['PaymentMode']."</td>
                <td>".$an['PaymentDetails']."</td>
                <td>". showImg($an[ImgUrl])."</td>
                <td>".$an['ContactDetails']."</td>
                <td>".$an['Time']."</td>
                <td class='accept_payment_proof' id='".$an['HouseBL']."'>  <button class='btn btn-info btn-user confirm_payment_proof' id='".$an['HouseBL']."'>Confirm</button> </td>
            </tr>

        ";
      }
      echo "
        </table>
        </div>
        <div id='paymentProofConfirmation'>Details will be here</div>
      ";
    }else{
        echo('');

    }

}


?>


<style>
    .thumbnail{
        position:relative;
        z-index:0;
    }
    .thumbnail:hover{
        background-color:transparent;
        z-index:50;
    }
    .thumbnail span{
        /* For enlarge image*/
        position: absolute;
        background-color:white;
        padding:5px;
        left:-100px;
        border:1px dashed gray;
        visibility:hidden;
        color:black;
        text-decoration:none;
    }
    .thumbnail span img{
        border-width:0;
        padding:2px;
    }
    .thumbnail:hover span{
        visibility:visible;
        top:0;
        left:60px;
    }
    #sample_tbl{
        position: relative;
        min-width: 100px;
        min-height: 100px;
    }
    .payment_proof_cover{
        height:1rem;
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
    .tr_payment_confirmation{
        cursor: pointer;
    }
    .tr_payment_confirmation:hover{
        background-color:gray;
        color:white;
    }
    .tr_payment_confirmation td{
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
    .online_request_header{
        margin-top:2rem;
        display:block;
        border:1px solid black;
        color:text;
        text-align:center;
        font-weight:bold;
    }
</style>

<script>
    $(".datepicker").datepicker();

$('.confirm_payment_proof').click( function(){
    let id = $.trim($(this).attr('id'));

    alert(id);
    $("body").append(
        '<div class="progress-loader"><i class="fa fa-hourglass faa-tada animated fa-2x"></i></div>'
      );
    $('#paymentProofConfirmation').load('load_ledger_control_tbl.php');
})

$('.tracked_shipping_btn').click(function(){
    let bl =$.trim($(this).attr('id'));
    let newETA = $.trim($(`#${bl}_eta`).val());
    let status=$.trim($(`#${bl}_status`).val());
    let status_code=$.trim($(`#${bl}_status :selected`).attr('id'));

    $('.tracked_shipping_btn').prop('disabled',true).css('background-color','gray');
    $("#tbl_confirm_payment_proof").append(
        '<div class="progress-loader"><i class="fa fa-hourglass faa-tada animated fa-2x"></i></div>'
      );

    $.post('update_shipment_tracker.php',{bl:bl, newETA, newETA, status:status, status_code:status_code},function(res){
        var data = JSON.parse(res)
        if(data.code==200){
            alert(data.msg);
            $('#display_tr_payment_confirmation_status').load('load_tr_payment_confirmation.php');
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