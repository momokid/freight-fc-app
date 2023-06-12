<?php

//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);
$fdt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_GET['fdt'])));
$ldt = mysqli_real_escape_string($dbc, strftime("%Y-%m-%d", strtotime($_GET['ldt'])));

if (!isset($_SESSION['Uname'])) {
    header('Location: login');
} else {

    $a = mysqli_query($dbc, "select * from declaration_main where Date between '$fdt' and '$ldt' ORDER BY Date asc");
    if (mysqli_num_rows($a) == 0) {
        echo '<table class="table table-bordered table-responsive" style="padding:0px;">
                         <thead class="thead-lig">
                           <tr>
                           <th scope="col">DATE</th>
                             <th scope="col">DECL. #</th>
                             <th scope="col">BL/ HBL</th>
                             <th scope="col">AGENT NAME</th>
                             <th scope="col">AMOUNT CHARGED</th>
                           </tr>
                         </thead>
                         <tbody>

                         </tbody>
                       </table>';
    } else {

        // echo'<label style="text-align:center;margin-top:0px;width:100%;font-weight:bold;text-transform:uppercase;border:1px solid black;">'.$zn[FullName].'</label>';
        echo '<table class="table table-bordered" style="padding:0px;" id="DeclProcessView">
                         <thead class="thead-dark">
                           <tr>
                           <th scope="col">DATE</th>
                           <th scope="col">DECL. #</th>
                           <th scope="col">BL/ HBL</th>
                           <th scope="col">AGENT NAME</th>
                           <th scope="col">AMOUNT</th>
                           </tr>
                         </thead>
                <tbody>';
        //  $b = mysqli_query($dbc, "select distinct SubjectID,SubjectName from temp_staff_class_subj_mapp_view where Username='$Uname' ORDER by SubjectName");
        while ($an = mysqli_fetch_assoc($a)) {
            echo '
                     <tr data-toggle="modal" id="' . $an['DeclarationNo'] . '" data-target="#viewDelcarationProcess" class="trProcessedDeclaration">
                        <td scope="col">' . strftime("$dtf", strtotime($an['Date'])) . '</td>
                       <td scope="col">' . $an['DeclarationNo'] . '</td>
                       <td scope="col">' . $an['BL'] . '</td>
                       <td scope="col">' . $an['AgentContact'] . '</td>
                       <td scope="col">' . number_format($an['Amount'], 2, '.', ',') . '</td>
                    </tr> ';
        }

        echo '      </tbody>
             </table>';
    }
}

?>

<style>
    .thead-lig {
        background: green;
        color: white;
    }

    .trProcessedDeclaration:hover {
        background: #bbb;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {
        $('#DeclProcessView').DataTable();

        $('.trProcessedDeclaration').click(function() {
            let id = $.trim($(this).attr('id'));

            if (id == '') {
                alert('Declaration No. not found');
                return false;
            } else {
                $('body').append(
                    '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
                );
                $('#display_ProcessDeclaration').html('');
                $.get('load_declaration_process_detail.php', {
                    id: id
                }, function(a) {
                    $('.progress-loader').remove();
                    $('#display_ProcessDeclaration').html(a);
                })
            }
        });

    });
</script>