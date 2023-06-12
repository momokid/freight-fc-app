<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {
    $a = mysqli_query($dbc, "select * from new_container_temp where Username='$Uname' order by Time");


    if (mysqli_num_rows($a) == 0) {
        echo '';
    } else {

        // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
        echo '<table class="table table-bordered" style="padding:0px;" id="ContainerDetailstTemp">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">SEAL</th>
                        <th scope="col">BILL OF LADING</th>
                        <th scope="col">CONT. NO & SIZE</th>
                        <th scope="col">WEIGHT (KG)</th>
                        <th scope="col">ESTIMATED COST</th>
                        <th scope="col">DATE</th>
                      </tr>
                    </thead>
                    <tbody>';
        //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
        while ($an = mysqli_fetch_assoc($a)) {
            echo '
                <tr>
                  <td scope="col">' . $an['SealNo'] . '</td>
                  <td scope="col">' . $an['BOL'] . '</td>
                  <td scope="col">' . $an['ContainerNo'] . '/' . $an['ContainerSize'] . '</td>
                  <td scope="col">' . $an['Weight'] . '</td>
                  <td scope="col">' . $an['HandlingCost'] . '</td>
                  <td scope="col">' . strftime("$dtf", strtotime($an['Date'])) . '  <i class="fa fa-trash text-danger temp_container_details" cnt="' . $an['ContainerNo'] . '" seal="' . $an['SealNo'] . '"></i></td>
                </tr> ';
        }

        echo '</tbody>
             </table>';
    }
}
?>

<style>
    .thead-gray {
        background: gray;
        color: white;
        font-size: 14px;

    }

    .table-r0:hover {
        background: black;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    $('#ContainerDetailstTemsp').DataTable();

    $('.temp_container_details').click(function() {
        let cnt = $.trim($(this).attr('cnt'));
        let seal = $.trim($(this).attr('seal'));

        let q = confirm("Remove container details?");
        if (q) {
            $('body').append(
                '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
            );
            $.post('remove_container_details_temp.php', {
                cnt: cnt,
                seal: seal
            }, function(a) {
                if (a == 1) {
                    $('.progress-loader').remove();
                    $('#display_new_container_details').load(
                        'load_new_pending_container_details_temp.php'
                    );
                    $('#sealNo_new_conisgnment').focus();
                } else {
                    $('.progress-loader').remove();
                    alert(a);
                }

            });
        } else {
            return false;
        }


    });
</script>