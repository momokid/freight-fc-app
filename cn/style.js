$(function(){
    
//Show New Transaction Day
$('#a-start-new-day').click(function(){  
    $('.sub-basic-setup').hide();
    $('#tdate_rate').load('load_daily_rate_start_tdate.php');
    $('#start-new-day').slideDown();
});

//Hide all menu buttons
	$('.main-area-content').hide();
        $('.sub-main-area-content').hide();
        $('#sub-basic-setup-rpt').hide();
	$('.sub-basic-setup').hide();
	$('.sub-menu-button-wrap').hide();
        $('.sch-fee-class').hide();
        $('.sub-basic-setup-1').hide();
        $('.sub-basic-setup-sub').hide();
	
	//window.setInterval(function() {
    // this will be invoked on every 5s
   //alert('this happens every 5 secs');
//}, 5000);
	       
//Show/Hide when clicked on search results of Edit Student Info
$(document).click(function(e) {
    if ($(e.target).is('#closeTimePicker,#openTimePicker, .edit_std_search_result, .edit_std_search_result *'))  return false;
    else $('.edit_std_search_result').hide();
})		
  
$(document).click(function(e) {
    if ($(e.target).is('.sel_suspend_student_account_react *'))  return false;
    else $('.sel_suspend_student_account_react').hide();
}) 
 
 $(document).click(function(e) {
    if ($(e.target).is('.sel_suspend_student_account_deact *'))  return false;
    else $('.sel_suspend_student_account_deact').hide();
})
 
//alert('process bill');
        
       // $('.push-notf-alert').fadeOut(10000);
        
	 $(".dtpicker").datepicker({
    	   showButtonPanel: false
            });
	$('.wrap-details').hide();
	
	$('#stock-level-0').load('stock_status_notifier.php');
	
	$('.bg-alert-popup').hide();
	
	$('.bg-alert-popups').fadeIn(1000);
		   
  	$('.close-btn').click(function(){
  		$('#alert-popup').slideUp(100);
  	});


//Show Basic Settings Menu
	$('#a-basicsettings').click(function(){
	$('.main-area-content').hide();
        $('.sub-basic-setup').hide();
	$('#basic-setup').slideDown();
	});

//Show Fee Management Menu
	$('#a-feemanagement').click(function(){
	$('.main-area-content').hide();
        $('.sub-basic-setup').hide();
	$('#fee-management').slideDown();
	});

//Show Stock Management Menu
	$('#a-stockmngmnt').click(function(){
            $('.main-area-content').hide();
            $('.sub-basic-setup').hide();
            $('#stockmngmnt').slideDown();
	});


//Show Student Management Menu
	$('#a-studentmngmnt').click(function(){
	$('.main-area-content').hide();
        $('.sub-basic-setup').hide();
	$('#student').slideDown();
	});


//Show Report Viewer Menu
	$('#a-reportview').click(function(){
	$('.main-area-content').hide();
        $('.sub-basic-setup').hide();
	$('#reportview').slideDown();
	});

 //Daily Cash Report
    $('#rpt-daily-mobilisation').click(function(){
        $('.sub-basic-setup').hide();
       $('#rpt-agent-mob-name').load('load_distinct_agent_mob_name.php');
        $('#daily-mobilisation').slideDown();
    });

 //Student Terminal Report
    $('#rpt-student_terminal').click(function(){
        $('.sub-basic-setup').hide();
        $('#student_search_list_terminal_rpt').load('load_terminal_rpt_student_list.php');
        $('#tbl-terminal_rpt_sel_details_temp').load('tbl-terminal_rpt_sel_details_temp.php');
        $('#student-terminal-rpt').slideDown();
    });
      
 //Student General Population Report
    $('#rpt-student_gen-pop').click(function(){
        $('.sub-basic-setup').hide();
       $('#student_gen-pop-rpt').slideDown();
    });
 
  //Deactivation Status Report
    $('#rpt-deactivation_status').click(function(){
        $('.sub-basic-setup').hide();
        $('#sel-deact-status-branch').load('load_terminal_rpt_student_list.php');    
        $('#deactivation_status-rpt').slideDown();
    });
    
 
 //Class General Population Report
    $('#rpt-student_pop-class').click(function(){
        $('#rpt-class-genpop-accname').load('load_class_genpop_classname.php');
        $('.sub-basic-setup').hide();
       $('#student_pop-class-rpt').slideDown();
    });

 //Gender General Population Report
    $('#rpt-student_pop-gender').click(function(){
        $('#rpt-gender-genpop-accname').load('load_gender_genpop_classname.php');
        $('.sub-basic-setup').hide();
       $('#student_pop-gender-rpt').slideDown();
    });

 //Nationality General Population Report
    $('#rpt-student_pop-nt').click(function(){
        $('#rpt-ntl-genpop-accname').load('load_ntl_genpop_classname.php');
        $('.sub-basic-setup').hide();
       $('#student_pop-nt-rpt').slideDown();
    });

 //Fee Outstanding Report
    $('#rpt-fee-outstanding').click(function(){
        $('.sub-basic-setup').hide();
        $('#fee-outstanding').slideDown();
    });
    
  //Fee Paid Report
    $('#rpt-fee-paid').click(function(){
        $('.sub-basic-setup').hide();
        $('#paid-fee-general').slideDown();
    });
     
 //Student Registration Report
    $('#rpt-studentregreport').click(function(){
        $('.sub-basic-setup').hide();
         $('.rpt-tch-class-assigned').load('load_teacher_class_attendance.php');
        $('#student-regreport').slideDown();
    });
    
  //Daily Attendance  Report
    $('#rpt-dailyattenreport').click(function(){
        $('.sub-basic-setup').hide();
         $('.rpt-tch-class-assigned').load('load_teacher_class_attendance.php');
        $('#daily-attenreport').slideDown();
    });
  
  //Daily Attendance  Report
    $('#rpt-attendance_register').click(function(){
        $('.sub-basic-setup').hide();
         $('#daily_attendance_class').load('load_distinct_classroom.php');
        $('#attendance_register').slideDown();
    });
    
//Show Academic Report
    $('#a-academicrpt').click(function(){
        $('.sub-main-area-content').hide();
        $('#academicrpt').slideDown();
    });

//Show Financial Report
    $('#a-financialsrpt').click(function(){
        $('.sub-main-area-content').hide();
        $('#financialsrpt').slideDown();
    });    
  
//Show Accounting Report
    $('#a-accountingrpt').click(function(){
        $('.sub-main-area-content').hide();
        $('#accountingrpt').slideDown();
    }) ;   
  
//Show Accounting Report
    $('#a-stockrpt').click(function(){
        $('.sub-main-area-content').hide();
        $('#stockrpt').slideDown();
    }) ;
    
//Show Other Report
    $('#a-otherrpt').click(function(){
        $('.sub-main-area-content').hide();
        $('#otherrpt').slideDown();
    }) ;   
     
 //...................
    $('#rpt-class_mobilisation').click(function(){
        $('.sub-basic-setup').hide();
        $('#rpt-mob-class-accname').load('load_distinct_class_rpt.php');
        $('#class-mobilisation').slideDown();
    });
  
 //...................
    $('#rpt-fee-repayment').click(function(){
        $('.sub-basic-setup').hide();
        $('#fee-repayment').slideDown();
    });   
    
  
 //...................
    $('#rpt-account_mobilisation').click(function(){
        $('.sub-basic-setup').hide();
        $('#rpt-mob-account-accname').load('load_distinct_account_rpt.php');
        $('#account-mobilisation').slideDown();
    });
    
    
 //...................
    $('#rpt-daily-cash').click(function(){
        $('.sub-basic-setup').hide();
         $('#rpt-daily-cash-accname').load('load_distinct_cashier_rpt.php');
        $('#daily-cash').slideDown();
    });
  
  //...................
    $('#rpt-mobilisation-analysis-rpt').click(function(){
        $('.sub-basic-setup').hide();
       $('#rpt-mob-analysis-class-name').load('load_distinct_class_rpt.php');
        $('#mobilisation-analysis-rpt').slideDown();
    });   
    
    //...................
    $('#rpt-gen-mobilisation-analysis-rpts').click(function(){
        $('.sub-basic-setup').hide();
       $('#rpt-gen-mob-analysis-accname').load('load_distinct_transport.php');
        $('#gen-mobil-analysis').slideDown();
    });
    
    //...................
    $('#rpt-gen-mobilisation-analysis-rpt').click(function(){
       window.open("general_mobilisation_report_analysis.php", "", "scrollbars=1,width=1250, height=1000");
       
    });
    
   
    //
    $('#rpt-detail-mobil-analysis-rpt').click(function(){
       $('.sub-basic-setup').hide();
       $('#rpt-detls-mob-analysis-accname').load('load_distinct_transport.php');
       $('#detail-mobil-analysis').slideDown(); 
    });
    
 //...................
    $('#rpt-daily-cash-csh').click(function(){
        $('.sub-basic-setup').hide();
         $('#rpt-daily-cash-accname-csh').load('load_distinct_cashier_rpt-csh.php');
         $('#lbl-rpt-date-csh-summary').load('load_csh_rpt_date.php');
        $('#daily-cash').slideDown();
    });
  

    //...................
    $('#rpt-general-cash').click(function(){
        $('.sub-basic-setup').hide();
         $('#rpt-gen-cash-accname').load('load_distinct_cashier_rpt.php');
        $('#general-cash').slideDown();
    });
  
    
    //...................
    $('#rpt-general-cash-csh').click(function(){
        $('.sub-basic-setup').hide();
        $('#lbl-rpt-date-csh-details').load('load_csh_rpt_date.php');
         $('#rpt-gen-cash-accname-csh').load('load_distinct_cashier_rpt-csh.php');
        $('#general-cash-csh').slideDown();
    });
    
//...................
$('#rpt-income-detail').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-income-branch-name').load('rpt_branch_pnl.php');
    $('#income-detail').slideDown();
});

//...................
$('#rpt-financial-statement').click(function(){
    $('.sub-basic-setup').hide();
    $('#financial-statement').slideDown();
});

//...................
$('#rpt-ledger-statement').click(function(){
    $('.sub-basic-setup').hide();
    $('#ledger-statement').slideDown();
});


//...................
$('#rpt-gen_student_bill').click(function(){
    $('.sub-basic-setup').hide();
    $('#gen_student_bill').slideDown();
});


//......................................
$('#rpt-income-ldg-stttmnt').click(function(){
     $('.sub-basic-setup-sub').hide();
     $('#rpt-inc-sttmnt-account-name').load('load_distinct_income_acc_name.php');
    $('#income-ldg-stttmnt').slideDown();
});

//..................................................
$('#rpt-exp-ldg-stttmnt').click(function(){
    $('.sub-basic-setup-sub').hide();
    $('#rpt-exp-sttmnt-account-name').load('exp-load_expenditure_account_name.php');
    $('#exp-ldg-stttmnt').slideDown();
});

//..................................................
$('#rpt-gen-class-bill').click(function(){
    $('.sub-basic-setup-sub').hide();
    $('#rpt-gen-std-bill-class-name').load('load_distinct_classroom.php');
    $('#gen-class-bill').slideDown();
    $('#tbl-search-student_bill').focus();
});

//..................................................
$('#rpt-gl-ldg-stttmnt').click(function(){
    $('.sub-basic-setup-sub').hide();
    $('#rpt-gl-sttmnt-account-name').load('gl_load_sttmnt_account_name.php');
    $('#gl-ldg-stttmnt').slideDown();
});


//...................
$('#rpt-stock-ordered').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-income-branch-name').load('rpt_branch_pnl.php');
    $('#stock-ordered-rpt').slideDown();
});

//...................
$('#rpt-stock-sales').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-income-branch-name').load('rpt_branch_pnl.php');
    $('#stock-sales-rpt').slideDown();
});

//...................
$('#rpt-stock-outs').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-income-branch-name').load('rpt_branch_pnl.php');
    $('#stock-outs-rpt').slideDown();
});


//...................
$('#rpt-expenditure-detail').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-expenditure-branch-name').load('rpt_branch_pnl.php');
    $('#expenditure-detail').slideDown();
});

//...................
$('#rpt-income-statement').click(function(){
    $('.sub-basic-setup').hide();
     $('#rpt-pnl-branch-name').load('rpt_branch_pnl.php');
    $('#income-statement').slideDown();
});

//...................
$('#rpt-student-statement').click(function(){
    $('.sub-basic-setup').hide();
     $('#tbl-rpt-sch-fee-student-list').load('student_statement_tbl_list.php');
     $('#tbl-rpt-student-sttmnt').load('student_statement_search_temp.php');
    $('#sel-student-sttmnt-acc').load('load_dstinct_sttment_fee_acc_name.php');
    $('#student-statement').slideDown();
});



 //Show Fee Billing
    $('#a-billstudent').click(function(){
         $('.sub-basic-setup').hide();
	$('#fee-bill').slideDown();
    });
 
 //Show Fee Payment Menu
    $('#a-feepayment').click(function(){
          $('.sub-basic-setup').hide();
	$('#fee-payment').slideDown();
    });
    
//Show New Classroom Menu
	$('#a-createclass').click(function(){
            $('.sub-basic-setup').hide();
            $('#class-category-name').load('load_class_category_name.php');  
            $('#new-class').slideDown();
	});
        
//Show School Fee Billing
    $('#a-schoolfee').click(function(){
       $('.sub-basic-setup').hide();
       $('#schfee-bill-accname').load('schoolbilllist.php');
       $('#tbl_studentlist').load('studentlist_bill_temp.php');
       $('#bill_account_details').load('bill_account_details.php');
       $('#lbl-bill-receipt-no').load('naamu_track.php');
       $('#lbl-bill-receipt-id').load('naamu_track_id.php');
       $('#schoolfee-billing').slideDown(); 
    });

//Show Stock Manager
$('#a-newstockmnger').click(function(){

    var mycode = "STM-";

    $.post('check_stock_manager_id.php',{},function(ansa){
            $('#lbl-manager-id-ref').text(ansa);
            $('#lbl-stock-manager-id').text(mycode+ansa);
    });

   $('.sub-basic-setup').hide();
   $('#newstockmnger').slideDown(); 
});

//Show Non Cash Stock Sales
$('#a-ncash-stk-sales').click(function(){
   $('.sub-basic-setup').hide();
   $('#ncash-stk-sales').slideDown(); 
});


//Show Stock Item
$('#a-newstockitem').click(function(){
   $('.sub-basic-setup').hide();
   $('#lbl-stock-item-id').load('load_stock_item_id.php');
   $('#newstockitem').slideDown(); 
   $('#stock-item-name').focus();
});

//Show Stock Purchase
$('#a-stockpurchase').click(function(){
   $('.sub-basic-setup').hide();
   $('#load-stock-item-id').load('load_stock_item.php');
   $('#load-stock-mnger-id').load('load_stock_manager_id.php');
    $('#load-stock-cr-account').load('load_distinct_stock_cr_account.php');  
    $('#lbl-stock-pch-rcpt-no').load('naamu_track.php');
    $('#lbl-stock-batch-no').load('batch_track.php');
   $('#stockpurchase').slideDown(); 
   $('#stock-item-name').focus();
});

//Show  Non-Cash Transaction
    $('#a-otherfee').click(function(){
       $('.sub-basic-setup').hide();    
       $('#otherfee-billing').slideDown(); 
    });
  

//Show Ledger Transfer
    $('#a-ledgertrf').click(function(){
        $.post('check_ledger_trf_user_priviledge.php',{},function(e){
            if(e==1){
               $('.sub-main-area-content').hide();
                $('#load_ledger_acc_name_dr').load('load_distinct_ledger_name.php');
                 $('#load_ledger_acc_name_cr').load('load_distinct_ledger_name.php');
                  $('#process_ledger_cr_bal').text('Balance:0.00');
                $('#lbl-legder_trf_tran_no').load('naamu_track.php');
                $('#ledgertrf').slideDown(); 
            }else{
                alert('Access Denied');
               $('.sub-main-area-content').hide(); 
            }
        });
        
    });
  
  //Show Debit Expenditure  Ledger Transfer
    $('#a-glexpenditure-trf').click(function(){
        $.post('check_exp_user_priviledge.php',{},function(e){
            if(e==1){
               $('.sub-main-area-content').hide();
               $('#exp-load_expenditure_account_name').load('exp-load_expenditure_account_name.php');
               $('#exp-load_ledger_acc_name_cr').load('load_distinct_ledger_name.php');
               $('#process_ledger_cr_bal').text('Balance:0.00');
               $('#lbl-exp-legder_trf_tran_no').load('naamu_track.php');
               $('#glexpenditure-trf').slideDown();
            }else{
                alert('Access Denied');
               $('.sub-main-area-content').hide();
            }
        })
        
    })
  
  //Show Credit Income - Ledger Transfer
    $('#a-glincome-trf').click(function(){
        $.post('check_exp_user_priviledge.php',{},function(e){
            if(e==1){
               $('.sub-main-area-content').hide();
               $('#load_ledgerinc_acc_name_dr').load('load_distinct_ledger_name.php');
               $('#load_income_acc_name_cr').load('load_distinct_income_acc_name.php');
               $('#process_ledgerinc_dr_bal').text('Balance:0.00');
               $('#lbl-glincome_trf_tran_no').load('naamu_track.php');
               $('#glincome-trf').slideDown();
            }else{
                alert('Access Denied');
               $('.sub-main-area-content').hide();
            }
        })
        
    })
  
  
  //Show Credit Expenditure  Ledger Transfer
    $('#a-expendituregl-trf').click(function(){
        $.post('check_exp_user_priviledge.php',{},function(e){
            if(e==1){
               $('.sub-main-area-content').hide();
               $('#dr-load_expenditure_account_name').load('load_distinct_ledger_name.php');
               $('#exp-cr-load_ledger_acc_name_cr').load('exp-load_expenditure_account_name.php');
               $('#process_ledger_cr_bal').text('Balance:0.00');
               $('#lbl-exp-cr-legder_trf_tran_no').load('naamu_track.php');
               $('#expendituregl-trf').slideDown();
            }else{
                alert('Access Denied');
               $('.sub-main-area-content').hide();
            }
        })
        
    });
 
    
//Show Cash Book Expenditure Transfer
    $('#a-expenditure-cshbook').click(function(){
        $.post('check_exp_user_priviledge.php',{},function(e){
            if(e==1){
                $('.sub-basic-setup').hide();
                $('#lbl-csh-expense-ac').load('check_cash_ifo_expenditure.php');
                $('#sel-expenditure-accname-cshbook').load('load_expenditure_account.php');
                $('#lbl-expenditure-rcpt-no-cshbk').load('naamu_track.php');
                $('#expenditure-cshbook').slideDown();
            }else{
                alert('Access Denied');
                $('#expenditure-cshbook').slideDown();
            }
        })
        
    });    
    
    
 //Show Other Fee Billing
    $('#a-otherfee-csh').click(function(){
       $('.sub-basic-setup').hide();
       $('#otherfee-billing').slideDown(); 
    });
 
 //Show Receive Cash

   $('#a-expense').click(function(){
        $('.sub-basic-setup').hide();
         $('#lbl-other-cash-sales-recpt-no').load('naamu_track.php');
        $('#load_other_stock_acc_name').load('load_stock_other_cash_Sales.php');
        $('#tbl_sel_other_stock_item_cash_sales').load('load_sel_other_stock_item_cash_sales.php');
        $('#lbl-stock_subtotal_sel_other_cash_sales').load('load_stock_sel_other_total_cash_sales.php');
        $('#expense').slideDown();
    });
  
//Show School Fee Payment
    $('#a-schfeepmt').click(function(){
       $('.sub-basic-setup').hide();
       $('#tbl-rcv-sch-fee-student-list').load('student_outstanding_fee_list.php');
       $('#tbl-rcv-sch-fee-student-details').load('student_fee_details_temp.php');
       $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
       $('#schoolfee-pmt').slideDown(); 
       $('#tbl-search-student_fee-rcv').focus();
    });
 
 //Show School Fee Payment
    $('#a-schfeepmt-csh').click(function(){
       $('.sub-basic-setup').hide();
       
       //$('#tbl-rcv-sch-fee-student-list').load('student_outstanding_fee_list.php');
       $('#tbl-rcv-sch-fee-student-details').load('student_fee_details_temp.php');
       $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
       $('#csh-total-out-fee-sel').load('load_sel_student_temp_rcv_total.php');
       $('#schoolfee-pmt').slideDown(); 
       $('#tbl-search-student_fee-rcv').focus();
    });
 
  //Show Stock Sales Cash
    $('#a-stocksalescsh').click(function(){
       $('.sub-basic-setup').hide();
       
       $('#tbl-cash-stock-sales-list').load('load_current_student_list.php');
       $('#load_stock_acc_name').load('load_stock_item_cash_sales.php');
       $('#tbl_sel_student_cash_stock_sales').load('load_sel_student_stock_cash_sales.php');
       $('#lbl-cash-sales-recpt-no').load('naamu_track.php');
       $('#stocksalescsh').slideDown(); 
       $('#tbl_sel_stock_item_cash_sales').load('load_sel_stock_item_cash_sales.php');
       $('#lbl-stock_subtotal_sel_cash_sales').load('load_stock_sel_total_cash_sales.php');
       $('#tbl-search-student_fee-rcv').focus();
    });

 
 //Show Bill Individual Student Fee
    $('#a-schoolfee-ind').click(function(){
       $('.sub-basic-setup').hide();
       
       $('#tbl-rcv-sch-fee-student-list').load('bill_ind_stundent_list_out_fee.php');
       $('#sel-student-fee-accname-ind').load('load_distinct_bill_account.php');
       $('#tbl-rcv-sch-fee-student-details').load('student_fee_ind_bill_temp.php');
       $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
       $('#tbl-search-student_fee-rcv').focus();
       $('#schoolfee-billing-ind').slideDown(); 
    });
 
 
 //Show Other Fee Payment
    $('#a-otherfeepmt').click(function(){        
       $('.sub-basic-setup').hide();
         $('#rcv-other-fee-accname').load('loa_distinct_class_name.php');
         $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
         $('#lbl-other-fee-receipt-no').load('naamu_track.php');
       $('#otherfee-pmt').slideDown(); 
    });
 
  //Show Write Off Student Arrears
    $('#a-write-off-arrears').click(function(){        
       $('.sub-basic-setup').hide();
         $('#lbl-other-fee-receipt-no').load('naamu_track.php');
       $('#write-off-arrears').slideDown(); 
       $('#txt-write-off-arrears-std-search').focus();
    });
 
 //Show Write Off Student Arrears
    $('#a-write-off-daily-arrears').click(function(){        
       $('.sub-basic-setup').hide();
         $('#lbl-other-fee-receipt-no').load('naamu_track.php');
       $('#write-off-daily-arrears').slideDown(); 
       $('#txt-write-daily-off-arrears-std-search').focus();
    });
 
 
  //Show Other Fee Payment
    $('#a-otherfeepmt-csh').click(function(){        
       $('.sub-basic-setup').hide();
         $('#rcv-other-fee-classname').load('loa_distinct_class_name.php');
         $('#rcv-other-fee-accname-csh').load('load_distinct_fee_name.php')
         $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
         $('#lbl-other-fee-receipt-no').load('naamu_track.php');
       $('#otherfee-pmt').slideDown(); 
    });
 
   //Show Receive Cash
    $('#a-other-cash-rcpt-csh').click(function(){        
       $('.sub-basic-setup').hide();
       $('#other-cash-rcpt-csh').slideDown(); 
    });
 
  
//Show Student Registration/Bill Form
	$('#a-newstudent').click(function(){
            $('#std-class-name').load('teacher_list.php');
            $('#std-religion').load('load_distinct_religion.php');
            $('#std-nationale').load('load_garinmu_data.php');
           // $('#load_stock_acc_name').load('load_stock_item_cash_sales.php');
            $('#std-transport-means').load('load_distinct_student_transport.php');
            $('#tbl-admitn-sel-class-fee-account').load('load_class_new_admitn_fee.php');
            $('#lbl-admitn-total-fee-temp').load('load_admission_total_fee_temp.php')
            $('#lbl-student-adm-recpt-no').load('naamu_track.php');
            $('#lbl-admitn-rcpt-id').load('naamu_track_id.php');
            $('#std-section').load('load_distinct_section_name.php');
            $.post('assign_new_student_id.php',{},function(e){
           // alert(Class);
             // alert(e);
               $('#lb-student-id').text(e); 
            });
            $.post('get_id_student.php',{},function(e){
               // alert(e);
                $('#lb-student-code').text(e);
            });
            $('.sub-basic-setup').hide();
            $('#new-student').slideDown();
             $('#std-fname').focus();
	});

//Show Student Registration - No Bill Form
	$('#a-newstudentnb').click(function(){
            $.post('check_user_new_studentnb_maker.php',{},function(e){
               if(e==1){
                    $('#stdnb-class-name').load('teacher_list.php');
                    $('#stdnb-religion').load('load_distinct_religion.php');
                    $('#std-sectionnb').load('load_distinct_section_name.php');
                    $('#stdnb-nationale').load('load_garinmu_data.php');
                    $('#std-transport-means-nb').load('load_distinct_student_transport.php');
                    $.post('assign_new_student_id.php',{},function(e){
                   // alert(Class);
                     // alert(e);
                       $('#lb-studentnb-id').text(e); 
                    });
                    $.post('get_id_student.php',{},function(e){
                       // alert(e);
                        $('#lb-studentnb-code').text(e);
                    });
                    $('.sub-basic-setup').hide();
                    $('#new-studentnb').slideDown();
                    $('#stdnb-fname').focus();
                 }else{
                     alert('Access Denied');
                 } 
            });
           
	});



//Show Student Registration Form
	$('#a-newstudent-tch').click(function(){
             $('#std-class-name-tch').load('load_teacher_class_attendance.php');
            $('.sub-basic-setup').hide();
            $('#new-student-tch').slideDown();
	});

//Show Edit Student Registration Form
	$('#a-editstudent').click(function(){
            $.post('check_user_edit_priviledge.php',{},function(e){
                if(e==1){
                    $('.sub-basic-setup').hide();
                    $('#editstudent').slideDown();
                    $('#txt-edit-student-info').val('');
                     $('#txt-edit-student-info').focus();
                }else{
                    alert('Access Denied');
                    return false;
                }
            })
	});

//Show Expenditure
	$('#a-expenditure').click(function(){
             $('#std-class-name').load('teacher_list.php');
            $('.sub-basic-setup').hide();
            $('#lbl-csh-expense-ac').load('check_cash_ifo_expenditure.php');
            $('#sel-expenditure-accname').load('load_expenditure_account.php');
            $('#lbl-expenditure-rcpt-no').load('naamu_track.php');
            $('#expenditure').slideDown();
	});

//Show Bank Payment
	$('#a-bank-pmt').click(function(){
            $('.sub-basic-setup').hide();
            $('#sel-bank-accname').load('load_bank_account.php');
            $('#lbl-bank-dep-rcpt-no').load('naamu_track.php');
            $('#bank-pmt').slideDown();
	});

//Show Start Day
	$('#a-start-day').click(function(){
            $('.main-area-content').hide();
            $('#start-day').slideDown();
	});

//Show Start User Access
	$('#a-activate-user-access').click(function(){
            $('.main-area-content').hide();
            $('#activate-user-access').slideDown();
	});

//Show Academic Coupon
	$('#a-academic-coupon').click(function(){
            $.post('check_user_coupon.php',{},function(ansa){
                if(ansa==1){
                    $('.main-area-content').hide();
                    $('#academic-coupon').slideDown();
                }else{
                    alert(ansa);
                }
            });
	});

//Show Student Registration Form
	$('#a-newstudent').click(function(){
             $('#std-class-name').load('teacher_list.php');
            $('.sub-basic-setup').hide();
            $('#new-student').slideDown();
	});

//Show New Academic Coupon
	$('#a-new-coupon').click(function(){
             $.post('check_user_coupon.php',{},function(ansa){
                if(ansa==1){
                    $('.sub-basic-setup').hide();
                    $('#lbl-new-coupon-id').load('coupon_track.php')
                    $('#tbl-new_coupon_class_roll').load('load_class_roll.php')
                    $('#new-coupon').slideDown();
                }else{
                    alert(ansa);
                }
            });
	});

//Show End Academic Coupon
	$('#a-end-active-coupon').click(function(){
             $.post('check_user_coupon.php',{},function(ansa){
                if(ansa==1){
                    $('.sub-basic-setup').hide();
                    $('#view_end_active_coupon').load('end_active_coupon_view.php');
                    $('#end-active-coupon').slideDown();
                }else{
                    alert(ansa);
                }
            });
	});


//Show Student Promo
	$('#a-studentpromo').click(function(){
            $.post('check_user_promo.php',{},function(e){
                if(e==1){
                    $('#student-promo-classname').load('load_empty_class_prom.php');
                    $('#tbl-promo-std-list-temp').load('load_student_promo_temp_list.php')
                    $('#promo_coupon_no_temp').load('load_coupon_no_promo_temp.php');
                    $('#promo_coupon_title_temp').load('load_coupon_title_promo_temp.php');
                    $('#promo_class_name_temp').load('load_class_name_promo_temp.php');
                    $('#student-promo-empty-class').load('load_promo_empty_class.php');
                    $('.sub-basic-setup').hide();
                    $('#student-promo').slideDown();
                }else{
                    alert(e);
                }
            });
          
	});


//Show New Teacher Menu
	$('#a-teacher').click(function(){
            $('#tch-class-name').load('teacher_list.php');
               $('#tch-branch-name').load('rpt_branch_pnl.php');
            $('.sub-basic-setup').hide();
            $('#new-teacher').slideDown();
            $('#tch-fname').focus();
	});

//Show New Non Teacher Menu
	$('#a-non-teacher').click(function(){
            $('.sub-basic-setup').hide();
            $('#new-non-teacher').slideDown();
	});

//Show New Income Account Menu
	$('#a-ldgaccount').click(function(){  
            $('.sub-basic-setup').hide();
            $('#ldgaccount').slideDown();
	});

//Show New Curricular Activity Menu
	$('#a-new-curricular').click(function(){  
            $('.sub-basic-setup').hide();
            $('#new-curricular').slideDown();
	});

//Show New Ledger Heading Menu
	$('#a-gl-cntrl').click(function(){  
            $('.sub-basic-setup-sub').hide();
            $('#lb-control-id').load('get_new_control_id.php');
            $('#tbl_control_display').load('load_distinct_control_name.php');
            $('#gl-cntrl').slideDown();
            $('#new-controlname').focus();
	});

//Show New Balance Sheet Account Menu
	$('#a-gl-account').click(function(){ 
            $('.sub-basic-setup-sub').hide();
            $('#ledger_control_id').load('load_distinct_control_id_ledger.php');
            $('#ledger_category_id').load('load_distinct_ledger_category.php');
            $('#tbl_control_ledger_display').html('');
            $('#gl-account').slideDown();
            $('#new-ledgername').focus();
	});

//Show New Income Account Menu
	$('#a-inc-account').click(function(){  
            $.post('check_active_ie.php',{},function(e){
                if(e==1){
                    $('.sub-basic-setup-sub').hide();
                    $('#lbl-active-pnl-inc-id').load('load_active_pnl.php');
                    $('#lbl-inc-account-id').load('load_distinct_income_account_id.php');
                    $('#tbl_income_account_display').load('load_distinct_income_account_name.php');
                    $('#inc-account').slideDown();
                    $('#new-inc-account-name').focus();
                }else if(e==2){
                    alert('Activate Proft and Loss account first');
                    return false;
                }else if(e==3){
                    alert('Multiple Profit and Loss account detected');
                    return false;
                }
            });
            
            
	});

//Show New Expenditure Account Menu
	$('#a-exp-account').click(function(){ 
            $.post('check_active_ie.php',{},function(e){
                if(e==1){
                    $('.sub-basic-setup-sub').hide();
                    $('#lbl-active-pnl-exp-id').load('load_active_pnl.php');
                    $('#lbl-exp-account-id').load('load_distinct_income_account_id.php');
                    $('#tbl_expenditure_account_display').load('load_distinct_expenditure_account_name.php');
                    $('#exp-account').slideDown();
                    $('#new-exp-account-name').focus();
                }else if(e==2){
                    alert('Activate Proft and Loss account first');
                    return false;
                }else if(e==3){
                    alert('Multiple Profit and Loss account detected');
                    return false;
                }
            });
            
            
	});



//Show Re-Open Transaction Day
	$('#a-reopen-day').click(function(){  
            $('.sub-basic-setup').hide();
            $('#tdate_reopen_date').load('load_reopen_transaction_date.php');
            $('#reopen-day').slideDown();
	});


//Show Student Registration
	$('#a-studentregister').click(function(){  
            $('.sub-basic-setup').hide();
            $('#student-register').slideDown();
	});

//Show Student Assignment
	$('#a-studentassignment').click(function(){  
            $('.main-area-content').hide();
            $('#studentassignment').slideDown();
	});

//Show Attendance Register
	$('#a-attendanceregister').click(function(){  
            $('.main-area-content').hide();
            $('#attendance-register').slideDown();
	});

//Show Mark Register
	$('#a-markregister').click(function(){  
            $('.sub-basic-setup').hide();
            $('#tch-class-assigned').load('load_teacher_class_attendance.php');
            $('#tbl-attendance-book-temp').load('load_attendance_book_temp.php');
            $('#mark-register').slideDown();
        });

//Show Student Mobilization Pmt
	$('#a-std-pmt-posting').click(function(){  
            $('.sub-basic-setup').hide();
            $('#lbl-mob-pmt-rec-no').load('naamu_track.php');
           $('#mob_posting_total_temp').load('load_sub_total_mob_posting.php');
           $('#tbl-mob-posting-temp_view').load('load_mob_postings_temp_view.php');
            $('#tbl-mob-posting-std-sel-temp').load('load_sel_std_mob_posting_temp.php')
            $('#std-mob-posting-pmt-acc-name').load('load_distinct_fee_name.php');
            $('#std-pmt-posting').slideDown();
            $('#txt-std-mob-posting-name').focus();
        });

//Show Mobilization Posting Overs
	$('#a-std-mob-overs').click(function(){  
            $('.sub-basic-setup').hide();
            $('#lbl-mob-pmt-rec-no').load('naamu_track.php');
           $('#mob_posting_total_temp').load('load_sub_total_mob_posting.php');
           $('#tbl-mob-posting-temp_view').load('load_mob_postings_temp_view.php');
            $('#tbl-mob-posting-std-sel-temp').load('load_sel_std_mob_posting_temp.php')
            $('#std-mob-posting-pmt-acc-name').load('load_distinct_fee_name.php');
            $('#std-mob-overs').slideDown();
        });


//Show Mobilization Posting
	$('#a-mob-posting').click(function(){  
            $('.sub-basic-setup').hide();
            $('#mob-posting').slideDown();
        });


//Show Exams Score
	$('#a-exams-score').click(function(){  
            $.post('check_active_coupon.php',{},function(e){
                if(e==1){
                    $('.sub-basic-setup').hide();
                    $('#tbl-std-list-exams-score').load('load_tch-std-list-exams-score.php');
                    $('#undelivered_laund_custname_csh').load('load_exams_score_stud_sel_temp_fname.php');
                    $('#undelivered_laund_telno_csh').load('load_exams_score_stud_sel_temp_classname.php');
                    $('#tbl_sel_exams_score_subject').load('load_sel_exams_score_student_subject.php');
                    $('#lbl-exam-coupon-no').load('load_exam_coupon_no.php');
                    $('#lbl-exam-coupon-title').load('load_exam_coupon_title.php');
                    $('#exams-score').slideDown();
                    $('#txt-std-exams-score_search').focus();
                }else{
                    alert(e);
                }
            });
            
         });


//Show Edit Exams Score
	$('#a-edit-exams-score').click(function(){  
            $('.sub-basic-setup').hide();
            $('#tbl-std-list-edit-exams-score').load('load-std-list-edit-exams-score.php');
            $('#edit_exams_std_fname').load('load_edit_exams_stud_sel_temp_fname.php');
            $('#edit_exams_std_id').load('load_edit_exams_stud_sel_temp_id.php');
            $('#tbl_edit_sel_exams_score_subject').load('load_sel_edit_exams_score_student.php');
            $('#lbl-edit_exam-coupon-no').load('load_exam_coupon_no.php');
            $('#lbl-edit_exam-coupon-title').load('load_exam_coupon_title.php');
            $.post('load_edit_tch_exams_rmks.php',{},function(e){
                 $('#txt-edit_gen-remarks').val(e);
            });
            //$('#txt-edit_gen-remarks').val('load_edit_tch_exams_rmks.php');
            
            $('#edit-exams-score').slideDown();
	});


//Show New User Access
	$('#a-start-user-access').click(function(){  
            $('.sub-basic-setup').hide();
            $('#tbl-start-user-access').load('start_user_access.php');
            $('#start-user-access').slideDown();
	});

//Show Restart User Access
	$('#a-restart-user-access').click(function(){
           
            $('.sub-basic-setup').hide();
            $('#tbl-restart-user-access').load('restart_user_access.php');
            $('#restart-user-access').slideDown();
	});

//Show End User Access
	$('#a-end-user-access').click(function(){  
            $('.sub-basic-setup').hide();
            $('#tbl-end-user-access').load('end_user_access.php');
            $('#end-user-access').slideDown();
	});

$('.sub-menu-ul-div').hide();
$('.tools-sub-menu').hide();

$('.a-menu-tools').click(function(){
  $('.sub-menu-ul-div').slideToggle();
});

$('#csh-change-password').click(function(){
   $('.sub-menu-ul-div').slideUp(); 
});

//Show End Day
	$('#a-end-day').click(function(){  
            $('.sub-basic-setup').hide();
            $('#lbl-active_users').load('active_user_access.php');
             $('#lbl-trans-day').load('check_trans_day.php');
            $('#end-day').slideDown();
	});

//Show New Expenditure Account Menu
	$('#a-expaccount').click(function(){
            $('.sub-basic-setup').hide();
            $('#expaccount').slideDown();
	});

//Show Class Fee Mapping
	$('#a-class-fee-mapping').click(function(){
            $('.sub-basic-setup').hide();
            $('#class-fee-mapping').slideDown();
	});
        
 //Show Receive Other Cash Menu       
       $('#a-bulk-moblz-csh').click(function(){
           $('.progress').remove();
           $('.sub-basic-setup-sub').hide();
           $('#lbl-csh-mob-bulk-rcpt-no').load('naamu_track.php');
           $('#sel-mob-accname-csh').load('load_moblization_account.php');
           $('#bulk-moblz-csh').slideDown();      
       });
  
  //Show Receive Other Cash Menu       
       $('#a-sub-other-cash-csh').click(function(){
           $('.progress').remove();
           $('.sub-basic-setup-sub').hide();
           $('#sel-other-accname-csh').load('load_distinct_ledger_name.php');
           $('#lbl-other-csh-rcpt-no').load('naamu_track.php');
           $('#sub-other-cash-csh').slideDown();      
       });
     
   //Show Receive Income Cash Menu       
       $('#a-sub-other-income-csh').click(function(){
           $('.progress').remove();
           $('.sub-basic-setup-sub').hide();
           $('#sel-other-income-accname-csh').load('load_distinct_income_acc_name.php');
           $('#lbl-other-income-csh-rcpt-no').load('naamu_track.php');
           $('#sub-other-income-csh').slideDown();      
       });
 
    
//Show Admission Fee Setup Menu
        $('#a-admission-fee-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#admitn-fee-mapping-class-acc-name').load('load_distinct_admission_mapping_class.php');
            $('#admitn-fee-mapping-fee-acc-name').load('load_distinct_admission_mapping_fee.php');
            $('#admission-fee-setup').slideDown();
	});

//Show School Fee Mapping Setup Menu
        $('#a-school-fee-mapping').click(function(){
            $('.sub-basic-setup-sub').hide();
//            $('#school-fee-mapped-account').load('school-fee-mapped-account-name.php');
            $('#school-fee-mapping-class-acc-name').load('load_distinct_admission_mapping_class.php');
            $('#school-fee-mapping-fee-acc-name').load('load_distinct_admission_mapping_fee.php');
            $('#school-fee-mapping').slideDown();
	});

//Show Nationality Setup Menu
        $('#a-nationality-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#admitn-fee-mapping-fee-acc-name').load('load_distinct_admission_mapping_fee.php');
            $('#nationality-setup').slideDown();
	});


//Show Student House/Section Menu
        $('#a-student-section-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#student_section_table').load('load_distinct_student_section.php');
            $('#student-section-setup').slideDown();
            $('#txt-section-name').focus();
	});

//Show Class Subject Setup Menu
        $('#a-class-subject-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#class-subject-mapping-class-acc-name').load('load_distinct_admission_mapping_class.php');
            $('#class-subject-mapping-fee-acc-name').load('load_distinct_subject_mapping.php');
            $('#class-subject-setup').slideDown();
	});


//Show School Fee Setup Menu
        $('#a-school-fee-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#school-fee-setup').slideDown();
	});

//Show Other Fee Setup Menu
        $('#a-other-fee-setup').click(function(){
            $('.sub-basic-setup-sub').hide();
            $('#other-fee-setup').slideDown();
	});
     
    
//Click User Setup

	$("#user-setup-btn").click(function(){
		$('.sub-menu-button-wrap').hide();
		$('#user-setup-wrap').slideDown();
		$('.form-button').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		
	});
	
//Click Accounting Legder Setup
	$('#account-ledger-btn').click(function(){
		$('.sub-menu-button-wrap').hide();
		$('#accounting-ledger-wrap').slideDown();
		$('.form-button').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		
	});
	
//Click Stock Imventory Setup
	$('#stock-inventory-btn').click(function(){
		$('.sub-menu-button-wrap').hide();
		$('#stock-setup-wrap').slideDown();
		$('.form-button').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});
	
//New User Account Setup
	$('#new-user-content').click(function(){
		$('.menu-buttons-content').hide();
		$('#user-menu-content').slideDown();
	});
	
//New Stock Category
	$('#new-stock-ctgry-id').click(function(){
		
		$.post('check_new_stock_category_id.php',{},function(ansa){
			$('#lbl-stock-ctgr-id').text(ansa);
		});
		
		$('.menu-buttons-content').hide();
		$('#new-stock-category-content').slideDown();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});
	
//New Stock Manager
	$('#new-stock-manager-id').click(function(){
		
		var mycode = "STM-";
		
		$.post('check_stock_manager_id.php',{},function(ansa){
			$('#lbl-manager-id-ref').text(ansa);
			$('#lbl-stock-manager-id').text(mycode+ansa);
		});
		
		$('.menu-buttons-content').hide();
		$('#new-stock-manager-content').slideDown();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});

//New Stock Item
	$('#new-stock-item-id').click(function(){
		
		var RefID = $('#lbl-stock-item-id').text();
		var stName = "UBP-";
		
		if(RefID ==""){
				$.post('check_stock_item_id.php',{},function(ansa){
				$('#lbl-stock-item-id').text(stName+ansa);
			});
		}else{
			
		}
		
		
		$('.menu-buttons-content').hide();
		$('#new-stock-item-content').slideDown();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});
//Stock Creditor
	$('#new-stock-creditor-id').click(function(){
		
		$('.form-text').val("");
		$.post("check_new_stock_creditor.php",{},function(ansa){
			$('#lbl-stock-creditor-id').text("CRDT-"+ansa);
			$('#temp-creditor-id').text(ansa);
		});
		
		$('.menu-buttons-content').hide();
		$('#new-stock-creditor').slideDown();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});	

//Stock Debtor
	$('#new-stock-debtor-id').click(function(){
		
		$('.form-text').val("");
		$.post("check_new_stock_debtor.php",{},function(ansa){
			$('#lbl-stock-debtor-id').text("DBTR-"+ansa);
			$('#temp-debtor-id').text(ansa);
		});
		
		$('.menu-buttons-content').hide();
		$('#new-stock-debtor').slideDown();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
	});	

//Select Receive Stock Into Warehouse
	$('#btn-warehouse-dr').click(function(){
		
			//alert("about to load table");
			//$.post('check_load_items_warehouse-dr.php',{},function(ansa){
				//$('#tbl-dr-warehouse-stock').html(ansa);
			//});
			
			$('#tbl-dr-warehouse-stock').load('check_load_items_warehouse-dr.php');
			
			$('#tbl-selected-whouse-dr-item').load('check_select_wrhouse-dr-items.php');
			
			$('#tbl-selected-dr-item').load('check_selected_drug_details.php');
			
			$('#stock-category-names').load("call_stock_category_list0.php");
			
			$.post('naamu_track.php',{},function(ansa){
				
				$('#lbl-receipt-no').text(ansa);
			});
	
		$('.sub-menu-button-stock-movement').hide();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		$('#warehouse-dr-wrap').slideDown();
		
	});

//Select Trf Stock To Retail Market
	$('#btn-retail-dr').click(function(){
		$('.sub-menu-button-stock-movement').hide();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		$('#retail-dr-wrap').slideDown();
		
	});

//Select Trf Stock To Wholesale Market
	$('#btn-wholesale-dr').click(function(){
		
		$('#stock-debtor-list').load('check_debtor_list.php');
		$('#tbl-warehouse-stock').load('load_wrhouse_av_stock.php');
		//alert('Nothing happens');
		
		$('#tbl-selected-whsale-dr-items').load('load_whsale_selected_item_temp.php');
		$('#tbl-selected-whosale-dr-item').load('tbl_load_whsale_invoice_sel_items.php');
		
		
		$.post('naamu_track.php',{},function(ansa){
					
					$('#lbl-receipt-no-whsale').text(ansa);
			});
				
			
		$('.sub-menu-button-stock-movement').hide();
		$('.stock-setup-1').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		$('#wholesale-dr-wrap').slideDown();
		
	});
	
	$('.table-item-data:even').css('background-color','#dddddd');
	
	$('.table-item-data').click(function(){
		
	});
	
//Stock Stock Item

	$('#txt-item-wrhouse-name').keyup(function(){
		
		var itemName = $.trim($('#txt-item-wrhouse-name').val());
		
		$.post('search_stock_name-wrhouse.php',{ItemName:itemName},function(ansa){
			$('#tbl-dr-warehouse-stock').html(ansa);
		});
	});
	
	
//Click Cash Sales Transaction

	$("#sales-trn-btn").click(function(){
		$('.sub-menu-button-wrap').hide();
		$('#cash-sales-wrap').slideDown();
		$('.form-button').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		
	});
	
//Click Cash Sales Transaction

	$("#chq-sales-trn-btn").click(function(){
		$('.sub-menu-button-wrap').hide();
		$('#cheque-sales-wrap').slideDown();
		$('.form-button').css('backgroundColor', '');
		$(this).css('backgroundColor', 'orange');
		
	});

    
$('.admin-tools-menu-wrap').hide();


//Upload Student Picture
$('#btn-upload-std-pix').click(function(){
    window.open("upload-student-picture.php","My window", "scrollbars=1,width=1300, height=1000,titlebar=yes");
});

//______________________________________________________________

 setInterval(function(){
     
    $('#alert-transaction').load('alert-transaction.php');
    
        }, 15000);

$('#alert-transaction').load('alert-transaction.php');

//______________________________________________________________

 setInterval(function(){
     
    $('#alert-std-arrears-write-off').load('alert-std-arrears-write-off.php');
    
        }, 15000);

$('#alert-std-arrears-write-off').load('alert-std-arrears-write-off.php');


//______________________________________________________________

 setInterval(function(){
     
    $('#alert-std-bill').load('alert-std-billing.php');
    
        }, 15000);

$('#alert-std-bill').load('alert-std-billing.php');



//______________________________________________________________

 setInterval(function(){
     
    $('#alert-mob-postings').load('mob-postings-alert.php');
    
        }, 15000);

$('#alert-mob-postings').load('mob-postings-alert.php');


//______________________________________________________________

 setInterval(function(){
     
    $('#alert-student-edit').load('student-edit-alert.php');
    
        }, 15000);

$('#alert-student-edit').load('student-edit-alert.php');

//______________________________________________________________

 setInterval(function(){
     
    $('#alert-student-deact').load('student_account_deact_alert.php');
    
        }, 15000);

$('#alert-student-deact').load('student_account_deact_alert.php');


//______________________________________________________________
 setInterval(function(){
     
    $('#alert-student-registration').load('new_student_alert.php');
    
        }, 30000);

$('#alert-student-registration').load('new_student_alert.php');


//_______________________________________________________________________
 setInterval(function(){
     
    $('#alert-exams-record').load('academic_exams_alert.php');
    
        }, 15000);

$('#alert-exams-record').load('academic_exams_alert.php');


//______________________________________________________________

//-------------------------------------------------
 setInterval(function(){
     
    $('#alert-stock-threshold').load('stock_threshold_alert.php');
    
        }, 15000);

$('#alert-stock-threshold').load('stock_threshold_alert.php');


//-------------------------------------------------
 setInterval(function(){
     
    $('#alert-academic-promo').load('alert_new_promotion.php');
    
        }, 15000);

$('#alert-academic-promo').load('alert_new_promotion.php');

//______________________________________________________________

 setInterval(function(){
     
    $('#alert-student-react').load('student_account_react_alert.php');
    
        }, 15000);

$('#alert-student-react').load('student_account_react_alert.php');


//-------------------------------------------------
// setInterval(function(){
     
  //  $('#alert-birthday').load('alert-birthday.php');
    
  //      }, 15000);

//$('#alert-birthday').load('alert-birthday.php');


 setInterval(function(){
     
    $('#alert-tch-attendance').load('alert_teacher_register_marking.php');
    
        }, 15000);

$('#alert-tch-attendance').load('alert_teacher_register_marking.php');

//

 setInterval(function(){
     
    $('#alert-daily-arrears-write-off').load('alert_daily_arrears_write_off.php');
    
        }, 15000);

$('#alert-daily-arrears-write-off').load('alert_daily_arrears_write_off.php');
//

//Search Student Info
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
      
        case '':
            event.preventDefault();
            window.open("student_search.php","My window","width=800, height=1000,titlebar=yes");
            break;
        }
    }
});

$('#csh-change-password').click(function(){
     window.open("change_passwordx_no.php","My window","width=400, height=400,titlebar=yes");
});

$('#search-student-pg').click(function(){
     window.open("student_search.php","My window","width=1000, height=1000,titlebar=yes");
});

$('#student-vouvher-pg').click(function(){
     window.open("receipt-search-center.php","My window","width=1000, height=1000,titlebar=yes");
});

$('#issue-student-accessories-pg').click(function(){
     window.open("issue-unifrom-stationery.php","My window","width=1000, height=1000,titlebar=yes");
});


document.onkeydown=function(e){
    if(e.which==18){
       return false;
    }
}

$('#').click(function(){
    
});


//Show Student Accoun Tools
$('#a-student-acc-tools').click(function(){
    $.post('check_user_edit_priviledge.php',{},function(e){
        if(e==1){
            $('.sub-basic-setup').hide();
            $('#student-acc-tools').slideDown();
        }else{
            alert('Access Denied');
            return false;
        }
    })
});


$('#a-student-acc-tools-deact').click(function(){
    $.post('check_user_edit_priviledge.php',{},function(e){
        if(e==1){
            $('.sub-basic-setup-sub').hide();
            $('#student-acc-tools-deact').slideDown();
            $('#txt-std-account-tools').val('');
             $('#txt-std-account-tools').focus();
        }else{
            alert('Access Denied');
            return false;
        }
    })
});

$('#a-student-acc-tools-react').click(function(){
    $.post('check_user_edit_priviledge.php',{},function(e){
        if(e==1){
            $('.sub-basic-setup-sub').hide();
            $('#student-acc-tools-react').slideDown();
            $('#txt-std-account-tools').val('');
             $('#txt-std-account-tools-react').focus();
        }else{
            alert('Access Denied');
            return false;
        }
    })
});

});

