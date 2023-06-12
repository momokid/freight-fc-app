<?php

//start the session
session_start();

//Database connection
include ('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate= mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$acc=  intval(trim(mysqli_real_escape_string($dbc,$_POST['acc'])));
$amt=  floatval(trim(mysqli_real_escape_string($dbc,$_POST['amt'])));
$taxStatus=  trim(mysqli_real_escape_string($dbc,$_POST['taxStatus']));


if(!isset( $_SESSION['Uname'])){	
	header('Location: login');
}elseif($acc==''){
    die('Select Account');
}elseif($amt<=0){
    die('Enter Amount');
}else{
    $t = mysqli_query($dbc, "select * from charge_taxes");
    if(mysqli_num_rows($t)==0){
        die('Taxes not setup');
    }else{
    $a = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp where Username<>'$Uname'");
    
    if(mysqli_num_rows($a)>0){
        die('Invoicing already initiated by '.$Uname);
    }else{

        $tn = mysqli_fetch_assoc($t);
        if($taxStatus == 'false'){
            $tn['GetFund']=0;
            $tn['VAT']=0;
            $tn['Covid']=0;
        }

        $b = mysqli_query($dbc, "select distinct MainBL,HouseBL, ConsignmentID,ConsigneeID from hbl_invoice_consignee_temp where Username='$Uname'"); 
        
        if(mysqli_num_rows($b)>1){
            die('Multiple processing detecting for this user');
        }else{
            $an = mysqli_fetch_assoc($b);
            $e = mysqli_query($dbc, "select * from hbl_invoice_consignee_temp where Username='$Uname' and AccountNo='$acc'");
            
            if(mysqli_num_rows($e)>0){
                $c = mysqli_query($dbc, "update hbl_invoice_consignee_temp set Amount='$amt',VAT='$tn[VAT]',Covid='$tn[Covid]',GetFundNHIL='$tn[GetFund]' where Username='$Uname' and AccountNo='$acc' and ConsigneeID='$an[ConsigneeID]' and MainBL='$an[MainBL]' and HouseBL='$an[HouseBL]' and ConsignmentID='$an[ConsignmentID]'");
                if($c){
                    echo '1';
                }else{
                    die($ERR);
                }
            }else{
                $c = $dbc->query("insert into hbl_invoice_consignee_temp values('$an[ConsignmentID]','$an[MainBL]','$an[HouseBL]','$an[ConsigneeID]','$acc','$tn[GetFund]','$tn[Covid]','$tn[VAT]','$amt','$ajaxDate','$ajaxTime','$Uname') ");
            
                if($c){
                    echo '1';
                }else{
                    die($ERR);
                }
            }
            
        }
        
        }
    } 
        
}
