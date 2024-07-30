<?php



//start the session
session_start();

//Database connection
include('cn/cn.php');

$Uname = mysqli_real_escape_string($dbc, $_SESSION['Uname']);
$BranchID = mysqli_real_escape_string($dbc, $_SESSION['BranchID']);
$ActiveDate = mysqli_real_escape_string($dbc, $_SESSION['ActiveDay']);

$id =  trim(mysqli_real_escape_string($dbc, $_POST['id']));

if (!isset($_SESSION['Uname'])) {

    header('Location: login');
} elseif (!isset($_SESSION['BranchID'])) {

    header('Location: login');
} else {

    $a = mysqli_query($dbc, "SELECT * FROM journal_all_entries_view_1 WHERE ReceiptNo='$id'");

?>

    <div class="table-responsive">
        <table class="table table-bordered border-primary">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ACCOUNT NAME</th>
                    <th scope="col">ACCOUNT TYPE</th>
                    <th scope="col">DEBIT</th>
                    <th scope="col">CREDIT</th>
                    <th scope="col" colspan="2">DESCRIPTION</th>
                    <th scope="col">DATE</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($id == "") { ?>

                    <tr class="table-warning">
                        <th scope="row" colspan="7"></th>
                    </tr>

                <?php } else if (mysqli_num_rows($a) == 0) { ?>

                    <tr class="table-warning">
                        <th scope="row" colspan="7">Transaction details not found for Receipt # <?= $id; ?></th>
                    </tr>

                    <?php

                } else {
                    while ($an = mysqli_fetch_assoc($a)) { ?>
                        <tr>
                            <td scope="col"><?= $an['SubAccountName']; ?></td>
                            <td scope="col"><?= $an['Type']; ?></td>
                            <td scope="col"><?= formatToCurrency($an['Dr']); ?></td>
                            <td scope="col"><?= formatToCurrency($an['Cr']); ?></td>
                            <td scope="col" colspan="2"><?= $an['Description']; ?></td>
                            <td scope="col"><?= formatDate($an['Date']); ?></td>
                        </tr>
                    <?php } ?>

                    <span id="journal_id" class="sr-only"><?= $id; ?></span>
                    <tr>
                        <td class="" colspan="8">
                            <button type="button" class="btn btn-danger" id="btn_journal_transaction_reversal"><span class="fas fa-trash"></span> <span class="font-weight-bold"><?= $id; ?></span></button>
                        </td>
                    </tr>

                <?php  } 
             } ?>

            </tbody>
        </table>
    </div>

    <!-- 
    
1. When you delete disbursement analysis, update container status in container details to 1

-->

    <script>
        $('#btn_journal_transaction_reversal').click(function() {
            let id = $('#journal_id').text();

            let q = confirm('Reverse transaction?')

            $(".progress-loader").remove();

            if (q) {
                $("body").append(
                    '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
                );

                $.post("delete_journal_transaction.php", {
                    id
                }, function(response) {

                    let data = JSON.parse(response);

                    if (data.code == 200) {

                        receipt = "";

                        $.post("get_tranasction_journal.php", {
                            id: receipt
                        }, function(response) {

                            $('#display_search_results_edit').html(response)

                            $(".progress-loader").remove();

                        });

                    } else {

                        alert(data.msg)

                        $(".progress-loader").remove();

                    }
                });


            } else {
                return false;
            }
        })
    </script>