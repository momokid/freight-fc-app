<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e=  trim(mysqli_real_escape_string($dbc,$_POST['e']));

if(!isset($_SESSION['Uname'])){	
    header('Location: case-login');	
}else{
        $x = mysqli_query($dbc,"select * from rpt_multi_values where Username='$Uname'");
        if(mysqli_num_rows($x)<>1){
            die('System cannot fetch receipt no.');
        }else{
            $xn = mysqli_fetch_assoc($x);
            $e = $xn['ReceiptNo'];
        $result = mysqli_query($dbc,"select distinct InstName,Address,Email from inst_branch_view where BranchID='$BranchID'");
        $a=  mysqli_query($dbc, "select FullName,StudentID,round(sum(TCr),2) as TCr, Description, Date, SubClassName from  student_fee_view_2 where ReceiptNo='$e' and Stamp='BL' group by StudentID");
        if(mysqli_num_rows($a)==0){
            die('Invalid Receipt No.');
        }elseif(mysqli_num_rows($a)>0){
            while($an=  mysqli_fetch_assoc($a)){
               $fn=$an['FullName'];
               $SID=$an['StudentID'];
               $amt=$an['TCr'];
               $des=$an['Description'];
               $ClassName=$an['SubClassName'];
               $Dt=$an['Date'];
            
               $b=  mysqli_query($dbc,"select round(sum(TDr),2)-round(sum(TCr),2) as AmtDue from  student_fee_view_2 where  Date<='$Dt' and StudentID='$SID' and ReceiptNo<>'$e'");
             $bn=  mysqli_fetch_assoc($b);
             $AmtDue=  $bn['AmtDue'];
             $Balance=$AmtDue-$amt;
             
           //  $Cmp = mysqli_query($dbc, "insert into sms_compose values('$SID','$fn','$ClassName','$e','$AmtDue','$amt','$Balance','$des','$ActiveDate','$Uname','1')");
             
        echo '<div class="rpt-header-wrapper">
                <span style="padding:5px;"><i class="fa fa-print"></i><a title="Print Report" alt="Print Report" onclick="window.print();" target="_blank" style="cursor:pointer; color:red; font-size:18px;">Print</a></span>
                <span style="padding:5px;"><i class="fa fa-file-excel-o"></i><a title="Print Report" alt="Print Report" onclick="window.print();" target="_blank" style="cursor:pointer; color:green; font-size:18px;">Export Excel</a></span>
              </div>';
            if(mysqli_num_rows($result)==0){
                die('Institution\'s details not found');
            }elseif(mysqli_num_rows($result)==1){
                      echo      "<div class='rpt-body-wrapper'>
                                    <div class='rpt-body-header-wrap'>
                                        <span style='padding-left:5px;font-size:16px;'>FEE PAYMENT RECEIPT- <b>RECEIPT #</b>: <t style='background-color:black;color:white;padding:0px 3px;'>".$e."</t></span>     <span><b>DATE:  </b>".strftime('%d %b, %Y',strtotime($Dt))."</span>
                                    </div>";
                 $det=  mysqli_fetch_assoc($result);
                         $r1 = mysqli_query($dbc,"select distinct InstName,Address,Email,TelNo from  inst_branch_view where BranchID='$BranchID'");
                         $rn = mysqli_fetch_assoc($r1);
                      echo      "  <div class='rpt-body-title-wrap'>
                                     <div class='company-details' style='width:50%;'>
                                        <span style='font-size:22px;font-weight:bold;color:#fc9f13;'>".$rn['InstName']."</span><br>
                                        <span style='color:#428bca;'><i class='fa fa-street-view' style='color:brown;'></i> ".$rn['Address']."</span><br>
                                        <span style='color:#428bca;'><i class='fa fa-phone-square' style='color:brown;'></i> ".$rn['TelNo']."</span><br>
                                        <span style='color:#428bca;'><i class='fa fa-envelope' style='color:brown;'></i> ".$rn['Email']."</span><br>
                                      </div>
                                      <div class='comp-logo' style='border:0px solid red;width:120px;height:90px;position:absolute;right:5px;'>
                                      
                                      </div>
                                  <div class='voucher-body-content'>
                                    <div class='voucher-data-wrap'><p style='border-bottom:1px dotted black;font-size:16px; white-space:nowrap;'><a style='border-bottom:1px solid white;font-size:16px;color:red;font-weight:bold;'>Cash Received From:</a><b style='text-transform:Uppercase;'>".$fn."</b>  with ID #:<i>".$SID."</i></p></div>
                                    <div class='voucher-data-wrap'><p style='border-bottom:1px dotted black;font-size:16px;'><a style='border-bottom:1px solid white;font-size:16px;color:red;font-weight:bold;'>Of  </a> ".$Crnc.$amt."</p></div>
                                    <div class='voucher-data-wrap'><p style='border-bottom:1px dotted black;font-size:16px;'><a style='border-bottom:1px solid white;font-size:16px;color:red;font-weight:bold;'>For:</a> ".$des."</p></div>
                                  </div> 
                                  <div class='voucher-sub-title'>
                                    <div>Payment Received in</div>
                                    <div class='voucher-sub-table-left'>
                                        <table style='text-align:center;'>
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;font-style:bold;background:#ccc;color:green;'>Cash</td>
                                                <td style='border:1px solid gray;width:50px;text-align:center;color:green;'><i class='fa fa-check-square-o'></i></td>
                                            </tr>
                                                
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;font-style:bold;background:#ccc;color:green;'>Cheque</td>
                                                <td style='border:1px solid gray;'></td>
                                            </tr>
                                            
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;font-style:bold;background:#ccc;color:green;'>Other</td>
                                                <td style='border:1px solid gray;'></td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                     <div class='voucher-sub-table-right'>
                                        <table style='text-align:center;'>
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;width:140px;font-style:bold;text-align:center;background:#ccc;color:green;'>Total Amount Due</td>
                                                <td style='border:1px solid gray;width:140px;text-align:center;color:red;'>".$AmtDue."</td>
                                            </tr>
                                                
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;font-style:bold;background:#ccc;color:green;text-align:center;'>Amount Received</td>
                                                <td style='border:1px solid gray;text-align:center'>".$amt."</td>
                                            </tr>
                                            
                                            <tr>
                                                <td style='padding:2px;border:1px solid gray;font-style:bold;background:#ccc;color:green;'>Balance Due</td>
                                                <td style='border:1px solid gray;color:blue;'>".$Balance."</td>
                                            </tr>
                                        </table>
                                    </div>
                                     <div style='width:200px;padding-top:40px; outline:0px solid black;float:left;height:60px;padding-left:5px;'>
                                        <div class='voucher-sign'>
                                            
                                        </div><br>
                                        <div style='text-align:center;'>Signed by</div>
                                     </div>
                                  </div>
                               </div>
                             </div>

                       ";
                }
              }      
            }
        } 
     }
?>
<style>
    *{
        padding:0;
        margin:0;
        font-family:Calibri,Tahomam,Arial
    }
    
    body{
        background-color:gray;
    }
    .rpt-header-wrapper{
        width: 100%;
        height:25px;
        margin: 0;
        padding: 0;
        background: white;
        box-shadow: -2px 2px 2px rgba(0, 0, 0, .3);
        position: relative;
    }
    .rpt-body-wrapper{
        height:inherit;
        max-width:505px;
        position: relative;
        height:430px;
        background: white;
        margin:3px auto 10px auto;
        box-shadow: -2px 2px 2px rgba(0, 0, 0, .3);
    }
    .rpt-body-header-wrap{
        width: inherit;
        height: auto;
        border-top:0px solid gray;
    }
    .rpt-body-title-wrap{
        width:500px;
        height:400px;
        border:1px solid gray;
        overflow: hidden;
    }
    .company-details{
        width:inherit;
        height: auto;
        border:1px solid gray;
        position: relative;
        float:left;
        padding-left: 5px;
    }
    .comp-logo{
        background: url('<?php echo $loc; ?>/img/logo.png')no-repeat;
        background-size: contain;
        background-position: center;

    }
    .voucher-body-content{
        width: inherit;
        height:100px;
        border:0px solid green;
        float:left;
    }
    .logo{
        width:30%;
        max-width:140px;
        height: inherit;
        border:0px solid gray;
        position: relative;
        float:right;
        background: url('<?php echo $loc; ?>/img/logo.jpg')no-repeat; 
    }
    .voucher-data-wrap{
        width:inherit;
        height:20px;
        border:0px solid #2a2a2a;
        padding:5px 0px 5px 3px;
    }
    .voucher-sub-title{
       width: inherit;
        height:200px;
        border:0px solid blue;
        float:left; 
    }
    .voucher-sub-table-left{
        width:auto;
        height:auto;
        border:0px solid orangered;
        float:left;
        
    }
     .voucher-sub-table-right{
        width:auto;
        height:auto;
        border:0px solid orangered;
        padding-left:30px;
        float:left;
    }
    .voucher-sign{
        width:200px;
        height:40px;
        float:left;
        border-bottom: 1px solid black;
    }
    
    @media print{
        .rpt-header-wrapper, .rpt-header-wrapper *{
            display: none !important;
        }
    }
</style>


