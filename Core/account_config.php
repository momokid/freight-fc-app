<?php

//Egt Company Details
function reportCompanyHeading($branchId)
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM inst_branch_view WHERE BranchID='$branchId'");

    if (mysqli_num_rows($a) == 1) { 
        $an = mysqli_fetch_assoc($a);
        ?>
        <div class="d-flex flex-column align-items-center text-dark font-weight-bold mb-3">
            <span class="fs-2"><?= $an['InstName'] ?></span>
            <span><?= $an['Address'] ?></span>
            <span><?= $an['Location'] ?></span>
            <span><?= $an['TelNo'] ?></span>
            <span><?= $an['Email'] ?></span>
        </div>
<?php }
}

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


//Get Cashbook A/C
function getActiveCashbook()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_cashbook");

    if (mysqli_num_rows($a) == 0) {
        $res = [
            'code' => 301,
            'status' => false,
            'msg' => 'CASHBOOK ACCOUNT NOT FOUND',
        ];
    } else {
        $an = mysqli_fetch_assoc($a);

        $res = [
            'code' => 200,
            'status' => true,
            'AccountNo' => $an['AccountNo']
        ];
    }

    return $res;
}


//Get IE A/C
function getActiveIEDisbursement()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_ie");
    $b = mysqli_query($dbc, "SELECT * FROM active_accounts");

    if (mysqli_num_rows($a) == 0) {
        $res = [
            'code' => 301,
            'status' => false,
            'msg' => 'RETAINED EARNINGS ACCOUNT NOT FOUND',
        ];
    } else {
        $an = mysqli_fetch_assoc($a);
        $bn = mysqli_fetch_assoc($b);

        $res = [
            'code' => 200,
            'status' => true,
            'AccountNo' => $an['AccountID'],
            'ActiveIE' => $bn['IE_Main']
        ];
    }

    return $res;
}

//Get active ie account
function getHandlingChargeIncome()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_handling_cost");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        return $an['AccountNo'];
    }
}

//Generate service charge ID
function getServiceChargeID()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM service_charge_main");

    if (mysqli_num_rows($a) == 0) {

        return 200001;
    } else {

        $l = mysqli_query($dbc, 'SELECT MAX(ServiceID) AS ID FROM service_charge_main');

        $ln = mysqli_fetch_assoc($l);

        return $ln['ID'] + 1;
    }
}


//Get  service charge income
function getServiceChargeIncome()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_service_charge");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        return $an['AccountNo'];
    }
}

//Get  service charge income
function getActiveAccounts()
{
    global $dbc;

    $a = mysqli_query($dbc, "SELECT * FROM active_accounts");

    if (mysqli_num_rows($a) == 0) {
        die('ACCOUNT NOT FOUND');
    } else {
        $an = mysqli_fetch_assoc($a);

        $accounts = [
            'IE_Main' => $an['IE_Main'],
            'VehicleFixedAsset' => $an['VehicleFixedAsset'],
            'VehicleFixedAsset' => $an['VehicleFixedAsset'],
            'AccountPayable' => $an['AccountPayable'],
            'IncomeOnTransport' => $an['IncomeOnTransport'],
        ];

        return $accounts;
    }
}

//Bundles all user authorization
$userAuth = userAuth($_SESSION['Uname'])['auth'];
