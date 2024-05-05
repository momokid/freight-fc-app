<?php

//Get active ie account
function getActivePNL()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_ie");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        return $an['AccountID'];
    }
}

//Get Disbursement Income Account
function getDefaultDisbursementIncomeAccount()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM disburement_income_account");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        return $an['AccountNo'];
    }
}


//Get Active Vault Account
function getActiveVaultAccount()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_vault");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        return $an['AccountNo'];
    }
}