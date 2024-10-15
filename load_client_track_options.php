<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$cns = mysqli_real_escape_string($dbc, $_POST['cns']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "SELECT * FROM consignee_main WHERE ConsigneeID='$cns'");

    if (mysqli_num_rows($a) > 0) {

        while ($an = mysqli_fetch_assoc($a)) { ?>
            <h3 class="card-title font-weight-bold"><?= $an['FullName']?></h3>
            <p class="card-text"><?= $an['TelNo']?></p>
            <p class="card-text"><?= $an['Address1']?>, <?= $an['Address2']?>.</p>
            <a href="#" class="btn btn-dark" id="<?= $an['ConsigneeID']?>">Edit Profile</a>
<?php }
    }
}
?>

<style>
    .client_profile_tr td button {
        margin-left: 5px;
    }

    .i-client_profile_options {
        cursor: pointer;
    }
</style>

<script>
    $('.i-client_profile_options').click(function() {
        let mbl = $.trim($(this).attr('mbl'));
        let hbl = $.trim($(this).attr('hbl'));
        let cns = $.trim($(this).attr('cns'));

        $('.progress-loader').remove();
        
        //alert(`${cns} and ${hbl} and ${mbl}`);
        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $.post('insert_recno_rpt.php', {
            ldt: cns,
            sid: hbl,
            cid: mbl
        }, function(a) {
            var win = window.open();
            win.location = "load_consignee_housebl_view.php", "_blank";
            win.opener = null;
            win.blur();
            window.focus();
            $('.progress-loader').remove();
        });

    });
</script>