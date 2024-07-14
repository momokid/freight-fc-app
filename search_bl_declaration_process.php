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
    $result = mysqli_query($dbc, "SELECT * from declaration_process_search where (MainBL like '%$e%')");

    while ($f = mysqli_fetch_assoc($result)) {
        //echo '<div class="student_search_display-wrap"><span class="search_student_details first-search-span">'.$f['StudentID'].'</span><span class="search_student_details second-search-span">'.$f['FullName'].'</span><span class="search_student_details third-search-span">'.$f['CurrentClass'].'</span>'
        //      . '<div class="wrap-details"></div></div><br>';

        echo "<div class='return_search_results cns_dclrt_prcs_search hide_div_note' bl='$f[MainBL]' cns='$f[ConsignmentID]' hbl='$f[HouseBL]' size='$f[ContainerSize]' desc='$f[Description]' tel='$f[AgentContact]'><b>" . $f['VesselName'] . "</b> <e style='color:red;'> [" . $f['MainBL'] . "]</e> <b style='color:blue;'> " . $f['HouseBL'] . "</b></div>";
    }
}


?>

<script>
    $('.cns_dclrt_prcs_search').click(function() {

        var bl = $(this).attr('bl');
        var hbl = $(this).attr('hbl');
        var m = $(this).text();
        var desc = $(this).attr('desc');
        var tel = $(this).attr('tel');
        var size = $(this).attr('size');
        //$('.ep').text('');

        $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
        $('#dclr_prcs_bl_search').val(hbl);
        $('#dclr_prcs_desc').val(desc);
        $('#dclr_prcs_agent_telno').val(tel);
        $('#dclr_prcs_cnt_size').val(size);
        $('.progress-loader').remove();

        $('.cns_dclrt_prcs_search').toggle();
        $('#dclr_prcs_decl_no').focus();
    });
</script>