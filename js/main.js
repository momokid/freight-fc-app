$(function () {
  $(".show_hide_password a").on("click", function (event) {
    event.preventDefault();
    if ($(".show_hide_password input").attr("type") == "text") {
      $(".show_hide_password input").attr("type", "password");
      $(".show_hide_password i").addClass("fa-eye-slash");
      $(".show_hide_password i").removeClass("fa-eye");
    } else if ($(".show_hide_password input").attr("type") == "password") {
      $(".show_hide_password input").attr("type", "text");
      $(".show_hide_password i").removeClass("fa-eye-slash");
      $(".show_hide_password i").addClass("fa-eye");
    }
  });

  //Loader/ Spinner function
  function Spinner() {
    return `<div style="display:flex;align-items:center;justify-content:center;">
              <div style='font-size:30px;'>
                <i class='fa fa-spinner faa-spin animated fa-2x'></i>
              </div>
            </div>`;
  }

  //Remove spinner function
  function Spinner_Remove() {
    return $(".progress-loader").remove();
  }

  //Function for fetching receipt no.
  function get_rcpt_no_dt(dt, id) {
    if (dt == "") {
    } else {
      $.post("get_receipt_no_date.php", { dt: dt }, function (a) {
        $(id).text(a);
      });
    }
  }

  //Function for fetching receipt id.
  function get_rcpt_id_dt(dt, id) {
    if (dt == "") {
    } else {
      $.post("get_receipt_id_date.php", { dt: dt }, function (a) {
        $(id).text(a);
      });
    }
  }

  //Function to get Legder Balances
  function getGLBalance(id, accountNo) {
    $.post("get_general_ledger_balance.php", { e: accountNo }, function (b) {
      $(id).text(b);
    });
  }

  //Function to get Income/Expenditure Ledger Balances
  function getIEBalance(id, accountNo) {
    $.post("get_ie_ledger_balance.php", { e: accountNo }, function (b) {
      $(id).text(b);
    });
  }

  //Fetch GL Credit Account Balance
  $("#sel_glDr_account").change(function () {
    let accountNo = $.trim($("#sel_glDr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select GL Credit Account");
      return false;
    }
    getGLBalance("#txt_rglDr_cash_bal", accountNo);
  });

  //Ftech GL Credit Account balance
  $("#sel_glCr_account").change(function () {
    let accountNo = $.trim($("#sel_glCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select GL Debit Account");
      return false;
    }
    getGLBalance("#txt_rglCr_cash_bal", accountNo);
  });

  //Fetch GL Credit Account balance
  $("#sel_glCr_account").change(function () {
    let accountNo = $.trim($("#sel_glCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select GL Credit Account");
      return false;
    }
    getGLBalance("#txt_rglCr_cash_bal", accountNo);
  });

  //Fetch GL Credit Account (DrGlCrIncome) balance
  $("#sel_dr_glDrIncCr_account").change(function () {
    let accountNo = $.trim($("#sel_dr_glDrIncCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select GL Debit Account");
      return false;
    }
    getGLBalance("#txt_dr_glDrIncCr_cash_bal", accountNo);
  });

  //Fetch Income Account (DrGLCrIncome) balance
  $("#sel_cr_glDrIncCr_account").change(function () {
    let accountNo = $.trim($("#sel_cr_glDrIncCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select Income Account");
      return false;
    }
    getIEBalance("#txt_cr_glDrIncCr_cash_bal", accountNo);
  });

  //Fetch Expense Account (DrExpCrGL) balance
  $("#sel_dr_expDrGLCr_account").change(function () {
    let accountNo = $.trim($("#sel_dr_expDrGLCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select Expense Account");
      return false;
    }
    getIEBalance("#txt_dr_expDrGLCr_cash_bal", accountNo);
  });

  //Fetch GL Account (DrExpCrGL) balance
  $("#sel_cr_expDrGLCr_account").change(function () {
    let accountNo = $.trim($("#sel_cr_expDrGLCr_account :selected").attr("id"));

    if (accountNo == "" || accountNo === "undefined") {
      alert("Select GL Account");
      return false;
    }
    getGLBalance("#txt_cr_expDrGLCr_cash_bal", accountNo);
  });

  //Search function

  $(".signup-warn-post").hide();
  $("#join-group").hide();
  $(".alert").hide();
  $(".sub-basic-setup").hide();
  $("#dasboard-panel").show();
  $("#show-recent-discussion").show();

  $("input").val("");
  $("#display_new_grp_members").hide();
  $(".loader-toggler").hide();
  $(".dashboard-mai-tp").show();

  //Show/Hide when clicked on search results of Edit Student Info
  $(document).click(function (e) {
    if ($(e.target).is("#closeTimePicker,#openTimePicker, .hide_div_note *"))
      return false;
    else $(".hide_div_note").hide();
  });

  $("#btn-change-pswd").click(function () {
    return false;
  });

  //Function for fetching ReceiptNo and ReceiptID
  function getReceiptDetails(recid, recno, date) {
    $.post("get_receipt_id_date.php", { dt: date }, function (a) {
      $(recid).text(a);
    });

    $.post("get_receipt_no_date.php", { dt: date }, function (a) {
      $(recno).text(a);
    });
  }

  $(".a-tooltip").tooltip();
  $("#new-group-selected").load("get_new_group_selected.php");
  $("#generate_iq_id_5e").load("get_post_request_id.php");
  $("#generate_iq_no_7s").load("get_post_request_iq.php");

  $(".nav-links").click(function () {
    //$(this).toggleClass("menu-li-btn-active");
    $(".nav-link").removeClass("active");
    $(this).addClass("nav-link active");
  });

  $(".collapse-item").click(function () {
    //$(this).toggleClass("menu-li-btn-active");
    $(".collapse-item").removeClass("active");
    $(this).addClass("collapse-item active");
  });

  //Load New Member list for Group creating
  $("#btn_login_11").click(function () {
    let Uname = $.trim($("#txt_Username_09").val());
    let Pass = $.trim($("#txt_Password_33").val());

    if (Uname == "") {
      alert("Enter Username");
      $("#txt_Username_09").focus();
      return false;
    } else if (Pass == "") {
      alert("Enter Password");
      $("#txt_Password_33").focus();
    } else {
      $("#body").append(
        '<div class="spinner_progrs"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "check_user_login_details.php",
        { Uname: Uname, Pass: Pass },
        function (a) {
          if (a == 1) {
            alert("Invalid login details");
            return false;
          } else {
            window.location.href = a;
            return false;
          }
        }
      );
    }
  });

  //$('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');

  $(".datepicker").datepicker();

  //Setup Ledger Control
  $("#ledger_control_panel").click(function () {
    $(".sub-basic-setup").hide();
    $("#ledger-control-panel").slideDown();
    $("#newledgerControlID").load("get_new_ledger_controlID.php");
    $("#display_new_control_ledger").load("load_ledger_control_tbl.php");
  });

  //Setup Ledger Control
  $("#user_profile").click(function () {
    $(".sub-basic-setup").hide();
    $("#user_profile_panel").slideDown();
    $("#newledgerControlID").load("get_new_ledger_controlID.php");
    $("#display_new_control_ledger").load("load_ledger_control_tbl.php");
  });

  //Setup Ledger Control Category
  $("#ledger_control_category_panel").click(function () {
    $(".sub-basic-setup").hide();
    $("#ledger-control-category-panel").slideDown();
    $("#newledgerCtryID").load("get_new_ledger_ctryID.php");
    $("#display_new_control_ledger").load("load_ledger_control_tbl.php");
  });

  //Setup Ledger Control Account
  $("#ledger_control_account_panel").click(function () {
    $(".sub-basic-setup").hide();
    $("#ledger-control-account-panel").slideDown();
    $("#newledgerAccountID").load("get_new_ledger_accountID.php");
    //$('#display_new_control_ledger').load('load_ledger_control_tbl.php');
    $("#sel_LedgerCtgry").load("load_new_ledger_category.php");
    $("#sel_LedgerContrl").load("load_ledger_control_sel.php");
    $("#display_new_ledger_account").load("load_ledger_account_tbl.php");
  });

  //Setup Charges
  $("#handling_charges_setup_tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#handling_charges_setup_panel").slideDown();
    $("#sel_HandlingCharge_account").load("load_handling_charge_accounts.php");
    $("#display_handling_charges").load("load_handling_charge_tbl.php");
  });

  //Setup Charges
  $("#disbursement_charges_setup_tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#disbursement_charges_setup_panel").slideDown();
    $("#sel_disbursement_account").load("load_disbursement_accounts.php");
    $("#display_disbursement_mapped_account").load(
      "load_disbursement_mapped_accout_tbl.php"
    );
  });

  //New Consignment
  $("#new-consignment-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-consignment-panel").slideDown();
    $("#newConsignmentID").load("get_new_consignment_id.php");
    //$('#new_consignment_rcptid').load('get_receipt_id.php');
    //$('#new_consignment_rcptno').load('get_receipt_no.php');
    $("#sel_pol_new_conisgnment").load("load_sel_pol_list.php");
    $("#sel_pod_new_conisgnment").load("load_sel_pod_list.php");
    $("#sel_shipper_new_conisgnment").load("load_sel_carrier_list.php");
    $("#display_new_container_details").load(
      "load_new_pending_container_details_temp.php"
    );
    $("#display_new_consignment").load("load_new_pending_consignment.php");
  });

  //Get Receipt No
  $("#dot_new_conisgnment").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_no_dt(dt, "#new_consignment_rcptno");
  });

  //Get Receipt ID
  $("#dot_new_conisgnment").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_id_dt(dt, "#new_consignment_rcptid");
  });

  //Get Receipt No
  $("#txt_expDrGLCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_no_dt(dt, "#lbl_expDrGLCr_rcpt_no");
  });

  //Get Receipt ID
  $("#txt_expDrGLCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_id_dt(dt, "#lbl_expDrGLCr_rcpt_id");
  });

  //Get Receipt No
  $("#txt_glDrCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_no_dt(dt, "#lbl_glDrCr_rcpt_no");
  });

  //Get Receipt ID
  $("#txt_pmt_exp_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_id_dt(dt, "#lbl_pmt_exp_rcpt_id");
  });

  //Get Receipt No
  $("#txt_pmt_exp_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_no_dt(dt, "#lbl_pmt_exp_rcpt_no");
  });

  //Get Receipt ID
  $("#txt_glDrCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_id_dt(dt, "#lbl_glDrCr_rcpt_id");
  });

  //Get Receipt No
  $("#txt_glDrIncCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_no_dt(dt, "#lbl_glDrIncCr_rcpt_no");
  });

  //Get Receipt ID
  $("#txt_glDrIncCr_dot").change(function () {
    let dt = $.trim($(this).val());
    get_rcpt_id_dt(dt, "#lbl_glDrIncCr_rcpt_id");
  });

  //New Cargo Manifestation
  $("#new-cargo-manifestation-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-cargo-manifestation-panel").slideDown();
    // $("#newConsignmentID").load("get_new_consignment_id.php");
    // $("#display_new_consignment").load("load_new_pending_consignment.php");
    $("#cosignee_main_bl_display_details").load(
      "load_temp_mainbl_new_consignee.php"
    );
    $("#sel_mbl_assignee_officer").load("load_sel_user_account.php");
    // $("#houseBL_consignee_breakown").load("get_new_house_bl_number.php");
    // $("#cosignee_house_bl_display_details").load(
    //   "load_cosignee_manifestation_temp.php"
    // );
    $("#mainBL_search_conisgnee").focus();
  });

  //House BL invoice
  $("#new-house-bl-invoice-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-house-bl-invoice-panel").slideDown();
    $.post("load_consignee_handling_charges_temp_tbl.php", {}, function (a) {
      $("#cosignee_hbl_invoice_charges_display").html(a);
      // $("#sel_hBL_acc_invoice").load("");
      $("#hBL_amt_invoice").val("");
      $(".progress-loader").remove();
    });
    $("#invoicing_hbl_search_conisgnee").focus();
  });

  //Search Consignee for HBL Invoice
  $("#invoicing_hbl_search_conisgnee").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_hbl_invoicing_consignee.php", { e: e }, function (a) {
      $("#display_hBL_invoicing_search_info").html(a);
    });
  });

  //Customer Waybill
  $("#new-customer-waybill").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-customer-waybill-panel").slideDown();
    // $('#consignee_existing_waybill_details').html(Spinner());
    // $('#consignee_existing_waybill_details').load('load_consignee_existing_waybill.php');

    $("#waybill_consignee_name").focus();
  });

  //Other Service invoice
  $("#new-other-serv-invoice-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#sel_ots_acc_invoice").val("");
    $("#client_charges_display_details").load(
      "load_client_handling_charges_temp_tbl.php"
    );
    $("#new-other-serv-invoice-panel").slideDown();
    $(".client-det-search").focus();
  });

  //Non-Manifest Invoice
  $("#new-non-manifest-invoice-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#sel_ots_acc_invoice").val("");
    $("#client_charges_display_details_nonm").load(
      "load_client_handling_charges_temp_nm_tbl.php"
    );
    $("#sel_ots_acc_invoice_nonm").load("load_sel_billing_account.php");
    $("#new-non-manifest-invoice-panel").slideDown();
    $("#search_consignee_manifest").focus();
  });

  //Receive Hanling Charge
  $("#rcv-invoice-charge-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#rcv-invoice-charge-panel").slideDown();
    $("#invoice_pmt_sel_cash_acc").load("load_sel_cash_account.php");
    $("#consignee_invoice_payment").focus();
  });

  //Receive Hanling Charge
  $("#rcv-customer-charge-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#rcv-customer-payment-panel").slideDown();
    $("#invoice_pmt_sel_cash_acc").load("load_sel_cash_account.php");
    $("#consignee_invoice_payment").focus();
  });

  $("#client_payment_search_client_name").keyup(function () {
    let e = $.trim($(this).val());

    if (e == "") {
      return false;
    } else {
      $.post("search_bl_declaration_process.php", { e: e }, function (d) {
        $("#display_client_payment_search").html(d);
      });
    }
  });

  //
  $("#rpt-client-trans-details").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-client-trans-details").slideDown();
    $("#search_client_profile_rpt").focus();
  });

  //
  $("#rpt-accounting-report").click(function () {
    $(".sub-basic-setup").hide();
    $("#sel_income_rpt_branch").load("load_distinct_income_account_rpt.php");
    $("#sel_gl_rpt_branch").load("load_sel_gl_account.php");
    $("#sel_expenditure_rpt_branch").load(
      "load_distinct_expenditure_account_rpt.php"
    );
    $("#new-accounting-report").slideDown();
  });

  //
  $("#rpt-other-report").click(function () {
    $(".sub-basic-setup").hide();
    //$('.sel_branch_rpt').load('load_distinct_income_account_rpt.php');
    $("#view-other-report").slideDown();
  });

  //
  $("#rpt-disbursement-report").click(function () {
    $(".sub-basic-setup").hide();
    //$('.sel_branch_rpt').load('load_distinct_income_account_rpt.php');
    $("#view-disbursement-report").slideDown();
  });

  //
  $("#rpt-consigment-details").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-consignment-details").slideDown();
    $("#search_consignment_profile_rpt").focus();
  });

  //
  $("#edit-consigment-details").click(function () {
    $(".sub-basic-setup").hide();
    $("#edit-consignment-details").slideDown();
    $("#search_consignment_profile_rpt").focus();
  });

  //
  $("#edit-consigment-weight").click(function () {
    $(".sub-basic-setup").hide();
    $("#edit-consignment-weight").slideDown();
    $("#search_consignment_weight_edit").focus();
  });

  //
  $("#truck-new-driver").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-driver-registration-panel").slideDown();
    $("#new_driver_vehicle_assigned").load("load_sel_vehicle.php");
    $('#display_registered_driver').load("load_registered_driver.view.php");
    $("#new_driver_fname").focus();
  });

  //
  $("#reverse-transaction").click(function () {
    $(".sub-basic-setup").hide();
    $("#reverse-transaction-panel").slideDown();
    $("#search_consignment_weight_edit").focus();
  });

  //
  $("#schedule-trip").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-schedule-trip-panel").slideDown();
    $("#search_consignment_weight_edit").focus();
  });

  //
  $("#truck-new-vehicle").click(function () {
    $(".sub-basic-setup").hide();
    $("#new-vehicle-registration-panel").slideDown();
    $("#search_consignment_profile_rpt").focus();
    $("#new_vehicle_credit_account").load("load_sel_cash_account.php");
    $('#display_registered_vehicles').load("load_registered_vehicles.view.php");
  });

  //Pay Handling Charge
  $("#pay-invoice-charge-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#pay-invoice-charge-panel").slideDown();

    $("#consignee_invoice_rcv").focus();
  });

  //Pay Service Charge
  $("#rcv-service-charge-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#rcv-service-charge-panel").slideDown();
    $("#service_charge_sel_cash_acc").load("load_sel_cash_account.php");
    $("#service_charge_bl_search").focus();
  });

  //Expenditure transaction
  $("#expense-transaction-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#expenditure-transaction-panel").slideDown();
    $("#sel_expense_transaction_account").load(
      "load_sel_expenditure_account.php"
    );
    $("#txt_pmt_exp_cash_bal").load("load_petty_cash_balance.php");
    $("#sel_expense_transaction_account").focus();
  });

  //General Ledger transfer
  $("#transaction_GL").click(function () {
    $(".sub-basic-setup").hide();
    $("#gl-transaction-panel").slideDown();
    $(".gl_account").load("load_sel_gl_account.php");
    $("#sel_glDr_account").focus();
  });

  //Disbursement Analysis Panel
  $("#new-disbursement-fcl-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#disbursement-analysis-panel").slideDown();
    $("#txt_disbursement_bl_search").focus();
    $("#recent_disbursement_bl").load("disbursement_recent_bl.php");
    $("#txtTotalDisbursementSource").load("load_sel_cash_account.php");
  });

  function SpinnerLoader(props) {
    return `
  $(".progress-loader").remove();
  $(${props}).append(
    '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
  );
  `;
  }

  function rmvSpinner() {
    return ` $(".progress-loader").remove();`;
  }

  //Disbursement Ananlysis Approval
  $("#new-disbursement-approval-review-tab").click(function () {
    $(".sub-basic-setup").hide();
    $(".progress-loader").remove();

    $("#display_disbursement_analysis_panel").load(
      "load_disbursement_analysis_approval_new.php"
    );

    // $.ajax({
    //   url: "load_disbursement_analysis_approval_new.php", // Assume this file contains the header HTML
    //   method: "GET",
    //   success: function (data) {
    //     // Inject the HTML into the div with ID 'header-container'
    //     alert('set continue')
    //     $("#display_disbursement_analysis_panel").html(data);
    //   },

    //   error: function (jqXHR, textStatus, errorThrown) {
    //     console.error("Failed to load header:", textStatus, errorThrown);
    //   },

    // });

    $("#disbursement-analysis-approval-panel").slideDown();
  });

  //
  $("#btn_disbursement_search_summary_rpt").click(function () {
    let id = $("#text_search_disbursement_details_view").val();

    if (id === "") {
      alert("Enter Container# Or BL#");
      $("#text_search_disbursement_details_view").focus();
      return false;
    } else {
      $(".progress-loader").remove();
      $("#disbursement_report_view_card").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.get("fetch_disbursement_summary_by_id.php", { id }, function (a) {
        $("#view_disbursement_report_search_result").html(a);
        $(".progress-loader").remove();
      });
    }
  });

  //Debit GL Credit Income
  $("#drGlCrIncometab").click(function () {
    $(".sub-basic-setup").hide();
    $("#drGlCrIncome-transaction-panel").slideDown();
    $(".gl_account").load("load_sel_gl_account.php");
    $("#sel_cr_glDrIncCr_account").load("load_sel_income_account.php");
    $("#consignee_invoice_rcv").focus();
  });

  //Credit GL Debit Expense
  $("#crGlDrExpensetab").click(function () {
    $(".sub-basic-setup").hide();
    $("#crGlDrExpense-transaction-panel").slideDown();
    $(".gl_account").load("load_sel_gl_account.php");
    $("#sel_dr_expDrGLCr_account").load("load_sel_expenditure_account.php");
    $("#sel_cr_expDrGLCr_account").focus();
  });

  //
  $("#invoice_pmt_dot").change(function () {
    let dt = $(this).val();

    $.post("get_receipt_no_date.php", { dt: dt }, function (a) {
      $("#invoice_pmt_rcpt_no").text(a);
    });
    $.post("get_receipt_id_date.php", { dt: dt }, function (a) {
      $("#invoice_pmt_rcpt_id").text(a);
    });
  });

  //
  $("#service_charge_pmt_dt").change(function () {
    let dt = $(this).val();

    $.post("get_receipt_no_date.php", { dt: dt }, function (a) {
      $("#service_charge_rcpt_no").text(a);
    });
    $.post("get_receipt_id_date.php", { dt: dt }, function (a) {
      $("#service_charge_rcpt_id").text(a);
    });
  });

  //
  $("#invoice_pmt_exp_dot").change(function () {
    let dt = $(this).val();

    $.post("get_receipt_no_date.php", { dt: dt }, function (a) {
      $("#invoice_pmt_exp_rcpt_no").text(a);
    });
    $.post("get_receipt_id_date.php", { dt: dt }, function (a) {
      $("#invoice_pmt_exp_rcpt_id").text(a);
    });
  });

  //  let taxStatus = document.getElementById("customSwitch").checked;
  let taxStatus;
  function getTaxStatus(id) {
    taxStatus = document.getElementById(id).checked;
  }

  //Allow tax charges on invoicing account

  $("#customSwitch1").change(function () {
    //taxStatus = document.getElementById("customSwitch2").checked;
    getTaxStatus("customSwitch1");
    //alert(taxStatus);
  });

  $("#customSwitch2").change(function () {
    //taxStatus = document.getElementById("customSwitch2").checked;
    getTaxStatus("customSwitch2");
    //alert(taxStatus);
  });

  //Search Function
  $("#txt_disbursement_bl_search").keyup(function () {
    var e = $.trim($(this).val());

    $(".progress-loader").remove();
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post("search_bl_hbl_main.php", { e: e }, function (a) {
      $("#disbursement_search_info").html(a);
      $(".progress-loader").remove();
    });
  });

  $("#txtTotalDisbursementIncome").blur(function () {
    let amount = $.trim($("#txtTotalDisbursementIncome").val());

    $.post("disbursement_fetch_total_bl.php", { amount }, function (data) {
      let result = JSON.parse(data);

      $("#lblTotalDisbursement").html(result.NetPNL);
    });
  });

  $("#btn_save_disbursement").click(function () {
    let amount = $.trim($("#txtTotalDisbursementIncome").val());
    let dOT = $.trim($("#txt_disbursement_DOT").val());
    let bl = $.trim($("#txt_disbursement_bl_search").val());
    let account = $.trim($("#txtTotalDisbursementSource :selected").attr("id"));

    $(".progress-loader").remove();
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post(
      "add_new_disbursement_analysis.php",
      { amount, dOT, bl, account },
      function (data) {
        let result = JSON.parse(data);
        // alert(data)
        if (result.status_code == 201) {
          alert(result.msg);
          $("#disbursement_fcl_bl_display_details").html("");
          $(".ep").val("");
          $("#lblTotalDisbursement").html("");
          $("#disbursement_fcl_account_display").html("");
          $(".progress-loader").remove();
        } else {
          alert(result.msg);
          $(".progress-loader").remove();
        }
      }
    );

    $;
  });

  $("#clearDisbursementAnalysis").click(function () {
    $.post("disbursement_temp_delete.php", {}, function (data) {
      let result = JSON.parse(data);

      alert(result.msg);
      console.log(result.status_code);
    });
  });

  //
  $("#btn_add_charge_consignee_invoice").click(function (e) {
    e.preventDefault();

    let acc = $.trim($("#sel_hBL_acc_invoice :selected").attr("id"));
    let accName = $.trim($("#sel_hBL_acc_invoice :selected").val());
    let amt = $.trim($("#hBL_amt_invoice").val());
    let mbl = $.trim($("#mbl_invoice_search").text());

    $(".progress-loader").remove();
    $("#body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post(
      "add_additional_charge_invoice_temp.php",
      { acc, accName, amt, taxStatus, mbl },
      function (a) {
        let data = JSON.parse(a);
        if (data.code == 200) {
          alert(data.msg);
          //Display Consignee handling charges
          $.post(
            "load_consignee_handling_charges_temp_tbl.php",
            {},
            function (a) {
              $("#cosignee_hbl_invoice_charges_display").html(a);
              $("#sel_hBL_acc_invoice").load("load_sel_billing_account.php");
              $("#hBL_amt_invoice").val("");
              $(".progress-loader").remove();
            }
          );
        } else {
          alert(a);
          $(".progress-loader").remove();
        }

        $(".progress-loader").remove();
      }
    );
  });

  //
  $("#btn_add_charge_client_invoice").click(function () {
    let acc = $.trim($("#sel_ots_acc_invoice :selected").attr("id"));
    let amt = $.trim($("#client_amt_invoice").val());
    let desc = $.trim($("#client_desc_invoice").val());
    let dot = $.trim($("#client_dot_invoice").val());
    let name = $.trim($("#search_client_oth_serv_id").text());

    if (name == "") {
      alert("Client Name not found");
      $(".client-det-search").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_additional_charge_invoice_temp_0.php",
        { acc: acc, amt: amt, desc: desc, dot: dot },
        function (a) {
          if (a == 1) {
            //Display Consignee handling charges
            $.post(
              "load_client_handling_charges_temp_tbl.php",
              {},
              function (a) {
                $("#client_charges_display_details").html(a);
                $("#sel_ots_acc_invoice").load("load_sel_billing_account.php");
                $(".epp").val("");
                $("#sel_ots_acc_invoice").focus();
                $(".progress-loader").remove();
              }
            );
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //
  $("#btn_consignee_invoice_payment").click(function () {
    let acc = $.trim($("#invoice_pmt_sel_cash_acc :selected").attr("id"));
    let amt = $.trim($("#invoice_pmt_amt").val());
    let desc = $.trim($("#invoice_pmt_description").val());
    let dot = $.trim($("#invoice_pmt_dot").val());
    let rid = $.trim($("#invoice_pmt_rcpt_id").text());
    let rno = $.trim($("#invoice_pmt_rcpt_no").text());
    let cns = $.trim($("#consignee_id_invoice_pmt").text());
    let mbl = $.trim($("#invoice_pmt_mblid").text());

    $(".progress-loader").remove();

    if (dot == "") {
      alert("Select Date of Transaction");
      return false;
    } else {
      let q = confirm("Save transaction?");
      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        if (mbl === "") {
          //This line save transaction for Other service invoice
          $.post(
            "run_receive_invoice_pmt_nhbl.php",
            {
              hbl: hbl,
              mbl: mbl,
              acc: acc,
              amt: amt,
              recid: rid,
              recno: rno,
              dt: dot,
              stid: cns,
              desc: desc,
            },
            function (a) {
              if (a == 1) {
                //Display Consignee handling charges
                $("#consignee_invoice_payment").focus();
                $(".ep").val("");
                $(".ep").text("");

                let q = confirm("Print invoice payment receipt?");
                if (q) {
                  $.post("insert_recno_rpt.php", { cid: rno }, function (a) {
                    if (a) {
                      window.open(
                        "invoice_othservice_payment_receipt.php",
                        "_blank"
                      );
                      $(".progress-loader").remove();
                    } else {
                      $(".progress-loader").remove();
                    }
                  });
                } else {
                  $(".progress-loader").remove();
                  return false;
                }
              } else {
                alert(a);
                $(".progress-loader").remove();
              }
            }
          );
        } else {
          //This line saves transactions for House BL invoice
          $.post(
            "run_receive_invoice_pmt_mbl.php",
            {
              mbl,
              acc,
              amt,
              dot,
              cns,
              desc,
            },
            function (response) {
              let data = JSON.parse(response);

              if (data.code == 200) {
                //Display Consignee handling charges
                $("#consignee_invoice_payment").focus();
                $(".ep").val("");
                $(".ep").text("");

                let q = confirm("Print invoice payment receipt?");
                if (q) {
                  $.post(
                    "insert_recno_rpt.php",
                    { cid: data.receiptNo },
                    function (a) {
                      if (a) {
                        window.open("invoice_payment_receipt.php", "_blank");
                        $(".progress-loader").remove();
                      } else {
                        $(".progress-loader").remove();
                      }
                    }
                  );
                } else {
                  $(".progress-loader").remove();
                  return false;
                }
              } else {
                alert(data.msg);
                $(".progress-loader").remove();
              }
            }
          );
        }
      } else {
        $(".progress-loader").remove();
        return false;
      }
    }
  });

  //
  $("#btn_consignee_invoice_payment_exp").click(function () {
    let acc = $.trim($("#invoice_pmt_exp_sel_cash_acc :selected").attr("id"));
    let exp_acc = $.trim(
      $("#invoice_pmt_exp_sel_cash_acc1 :selected").attr("id")
    );
    let amt = $.trim($("#invoice_pmt_exp_amt").val());
    let desc = $.trim($("#invoice_pmt_exp_description").val());
    let dot = $.trim($("#invoice_pmt_exp_dot").val());
    let rid = $.trim($("#invoice_pmt_exp_rcpt_id").text());
    let rno = $.trim($("#invoice_pmt_exp_rcpt_no").text());
    let cns = $.trim($("#consignee_id_pmt_expense").text());
    let mbl = $.trim($("#invoice_pmt_exp_mblid").text());

    if (dot == "") {
      alert("Select Date of Transaction");
      $("#invoice_pmt_exp_dot").focus();
      return false;
    } else {
      let q = confirm("Save transaction?");
      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_consignment_expense_pmt.php",
          {
            exp_acc: exp_acc,
            mbl: mbl,
            acc: acc,
            amt: amt,
            recid: rid,
            recno: rno,
            dt: dot,
            cns: cns,
            desc: desc,
          },
          function (a) {
            if (a == 1) {
              //Display Consignee handling charges
              $("#consignee_invoice_payment").focus();
              $(".ep").val("");
              $(".ep").text("");
              $(".progress-loader").remove();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      } else {
        $(".progress-loader").remove();
        return false;
      }
    }
  });

  //
  $("#load_consignee_in_process_others").click(function (a) {
    $("#display_consignee_in_process").load(
      "load_consignee_in_process_tbl.php"
    );
  });

  //Search Shipper
  $("#shipper_new_conisgnment").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_shipper.php", { e: e }, function (a) {
      $("#display_shipper_search_info").html(a);
    });
  });

  //Search Consignee Name
  $("#search_hbl_consignee_fname").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_hbl_new_consignee.php", { e: e }, function (a) {
      $("#display_hBL_search_consignee_info").html(a);
    });
  });

  //Search Client Profile Report
  $("#search_client_profile_rpt").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_client_profile.php", { e: e }, function (a) {
      $("#display_client_profile_search_info").html(a);
    });
  });

  //Search Client Profile Report
  $("#search_consignment_profile_rpt").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignment_profile.php", { e: e }, function (a) {
      $("#display_cns_profile_search_info").html(a);
    });
  });

  //Search Cnsignment Profile Edit
  $("#search_consignment_profile_edit").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignment_profile_edit.php", { e: e }, function (a) {
      $("#display_cns_profile_edit_info").html(a);
    });
  });

  //
  $("#btn-search-container-details").click(function () {
    let id = $.trim($("#txt-tracked-shipment-container-details").val());

    alert(id);
  });

  //Search Client Profile Edit
  $("#search_housebl_profile_rpt").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_housebl_profile_edit.php", { e: e }, function (a) {
      $("#display_hbl_profile_search_info").html(a);
    });
  });

  //
  $("#text-search-client-details-general").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_shipper.php", { e: e }, function (a) {
      $("#display_ops_search_info").html(a);
    });
  });

  //Search Shipper New Consignee
  $("#mainBL_search_conisgnee").keyup(function () {
    var e = $.trim($(this).val());

    if (e === "") {
      return false;
    }
    $.post("search_mainbl_new_consignee.php", { e: e }, function (a) {
      // alert(a)
      $("#display_mainBL_search_info").html(a);
    });
  });

  //Search Consignee for HBL Invoice
  $("#search_client_other_invoice").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_hbl_new_consignee.php", { e: e }, function (a) {
      $(".client-search-show").html(a);
    });
  });

  //
  $("#search_consignee_manifest").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignee_manifest.php", { e: e }, function (a) {
      $(".client-search-show").html(a);
    });
  });

  //Search  HBL Invoice for Customer Waybill
  $("#txt_housebl_customer_waybill").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_existing_waybill.php", { e: e }, function (a) {
      $("#display_hBL_waybill_search_info").html(a);
    });
  });

  //Search New Consignee FullName for Invoice Repayment
  $("#consignee_invoice_payment").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignee_invoice_outstanding.php", { e: e }, function (a) {
      $("#display_consginee_invoice_pmt_info").html(a);
    });
  });

  //Search Main BL for container expense
  $("#consignee_invoice_rcv").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignee_invoice_pmt_exp.php", { e: e }, function (a) {
      $("#display_consginee_invoice_rcv_info").html(a);
    });
  });

  //Search New Consignee2 FullName/ TelNo
  $("#search_hbl_consignee2_fname").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_hbl_new_consignee2.php", { e: e }, function (a) {
      $("#display_hBL_search_consignee2_info").html(a);
    });
  });

  $("#btn_consignee_manifestation").click(function () {
    let newOfficer = $.trim(
      $("#sel_mbl_assignee_officer :selected").attr("id")
    );
    // let cns = $.trim($("#hbl_consignee_id").text());

    if (newOfficer == "") {
      alert("Select Officer");
      return false;
    } else {
      let q = confirm("Assign Officer to BL?");
      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "assign_new_officer_to_bl.php",
          {
            newOfficer,
          },
          function (a) {
            let data = JSON.parse(a);
            if (data.code == 200) {
              $(".ep").text("");
              $(".ep").val("");
              $(".progress-loader").remove();
              $("#cosignee_main_bl_display_details").load(
                "load_temp_mainbl_new_consignee.php"
              );

              $("#search_hbl_consignee_fname").focus();
            } else {
              alert(data.msg);
              $(".progress-loader").remove();
            }

            // if (a == 1) {
            //   $(".ep").text("");
            //   $(".ep").val("");
            //   $.post("get_new_house_bl_number.php", {}, function (a) {
            //     $("#houseBL_consignee_breakown").val(a);
            //   });
            //   $("#cosignee_house_bl_display_details").load(
            //     "load_cosignee_manifestation_temp.php"
            //   );
            //   $(".progress-loader").remove();
            //   $("#search_hbl_consignee_fname").focus();
            // } else {
            //   alert(a);
            //   $(".progress-loader").remove();
            // }
          }
        );
      } else {
        return false;
      }
    }
  });

  //Add New Handling Charge
  $("#btn-new-handling-charge").click(function () {
    let cid = $.trim($("#sel_HandlingCharge_account :selected").attr("id"));
    let cnm = $.trim($("#sel_HandlingCharge_account").val());
    let amt = $.trim($("#txt-handlingChanrgeAmt").val());

    if (cnm == "") {
      alert("Select Account");
      $("#sel_HandlingCharge_account").focus();
      return false;
    } else if (amt == "") {
      alert("Enter Amount");
      $("#txt-handlingChanrgeAmt").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_handling_charge.php",
        { cid: cid, cnm: cnm, amt: amt },
        function (a) {
          if (a == 1) {
            $(".ep").text("");
            $(".ep").val("");
            $("#display_handling_charges").load("load_handling_charge_tbl.php");
            $("#sel_HandlingCharge_account").load(
              "load_handling_charge_accounts.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Add New Disbursement Account
  $("#btn-new-disbursement-charge").click(function () {
    let accountID = $.trim($("#sel_disbursement_account :selected").attr("id"));

    if (accountID == "") {
      alert("Select Account");
      $("#sel_disbursement_account").focus();
      return false;
    } else {
      $("#disbursement_charges_setup_panel").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post("add_new_disbursement_account.php", { accountID }, function (a) {
        if (a == 1) {
          $(".ep").text("");
          $(".ep").val("");
          $("#display_disbursement_mapped_account").load(
            "load_disbursement_mapped_accout_tbl.php"
          );

          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  $("#btn-change-pswd").click(function () {
    var old = $.trim($("#pwdold").val());
    var new1 = $.trim($("#pwdnew").val());
    var new2 = $.trim($("#pwdnew1").val());

    if (old == "") {
      alert("Enter your current password");
      $("#pwdold").focus();
      return false;
    } else if (new1 == "") {
      alert("Enter your new password");
      $("#pwdnew").focus();
      return false;
    } else if (new2 == "") {
      alert("Confirm your new password");
      $("#pwdnew1").focus();
      return false;
    } else if (new1 !== new2) {
      $(".change-pswd-wrong").show().fadeOut(3000);
    } else {
      //$('.change-pswd-correct').show().fadeOut(3000);

      $.post(
        "run_change_new_password.php",
        { old: old, new1: new1, new2: new2 },
        function (e) {
          if (e == 1) {
            $("#password").val("");
            $(".ep").val("");
            $(".change-pswd-correct").show().fadeOut(3000);
            return false;
          } else {
            $(".old-pswd-wrong").show().fadeOut(3000);
            return false;
          }
        }
      );
    }
  });

  $("#btn_new_container_details").click(function () {
    var cid = $.trim($("#newConsignmentID").text());
    var bl = $.trim($("#bl_new_conisgnment").val());
    var cntNo = $.trim($("#cntNo_new_conisgnment").val());
    var sealNo = $.trim($("#sealNo_new_conisgnment").val());
    var cntSize = $.trim($("#cntSize_new_conisgnment").val());
    var wgt = $.trim($("#weight_new_conisgnment").val());
    let cost = $.trim($("#tcost_handling_new_conisgnment").val());

    if (bl == "") {
      alert("Enter Bill Of Laden");
      $("#bl_new_conisgnment").focus();
      return false;
    } else if (cid == "") {
      alert("Error: Consignment ID not found");
      return false;
    } else if (sealNo == "") {
      alert("Enter Seal No.");
      $("#sealNo_new_conisgnment").focus();
      return false;
    } else if (cntNo == "") {
      alert("Enter Container No.");
      $("#cntNo_new_conisgnment").focus();
      return false;
    } else if (cntSize == "") {
      alert("Enter Container Size");
      $("#cntSize_new_conisgnment").focus();
      return false;
    } else if (cost == "") {
      alert("Enter Estimated Handling Cost");
      $("#tcost_handling_new_conisgnment").focus();
      return false;
    } else if (wgt == "") {
      alert("Enter Container Weight");
      $("#weight_new_conisgnment").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_container_details_temp.php",
        {
          cost: cost,
          cid: cid,
          bl: bl,
          sealNo: sealNo,
          cntNo: cntNo,
          cntSize: cntSize,
          wgt: wgt,
        },
        function (a) {
          if (a == 1) {
            $(".ef").val("");
            $("#display_new_container_details").load(
              "load_new_pending_container_details_temp.php"
            );
            $(".progress-loader").remove();
            $("#sealNo_new_conisgnment").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn_new_consignment").click(function (event) {
    event.preventDefault();

    var cid = $.trim($("#newConsignmentID").text());
    var shpid = $.trim($("#shpperid_new_consignment").text());
    var shpnm = $.trim($("#shipper_new_conisgnment").val());
    var dot = $.trim($("#dot_new_conisgnment").val());
    var pois = $.trim($("#pois_new_conisgnment").val());
    var dois = $.trim($("#dois_new_conisgnment").val());
    var sob = $.trim($("#sob_new_conisgnment").val());
    var vessel = $.trim($("#vessel_new_conisgnment").val());
    var eta = $.trim($("#eta_new_conisgnment").val());
    var bl = $.trim($("#bl_new_conisgnment").val());
    var VygNo = $.trim($("#voyageNo_new_conisgnment").val());
    var pol = $.trim($("#sel_pol_new_conisgnment").val());
    var polid = $.trim($("#sel_pol_new_conisgnment :selected").attr("id"));
    var pod = $.trim($("#sel_pod_new_conisgnment").val());
    var podid = $.trim($("#sel_pod_new_conisgnment :selected").attr("id"));
    var carid = $.trim($("#sel_shipper_new_conisgnment :selected").attr("id"));
    var car = $.trim($("#sel_shipper_new_conisgnment").val());
    var rtt = $.trim($("#rotation_new_conisgnment").val());
    let agent = $.trim($("#agent_contact_new_conisgnment").val());
    let rcptid = $.trim($("#new_consignment_rcptid").text());
    let rcptno = $.trim($("#new_consignment_rcptno").text());
    let cns = $.trim($("#hbl_consignee_id").text());

    if (dot == "") {
      alert("Select Transaction Date");
      $("#dot_new_conisgnment").focus();
      return false;
    } else if (dois == "") {
      alert("Select Date of Issue");
      $("#dois_new_conisgnment").focus();
      return false;
    } else if (sob == "") {
      alert("Select Shipped on Board [Date]");
      $("#sob_new_conisgnment").focus();
      return false;
    } else if (shpid == "") {
      alert("Enter Shipper's Name");
      $("#shipper_new_conisgnment").focus();
      return false;
    } else if (vessel == "") {
      alert("Enter Vessel Name");
      $("#vessel_new_conisgnment").focus();
      return false;
    } else if (VygNo == "") {
      alert("Enter Voyage No.");
      $("#voyageNo_new_conisgnment").focus();
      return false;
    } else if (car == "") {
      alert("Select Shipping Line");
      $("#sel_shipper_new_conisgnment").focus();
      return false;
    } else if (eta == "") {
      alert("Enter ETA");
      $("#eta_new_conisgnment").focus();
      return false;
    } else if (bl == "") {
      alert("Enter Bill Of Laden");
      $("#bl_new_conisgnment").focus();
      return false;
    } else if (pois == "") {
      alert("Enter Place of Issue");
      $("#pois_new_conisgnment").focus();
      return false;
    } else if (polid == "") {
      alert("Select P.O.L.");
      $("#pol_new_conisgnment").focus();
      return false;
    } else if (podid == "") {
      alert("Select P.O.D.");
      $("#pod_new_conisgnment").focus();
      return false;
    } else if (agent == "") {
      alert("Enter agent's contact");
      $("#agent_contact_new_conisgnment").focus();
      return false;
    } else if (rcptid == "" || rcptno == "") {
      alert("Transaction ID not found");
      return false;
    } else if (cns == "") {
      alert("Select Consignee Name");
      return false;
    } else {
      let q = confirm("Save consignment details?");
      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "add_new_consignment.php",
          {
            vyg: VygNo,
            shpid: shpid,
            rtt: rtt,
            pois: pois,
            dois: dois,
            sob: sob,
            carid: carid,
            cid: cid,
            dot: dot,
            vessel: vessel,
            eta: eta,
            bl: bl,
            polid: polid,
            podid: podid,
            agent: agent,
            rcptid: rcptid,
            rcptno: rcptno,
            cns: cns,
          },
          function (a) {
            if (a == 1) {
              alert("Consigment profile added successfully");
              $(".ep").val("");
              $("#shpperid_new_consignment").text("");
              $("#newConsignmentID").load("get_new_consignment_id.php");
              $("#sel_pol_new_conisgnment").load("load_sel_pol_list.php");
              $("#sel_pod_new_conisgnment").load("load_sel_pod_list.php");
              $("#display_new_consignment").load(
                "load_new_pending_consignment_new.php"
              );
              $("#display_new_container_details").load(
                "load_new_pending_container_details_temp.php"
              );
              $(".progress-loader").remove();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      } else {
        return false;
      }
    }
  });

  //
  $("#btn_new_vehicle_registration").click(function () {
    var brand = $.trim($("#new_vehicle_brand").val());
    var model = $.trim($("#new_vehicle_model").val());
    var year = $.trim($("#new_vehicle_year").val());
    var license_plate = $.trim($("#new_vehicle_license_plate").val());
    var vin = $.trim($("#new_vehicle_vin").val());
    var cost = $.trim($("#new_vehicle_cost").val());
    var amount_paid = $.trim($("#new_vehicle_amount_paid").val());
    var account_name = $.trim($("#new_vehicle_credit_account :selected").val());
    var account_no = $.trim(
      $("#new_vehicle_credit_account :selected").attr("id")
    );

    // alert(
    //   `${brand} ${model} ${year} ${license_plate} ${vin} ${cost} ${account_name} ${account_no}`
    // );

    let q = confirm("Register new vehicle?");

    if (q) {
      $(".progress-loader").remove();
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_new_vehicle_registration.php",
        {
          brand,
          model,
          year,
          license_plate,
          vin,
          cost,
          amount_paid,
          account_no,
          account_name,
        },
        function (response) {
          let data = JSON.parse(response)

          if(data.status_code == 200){
            alert(data.msg)
            $('#display_registered_vehicles').load("load_registered_vehicles.view.php");
            $(".progress-loader").remove();
            $('.ef').val('')
            $('#new_vehicle_brand').focus();
          }else{
            alert(data.msg)
            $(".progress-loader").remove();
          }
          
          
        }
      );
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  $("#btn_new_driver_registration").click(function () {
    var fname = $.trim($("#new_driver_fname").val());
    var lname = $.trim($("#new_driver_lname").val());
    var license = $.trim($("#new_driver_license").val());
    var address = $.trim($("#new_driver_address").val());
    var telno = $.trim($("#new_driver_telno").val());
    var former_emp = $.trim($("#new_driver_former_employer").val());
    var emp_date = $.trim($("#new_driver_employment_date").val());
    var vehicle_name = $.trim($("#new_driver_vehicle_assigned :selected").val());
    var vehicleId = $.trim(
      $("#new_driver_vehicle_assigned :selected").attr("id")
    );

    // alert(
    //   `${brand} ${model} ${year} ${license_plate} ${vin} ${cost} ${account_name} ${account_no}`
    // );

    let q = confirm(`Register new ${fname} ${lname} as a new driver?`);

    if (q) {
      $(".progress-loader").remove();
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_new_driver_registration.php",
        {
          lname,
          fname,
          address,
          license,
          telno,
          former_emp,
          emp_date,
          vehicleId,
          vehicle_name,
        },
        function (response) {
          let data = JSON.parse(response)

          if(data.status_code == 200){
            alert(data.msg)
            $('#display_registered_driver').load("load_registered_driver.view.php");
            $(".progress-loader").remove();
            $('.ef').val('')
            $('#new_vehicle_brand').focus();
          }else{
            alert(data.msg)
            $(".progress-loader").remove();
          }
          
          
        }
      );
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  //Add New POL Modal
  $("#addPOLModal").click(function () {
    $("#newPOLID").load("get_new_pol_id.php");
    $("#display_pol_list").load("load_pol_list.php");
  });

  //Add New Carrier Modal
  $("#addCarrierModals").click(function () {
    $("#newCarrierID").load("get_new_carrier_id.php");
    $("#display_carrier_list").load("load_carrier_list.php");
  });

  //Add New POD Modal
  $("#addPODModal").click(function () {
    $("#newPODID").load("get_new_pod_id.php");
    $("#display_pod_list").load("load_pod_list.php");
  });

  //Add New Shipper Modal
  $("#addShipperModal").click(function () {
    $("#newshpID").load("get_new_shopper_id.php");
  });

  $("#btn_add_new_pol").click(function () {
    let pid = $.trim($("#newPOLID").text());
    let pnm = $.trim($("#newpolName").val());

    if (pnm == "") {
      alert("Enter P.O.L.");
      $("#newpolName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("add_new_pol.php", { pid: pid, pnm: pnm }, function (a) {
        if (a == 1) {
          $("#newPOLID").load("get_new_pol_id.php");
          $("#display_pol_list").load("load_pol_list.php");
          $("#sel_pol_new_conisgnment").load("load_sel_pol_list_unselect.php");
          $("#newpolName").val("").focus();
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  $("#btn_add_new_carrier").click(function () {
    let pid = $.trim($("#newCarrierID").text());
    let pnm = $.trim($("#newCarrierName").val());

    if (pnm == "") {
      alert("Enter Shipping Line");
      $("#newCarrierName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("add_new_carrier.php", { pid: pid, pnm: pnm }, function (a) {
        if (a == 1) {
          $("#newCarrierID").load("get_new_carrier_id.php");
          $("#display_carrier_list").load("load_carrier_list.php");
          $("#sel_shipper_new_conisgnment").load(
            "load_sel_carrier_list_unselect.php"
          );
          $("#newCarrierName").val("").focus();
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  $("#btn_add_new_pod").click(function () {
    let pid = $.trim($("#newPODID").text());
    let pnm = $.trim($("#newpodName").val());

    if (pnm == "") {
      alert("Enter P.O.D.");
      $("#newpodName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("add_new_pod.php", { pid: pid, pnm: pnm }, function (a) {
        if (a == 1) {
          $("#newPODID").load("get_new_pod_id.php");
          $("#display_pod_list").load("load_pod_list.php");
          $("#sel_pod_new_conisgnment").load("load_sel_pod_list_unselect.php");
          $("#newpodName").val("").focus();
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Add new Consignee Modal
  $("#addConsigneeModal").click(function () {
    $("#newcnsID").load("get_new_consignee_id.php");
  });

  //Add new Consignee Modal - Other service Client
  $(".addNewConsignee").click(function () {
    $("#newcnsID").load("get_new_consignee_id.php");
  });

  //Add new Shipper
  $("#btn_add_new_shipper").click(function () {
    let shpid = $.trim($("#newshpID").text());
    let shpnm = $.trim($("#newshpName").val());
    let shpadd1 = $.trim($("#newshpAdd1").val());
    let shpadd2 = $.trim($("#newshpAdd2").val());
    let shpadd3 = $.trim($("#newshpAdd3").val());
    let shpadd4 = $.trim($("#newshpAdd4").val());

    if (shpid == "") {
      alert("Shipper ID not found");
      // $('#newpodName').focus();
      return false;
    } else if (shpnm == "") {
      alert("Enter Shippers's Name");
      $("#newshpName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_shipper.php",
        {
          shpid: shpid,
          shpnm: shpnm,
          shpadd1: shpadd1,
          shpadd2: shpadd2,
          shpadd3: shpadd3,
          shpadd4: shpadd4,
        },
        function (a) {
          if (a == 1) {
            $(".ep").val("");
            alert("Shipper details added successfully");
            $("#shpperid_new_consignment").text(shpid);
            $("#shipper_new_conisgnment").val(shpnm);
            $("#newshpID").load("get_new_shopper_id.php");
            $("#display_pod_list").load("load_pod_list.php");
            $("#sel_pod_new_conisgnment").load(
              "load_sel_pod_list_unselect.php"
            );
            $("#newshpName").val("").focus();
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Add new Consignee
  $("#btn_add_new_consignee").click(function () {
    let shpid = $.trim($("#newcnsID").text());
    let shpnm = $.trim($("#newcnsName").val());
    let shpadd1 = $.trim($("#newcnsAdd1").val());
    let shpadd2 = $.trim($("#newcnsAdd2").val());
    let shpadd3 = $.trim($("#newcnsAdd3").val());
    let cnsTel = $.trim($("#newcnsTel").val());

    if (shpid == "") {
      alert("Consignee ID not found");
      // $('#newpodName').focus();
      return false;
    } else if (shpnm == "") {
      alert("Enter Consignee's Full Name");
      $("#newcnsName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_consingee.php",
        {
          shpid: shpid,
          shpnm: shpnm,
          shpadd1: shpadd1,
          shpadd2: shpadd2,
          shpadd3: shpadd3,
          cnsTel: cnsTel,
        },
        function (a) {
          if (a == 1) {
            $(".ep").val("");
            $("#hbl_consignee_id").text(shpid);
            $(".new_consignee_id").text(shpid);
            $("#search_client_oth_serv_id").text(shpid);
            $(".client-det-search").val(shpnm);
            $(".new_consignee_name").val(shpnm);
            $("#search_hbl_consignee_fname").val(shpnm);
            $("#hbl_consignee2_id").text(shpid);
            $("#search_hbl_consignee2_fname").val(shpnm);
            $("#newcnsID").load("get_new_consignee_id.php");
            $("#sel_ots_acc_invoice").load("load_sel_billing_account.php");
            $("#newcnsName").val("").focus();
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //STUDENT PANEL
  $("#btn-new-student-panel").click(function () {
    $(".sub-basic-setup").hide();
    $("#studentPanel").slideDown();
  });

  $("#btn-add-subjCategory").click(function () {
    var CID = $.trim($("#subjctgrID").text());
    var CName = $.trim($("#subjctgrName").val());

    if (CID == "") {
      alert("Error generating category details");
      return false;
    } else if (CName == "") {
      alert("Missing subject category name");
      $("#subjctgrName").focus();
      return false;
    } else {
      $("#subjCategory").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "run_new_subjCategory.php",
        { CID: CID, CName: CName },
        function (a) {
          if (a == 1) {
            $.post("check_subj_category_tbl.php", {}, function (a) {
              $("#subject-cateogory-tbl").html(a);
            });
            $.post("check_subj_category_id.php", {}, function (e) {
              $("#subjctgrID").text(e);
            });
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-subjSetup").click(function () {
    $("#select-subj-category").load("load_subject_category.php");
    $("#subject-main-tbl").html("");
  });

  $("#select-subj-category").change(function () {
    var CID = $.trim($("#select-subj-category :selected").attr("id"));
    var CN = $.trim($("#select-subj-category").val());

    if (CN == "") {
    } else {
      $.post("load_new_subject_id.php", { CID: CID, CN: CN }, function (a) {
        $("#subjnameID").text(a);
      });
      $.post("load_subject_tbl.php", { CID: CID, CN: CN }, function (a) {
        $("#subject-main-tbl").html(a);
      });
    }
  });

  $("#add_new_subject").click(function () {
    var CID = $.trim($("#select-subj-category :selected").attr("id"));
    var CN = $.trim($("#select-subj-category").val());
    var SID = $.trim($("#subjnameID").text());
    var SN = $.trim($("#subjName").val());

    if (CN == "") {
      alert("Select Subject Category");
      $("#select-subj-category").focus();
      return false;
    } else if (SN == "") {
      alert("Enter Subject Name");
      $("#subjName").focus();
      return false;
    } else {
      $.post(
        "run_add_new_subject.php",
        { CID: CID, CN: CN, SID: SID, SN: SN },
        function (e) {
          if (e == 1) {
            $(".ep").val("");
            $.post("load_subject_tbl.php", { CID: CID, CN: CN }, function (a) {
              $("#subject-main-tbl").html(a);
            });
            $.post(
              "load_new_subject_id.php",
              { CID: CID, CN: CN },
              function (a) {
                $("#subjnameID").text(a);
              }
            );
            $("#subjName").focus();
          } else {
            alert(e);
          }
        }
      );
    }
  });

  $("#btn-classSetup").click(function () {
    $("#select-class-category").load("load_class_category.php");
    $("#select-class-subj-category").load("load_subject_category.php");

    $.post("get_class_id.php", {}, function (a) {
      $("#new_classID").text(a);
    });
    $.post("load_select_subj_class.php", {}, function (a) {
      $("#select-class-subject-temp").html(a);
    });
    $("#select-subject-cat-tbl").html("");
  });

  $("#btn-staffSetup").click(function () {
    // $('#select-class-category').load('load_class_category.php');
    // $('#select-class-subj-category').load('load_subject_category.php');

    $.post("get_staff_id.php", {}, function (a) {
      $("#new_staffID").val(a);
    });
    $.post("get_staff_code.php", {}, function (a) {
      $("#new_staffCode").text(a);
    });
    $.post("load_staff_list_tbl.php", {}, function (a) {
      $("#staff_list_table").html(a);
    });
    // $('#select-subject-cat-tbl').html('');
  });

  $("#select-class-subj-category").change(function () {
    var CID = $.trim($("#select-class-subj-category :selected").attr("id"));
    var CN = $.trim($("#select-class-subj-category").val());

    $.post("load_select_subj_category.php", { CID: CID, CN: CN }, function (a) {
      $("#select-subject-cat-tbl").html(a);
    });
    $.post("load_select_subj_class.php", { CID: CID, CN: CN }, function (a) {
      $("#select-class-subject-temp").html(a);
    });
  });

  $("#new_className").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_class_name_sillow_tbl.php", { e: e }, function (a) {
      $("#select-subject-cat-tbl").html(a);
    });
  });

  $("#subClass_Course").change(function () {
    var Crs = $.trim($("#subClass_Course :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post("add_more_subject_class.php", { Crs: Crs }, function (a) {
      $.post("load_sub_class_info.php", {}, function (a) {
        $("#new_subclass_info_tbl").html(a);
      });
      $(".progress-loader").remove();
    });
  });

  $("#add_new_class").click(function () {
    var CLID = $.trim($("#new_classID").text());
    var CLNM = $.trim($("#new_className").val());
    var CID = $.trim($("#select-class-category :selected").attr("id"));
    var CN = $("#select-class-category").val();

    if (CLID == "") {
      alert("Error generating class patches");
      // $('#select-class-category').focus();
      return false;
    } else if (CLNM == "") {
      alert("Enter course name");
      $("#new_className").focus();
      return false;
    } else if (CN == "") {
      alert("Select subject category");
      $("#select-class-category").focus();
      return false;
    } else {
      $.post(
        "run_add_new_class.php",
        { CLID: CLID, CLNM: CLNM, CID: CID, CN: CN },
        function (a) {
          if (a == 1) {
            $("#select-subject-cat-tbl").html("");
            $("#select-class-subject-temp").html("");
            $.post("get_class_id.php", {}, function (a) {
              $("#new_classID").text(a);
            });
            $(".ep").val("");
          } else {
            alert(a);
          }
        }
      );
    }
  });

  $("#add_new_staff").click(function () {
    var FN = $.trim($("#new_staffName").val());
    var TID = $.trim($("#new_staffID").val());
    var TCode = $.trim($("#new_staffCode").text());
    var Tel = $.trim($("#staffReg_TelNo").val());
    var Gender = $.trim($("#staffReg_Gender").val());
    var Address = $.trim($("#staffReg_Address").val());
    var DOB = $.trim($("#staffReg_DOB").val());
    var Type = $.trim($("#staffReg_Type :selected").attr("id"));
    var ApmntDt = $.trim($("#staffReg_appmntDate").val());
    var RegNo = $.trim($("#staffReg_No").val());
    var SSNIT = $.trim($("#staffReg_SSNIT").val());
    var Qlf = $.trim($("#staffReg_Qlf").val());
    var PQlf = $.trim($("#staffReg_ProfQlf").val());
    var Rank = $.trim($("#staffReg_Rank").val());
    var PromDt = $.trim($("#staffReg_PromoDt").val());
    var DtPost = $.trim($("#staffReg_PostDt").val());
    var ClassT = $.trim($("#staffReg_ClassTaught").val());
    var SchlDt = $.trim($("#staffReg_SchdlDt").val());
    Tel = "233" + Tel;

    if (FN == "") {
      alert("Enter Staff's Full Name");
      $("#new_staffName").focus();
      return false;
    } else if (TCode == "") {
      alert("Error generating staff ID");
      return false;
    } else if (DOB == "") {
      alert("Select Date of Birth");
      $("#staffReg_DOB").focus();
      return false;
    } else if (Tel == "") {
      alert("Enter Telephone No.");
      $("#staffReg_TelNo").focus();
      return false;
    } else if (Gender == "") {
      alert("Select Gender");
      $("#staffReg_Gender").focus();
      return false;
    } else if (Address == "") {
      alert("Enter Address/ Location");
      $("#staffReg_Address").focus();
      return false;
    } else if (ApmntDt == "") {
      alert("Missing Data: Appointment Data");
      $("#staffReg_Type").focus();
      return false;
    } else if (RegNo == "") {
      alert("Missing Data: Registered No.");
      $("#staffReg_No").focus();
      return false;
    } else if (SSNIT == "") {
      alert("Missing Data: Social Security No.");
      $("#staffReg_SSNIT").focus();
      return false;
    } else if (Qlf == "") {
      alert("Missing Data: Academic Qulaification");
      $("#staffReg_Qlf").focus();
      return false;
    } else if (PQlf == "") {
      alert("Missing Data: Professional Qualification");
      $("#staffReg_ProfQlf").focus();
      return false;
    } else if (Rank == "") {
      alert("Missing Data: Present Grade/Rank");
      $("#staffReg_Rank").focus();
      return false;
    } else if (PromDt == "") {
      alert("Missing Data: Promotion Date");
      $("#staffReg_PromoDt").focus();
      return false;
    } else if (DtPost == "") {
      alert("Missing Data: Date Posted To School");
      $("#staffReg_PostDt").focus();
      return false;
    } else if (ApmntDt == "") {
      alert("Missing Data: Appointment Data");
      $("#staffReg_Type").focus();
      return false;
    } else if (ClassT == "") {
      alert("Missing Data: Class Taught");
      $("#staffReg_ClassTaught").focus();
      return false;
    } else if (SchlDt == "") {
      alert("Missing Data: Appointed Schedule Date");
      $("#staffReg_Type").focus();
      return false;
    } else if (Type == "") {
      alert("Select Account Type");
      $("#staffReg_SchdlDt").focus();
      return false;
    } else {
      $("#staffSetup").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "run_new_staff_reg.php",
        {
          ApmntDt: ApmntDt,
          RegNo: RegNo,
          SSNIT: SSNIT,
          SchlDt: SchlDt,
          ClassT: ClassT,
          DtPost: DtPost,
          PromDt: PromDt,
          Rank: Rank,
          PQlf: PQlf,
          Qlf: Qlf,
          TCode: TCode,
          TID: TID,
          FN: FN,
          DOB: DOB,
          Tel: Tel,
          Gender: Gender,
          Addr: Address,
          Type: Type,
        },
        function (a) {
          if (a == 1) {
            $.post("get_staff_id.php", {}, function (a) {
              $("#new_staffID").val(a);
            });
            $.post("get_staff_code.php", {}, function (a) {
              $("#new_staffCode").text(a);
            });
            $.post("load_staff_list_tbl.php", {}, function (a) {
              $("#staff_list_table").html(a);
            });
            $(".progress-loader").remove();
            $(".ep").val("");
            $("#new_staffName").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Staff Name
  $("#map_StaffName").keyup(function () {
    var e = $.trim($("#map_StaffName").val());

    if (e == "") {
      return false;
    } else {
      $.post("search_staff_id_mapp.php", { e: e }, function (a) {
        $("#search_staff_mapp_info").html(a);
      });
    }
  });

  //Search Staff Name/ Form Master mapping
  $("#map_FormMasterName").keyup(function () {
    var e = $.trim($("#map_FormMasterName").val());

    if (e == "") {
      return false;
    } else {
      $.post("search_form_master_map_id.php", { e: e }, function (a) {
        $("#search_mapp_form_master_info").html(a);
      });
    }
  });

  $("#edit_StaffName").keyup(function () {
    var e = $.trim($("#edit_StaffName").val());

    if (e == "") {
      return false;
    } else {
      $.post("search_staff_id_edit.php", { e: e }, function (a) {
        $("#search_staff_edit_info").html(a);
      });
    }
  });

  $("#btn-staffMapp").click(function () {
    $("#mapp_StaffClass").val("");
    $("#mapp_StaffSubject").val("");

    $.post("load_staff_class_subj_mapp_tbl.php", {}, function (a) {
      $("#temp_staff_class_subj_mapp").html(a);
    });

    $.post("load_staff_subj_class_mapp_main.php", {}, function (a) {
      $("#class_subj_mapp_info").html(a);
    });
  });

  $("#btn-staffHouse").click(function () {
    $.post("load_student_section.php", {}, function (a) {
      $("#student_section_tbl").html(a);
    });
  });

  $("#btn-add-section").click(function () {
    var name = $.trim($("#sectionName").val());
    // $('#mapp_StaffSubject').val('');

    if (name == "") {
      alert("Enter section/house name");
      $("#sectionName").focus();
      return false;
    } else {
      $.post("run_new_section.php", { name: name }, function (a) {
        if (a == 1) {
          $.post("load_student_section.php", {}, function (e) {
            $("#student_section_tbl").html(e);
          });
          $("#sectionName").val("").focus();
        } else {
          alert(a);
        }
      });
    }
  });

  $("#btn-SubClassSetup").click(function () {
    $.post("get_sub_class_id.php", {}, function (e) {
      $("#new_SubClassID").text(e);
      $("#subClass_Course").load("load_class_course.php");

      $.post("load_sub_class_info.php", {}, function (a) {
        $("#new_subclass_info_tbl").html(a);
      });
      $.post("load_existing_subclass_info.php", {}, function (e) {
        $("#new_subclass_existing_tbl").html(e);
      });
      $("#subClass_SubjAdd").load("load_subject_main.php");
    });
  });

  $("#subClass_SubjAdd").change(function () {
    var Cat = $.trim($("#subClass_SubjAdd :selected").attr("cat"));
    var Subj = $.trim($(this).val());
    var SubjID = $.trim($("#subClass_SubjAdd :selected").attr("id"));
    // alert(Cat+" 0 "+Subj+" 1 "+SubjID);
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post(
      "add_more_subject_new_class.php",
      { Cat: Cat, SID: SubjID, SNM: Subj },
      function (a) {
        if (a == 1) {
          $.post("load_sub_class_info.php", {}, function (a) {
            $("#new_subclass_info_tbl").html(a);
          });
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      }
    );
  });

  $("#subClass_Course").change(function () {
    var SCID = $.trim($(this).attr("id"));
    var SCN = $.trim($("#subClass_Course").val());

    if (SCN == "") {
      $("#new_subclass_info_tbl").html("");
    } else {
      $.post("load_", {}, function () {});
    }
  });

  $("#btn_new_sub_class").click(function () {
    var SCID = $.trim($("#subClass_Course :selected").attr("id"));
    var SCN = $.trim($("#subClass_Course").val());
    var CLID = $.trim($("#new_SubClassID").text());
    var CLN = $.trim($("#new_SubClassName").val());

    if (CLN == "") {
      alert("Enter Class Name");
      $("#new_SubClassName").focus();
      return false;
    } else if (SCN == "") {
      alert("Select Course");
      $("#subClass_Course").focus();
      return false;
    } else if (CLID == "") {
      alert("Class ID not registered");
      return false;
    } else {
      $("#subClassSetup").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "run_new_sub_class.php",
        { SCID: SCID, SCN: SCN, CLID: CLID, CLN: CLN },
        function (e) {
          if (e == 1) {
            $("#subClass_Course").load("load_class_course.php");
            $("#new_SubClassID").load("get_sub_class_id.php");
            $.post("load_sub_class_info.php", {}, function (a) {
              $("#new_subclass_info_tbl").html(a);
            });
            $.post("load_existing_subclass_info.php", {}, function (e) {
              $("#new_subclass_existing_tbl").html(e);
            });

            $(".ep").val("");
            $("#new_SubClassName").focus();

            $(".progress-loader").remove();
          } else {
            alert(e);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#add_class_subj_mapp").click(function () {
    var CID = $.trim($("#mapp_StaffClass :selected").attr("id"));
    var CN = $.trim($("#mapp_StaffClass").val());
    var SID = $.trim($("#mapp_StaffSubject :selected").attr("id"));
    var SN = $.trim($("#mapp_StaffSubject").val());
    var TID = $.trim($("#map_StaffID").text());

    if (TID == "") {
      alert("Select Staff/Teacher");
      $("#map_StaffName").focus();
      return false;
    } else if (CN == "") {
      alert("Select Class");
      $("#mapp_StaffClass").focus();
      return false;
    } else if (SN == "") {
      alert("Select Subject");
      $("#mapp_StaffSubject").focus();
      return false;
    } else {
      $.post(
        "add_staff_class_subj_mapp_list.php",
        { TID: TID, CN: CN, CID: CID, SN: SN, SID: SID },
        function (a) {
          if (a == 1) {
            $("#mapp_StaffClass").load("load_staff_class_map.php");
            $.post("load_staff_class_subj_mapp_tbl.php", {}, function (a) {
              $("#temp_staff_class_subj_mapp").html(a);
            });
          } else {
            alert(a);
          }
        }
      );
    }
  });

  $("#btn_add_class_subj_mapp").click(function () {
    $.post("run_add_staff_class_subj_mapp.php", {}, function (e) {
      if (e == 1) {
        $.post("load_staff_class_subj_mapp_tbl.php", {}, function (a) {
          $("#temp_staff_class_subj_mapp").html(a);
        });
        // alert('statr');
        $.post("load_staff_subj_class_mapp_main.php", {}, function (a) {
          //  alert(a);
          $("#class_subj_mapp_info").html(a);
        });
      } else {
        alert(e);
      }
    });
  });

  $("#home-tab").click(function () {
    $.post("check_active_calender.php", {}, function (e) {
      if (e == 1) {
        $("#new_StdCode").load("get_student_code.php");
        $("#new_StdYr").load("get_academic_yr.php");
        //$('#newStdClassAdmit').load('load_staff_class_map.php');
        $("#newStdProgram").load("load_class_course.php");
        $("#stdreg_calender").load("load_active_calenda.php");
        $("#new_StdSection").load("load_student_section_sel.php");
        $.post("get_student_id.php", {}, function (a) {
          $("#new_StdID").val(a);
        });
      } else {
        alert(e);
      }
    });
  });

  $("#newStdProgram").change(function () {
    var e = $.trim($("#newStdProgram :selected").attr("id"));
    var Name = $("#newStdProgram").val();

    $("#newstudent_billdetails").html("");
    $("#no").prop("checked", "checked");

    if (Name == "") {
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#newStdClassAdmit").load("load_sub_class_per_course.php");

        $(".progress-loader").remove();
      });
    }
  });

  $("#client_dot_invoice").change(function () {
    let dt = $.trim($(this).val());

    getReceiptDetails("#client_rcpt_id_invoice", "#client_rcpt_no_invoice", dt);
  });

  $("#client_dot_invoice_nonm").change(function () {
    let dt = $.trim($(this).val());

    getReceiptDetails(
      "#client_rcpt_id_invoice_nonm",
      "#client_rcpt_no_invoice_nonm",
      dt
    );
  });

  $("#dclr_prcs_pmt_dt").change(function () {
    let dt = $.trim($(this).val());

    getReceiptDetails("#dclr_prcs_rcpt_id", "#dclr_prcs_rcpt_no", dt);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $("#myimg").attr("src", e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function () {
    readURL(this);
  });

  $("#prvImg").click(function () {
    var SID = $("#SID").val();

    //alert(SID);
    $.post("pics.php", { SID: SID }, function (e) {
      $("#myimg").attr("src", e);
    });
  });

  //Search Student ID for Image Upload
  $("#img_search_StdName").keyup(function () {
    var e = $.trim($("#img_search_StdName").val());

    if (e == "") {
    } else {
      $.post("search_std_detail_upload_image.php", { e: e }, function (a) {
        $("#search_StdIDImg_info").html(a);
      });
    }
  });

  //Search Staff ID for Image upload
  $("#img_search_StaffName").keyup(function () {
    var e = $.trim($("#img_search_StaffName").val());

    if (e == "") {
    } else {
      $.post("search_staff_detail_upload_image.php", { e: e }, function (a) {
        $("#search_StaffIDImg_info").html(a);
      });
    }
  });

  //Search Login ID for Password Update - Admin
  $("#search_Username_PassswdChng").keyup(function () {
    var e = $.trim($("#search_Username_PassswdChng").val());

    if (e == "") {
    } else {
      $.post("search_username_unloackpasswd.php", { e: e }, function (a) {
        $("#display_UsernamePasswdUpdate").html(a);
      });
    }
  });

  //Search Login ID for Issuing Ticker- Admin
  $("#search_Username_issueTicket").keyup(function () {
    var e = $.trim($("#search_Username_issueTicket").val());

    if (e == "") {
    } else {
      $.post("search_username_issueticket.php", { e: e }, function (a) {
        $("#display_issueTicket").html(a);
      });
    }
  });

  $("#btn_new_student_img").click(function () {
    // alert('run me');
  });

  $("#btn-staffImg").click(function () {
    $("#img_search_StaffName").val("");
    $("#lbl_imgStaffID").text("");
  });

  //Upload student image
  $("#file").change(function () {
    $("#message").empty(); // To remove the previous error message
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (
      !(imagefile == match[0] || imagefile == match[1] || imagefile == match[2])
    ) {
      $("#previewing").attr("src", "noimage.png");
      $("#message").html(
        "<p id='error'>Please Select A valid Image File</p>" +
          "<h4>Note</h4>" +
          "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>"
      );
      return false;
    } else {
      var reader = new FileReader();
      reader.onload = imageIsLoaded;
      reader.readAsDataURL(this.files[0]);
    }
  });

  //Upload staff image
  $("#file0").change(function () {
    $("#message0").empty(); // To remove the previous error message
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (
      !(imagefile == match[0] || imagefile == match[1] || imagefile == match[2])
    ) {
      $("#previewing0").attr("src", "noimage.png");
      $("#message0").html(
        "<p id='error'>Please Select A valid Image File</p>" +
          "<h4>Note</h4>" +
          "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>"
      );
      return false;
    } else {
      var reader = new FileReader();
      reader.onload = imageIsLoaded0;
      reader.readAsDataURL(this.files[0]);
    }
  });

  function imageIsLoaded(e) {
    $("#file").css("color", "green");
    $("#image_preview").css("display", "block");
    $("#previewing").attr("src", e.target.result);
    $("#previewing").attr("width", "250px");
    $("#previewing").attr("height", "230px");
  }

  function imageIsLoaded0(e) {
    $("#file0").css("color", "green");
    $("#image_preview0").css("display", "block");
    $("#previewing0").attr("src", e.target.result);
    $("#previewing0").attr("height", "200px");
    $("#previewing0").attr("height", "230px");
  }

  //Upload image
  $("#uploadimage").on("submit", function (e) {
    e.preventDefault();
    var e = $.trim($("#img_search_StdName").val());

    if (e == "") {
      alert("Missing Data: Student Name");
      $("#img_search_StdName").focus();
      return false;
    } else {
      $("#message").empty();
      $("#loading").show();
      $.ajax({
        url: "ajax_php_file.php", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data) {
          $("#loading").hide();
          $("#message").html(data);
          $("#file0").val("");
          $("#previewing").attr("src", "img/generic.jpg");
          $("#img_search_StdName").val("");
          $("#img_search_StdName").focus();
          // alert(data);
        },
      });
    }
  });

  $("#edit_search_StdName").keyup(function () {
    var e = $.trim($("#edit_search_StdName").val());

    if (e == "") {
    } else {
      $.post("search_std_detail_edit_info.php", { e: e }, function (a) {
        $("#edit_StdID_searchInfo").html(a);
      });
    }
  });
  //  $('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated"></i></div>');
  $("#btn-newScoreRemarks").click(function () {
    $.post("load_test_score_remarks_tbl.php", {}, function (a) {
      $("#exams_test_remarks_tbl").html(a);
    });
  });

  $("#btn-add-testremarks").click(function () {
    var Max = $.trim($("#maxTestScore").val());
    var Min = $.trim($("#minTestScore").val());
    var Rmk = $.trim($("#commentTestScore").val());
    var Grd = $.trim($("#gradeTestScore").val());
    var Val = $.trim($("#valTestScore").val());

    if (Max == "") {
      alert("Missing Data: Maximum Test Score");
      $("#maxTestScore").focus();
      return false;
    } else if (Min == "") {
      alert("Missing Data: Minimum Test Score");
      $("#minTestScore").focus();
      return false;
    } else if (Rmk == "") {
      alert("Missing Data: Remarks");
      $("#commentTestScore").focus();
      return false;
    } else if (Grd == "") {
      alert("Missing Data: Grade");
      $("#gradeTestScore").focus();
      return false;
    } else if (Val == "") {
      alert("Missing Data: Value");
      $("#valTestScore").focus();
      return false;
    } else {
      $("#ScoresRemarksSetup").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_new_test_remarks.php",
        { Max: Max, Min: Min, Rmk: Rmk, Grd: Grd, Val: Val },
        function (e) {
          if (e == 1) {
            $.post("load_test_score_remarks_tbl.php", {}, function (a) {
              $("#exams_test_remarks_tbl").html(a);
            });
            $(".ep").val("");
            $(".progress-loader").remove();
            $("#maxTestScore").focus();
          } else {
            alert(e);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-SetupTest").click(function () {
    $("#SetupAcademicTest").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $("#setupTest_Calenda").load("load_active_calenda_sel.php");
    $(".progress-loader").remove();
  });

  $("#btn-add-testtype").click(function () {
    var CpNo = $.trim($("#setupTest_Calenda :selected").attr("id"));
    var Cp = $("#setupTest_Calenda").val();
    var TestID = $.trim($("#setupTest_TestType :selected").attr("id"));
    var TestType = $("#setupTest_TestType").val();
    var TName = $.trim($("#setTestName").val());
    var Score = $.trim($("#SetTestScore").val());

    if (Cp == "") {
      alert("Academic Term not active");
      $("#setupTest_Calenda").focus();
      return false;
    } else if (TestType == "") {
      alert("Missing Data: Test Type");
      return false;
    } else if (TName == "") {
      alert("Missing Data: Test Name");
      $("#setTestName").focus();
      return false;
    } else if (Score == "") {
      alert("Missing Data: Test Score");
      $("#SetTestScore").focus();
      return false;
    } else {
      $("#SetupAcademicTest").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "run_new_academic_test_exams.php",
        {
          CpNo: CpNo,
          Cp: Cp,
          TestID: TestID,
          Type: TestType,
          TName: TName,
          Score: Score,
        },
        function (a) {
          if (a == 1) {
            $(".ep").val("");
            $.post("load_academic_test_exams_tbl.php", {}, function (e) {
              $("#setup_academic_test_exams_tbl").html(e);
            });
            $(".progress-loader").remove();
            $("#setTestName").focus();
          } else {
            alert(a);
          }
        }
      );

      $(".progress-loader").remove();
    }
  });

  $("#btn-SetupTest").click(function () {
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $("#setupTest_TestType").load("load_test_type.php");
    $.post("load_academic_test_exams_tbl.php", {}, function (e) {
      $("#setup_academic_test_exams_tbl").html(e);
    });
    $(".progress-loader").remove();
  });

  //Record Student Marks - Admin
  $("#btn-StdrecordScore").click(function () {
    $("#recScore_Student").load("load_sel_class_recSubj_tch.php");
    $("#recScore_SelTestType").load("load_sel_class_TestType.php");
  });

  //Record Student Marks - Teacher
  $("#btn-StdrecordScore_tch").click(function () {
    $("#recScore_Student_tch").load("load_sel_class_recSubj_tch.php");
    $("#recScore_SelTestType_tch").load("load_sel_class_TestType.php");
    $("#temp_student_recTestScore_tch").load(
      "load_temp_student_recTestScore.php"
    );
  });

  //Record Student Test ReMarks - Teacher
  $("#btn-StdrecordSRemark_tch").click(function () {
    $("#recRemarks_Student_tch").load("load_sel_class_form_master.php");
    $("#recRemarks_SelTestType_tch").load("load_active_calenda_sel_1.php");
    $("#temp_student_recTestScore_tch").load(
      "load_temp_student_recTestScore.php"
    );
  });

  //Approve Terminal Report Ticket - Teacher
  $("#btn-TicketApproval_tch").click(function () {
    $("#apprvTicket_selClass_tch").load("load_sel_class_form_master.php");
    $("#apprvTicket_SelTestType_tch").load("load_active_calenda_sel_1.php");
    // $('#temp_student_recTestScore_tch').load('load_temp_student_recTestScore.php');
  });

  $("#recRemarks_Student_tch").click(function () {
    $("#recRemarks_SelTestType_tch").load("load_active_calenda_sel_1.php");
  });

  $("#apprvTicket_SelTestType_tch").change(function () {
    let cid = $.trim($("#apprvTicket_selClass_tch :selected").attr("id"));
    let cl = $("#apprvTicket_selClass_tch").val();
    let cpn = $.trim($("#apprvTicket_SelTestType_tch :selected").attr("id"));
    let cp = $("#apprvTicket_SelTestType_tch").val();

    if (cid == "") {
      alert("Select Class First");
      $("#apprvTicket_selClass_tch").focus();
      return false;
    } else if (cp == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "load_unauth_terminal_rpt_ticket.php",
        { cid: cid, cpn: cpn },
        function (a) {
          $("#temp_apprv_studentTermRpt_Tickets_tch").html(a);
          $(".progress-loader").remove();
        }
      );
    }
  });

  //Edit Undo Test Authorization - Admin
  $("#btn-undoTestAuth").click(function () {
    //$('#temp_student_editTestScore_tch').load('load_temp_student_editTestScore.php');
    $("#editScore_SelTestType").load("load_sel_class_editTest.php");
  });

  //Edit Student Marks - Teacher
  $("#btn-StdeditScore_tch").click(function () {
    $("#temp_student_editTestScore_tch").load(
      "load_temp_student_editTestScore.php"
    );
    $("#editScore_SelTestType_tch").load("load_sel_class_editTest_tch.php");
  });

  //Load class for student records test - Teacher
  $("#editScore_SelTestType_tch").change(function () {
    let tid = $.trim($("#editScore_SelTestType_tch :selected").attr("id"));
    let name = $.trim($("#editScore_SelTestType_tch").val());

    if (name == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_sel_class_subj_recScore.php",
        { Class: tid },
        function (a) {
          if (a == 1) {
            $("#editScore_StudentClass_tch").load(
              "load_sel_class_editScore_tch.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Load class for student records test - Admin
  $("#editScore_SelTestType").change(function () {
    let tid = $.trim($("#editScore_SelTestType :selected").attr("id"));
    let name = $.trim($("#editScore_SelTestType").val());

    if (name == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_sel_class_subj_recScore.php",
        { Class: tid },
        function (a) {
          if (a == 1) {
            $("#editScore_StudentClass").load("load_sel_class_editScore.php");
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Load subject for students records edit  -Teacher
  $("#editScore_StudentClass_tch").change(function () {
    let tid = $.trim($("#editScore_SelTestType_tch :selected").attr("id"));
    let tname = $.trim($("#editScore_SelTestType_tch").val());
    let cid = $.trim($("#editScore_StudentClass_tch :selected").attr("id"));
    let cname = $.trim($("#editScore_StudentClass_tch").val());

    if (tname == "") {
      alert("Select Test Type");
      return false;
    } else if (cname == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_val_rpt.php", { sid: tid, cid: cid }, function (a) {
        if (a == 1) {
          $("#editScore_SelSubject_tch").load(
            "load_sel_subject_editScore_tch.php"
          );
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Load subject for students records edit- Admin
  $("#editScore_StudentClass").change(function () {
    let tid = $.trim($("#editScore_SelTestType :selected").attr("id"));
    let tname = $.trim($("#editScore_SelTestType").val());
    let cid = $.trim($("#editScore_StudentClass :selected").attr("id"));
    let cname = $.trim($("#editScore_StudentClass").val());

    if (tname == "") {
      alert("Select Test Type");
      return false;
    } else if (cname == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_val_rpt.php", { sid: tid, cid: cid }, function (a) {
        if (a == 1) {
          $("#editScore_SelSubject").load("load_sel_subject_editScore.php");
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Load student test records for edit -
  $("#btn-load-student-edit_test_score_tch").click(function () {
    let TID = $.trim($("#editScore_SelTestType_tch :selected").attr("id"));
    let tname = $.trim($("#editScore_SelTestType_tch").val());
    let CID = $.trim($("#editScore_StudentClass_tch :selected").attr("id"));
    let cname = $.trim($("#editScore_StudentClass_tch").val());
    let SID = $.trim($("#editScore_SelSubject_tch :selected").attr("id"));
    let sbjnm = $.trim($("#editScore_SelSubject_tch").val());

    if (tname == "") {
      return false;
    } else if (cname == "") {
      return false;
    } else if (sbjnm == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "load_students_edit_test_score.php",
        { SID: SID, CID: CID, TID: TID },
        function (e) {
          $("#temp_student_editTestScore_tch").load(
            "load_temp_student_editTestScore.php"
          );
          $(".progress-loader").remove();
        }
      );
    }
  });

  //Load subject Class for  marks records- Admin
  $("#recScore_Student").change(function () {
    var Class = $.trim($("#recScore_Student :selected").attr("id"));

    $("#recStudentScore").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post(
      "insert_sel_class_subj_recScore.php",
      { Class: Class },
      function (a) {
        if (a == 1) {
          $("#recScore_SelSubject").load("load_sel_class_subj_recScore.php");
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      }
    );
  });

  //Load subject Class for  marks records- Teacher
  $("#recScore_Student_tch").change(function () {
    var e = $.trim($("#recScore_Student_tch :selected").attr("id"));

    if (e == "") {
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#recScore_SelSubject_tch").load("load_sel_subject_distinct_tch.php");
        $(".progress-loader").remove();
      });
    }
  });

  //Load subject Class for  marks records- Teacher
  $("#recRemarks_Student_tch").change(function () {
    var e = $.trim($("#recRemarks_Student_tch :selected").attr("id"));

    if (e == "") {
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#recRemarks_SelSubject_tch").load(
          "load_sel_subject_distinct_tch.php"
        );
        $(".progress-loader").remove();
      });
    }
  });

  //Load subject Class for detail test report- Teacher
  $("#rptmarkTest_SelClass_det_tch").change(function () {
    var e = $.trim($("#rptmarkTest_SelClass_det_tch :selected").attr("id"));

    if (e == "") {
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#rptmarkTest_SelSubject_det_tch").load(
          "load_sel_subject_distinct_tch.php"
        );
        $(".progress-loader").remove();
      });
    }
  });

  $("#btn-StdrecordScore").click(function () {
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.post("load_students_subj_test_score.php", {}, function () {
      $("#temp_student_recTestScore").load(
        "load_temp_student_recTestScore.php"
      );
    });

    $(".progress-loader").remove();
  });

  //Load all studens in class to record marks - admin
  $("#recScore_SelSubject").change(function () {
    var SID = $.trim($("#recScore_SelSubject :selected").attr("id"));
    var SN = $.trim($("#recScore_SelSubject").val());
    var CID = $.trim($("#recScore_Student :selected").attr("id"));
    var TID = $.trim($("#recScore_SelTestType :selected").attr("id"));
    var TNM = $.trim($("#recScore_SelTestType").val());

    if (SN == "") {
      return false;
    } else {
      $("#recStudentScore").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "load_students_subj_test_score.php",
        { SID: SID, CID: CID, TID: TID },
        function (e) {
          $("#temp_student_recTestScore").load(
            "load_temp_student_recTestScore.php"
          );
        }
      );

      $(".progress-loader").remove();
    }
  });

  //Load all studens in class to record marks - teacher
  $("#btn-load-student_test_score_tch").click(function () {
    var SID = $.trim($("#recScore_SelSubject_tch :selected").attr("id"));
    var SN = $.trim($("#recScore_SelSubject_tch").val());
    var CID = $.trim($("#recScore_Student_tch :selected").attr("id"));
    var TID = $.trim($("#recScore_SelTestType_tch :selected").attr("id"));
    var TNM = $.trim($("#recScore_SelTestType_tch").val());

    if (SN == "") {
      return false;
    } else {
      $("#recStudentScore").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "load_students_subj_test_score.php",
        { SID: SID, CID: CID, TID: TID },
        function (e) {
          $("#temp_student_recTestScore_tch").load(
            "load_temp_student_recTestScore.php"
          );
          $(".progress-loader").remove();
        }
      );
    }
  });

  //Search for new student without class
  $("#search_std_assignClass").keyup(function () {
    var e = $.trim($("#search_std_assignClass").val());

    if (e == "") {
    } else {
      $.post("search_std_unassign_class.php", { e: e }, function (a) {
        $("#std_assignClass_info").html(a);
      });
      //$('.progress-loader').remove();
    }
  });

  //Search for exiistng student for class reassingment
  $("#search_std_reassignClass").keyup(function () {
    var e = $.trim($("#search_std_reassignClass").val());

    if (e == "") {
    } else {
      $.post("search_std_reassign_class.php", { e: e }, function (a) {
        $("#std_reassignClass_info").html(a);
      });
      //$('.progress-loader').remove();
    }
  });

  //Search for exiistng student for edit
  $("#search_std_info_edit").keyup(function () {
    var e = $.trim($("#search_std_info_edit").val());

    if (e == "") {
    } else {
      $.post("search_std_edit_info.php", { e: e }, function (a) {
        $("#std_info_edit").html(a);
      });
      //$('.progress-loader').remove();
    }
  });

  //Search Staff ID for Info display
  $("#rpt_search_staffID_info").keyup(function () {
    var e = $.trim($("#rpt_search_staffID_info").val());

    if (e == "") {
    } else {
      $.post("search_staff_info_detail.php", { e: e }, function (a) {
        $("#staff_detailInfo_info").html(a);
      });
      //$('.progress-loader').remove();
    }
  });

  //Search Student ID for statement
  $("#rpt_search_stdID_sttmnt").keyup(function () {
    var e = $.trim($("#rpt_search_stdID_sttmnt").val());

    if (e == "") {
    } else {
      $.post("search_student_sttmnt_detail.php", { e: e }, function (a) {
        $("#student_serach_sttmtn_display").html(a);
      });
      //$('.progress-loader').remove();
    }
  });

  //Save student records marked - admin
  $("#btn-add-student_test_score").click(function () {
    var q = confirm("Save work?");

    if (q) {
      $("#recStudentScore").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_student_record_test.php", {}, function (a) {
        if (a == 1) {
          $.post("load_students_subj_test_score.php", {}, function () {
            $("#temp_student_recTestScore").load(
              "load_temp_student_recTestScore.php"
            );
          });
          $("#recScore_Student").load("load_sel_class_recScore.php");
          $(".progress-loader").remove();
          $("#recScore_SelTestType").focus();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  //Save student records marked - teacher
  $("#btn-add-student_test_score_tch").click(function () {
    var q = confirm("Save work?");

    if (q) {
      $("#recStudentScore").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_student_record_test.php", {}, function (a) {
        if (a == 1) {
          $.post("load_students_subj_test_score.php", {}, function () {
            $("#temp_student_recTestScore_tch").load(
              "load_temp_student_recTestScore.php"
            );
          });
          $("#recScore_Student_tch").load("load_sel_class_recSubj_tch.php");
          $("#recScore_SelTestType").focus();
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  //Update student records marked - teacher
  $("#btn-edit-student_test_score_tch").click(function () {
    var q = confirm("Update work?");

    let cpn = $.trim($("#editScore_SelSubject_tch :selected").attr("cpn"));
    let sbj = $.trim($("#editScore_SelSubject_tch").val());

    if (q) {
      if (sbj == "" || sbj == "...") {
        alert("Select Subject");
        return false;
      } else if (cpn == "") {
        alert("Mssing Data: Academic Coupon No.");
        return false;
      } else {
        $("#recStudentScore").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_student_record_test_update.php",
          { cpn: cpn },
          function (a) {
            if (a == 1) {
              alert("Student(s) score updated successfully");
              $.post("load_students_subj_test_score.php", {}, function () {
                $("#temp_student_editTestScore_tch").load(
                  "load_temp_student_editTestScore.php"
                );
              });
              $("#recScore_Student_tch").load("load_sel_class_recSubj_tch.php");
              $("#recScore_SelTestType").focus();
              $(".progress-loader").remove();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  //Load All Class for Marking of Register -  Admin
  $("#btn-markStudentReg").click(function () {
    $("#markReg_SelSubClass").load("load_sel_class_recScore.php");
    $("#stdReg_activedate").load("check_active_date.php");

    $.post("temp_student_register_info_tbl.php", {}, function (a) {
      $("#display_temp_student_register_tbl").html(a);
    });
  });

  //Load All Class for Marking of Register -  Teacher
  $("#btn-markStudentReg_tch").click(function () {
    $("#markReg_SelSubClass_tch").load("load_sel_class_recScore_tch.php");
    $("#stdReg_activedate").load("check_active_date.php");

    $.post("temp_student_register_info_tbl_tch.php", {}, function (a) {
      $("#display_temp_student_register_tbl_tch").html(a);
    });
  });

  //Load All Class For Marking Subect Register - admin
  $("#btn-markSubjectReg").click(function () {
    $("#subjReg_SelSubClass").load("load_sel_class_recScore.php");
    $("#subjReg_activedate").load("check_active_date.php");

    $.post("temp_subject_register_info_tbl.php", {}, function (a) {
      $("#display_temp_subject_register_tbl").html(a);
    });
  });

  //Load All Class For Marking Subect Register - Teacher
  $("#btn-markSubjectReg_tch").click(function () {
    $("#subjReg_SelSubClass_tch").load("load_sel_class_recSubj_tch.php");
    //$('#rptTerminal_SelClass_tch').load('load_sel_class_form_master.php');
    $("#subjReg_activedate").load("check_active_date.php");

    $.post("temp_subject_register_info_tbl.php", {}, function (a) {
      $("#display_temp_subject_register_tbl").html(a);
    });
  });

  //Load All Subject under a class - admin
  $("#subjReg_SelSubClass").change(function () {
    var e = $.trim($("#subjReg_SelSubClass :selected").attr("id"));

    if (e == "") {
    } else {
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#subjReg_SelSubject").load("load_sel_subject_distinct.php");
      });
    }
  });

  //Load All Subject under a class - teacher
  $("#subjReg_SelSubClass_tch").change(function () {
    var e = $.trim($("#subjReg_SelSubClass_tch :selected").attr("id"));

    if (e == "") {
    } else {
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#subjReg_SelSubject_tch").load("load_sel_subject_distinct_tch.php");
      });
    }
  });

  //Mark class register by admin
  $("#btn-markReg_process").click(function () {
    var e = $.trim($("#markReg_SelSubClass :selected").attr("id"));
    var n = $.trim($("#markReg_SelSubClass").val());

    if (n == "") {
      alert("Missing Data: Class");
      $("#markReg_SelSubClass").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post("add_temp_student_register.php", { e: e, n: n }, function (a) {
        if (a == 1) {
          $.post("temp_student_register_info_tbl.php", {}, function (a) {
            $("#display_temp_student_register_tbl").html(a);
          });
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Mark class register by form master
  $("#btn-markReg_process_tch").click(function () {
    var e = $.trim($("#markReg_SelSubClass_tch :selected").attr("id"));
    var n = $.trim($("#markReg_SelSubClass_tch").val());

    if (n == "") {
      alert("Missing Data: Class");
      $("#markReg_SelSubClass_tch").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post("add_temp_student_register.php", { e: e, n: n }, function (a) {
        if (a == 1) {
          $.post("temp_student_register_info_tbl.php", {}, function (a) {
            $("#display_temp_student_register_tbl_tch").html(a);
          });
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Process Subject register for admin
  $("#btn-subjReg_process").click(function () {
    var e = $.trim($("#subjReg_SelSubClass :selected").attr("id"));
    var n = $.trim($("#subjReg_SelSubClass").val());
    var s = $.trim($("#subjReg_SelSubject :selected").attr("id"));
    var sn = $.trim($("#subjReg_SelSubject").val());

    if (n == "") {
      alert("Missing Data: Class");
      $("#subjReg_SelSubClass").focus();
      return false;
    } else if (sn == "") {
      alert("Missing Data: Select Subject");
      $("#subjReg_SelSubject").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_temp_subject_register.php",
        { e: e, n: n, s: s, sn: sn },
        function (a) {
          if (a == 1) {
            $.post("temp_subject_register_info_tbl.php", {}, function (a) {
              $("#display_temp_subject_register_tbl").html(a);
            });
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Process Subject register for teacher
  $("#btn-subjReg_process_tch").click(function () {
    var e = $.trim($("#subjReg_SelSubClass_tch :selected").attr("id"));
    var n = $.trim($("#subjReg_SelSubClass_tch").val());
    var s = $.trim($("#subjReg_SelSubject_tch :selected").attr("id"));
    var sn = $.trim($("#subjReg_SelSubject_tch").val());

    if (n == "") {
      alert("Missing Data: Class");
      $("#subjReg_SelSubClass_tch").focus();
      return false;
    } else if (sn == "") {
      alert("Missing Data: Select Subject");
      $("#subjReg_SelSubject_tch").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_temp_subject_register.php",
        { e: e, n: n, s: s, sn: sn },
        function (a) {
          if (a == 1) {
            $.post("temp_subject_register_info_tbl_tch.php", {}, function (a) {
              $("#display_temp_subject_register_tbl_tch").html(a);
            });
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-set-new-tdate").click(function () {
    var q = confirm("Start a new date?");

    if (q) {
      var tdate = $.trim($("#txt-active-date").val());

      if (tdate == "") {
        alert("Missing Date: Active Date");
        $("#txt-active-date").focus();
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );

        $.post("add_new_active_date.php", { e: tdate }, function (a) {
          if (a == 1) {
            $("#b_active_date").load("load_my_active_date.php");
            $(".progress-loader").remove();
            alert("Date started successfully");
            $("#txt-check-active-date").load("check_active_date.php");
            $("#activeDateCover").hide();
            $(".ep").val("");
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        });
      }
    } else {
      return false;
    }
  });

  $("#btn-end-new-tdate").click(function () {
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    var q = confirm("End current date?");

    if (q) {
      $.post("run_end_current_day.php", {}, function (e) {
        if (e == 1) {
          $("#b_active_date").load("load_my_active_date.php");
          $("#txt-check-active-date").load("check_active_date.php");
          $(".progress-loader").remove();
          $("#activeDateCover").show();
        } else {
          alert(e);
          $(".progress-loader").remove();
          return false;
        }
      });
    } else {
      $(".progress-loader").remove();
      return false;
    }
  });

  $("#btn-restart-date").click(function () {
    $("#recStudentScore").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $("#div_existing_dates_view").load("load_existing_dates_tbl.php");

    $(".progress-loader").remove();
  });

  $("#btn-rpt-gen-population").click(function () {
    // window.open("rpt_general_student_population.php", "", "scrollbars=1,width=1250, height=1000","_blank");
    window.open("rpt_general_student_population.php", "_blank");
  });

  $("#btn-rpt-stdpop-chart").click(function () {
    // window.open("rpt_general_student_population.php", "", "scrollbars=1,width=1250, height=1000","_blank");
    window.open("rpt_student_population_chart.php", "_blank");
  });

  //Academics report pannel for admin
  $("#btn-academic-rpt").click(function () {
    $("#rptstd_ClassPop").load("load_sub_class_sel.php");
    $("#rptSubj_RegClass").load("load_sub_class_sel.php");
    $("#rptClass_RegClass").load("load_sub_class_sel.php");
    $(".ep").val("");
  });

  //Academics report pannel for teacher
  $("#btn-academic-tch-rpt").click(function () {
    $("#rptstd_ClassPop").load("load_sub_class_sel.php");
    $("#rptSubj_RegClass_tch").load("load_sel_class_recSubj_tch.php");
    $("#rptClass_RegClass").load("load_sel_class_recScore_tch.php");
    $(".ep").val("");
  });

  //Student population by class report
  $("#btn-rpt-stdpop-class").click(function () {
    var n = $.trim($("#rptstd_ClassPop").val());
    var e = $.trim($("#rptstd_ClassPop :selected").attr("id"));

    if (n == "") {
      alert("Missing Data: Select Class");
      $("#rptstd_ClassPop").focus();
      return false;
    } else {
      $("#recStudentScore").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_sel_class_subj_recScore.php",
        { n: n, Class: e },
        function (a) {
          window.open("rpt_subclass_student_population.php", "_blank");
        }
      );
      $(".progress-loader").remove();
    }
  });

  //Load Subject from Class fro register rpt - admin
  $("#rptSubj_RegClass").change(function () {
    let n = $.trim($("#rptSubj_RegClass").val());
    let e = $.trim($("#rptSubj_RegClass :selected").attr("id"));

    if (n == "") {
      alert("Missing Data: Select Class");
      $("#rptSubj_RegClass").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_sel_class_subj_recScore.php",
        { n: n, Class: e },
        function (a) {
          $("#rptSubj_RegSubject").load("load_sel_subject_distinct.php");
        }
      );
      $(".progress-loader").remove();
    }
  });

  //Load Subject from Class fro register rpt - admin
  $("#rptSubj_RegClass_tch").change(function () {
    let n = $.trim($("#rptSubj_RegClass_tch").val());
    let e = $.trim($("#rptSubj_RegClass_tch :selected").attr("id"));

    if (n == "") {
      alert("Missing Data: Select Class");
      $("#rptSubj_RegClass_tch").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_sel_class_subj_recScore.php", { Class: e }, function () {
        $("#rptSubj_RegSubject_tch").load("load_sel_subject_distinct_tch.php");
      });
      $(".progress-loader").remove();
    }
  });

  //View SSubject regster - admin
  $("#btn-rpt-subjRegister").click(function () {
    alert("del");
    var cnm = $.trim($("#rptSubj_RegClass").val());
    var cid = $.trim($("#rptSubj_RegClass :selected").attr("id"));
    var snm = $.trim($("#rptSubj_RegSubject").val());
    var sid = $.trim($("#rptSubj_RegSubject :selected").attr("id"));
    var dt = $.trim($("#rptSubj_RegDate").val());

    if (cnm == "") {
      alert("Missing Data: Select Class");
      $("#rptSubj_RegClass").focus();
      return false;
    } else if (snm == "") {
      alert("Missing Data: Select Subject");
      $("#rptSubj_RegSubject").focus();
      return false;
    } else if (dt == "") {
      alert("Missing Data: Report Date");
      $("#rptSubj_RegDate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_val_rpt.php",
        { cnm: cnm, snm: snm, cid: cid, sid: sid, dt: dt },
        function () {
          window.open("rpt_class_subject_register.php", "_blank");
        }
      );
      $(".progress-loader").remove();
    }
  });

  //View SSubject regster - teacher
  $("#btn-rpt-subjRegister_tch").click(function () {
    var cnm = $.trim($("#rptSubj_RegClass_tch").val());
    var cid = $.trim($("#rptSubj_RegClass_tch :selected").attr("id"));
    var snm = $.trim($("#rptSubj_RegSubject_tch").val());
    var sid = $.trim($("#rptSubj_RegSubject_tch :selected").attr("id"));
    var dt = $.trim($("#rptSubj_RegDate").val());

    if (cnm == "") {
      alert("Missing Data: Select Class");
      $("#rptSubj_RegClass_tch").focus();
      return false;
    } else if (snm == "") {
      alert("Missing Data: Select Subject");
      $("#rptSubj_RegSubject_tch").focus();
      return false;
    } else if (dt == "") {
      alert("Missing Data: Report Date");
      $("#rptSubj_RegDate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_val_rpt.php",
        { cnm: cnm, snm: snm, cid: cid, sid: sid, dt: dt },
        function () {
          window.open("rpt_class_subject_register.php", "_blank");
        }
      );
      $(".progress-loader").remove();
    }
  });

  $("#btn-rpt-classRegister").click(function () {
    var cnm = $.trim($("#rptClass_RegClass").val());
    var cid = $.trim($("#rptClass_RegClass :selected").attr("id"));
    var dt = $.trim($("#rptClass_RegDate").val());

    if (cnm == "") {
      alert("Missing Data: Select Class");
      $("#rptClass_RegClass").focus();
      return false;
    } else if (dt == "") {
      alert("Missing Data: Report Date");
      $("#rptClass_RegDate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_val_rpt.php",
        { cnm: cnm, cid: cid, dt: dt },
        function () {
          window.open("rpt_class_register.php", "_blank");
        }
      );
      $(".progress-loader").remove();
    }
  });

  $("#uploadimage0").on("submit", function (e) {
    // alert('start upload');]
    e.preventDefault();
    var e = $.trim($("#lbl_imgStaffID").text());

    if (e == "") {
      alert("Missing Data: Staff Name");
      $("#img_search_StdName").focus();
      return false;
    } else {
      $("#message0").empty();
      $("#loading").show();
      $.ajax({
        url: "ajax_php_file.php", // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false, // To send DOMDocument or non processed data file it is set to false
        success: function (data) {
          $("#loading").hide();
          $("#img_search_StdName").focus();
          $("#message0").html(data);
          $("#file0").val("").focus();
          // alert(data);
        },
      });
    }
  });

  //Show Staff details Report
  $("#btn-rpt-staffDetails").click(function () {
    var e = $.trim($("#lbl_staffInfoID").text());
    var n = $.trim($("#rpt_search_staffID_info").val());

    if (e == "") {
      alert("Missing Data: Staff ID");
      $("#rpt_search_staffID_info").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_student_id.php", { e: e }, function () {
        window.open("rpt_staff_details.php", "_blank");
      });
      $(".progress-loader").remove();
    }
  });

  //Show Summary Income Report
  $("#btn-rptSummaryIncome").click(function () {
    var fdt = $.trim($("#rptSummaryIncome_fdt").val());
    var ldt = $.trim($("#rptSummaryIncome_ldt").val());

    if (fdt == "") {
      alert("Missing Data: First Date");
      $("#rptSummaryIncome_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Missing Data: Last Date");
      $("#rptSummaryIncome_ldt").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_date.php", { fdt: fdt, ldt: ldt }, function () {
        window.open("rpt_income_statement.php", "_blank");
      });
      $(".progress-loader").remove();
    }
  });

  //Show Balance Sheet
  $("#btn-rptBalance-sheet").click(function () {
    var fdt = $.trim($("#rptBsheet_fdt").val());
    var ldt = $.trim($("#rptBsheet_fdt").val());

    if (fdt == "") {
      alert("Missing Data: First Date");
      $("#rptBsheet_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Missing Data: Last Date");
      $("#rptBsheet_fdt").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_date.php", { fdt: fdt, ldt: ldt }, function () {
        window.open("rpt_balance_sheet.php", "_blank");
      });
      $(".progress-loader").remove();
    }
  });

  $("#btn-financeSetup").click(function () {
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("get_ledger_control_id.php", {}, function (a) {
      $("#lbl_newCtrlID").text(a);
      $("#display_new_control_ledger").load("load_ledger_control_tbl.php");
      $("#sel_LedgerContrl").load("load_ledger_control_sel.php");
    });
    $(".progress-loader").remove();
  });

  $("#btn-new-control-ledger").click(function () {
    var CID = $.trim($("#newledgerControlID").text());
    var CNM = $.trim($("#txt_newCtryName").val());

    if (CID == "") {
      alert("Missing Data: Control ID");
      $("#lbl_newCtrlID").focus();
      return false;
    } else if (CNM == "") {
      alert("Missing Data: Control Name");
      $("#txt-newControlName").focus();
      return false;
    } else {
      //$('body').append('<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>');

      $.post(
        "add_new_ledger_control.php",
        { CID: CID, CNM: CNM },
        function (a) {
          if (a == 1) {
            $("#newledgerControlID").load("get_new_ledger_controlID.php");
            $("#display_new_control_ledger").load(
              "load_ledger_control_tbl.php"
            );
            $(".ep").val("");
            $("#txt-newControlName").focus();
          } else {
            alert(a);
          }
        }
      );
      $(".progress-loader").remove();
    }
  });

  $("#btn-new-ledger-account").click(function () {
    var lid = $.trim($("#newledgerAccountID").text());
    var cid = $.trim($("#sel_LedgerContrl :selected").attr("id"));
    var type = $.trim($("#sel_LedgerType").val());
    var cls = $.trim($("#sel_LedgerCtgry :selected").attr("class"));
    var ctgr = $.trim($("#sel_LedgerCtgry :selected").attr("id"));
    var bill = $.trim($("#sel_LedgerBill :selected").attr("id"));
    var lnm = $.trim($("#txt-newLedgerName").val());

    if (lid == "") {
      alert("Missing Data: Ledger ID");
      return false;
    } else if (lnm == "") {
      alert("Missing Data: Ledger Account Name");
      $("#txt-newLedgerName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_new_ledger_account.php",
        {
          cid: cid,
          ctgr: ctgr,
          lid: lid,
          lnm: lnm,
          type: type,
          cls: cls,
          bil: bill,
        },
        function (a) {
          if (a == 1) {
            alert("Ledger account created successfully");
            $("#newledgerAccountID").load("get_new_ledger_accountID.php");
            $("#display_new_ledger_account").load(
              "load_ledger_account_tbl.php"
            );
            $(".ep").val("");
            $(".progress-loader").remove();
            $("#txt-newControlName").focus();
          } else {
            $(".progress-loader").remove();
            alert(a);
          }
        }
      );
      $(".progress-loader").remove();
    }
  });

  $("#sel_LedgerContrl").change(function () {
    var n = $.trim($("#sel_LedgerContrl").val());

    if (n == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $("#lbl_newLedgerID").load("load_new_ledger_id.php");
      $("#sel_LedgerCtgry").load("load_new_ledger_category.php");
      $(".progress-loader").remove();
    }
  });

  $("#LedgerAcc-tab").click(function () {
    $("#display_new_ledger_account").load("load_ledger_account_tbl.php");
    $("#sel_LedgerContrl").load("load_ledger_control_sel.php");
    $("#sel_LedgerCtgry").load("load_new_ledger_category.php");
  });

  $("#btn-new-account-ledger").click(function () {
    var Ctg = $.trim($("#sel_LedgerCtgry :selected").attr("id"));
    var Ctn = $.trim($("#sel_LedgerCtgry").val());
    var CID = $.trim($("#sel_LedgerContrl :selected").attr("id"));
    var cls = $.trim($("#sel_LedgerCtgry :selected").attr("class"));
    var Cn = $.trim($("#sel_LedgerContrl").val());
    var LID = $.trim($("#lbl_newLedgerID").text());
    var LN = $.trim($("#txt-newLedgerControlName").val());

    if (Cn == "") {
      alert("Select Ledger Control");
      $("#sel_LedgerContrl").focus();
      return false;
    } else if (Ctn == "") {
      alert("Select Ledger Category");
      $("#sel_LedgerCtgry").focus();
      return false;
    } else if (LID == "") {
      alert("Missing Data: Ledger ID");
      return false;
    } else if (LN == "") {
      alert("Missing Data: Ledger Name");
      $("#txt-newLedgerControlName").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_ledger_account.php",
        { ctg: Ctg, ctn: Ctn, cid: CID, cn: Cn, lid: LID, ln: LN, cls: cls },
        function (a) {
          if (a == 1) {
            alert("Ledger Account created succeffully");
            $("#lbl_newLedgerID").load("load_new_ledger_id.php");
            $(".ep").val("");
            $("#sel_LedgerContrl").load("load_ledger_control_sel.php");
            $("#display_new_ledger_account").load(
              "load_ledger_account_tbl.php"
            );
            $("#sel_LedgerContrl").focus();
          } else {
            alert(a);
          }
        }
      );

      $(".progress-loader").remove();
    }
  });

  $("#IncomeAcc-tab").click(() => {
    $("#lbl_activePNL_NewAccount").load("load_active_pnl_account.php");
    $("#lbl_newIncomeID").load("load_new_ledger_id.php");
    $("#display_new_income_account").load("load_income_account_tbl.php");
    $("#sel_IncomeCategory").load("load_sel_income_ctgry.php");
  });

  $("#MapAddmission-tab").click(() => {
    $("#sel_MapAdmisionFeeClass").load("load_class_course.php");
    $("#sel_MapAdmisionFeeAccount").load("load_sel_income_account_bill.php");
    // $('#display_new_expense_account').load('load_expense_account_tbl.php');
  });

  $("#MapSchoolFee-tab").click(() => {
    $("#sel_MapSchoolFeeClass").load("load_sub_class_sel.php");
    $("#sel_MapSchoolFeeAccount").load("load_sel_income_account_bill.php");
    // $('#display_new_expense_account').load('load_expense_account_tbl.php');
  });

  //Create new Expenditure Account
  $("#ExpenditureAcc-tab").click(() => {
    $("#lbl_activePNL_ExpenseAcc").load("load_active_pnl_account.php");
    $("#lbl_newExpenseID").load("load_new_ledger_id.php");
    $("#display_new_expense_account").load("load_expense_account_tbl.php");
    $("#sel_ExpenseCategory").load("load_sel_expense_ctgry.php");
  });

  $("#btn_new_income_ledger").click(function () {
    let IE = $.trim($("#lbl_activePNL_NewAccount").text());
    let LID = $.trim($("#lbl_newIncomeID").text());
    let LN = $.trim($("#txt-newIncomeName").val());
    let CID = $.trim($("#sel_IncomeCategory :selected").attr("id"));
    let CNM = $.trim($("#sel_IncomeCategory").val());
    let Stn = $.trim($("#sel_IncomeStatus").val());
    let st = $("#sel_IncomeStatus :selected").attr("id");

    if (LID == "") {
      alert("Missing Data: Income Account ID");
      return false;
    } else if (LN == "") {
      alert("Missing Data: Income Account Name");
      $("#txt-newIncomeName").focus();
      return false;
    } else if (Stn == "") {
      alert("Missing Data: Income Account Status");
      $("#sel_IncomeStatus").focus();
      return false;
    } else if (IE == "") {
      alert("Missing Data: Active Income Account");
      return false;
    } else if (CNM == "") {
      alert("Select Category");
      $("#sel_IncomeCategory").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_income_account.php",
        { ie: IE, stn: Stn, cid: CID, cnm: CNM, st: st, lid: LID, ln: LN },
        function (a) {
          if (a == 1) {
            alert("Ledger Account created succeffully");
            $("#lbl_newIncomeID").load("load_new_ledger_id.php");
            $(".ep").val("");
            // $('#sel_LedgerContrl').load('load_ledger_control_sel.php');
            $("#display_new_income_account").load(
              "load_income_account_tbl.php"
            );
            $(".progress-loader").remove();
            $("#txt-newIncomeName").focus();
          } else if (a == 2) {
            let q = confirm(
              "Ledger (" +
                LN +
                ") already exists. Continue to update " +
                LN +
                "?"
            );
            if (q) {
              //Run query to upload income ledger info
              $.post(
                "update_income_ledger.php",
                { st: st, lid: LID, ln: LN },
                (c) => {
                  if (c == 1) {
                    $(".ep").val("");
                    $("#display_new_income_account").load(
                      "load_income_account_tbl.php"
                    );
                    $("#txt-newIncomeName").focus();
                  } else {
                    alert(c);
                    $(".progress-loader").remove();
                  }
                }
              );
              $(".progress-loader").remove();
            } else {
              $(".progress-loader").remove();
              return false;
            }
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn_new_expense_ledger").click(function () {
    let IE = $.trim($("#lbl_activePNL_ExpenseAcc").text());
    let LID = $.trim($("#lbl_newExpenseID").text());
    let LN = $.trim($("#txt-newExpenseName").val());
    let CID = $.trim($("#sel_ExpenseCategory :selected").attr("id"));
    let CNM = $.trim($("#sel_ExpenseCategory").val());
    let Stn = $.trim($("#sel_ExpenseStatus").val());
    let st = $("#sel_ExpenseStatus :selected").attr("id");

    if (LID == "") {
      alert("Missing Data: Income Account ID");
      return false;
    } else if (LN == "") {
      alert("Missing Data: Income Account Name");
      $("#txt-newExpenseName").focus();
      return false;
    } else if (CNM == "") {
      alert("Select Category");
      $("#sel_ExpenseCategory").focus();
      return false;
    } else if (Stn == "") {
      alert("Missing Data: Income Account Status");
      $("#sel_ExpenseStatus").focus();
      return false;
    } else if (IE == "") {
      alert("Missing Data: Active Income Account");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_expense_account.php",
        { ie: IE, stn: Stn, cid: CID, cnm: CNM, st: st, lid: LID, ln: LN },
        function (a) {
          if (a == 1) {
            alert("Ledger Account created succeffully");
            $(".ep").val("");
            // $('#sel_LedgerContrl').load('load_ledger_control_sel.php');
            $("#lbl_newExpenseID").load("load_new_ledger_id.php");
            $("#display_new_expense_account").load(
              "load_expense_account_tbl.php"
            );
            $("#txt-newExpenseName").focus();
          } else {
            alert(a);
          }
        }
      );

      $(".progress-loader").remove();
    }
  });

  //Load Staff profile
  $("#btn-viewProfile").click(function () {
    $.post("load_staff_profile_details.php", {}, function (a) {
      $("#subject-cateogory-tbl").html(a);
    });
  });

  //Load Student Profile
  $("#btn-viewProfile-std").click(function () {
    $.post("load_student_profile_details.php", {}, function (a) {
      $("#student_profile_details_tbl").html(a);
    });
  });

  $("#btn-editStaffProfile").click(function () {
    $("#edit_staff_profile_details").load(
      "load_edit_staff_profile_details.php"
    );
    // $('#subject-main-tbl').html('');
  });

  //Tracked shipment
  $("#tracked_shipping_count").load("load_tracked_shipping_count.php");
  setInterval(() => {
    $("#tracked_shipping_count").load("load_tracked_shipping_count.php");
  }, 30000);

  //
  $("#display_new_consignment").load("load_new_pending_consignment_new.php");
  // setInterval(() => {
  //   $("#display_new_consignment").load("load_new_pending_consignment_new.php");
  // }, 50000);

  //Admin Notification
  setInterval(function () {
    $("#check-auth-notification").load("load_user_notification_count.php");
  }, 15000);
  $("#check-auth-notification").load("load_user_notification_count.php");

  //Admin Notification - Student Test Score
  setInterval(function () {
    $("#check-envlp-notification").load("load_student_test_notification.php");
  }, 15000);
  $("#check-envlp-notification").load("load_student_test_notification.php");

  //Admin Notification for Student Test Score
  setInterval(function () {
    $("#check-auth-notification").load("load_user_notification_count.php");
  }, 15000);
  $("#check-auth-notification").load("load_user_notification_count.php");

  //Show notification when clicked on the icon
  $("#check-auth-notification").click(function () {
    $("#staff_passowrd_update").show();
    $("#staff_update_profile_ntf").load(
      "check_staff_profile_update_pending_ntf.php"
    );
    $("#staff_passowrd_update").load(
      "check_staff_password_update_pending_ntf.php"
    );
  });

  //View Staff Password Alteration Pop Up
  $("#staff_passowrd_update").click(function () {
    $("#tbl_staff_password_edit_display").load(
      "load_staff_password_change_display.php"
    );
  });

  //Approve Staff Details Alteration Pop Up
  $("#staff_update_profile_ntf").click(function () {
    $("#tbl_staff_profile_edit_display").load(
      "load_staff_profile_approval_display.php"
    );
  });

  //Load Class Mapped Admission Fees
  $("#sel_MapAdmisionFeeClass").change(() => {
    let classid = $.trim($("#sel_MapAdmisionFeeClass :selected").attr("id"));
    let clas = $.trim($("#sel_MapAdmisionFeeClass").val());

    if (clas == "") {
      $("#display_admission_fee_map").html("");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("load_admission_map_tbl.php", { classid: classid }, (a) => {
        $("#display_admission_fee_map").html(a);
      });

      $(".progress-loader").remove();
    }
  });

  //Load Class Mapped School Fees
  $("#sel_MapSchoolFeeClass").change(() => {
    let classid = $.trim($("#sel_MapSchoolFeeClass :selected").attr("id"));
    let clas = $.trim($("#sel_MapSchoolFeeClass").val());

    if (clas == "") {
      $("#display_school_fee_map").html("");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("load_school_fee_map_tbl.php", { classid: classid }, (a) => {
        $("#display_school_fee_map").html(a);
      });

      $(".progress-loader").remove();
    }
  });

  //Mapping Admission Fees
  $("#btn-new-admision-account-map").click(() => {
    let classid = $.trim($("#sel_MapAdmisionFeeClass :selected").attr("id"));
    let clas = $.trim($("#sel_MapAdmisionFeeClass").val());
    let accountid = $.trim(
      $("#sel_MapAdmisionFeeAccount :selected").attr("id")
    );
    let account = $.trim($("#sel_MapAdmisionFeeAccount").val());
    let amount = $.trim($("#txt_MapAdmisionFeeAmt").val());

    if (clas == "") {
      alert("Select Class");
      $("#sel_MapAdmisionFeeClass").focus();
      return false;
    } else if (account == "") {
      alert("Select fee account");
      $("#sel_MapAdmisionFeeAccount").focus();
      return false;
    } else if (amount == "") {
      alert("Enter fee amount");
      $("#txt_MapAdmisionFeeAmt").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_map_addmission_fee_account.php",
        {
          classid: classid,
          accountid: accountid,
          amt: amount,
          clas: clas,
          account: account,
        },
        (a) => {
          if (a == 1) {
            $(".ep").val("");
            $("#sel_MapAdmisionFeeAccount").load(
              "load_sel_income_account_bill.php"
            );
            //Reload Admission Fee map table
            $.post("load_admission_map_tbl.php", { classid: classid }, (e) => {
              $("#display_admission_fee_map").html(e);
            });

            $("#sel_MapAdmisionFeeAccount").focus();
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Mapping School Fee
  $("#btn-new-school-account-map").click(() => {
    let classid = $.trim($("#sel_MapSchoolFeeClass :selected").attr("id"));
    let clas = $.trim($("#sel_MapSchoolFeeClass").val());
    let accountid = $.trim($("#sel_MapSchoolFeeAccount :selected").attr("id"));
    let account = $.trim($("#sel_MapSchoolFeeAccount").val());
    let amount = $.trim($("#txt_MapSchoolFeeAmt").val());

    if (clas == "") {
      alert("Select Class");
      $("#sel_MapSchoolFeeClass").focus();
      return false;
    } else if (account == "") {
      alert("Select fee account");
      $("#sel_MapSchoolFeeAccount").focus();
      return false;
    } else if (amount == "") {
      alert("Enter fee amount");
      $("#txt_MapSchoolFeeAmt").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_map_school_fee_account.php",
        {
          classid: classid,
          accountid: accountid,
          amt: amount,
          clas: clas,
          account: account,
        },
        (a) => {
          if (a == 1) {
            $(".ep").val("");
            $("#sel_MapSchoolFeeAccount").load(
              "load_sel_income_account_bill.php"
            );
            //Reload Admission Fee map table
            $.post("load_school_fee_map_tbl.php", { classid: classid }, (e) => {
              $("#display_school_fee_map").html(e);
            });

            $("#sel_MapSchoolFeeAccount").focus();
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-formMasterMapp").click(() => {
    $("#mapp_FormMasterClass").load("load_sub_class_sel.php");
    $("#tbl_map_form_master_class").load("load_form_master_class_map.php");
  });

  //Assign Form Master to Class
  $("#add_class_form_master").click(() => {
    let StaffID = $.trim($("#map_formMaster_id").text());
    let ClassID = $.trim($("#mapp_FormMasterClass :selected").attr("id"));
    let Clas = $.trim($("#mapp_FormMasterClass").val());

    if (StaffID == "") {
      alert("Search Staff Name");
      $("#map_FormMasterName").focus();
      return false;
    } else if (Clas == "") {
      alert("Select Class");
      $("#mapp_FormMasterClass").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "map_class_form_master.php",
        { CLID: ClassID, Clas: Clas, STID: StaffID },
        (a) => {
          if (a == 1) {
            $("#tbl_map_form_master_class").load(
              "load_form_master_class_map.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //General Student Billing
  $("#genStudentTrans-tab").click(() => {
    $("#sel_gen_bill_class").load("load_staff_class_map.php");
    $("#gen_class_bill_receiptid").load("get_receipt_id.php");
    $("#gen_class_bill_receiptno").load("get_receipt_no.php");
    $("#display_gen_student_billing_class").load(
      "load_temp_general_class_billing.php"
    );
  });

  //Individual Student Billing
  $("#accStudentTrans-tab").click(() => {
    $("#sel_gen_bill_class").load("load_staff_class_map.php");
    $("#gen_ind_std_receiptid").load("get_receipt_id.php");
    $("#gen_ind_std_receiptno").load("get_receipt_no.php");
    $("#temp_ind_std_bill_view").load("load_ind_std_bill_account_details.php");
  });

  //Generate Transaction ID/No by Date
  $("#gen_class_bill_tdate").change(() => {
    let dt = $.trim($("#gen_class_bill_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#gen_class_bill_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#gen_class_bill_receiptno").text(a);
    });
  });

  //Generate Transaction ID/No by Date - Individual Student Billing
  $("#gen_ind_std_tdate").change(() => {
    let dt = $.trim($("#gen_ind_std_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#gen_ind_std_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#gen_ind_std_receiptno").text(a);
    });
  });

  //Process Student Billing General
  $("#btn_proces_gen_std_billing").click(function () {
    let clid = $.trim($("#sel_gen_bill_class :selected").attr("id"));
    let cls = $.trim($("#sel_gen_bill_class").val());

    if (cls == "") {
      alert("Missing Data: Select Class");
      $("#sel_gen_bill_class").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_process_gen_student_bill.php",
        { clid: clid, cls: cls },
        function (a) {
          if (a == 1) {
            $("#display_gen_student_billing_class").load(
              "load_temp_general_class_billing.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Save General Class Billing
  $("#btn_run_gen_std_billing").click(function () {
    let note = $.trim($("#gen_class_bill_note").val());
    let desc = $.trim($("#gen_class_bill_description").val());
    let recid = $.trim($("#gen_class_bill_receiptid").text());
    let recno = $.trim($("#gen_class_bill_receiptno").text());
    let dt = $.trim($("#gen_class_bill_tdate").val());
    let startdt = $.trim($("#gen_class_bill_pmtStartdate").val());
    let cls = $.trim($("#sel_gen_bill_class :selected").attr("id"));
    let cnm = $.trim($("#sel_gen_bill_class").val());

    if (cnm == "") {
      alert("Missing Data: Select Class");
      $("#sel_gen_bill_class").focus();
      return false;
    } else if (dt == "") {
      alert("Missing Data: Select Transaction Date");
      $("#gen_class_bill_tdate").focus();
      return false;
    } else if (startdt == "") {
      alert("Missing Data: Select Payment Start Date");
      $("#gen_class_bill_description").focus();
      return false;
    } else if (desc == "") {
      alert("Missing Data: Transaction Description");
      $("#gen_class_bill_description").focus();
      return false;
    } else if (recid == "" || recno == "") {
      alert("Missing Data: Receipt ID/No");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_gen_class_bill.php",
        {
          cnm: cnm,
          cls: cls,
          sttdt: startdt,
          note: note,
          desc: desc,
          recid: recid,
          recno: recno,
          dt: dt,
        },
        function (a) {
          if (a == 1) {
            $(".progress-loader").remove();
            alert("Student's accounts billed successfully");
            $(".ep").val("");
            $("#sel_gen_bill_class").load("load_staff_class_map.php");
            $("#gen_class_bill_receiptid").load("get_receipt_id.php");
            $("#gen_class_bill_receiptno").load("get_receipt_no.php");
            $("#display_gen_student_billing_class").load(
              "load_temp_general_class_billing.php"
            );
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Student Name - Individual Billing
  $("#ind_bill_std_search").keyup(function () {
    var e = $.trim($("#ind_bill_std_search").val());

    if (e == "") {
    } else {
      $.post("search_std_ind_bill.php", { e: e }, function (a) {
        $("#search_StdBill_info").html(a);
      });
    }
  });

  //Save Individual Student Billing
  $("#btn_run_ind_std_billing").click(() => {
    let dt = $.trim($("#gen_ind_std_tdate").val());
    let pmtdt = $.trim($("#gen_ind_std_pmtdate").val());
    let recid = $.trim($("#gen_ind_std_receiptid").text());
    let recno = $.trim($("#gen_ind_std_receiptno").text());
    let des = $.trim($("#gen_ind_std_description").val());
    let note = $.trim($("#gen_ind_std_note").val());

    if (dt == "") {
      alert("Select Transaction Date");
      $("#gen_ind_std_tdate").focus();
      return false;
    } else if (pmtdt == "") {
      alert("Select Payment Start Date");
      $("#gen_ind_std_pmtdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_individal_std_bill.php",
        {
          pmtdt: pmtdt,
          dt: dt,
          recid: recid,
          recno: recno,
          desc: des,
          note: note,
        },
        function (a) {
          if (a == 1) {
            $(".progress-loader").remove();
            $(".ep").val("");
            $("#gen_ind_std_receiptid").load("get_receipt_id.php");
            $("#gen_ind_std_receiptno").load("get_receipt_no.php");
            $("#temp_ind_std_bill_view").html("");
            alert("Billing saved successfully");
            $("#ind_bill_std_search").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Student ID for Fee Repayment
  $("#txt_feeRpmtStudentIDSearch").keyup(function () {
    var e = $.trim($("#txt_feeRpmtStudentIDSearch").val());

    if (e == "") {
    } else {
      $.post("search_studentid_fee_rpmt.php", { e: e }, function (a) {
        $("#search_feeRpmtStudentID_info").html(a);
      });
    }
  });

  //Search Student ID for Fee Write Off
  $("#txt_write_off_StudentIDSearch").keyup(function () {
    var e = $.trim($("#txt_write_off_StudentIDSearch").val());

    if (e == "") {
    } else {
      $.post("search_studentid_fee_write_off.php", { e: e }, function (a) {
        $("#search_write_off_StudentID_info").html(a);
      });
    }
  });

  //Fee Repayment Tab
  $("#rptmStudentFee-tab").click(() => {
    $("#gen_fee_rpmt_receiptid").load("get_receipt_id.php");
    $("#gen_fee_rpmt_receiptno").load("get_receipt_no.php");

    //Load all GL Account. Use active_bank_cash to load only assign GL's
    $("#gen_fee_rpmt_debit_acc").load("load_gl_accounts.php");
  });

  //Generate Transactio ID/No by Date - School fee Payment
  $("#gen_fee_rpmt_tdate").change(() => {
    let dt = $.trim($("#gen_fee_rpmt_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#gen_fee_rpmt_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#gen_fee_rpmt_receiptno").text(a);
    });
  });

  //Save Student Fee Payment
  $("#btn_run_gen_fee_rpmt").click(function () {
    let recid = $.trim($("#gen_fee_rpmt_receiptid").text());
    let recno = $.trim($("#gen_fee_rpmt_receiptno").text());
    let accid = $.trim($("#gen_fee_rpmt_debit_acc :selected").attr("id"));
    let accname = $.trim($("#gen_fee_rpmt_debit_acc").val());
    let dt = $.trim($("#gen_fee_rpmt_tdate").val());
    let desc = $.trim($("#gen_fee_rpmt_description").val());
    let stid = $.trim($("#lbl_feeRpmtStudentID").text());
    let amt = $.trim($("#gen_fee_rpmt_amt").val());

    if (stid == "") {
      alert("Missing Data: Student details");
      $("#txt_feeRpmtStudentIDSearch").focus();
      return false;
    } else if (amt <= 0 || amt == "") {
      alert("Missing Data: Amount");
      $("#gen_fee_rpmt_amt").focus();
      return false;
    } else if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#gen_fee_rpmt_tdate").focus();
      return false;
    } else if (recid == "" || recno == "") {
      alert("Missing Data: Receipt ID/No");
      return false;
    } else if (accname == "") {
      alert("Missing Data: Debit Account");
      $("#gen_fee_rpmt_debit_acc").focus();
      return false;
    } else if (desc == "") {
      alert("Missing Data: Description");
      $("#gen_fee_rpmt_description").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_gen_student_fee_rptm.php",
        {
          recid: recid,
          recno: recno,
          accid: accid,
          accname: accname,
          dt: dt,
          desc: desc,
          stid: stid,
          amt: amt,
        },
        function (a) {
          if (a == 1) {
            alert("Payment successfully saved");
            $(".ep").val("");
            $(".progress-loader").remove();
            $("#gen_fee_rpmt_receiptid").load("get_receipt_id.php");
            $("#gen_fee_rpmt_receiptno").load("get_receipt_no.php");
            $("#showStudentFinDetails").html("");
            $("#txt_feeRpmtStudentIDSearch").focus();

            $.post("insert_receipt_no.php", { e: recno }, () => {
              $.post("rpt_student_receipt.php", { e: recno }, function (em) {
                var newWindow = window.open(
                  "",
                  "rpt_student_receipt.php",
                  "scrollbars=1,width=1300, height=1000"
                );
                // window.print(e);
                //write the data to the document of the newWindow
                newWindow.document.body.innerHTML = em;
              });
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Transaction ID for Fee Reversal
  $("#btn_search_transid_rvs_fee").click(function () {
    $("#showFeeDetailsReverseTrans").html("");
    var e = $.trim($("#txt_feeReversalTransID").val());

    if (e == "") {
    } else {
      $.post("load_transid_reversal_info_tbl.php", { e: e }, function (a) {
        $("#showFeeDetailsTransReversal").html(a);
      });
    }
  });

  //Generate Transactio ID/No by Date - GL Transfer
  $("#gl_trf_tdate").change(() => {
    let dt = $.trim($("#gl_trf_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#trf_gl_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#trf_gl_receiptno").text(a);
    });
  });

  //Generate Transactio ID/No by Date - Petty Cash Transaction
  $("#pettycash_trf_tdate_acc").change(() => {
    let dt = $.trim($("#pettycash_trf_tdate_acc").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#trf_gl_receiptid_petty_acc").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#trf_gl_receiptno_petty_acc").text(a);
    });
  });

  //GL Transfer Button
  $("#genLedgerTrans-tab").click(() => {
    $("#trf_gl_receiptid").load("get_receipt_id.php");
    $("#trf_gl_receiptno").load("get_receipt_no.php");
    $("#sel_gl_trf_dr").load("load_sel_gl_account.php");
    $("#sel_gl_trf_cr").load("load_sel_gl_account.php");
  });

  //Cr Income Dr GL
  $("#CrIncomeDrGL-tab").click(() => {
    $("#txt_crincdrgl_receiptid").load("get_receipt_id.php");
    $("#txt_crincdrgl_receiptno").load("get_receipt_no.php");
    $("#sel_crincdrgl_dr").load("load_sel_gl_account.php");
    $("#sel_crincdrgl_cr").load("load_sel_pnl_account.php");
  });

  //Dr Income Cr GL
  $("#DrIncomeCrGL-tab").click(() => {
    $("#txt_drinccrgl_receiptid").load("get_receipt_id.php");
    $("#txt_drinccrgl_receiptno").load("get_receipt_no.php");
    $("#sel_drinccrgl_cr").load("load_sel_gl_account.php");
    $("#sel_drinccrgl_dr").load("load_sel_pnl_account.php");
  });

  //Dr Expense Cr GL
  $("#DrEpenseCrGL-tab").click(() => {
    $("#txt_drexpcrgl_receiptid").load("get_receipt_id.php");
    $("#txt_drexpcrgl_receiptno").load("get_receipt_no.php");
    $("#sel_drexpcrgl_cr").load("load_sel_gl_account.php");
    $("#sel_drexpcrgl_dr").load("load_sel_pnl_exp_account.php");
  });

  //Cr Expense Dr GL
  $("#CrExpenseDrGL-tab").click(() => {
    $("#txt_crexpdrgl_receiptid").load("get_receipt_id.php");
    $("#txt_crexpdrgl_receiptno").load("get_receipt_no.php");
    $("#sel_crexpdrgl_dr").load("load_sel_gl_account.php");
    $("#sel_crexpdrgl_cr").load("load_sel_pnl_exp_account.php");
  });

  //Save GL Transfer
  $("#btn_run_gl_trf").click(() => {
    let dr = $.trim($("#sel_gl_trf_dr :selected").attr("id"));
    let cr = $.trim($("#sel_gl_trf_cr :selected").attr("id"));
    let d = $.trim($("#sel_gl_trf_dr").val());
    let c = $.trim($("#sel_gl_trf_cr").val());
    let dt = $.trim($("#gl_trf_tdate").val());
    let recid = $.trim($("#trf_gl_receiptid").text());
    let recno = $.trim($("#trf_gl_receiptno").text());
    let amt = $.trim($("#gl_trf_amt").val());
    let dsc = $.trim($("#gl_trf_description").val());

    if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#gl_trf_tdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_gl_tranafer.php",
        {
          dr: dr,
          d: d,
          cr: cr,
          c: c,
          amt: amt,
          dt: dt,
          recid: recid,
          recno: recno,
          dsc: dsc,
        },
        function (a) {
          if (a == 1) {
            alert("Transaction saved successfully");
            $(".ep").val("");
            $(".ep").text("0.00");
            $("#sel_gl_trf_dr").load("load_sel_gl_account.php");
            $("#sel_gl_trf_cr").load("load_sel_gl_account.php");
            $("#sel_gl_trf_dr").load("load_sel_gl_account.php");
            $("#sel_gl_trf_cr").load("load_sel_gl_account.php");
            $(".progress-loader").remove();
            $("#sel_gl_trf_dr").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Load GL Balance - Debit Account
  $("#sel_gl_trf_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_gl_trf_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#trf_gl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load GL Balance - Credit Account
  $("#sel_gl_trf_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_gl_trf_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#trf_gl_cr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Save Cr Income Dr GL
  $("#btn_run_crincdrgl").click(() => {
    let dr = $.trim($("#sel_crincdrgl_dr :selected").attr("id"));
    let cr = $.trim($("#sel_crincdrgl_cr :selected").attr("id"));
    let d = $.trim($("#sel_crincdrgl_dr").val());
    let c = $.trim($("#sel_crincdrgl_cr").val());
    let dt = $.trim($("#txt_crincdrgl_tdate").val());
    let recid = $.trim($("#txt_crincdrgl_receiptid").text());
    let recno = $.trim($("#txt_crincdrgl_receiptno").text());
    let amt = $.trim($("#txt_crincdrgl_amt").val());
    let dsc = $.trim($("#txt_crincdrgl_description").val());

    if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#txt_crincdrgl_tdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_crincdrgl_transaction.php",
        {
          dr: dr,
          d: d,
          cr: cr,
          c: c,
          amt: amt,
          dt: dt,
          recid: recid,
          recno: recno,
          dsc: dsc,
        },
        function (a) {
          if (a == 1) {
            alert("Transaction saved successfully");
            $(".ep").val("");
            $("#sel_crincdrgl_dr").load("load_sel_gl_account.php");
            $("#sel_crincdrgl_cr").load("load_sel_pnl_account.php");
            $(".progress-loader").remove();
            $("#sel_gl_trf_dr").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Generate Transactio ID/No by Date - Cr Income Dr GL
  $("#txt_crincdrgl_tdate").change(() => {
    let dt = $.trim($("#txt_crincdrgl_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#txt_crincdrgl_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#txt_crincdrgl_receiptno").text(a);
    });
  });

  //Generate Transactio ID/No by Date - Dr Income Cr GL
  $("#txt_drinccrgl_tdate").change(() => {
    let dt = $.trim($("#txt_drinccrgl_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#txt_drinccrgl_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#txt_drinccrgl_receiptno").text(a);
    });
  });

  //Generate Transactio ID/No by Date - Dr Expenditure Cr GL
  $("#txt_drexpcrgl_tdate").change(() => {
    let dt = $.trim($("#txt_drexpcrgl_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#txt_drexpcrgl_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#txt_drexpcrgl_receiptno").text(a);
    });
  });

  //Generate Transactio ID/No by Date - Dr Expenditure Cr GL
  $("#txt_crexpdrgl_tdate").change(() => {
    let dt = $.trim($("#txt_crexpdrgl_tdate").val());

    //Transaction ID
    $.post("get_receipt_id_date.php", { dt }, function (a) {
      $("#txt_crexpdrgl_receiptid").text(a);
    });

    //Transaction No
    $.post("get_receipt_no_date.php", { dt }, function (a) {
      $("#txt_crexpdrgl_receiptno").text(a);
    });
  });

  //Save Dr Income Cr GL
  $("#btn_run_drinccrgl").click(() => {
    let dr = $.trim($("#sel_drinccrgl_dr :selected").attr("id"));
    let cr = $.trim($("#sel_drinccrgl_cr :selected").attr("id"));
    let d = $.trim($("#sel_drinccrgl_dr").val());
    let c = $.trim($("#sel_drinccrgl_cr").val());
    let dt = $.trim($("#txt_drinccrgl_tdate").val());
    let recid = $.trim($("#txt_drinccrgl_receiptid").text());
    let recno = $.trim($("#txt_drinccrgl_receiptno").text());
    let amt = $.trim($("#txt_drinccrgl_amt").val());
    let dsc = $.trim($("#txt_drinccrgl_description").val());

    if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#txt_drinccrgl_tdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_drinccrgl_transaction.php",
        {
          dr: dr,
          d: d,
          cr: cr,
          c: c,
          amt: amt,
          dt: dt,
          recid: recid,
          recno: recno,
          dsc: dsc,
        },
        function (a) {
          if (a == 1) {
            alert("Transaction saved successfully");
            $(".ep").val("");
            $("#sel_drinccrgl_dr").load("load_sel_pnl_account.php");
            $("#sel_drinccrgl_cr").load("load_sel_gl_account.php");
            $(".progress-loader").remove();
            $("#sel_gl_trf_dr").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Save Dr Expense Cr GL
  $("#btn_run_drexpcrgl").click(() => {
    let dr = $.trim($("#sel_drexpcrgl_dr :selected").attr("id"));
    let cr = $.trim($("#sel_drexpcrgl_cr :selected").attr("id"));
    let d = $.trim($("#sel_drexpcrgl_dr").val());
    let c = $.trim($("#sel_drexpcrgl_cr").val());
    let dt = $.trim($("#txt_drexpcrgl_tdate").val());
    let recid = $.trim($("#txt_drexpcrgl_receiptid").text());
    let recno = $.trim($("#txt_drexpcrgl_receiptno").text());
    let amt = $.trim($("#txt_drexpcrgl_amt").val());
    let dsc = $.trim($("#txt_drexpcrgl_description").val());

    if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#txt_drexpcrgl_tdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_drexpcrgl_transaction.php",
        {
          dr: dr,
          d: d,
          cr: cr,
          c: c,
          amt: amt,
          dt: dt,
          recid: recid,
          recno: recno,
          dsc: dsc,
        },
        function (a) {
          if (a == 1) {
            alert("Transaction saved successfully");
            $(".ep").val("");
            $("#sel_drexpcrgl_cr").load("load_sel_gl_account.php");
            $("#sel_drexpcrgl_dr").load("load_sel_pnl_exp_account.php");
            $(".progress-loader").remove();
            $("#sel_gl_trf_dr").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Save Cr Expense Dr GL
  $("#btn_run_crexpdrgl").click(() => {
    let dr = $.trim($("#sel_crexpdrgl_dr :selected").attr("id"));
    let cr = $.trim($("#sel_crexpdrgl_cr :selected").attr("id"));
    let d = $.trim($("#sel_crexpdrgl_dr").val());
    let c = $.trim($("#sel_crexpdrgl_cr").val());
    let dt = $.trim($("#txt_crexpdrgl_tdate").val());
    let recid = $.trim($("#txt_crexpdrgl_receiptid").text());
    let recno = $.trim($("#txt_crexpdrgl_receiptno").text());
    let amt = $.trim($("#txt_crexpdrgl_amt").val());
    let dsc = $.trim($("#txt_crexpdrgl_description").val());

    if (dt == "") {
      alert("Missing Data: Transaction Date");
      $("#txt_crincdrgl_tdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_crexpdrgl_transaction.php",
        {
          dr: dr,
          d: d,
          cr: cr,
          c: c,
          amt: amt,
          dt: dt,
          recid: recid,
          recno: recno,
          dsc: dsc,
        },
        function (a) {
          if (a == 1) {
            alert("Transaction saved successfully");
            $(".ep").val("");
            $("#sel_crexpdrgl_dr").load("load_sel_gl_account.php");
            $("#sel_crexpdrgl_cr").load("load_sel_pnl_exp_account.php");
            $(".progress-loader").remove();
            $("#crexpdrgl_dr_balance").text("0.00");
            $("#crexpdrgl_cr_balance").text("0.00");
            $("#sel_crexpdrgl_dr").focus();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Unlock User Password
  $("#btn-unlockuserpassword").click(function () {
    let ID = $.trim($("#unlockPasssword_UserID").text());
    let NP = $.trim($("#txt_unlockNewPassword").val());
    let CP = $.trim($("#txt_unlockConfirmPassword").val());

    if (ID == "") {
      alert("Missing Data: User Name");
      $("#search_Username_PassswdChng").focus();
      return false;
    } else if (NP == "") {
      alert("Missing Data: New Password");
      $("#txt_unlockNewPassword").focus();
      return false;
    } else if (CP == "") {
      alert("Missing Data: Confirm Password");
      $("#txt_unlockConfirmPassword").focus();
      return false;
    } else if (CP !== NP) {
      alert("Passwords do not match");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("update_user_password.php", { id: ID, np: NP, cp: CP }, (a) => {
        if (a == 1) {
          alert("Password update successfully");
          $(".ep").val("");
          $(".ep").text("");
          $(".progress-loader").remove();
          return false;
        } else {
          alert(a);
          $(".progress-loader").remove();
          return false;
        }
      });
    }
  });

  //Student statement report
  $("#btn-rpt-StdStttmnt").click(function () {
    var id = $.trim($("#lbl_stdSttmntID").text());
    var fdt = $.trim($("#rptStdStttmnt_fDate").val());
    var ldt = $.trim($("#rptStdStttmnt_lDate").val());
    let fn = $.trim($("#rpt_search_stdID_sttmnt").val());

    if (id == "") {
      alert("Missing Data: Student ID");
      $("#rpt_search_stdID_sttmnt").focus();
      $("#rpt_search_stdID_sttmnt").focus();
      return false;
    } else if (fn == "") {
      alert("Search Student's Name/ Student ID");
    } else if (fdt == "") {
      alert("Missing Data: First Date");
      $("#rptStdStttmnt_fDate").focus();
      return false;
    } else if (ldt == "") {
      alert("Missing Data: Last Date");
      $("#rptStdStttmnt_lDate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: ldt },
        function (a) {
          if (a == 1) {
            // window.open("","rpt_student_statement.php","");
            $.post("rpt_student_statement.php", {}, function (ansa) {
              var newWindow = window.open(
                "",
                "rpt_student_statement.php",
                "scrollbars=1,width=1400, height=900"
              );
              //write the data to the document of the newWindow
              newWindow.document.body.innerHTML = ansa;
            });
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //G.L statement report
  $("#btn-rpt-glsttment").click(function () {
    var id = $.trim($("#glsttment_ledgerid :selected").attr("id"));
    var nm = $.trim($("#glsttment_ledgerid").val());
    var fdt = $.trim($("#glsttment_fdate").val());
    var ldt = $.trim($("#glsttment_ldate").val());

    if (nm == "") {
      alert("Missing Data: General Ledger ID");
      $("#glsttment_ledgerid").focus();
      return false;
    } else if (fdt == "") {
      alert("Missing Data: First Date");
      $("#glsttment_fdate").focus();
      return false;
    } else if (ldt == "") {
      alert("Missing Data: Lastss Date");
      $("#glsttment_ldate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: ldt },
        function (a) {
          if (a == 1) {
            $(".progress-loader").remove();
            // window.open("","rpt_student_statement.php","");
            $.post("rpt_gl_statement.php", {}, function (ansa) {
              var newWindow = window.open(
                "",
                "rpt_gl_statement.php",
                "scrollbars=1,width=1400, height=900"
              );
              //write the data to the document of the newWindow
              newWindow.document.body.innerHTML = ansa;
              $(".progress-loader").remove();
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Journla Entries report
  $("#btn-rpt-glEntries").click(function () {
    //var id = $.trim($('#lbl_stdSttmntID').text());
    var fdt = $.trim($("#rpt-glEntries-fdate").val());
    var ldt = $.trim($("#rpt-glEntries-ldate").val());
    let id = "1";

    if (fdt == "") {
      alert("Missing Data: First Date");
      $("#rpt-glEntries-fdate").focus();
      return false;
    } else if (ldt == "") {
      alert("Missing Data: Last Date");
      $("#rpt-glEntries-ldate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: ldt },
        function (a) {
          if (a == 1) {
            // window.open("","rpt_student_statement.php","");
            $.post("rpt_journal_entries_general.php", {}, function (ansa) {
              var newWindow = window.open(
                "",
                "rpt_journal_entries_general.php",
                "scrollbars=1,width=1400, height=900"
              );
              //write the data to the document of the newWindow
              newWindow.document.body.innerHTML = ansa;
              $(".progress-loader").remove();
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Journla Entries report by receipt id
  $("#btn-rpt-glEntries-id").click(function () {
    var id = $.trim($("#glEntries-rccptID").val());
    var fdt = $.trim($("#rpt-glEntries-fdate").val());
    var ldt = $.trim($("#rpt-glEntries-ldate").val());

    if (id == "") {
      alert("Missing Data: Receipt ID");
      $("#glEntries-rccptID").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: ldt },
        function (a) {
          if (a == 1) {
            $(".progress-loader").remove();
            // window.open("","rpt_student_statement.php","");
            $.post(
              "rpt_journal_entries_reeceipt_no.php",
              { sid: id },
              function (ansa) {
                var newWindow = window.open(
                  "",
                  "rpt_journal_entries_reeceipt_no.php",
                  "scrollbars=1,width=1400, height=900"
                );
                //write the data to the document of the newWindow
                newWindow.document.body.innerHTML = ansa;
              }
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //CLicked on Other Report Tab
  $("#OtherRpt-tab").click(function () {
    $("#glsttment_ledgerid").load("load_gl_accounts_all.php");
  });

  //Select billing details for new student registration
  $(".optradio-stdbill").change(function () {
    let v = $.trim($(this).attr("id"));
    let cid = $.trim($("#newStdProgram :selected").attr("id"));
    let cnm = $.trim($("#newStdProgram").val());

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    if (v === "yes") {
      if (cnm == "") {
        alert("Missing Data: Select course");
        $("#no").prop("checked", "checked");
        $(".progress-loader").remove();
        $("#newstd_reg_bill_receiptid").load("get_receipt_id.php");
        $("#newstd_reg_bill_receiptno").load("get_receipt_no.php");
        $("#newStdProgram").focus();
        return false;
      } else {
        $.post("load_admission_map_tbl_0.php", { classid: cid }, function (em) {
          $("#newstudent_billdetails").html(em);
          $("#newstd_reg_bill_receiptid").load("get_receipt_id.php");
          $("#newstd_reg_bill_receiptno").load("get_receipt_no.php");
          $(".progress-loader").remove();
        });
      }
    } else {
      $("#newstudent_billdetails").html("");
      $(".progress-loader").remove();
      return false;
    }
  });

  $("#btn-end-new-calender").click(function () {
    let q = confirm("End Academic Term?");

    if (q) {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_end_academic_term.php", {}, function (e) {
        if (e == 1) {
          $.post("check_academic_coupon.php", {}, function (a) {
            $("#txt-academic-coupon-stats").html(a);
          });
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    } else {
      return false;
    }
  });

  //Start New Academic Term Tab
  $("#tab-newAcademicTerm").click(function () {
    $.post("check_academic_coupon.php", {}, function (a) {
      $("#txt-academic-coupon-stats").html(a);
    });
  });

  //Activate GL Tab
  $("#newActivateGL-tab").click(function () {
    $("#sel_SetActivePnL").load("load_gl_accounts_all.php");
    $("#sel_SetActiveUnPaidFee").load("load_gl_accounts_all.php");
    $("#txt_SetActivePnL").load("load_active_pnl_account_1.php");
    $("#sel_SetActiveMoMo").load("load_gl_accounts_all.php");
    $("#txt_SetActiveMoMo").load("load_active_momo_account.php");
    $("#txt_SetActiveUnPaidFee").load("load_active_unpaid_fee.php");
    $("#sel_SetActiveFeeHeld").load("load_gl_accounts_all.php");
    $("#txt_SetActiveFeeHeld").load("load_active_fees_held_suspense.php");
    $("#sel_SetActiveActiveWriteOff").load("load_gl_accounts_all_exp.php");
    $("#txt_SetActiveWriteOff").load("load_active_fees_write_off.php");
    $("#sel_SetActivePettyCash").load("load_gl_accounts_all.php");
    $("#txt_SetActivePettyCash").load("load_active_petty_cash_1.php");
    $("#sel_SetActiveFeeHeld").load("load_gl_accounts_all.php");
    $("#txt_SetActiveFeeRcvbl").load("load_active_fees_receivables.php");
    $("#sel_SetActiveFeeRcvbl").load("load_gl_accounts_all.php");
  });

  //Set Active Fee Write Off
  $("#btn-SetActiveActiveWriteOff").click(function () {
    let id = $.trim($("#sel_SetActiveActiveWriteOff :selected").attr("id"));
    let nm = $.trim($("#sel_SetActiveActiveWriteOff").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActiveActiveWriteOff").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_set_active_fee_write_off.php",
        { id: id, nm: nm },
        function (e) {
          if (e == 1) {
            $("#txt_SetActiveWriteOff").load("load_active_fees_write_off.php");
            $(".progress-loader").remove();
          } else {
            alert(e);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Set Active Petty Cash
  $("#btn-SetActivePettyCash").click(function () {
    let id = $.trim($("#sel_SetActivePettyCash :selected").attr("id"));
    let nm = $.trim($("#sel_SetActivePettyCash").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActivePettyCash").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_set_active_petty.php", { id: id, nm: nm }, function (e) {
        if (e == 1) {
          $("#txt_SetActivePettyCash").load("load_active_petty_cash.php");
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Set Active PNL
  $("#btn-SetActivePnL").click(function () {
    let id = $.trim($("#sel_SetActivePnL :selected").attr("id"));
    let nm = $.trim($("#sel_SetActivePnL").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActivePnL").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_set_active_pnl.php", { id: id, nm: nm }, function (e) {
        if (e == 1) {
          $("#txt_SetActivePnL").load("load_active_pnl_account_1.php");
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Set Active Unpaid Fee
  $("#btn-SetActiveUnPaidFee").click(function () {
    let id = $.trim($("#sel_SetActiveUnPaidFee :selected").attr("id"));
    let nm = $.trim($("#sel_SetActiveUnPaidFee").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActiveUnPaidFee").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_set_active_unpaid_fee.php", { id: id, nm: nm }, function (e) {
        if (e == 1) {
          $("#txt_SetActiveUnPaidFee").load("load_active_unpaid_fee.php");
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Set Active Fee Held in suspense
  $("#btn-SetActiveFeeHeld").click(function () {
    let id = $.trim($("#sel_SetActiveFeeHeld :selected").attr("id"));
    let nm = $.trim($("#sel_SetActiveFeeHeld").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActiveFeeHeld").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_set_active_fee_held.php", { id: id, nm: nm }, function (e) {
        if (e == 1) {
          $("#txt_SetActiveFeeHeld").load("load_active_fees_held_suspense.php");
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  $("#loading").hide();
  $("#loading0").hide();

  //Check for Active Date
  $("#b_active_date").load("load_my_active_date.php");
  setInterval(function () {
    $("#b_active_date").load("load_my_active_date.php");
  }, 15000);

  //Fee Outstanding report by Age nanlysis
  $("#btn-rpt-age-analysis-fee-outsstanding").click(function () {
    var id = $.trim($("#glEntries-rccptID").val());
    var fdt = $.trim($("#feeout_ageanalysis_fdate").val());
    var ldt = $.trim($("#rpt-glEntries-ldate").val());

    if (fdt == "") {
      alert("Missing Data: Report Date");
      $("#feeout_ageanalysis_fdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: fdt },
        function (a) {
          if (a == 1) {
            $(".progress-loader").remove();
            // window.open("","rpt_student_statement.php","");
            $.post(
              "rpt_fee_outstanding_age_analysis.php",
              { sid: id },
              function (ansa) {
                var newWindow = window.open(
                  "",
                  "rpt_fee_outstanding_age_analysis.php",
                  "scrollbars=1,width=1400, height=900"
                );
                //write the data to the document of the newWindow
                newWindow.document.body.innerHTML = ansa;
                newWindow.opener = null;
                $(".progress-loader").remove();
              }
            );
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Fee Outstanding report
  $("#btn-rpt-fee-outstanding").click(function () {
    var id = $.trim($("#glEntries-rccptID").val());
    var fdt = $.trim($("#feeout_rpt_fdate").val());
    var ldt = $.trim($("#rpt-glEntries-ldate").val());

    if (fdt == "") {
      alert("Missing Data: Report Date");
      $("#feeout_rpt_fdate").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_date.php",
        { sid: id, fdt: fdt, ldt: fdt },
        function (a) {
          if (a == 1) {
            // window.open("","rpt_student_statement.php","");
            $.post("rpt_fee_outstanding.php", { sid: id }, function (ansa) {
              var newWindow = window.open(
                "",
                "rpt_fee_outstanding.php",
                "scrollbars=1,width=1400, height=900"
              );
              //write the data to the document of the newWindow
              newWindow.document.body.innerHTML = ansa;
              newWindow.opener = null;
              $(".progress-loader").remove();
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Student Name for record edit
  $("#ediStScore_search_StdName").keyup(function () {
    var e = $.trim($("#ediStScore_search_StdName").val());
    var cid = $.trim($("#editScore_StudentClass_tch :selected").attr("id"));
    var cn = $.trim($("#editScore_StudentClass_tch").val());
    var sid = $.trim($("#editScore_SelSubject_tch :selected").attr("id"));
    var sn = $.trim($("#editScore_SelSubject_tch").val());
    var tid = $.trim($("#editScore_SelTestType_tch :selected").attr("id"));
    var tn = $.trim($("#editScore_SelTestType_tch").val());

    if (e == "") {
      return false;
    } else if (tn == "" || tn == "...") {
      alert("Select Test");
    } else if (cn == "" || cn === "...") {
      alert("Select Class");
      return false;
    } else if (sn == "" || sn == "...") {
      alert("Select Subject");
      return false;
    } else {
      $.post(
        "search_student_editrecords.php",
        { e: e, cid: cid, sid: sid, tid: tid },
        function (a) {
          $("#search_StdID_editRecords").html(a);
        }
      );
    }
  });

  //Search Student Name for adding students to test list
  $("#addScore_search_StdName").keyup(function () {
    var e = $.trim($("#addScore_search_StdName").val());
    var cid = $.trim($("#recScore_Student_tch :selected").attr("id"));
    var cn = $.trim($("#recScore_Student_tch").val());
    var sid = $.trim($("#recScore_SelSubject_tch :selected").attr("id"));
    var sn = $.trim($("#recScore_SelSubject_tch").val());
    var tid = $.trim($("#recScore_SelTestType_tch :selected").attr("id"));
    var tn = $.trim($("#recScore_SelTestType_tch").val());

    if (e == "") {
      return false;
    } else if (tn == "" || tn == "...") {
      alert("Select Test");
      $("#recScore_SelTestType_tch").focus();
      return false;
    } else if (cn == "" || cn === "...") {
      alert("Select Class");
      $("#recScore_Student_tch").focus();
      return false;
    } else if (sn == "" || sn == "...") {
      alert("Select Subject");
      $("#recScore_SelSubject_tch").focus();
      return false;
    } else {
      $.post(
        "search_student_addrecords.php",
        { e: e, cid: cid, sid: sid, tid: tid },
        function (a) {
          $("#search_StdID_addRecords").html(a);
        }
      );
    }
  });

  //Search Student Name for adding students to test list
  $("#addRemarks_search_StdName").keyup(function () {
    var e = $.trim($("#addRemarks_search_StdName").val());
    var cid = $.trim($("#recRemarks_Student_tch :selected").attr("id"));
    var cn = $.trim($("#recRemarks_Student_tch").val());
    var sid = $.trim($("#recRemarks_SelSubject_tch :selected").attr("id"));
    var sn = $.trim($("#recRemarks_SelSubject_tch").val());
    var tid = $.trim($("#recRemarks_SelTestType_tch :selected").attr("id"));
    var tn = $.trim($("#recRemarks_SelTestType_tch").val());

    if (e == "") {
      return false;
    } else if (cn == "" || cn === "...") {
      alert("Select Class");
      $("#recRemarks_Student_tch").focus();
      return false;
    } else if (tn == "" || tn == "...") {
      alert("Select Academic Term");
      $("#recRemarks_SelTestType_tch").focus();
      return false;
    } else {
      $.post(
        "search_student_addremarks.php",
        { e: e, cid: cid, tid: tid },
        function (a) {
          $("#search_StdID_addRemarks").html(a);
        }
      );
    }
  });

  //Reset student record test scores - Teacher interface
  $("#btn-reset-student_test_score_tch").click(function () {
    q = confirm("Reset list?");

    if (q) {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "reset_marking_list_student_test_scores_tch.php",
        {},
        function (e) {
          if (e == 1) {
            $("#temp_student_recTestScore_tch").load(
              "load_temp_student_recTestScore.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(e);
            $(".progress-loader").remove();
            return false;
          }
        }
      );
    } else {
      return false;
    }
  });

  //View student test record at the notification
  $("#check-envlp-notification").click(function () {
    $("#tbl_student_test_record_display").load(
      "load_student_test_record_notif.php"
    );
  });

  //Set Active PNL
  $("#btn-SetActiveMoMo").click(function () {
    let id = $.trim($("#sel_SetActiveMoMo :selected").attr("id"));
    let nm = $.trim($("#sel_SetActiveMoMo").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActiveMoMo").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("run_set_active_momo.php", { id: id, nm: nm }, function (e) {
        if (e == 1) {
          $("#txt_SetActiveMoMo").load("load_active_momo_account.php");
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Load Sub Class Students for promotion
  $("#tab_std_promo_gen").click(function () {
    $("#sel_student_promo_subclass").load(
      "load_sel_gen_std_promo_subclass.php"
    );
    $("#sel_student_promo_subclass_empty").load(
      "load_sel_empty_std_promo_subclass.php"
    );
  });

  //Load selected class for promotion
  $("#btn_load_sel_class_promotion").click(function () {
    let cid = $.trim($("#sel_student_promo_subclass :selected").attr("id"));
    let cnm = $.trim($("#sel_student_promo_subclass").val());

    if (cnm == "") {
      alert("Select class first");
      $("#sel_student_promo_subclass").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "add_temp_sel_class_promotion.php",
        { cid: cid, cnm: cnm },
        function (a) {
          $("#").html("load_sel_class_promotion_temp.php");
        }
      );
      $(".progress-loader").remove();
    }
  });

  $("#tab-AcademicSttmntRpt").click(function () {
    $("#rptmarkTest_SelAcademic").load("load_active_calenda_sel.php");
    $("#rptTerminal_SelClass_tch").load("load_sel_class_form_master.php");
    $("#rptTerminal_SelAcademic").load("load_active_calender_all.php");
    $("#rptmarkTest_SelAcademic_det_tch").load("load_active_calenda_sel.php");
    $("#rptmarkTest_SelClass_det_tch").load("load_sel_class_recSubj_tch.php");
  });

  $("#btn-TermlyRpt_Admin").click(function () {
    $("#rptTerminal_SelAcademic").load("load_active_calender_all.php");
    $("#rptTerminal_SelClass").load("load_staff_class_map.php");
    $("#rptTerminal_SelAcademic_main").load("load_active_calender_all.php");
    $("#rptTerminal_SelClass_main").load("load_staff_class_map.php");
  });

  $("#btn-GLTransaction_acc").click(function () {
    $("#pettycash_trf_tdate_acc").load("load_active_date.php");
    $("#sel_pettycash_trf_cr").load("load_active_petty_cash.php");
    $("#trf_gl_receiptid_petty_acc").load("get_receipt_id.php");
    $("#trf_gl_receiptno_petty_acc").load("get_receipt_no.php");
    $("#sel_gl_trf_dr_petty_acc").load("load_sel_gl_account.php");
  });

  //Load GL Balance - Debit Account
  $("#sel_gl_trf_dr_petty_acc").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_gl_trf_dr_petty_acc :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#trf_gl_dr_balance_petty_acc").text(a);
      $(".progress-loader").remove();
    });
  });

  //Load Petty Cash Balance - Debit Account
  $("#sel_pettycash_trf_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_pettycash_trf_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#trf_gl_cr_balance_petty_acc").text(a);
      $(".progress-loader").remove();
    });
  });

  $("#rptmarkTest_SelAcademic").change(function () {
    let cpn = $("#rptmarkTest_SelAcademic :selected").attr("id");
    let title = $("#rptmarkTest_SelAcademic").val();

    if (title == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_receipt_no.php", { e: cpn }, function (e) {
        if (e == 1) {
          $("#rptmarkTest_SelSubject").load(
            "load_academic_test_type_0_tch.php"
          );
          $(".progress-loader").remove();
        } else {
          alert(e);
          $(".progress-loader").remove();
        }
      });
    }
  });

  //Marked subject report for Teachers
  $("#btn-rpt-subj-marked-testType_tch").click(function () {
    var cpn = $.trim($("#rptmarkTest_SelAcademic :selected").attr("id"));
    var cp = $.trim($("#rptmarkTest_SelAcademic").val());
    var tid = $.trim($("#rptmarkTest_SelSubject :selected").attr("id"));
    var test = $.trim($("#rptmarkTest_SelSubject").val());

    if (cp == "") {
      alert("Select Academic Term");
      $("#rptmarkTest_SelAcademic").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_val_rpt.php", { cid: cpn, sid: tid }, function () {
        window.open("rpt_general_subject_report_by_test_tch.php", "_blank");
        $(".progress-loader").remove();
      });
    }
  });

  //View detail report for test marked - Teacher
  $("#btn-rpt-subj-marked-testType_det_tch").click(function () {
    var cpn = $.trim($("#rptmarkTest_SelAcademic :selected").attr("id"));
    var cp = $.trim($("#rptmarkTest_SelAcademic").val());
    var cid = $.trim($("#rptmarkTest_SelClass_det_tch :selected").attr("id"));
    var cnm = $.trim($("#rptmarkTest_SelClass_det_tch").val());
    var sbid = $.trim(
      $("#rptmarkTest_SelSubject_det_tch :selected").attr("id")
    );
    var sbnm = $.trim($("#rptmarkTest_SelSubject_det_tch").val());

    if (cp == "") {
      alert("Select Academic Term");
      $("#rptmarkTest_SelAcademic").focus();
      return false;
    } else if (cnm == "") {
      alert("Select Class");
      return false;
    } else if (sbnm == "") {
      alert("Select Subject");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "insert_multi_val_rpt.php",
        { ldt: cpn, cid: cid, sid: sbid, cnm: cnm, sbnm: sbnm, dt: cp },
        function () {
          window.open("rpt_details_test_subject_tch.php", "_blank");
          $(".progress-loader").remove();
        }
      );
    }
  });

  //Makred subject report for Admin
  $("#btn-rpt-subj-marked-testType").click(function () {
    var cpn = $.trim($("#rptmarkTest_SelAcademic :selected").attr("id"));
    var cp = $.trim($("#rptmarkTest_SelAcademic").val());
    var tid = $.trim($("#rptmarkTest_SelSubject :selected").attr("id"));
    var test = $.trim($("#rptmarkTest_SelSubject").val());

    if (cp == "") {
      alert("Select Academic Term");
      $("#rptmarkTest_SelAcademic").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_multi_val_rpt.php", { cid: cpn, sid: tid }, function () {
        window.open("rpt_general_subject_report_by_test.php", "_blank");
        $(".progress-loader").remove();
      });
    }
  });

  //$('#momopmt_debits').prepend("<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>");

  $("#fpmt_studentid").keyup(function () {
    $("#alert1").fadeOut();
  });

  $("#fpmt_studentid").blur(function () {
    let sid = $.trim($("#fpmt_studentid").val());

    if (sid == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.getJSON("api/post/read_single.php", { id: sid }, function (response) {
        // console.log(response);
        if (response.data.length) {
          $.each(response.data, function (i, data) {
            if (data.status == "404") {
              $(".progress-loader").remove();
              $(".fmpt-txt").val("");
              $("#alert1").fadeIn("600");
            } else {
              $(".progress-loader").remove();

              $("#fpmt_FllName").val(data.FullName);
              $("#fpmt_studentid").val(data.StudentID);
              $("#fpmt_Class").val(data.ClassName);
              $("#fpmt_Balance").val(data.Fee_Outstanding);

              $.post("get_momo_foreign_id.php", { e: sid }, function (id) {
                $("#fpmt_TransID").val(id);
              });
            }
          });
        }
      });
    }
  });

  //Process Studnet online payment with flexiPa
  $("#fmpt_ConfirmTrans").click(function () {
    let sid = $.trim($("#fpmt_studentid").val());
    let fn = $.trim($("#fpmt_FllName").val());
    let cid = $.trim($("#fpmt_Class").val());
    let serviceCode = "mm";
    let provider = $.trim($("#fpmt_Provider :selected").attr("id"));
    let ProviderName = $.trim($("#fpmt_Provider").val());
    let Xmode = "debit";
    let ForeignID = $.trim($("#fpmt_TransID").val());
    let txtDevice = $.trim($("#fpmt_PhoneNo").val());
    let txtAmount = $.trim($("#fpmt_Amount").val());
    let txtVCode = $.trim($("#fpmt_Provider :selected").attr("txtvcode"));

    if (sid == "") {
      $("#alert1").html("Missing Data: Student ID").show();
      $("#fpmt_studentid").focus();
      return false;
    } else if (ProviderName == "") {
      $("#alert1").html("Missing Data: Select Provider").show();
      $("#fpmt_Provider").focus();
      return false;
    } else if (txtDevice == "") {
      $("#alert1").html("Missing Data: Enter Telephone Number").show();
      $("#fpmt_PhoneNo").focus();
      return false;
    } else if (txtAmount <= 0) {
      $("#alert1").html("Missing Data: Enter Amount").show();
      $("#fpmt_Amount").focus();
      return false;
    } else if (ForeignID == "") {
      $("#alert1").html("Missing Data: Invalid Foreign ID").show();
      $("#fpmt_studentid").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      /**$.post(' https://myflexipay.com/ext/',{serviceCode:serviceCode,provider:provider,xmode:Xmode,txtDevice:txtDevice,txtAmount:txtAmount,txtVcode:txtVCode},function(res){
                      console.log(res);
                      if(res.status=='success'){
                          $('.progress-loader').remove();
                          $('#alert1').html('We saved data successful').show();
                      }else if(res.status =='Forbidden'){
                          $('.progress-loader').remove();
                          $('#alert1').html(res.status+" : "+res.message).show();
                      }
                  });*/

      axios
        .post("https://myflexipay.com/ext/", {
          userID: "10000005",
          userToken: "3f3a4f609546d45913b32b957508450dg",
          serviceCode: serviceCode,
          provider: provider,
          xmode: Xmode,
          txtDevice: txtDevice,
          txtAmount: txtAmount,
          txtVcode: txtVCode,
          foreignID: ForeignID,
        })
        .then(function (response) {
          console.log(response.data);
          $(".progress-loader").remove();
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  });

  //Load active date for student transaction at the accountant interface
  $("#btn-studentTrans-accnt").click(function () {
    $("#gen_class_bill_tdate_lbl").load("load_active_date.php");
    $("#gen_ind_std_tdate").load("load_active_date.php");
    $("#gen_fee_rpmt_tdate").load("load_active_date.php");
  });

  //Save General Class Billing - Accountant
  $("#btn_run_gen_std_billing-acct").click(function () {
    let q = confirm("Process Student Bill?");

    if (q) {
      let note = $.trim($("#gen_class_bill_note").val());
      let desc = $.trim($("#gen_class_bill_description").val());
      let recid = $.trim($("#gen_class_bill_receiptid").text());
      let recno = $.trim($("#gen_class_bill_receiptno").text());
      let dt = $.trim($("#gen_class_bill_tdate_lbl").text());
      let startdt = $.trim($("#gen_class_bill_pmtStartdate").val());
      let cls = $.trim($("#sel_gen_bill_class :selected").attr("id"));
      let cnm = $.trim($("#sel_gen_bill_class").val());

      if (cnm == "") {
        alert("Missing Data: Select Class");
        $("#sel_gen_bill_class").focus();
        return false;
      } else if (dt == "") {
        alert("Missing Data: Select Transaction Date");
        $("#gen_class_bill_tdate").focus();
        return false;
      } else if (startdt == "") {
        alert("Missing Data: Select Payment Start Date");
        $("#gen_class_bill_description").focus();
        return false;
      } else if (desc == "") {
        alert("Missing Data: Transaction Description");
        $("#gen_class_bill_description").focus();
        return false;
      } else if (recid == "" || recno == "") {
        alert("Missing Data: Receipt ID/No");
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_gen_class_bill_acc.php",
          {
            cnm: cnm,
            cls: cls,
            sttdt: startdt,
            note: note,
            desc: desc,
            recid: recid,
            recno: recno,
            dt: dt,
          },
          function (a) {
            if (a == 1) {
              $(".progress-loader").remove();
              alert("Student's accounts billed successfully");
              $(".ep").val("");
              $("#sel_gen_bill_class").load("load_staff_class_map.php");
              $("#gen_class_bill_receiptid").load("get_receipt_id.php");
              $("#gen_class_bill_receiptno").load("get_receipt_no.php");
              $("#display_gen_student_billing_class").load(
                "load_temp_general_class_billing.php"
              );
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  //Save Individual Student Billing
  $("#btn_run_ind_std_billing_acc").click(() => {
    let q = confirm("Proceed with account billing?");

    if (q) {
      let dt = $.trim($("#gen_ind_std_tdate").text());
      let pmtdt = $.trim($("#gen_ind_std_pmtdate").val());
      let recid = $.trim($("#gen_ind_std_receiptid").text());
      let recno = $.trim($("#gen_ind_std_receiptno").text());
      let des = $.trim($("#gen_ind_std_description").val());
      let note = $.trim($("#gen_ind_std_note").val());

      if (dt == "") {
        alert("Select Transaction Date");
        $("#gen_ind_std_tdate").focus();
        return false;
      } else if (pmtdt == "") {
        alert("Select Payment Start Date");
        $("#gen_ind_std_pmtdate").focus();
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_individal_std_bill_acc.php",
          {
            pmtdt: pmtdt,
            dt: dt,
            recid: recid,
            recno: recno,
            desc: des,
            note: note,
          },
          function (a) {
            if (a == 1) {
              $(".progress-loader").remove();
              $(".ep").val("");
              $("#gen_ind_std_receiptid").load("get_receipt_id.php");
              $("#gen_ind_std_receiptno").load("get_receipt_no.php");
              $("#temp_ind_std_bill_view").html("");
              alert("Billing saved successfully");
              $("#ind_bill_std_search").focus();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  //Save Student Fee Payment - Accountant
  $("#btn_run_gen_fee_rpmt_acc").click(function () {
    let q = confirm("Save Fee Repayment");

    if (q) {
      let recid = $.trim($("#gen_fee_rpmt_receiptid").text());
      let recno = $.trim($("#gen_fee_rpmt_receiptno").text());
      let accid = $.trim($("#gen_fee_rpmt_debit_acc :selected").attr("id"));
      let accname = $.trim($("#gen_fee_rpmt_debit_acc").val());
      let dt = $.trim($("#gen_fee_rpmt_tdate").text());
      let desc = $.trim($("#gen_fee_rpmt_description").val());
      let stid = $.trim($("#lbl_feeRpmtStudentID").text());
      let amt = $.trim($("#gen_fee_rpmt_amt").val());

      if (stid == "") {
        alert("Missing Data: Student details");
        $("#txt_feeRpmtStudentIDSearch").focus();
        return false;
      } else if (amt <= 0 || amt == "") {
        alert("Missing Data: Amount");
        $("#gen_fee_rpmt_amt").focus();
        return false;
      } else if (dt == "") {
        alert("Missing Data: Transaction Date");
        $("#gen_fee_rpmt_tdate").focus();
        return false;
      } else if (recid == "" || recno == "") {
        alert("Missing Data: Receipt ID/No");
        return false;
      } else if (accname == "") {
        alert("Missing Data: Debit Account");
        $("#gen_fee_rpmt_debit_acc").focus();
        return false;
      } else if (desc == "") {
        alert("Missing Data: Description");
        $("#gen_fee_rpmt_description").focus();
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_gen_student_fee_rptm_acc.php",
          {
            recid: recid,
            recno: recno,
            accid: accid,
            accname: accname,
            dt: dt,
            desc: desc,
            stid: stid,
            amt: amt,
          },
          function (a) {
            if (a == 1) {
              alert("Payment successfully saved");
              $(".ep").val("");
              $(".progress-loader").remove();
              $("#gen_fee_rpmt_receiptid").load("get_receipt_id.php");
              $("#gen_fee_rpmt_receiptno").load("get_receipt_no.php");
              $("#showStudentFinDetails").html("");
              $("#txt_feeRpmtStudentIDSearch").focus();

              $.post("insert_receipt_no.php", { e: recno }, () => {
                $.post("rpt_student_receipt.php", { e: recno }, function (em) {
                  var newWindow = window.open(
                    "",
                    "rpt_student_receipt.php",
                    "scrollbars=1,width=1300, height=1000"
                  );
                  // window.print(e);
                  //write the data to the document of the newWindow
                  newWindow.document.body.innerHTML = em;
                });
              });
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  //Save GL Transfer - Accountant
  $("#btn_run_gl_trf_acc").click(() => {
    let q = confirm("Save Transaction?");

    if (q) {
      let dr = $.trim($("#sel_gl_trf_dr :selected").attr("id"));
      let cr = $.trim($("#sel_gl_trf_cr :selected").attr("id"));
      let d = $.trim($("#sel_gl_trf_dr").val());
      let c = $.trim($("#sel_gl_trf_cr").val());
      let dt = $.trim($("#gl_trf_tdate").val());
      let recid = $.trim($("#trf_gl_receiptid").text());
      let recno = $.trim($("#trf_gl_receiptno").text());
      let amt = $.trim($("#gl_trf_amt").val());
      let dsc = $.trim($("#gl_trf_description").val());

      if (dt == "") {
        alert("Missing Data: Transaction Date");
        $("#gl_trf_tdate").focus();
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_gl_tranafer_acc.php",
          {
            dr: dr,
            d: d,
            cr: cr,
            c: c,
            amt: amt,
            dt: dt,
            recid: recid,
            recno: recno,
            dsc: dsc,
          },
          function (a) {
            if (a == 1) {
              alert("Transaction saved successfully");
              $(".ep").val("");
              $(".ep").text("0.00");
              $("#sel_gl_trf_dr").load("load_sel_gl_account.php");
              $("#sel_gl_trf_cr").load("load_sel_gl_account.php");
              $("#sel_gl_trf_dr").load("load_sel_gl_account.php");
              $("#sel_gl_trf_cr").load("load_sel_gl_account.php");
              $(".progress-loader").remove();
              $("#sel_gl_trf_dr").focus();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  //Save Petty Cash Transfer - Accountant
  $("#btn_run_gl_trf_petty_acc").click(() => {
    let q = confirm("Save Petty Cash Transaction?");
    if (q) {
      let dr = $.trim($("#sel_pettycash_trf_cr :selected").attr("id"));
      let cr = $.trim($("#sel_gl_trf_dr_petty_acc :selected").attr("id"));
      let d = $.trim($("#sel_pettycash_trf_cr").val());
      let c = $.trim($("#sel_gl_trf_dr_petty_acc").val());
      let dt = $.trim($("#pettycash_trf_tdate_acc").val());
      let recid = $.trim($("#trf_gl_receiptid_petty_acc").text());
      let recno = $.trim($("#trf_gl_receiptno_petty_acc").text());
      let amt = $.trim($("#gl_trf_amt_petty_acc").val());
      let dsc = $.trim($("#gl_trf_description_petty_acc").val());

      if (dt == "") {
        alert("Missing Data: Transaction Date");
        $("#gl_trf_tdate").focus();
        return false;
      } else if (d == "") {
        alert("Select Petty Cash Account");
        return false;
      } else if (c == "") {
        alert("Select Credit Account");
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_gl_tranafer_acc.php",
          {
            dr: dr,
            d: d,
            cr: cr,
            c: c,
            amt: amt,
            dt: dt,
            recid: recid,
            recno: recno,
            dsc: dsc,
          },
          function (a) {
            if (a == 1) {
              alert("Transaction saved successfully");
              $(".ep").val("");
              $(".ep").text("0.00");

              $.post("load_gl_balance.php", { cid: d, cn: dr }, function (b) {
                $("#trf_gl_cr_balance_petty_acc").text(b);
              });

              $.post("load_gl_balance.php", { cid: c, cn: cr }, function (cc) {
                $("#trf_gl_dr_balance_petty_acc").text(cc);
              });

              $(".progress-loader").remove();
              $("#sel_gl_trf_dr").focus();
            } else {
              alert(a);
              $(".progress-loader").remove();
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  $("#btn-authFeeCharges").click(function () {
    $("#auth_student_charges_tbl").load("load_auth_student_charges.php");
  });

  $("#btn-authFeeRpmt").click(function () {
    $("#auth_student_fee_rpmt_tbl").load("load_auth_student_fee_rpmt.php");
  });

  $("#btn-authFeeWriteOff").click(function () {
    $("#auth_student_fee_write_off_tbl").load(
      "load_auth_student_fee_write_off.php"
    );
  });

  $("#btn-authGLTransaction").click(function () {
    $("#auth_general_transaction_tbl").load("load_auth_gl_transaction.php");
  });

  $("#btn-authPNLTransaction").click(function () {
    $("#auth_pnl_transaction_tbl").load("load_auth_pnl_transaction.php");
  });

  //Load GL Balance - Debit Account
  $("#sel_crincdrgl_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_crincdrgl_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#crincdrgl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load GL Balance - Debit Account
  $("#sel_crincdrgl_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_crincdrgl_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#crincdrgl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load PNL Balance - Credit Account
  $("#sel_crincdrgl_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_crincdrgl_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_pnl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#crincdrgl_cr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load PNL Balance - Debit Account
  $("#sel_drinccrgl_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_drinccrgl_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_pnl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#drinccrgl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load GL Balance - Credit Account
  $("#sel_drinccrgl_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_drinccrgl_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#drinccrgl_cr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load PNL Balance - debit Account
  $("#sel_drexpcrgl_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_drexpcrgl_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_pnl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#drexpcrgl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load GL Balance - Credit Account
  $("#sel_drexpcrgl_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_drexpcrgl_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#drexpcrgl_cr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load GL Balance - Debit Account
  $("#sel_crexpdrgl_dr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_crexpdrgl_dr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_gl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#crexpdrgl_dr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  //Load PNL Balance - debit Account
  $("#sel_crexpdrgl_cr").change(function () {
    let cid = $(this).attr("id");
    let cn = $.trim($("#sel_crexpdrgl_cr :selected").attr("id"));

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post("load_pnl_balance.php", { cid: cid, cn: cn }, function (a) {
      $("#crexpdrgl_cr_balance").text(a);
    });
    $(".progress-loader").remove();
  });

  $("#writeOffFee-tab").click(function () {
    $("#write_off_fee_date").load("load_active_date.php");
    $("#write_off_fee_receiptid").load("get_receipt_id.php");
    $("#write_off_fee_receiptno").load("get_receipt_no.php");
    $("#write_off_fee_account").load("load_active_fees_write_off.php");
  });

  $("#btn_run_write_off_fee").click(function () {
    let sid = $.trim($("#lbl_write_off_feeStudentID").text());
    let amt = $.trim($("#write_off_fee_amt").val());
    let recid = $.trim($("#write_off_fee_receiptid").text());
    let recno = $.trim($("#write_off_fee_receiptno").text());

    let q = confirm("Write off student fee?");

    if (q) {
      if (sid == "") {
        alert("Search for student details");
        $("#lbl_write_off_feeStudentID").focus();
        return false;
      } else if (amt <= 0 || amt == "") {
        alert("Enter write off amount");
        $("#write_off_fee_amt").focus();
        return false;
      } else if (recid == "" && recno == "") {
        alert("Receipt No. not found");
        return false;
      } else {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "run_student_fee_write_off.php",
          { sid: sid, recid: recid, recno: recno, amt: amt },
          function (a) {
            if (a == 1) {
              alert("Fee written off successfully");
              $(".ep").val("");
              $(".ep").text("");
              $("#txt_write_off_StudentIDSearch").focus();
              $(".progress-loader").remove();
            } else {
              alert(a);
              $(".progress-loader").remove();
              return false;
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  //Set Active Fee Receivable Account
  $("#btn-SetActiveFeeRcvbl").click(function () {
    let id = $.trim($("#sel_SetActiveFeeRcvbl :selected").attr("id"));
    let nm = $.trim($("#sel_SetActiveFeeRcvbl").val());

    if (nm == "") {
      alert("Select Ledger Account");
      $("#sel_SetActiveFeeRcvbl").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_set_active_fee_receivable.php",
        { id: id, nm: nm },
        function (e) {
          if (e == 1) {
            $("#txt_SetActiveFeeRcvbl").load(
              "load_active_fees_receivables.php"
            );
            $(".progress-loader").remove();
          } else {
            alert(e);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Search Student Name for record edit
  $("#btn-edit-student_test_score").click(function () {
    var e = $.trim($("#ediStScore_search_StdName").val());
    var cid = $.trim($("#editScore_StudentClass :selected").attr("id"));
    var cn = $.trim($("#editScore_StudentClass").val());
    var sid = $.trim($("#editScore_SelSubject :selected").attr("id"));
    var cpn = $.trim($("#editScore_SelSubject :selected").attr("cpn"));
    var sn = $.trim($("#editScore_SelSubject").val());
    var tid = $.trim($("#editScore_SelTestType :selected").attr("id"));
    var tn = $.trim($("#editScore_SelTestType").val());

    if (tn == "" || tn == "NO DATA" || tn == "NA") {
      alert("Select Test");
    } else if (cn == "" || cn == "NO DATA" || cn == "NA") {
      alert("Select Class");
      return false;
    } else if (sn == "" || sn == "NO DATA" || sn == "NA") {
      alert("Select Subject");
      return false;
    } else if (cpn == "") {
      alert("Error Detected: Academic cyclet details not found");
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "load_temp_student_unauth_TestScore.php",
        { SID: sid, CID: cid, TID: tid, CPN: cpn },
        function (e) {
          if (e == 1) {
            $("#temp_student_editTestScore").html(e);
            $(".progress-loader").remove();
          } else {
            $("#temp_student_editTestScore").html(e);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Undo all test score authorisation
  $("#btn_undo_all_auth_test_score").click(function () {
    var cid = $.trim($("#editScore_StudentClass :selected").attr("id"));
    var sid = $.trim($("#editScore_SelSubject :selected").attr("id"));
    var tid = $.trim($("#editScore_SelTestType :selected").attr("id"));
    var cpn = $.trim($("#editScore_SelSubject :selected").attr("cpn"));
    // var sc =$.trim($(this).attr('sc'));

    q = confirm("Undo all actions?");
    if (q) {
      if (tid == "" || tid == "0") {
        alert("Selec Test Type");
        return false;
      } else if (cid == "" || cid == "0") {
        alert("Error detected: Student details not found");
        return false;
      } else if (sid == "" || sid == "0") {
        alert("Select Subject");
        return false;
      } else {
        $("#recStudentScore").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "add_temp_student_unath_testScore_all.php",
          { CPN: cpn, CID: cid, SID: sid, TID: tid },
          function (a) {
            if (a == 1) {
              $.post(
                "load_temp_student_unauth_TestScore.php",
                { SID: sid, CID: cid, TID: tid, CPN: cpn },
                function (e) {
                  if (e == 1) {
                    $("#temp_student_editTestScore").html(e);
                    $(".progress-loader").remove();
                  } else {
                    $("#temp_student_editTestScore").html(e);
                    $(".progress-loader").remove();
                  }
                }
              );
            } else {
              alert(a);
              return false;
            }
          }
        );
      }
    } else {
      return false;
    }
  });

  $("#btn-rpt-class_terminal_report").click(function () {
    let cp = $.trim($("#rptTerminal_SelAcademic").val());
    let cpn = $.trim($("#rptTerminal_SelAcademic :selected").attr("id"));
    let cls = $.trim($("#rptTerminal_SelClass").val());
    let cid = $.trim($("#rptTerminal_SelClass :selected").attr("id"));

    if (cp == "") {
      alert("select Academic Coupon");
      return false;
    } else if (cls == "") {
      alert("Select Class");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "insert_multi_val_rpt_single.php",
        { cid: cid, sid: cpn },
        function (a) {
          if (a == 1) {
            $.post("insert_student_terminal_rpt_temp.php", {}, function (e) {
              if (e == 1) {
                var win = window.open();
                (win.location = "general_class_terminal_report.php"), "_blank";
                win.opener = null;
                win.blur();
                window.focus();
                $(".progress-loader").remove();
              } else {
                alert(e + " come");
                $(".progress-loader").remove();
              }
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-rpt-class_terminal_report_tch").click(function () {
    let cp = $.trim($("#rptTerminal_SelAcademic").val());
    let cpn = $.trim($("#rptTerminal_SelAcademic :selected").attr("id"));
    let cls = $.trim($("#rptTerminal_SelClass_tch").val());
    let cid = $.trim($("#rptTerminal_SelClass_tch :selected").attr("id"));

    if (cp == "") {
      alert("select Academic Coupon");
      return false;
    } else if (cls == "") {
      alert("Select Class");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "insert_multi_val_rpt_single.php",
        { cid: cid, sid: cpn },
        function (a) {
          if (a == 1) {
            $.post("insert_student_terminal_rpt_temp.php", {}, function (e) {
              if (e == 1) {
                var win = window.open();
                (win.location = "general_class_terminal_report_fm.php"),
                  "_blank";
                win.opener = null;
                win.blur();
                window.focus();
                $(".progress-loader").remove();
              } else {
                $(".progress-loader").remove();
              }
            });
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  //Load studnet terminal report temporarily
  $(".load-student-term-rpt").change(function () {
    let cid = $.trim($("#recRemarks_Student_tch :selected").attr("id"));
    let tid = $.trim($("#recRemarks_SelTestType_tch :selected").attr("id"));

    if (cid == "") {
      return false;
    } else if (tid == "") {
      return false;
    } else {
      $(".loader-toggler").show();
      let q = confirm("Process students terminal report details?");
      if (q) {
        $.post(
          "insert_multi_val_rpt_single.php",
          { cid: cid, sid: tid },
          function (a) {
            if (a == 1) {
              $.post(
                "insert_student_terminal_rpt_temp_single.php",
                { cid: cid, tid: tid },
                function (b) {
                  if (b == 1) {
                    $(".loader-toggler").hide();
                  } else {
                    alert(b);
                    $(".loader-toggler").hide();
                    return false;
                  }
                }
              );
            } else {
              alert(a);
              $(".loader-toggler").hide();
              return false;
            }
          }
        );
      } else {
        $(".loader-toggler").hide();
        return false;
      }
    }
  });

  $("#li-issueTicket").click(function () {
    $("#sel_issueTicket_subclass").load("load_staff_class_map.php");
    $("#sel_issueTicket_academic_coupon").load("load_active_calenda_sel_1.php");
  });

  //Load previous class ticket for the term
  $("#btn_check_available_ticket").click(function () {
    let cpn = $.trim(
      $("#sel_issueTicket_academic_coupon :selected").attr("id")
    );
    let cp = $("#sel_issueTicket_academic_coupon").val();
    let cid = $.trim($("#sel_issueTicket_subclass :selected").attr("id"));
    let cl = $("#sel_issueTicket_subclass").val();

    if (cl == "") {
      alert("Select Class First");
      $("#sel_issueTicket_subclass").focus();
      return false;
    } else if (cp == "") {
      alert("Select Academic Term");
      $("#sel_issueTicket_academic_coupon").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      /** $.post('load_class_academic_term_ticket.php',{cid:cid,cpn:cpn},function(a){
              $('#student_term_rpt_ticket').html(a);
              $('.progress-loader').remove();
          }); **/

      $.post(
        "insert_multi_val_rpt.php",
        { sid: cpn, cid: cid, ldt: cid },
        function (a) {
          if (a == 1) {
            $.post(
              "load_class_academic_term_ticket.php",
              { cpn: cpn, cid: cid },
              function (a) {
                window.open("load_class_academic_term_ticket.php", "_blank");
                $(".progress-loader").remove();
              }
            );
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-gen_termRpt_ticket").click(function () {
    let cpn = $.trim(
      $("#sel_issueTicket_academic_coupon :selected").attr("id")
    );
    let cp = $("#sel_issueTicket_academic_coupon").val();
    let cid = $.trim($("#sel_issueTicket_subclass :selected").attr("id"));
    let cl = $("#sel_issueTicket_subclass").val();

    if (cl == "") {
      alert("Select Class");
      $("#sel_issueTicket_subclass").focus();
      return false;
    } else if (cp == "") {
      alert("Select Academic Coupon");
      $("#sel_issueTicket_academic_coupon").focus();
      return false;
    } else {
      let q = confirm("Generate ticket?");
      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "generate_algor_means.php",
          { cid: cid, cpn: cpn },
          function (t) {
            if (t == 1) {
              $(".progress-loader").remove();
            } else {
              alert(t);
              $(".progress-loader").remove();
              return false;
            }
          }
        );
      } else {
        return false;
      }
    }
  });

  $("#student_academic_rpt").click(function () {
    $("#sel_viewTerminalRpt_coupon").load("load_active_calender_all_1.php");
  });

  $("#sel_viewTerminalRpt_coupon").change(function () {
    let cpn = $.trim($("#sel_viewTerminalRpt_coupon :selected").attr("id"));
    let cp = $("#sel_viewTerminalRpt_coupon").val();

    if (cp == "") {
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post("insert_receipt_no.php", { e: cpn }, function (a) {
        if (a == 1) {
          $("#sel_viewTerminalRpt_Ticket").load(
            "load_student_terminal_rpt_active_ticket.php"
          );
          $(".progress-loader").remove();
        } else {
          $(".progress-loader").remove();
          return false;
        }
      });
    }
  });

  $("#btn_gen_student_terminal_rpt").click(function () {
    let cpn = $.trim($("#sel_viewTerminalRpt_coupon :selected").attr("id"));
    let cp = $("#sel_viewTerminalRpt_coupon").val();
    let tkt = $.trim($("#sel_viewTerminalRpt_Ticket :selected").attr("tkt"));
    let tk = $("#sel_viewTerminalRpt_Ticket").val();

    if (cp == "") {
      alert("Select Academic Term");
      $("#sel_viewTerminalRpt_coupon").focus();
      return false;
    } else if (tk == "") {
      alert("Select Active Ticket");
      $("#sel_viewTerminalRpt_Ticket").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "insert_multi_val_rpt.php",
        { sid: cpn, cid: tkt, ldt: tkt },
        function (a) {
          if (a == 1) {
            // window.open("","rpt_student_statement.php","");

            $.post(
              "student_temp_terminal_report.php",
              { cpn: cpn, tkt: tkt },
              function (a) {
                window.open("student_temp_terminal_report.php", "_blank");
              }
            );
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn-rpt-class_terminal_report_main").click(function () {
    let cp = $.trim($("#rptTerminal_SelAcademic_main").val());
    let cpn = $.trim($("#rptTerminal_SelAcademic_main :selected").attr("id"));
    let cls = $.trim($("#rptTerminal_SelClass_main").val());
    let cid = $.trim($("#rptTerminal_SelClass_main :selected").attr("id"));

    if (cp == "") {
      alert("select Academic Coupon");
      return false;
    } else if (cls == "") {
      alert("Select Class");
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post(
        "insert_multi_val_rpt_single.php",
        { cid: cid, sid: cpn },
        function (a) {
          if (a == 1) {
            var win = window.open();
            (win.location = "student_terminal_report_general.php"), "_blank";
            win.opener = null;
            win.blur();
            window.focus();
            $(".progress-loader").remove();
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#btn_view_graphs").click(function () {
    /* $.get('rpt_fetch_graph_data.php', {}, (data) => {
      let panel = document.querySelector('#accounting_report_panel');
      //panel.innerHTML = data;
      let obj = '{ "name":"John", "age":30, "city":"New York"}';
      panel.innerHTML = JSON.parse(obj.name);
    }); */

    const response = fetch("rpt_fetch_graph_data.php")
      .then((response) => {
        console.log(response.json());
      })
      .then((response) => {
        console.log(response);
      });
  });

  //Search Cnsignment Profile Edit
  $("#search_consignment_weight_edit").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignment_weight_edit.php", { e: e }, function (a) {
      $("#display_cns_weight_edit_info").html(a);
    });
  });

  //Get Receipt#
  $("#btn_get_receiptno_reversal").click(function () {
    $(".progress-loader").remove();

    let id = $.trim($("#search_transaction_edit").val());

    if (id === "") {
      alert("Enter Receipt#");

      $("#search_transaction_edit").focus();

      return false;
    } else {
      $("#display_search_results_edit").html("Loading...");

      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );

      $.post("get_tranasction_journal.php", { id }, function (response) {
        $("#display_search_results_edit").html(response);

        $(".progress-loader").remove();
      });
    }
  });

  //
  $("#search_reverse_transaction_edit").keyup(function () {
    var e = $.trim($(this).val());

    // $.post('search_consignment_weight_edit.php', { e: e }, function (response) {
    //   $('#display_reverse_transaction_edit_info').html(response)
    // })

    searchEngine(
      "search_consignment_weight_edit.php",
      { e },
      "#display_reverse_transaction_edit_info"
    );
  });

  //Function to search
  function searchEngine(fileName, data, displayLabel) {
    //alert(data)
    $.post(fileName, data, function (response) {
      $(displayLabel).html(response);
    });
  }

  //Receive Declaration Charges
  $("#rcv-process-decalartion-tab").click(function () {
    $(".sub-basic-setup").hide();
    $("#rcv-process-declaration-panel").slideDown();
    $("#dclr_prcs_rcpt_id").load("get_receipt_id.php");
    $("#dclr_prcs_rcpt_no").load("get_receipt_no.php");
    $("#dclr_prcs_sel_cash_acc").load("load_sel_cash_account.php");
    $("#dclr_prcs_bl_search").focus();
  });

  $("#dclr_prcs_bl_search").keyup(function () {
    let e = $.trim($(this).val());

    if (e == "") {
      return false;
    } else {
      $.post("search_bl_declaration_process.php", { e: e }, function (d) {
        $("#display_dclr_prcs_bl_search").html(d);
      });
    }
  });

  //Search BL for Service Charge Income
  $("#service_charge_bl_search").keyup(function () {
    let e = $.trim($(this).val());

    if (e == "") {
      return false;
    } else {
      $.post("search_bl_service_charge.php", { e: e }, function (d) {
        $("#display_service_charge_bl_search").html(d);
      });
    }
  });

  $("#btn_process_declaration").click(function () {
    let bl = $.trim($("#dclr_prcs_bl_search").val());
    let dcl = $.trim($("#dclr_prcs_decl_no").val());
    let desc = $.trim($("#dclr_prcs_desc").val());
    let duty = $.trim($("#dclr_prcs_duty_amt").val());
    let amt = $.trim($("#dclr_prcs_amt_charge").val());
    let agnm = $.trim($("#dclr_prcs_agent_name").val());
    let tel = $.trim($("#dclr_prcs_agent_telno").val());
    let csz = $.trim($("#dclr_prcs_cnt_size").val());
    let dt = $.trim($("#dclr_prcs_pmt_dt").val());
    let rid = $.trim($("#dclr_prcs_rcpt_id").text());
    let rno = $.trim($("#dclr_prcs_rcpt_no").text());
    let acc = $.trim($("#dclr_prcs_sel_cash_acc :selected").attr("id"));

    $(".progress-loader").remove();

    let q = confirm("Save the declaration?");
    if (q) {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_consignment_declaration_process.php",
        {
          bl: bl,
          dcl: dcl,
          desc: desc,
          duty: duty,
          amt: amt,
          agnm: agnm,
          tel: tel,
          csz: csz,
          dt: dt,
          rid: rid,
          rno: rno,
          acc: acc,
        },
        function (e) {
          if (e == 1) {
            $(".progress-loader").remove();
            alert("Declaration charge saved successfully");
            $("#dclr_prcs_rcpt_id").load("get_receipt_id.php");
            $("#dclr_prcs_rcpt_no").load("get_receipt_no.php");
            $(".ep").val("");
            $("#dclr_prcs_bl_search").focus();
          } else {
            $(".progress-loader").remove();
            alert(e);
          }
        }
      );
    } else {
      return false;
    }
  });

  $("#btn_view_income_rpt").click(function () {
    let accName = $.trim($("#sel_income_rpt_branch :selected").attr("id"));
    let fdt = $.trim($("#text_income_rpt_fdt").val());
    let ldt = $.trim($("#text_income_rpt_ldt").val());

    if (accName === "") {
      alert("Select Income Account");
      $("#sel_income_rpt_branch").focus();
      return false;
    } else if (fdt == "") {
      alert("Select First Transaction Date");
      $("#text_income_rpt_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_income_rpt_ldt").focus();
      return false;
    } else {
      $.post(
        "insert_multi_values_0.php",
        { fdt: fdt, ldt: ldt, e1: accName },
        function (a) {
          if (a != 1) {
            alert(a);
            return false;
          } else {
            window.open("rpt_general_income_report.php", "_blank");
          }
        }
      );
    }
  });

  $("#btn_view_expense_rpt").click(function () {
    let accName = $.trim($("#sel_expenditure_rpt_branch :selected").attr("id"));
    let fdt = $.trim($("#text_expense_rpt_fdt").val());
    let ldt = $.trim($("#text_expense_rpt_ldt").val());

    if (accName === "") {
      alert("Select Expenditure Account");
      $("#sel_expenditure_rpt_branch").focus();
      return false;
    } else if (fdt == "") {
      alert("Select First Transaction Date");
      $("#text_expense_rpt_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_expense_rpt_ldt").focus();
      return false;
    } else {
      $.post(
        "insert_multi_values_0.php",
        { fdt: fdt, ldt: ldt, e1: accName },
        function (a) {
          if (a != 1) {
            alert(a);
            return false;
          } else {
            window.open("rpt_general_expenditure_report.php", "_blank");
          }
        }
      );
    }
  });

  $("#btn_search_processed_declaration").click(function () {
    let fdt = $.trim($("#sel_decl_inc_fdate").val());
    let ldt = $.trim($("#sel_decl_inc_ldate").val());

    if (fdt == "") {
      alert("Select First Date");
      $("#sel_decl_inc_fdate").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Date");
      $("#sel_decl_inc_ldate").focus();
      return false;
    }
    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $("#view_other_report_search_result").html("");
    $.get(
      "fetch_processed_declaration_income.php",
      { fdt: fdt, ldt: ldt },
      function (a) {
        $("#view_other_report_search_result").html(a);
        $(".progress-loader").remove();
      }
    );
  });

  $("#btn_disbursement_summary_rpt").click(function () {
    let fdt = $.trim($("#sel_disbursement_summary_fdate").val());
    let ldt = $.trim($("#sel_disbursement_summary_ldate").val());

    if (fdt == "") {
      alert("Select First Date");
      $("#sel_disbursement_summary_fdate").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Date");
      $("#sel_disbursement_summary_ldate").focus();
      return false;
    }

    $(".progress-loader").remove();
    $("#disbursement_report_view_card").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    $.get("fetch_disbursement_summary_by_date.php", { fdt, ldt }, function (a) {
      $("#view_disbursement_report_search_result").html(a);
      $(".progress-loader").remove();
    });
  });

  $("#updateUserPassword").click(function (e) {
    e.preventDefault();

    let oldpassword = $.trim($("#oldUserPassword").val());
    let newpassword = $.trim($("#newUserPassword").val());
    let confirmPassword = $.trim($("#confirmNewUserPassword").val());

    if (oldpassword === "") {
      alert("Enter Old Password");
      return false;
    } else if (newpassword === "") {
      alert("Enter New Password");
      return false;
    } else if (newpassword != confirmPassword) {
      alert("Passwords do not match.");
    } else if (confirmPassword === "") {
      alert("Confirm Password");
      return false;
    } else {
      let q = confirm("Update password?");

      if (q) {
        $("body").append(
          '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
        );
        $.post(
          "update_user_password.php",
          {
            oldPass: oldpassword,
            newPass: newpassword,
            confirmPass: confirmPassword,
          },
          function (a) {
            if (a == 1) {
              $(".epp").val("");
              alert("Password updated successfully");
              $(".progress-loader").remove();
            } else {
              $(".progress-loader").remove();
              alert(a);
            }
          }
        );
        $(".progress-loader").remove();
      } else {
        return false;
      }
    }
  });

  //GL Transfer
  $("#btn_save_glDrCr").click(function () {
    let rid = $.trim($("#lbl_glDrCr_rcpt_id").text());
    let rno = $.trim($("#lbl_glDrCr_rcpt_no").text());
    let glDr = $.trim($("#sel_glDr_account :selected").attr("id"));
    let glCr = $.trim($("#sel_glCr_account :selected").attr("id"));
    let dot = $.trim($("#txt_glDrCr_dot").val());
    let amt = $.trim($("#txt_glDrCr_amt").val());
    let desc = $.trim($("#txt_glDrCr_description").val());

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post(
      "run_gldrcr_transaction.php",
      {
        rid: rid,
        rno: rno,
        glDr: glDr,
        glCr: glCr,
        dot: dot,
        amt: amt,
        desc: desc,
      },
      function (a) {
        if (a == 1) {
          $(".ep").text("");
          $(".ep").val("");
          $(".gl_account").load("load_sel_gl_account.php");
          alert("Transaction saved successfully");
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
          return false;
        }
      }
    );
  });

  //Debit GL Credit Income
  $("#btn_save_glDrIncCr").click(function () {
    let rid = $.trim($("#lbl_glDrIncCr_rcpt_id").text());
    let rno = $.trim($("#lbl_glDrIncCr_rcpt_no").text());
    let glDr = $.trim($("#sel_dr_glDrIncCr_account :selected").attr("id"));
    let glCr = $.trim($("#sel_cr_glDrIncCr_account :selected").attr("id"));
    let dot = $.trim($("#txt_glDrIncCr_dot").val());
    let amt = $.trim($("#txt_glDrIncCr_amt").val());
    let desc = $.trim($("#txt_glDrIncCr_description").val());

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post(
      "run_gldrincomecr_transaction.php",
      {
        rid: rid,
        rno: rno,
        glDr: glDr,
        glCr: glCr,
        dot: dot,
        amt: amt,
        desc: desc,
      },
      function (a) {
        if (a == 1) {
          $(".ep").text("");
          $(".ep").val("");
          $(".gl_account").load("load_sel_gl_account.php");
          alert("Transaction saved successfully");
          $(".progress-loader").remove();
        } else {
          alert(a);
          $(".progress-loader").remove();
          return false;
        }
      }
    );
  });

  //Debit Expense Credit GL
  $("#btn_save_expDrGLCr").click(function () {
    let rid = $.trim($("#lbl_expDrGLCr_rcpt_id").text());
    let rno = $.trim($("#lbl_expDrGLCr_rcpt_no").text());
    let glDr = $.trim($("#sel_dr_expDrGLCr_account :selected").attr("id"));
    let glCr = $.trim($("#sel_cr_expDrGLCr_account :selected").attr("id"));
    let dot = $.trim($("#txt_expDrGLCr_dot").val());
    let amt = $.trim($("#txt_expDrGLCr_amt").val());
    let desc = $.trim($("#txt_expDrGLCr_description").val());

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post(
      "run_expensedrglcr_transaction.php",
      {
        rid: rid,
        rno: rno,
        glDr: glDr,
        glCr: glCr,
        dot: dot,
        amt: amt,
        desc: desc,
      },
      function (a) {
        if (a == 1) {
          $(".ep").text("");
          $(".ep").val("");
          $(".gl_account").load("load_sel_gl_account.php");
          alert("Transaction saved successfully");
          $(".progress-loader").remove();
          $("#sel_cr_expDrGLCr_account").focus();
        } else {
          alert(a);
          $(".progress-loader").remove();
          return false;
        }
      }
    );
  });

  //Petty cash expense
  $("#btn_save_expense_petty_cash").click(function () {
    $(".progress-loader").remove();

    let rid = $.trim($("#lbl_pmt_exp_rcpt_id").text());
    let rno = $.trim($("#lbl_pmt_exp_rcpt_no").text());
    let glDr = $.trim(
      $("#sel_expense_transaction_account :selected").attr("id")
    );
    //let glCr = $.trim($('#sel_cr_expDrGLCr_account :selected').attr('id'));
    let dot = $.trim($("#txt_pmt_exp_dot").val());
    let amt = $.trim($("#txt_pmt_exp_amt").val());
    let desc = $.trim($("#txt_pmt_exp_description").val());

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );
    $.post(
      "run_pettycash_expense_transaction.php",
      {
        rid: rid,
        rno: rno,
        glDr: glDr,
        dot: dot,
        amt: amt,
        desc: desc,
      },
      function (a) {
        if (a == 1) {
          $(".progress-loader").remove();
          $(".ep").text("");
          $(".ep").val("");
          $("#sel_expense_transaction_account").load(
            "load_sel_expenditure_account.php"
          );
          $("#txt_pmt_exp_cash_bal").load("load_petty_cash_balance.php");
          alert("Transaction saved successfully");
          $("#sel_expense_transaction_account").focus();
        } else {
          alert(a);
          $(".progress-loader").remove();
          return false;
        }
      }
    );
  });

  // View GL Statement
  $("#btn_view_gl_rpt").click(function () {
    let accName = $.trim($("#sel_gl_rpt_branch :selected").attr("id"));
    let fdt = $.trim($("#text_gl_rpt_fdt").val());
    let ldt = $.trim($("#text_gl_rpt_ldt").val());

    if (accName === "") {
      alert("Select G.L. Account");
      $("#sel_gl_rpt_branch").focus();
      return false;
    } else if (fdt == "") {
      alert("Select First Transaction Date");
      $("#text_gl_rpt_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_gl_rpt_ldt").focus();
      return false;
    } else {
      $.post(
        "insert_multi_values_0.php",
        { fdt: fdt, ldt: ldt, e1: accName },
        function (a) {
          if (a != 1) {
            alert(a);
            return false;
          } else {
            window.open("rpt_general_legder_statement.php", "_blank");
          }
        }
      );
    }
  });

  // View Income Statement
  $("#btn_view_income_sttmnt").click(function () {
    let accName = $.trim($("#sel_gl_rpt :selected").attr("id"));
    let fdt = $.trim($("#text_income_sttmnt_fdt").val());
    let ldt = $.trim($("#text_income_sttmnt_ldt").val());

    if (fdt == "") {
      alert("Select First Transaction Date");
      $("#text_income_sttmnt_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_income_sttmnt_ldt").focus();
      return false;
    } else {
      $.post(
        "insert_multi_values_0.php",
        { fdt: fdt, ldt: ldt, e1: accName },
        function (a) {
          if (a != 1) {
            alert(a);
            return false;
          } else {
            window.open("rpt_income_statement.php", "_blank");
          }
        }
      );
    }
  });

  // View Cash Flow Statement
  $("#btn_view_cashflow_sttmnt").click(function () {
    let accName = $.trim($("#sel_gl_rpt :selected").attr("id"));
    let fdt = $.trim($("#text_cashflow_sttmnt_fdt").val());
    let ldt = $.trim($("#text_cashflow_sttmnt_ldt").val());

    if (fdt == "") {
      alert("Select First Transaction Date");
      $("#text_cashflow_sttmnt_fdt").focus();
      return false;
    } else if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_cashflow_sttmnt_ldt").focus();
      return false;
    } else {
      $.post(
        "insert_multi_values_0.php",
        { fdt: fdt, ldt: ldt, e1: accName },
        function (a) {
          if (a != 1) {
            alert(a);
            return false;
          } else {
            $("#display_IncomeSttmnt").load("rpt_income_statement.php");
          }
        }
      );
    }
  });

  $("#sel_LedgerType").change(function () {
    let id = $.trim($(this).val());

    if (id === "") {
      return false;
    } else {
      $.post("insert_multi_values_0.php", { e1: id }, function (a) {
        $("#sel_LedgerCtgry").load("load_sel_distinct_ledger_category.php");
      });
    }
  });

  // View Financial Statement
  $("#btn_view_financial_sttmnt_rpt").click(function () {
    let ldt = $.trim($("#text_financial_sttmnt_rpt_ldt").val());

    $(".progress-loader").remove();

    $("body").append(
      '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
    );

    if (ldt == "") {
      alert("Select Last Transaction Date");
      $("#text_financial_sttmnt_rpt_ldt").focus();

      $(".progress-loader").remove();
      return false;
    } else {
      $.post("insert_multi_values_0.php", { ldt: ldt }, function (a) {
        if (a != 1) {
          alert(a);
          $(".progress-loader").remove();
          return false;
        } else {
          window.open("view_financial_statement_report.php", "_blank");

          $(".progress-loader").remove();
        }
      });
    }
  });

  $("#btn_save_service_charge").click(function () {
    $(".progress-loader").remove();

    let bl = $.trim($("#service_charge_bl_search").val());
    let dcl = $.trim($("#service_charge_decl_no").val());
    let dcl_id = $.trim($("#service_charge_declaration_id").text());
    let desc = $.trim($("#service_charge_desc").val());
    let cons = $.trim($("#service_charge_consignee_name").val());
    let cons_id = $.trim($("#service_charge_consignee_id").text());
    let amt = $.trim($("#service_charge_amt_charge").val());
    let dt = $.trim($("#service_charge_pmt_dt").val());
    let rid = $.trim($("#service_charge_rcpt_id").text());
    let rno = $.trim($("#service_charge_rcpt_no").text());
    let acc = $.trim($("#service_charge_sel_cash_acc :selected").attr("id"));

    let q = confirm("Do you want to save this transaction?");

    if (q) {
      $(".progress-loader").remove();

      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "run_consignment_service_charge.php",
        { bl, dcl, desc, amt, cons, dt, acc, cons_id, dcl_id },
        function (response) {
          let data = JSON.parse(response);

          if (data.code == "200") {
            $(".progress-loader").remove();
            alert(data.msg);
            $(".ep").val("");
            $(".ep").text("");
            $("#service_charge_sel_cash_acc").load("load_sel_cash_account.php");
            $("#service_charge_bl_search").focus();
          } else {
            $(".progress-loader").remove();
            alert(data.msg);
          }
        }
      );
    } else {
      return false;
    }
  });

  //
  $("#btn_add_charge_client_invoice_nonm").click(function () {
    let acc = $.trim($("#sel_ots_acc_invoice_nonm :selected").attr("id"));
    let amt = $.trim($("#client_amt_invoice_nonm").val());
    let desc = $.trim($("#client_desc_invoice_nonm").val());
    let dot = $.trim($("#client_dot_invoice_nonm").val());
    let name = $.trim($("#search_consignee_manifest").val());
    let id = $.trim($("#search_client_oth_serv_id").text());

    if (name == "") {
      alert("Client Name not found");
      $(".client-det-search").focus();
      return false;
    } else if (desc === "") {
      alert("Enter Description");
      $("#client_desc_invoice_nonm").focus();
      return false;
    } else if (dot === "") {
      alert("Select Date of Transaction");
      $("#client_dot_invoice_nonm").focus();
      return false;
    } else if (acc === "") {
      alert("Select Account");
      $("#sel_ots_acc_invoice_nonm").focus();
      return false;
    } else if (amt === "" || amt < 0) {
      alert("Enter Amount");
      $("#client_amt_invoice_nonm").focus();
      return false;
    } else {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_additional_charge_invoice_temp_nonm.php",
        {
          acc: acc,
          amt: amt,
          dot: dot,
          taxStatus: taxStatus,
          desc: desc,
          id: id,
          name: name,
        },
        function (a) {
          if (a == 1) {
            console.log(a);
            //Display Consignee handling charges
            $.post(
              "load_client_handling_charges_temp_nm_tbl.php",
              {},
              function (a) {
                $("#client_charges_display_details_nonm").html(a);
                $("#sel_ots_acc_invoice_nonm").load(
                  "load_sel_billing_account.php"
                );
                $(".epp").val("");
                $("#sel_ots_acc_invoice_nonm").focus();
                $(".progress-loader").remove();
              }
            );
          } else {
            alert(a);
            $(".progress-loader").remove();
          }
        }
      );
    }
  });

  $("#sel_bl_invoice_nonm").change(function () {
    let desc = $("#sel_bl_invoice_nonm :selected").attr("desc");
    $("#client_desc_invoice_nonm").val(desc);
  });

  //
  $("#client_nonm_bill_view").keyup(function () {
    var e = $.trim($(this).val());

    $.post("search_consignee_manifest_nonm_view.php", { e: e }, function (a) {
      $("#display_nonm_bill_client_Search").html(a);
    });
  });

  //
  $("#logistic_tracker").click(() => {
    $("#display_tracked_shipment_status").html(Spinner());
    $("#display_tracked_shipment_status").load("load_tracked_shipment.php");
  });

  //
  $("#online_request").click(() => {
    $("#display_online_request_status").html(Spinner());
    $("#display_online_request_status").load("load_online_request.php");
  });

  $("#searchMainBLTracking").keyup(function () {
    let e = $.trim($(this).val());

    $.post("search_mainbl_shipment_tracking.php", { e: e }, function (a) {
      $("#display_mainbl_tracking_search").html(a);
    });
  });

  //New Waybill
  $("#btn_add_new_waybill").click(function (e) {
    e.preventDefault();

    let consignee_name = $.trim($("#waybill_consignee_name").val());
    let vehicle_no = $.trim($("#waybill_vehicle_no").val());
    let driver_name = $.trim($("#waybill_driver_name").val());
    let port = $.trim($("#waybill_port").val());
    let driver_license = $.trim($("#waybill_driver_license").val());
    let package = $.trim($("#waybill_package").val());
    let description = $.trim($("#waybill_description").val());
    let qty = $.trim($("#waybill_qty").val());
    let date = $.trim($("#waybill_date").val());

    if (date == "") {
      alert("Select Transaction Date");
      $("#waybill_date").focus();
      return false;
    }

    let q = confirm("Create customer waybill?");
    if (q) {
      $("body").append(
        '<div class="progress-loader"><i class="fa fa-spinner faa-spin animated fa-2x"></i></div>'
      );
      $.post(
        "add_new_waybill.php",
        {
          consignee_name,
          vehicle_no,
          driver_name,
          port,
          driver_license,
          package,
          description,
          qty,
          date,
        },
        function (a) {
          let res = JSON.parse(a);
          if (res.code == 200) {
            alert(res.msg);
            window.open("customer_waybill_printable.php", "_blank");
            $(".ep").val("");
            $(".progress-loader").remove();
          } else if (res.code == 300) {
            alert(res.msg);
            $(".progress-loader").remove();
          }
        }
      );
    } else {
      return false;
    }
  });
  //End of Script.
});
