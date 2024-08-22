<?php
include("cn/cn.php");

$a = mysqli_query($dbc,"SELECT * FROM disbursement_analysis");
if(mysqli_num_rows($a) > 0){
    echo "we get data";
}else{
    echo "we no get";
}
?>

