<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Username']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$e = mysqli_real_escape_string($dbc, $_POST['e']);

if (!isset($_SESSION['Uname'])) {

    header('Location: login');
} elseif ($e == '') {
    die('');
} elseif (!isset($e)) {
    die('Search key not found');
} else {
    $result = mysqli_query($dbc, "select * from container_main_view_3 where BL like '%$e%'");

    while ($f = mysqli_fetch_assoc($result)) {
        //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
        //      . '<div class="wrap-details"></div></div><br>';

        echo "<div class='return_search_results form_master_search hide_div_note'  cns=" . $f['ConsignmentID'] . " id='$f[BL]' cnt=" . $f['ContainerNo'] . "><b>" . $f['BL'] . "</b> " . $f['ShipperName'] . " ~ " . $f['ContainerNo'] . "</div>";
    }
}


?>

<script>
    $('.form_master_search').click(function() {

        var cns = $(this).attr('cns');
        var bl = $(this).attr('id');
        var cnt = $(this).attr('cnt');
        var m = $(this).text();

        //$('#edit_std_info_display_board').html(e);
        $('#mainBL_search_conisgnee').val(m);
        $('#seach_mainBL_new_consignee').text(bl);

        $.post('add_mainbl_newconsignee.php', {
            cns: cns,
            bl: bl,
            cnt: cnt
        }, function(a) {
            if (a == 1) {
                $('#cosignee_main_bl_display_details').load('load_temp_mainbl_new_consignee.php');
                $.post('get_new_house_bl_number.php', {}, function(a) {
                    $('#houseBL_consignee_breakown').val(a);
                });

            } else {
                alert(a);
            }
        });

        // $('#mapp_StaffClass').load('load_staff_class_map.php');
        //  $('#mapp_StaffSubject').load('load_staff_subject_map.php');

        $('.form_master_search').toggle();
        $('#search_hbl_consignee_fname').focus();
    });
</script>