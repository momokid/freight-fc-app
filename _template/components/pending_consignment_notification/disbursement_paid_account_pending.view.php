<?php
include("../../../cn/cn.php");

function getfirst($bl)
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM disbursement_analysis_view WHERE BL='$bl'");

    if(mysqli_num_rows($a) > 0){
        while($an = mysqli_fetch_assoc($a)){
            echo '<span class="badge text-bg-secondary text-truncate timer m-1">
                    ' . $an['AccountName'] . '.
                 </span>';
        }
        
    }else{
        echo "No payment made";
    }

    
}
