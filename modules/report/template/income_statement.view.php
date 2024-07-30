<?php $d = mysqli_query($dbc, "SELECT * FROM pnl_transaction_general WHERE (Date BETWEEN '$an[FDate]' and '$an[LDate]')");
    $dn = mysqli_fetch_assoc($d);

    ?>
    <table class="" style="width:1000px;border: 0px solid red;margin-top: 5px;color:black;margin-left: 10px;">
        <thead>
            <tr style="font-weight:bold;" width="140">
                <td style="text-align: center;">
                    <div><img src="img/logo1.png" height="100rem" /></div>
                </td>
                <td colspan="3" scope="col" style="text-align: center;">
                    <div style="font-size: 15px;text-transform: uppercase;"><?= $bn['InstName']  ?></div>
                    <div style="font-size: 15px;"><?= $bn['Address']  ?></div>
                    <div style="font-size: 15px;"><?= $bn['Email']  ?></div>
                    <div style="font-size: 15px;"><?= $bn['Location']  ?></div>
                </td>
                <td width="300;">
                    <div style="margin-top:-2rem;padding:0.5rem;float:right;background:orangered;color:white;">
                        <span style="font-size: 15px;">INCOME STATEMENT</span><br>
                        <span style="font-size: 15px;">BRANCH: <?= $bn['BranchName']; ?></span><br>
                        <span style="font-size: 15px;">DATE: <?= strftime("$dtf", strtotime($an['FDate'])); ?> <em>TO</em> <?= strftime("$dtf", strtotime($an['LDate'])); ?></span>
                    </div>
                </td>
            </tr>
        </thead>
        <?php
        $c = mysqli_query($dbc, "SELECT * FROM income_statement_view_2 WHERE RptUsername='$Uname'");

        if (mysqli_num_rows($c) == 0) {
            die('<table class="tbl-error" style="margin-top: 50px;
            font-weight: bold;
            font-size: 24px;"><tr><td>Report details not found</td></tr></table>');
        }

        ?>
        <tbody>
            <tr class="tbl-head-border">
                <td colspan="5">
                    <div style="border:1px solid black;margin:20px 0px;"></div>
                </td>
            </tr>
            <tr class="tbl-data no-border">
                <td colspan="4" class="no-border"></td>
                <td colspan="1" class="no-border"></td>
            </tr>
            <?php
            $b = mysqli_query($dbc, "SELECT DISTINCT CategoryName,CategoryID FROM income_statement_view_2 WHERE RptUsername='$Uname' ORDER BY CategoryName Desc");
            while ($bn = mysqli_fetch_assoc($b)) { ?>
                <tr class="tbl-data-header">
                    <td colspan="1" class="bg-black"><?= $bn['CategoryName'] ?></td>
                    <td colspan="4" class="bg-black"></td>
                </tr>
                <?php
                $c = mysqli_query($dbc, "SELECT distinct SubCategoryID,SubCategoryName FROM income_statement_view_2 WHERE CategoryID='$bn[CategoryID]' and RptUsername='$Uname'");
                while ($cn = mysqli_fetch_assoc($c)) { ?>
                    <tr class="tbl-data tbl-final">
                        <td colspan="1"><?= $cn['SubCategoryName'] ?></td>
                        <td colspan="3" class="no-border"></td>
                    </tr>
                    <?php
                    $d = mysqli_query($dbc, "SELECT * FROM income_statement_view_2 WHERE SubCategoryID='$cn[SubCategoryID]' AND RptUsername='$Uname' ORDER BY AccountName");
                    while ($dn = mysqli_fetch_assoc($d)) { ?>
                        <tr class="tbl-data">
                            <td class="no-border"></td>
                            <td colspan="2"><?= $dn['AccountName'] ?></td>
                            <td colspan="2"><?= formatToCurrency($dn['TBal']) ?></td>
                        </tr>
                    <?php }


                    $f = mysqli_query($dbc, "SELECT round(sum(TBal),2) AS CatBal FROM income_statement_view_2 WHERE SubCategoryID='$cn[SubCategoryID]' AND RptUsername='$Uname' Group By SubCategoryID");
                    while ($fn = mysqli_fetch_assoc($f)) { ?>
                        <tr class="tbl-data tbl-final">
                            <td colspan="1" class="no-border"></td>
                            <td colspan="2" class="no-border"></td>
                            <td colspan="2" class="bg-black"><?= formatToCurrency($fn['CatBal']) ?></td>
                        </tr>
                        <tr>
                            <td class="no-border">.</td>
                        </tr>
                    <?php }
                }

                $f = mysqli_query($dbc, "SELECT round(sum(TBal),2) AS CatBal, SubCategoryName, SubCategoryID FROM income_statement_view_2 WHERE CategoryID='$bn[CategoryID]' AND RptUsername='$Uname' Group By CategoryID");
                while ($fn = mysqli_fetch_assoc($f)) { ?>
                    <tr class="tbl-data tbl-final">
                        <td colspan="2" class="no-border"></td>
                        <td colspan="2" class="bg-black"><?= $bn['CategoryName'] ?> SUBTOTAL</td>
                        <td colspan="2" class="bg-black"><?= formatToCurrency($fn['CatBal']) ?></td>
                    </tr>
                    <tr>
                        <td class="no-border">.</td>
                    </tr>
                <?php }
            }

            $g = mysqli_query($dbc, "SELECT round(sum(TBal),2) as TBal FROM income_statement_view_2 WHERE RptUsername='$Uname'");
            while ($gn = mysqli_fetch_assoc($g)) { ?>
                <tr class="tbl-data tbl-final">
                    <td colspan="5">NET PROFIT/LOSS : <?= formatToCurrency($gn['TBal']) ?></td>
                </tr>
            <?php }
            ?>

        </tbody>

    </table>