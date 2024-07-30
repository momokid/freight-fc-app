        <!-- Begin Transaction Report Content -->
        <div class="container-fluid sub-basic-setup" id="new-accounting-report">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Transaction Report</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <?php

                include_once 'modules/report/_income_report.php';
                include_once 'modules/report/_expense_report.php';
                include_once 'modules/report/_general_ledger_report.php';
                ?>

                <?php

                //$userAuth('AccountingReport');
                include_once 'modules/report/_financial_statement.php';
                include 'modules/report/_income_statement.php';
                include 'modules/report/_cashflow_statement.php'; 
                
                ?>

            </div>

        </div>