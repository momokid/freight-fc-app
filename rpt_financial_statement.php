<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);


if (!isset($_SESSION['Uname'])) {
    header('Location: case-login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM rpt_multi_values_0 where Username='$Uname'");
    $b = mysqli_query($dbc, "select * from inst_branch_view where BranchID='$BranchID'");

    if (mysqli_num_rows($b) == 0) {
        die('Error detected: Report not genarated.');
    } else {
        $bn = mysqli_fetch_assoc($b);

        if (mysqli_num_rows($a) == 0) {
            die('Records not found');
        } elseif (mysqli_num_rows($a) <> 1) {
            die('Multiple records detected');
        } else {
            $an = mysqli_fetch_assoc($a);
        }
    }
}


?>

<!doctype html>

<html>

<head>
    <title>FINANCIAL STATEMENT</title>
    <?php
    include 'script.php';
    ?>
</head>

<body style="border: 0px solid green;">
   <?php 
   
   include_once("modules/report/template/statement_financial_position_view.php"); 

   ?>
    <div style="height: 0px;" class="m-3">
        <!-- here we call the function that makes PDF -->
        <input class="btn btn-dark no-print" type="button" onClick="window.open('view_financial_statement_report.php')" value="PRINT VIEW">
    </div>
</body>

</html>
<style>
    th,
    tr,
    td {
        border: 0px solid black;
    }

    .tbl-data-header td {
        font-size: 14px;
        border: 1px solid black;
        padding: 2px;
        text-align: center;
        font-weight: bold;
        background: black;
        color: white;
    }

    .tbl-data td {
        text-align: left;
        border: 1px solid black;
        padding-left: 3px;
        text-transform: uppercase;
        text-align: center;
    }

    .tbl-final td {
        font-weight: bold;
        border: 1px solid black;
    }


    @media print {
        @page {
            size: landscape
        }
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>