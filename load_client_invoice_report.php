<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cid = mysqli_real_escape_string($dbc, $_GET['cid']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $a = mysqli_query($dbc, "select * from other_invoice where ClientID='$cid'");
    if (mysqli_num_rows($a) == 0) {
        echo '<table class="table table-bordered table-responsive" style="padding:0px;">
                         <thead class="thead-lig">
                           <tr>
                           <th scope="col">DATE</th>
                             <th scope="col">DECL. #</th>
                             <th scope="col">BL/ HBL</th>
                             <th scope="col">AGENT NAME</th>
                             <th scope="col">AMOUNT CHARGED</th>
                           </tr>
                         </thead>
                         <tbody>
                               
                         </tbody>
                       </table>';
    } else {

         $b = mysqli_query($dbc,"select distinct ClientID, ReceiptNo,Stamp, Description,Date,HouseBL from other_invoice where ClientID='$cid'");
        echo '<table class="table table-bordered" style="padding:0px;" id="ClientInvoiceView">
                         <thead class="thead-dark">
                           <tr>
                           <th scope="col">DATE</th>
                           <th scope="col">INVOICE #</th> 
                           <th scope="col">HBL #</th>
                           <th scope="col">DESCRIPTION</th>
                           <th scope="col"></th>
                           </tr>
                         </thead>
                <tbody>';
        //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
        while ($bn = mysqli_fetch_assoc($b)) {
            echo '
                     <tr data-toggle="modal" id="' . $bn['ReceiptNo'] . '"  class="trViewClientBill">
                        <td scope="col" id="ff">' . strftime("$dtf", strtotime($bn['Date'])) . '</td>
                       <td scope="col">' . $bn['ReceiptNo'] . ' <i class="fa fa-eye text-warning  client_bill_view ml-3" id="'.$bn['ReceiptNo'] .'"></i></td>
                       <td scope="col">' . $bn['HouseBL'] . '</td>
                       <td scope="col">' . $bn['Description'] . ' </td>
                       <td scope="col"><i class="fa fa-trash text-danger rm-client-invoices-nonm ml-3" id="'.$bn['ReceiptNo'].'" cid="'.$cid.'"></i></td>

                    </tr> ';
        }

        echo '      </tbody>
             </table>';
    }
}

?>

<style>
    .thead-lig {
        background: green;
        color: white;
    }

    .trViewClientBill:hover {
        background: #bbb;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        //$('#ClientInvoiceView').DataTable();

        $('.client_bill_view').click(function() {
            let id = $.trim($(this).attr('id'));
            let cid = $.trim($(this).attr('cid'));

            if (id == '') {
                alert('Receipt No. not found');
                return false;
            } else {
                $('body').append(
                    '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
                );
                $.post('insert_recno_rpt.php',{sid:id},function(){
                    var win = window.open();
                    win.location = "invoice_other_services_non_manifest.php", "_blank";
                    win.opener = null;
                    win.blur();
                    window.focus();
                    $('.progress-loader').remove(); 
                });
            }
        });

        $('.rm-client-invoices-nonm').click(function(){
            let id=$.trim($(this).attr('id'));
            let cid = $.trim($(this).attr('cid'));
            
            q = confirm('Remove client invoice?');
            
            if(q){
                $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
                $.post('remove_client_invoice_transaction.php',{id:id},function(a){
                    if(a==1){
                       $.get(
                            'load_client_invoice_report.php',
                            { cid:cid },
                            function (a) {
                                $('#view_other_report_search_result').html(a);
                                $('.progress-loader').remove();
                            });
                        $('.progress-loader').remove();
                    }else{
                        alert(a);
                        $('.progress-loader').remove();
                    }
                });
            }
        });
    });
</script>