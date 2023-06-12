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
    $d = mysqli_query($dbc, "select * from temp_manifestation_breakdown_view where Username='$Uname' order by Time");
    $dn = mysqli_fetch_assoc($d);

    $b = mysqli_query($dbc, "select * from temp_mainbl_new_consignee where Username='$Uname' and MainBL='$dn[MainBL]'");
    if (mysqli_num_rows($b) == 0) {
        die('Manifestation breakdown not found');
    } else {
        $bn = mysqli_fetch_assoc($b);

        $a = mysqli_query($dbc, "select * from temp_manifestation_breakdown_view where Username='$Uname' order by Time");
        if (mysqli_num_rows($a) == 0) {
            echo '<table class="table table-bordered" style="padding:0px;" id="dataTables">
                         <thead class="thead-lig">
                           <tr>
                             <th scope="col">HOUSE BL</th>
                             <th scope="col">CONSIGNEE</th>
                             <th scope="col">DESCRIPTION</th>
                             <th scope="col">WEIGHT(KG)</th>
                             <th scope="col">PACKAGE</th>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>';
        } else {

            // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
            echo '<table class="table table-bordered" style="padding:0px;" id="TempHblTbl">
                         <thead class="thead-dark">
                           <tr>
                             <th scope="col">HOUSE BL</th>
                             <th scope="col">CONSIGNEE</th>
                             <th scope="col">CONTAINER NO.</th>
                             <th scope="col">DESCRIPTION</th>
                             <th scope="col">PACKAGE</th>
                             <th scope="col">WEIGHT(KG)</th>
                             <th scope="col"></th>
                           </tr>
                         </thead>
                         <tbody>';
            //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
            while ($an = mysqli_fetch_assoc($a)) {
                echo '
                     <tr>
                       <td scope="col">' . $an['HouseBL'] . '</td>
                       <td scope="col">' . $an['FullName'] . '</td>
                       <td scope="col">' . $an['ContainerNo'] . '</td>
                       <td scope="col">' . $an['Description'] . '</td>
                       <td scope="col">' . $an['Package'] . ' ' . $an['Unit'] . '</td>
                       <td scope="col">' . number_format($an['Weight'], 2, '.', ',') . '</td>
                       <td scope="col"><i class="fas fa-edit text-warning temp_hbl_edit" text="Edit" cid="' . $an['HouseBL'] . '" data-toggle="modal" data-target="#editManifestBreakdownTemp" id="addConsigneeModal"></i> <i class="fa fa-trash text-danger temp_hbl_del" cid="' . $an['HouseBL'] . '"  mbl="' . $an['MainBL'] . '" ></i></td>
                    </tr> ';
            }
            $c = mysqli_query($dbc, "select * from temp_manifestation_breakdown_total_weight_view_0 where Username='$Uname' and MainBl='$dn[MainBL]'");
            $cn = mysqli_fetch_assoc($c);
            $Rem_Weight = round($bn['ContWeight'] - $cn['TW'], 2);
            echo '
                     <tr>
                       <td scope="col" colspan="2">TOTAL WEIGHT ADDED: <b>' . number_format($cn['TWeight'], 2, '.', ',') . '</b></td>
                       <td scope="col"></td>
                       <td scope="col" colspan="3">OUTSTANDING WEIGHT(KG): <b class="text-danger">' . number_format($cn['RemWieght'], 2, '.', ',') . '</b></td>
                     </tr> ';

            echo '</tbody>
             </table>';
        }
        echo '
                <div class="form-group row">
                    <form class="user">
                      <a class="btn btn-dark btn-user btn-block" id="btn_save_consignee_manifestation">
                        Save Manifest Breakdown
                      </a>
                    </form>
                </div>';
    }
}
?>

<style>
    .thead-lig {
        background: green;
        color: white;
    }

    .table-r0:hover {
        background: black;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        $('#TempHblTbls').DataTable();

        //Edit temp huse bl
        $('.fa-edit').click(function() {
            let id = $(this).attr('cid');

            //alert(id);
            $.post('insert_recno_rpt.php', {
                cid: id
            }, function() {
                $('#editTempBreakdown_body').load('load_edit_temp_manifestation_breakdown.php');
            });
        });

        //Delete temp house bl
        $('.temp_hbl_del').click(function() {
            let id = $(this).attr('cid');
            let mbl = $(this).attr('mbl');

            let q = confirm(`Delete manifest breakdown of ${id}`);

            if (q) {
                $('#manifestation_breakdown_card').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
                $.post('remove_temp_manifest_breakdown.php', {
                    hbl: id,
                    mbl: mbl
                }, function(a) {
                    if (a == 1) {
                        $('#cosignee_house_bl_display_details').load('load_cosignee_manifestation_temp.php');
                        $('.progress-loader').remove();
                    } else {
                        alert(a);
                        $('.progress-loader').remove();
                        return false;
                    }
                });

            } else {
                $('.progress-loader').remove();
                return false;
            }
        });

        $('#btn_save_consignee_manifestation').click(function() {
            q = confirm('Save manifestation breakdown?');

            if (q) {
                $('#manifestation_breakdown_card').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');
                $.post('run_cosignment_manifestation_breakdown.php', {}, function(a) {
                    if (a == 1) {
                        alert('Manifestation breakdown successfully');
                        $('#cosignee_house_bl_display_details').load('load_cosignee_manifestation_temp.php');
                        $('#cosignee_main_bl_display_details').load('load_temp_mainbl_new_consignee.php');


                        let q = confirm('Show Cargo Manifest Breakdown?');
                        if (q) {
                            window.open("rpt_manifestation_breakdown_consignee.php", "_blank");
                        } else {
                            $('.progress-loader').remove();
                            return false;
                        }
                        $('.progress-loader').remove();
                    } else {
                        alert(a);
                        $('.progress-loader').remove();
                    }
                });
            } else {
                return false;
            }

        });
    });
</script>