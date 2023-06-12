$(function(){
    //alert('whose');
    $('#crt-New-Class').click(function(){
        var classcatID =  $('#class-category-name :selected').attr('id');
        var className = $.trim($('#txt-class-name').val());
        var classcatName = $('#class-category-name').val();
        
        if(classcatName==''){
            alert("Select Class Category Name");
            $('#class-category-name').setfocus();
        }else if(className==''){
            alert('Enter Classroom Name');
            $.trim($('#txt-class-name').focus());
        }else{
            $.post('newclass.php',{ClassID:classcatID, ClassName:className},function(ansa){
               if(ansa==1){
                   alert("Class created successfully");
                   $('#txt-class-name').val('');
                   $.trim($('#txt-class-name').focus());
                  // $('#class-category-name').val('');
               }else{
                   alert(ansa);
               }
            });
        }
    });
    
   $('#crt-New-Teacher').click(function(){
      var TFName=$.trim($('#tch-fname').val());
      var TTelNo=$.trim($('#tch-telno').val());
      var TGender=$.trim($('#tch-gender').val());
      var TDOB=$.trim($('#tch-dob').val());
      var TAddress=$.trim($('#tch-address').val());
      var TSchAttnd=$.trim($('#tch-schattnd').val());
      var TQlf=$.trim($('#tch-qlf').val());
      var TRef=$.trim($('#tch-ref').val());
      var TClassID=$('#tch-class-name :selected').attr('id');
      var TClassName =$('#tch-class-name').val();
      var Branch=$('#tch-branch-name :selected').attr('id');
      
      if(TFName==''){
          alert("Enter Teacher's Full Name");
          $.trim($('#tch-fname').focus());
      }else if(TDOB==''){
          alert("Select Teacher's date of birth");
          $.trim($('#tch-dob').focus());
      }else if(TAddress==''){
          alert("Enter Teacher's Residence or Postal Address");
          $.trim($('#tch-address').focus());
      }else if(TGender==''){
          alert("Select Teacher's Gender");
          $.trim($('#tch-gender').focus());
          return false;
      }else if(TTelNo==''){
          alert("Enter Teacher's Telephone Number");
          $.trim($('#tch-telno').focus());
          return false; 
      }else if(TSchAttnd==''){
          alert("Enter Teacher's Last School Attended");
          $.trim($('#tch-schattnd').focus());
      }else if(TQlf==''){
          alert("Enter Teacher's Qualification");
          $.trim($('#tch-qlf').focus());
      }else if(TRef==''){
          alert("Enter Teacher's Referee Name");
          $.trim($('#tch-ref').focus());
      }else if(TClassID==''){
          alert("Select Class Assigned for our Teacher");
          $.trim(('#tch-class_name').focus());
      }else if(TClassName==''){
          alert("Select Class Assigned for the Teacher");
                  $.trim($('#tch-class_name').focus());
      }else if(Branch==''){
          alert("Select Branch Name");
          $('#tch-branch-name').focus();
      }else{
          
          $.post('newteacher.php',{TFName:TFName, Branch:Branch,TTelNo:TTelNo,TGender:TGender, TDOB:TDOB, TAddress:TAddress, TSchAttnd:TSchAttnd, TQlf:TQlf,TClassID:TClassID,TRef:TRef},function(ansa){
              if(ansa==1){
                  alert("New teacher info saved successfully");
                  $('.form-text').val('');
                  $('#tch-fname').focus();
              }else{
                  alert(ansa);
              }
          });
      }
   });
   
   $('#crt-new-income').click(function(){
     var Acc_name=$.trim($('#txt-income-name').val());
     
     if(Acc_name==''){
         alert("Enter income account name");
         $('#txt-income-name').focus();
         return false;
     }else{
         $.post('new_curricular_activity.php',{AccName:Acc_name},function(ansa){
             alert(ansa);
         });
     }
   });
  
   
     
   $('#crt-new-student').click(function(){
      var STDFName=$.trim($('#std-fname').val());
      var STDID=$.trim($('#lb-student-id').text());
      var Gender=$('#std-gender :selected').val();
      var STDDOB=$.trim($('#std-dob').val());
      var STDAddress=$.trim($('#std-address').val());
      var STDSchAttnd=$.trim($('#std-schattnd').val());
      var STDParent=$.trim($('#std-parent').val());
      var STDPhone=$.trim($('#std-phone').val());
      var STDLoc=$.trim($('#std-location').val());
      var STDClassID=$('#std-class-name :selected').attr('id');
      var STDClassName =$('#std-class-name').val();
      var RecNo=$.trim($('#lbl-student-adm-recpt-no').text());
      var RecID=$.trim($('#lbl-admitn-rcpt-id').text());
      var Nt=$('#std-nationale :selected').attr('id');
      var Prf=$.trim($('#std-parent-prf').val());
      var Zips=$.trim($('#std-zip').val());
      var SID=$.trim($('#lb-student-code').text());
      var Relg=$.trim($('#std-religion :selected').attr('id'));
      var Trpt=$.trim($('#std-transport-means :selected').attr('id'));
      var Section=$.trim($('#std-section :selected').attr('id'));
       
      if(STDFName==''){
          alert("Enter Student's Full Name");
          $($('#std-fname').focus());
          return false;
      }else if(STDID==''){
          alert('Failure Generating Student ID');
          return false;
      }else if(SID==''){
          alert('Failure Generating Student ID')
          return false;
      }else if(STDDOB==''){
          alert("Select Student's date of birth");
          ($('#std-dob').focus());
          return false;
      }else if(STDAddress==''){
          alert("Enter Student's Residence or Postal Address");
          ($('#std-address').focus());
          return false;
      }else if(STDSchAttnd==''){
          alert("Enter Student's Last School Attended");
         ($('#std-schattnd').focus());
          return false;
      }else if(STDParent==''){
          alert("Enter Parent/ Guardian's Full Name");
          ($('#std-parent').focus());
          return false;
      }else if(Zips==''){
           alert("Enter Country\'s ZIP Code");
          ($('#std-zip').focus());
          return false;
      }else if(Zips=='0' || Zips=='00' || Zips=='000'){
           alert("ZIP Code cannot be zero(0)");
          ($('#std-phone').focus());
          return false;
      }else if(STDPhone==''){
          alert("Enter Parent/ Guardian's Phone No.");
          ($('#std-phone').focus());
          return false;
      }else if(STDLoc==''){
          alert("Enter student's location or pick-up point");
          ($('#std-location').focus());
          return false;
      }else if(Section=='0' || Section==''){
          alert('Select Section');
          $('#std-section').focus();
          return false;
      }else if(STDClassID==''){
          alert("Select Class Admitted");
          ($('#std-class_name').focus());
          return false;
      }else if(RecNo==''){
          alert("Receipt No not found");
          return false;
      }else if(STDClassName==''){
          alert("Select Class Admitted");
          ($('#std-class_name').focus());
          return false;
      }else if(Gender==''){
          alert('Select Student Gender');
          $('#std-gender').focus();
          return false;
      }else if(Relg==''){
           alert('Select Student Religion');
          $('#std-religion').focus();
          return false;
      }else if(Nt=='' || Nt=='0'){
          alert('Select Student\'s Nationality');
          $('#std-nationale').focus();
          return false;
      }else if(Prf==''){
          alert('Specify Parent/Guandian\'s Profession');
          $('#std-parent-prf').focus();
          return false;
      }else if(Trpt=='0' || Trpt==''){
          alert('Select student\'s means of transport');
          $('#std-transport-means').focus();
          return false;
      }else{
        $('body').append('<div class="progress">Processing...</div>');  
          $.post('newtualib.php',{STDID:STDID,RecID:RecID,SID:SID,Relg:Relg,Section:Section,Trpt:Trpt,RecNo:RecNo,Zip:Zips,FName:STDFName,Nt:Nt,Prf:Prf,Gender:Gender, DOB:STDDOB, Address:STDAddress, SchAttnd:STDSchAttnd,Phone:STDPhone, Parent:STDParent,ClassID:STDClassID,Loc:STDLoc},function(ansa){
              if(ansa==1){
                  alert("New student info saved successfully");
                  
                  $.post('assign_new_student_id.php',{},function(e){
                    // alert(Class);
                      // alert(e);
                        $('#lb-student-id').text(e); 
                     });
                     
                     $.post('get_id_student.php',{},function(e){
                        // alert(e);
                         $('#lb-student-code').text(e);
                     });
                     
                $('#tbl-admitn-sel-class-fee-account').load('load_class_new_admitn_fee.php');
                $('#lbl-admitn-total-fee-temp').load('load_admission_total_fee_temp.php');
                $('#tbl-admitn-sel-class-fee-account').load('load_class_new_admitn_fee.php');
                $('#lbl-student-adm-recpt-no').load('naamu_track.php');
                $('#lbl-admitn-rcpt-id').load('naamu_track_id.php');
                $('.form-text').val('');
                $('#std-fname').focus();
                $('.progress').remove();
                
                 var q=confirm('Issue uniform to '+STDFName+' ?');
                
                if(q){
                   $.post('issue_uniform_admission_std.php',{SFName:STDFName},function(ansa){
                        //  $('#shw-daily-mob').html(ansa); 
                        //alert(AccountID);
                      var newWindow = window.open("", "issue-unifrom-stationery.php", "scrollbars=1,width=1250, height=1000");

                       //write the data to the document of the newWindow
                        newWindow.document.body.innerHTML=(ansa);
            
                    });
                }else{
                    
                }
               
              }else{
                  $('progress').remove();
                  alert(ansa);
                  
              }
          });
      }
   });

    
  $('#crt-new-student-tch').click(function(){
      var STDFName=$.trim($('#std-fname').val());
      var STDDOB=$.trim($('#std-dob').val());
      var STDAddress=$.trim($('#std-address').val());
      var STDSchAttnd=$.trim($('#std-schattnd').val());
      var STDParent=$.trim($('#std-parent').val());
      var STDPhone=$.trim($('#std-phone').val());
      var STDLoc=$.trim($('#std-location').val());
      var STDClassID=$('#std-class-name-tch :selected').attr('id');
      var STDClassName =$('#std-class-name-tch').val();
      
      
      if(STDFName==''){
          alert("Enter Student's Full Name");
          $.trim($('#std-fname').focus());
      }else if(STDDOB==''){
          alert("Select Student's date of birth");
          $.trim($('#std-dob').focus());
      }else if(STDAddress==''){
          alert("Enter Student's Residence or Postal Address");
          $.trim($('#std-address').focus());
      }else if(STDSchAttnd==''){
          alert("Enter Student's Last School Attended");
          $.trim($('#std-schattnd').focus());
      }else if(STDParent==''){
          alert("Enter Parent/ Guardian's Full Name");
          $.trim($('#std-parent').focus());
      }else if(STDPhone==''){
          alert("Enter Parent/ Guardian's Phone No.");
          $.trim($('#std-phone').focus());
      }else if(STDLoc==''){
          alert("Enter student's location or pick-up point");
          $.trim($('#std-location').focus());
      }else if(STDClassID==''){
          alert("Select Class Admitted");
          $.trim(('#std-class_name').focus());
      }else if(STDClassName==''){
          alert("Select Class Admitted");
                  $.trim($('#std-class_name').focus());
      }else{
          //alert("muje");
          $.post('newtualib.php',{FName:STDFName, DOB:STDDOB, Address:STDAddress, SchAttnd:STDSchAttnd,Phone:STDPhone, Parent:STDParent,ClassID:STDClassID,Loc:STDLoc},function(ansa){
              if(ansa==1){
                  alert("New student info saved successfully");
                  $('.form-text').val('');
                  $('#tch-fname').focus();
              }else{
                  alert(ansa);
              }
          });
      }
   });
    
    
    
$('#process-student-bill').click(function(){
   var ClassID = $('#schfee-bill-accname :selected').attr('id');
   var ClassName=$('#schfee-bill-accname').val();
    
    if(ClassName=='na'){
        alert('Select class from the list');
        $('#schfee-bill-accname').focus();
    }else{
            $('body').append('<div class="progress">Processing...</div>');
        $.post('student_list_add_temp.php',{ClassID:ClassID,ClassName:ClassName},function(ansa){
          if(ansa==1){
              $('.progress').remove();
              alert("Select class from the list");
          }else if(ansa==2){
              $('.progress').remove();
              alert("No student record found");
          }else if(ansa==3){
              $('.progress').remove();
              alert("Operation already in process");
          }else{
              $('.progress').remove();
              $('#tbl_studentlist').load('studentlist_bill_temp.php');
               $('#bill_account_details').load('bill_account_details.php');
          }
         });  
    }
 
});
   
$('#rmv-all-student-bill').click(function(){
    
    que=confirm("Remove all student(s) from the list?");
    
    if(que){
        
        $.post('remove_bill_list_temp.php',{},function(ansa){
            if(ansa==1){

                $('#schfee-bill-accname').load('schoolbilllist.php');
                $('#tbl_studentlist').load('studentlist_bill_temp.php');
                $('#bill_account_details').load('bill_account_details.php');
                $('#lbl-bill-receipt-no').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });
    
    }
        
    });
    
   $('#crt-bill-student').click(function(){
       
       var ReceiptNo = $.trim($('#lbl-bill-receipt-no').text());
       var RID = $.trim($('#lbl-bill-receipt-id').text());
       var Description=$.trim($('#txt-bill-student-descr').val());
       var NB=$.trim($('#txt-bill-student-nb').val());
       //alert(ReceiptNo+Description);
       
       if(Description==''){
           alert('Enter description for the billing')
           $('#txt-bill-student-descr').focus();
           
       }else if(ReceiptNo==''){
           alert("Receipt number not generated. Contact your system adminstrator");
           
       }else if(RID==''){
           alert("Receipt ID not generated. Contact your system adminstrator");
           
       }else{
            $('body').append('<div class="progress">Processing...</div>');
           $.post('run_student_bill.php',{ReceiptNo:ReceiptNo,Description:Description,NB:NB,RID:RID},function(ansa){
               if(ansa==1){
                   $('.progress').remove();
                   alert("Receipt number not yet generated. Contact your system administrator");
               }else if(ansa==2){
                   $('.progress').remove();
                   alert("Enter description for billing students");
               }else if(ansa==3){
                   $('.progress').remove();
                   alert("Records not found or Bill Account not yet configured");
               }else{
                   $('.progress').remove();
                 $('#schfee-bill-accname').load('schoolbilllist.php');
                $('#tbl_studentlist').load('studentlist_bill_temp.php');
                $('#bill_account_details').load('bill_account_details.php');
                $('#lbl-bill-receipt-id').load('naamu_track_id.php');
                $('#lbl-bill-receipt-no').load('naamu_track.php');   
                $('#txt-bill-student-descr').val('');
               }
           });
       }
   });
   
   $('#tbl-search-student_fee-rcv').keyup(function(){
      var StudentName = $.trim($('#tbl-search-student_fee-rcv').val());
	
        $.post('search_student_outstanding_fee_list.php',{StudentName:StudentName},function(ansa){
            $('#tbl-rcv-sch-fee-student-list').html(ansa);
        });
		
   });
   
 
 $('#tbl-search-stock-std-list').keyup(function(){
      var StudentName = $.trim($('#tbl-search-stock-std-list').val());
	
        $.post('load_stock_student_list_search.php',{StudentName:StudentName},function(ansa){
            $('#tbl-cash-stock-sales-list').html(ansa);
        });
		
   });    
    
   $('#tbl-search-student_fee-rcv-ind').keyup(function(){
      var StudentName = $.trim($('#tbl-search-student_fee-rcv-ind').val());
	
        $.post('search_student_bill_ind_list.php',{StudentName:StudentName},function(ansa){
            $('#tbl-rcv-sch-fee-student-list').html(ansa);
        });
		
   });
   
   
   
 $('#undo-student-selection-rcv-fee').click(function(){
     $.post('undo_student_selection_fee_rcv.php',{},function(){
         $('#tbl-rcv-sch-fee-student-details').load('student_fee_details_temp.php');
       $('#csh-total-out-fee-sel').load('load_sel_student_temp_rcv_total.php');
     });
 });
 
  
 $('#undo-student-selection-bill-ind').click(function(){ 
     $.post('undo_student_sel_bill_ind_temp.php',{},function(){
         $('#tbl-rcv-sch-fee-student-details').load('student_fee_ind_bill_temp.php');
     });
 });
    
    
 $('#csh-undo-rcv-other-fee-temp-list').click(function(){
     
     $.post('csh_undo_sel_student_rcv_fee_temp.php',{},function(ansa){
         alert(ansa);
         $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
     });
 });
 
 
   
 $('#undo-student-sttmt-selection').click(function(){
     $.post('undo_student_sttmnt_select.php',{},function(){
         $('#tbl-rpt-student-sttmnt').load('student_statement_search_temp.php')
     });
 });
 
  
 
 $('#sel-student-fee-accname').focus(function(){
    $('#sel-student-fee-accname').load('load_sel_student_fee_accname_rcv.php');
 });
 
 $('#crt-sch-fee-paid').click(function(){
    var AccountNo = $('#sel-student-fee-accname :selected').attr('id');
    var Naration = $.trim($('#txt-sch-fee-paid-nrt').val());
    var Amount =$.trim($('#txt-sch-fee-paid').val());
    var AccountName = $.trim($('#sel-student-fee-accname').val());
    var RcptNo = $('#lbl-paid-sch-fee-receipt-no').text();
    
    if(AccountNo=='0'){
        alert("Please select fee account");
        $('#sel-student-fee-accname').focus();
        return false;
    }else if(AccountName ==''){
        alert("Please select fee account");
        $('#sel-student-fee-accname').focus();
        return false;
    }else if(Amount==''){
        alert("Enter the amount paid");
        $('#txt-sch-fee-paid').focus();
        return false;
    }else if(Naration==''){
        alert("Enter the narration for amount paid");
        $('#txt-sch-fee-paid-nrt').focus();
        return false;
    }else if(RcptNo==''){
        alert('Receipt number not generated');
        return false;
    }else{
        $.post('student_sch_fee_pmt_run.php',{AccountNo:AccountNo, Amount:Amount,Naration:Naration,RcptNo:RcptNo},function(ansa){
           if(ansa=='1'){
               alert("Payment saved successfully");
               $('.form-text').val('');
                $('#tbl-rcv-sch-fee-student-list').load('student_outstanding_fee_list.php');
                $('#tbl-rcv-sch-fee-student-details').load('student_fee_details_temp.php');
                $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
           }else{
               alert(ansa);
           }
        });
    }
 });
 
 
 $('#crt-sch-fee-paid-csh').click(function(){
    var Naration = $.trim($('#txt-sch-fee-paid-nrt').val());
    var Amount =$.trim($('#txt-sch-fee-paid').val());
    var RcptNo = $.trim($('#lbl-paid-sch-fee-receipt-no').text());
    
     if(Amount==''){
        alert("Enter the amount paid");
        $('#txt-sch-fee-paid').focus();
        return false;
    }else if(Naration==''){
        alert("Enter the narration for amount paid");
        $('#txt-sch-fee-paid-nrt').focus();
        return false;
    }else if(RcptNo==''){
        alert('Receipt number not generated');
        return false;
    }else{
    $('body').append('<div class="progress">Processing...</div>');
        $.post('csh_student_sch_fee_pmt_run.php',{ Amount:Amount,Naration:Naration,RcptNo:RcptNo},function(e){
            if(e==2){
                alert("Amount paid is not valid");
                $('.progress').remove();
            }else if(e==3){
                alert("Amount paid must be more than zero(0)");
                $('.progress').remove();
            }else if(e==4){
             alert("Invalid receipt number");   
             $('.progress').remove();
            }else if(e==5){
                alert('Enter narration for amount paid');
                $('.progress').remove();
            }else if(e==6){
                alert('Cannot overpay outstanding balance');
                $('.progress').remove();
            }else{    
                $('.progress').remove();
               alert("Payment saved successfully");
               $('#cashbook').load('load_cashbook_balance.php');
               $('.form-text').val('');
                $('#tbl-rcv-sch-fee-student-list').load('student_outstanding_fee_list.php');
                $('#tbl-rcv-sch-fee-student-details').load('student_fee_details_temp.php');
                $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
                $('#cashbook').load('load_cashbook_balance.php');
                $('#csh-total-out-fee-sel').load('load_sel_student_temp_rcv_total.php');
                $.post('school-fee-receipt.php',{e:RcptNo},function(em){
                      var newWindow = window.open("", "school-fee-receipt.php", "scrollbars=1,width=1300, height=1000");
                     // window.print(e);
                    //write the data to the document of the newWindow
                     newWindow.document.body.innerHTML=(em);

                 }); 
                 $('#tbl-search-student_fee-rcv').focus();
           }
        });
    }
 });
 
 
 
 $('#process-rcv-other-fee').click(function(){
    var ClassID = $('#rcv-other-fee-accname :selected').attr('id');
    var ClassName=$('#rcv-other-fee-accname').val();
    
    if(ClassID=='0'){
        alert('Select Class');
        $('#rcv-other-fee-accname').focus();
        return false;
    }else if(ClassName==''){
        alert('Select Class');
        $('#rcv-other-fee-accname').focus();
        return false;
    }else{
        $.post('load_class_rcv_other_fee_temp.php',{ClassID:ClassID,ClassName:ClassName},function(ansa){
           
          if(ansa==1){
              alert("Operation already in process. Try later");
          }else if(ansa==2){
              alert("Class details not found");
          }else if(ansa==3){
              alert("Error process student billing. Contact your system administrator");
          }else{
               $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
          }
        });
    }
 });
 
 
  $('#process-rcv-other-fee-csh').click(function(){
    var ClassID = $('#rcv-other-fee-classname :selected').attr('id');
    var FeesID = $('#rcv-other-fee-accname-csh :selected').attr('id');
    var ClassName=$('#rcv-other-fee-classname').val();
    var FeesName = $('#rcv-other-fee-accname-csh').val();
    
    if(ClassID=='0'){
        alert('Select Class');
        $('#rcv-other-fee-classname').focus();
        return false;
    }else if(ClassName==''){
        alert('Select Class');
        $('#rcv-other-fee-classname').focus();
        return false;
    }else if(FeesID=='0'){
        alert('Select Fee Account');
        $('#rcv-other-fee-accname-csh').focus();
        return false;
    }else if(FeesName==''){
        alert('Select Fee Account');
        $('#rcv-other-fee-accname-csh').focus();
        return false;
    }else{
        $.post('csh-load_class_rcv_other_fee_temp.php',{ClassID:ClassID,ClassName:ClassName, FeesID:FeesID, FeesName:FeesName},function(ansa){
           
          if(ansa==1){
              alert("Operation already in process. Try later");
          }else if(ansa==2){
              alert("Class details not found");
          }else if(ansa==3){
              alert("Error process student billing. Contact your system administrator");
          }else{
               $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
              
          }
        });
    }
 });
 
 
 
 $('#rmv-rcv-other-fee-temp-list').click(function(){
     $.post('#remove_sel_other_fee_student_temp',{},function(){
         
     });
 });
 
 $('#btn-rcv-other-trnspt').click(function(){
    
     var RcptNo=$('#lbl-other-fee-receipt-no').text();
     var Nrt=$.trim($('#txt-other-fee-paid-nrt').val());
     
    if(RcptNo==''){
        alert('Receipt number not generated. Contact your system administrator');
        return false;
    }else if(Nrt==''){
        alert('Enter payment description/ narration')
        $('#txt-other-fee-paid-nrt').focus();
        return false;
    }else{
        $.post('rcv_other_fee_payment.php',{RecNo:RcptNo,Nrt:Nrt},function(ansa){
            if(ansa==1){
                alert("Enter payment description");
                return false;
            }else if(ansa==2){
                alert("Receipt number not yet generated");
                return false;
            }else if(ansa==3){
                alert("Records not found or amount paid MUST be more than zeros");
                return false;
            }else{
               $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
               $('#lbl-other-fee-receipt-no').load('naamu_track.php');
            }
        });
    }
     
 });
 
 
  $('#btn-rcv-other-fee-csh').click(function(){
    
     var RcptNo=$.trim($('#lbl-other-fee-receipt-no').text());
     var Nrt=$.trim($('#txt-other-fee-paid-nrt').val());
     
    if(RcptNo==''){
        alert('Receipt number not generated. Contact your system administrator');
        return false;
    }else if(Nrt==''){
        alert('Enter payment description/ narration')
        $('#txt-other-fee-paid-nrt').focus();
        return false;
    }else{
        $.post('csh_rcv_other_fee_payment.php',{RecNo:RcptNo,Nrt:Nrt},function(ansa){
            if(ansa==1){
                alert("Enter payment description");
                return false;
            }else if(ansa==2){
                alert("Receipt number not yet generated");
                return false;
            }else if(ansa==3){
                alert("Records not found or amount paid MUST be more than zero");
                return false;
            }else{
               $('#tbl-other-fee-rcv-temp').load('load_other_fee_class_temp.php');
               $('#lbl-other-fee-receipt-no').load('naamu_track.php');
                $('#cashbook').load('load_cashbook_balance.php');
               $('.form-text-wrap').val('');
               $('.form-text').val('');
               $('#rcv-other-fee-accname-csh').val('');
            }
        });
    }
     
 });
 
 $('#cashbook').load('load_cashbook_balance.php');
 
 $('#teacher-active-class').load('load_teacher_class_assigned.php');
 
 $('#active-mob-account').load('load_active_mob_account.php');
 
 $('#crt-exp-csh').click(function(){
    var AccNo = $('#sel-expenditure-accname :selected').attr('id');
    var AccName= $('#sel-expenditure-accname').val();
    var Descr = $.trim($('#txt-exp-nrt').val());
    var RcptNo = $.trim($('#lbl-expenditure-rcpt-no').text());
    var Amt = $.trim($('#txt-exp-amount').val());
    
    if(AccNo=='0'){
        alert('Select Expenditure Account');
        $('#sel-expenditure-accname').focus();
        return false;
    }else if(AccName==''){
        alert('Select Expenditure Account');
        $('#sel-expenditure-accname').focus();
        return false;
    }else if(Amt==''){
        alert('Enter Expenditure Amount');
      $('#txt-exp-amount').focus();
      return false;
    }else if(Amt<='0'){
        alert('Expenditure Amount MUST be less than zero');
      $('#txt-exp-amount').focus();
      return false; 
    }else if(Descr==''){
        alert('Enter Expenditure Dscription');
      $('#txt-exp-nrt').focus();
      return false; 
    }else if(RcptNo==''){
        alert('Receipt Number  Not Generated. Contact Your System Administrator');
      return false;  
    }else{
        $.post('run_expenditure_payment.php',{AccNo:AccNo, AccName:AccName,Amt:Amt,Descr:Descr,RcptNo:RcptNo},function(ansa){
            if(ansa==1){
                alert('Transaction saved successfully');
                $('.form-text').val('');
                $('#lbl-csh-expense-ac').load('check_cash_ifo_expenditure.php');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-expenditure-rcpt-no').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });        
    }
 });
 
//----------------------------------------------

 $('#crt-exp-csh-cshbk').click(function(){
    var AccNo = $('#sel-expenditure-accname-cshbook :selected').attr('id');
    var AccName= $('#sel-expenditure-accname-cshbook').val();
    var Descr = $.trim($('#txt-exp-nrt-cshbk').val());
    var RcptNo = $.trim($('#lbl-expenditure-rcpt-no-cshbk').text());
    var Amt = $.trim($('#txt-exp-amount-cshbk').val());
    
    if(AccNo=='0'){
        alert('Select Expenditure Account');
        $('#sel-expenditure-accname-cshbook').focus();
        return false;
    }else if(AccName==''){
        alert('Select Expenditure Account');
        $('#sel-expenditure-accname-cshbook').focus();
        return false;
    }else if(Amt==''){
        alert('Enter Expenditure Amount');
      $('#txt-exp-amount-cshbk').focus();
      return false;
    }else if(Amt<='0'){
        alert('Expenditure Amount MUST be less than zero');
      $('#txt-exp-amount-cshbk').focus();
      return false; 
    }else if(Descr==''){
        alert('Enter Expenditure Dscription');
      $('#txt-exp-nrt-cshbk').focus();
      return false; 
    }else if(RcptNo==''){
        alert('Receipt Number  Not Generated. Contact Your System Administrator');
      return false;  
    }else{
        $.post('run_expenditure_cash_pmt.php',{AccNo:AccNo, AccName:AccName,Amt:Amt,Descr:Descr,RcptNo:RcptNo},function(ansa){
            if(ansa==1){
                alert('Transaction saved successfully');
                $('.form-text').val('');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-expenditure-rcpt-no-cshbk').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });        
    }
 });
 
 
//-//-------------------------//-//-------------------//-//--------- 
    
    $('#crt-bank-csh').click(function(){
    var AccNo = $('#sel-bank-accname :selected').attr('id');
    var AccName= $('#sel-bank-accname').val();
    var Descr = $.trim($('#txt-bank-nrt').val());
    var RcptNo = $.trim($('#lbl-bank-dep-rcpt-no').text());
    var Amt = $.trim($('#txt-bank-amount').val());
    
    if(AccNo=='0'){
        alert('Select Bank Account');
        $('#sel-bank-accname').focus();
        return false;
    }else if(AccName==''){
        alert('Select Bank Account');
        $('#sel-bank-accname').focus();
        return false;
    }else if(Amt==''){
        alert('Enter Amount Deposited');
      $('#txt-bank-amount').focus();
      return false;
    }else if(Amt<='0'){
        alert('Amount Deposited CANNOT be less than zero');
      $('#txt-bank-amount').focus();
      return false; 
    }else if(Descr==''){
        alert('Enter Bank Deposit Dscription');
      $('#txt-bank-nrt').focus();
      return false; 
    }else if(RcptNo==''){
        alert('Receipt Number  Not Generated. Contact Your System Administrator');
      return false;  
    }else{
        $.post('run_bank_payment.php',{AccNo:AccNo, AccName:AccName,Amt:Amt,Descr:Descr,RcptNo:RcptNo},function(ansa){
         
            if(ansa==1){
                alert('Transaction saved successfully');
                $('.form-text').val('');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-bank-dep-rcpt-no').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });        
    }
 }); 
 
 
 $('#crt-new-transaction-day').click(function(){
  var TrnDate=$.trim($('#dt-new-transaction-date').val());

     if(TrnDate==''){
        alert("Select Transaction Date");
        $.trim($('#dt-new-transaction-date').focus());
        return false;
    }else{
        $.post('start-new-date.php',{TrnDate:TrnDate},function(ansa){
            alert(ansa);
            $('.form-text').val('');
        });
    }
 });

$('#crt-end-transaction-day').click(function(){
   var ActiveUser = $('#lbl-active_users').text();
   var TransDay = $('#lbl-trans-day').text();
   
   if(ActiveUser==''){
       alert('Active User(s) not detected');
   }else if(TransDay==''){
       alert('Transaction Date not detected');
   }else{
       $.post('end_trans_day.php',{},function(ansa){
          alert(ansa) 
          $('#lbl-active_users').load('active_user_access.php');
             $('#lbl-trans-day').load('check_trans_day.php');
       });
   }
});

$('#btn-gen-mob').click(function(){
    var FDate = $('#gen-mob-fdate').val();
    var UserID = $('#rpt-agent-mob-name :selected').attr('id');
    
    if(FDate==''){
        alert('Select beginning date');
        $('#gen-mob-fdate').focus();
        return false;
    }else if(UserID == '0'){
          alert('Select agent name');
        $('#rpt-agent-mob-name').focus();
        return false;
    }else{
        //alert(FDate+" "+LDate);
                 
        $.post('general_mobilisation_rpt.php',{FDate:FDate, UserID:UserID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "general_mobilisation_report.php", "scrollbars=1,width=1400, height=1200");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
   
});

$('#btn-class-mob').click(function(){
   
    var FDate = $('#class-mob-fdate').val();
    var LDate = $('#class-mob-ldate').val();
    var ClassID= $('#rpt-mob-class-accname :selected').attr('id');
    
    if(FDate==''){
        alert('Select beginning date');
        $('#class-mob-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select ending date');
        $('#class-mob-ldate').focus();
        return false;
    }else if(ClassID==''){
          alert('Select class from the list');
        $('#rpt-mob-class-accname').focus();
        return false;
    }else if(ClassID=='0'){
        alert('Select class from the list');
        $('#rpt-mob-class-accname').focus();
        return false;
    }else{
        //alert(FDate+" "+LDate);
                 
        $.post('mob_rpt_class.php',{FDate:FDate, LDate:LDate,ClassID:ClassID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "general_mobilisation_report.php", "scrollbars=1,width=1400, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});

$('#btn-std-genpop').click(function(e){
    var FDate = $('#std-genpop-fdate').val();
    var LDate = $('#std-genpop-ldate').val();
    
     if(FDate==''){
        alert('Select report beginning date');
        $('#std-genpop-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select report ending date');
        $('#std-genpop-ldate').focus();
        return false;
    }else{
         $.post('student-gen-pop-rpt.php',{FDate:FDate, LDate:LDate},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "student-gen-pop-rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});

$('#btn-account-mob').click(function(){
   
      var FDate = $('#account-mob-fdate').val();
    var LDate = $('#account-mob-ldate').val();
    var AccountID= $('#rpt-mob-account-accname :selected').attr('id');
    
    if(FDate==''){
        alert('Select beginning date');
        $('#account-mob-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select ending date');
        $('#account-mob-ldate').focus();
        return false;
    }else if(AccountID==''){
          alert('Select class from the list');
        $('#rpt-mob-account-accname').focus();
        return false;
    }else if(AccountID=='0'){
        alert('Select class from the list');
        $('#rpt-mob-account-accname').focus();
        return false;
    }else{
      // alert(FDate+" "+LDate);
                 
        $.post('mob_account_rpt.php',{FDate:FDate, LDate:LDate,AccountID:AccountID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "general_mobilisation_report.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});

$('#btn-daily-cashier').click(function(){
  
  var CDate = $.trim($('#dt-daily-cash-rpt').val());
  var UserID = $('#rpt-daily-cash-accname :selected').attr('id');
  
  if(CDate==''){
      alert('Select report Date');
      $('#rpt-daily-cash-accname').focus();
      return false;
  }else if(UserID=='0'){
      alert("Select Cashier's Name");
      $('#dt-daily-cash-rpt').focus();
      return false;
  }else{
      
      $.post('daily_cash_rpt.php',{CDate:CDate, UserID:UserID},function(ansa){
           
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "daily_cash_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
      });
  }
});

$('#btn-daily-cashier-csh').click(function(){
  
  var CDate = $.trim($('#lbl-rpt-date-csh-summary').text());
  var UserID = $('#rpt-daily-cash-accname-csh :selected').attr('id');
  
  if(CDate==''){
      alert('Select report Date');
      $('#rpt-daily-cash-accname').focus();
      return false;
  }else if(UserID=='0'){
      alert("Select Cashier's Name");
      $('#dt-daily-cash-rpt').focus();
      return false;
  }else{
      
      $.post('admin-daily-cash-rpt.php',{CDate:CDate, UserID:UserID},function(ansa){
           
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "admin-daily-cash-rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
      });
  }
});


$('#btn-gen-cashier').click(function(){
  
  var FDate = $.trim($('#dt-fgen-cash-rpt').val());
  var UserID = $('#rpt-gen-cash-accname :selected').attr('id');
  
  if(FDate==''){
      alert('Select first report Date');
      $('#dt-fgen-cash-rpt').focus();
      return false;
  }else if(UserID=='0'){
      alert("Select Cashier's Name");
      $('#rpt-gen-cash-accname').focus();
      return false;
  }else{
      
      $.post('cashier_summary_rpt.php',{FDate:FDate, UserID:UserID},function(ansa){
           
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "gen_cash_rpt.php", "scrollbars=1,width=1300, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
      });
  }
});

$('#btn-gen-cashier-csh').click(function(){
  
  var FDate = $.trim($('#lbl-rpt-date-csh-details').text());
  var UserID = $('#rpt-gen-cash-accname-csh :selected').attr('id');
  
  if(FDate==''){
      alert('Select first report Date');
      $('#dt-fgen-cash-rpt').focus();
      return false;
  }else if(UserID=='0'){
      alert("Select Cashier's Name");
      $('#rpt-gen-cash-accname').focus();
      return false;
  }else{
      
      $.post('admin-gen-cash-rpt.php',{FDate:FDate, UserID:UserID},function(ansa){
           
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "admin-gen-cash-rpt.php", "scrollbars=1,width=1300, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
      });
  }
});


$('#btn-income-detail').click(function(){
   var FDate= $('#income-detail-fdate').val();
   var LDate =$('#income-detail-ldate').val();
   var BranchID = $('#rpt-income-branch-name :selected').attr('id');
   
   if(FDate==''){
       alert('Select first report Date');
      $('#income-detail-fdate').focus();
      return false;
   }else if(LDate==''){
        alert('Select last report Date');
      $('#income-detail-ldate').focus();
      return false;
   }else if(BranchID==''){
        alert('Select branch');
      $('#rpt-income-branch-name').focus();
      return false;
   }else{
       $.post('pnl_income_detail_rpt.php',{FDate:FDate, LDate:LDate, BranchID:BranchID},function(ansa){
            
           //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "pnl_income_detail_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#btn-fin-sttmnt').click(function(){
   var Date= $('#fin-sttmnt-fdate').val();
   
   if(Date==''){
       alert('Select first report Date');
      $('#fin-sttmnt-fdate').focus();
      return false;
  }else{
       $.post('financial_statement_rpt.php',{FDate:Date},function(ansa){
            
           //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "financial_statement_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#btn-expenditure-detail').click(function(){
   var FDate= $('#expenditure-detail-fdate').val();
   var LDate =$('#expenditure-detail-ldate').val();
   var BranchID = $('#rpt-expenditure-branch-name :selected').attr('id');
   
   if(FDate==''){
       alert('Select first report Date');
      $('#income-detail-fdate').focus();
      return false;
   }else if(LDate==''){
        alert('Select last report Date');
      $('#income-detail-ldate').focus();
      return false;
   }else if(BranchID==''){
        alert('Select branch');
      $('#rpt-income-branch-name').focus();
      return false;
   }else{
       $.post('pnl_expenditure_detail_rpt.php',{FDate:FDate, LDate:LDate, BranchID:BranchID},function(ansa){
            
           //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "pnl_expenditure_detail_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});


$('#btn-pnl-summary').click(function(){
    alert('come');
   var FDate= $('#pnl-summary-fdate').val();
   var LDate =$('#pnl-summary-ldate').val();
   var BranchID = $('#rpt-pnl-branch-name :selected').attr('id');
   
   if(FDate==''){
       alert('Select first report Date');
      $('#pnl-summary-fdate').focus();
      return false;
   }else if(LDate==''){
        alert('Select last report Date');
      $('#pnl-summary-ldate').focus();
      return false;
   }else if(BranchID==''){
        alert('Select branch');
      $('#rpt-pnl-branch-name').focus();
      return false;
   }else{
       $.post('pnl_main_rpt.php',{FDate:FDate, LDate:LDate, BranchID:BranchID},function(ansa){
            
           //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "pnl_main_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#undo-attendance-sel-temp').click(function(){
    $.post('undo_attendance_sel_temp.php',{},function(ansa){
        alert(ansa);
       $('#tbl-attendance-book-temp').load('load_attendance_book_temp.php');
    });
});

$('#process-class-assigned').click(function(){
   
    var ClassID = $('#tch-class-assigned :selected').attr('id');
    //alert('attendance');
    $('body').append('<div class="progress">Processing...</div>');
    $.post('process_teacher_class_assigned_temp.php',{ClassID:ClassID},function(ansa){
        if(ansa==1){
            alert('Class assigned details not found');
            $('.progress').remove();
        }else if(ansa==2){
            alert("Attendance register for this class has already been marked. Please view attendance report");
            $('.progress').remove();
        }else if(ansa==3){
            alert('Attendance register is in the process');
            $('.progress').remove();
        }else if(ansa==4){
            alert('Class details not found. Contact your system administrator');
            $('.progress').remove();
        }else{
            //alert('Done');            
            $('#tbl-attendance-book-temp').load('load_attendance_book_temp.php');
            $('.progress').remove();
           
        }
    });
    
});

$('#btn-daily-attendance').click(function(){
   //alert('ATTENDANCE starts here');
    $('body').append('<div class="progress">Processing...</div>');
  $.post('run_attendance_book.php',{},function(ansa){
      if(ansa==1){
          alert('Student attendance register already marked for this class .Check daily attendance report');
          $('.progress').remove();
      }else if(ansa==2){
          alert('Daily register not yet processed');
          $('.progress').remove();
      }else if(ansa==3){
          alert('Error encountered. Contact your system administrator');
          $('.progress').remove();
      }else{
          $('#tbl-attendance-book-temp').load('load_attendance_book_temp.php');
          $('.progress').remove();
          //alert(ansa);
      }
  });
});

$('#btn-tch-stud-reg').click(function(){
    var FDate = $('#tch-stud-reg-fdate').val();
    var LDate = $('#tch-stud-reg-ldate').val();
    var ClassID = $('.rpt-tch-class-assigned :selected').attr('id');
    
    if(FDate==''){
        alert('Select first reporting date');
        $('#tch-stud-reg-fdate').focus();
        return false;
    }else if(LDate==''){
        alert('Select last report Date');
      $('#tch-stud-reg-ldate').focus();
      return false;
   }else{
        //alert(ClassID);
                 
        $.post('tch_rpt_stud-reg.php',{FDate:FDate, LDate:LDate, ClassID:ClassID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "tch_rpt_stud-reg.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
   
});

$('#btn-tch-daily-attn').click(function(){
     var FDate = $('#tch-daily-attn-fdate').val();
    var ClassID = $('.rpt-tch-class-assigned :selected').attr('id');
    
    if(FDate==''){
        alert('Select  reporting date');
        $('#tch-daily-attn-fdate').focus();
        return false;
    }else{
        //alert(ClassID);
                 
        $.post('tch_rpt_daily_attendance.php',{FDate:FDate,  ClassID:ClassID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "tch_rpt_daily_attendance.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});

$('#btn-daily-attendance-rpt').click(function(){
     var FDate = $('#tch-daily-attn-fdate').val();
    var ClassID = $('#daily_attendance_class :selected').attr('id');
    var StaffID = $('#daily_attendance_class :selected').attr('class');
    
    if(FDate==''){
        alert('Select  reporting date');
        $('#tch-daily-attn-fdate').focus();
        return false;
    }else if(ClassID=='0'){
        alert('Select Class');
        $('#daily_attendance_class').focus();
    }else{
        //alert(ClassID);
                 
        $.post('rpt-daily-attendance-report',{FDate:FDate,  ClassID:ClassID,StaffID:StaffID},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "rpt-daily-attendance-report", "scrollbars=1,width=1200, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});



$('#crt-exp-ledger_trf').click(function(){
  var LDr = $('#exp-load_expenditure_account_name :selected').attr('id'); 
  var LCr = $('#exp-load_ledger_acc_name_cr :selected').attr('id'); 
  var Amount = $.trim($('#txt-exp-lgd-trf-amt').val());
  var Desc = $.trim($('#txt-exp-led-trf-nrt').val());
  var TranNo = $.trim($('#lbl-exp-legder_trf_tran_no').text());
  var TDate=$('#expgltrf_tdate').val();
  
  if(LDr ==0){
      alert('Select Expenditure Account');
      $('#exp-load_expenditure_account_name').focus();
      return false;
  }else if(LCr ==0){
      alert('Select Source Account');
      $('#exp-load_ledger_acc_name_cr').focus();
      return false;
  }else if(LDr==LCr){
      alert('Source account cannot be the same as expenditure account ');
      $('#exp-load_ledger_acc_name_cr').focus();
      return false;
  }else if(TDate==''){
      alert('Select Transaction Date');
      $('#expgltrf_tdate').focus();
      return false();
  }else if(Amount==0){
      alert('Amount must be more than zero');
      $('#txt-exp-lgd-trf-amt').focus();
      return false();
  }else if(Amount==''){
      alert('Enter transfer amount');
      $('#txt-exp-lgd-trf-amt').focus();
      return false();
  }else if(Desc==''){
      alert('Enter transfer description');
      $('#txt-exp-led-trf-nrt').focus();
      return false;
  }else if(TranNo==''){
      alert('Receipt no. not detected');
      return false;
  }else{
      $.post('run_exp_ledger_trf.php',{LDr:LDr,LCr:LCr,Desc:Desc,Amount:Amount,TranNo:TranNo,TDate:TDate},function(ansa){
         if(ansa==1){
             $('.form-text').val('');
             $('.span-process').text('Balance:0.00');
             $('#lbl-exp-legder_trf_tran_no').load('naamu_track.php');
             alert('Transfer saved successfully');
         }else{
             alert(ansa);
         }
      });
  }
   
});

//
$('#crt-exp-cr-ledger_trf').click(function(){
  var LDr = $('#dr-load_expenditure_account_name :selected').attr('id'); 
  var LCr = $('#exp-cr-load_ledger_acc_name_cr :selected').attr('id'); 
  var Amount = $.trim($('#txt-exp-cr-lgd-trf-amt').val());
  var Desc = $.trim($('#txt-exp-cr-led-trf-nrt').val());
  var TranNo = $.trim($('#lbl-exp-cr-legder_trf_tran_no').text());
  var TDate=$('#glexptrf_tdate').val();
  
  if(LDr ==0){
      alert('Select Expenditure Account');
      $('#exp-cr-load_expenditure_account_name').focus();
      return false;
  }else if(LCr ==0){
      alert('Select Source Account');
      $('#exp-cr-load_ledger_acc_name_cr').focus();
      return false;
  }else if(LDr==LCr){
      alert('Source account cannot be the same as expenditure account ');
      $('#exp-cr-load_ledger_acc_name_cr').focus();
      return false;
  }else if(TDate==''){
      alert('Select Transaction Date');
      $('#glexptrf_tdate').focus();
      return false;
   }else if(Amount==0){
      alert('Amount must be more than zero');
      $('#txt-exp-cr-lgd-trf-amt').focus();
      return false();
  }else if(Amount==''){
      alert('Enter transfer amount');
      $('#txt-exp-cr-lgd-trf-amt').focus();
      return false();
  }else if(Desc==''){
      alert('Enter transfer description');
      $('#txt-exp-cr-led-trf-nrt').focus();
      return false;
  }else if(TranNo==''){
      alert('Receipt no. not detected');
      return false;
  }else{
      $.post('run_exp_cr_ledger_trf.php',{LDr:LDr,LCr:LCr,Desc:Desc,Amount:Amount,TranNo:TranNo,TDate:TDate},function(ansa){
         if(ansa==1){
             $('#lbl-exp-cr-legder_trf_tran_no').load('naamu_track.php');
             alert('Transfer saved successfully');
             $('.form-text').val('');
             $('.span-process').text('Balance:0.00');
         }else{
             alert(ansa);
         }
      });
  }
   
});


$('#crt-ledger_trf').click(function(){
  var LDr = $('#load_ledger_acc_name_dr :selected').attr('id'); 
  var LCr = $('#load_ledger_acc_name_cr :selected').attr('id'); 
  var Amount = $.trim($('#txt-lgd-trf-amount').val());
  var Desc = $.trim($('#txt-led-trf-nrt').val());
  var TranNo = $.trim($('#lbl-legder_trf_tran_no').text());
  var TDate=$('#ldgtrf_tdate').val();
  
  if(LDr ==0){
      alert('Select Debit Ledger');
      $('#load_ledger_acc_name_dr').focus();
      return false;
  }else if(TDate==''){
       alert('Select Transaction Date');
      $('#ldgtrf_tdate').focus();
      return false;
  }else if(LCr ==0){
      alert('Select Credit Ledger');
      $('#load_ledger_acc_name_cr').focus();
      return false;
  }else if(LDr==LCr){
      alert('Debit account cannot be the same as credit account ');
      $('#load_ledger_acc_name_cr').focus();
      return false;
  }else if(Amount==0){
      alert('Amount must be more than zero');
      $('#txt-lgd-trf-amount').focus();
      return false();
  }else if(Amount==''){
      alert('Enter transfer amount');
      $('#txt-lgd-trf-amount').focus();
      return false();
  }else if(Desc==''){
      alert('Enter transfer description');
      $('#txt-led-trf-nrt').focus();
      return false;
  }else if(TranNo==''){
      alert('Receipt no. not detected');
      return false;
  }else{
      $.post('run_ledger_trf.php',{LDr:LDr,LCr:LCr,Desc:Desc,Amount:Amount,TranNo:TranNo,TDate:TDate},function(ansa){
         if(ansa==1){
             alert('Transfer saved successfully');
             $('.form-text').val('');
              $('#process_ledger_cr_bal').text('Balance:0.00');
              $('#process_ledger_dr_bal').text('Balance:0.00');
                $('#lbl-legder_trf_tran_no').load('naamu_track.php');
         }else{
             alert(ansa);
         }
      });
  }
   
});


$('#crt-glincome_trf').click(function(){
  var LDr = $('#load_ledgerinc_acc_name_dr :selected').attr('id'); 
  var LCr = $('#load_income_acc_name_cr :selected').attr('id'); 
  var Amount = $.trim($('#txt-glincome-trf-amount').val());
  var Desc = $.trim($('#txt-glincome-trf-nrt').val());
  var TranNo = $.trim($('#lbl-glincome_trf_tran_no').text());
  var TDate=$('#glinctrf_tdate').val();
  
  if(LDr ==0){
      alert('Select Debit Ledger');
      $('#load_ledgerinc_acc_name_dr').focus();
      return false;
  }else if(LCr ==0){
      alert('Select Credit Ledger');
      $('#load_income_acc_name_cr').focus();
      return false;
  }else if(LDr==LCr){
      alert('Debit account cannot be the same as credit account ');
      $('#load_income_acc_name_cr').focus();
      return false;
  }else if(TDate==''){
       alert('Select Transaction Date');
      $('#glinctrf_tdate').focus();
      return false;
  }else if(Amount==0){
      alert('Amount must be more than zero');
      $('#txt-glincome-trf-amount').focus();
      return false();
  }else if(Amount==''){
      alert('Enter transfer amount');
      $('#txt-glincome-trf-amount').focus();
      return false();
  }else if(Desc==''){
      alert('Enter transfer description');
      $('#txt-glincome-trf-nrt').focus();
      return false;
  }else if(TranNo==''){
      alert('Receipt no. not detected');
      return false;
  }else{
      $.post('run_gl_income_trf.php',{LDr:LDr,LCr:LCr,Desc:Desc,Amount:Amount,TranNo:TranNo,TDate:TDate},function(ansa){
         if(ansa==1){
               $('#lbl-glincome_trf_tran_no').load('naamu_track.php');
             alert('Transfer saved successfully');
             $('.form-text').val('');
              $('#process_ledger_cr_bal').text('Balance:0.00');
         }else{
             alert(ansa);
         }
      });
  }
   
});


$('#load_ledger_acc_name_dr').blur(function(){
   var AccNo = $('#load_ledger_acc_name_dr :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_ledger_dr_bal').text(ansa);
       }
   });
});

$('#load_ledgerinc_acc_name_dr').blur(function(){
   var AccNo = $('#load_ledgerinc_acc_name_dr :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_ledgerinc_dr_bal').text(ansa);
       }
   });
});

$('#load_income_acc_name_cr').blur(function(){
   var AccNo = $('#load_income_acc_name_cr :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_income_cr_bal').text(ansa);
       }
   });
});

$('#txt-std-mob-posting-name').keyup(function(){
    var StdID = $.trim($('#txt-std-mob-posting-name').val());
    if(StdID==''){
        return false;
    }else{
       //alert(StdID);
        $.post('load_mob_std_search.php',{StdID:StdID},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#tbl-std-list-mob-posting').html(ansa);
       }
   }); 
    }
    
});

$('#load_ledger_acc_name_cr').blur(function(){
   var AccNo = $('#load_ledger_acc_name_cr :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_ledger_cr_bal').text(ansa);
       }
   });
});

$('#exp-load_ledger_acc_name_cr').blur(function(){
   var AccNo = $('#exp-load_ledger_acc_name_cr :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_exp-ledger_cr_bal').text(ansa);
       }
   });
});

$('#exp-load_expenditure_account_name').blur(function(){
   var AccNo = $('#exp-load_expenditure_account_name :selected').attr('id');
    //alert(AccNo);
   $.post('check_exp_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_exp_ledger_cr_bal').text(ansa);
       }
   });
});


$('#exp-cr-load_ledger_acc_name_cr').blur(function(){
   var AccNo = $('#exp-cr-load_ledger_acc_name_cr :selected').attr('id');
    //alert(AccNo);
   $.post('check_exp_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_exp_cr_ledger_bal').text(ansa);
       }
   });
});


$('#dr-load_expenditure_account_name').blur(function(){
   var AccNo = $('#dr-load_expenditure_account_name :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_exp_ledger_dr_bal').text(ansa);
       }
   });
});

$('#crt-sch-fee-bill-ind').click(function(){
    var AccountNo = $('#sel-student-fee-accname-ind :selected').attr('id');
    var Naration = $.trim($('#txt-sch-fee-paid-nrt').val());
    var Amount =$.trim($('#txt-sch-fee-paid').val());
    var AccountName = $.trim($('#sel-student-fee-accname-ind').val());
    var RcptNo = $.trim($('#lbl-paid-sch-fee-receipt-no').text());
    
    if(AccountNo=='0'){
        alert("Please select fee account");
        $('#sel-student-fee-accname-ind').focus();
        return false;
    }else if(AccountName ==''){
        alert("Please select fee account");
        $('#sel-student-fee-accname-ind').focus();
        return false;
    }else if(RcptNo==''){
        alert('Receipt number not generated');
        return false;
    }else{
        $.post('run_ind_student_bill.php',{AccountNo:AccountNo, Amount:Amount,Naration:Naration,RcptNo:RcptNo},function(ansa){
           if(ansa==1){
               alert("Payment saved successfully");
               $('.form-text').val('');
                     $('#tbl-rcv-sch-fee-student-list').load('bill_ind_stundent_list_out_fee.php');
                    $('#sel-student-fee-accname-ind').load('load_distinct_bill_account.php');
                    $('#tbl-rcv-sch-fee-student-details').load('student_fee_ind_bill_temp.php');
                    $('#lbl-paid-sch-fee-receipt-no').load('naamu_track.php');
                    $('#tbl-search-student_fee-rcv').focus();
                 $('#cashbook').load('load_cashbook_balance.php');
           }else{
               alert(ansa);
           }
        });
    }
 });

$('#tbl-search-student_stmnt').keyup(function(){
   var FName = $.trim($('#tbl-search-student_stmnt').val());
   
   $.post('student_statement_search_tbl_list.php',{FName:FName},function(ansa){
    $('#tbl-rpt-sch-fee-student-list').html(ansa);
   });
    
});


$('#tbl-search-student_bill').keyup(function(){
   var e = $.trim($('#tbl-search-student_bill').val());
   
   if(e===''){
       return false;
   }else{
      $.post('student_bill_info_search_tbl.php',{e:e},function(ansa){
        $('#tbl-student-bill-info').html(ansa);
       }); 
   }
   
});



$('#txt-std-exams-score_search').keyup(function(){
   var key=$.trim($('#txt-std-exams-score_search').val());
   
   $.post('load_tch-std-list-exams-score-search.php',{key:key},function(ansa){
       $('#tbl-std-list-exams-score').html(ansa);
   });
   
});

$('#btn-student-sttmnt-acc-rpt').click(function(){
  
    var FDate= $.trim($('#student_sttmnt-fdate').val());
    var LDate = $.trim($('#student_sttmnt-ldate').val());
    var AccountID =  $('#sel-student-sttmnt-acc :selected').attr('id');
    var AccName =  $('#sel-student-sttmnt-acc').val();
        if(FDate==''){
       alert('Select first statement date');
        $('#student_sttmnt-fdate').focus();
        return false;
        }else if(LDate==''){
            alert('Select last statement Date');
          $('#student_sttmnt-ldate').focus();
          return false;
       }else if(AccName==''){
           alert('Select Account');
            $('#sel-student-sttmnt-acc').focus();
            return false;
        }else if(AccountID=='0'){
            alert('Select Account');
            $('#sel-student-sttmnt-acc').focus();
            return false;
       }else{
        $.post('run_student_statement-acc-1.php',{FDate:FDate, LDate:LDate,AccID:AccountID},function(ansa){
            //  $('#shw-daily-mob').html(ansa); 
            //alert(AccountID);
          var newWindow = window.open("", "run_student_statement-acc-1.php", "scrollbars=1,width=1250, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        }); 
   }
});

//View Full Student 

$('#btn-student-sttmnt-full-rpt').click(function(){
  
    var FDate= $.trim($('#student_sttmnt-fdate').val());
    var LDate = $.trim($('#student_sttmnt-ldate').val());

    if(FDate==''){
       alert('Select first statement date');
        $('#student_sttmnt-fdate').focus();
        return false;
        }else if(LDate==''){
            alert('Select last statement Date');
          $('#student_sttmnt-ldate').focus();
          return false;
       }else{
        $.post('run_student_statement-full.php',{FDate:FDate, LDate:LDate},function(ansa){
            //  $('#shw-daily-mob').html(ansa); 
            //alert(AccountID);
          var newWindow = window.open("", "run_student_statement-full.php", "scrollbars=1,width=1250, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        }); 
   }
});

//Full Student Ends Here...


$('#sel-student-sttmnt-acc').focus(function(){
       $('#sel-student-sttmnt-acc').load('load_dstinct_sttment_fee_acc_name.php');
 
});

$('#btn-fee-outstanding-rpt').click(function(){
    var FDate = $('#fee-outs-fdate').val();
    
    if(FDate==''){
        alert('Select beginning date');
        $('#fee-outs-fdate').focus();
        return false;
    }else{
        //alert(FDate+" "+LDate);
                 
        $.post('rpt_general_fee_outstanding.php',{FDate:FDate},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "rpt_general_fee_outstanding.php", "scrollbars=1,width=1200, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
   
});


$('#csh-ledger_trf').click(function(){
  var LCr = $('#load_ledger_acc_name_cr :selected').attr('id'); 
  var Amount = $.trim($('#txt-lgd-trf-amount').val());
  var Desc = $.trim($('#txt-led-trf-nrt').val());
  var TranNo = $('#lbl-legder_trf_tran_no').text();
  
  if(LCr ==0){
      alert('Select Credit Ledger');
      $('#load_ledger_acc_name_cr').focus();
      return false;
  }else if(Amount==0){
      alert('Amount must be more than zero');
      $('#txt-lgd-trf-amount').focus();
      return false();
  }else if(Amount==''){
      alert('Enter transfer amount');
      $('#txt-lgd-trf-amount').focus();
      return false();
  }else if(Desc==''){
      alert('Enter transfer description');
      $('#txt-led-trf-nrt').focus();
      return false;
  }else if(TranNo==''){
      alert('Receipt no. not detected');
      return false;
  }else{
      $.post('run_csh_stock_sales.php',{LCr:LCr,Desc:Desc,Amount:Amount,TranNo:TranNo},function(ansa){
         if(ansa==1){
             alert('Stock Sales Saved Successfully');
             $('.form-text').val('');
              $('#process_ledger_cr_bal').text('Balance:0.00');
              $('#lbl-legder_trf_tran_no').load('naamu_track.php');
         }else{
             alert(ansa);
         }
      });
  }
   
});


$('#btn-fee-paid-rpt').click(function(){
    var FDate = $('#fee-paid-fdate').val();
    
    if(FDate==''){
        alert('Select beginning date');
        $('#fee-paid-fdate').focus();
        return false;
    }else{
        //alert(FDate+" "+LDate);
                 
        $.post('general_fee_paid_rpt.php',{FDate:FDate},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "general_fee_paid_rpt.php", "scrollbars=1,width=1200, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
   
});


//Stock Manager

	$('#crt-Stock-MngID').click(function(){
		
		var mngCode = "STM-";
		var MngRef = $.trim($('#lbl-manager-id-ref').text());
		var MngID = $.trim($('#lbl-stock-manager-id').text());
		var MngName = $.trim($('#stock-manager-name').val());
		
		if(MngID ==""){
			alert("Stock Manager ID not detected. Contact your system administrator.");
			
			}else if(MngName==""){
				alert("Enter Stock Manager Name.");
				$('#stock-manager-name').focus();
				
			}else if(MngRef==""){
				
			alert("Stock Manager ID not detected. Contact your system administrator.");		
				}else{
				
					
					$.post('run_stock_manager_id.php',{mngID:MngID, mngName:MngName,mngRef:MngRef},function(ansa){
						alert(ansa);
						$('#stock-manager-name').val("");
						
						$.post('check_stock_manager_id.php',{},function(ansa){
								$('#lbl-manager-id-ref').text(ansa);
								$('#lbl-stock-manager-id').text(mngCode+ansa);
							});
					});
			
				
			}
		
	});


$('#crt-Stock-ItemgID').click(function(){
  var StockID = $.trim($('#lbl-stock-item-id').text());
  var StockName = $.trim($('#stock-item-name').val());
  var thres = $.trim($('#txt-stk-thresh').val());
  var rem =(thres % 1);
  if(StockID==''){
      alert('Stock ID not found');
      return false;
  }else if(StockName==''){
      alert('Enter Stock Name');
      $('#stock-item-name').focus();
      return false;
  }else if(thres==''){
      alert('Enter Stock Threshold value');
      $('#txt-stk-thresh').focus();
      return false;
  }else if(rem !==0){
       alert('Enter a Valid Stock Threshold value');
      $('#txt-stk-thresh').focus();
      return false;
  }else if(thres<=0){
        alert('Enter a Valid Stock Threshold value');
      $('#txt-stk-thresh').focus();
      return false;
  }else{
      $.post('run_new_stock_item.php',{ID:StockID,Name:StockName,Thres:thres},function(ansa){
          if(ansa==1){
              alert('Stock item created successfully');
              $('#lbl-stock-item-id').load('load_stock_item_id.php');
              $('.form-text').val('');
              $('#stock-item-name').focus();
          }else{
              alert(ansa);
          }
      });
  }
});


$('#load-stock-cr-account').blur(function(){
   var AccNo = $('#load-stock-cr-account :selected').attr('id');
    //alert(AccNo);
   $.post('check_ledger_balance.php',{AccNo:AccNo},function(ansa){
       if(ansa==1){
           alert("Invalid account number");
       }else{
           $('#process_stk-cr-acc').text(ansa);
       }
   });
});

$('#crt-stock-purchase').click(function(){
   var StkID=$('#load-stock-item-id :selected').attr('id');
   var MngID = $('#load-stock-mnger-id :selected').attr('id');
   var BatchNo=$.trim($('#lbl-stock-batch-no').text());
   var QtyDr = $.trim($('#txt-stk-pchs-dr').val());
   var UCost = $.trim($('#txt-stk-pchs-ucost').val());
   var TCost = $('#lbl-stock-pchs-tcost').text();
   var SPrice = $.trim($('#txt-stk-pchs-sprice').val());
   var SCr = $('#load-stock-cr-account :selected').attr('id');
   var RcptNo = $.trim($('#lbl-stock-pch-rcpt-no').text());
   var Dsc= $.trim($('#desc-stk-pchs').val());
   var Qrem = (QtyDr % 1);
   
   if(StkID=='0'){
       alert('Select Stock Item');
       $('#load-stock-item-id').focus();
       return false;
   }else if(MngID=='0'){
       alert('Select Stock Manager');
       $('#load-stock-mnger-id').focus();
       return false;
   }else if(BatchNo==''){
        alert('Batch No. not found');
       return false; 
   }else if(QtyDr==''){
        alert('Enter Quantity Purchased');
       $('#txt-stk-pchs-dr').focus();
       return false;
   }else if(Qrem !==0){
        alert('Enter Quantity Purchased');
       $('#txt-stk-pchs-dr').focus();
       return false;
   }else if(QtyDr<=0){
      alert('Quantity Purchased must be more than zero');
       $('#txt-stk-pchs-dr').focus();
       return false;
   }else if(UCost==''){
       alert('Enter Unit Cost');
       $('#txt-stk-pchs-ucost').focus();
       return false; 
   }else if(UCost<=0){
        alert('Unit Cost must be more than zero');
       $('#txt-stk-pchs-ucost').focus();
       return false; 
   }else if(TCost==''){
         alert('Total Cost not found');
       return false;
   }else if(SPrice==''){
        alert('Enter Selling Price');
       $('#txt-stk-pchs-sprice').focus();
       return false;
   }else if(UCost>SPrice){
       alert('Selling price cannot be less than cost price');
       return false;
   }else if(SCr=='0'){
        alert('Select Credit Account');
       $('#load-stock-cr-account').focus();
       return false;
   }else if(RcptNo==''){
        alert('Receipt No. not found');
       return false;
   }else if(Dsc==''){
      alert('Enter description for item(s) purchased');
      $('#desc-stk-pchs').focus();
       return false;  
   }else{
      $.post('run_stock_purchase.php',{SID:StkID, RcptNo:RcptNo,SCr:SCr,Desc:Dsc,SPrice:SPrice,TCost:TCost,UCost:UCost,QtyDr:QtyDr,BatchNO:BatchNo,MngID:MngID},function(ansa){
          if(ansa==1){
              alert('Stock purchased saved successfully');
              $('.form-text').val('');  
             $('#lbl-stock-pch-rcpt-no').load('naamu_track.php');
             $('#lbl-stock-batch-no').load('batch_track.php');
             $('#lbl-stock-pchs-tcost').text('0');
             $('#process_stk-cr-acc').text('Balance:0.00');
             $('#stock-item-name').focus();

          }else{
              alert(ansa);
          }
      });
   }
  //alert(StkID+' '+MngID+' '+BatchNo+' '+QtyDr);
});

 $('#txt-stk-pchs-ucost').blur(function(){
      var QtyDr = $.trim($('#txt-stk-pchs-dr').val());
   var UCost = $.trim($('#txt-stk-pchs-ucost').val());
    var Total=QtyDr*UCost;
    $('#lbl-stock-pchs-tcost').text(Total);
 });

$('#btn-cash-add-stock-item').click(function(){
   //alert('add stock item'); 
   
   var SID = $('#load_stock_acc_name :selected').attr('id');
   var SName =$('#load_stock_acc_name').val();
   var Qty = $.trim($('#txt-cash-stock-pchs-qty').val());
   var rem = (Qty % 1);
  //alert(SID+" "+SName+" "+Qty);
   if(SID=='0'){
       alert('Select Stock Item');
       $('#load_stock_acc_name').focus();
       return false();
   }else if(SName==''){
        alert('Select Stock Item');
       $('#load_stock_acc_name').focus();
       return false();
   }else if(Qty==''){
       alert('Enter Quantity Purchased');
       $('#txt-cash-stock-pchs-qty').focus();
       return false;
   }else if(Qty<='0'){
       alert('Qunatity purchase must be more than zero');
       $('#txt-cash-stock-pchs-qty').focus();
       return false;
   }else if(rem !==0){
       alert('Enter a valid purchased value');
      $('#txt-cash-stock-pchs-qty').focus();
      return false;
  }else{
       //alert('Go ahead');
       $.post('add_stock_selected_temp_cash_sales.php',{SID:SID, SName:SName,Qty:Qty},function(ansa){
           if(ansa==1){
               //alert("Item addedd successfully");
                $('#txt-cash-stock-pchs-qty').val('');
                $('#load_stock_acc_name').val('');
                $('#tbl_sel_stock_item_cash_sales').load('load_sel_stock_item_cash_sales.php');
                $('#lbl-stock_subtotal_sel_cash_sales').load('load_stock_sel_total_cash_sales.php');
           }else{
               alert(ansa);
              
           }
       });
   }
});

$('#crt-stock-sales-cash').click(function(){
  var SubTotal =Number($.trim($('#lbl-stock_subtotal_sel_cash_sales').text()));
  var Total = Number($.trim($('#txt-total-cash-sales').val()));
  var Rcpt = $.trim($('#lbl-cash-sales-recpt-no').text());
  var Descr = $.trim($('#txt-stock-sles-descr').val());
  
  if(SubTotal==''){
      alert('Sub Total not found');
      return false;
  }else if(SubTotal<='0'){
      alert('Sub Total cannot must be more than zero(0)');
      return false;
  }else if(Total==''){
      alert('Enter the amount paid');
      $('#txt-total-cash-sales').focus();
      return false;
  }else if(Total<='0'){
      alert('Amount paid must be more than zero(0)');
      $('#txt-total-cash-sales').focus();
      return false;
  }else if(Total!==SubTotal){
    alert('Amount paid must be equal to total price');
      $('#txt-total-cash-sales').focus();
      return false;  
  }else if(Rcpt==''){
      alert('Receipt no. not found');
      return false;
  }else if(Descr==''){
      alert('Enter Transaction Description');
      $('#txt-stock-sles-descr').focus();
      return false;
  }else{
      //alert(SubTotal+" "+Total+" "+Rcpt+" "+Descr);
      $.post('run_stock_cash_sales.php',{SubTotal:SubTotal, Total:Total,Rcpt:Rcpt,Descr:Descr},function(ansa){
          if(ansa==1){
              alert("Cashbook account not found");
          }else if(ansa==2){
              alert("Sub Total not found");
          }else if(ansa==3){
              alert("Amount paid is not valid");
              $('#txt-total-cash-sales').focus();
          }else if(ansa==4){
              alert("Amount paid must be equal to Sub Total");
          $('#txt-total-cash-sales').focus();
          }else if(ansa==5){
              alert("Invalid receipt number");
          }else if(ansa==6){
              alert('Enter description for transfer amount');
               $('#txt-stock-sles-descr').focus();
          }else if(ansa==7){
              alert('Select student name from the list');
          }else if(ansa==8){
              alert('Multipe records detected. Contact your system administrator');
          }else if(ansa==9){
              alert('Select item from the dropdown list');
           $('#load_stock_acc_name').focus();
          }else if(ansa==10){
              alert('Error encountered. Contact your system administrator');
          }else if(ansa==11){
              alert('Stock main account not found');
          }else if(ansa==12){
              alert('Stock profit account not found');
          }else if(ansa==13){
              alert('Active income account not found');
          }else{
              $('.form-text').val('');
              $('#cashbook').load('load_cashbook_balance.php');
             $('#lbl-cash-sales-recpt-no').load('naamu_track.php');
              $('#tbl_sel_student_cash_stock_sales').load('load_sel_student_stock_cash_sales.php');
            $('#tbl_sel_stock_item_cash_sales').load('load_sel_stock_item_cash_sales.php');
            $('#lbl-stock_subtotal_sel_cash_sales').load('load_stock_sel_total_cash_sales.php');
            
             //alert(ansa);
          }
      });
    }
});



$('#btn-cash-add-other-stock-item').click(function(){
   //alert('add stock item'); 
   
   var SID = $('#load_other_stock_acc_name :selected').attr('id');
   var SName =$('#load_other_stock_acc_name').val();
   var Qty = $.trim($('#txt-other_cash-stock-pchs-qty').val());
   var rem = (Qty % 1);
  //alert(SID+" "+SName+" "+Qty);
   if(SID=='0'){
       alert('Select Stock Item');
       $('#load_other_stock_acc_name').focus();
       return false();
   }else if(SName==''){
        alert('Select Stock Item');
       $('#load_other_stock_acc_name').focus();
       return false();
   }else if(Qty==''){
       alert('Enter Quantity Purchased');
       $('#txt-other_cash-stock-pchs-qty').focus();
       return false;
   }else if(Qty<='0'){
       alert('Qunatity purchase must be more than zero');
       $('#txt-other_cash-stock-pchs-qty').focus();
       return false;
   }else if(rem !==0){
       alert('Enter a valid purchased value');
      $('#txt-other_cash-stock-pchs-qty').focus();
      return false;
  }else{
       //alert('Go ahead');
       $.post('add_stock_selected_temp_other_cash_sales.php',{SID:SID, SName:SName,Qty:Qty},function(ansa){
           if(ansa==1){
              // alert("Item addedd successfully");
                $('#txt-other_cash-stock-pchs-qty').val('');
                $('#load_other_stock_acc_name').val('');
                $('#tbl_sel_other_stock_item_cash_sales').load('load_sel_other_stock_item_cash_sales.php');
                $('#lbl-stock_subtotal_sel_other_cash_sales').load('load_stock_sel_other_total_cash_sales.php');
           }else{
               alert(ansa);
              
           }
       });
   }
});


$('#crt-other_stock-sales-cash').click(function(){
  var SubTotal =Number($.trim($('#lbl-stock_subtotal_sel_other_cash_sales').text()));
  var Total = Number($.trim($('#txt-total-other_cash-sales').val()));
  var Rcpt = $.trim($('#lbl-other-cash-sales-recpt-no').text());
  var Descr = $.trim($('#txt-other_stock-sles-descr').val());
  
  if(SubTotal==''){
      alert('Sub Total not found');
      return false;
  }else if(SubTotal<='0'){
      alert('Sub Total cannot must be more than zero(0)');
      return false;
  }else if(Total==''){
      alert('Enter the amount paid');
      $('#txt-total-other_cash-sales').focus();
      return false;
  }else if(Total<='0'){
      alert('Amount paid must be more than zero(0)');
      $('#txt-total-other_cash-sales').focus();
      return false;
  }else if(Total!==SubTotal){
    alert('Amount paid must be equal to sub total');
      $('#txt-total-other_cash-sales').focus();
      return false;  
  }else if(Rcpt==''){
      alert('Receipt no. not found');
      return false;
  }else if(Descr==''){
      alert('Enter Transaction Description');
      $('#txt-other_stock-sles-descr').focus();
      return false;
  }else{
      //alert(SubTotal+" "+Total+" "+Rcpt+" "+Descr);
      $.post('run_other_stock_cash_sales.php',{SubTotal:SubTotal, Total:Total,Rcpt:Rcpt,Descr:Descr},function(ansa){
          if(ansa==1){
              alert("Cashbook account not found");
          }else if(ansa==2){
              alert("Sub Total not found");
          }else if(ansa==3){
              alert("Amount paid is not valid");
              $('#txt-total-cash-sales').focus();
          }else if(ansa==4){
              alert("Amount paid must be equal to Sub Total");
          $('#txt-total-cash-sales').focus();
          }else if(ansa==5){
              alert("Invalid receipt number");
          }else if(ansa==6){
              alert('Enter description for transfer amount');
               $('#txt-stock-sles-descr').focus();
          }else if(ansa==7){
              alert('Select student name from the list');
          }else if(ansa==8){
              alert('Multipe records detected. Contact your system administrator');
          }else if(ansa==9){
              alert('Select item from the dropdown list');
           $('#load_stock_acc_name').focus();
          }else if(ansa==10){
              alert('Error encountered. Contact your system administrator');
          }else if(ansa==11){
              alert('Stock main account not found');
          }else if(ansa==12){
              alert('Stock profit account not found');
          }else if(ansa==13){
              alert('Active income account not found');
          }else{
              $('#cashbook').load('load_cashbook_balance.php');
             $('#lbl-other-cash-sales-recpt-no').load('naamu_track.php');
            $('#load_other_stock_acc_name').load('load_stock_other_cash_Sales.php');
            $('#tbl_sel_other_stock_item_cash_sales').load('load_sel_other_stock_item_cash_sales.php');
            $('#lbl-stock_subtotal_sel_other_cash_sales').load('load_stock_sel_other_total_cash_sales.php');
            $('.form-text').val('');
             //alert(ansa);
          }
      });
    }
});

$('#crt-new-academic-coupon').click(function(){
    
    var BgDt = $.trim($('#dt-CpBgDt').val());
    var EndDt = $.trim($('#dt-CpEndDt').val());
    var NtDt = $.trim($('#dt-CpNtDt').val());
    var CpNo = $.trim($('#lbl-new-coupon-id').text());
    var Title = $.trim($('#txt-coupon-cycle').val());
    
    if(BgDt==''){
        alert('Select First Academic Date');
        $('#dt-CpBgDt').focus();
        return false;
    }else if(EndDt==''){
         alert('Select  Last Academic Date');
        $('#dt-CpEndDt').focus();
        return false;
    }else if(NtDt==''){
        alert('Select  Next Academic Date');
        $('#dt-CpNtDt').focus();
        return false;
    }else if(Title==''){
        alert('Enter the Academic Coupon Title');
        $('#txt-coupon-cycle').focus();
        return false;
    }else if(CpNo==''){
        alert('Coupon No. not found');
        return false;
    }else{
       // alert('run me');
       $.post('run_new_academic_coupon.php',{Title:Title,EndDt:EndDt, BgDt:BgDt,NtDt:NtDt,CpNo:CpNo},function(ansa){
           if(ansa==1){
               alert('New coupon issued successfully');
               $('#lbl-new-coupon-id').load('coupon_track.php');
               $('.form-text').val('');
           }else{
               alert(ansa);
           }
       });
    }
});


$('#crt-map-admitn-account-fee').click(function(){
   var Fee = $('#admitn-fee-mapping-fee-acc-name :selected').attr('id');
   var Class = $('#admitn-fee-mapping-class-acc-name :selected').attr('id');
   var Amt = $.trim($('#txt-admitn-fee-acc-mapping').val());
   
   //alert(Fee+Class+Amt);
   
   if(Class=='0'){
       alert('Select Class Name');
       $('#admitn-fee-mapping-class-acc-name').focus();
       return false;
   }else if(Fee=='0'){
       alert('Select Fee Account');
       $('#admitn-fee-mapping-fee-acc-name').focus();
       return false;
   }else if(Amt==''){
        alert('Enter Amount');
       $('#txt-admitn-fee-acc-mapping').focus();
       return false;
   }else if(Amt<='0'){
       alert('Amount must be more than zero(0)');
       $('#txt-admitn-fee-acc-mapping').focus();
       return false;
   }else
    $('body').append('<div class="progress">Processing...</div>');
       $.post('map_admission_fee_class.php',{Fee:Fee, Class:Class, Amt:Amt},function(ansa){
           if(ansa==2){
               $('.progress').remove();
               alert('Fee update successfully');
               $('#admission-fee-mapped-account').load('load-admission-fee-mapped-account.php');
               $('#admitn-fee-mapping-fee-acc-name').val('');
               $('#txt-admitn-fee-acc-mapping').val('');
           }else if(ansa==1){
               $('.progress').remove();
               $('#admission-fee-mapped-account').load('load-admission-fee-mapped-account.php');
               $('#admitn-fee-mapping-fee-acc-name').val('');
               $('#txt-admitn-fee-acc-mapping').val('');
           }else{
               $('.progress').remove();
               alert(ansa);
           }
       });
});


$('#crt-map-school-account-fee').click(function(){
   var Fee = $('#school-fee-mapping-fee-acc-name :selected').attr('id');
   var Class = $('#school-fee-mapping-class-acc-name :selected').attr('id');
   var Amt = $.trim($('#txt-school-fee-acc-mapping').val());
   
   //alert(Fee+Class+Amt);
   
   if(Class=='0'){
       alert('Select Class Name');
       $('#school-fee-mapping-class-acc-name').focus();
       return false;
   }else if(Fee=='0'){
       alert('Select Fee Account');
       $('#school-fee-mapping-fee-acc-name').focus();
       return false;
   }else if(Amt==''){
        alert('Enter Amount');
       $('#txt-school-fee-acc-mapping').focus();
       return false;
   }else if(Amt<='0'){
       alert('Amount must be more than zero(0)');
       $('#txt-school-fee-acc-mapping').focus();
       return false;
   }else{
    $('body').append('<div class="progress">Processing...</div>');
       $.post('map_school_fee_class.php',{Fee:Fee, Class:Class, Amt:Amt},function(ansa){
           if(ansa==2){
               $('.progress').remove();
               alert('Fee update successfully');
               $('#school-fee-mapped-account').load('load-school-fee-mapped-account.php');
               $('#school-fee-mapping-fee-acc-name').val('');
               $('#txt-school-fee-acc-mapping').val('')
           }else if(ansa==1){
               $('.progress').remove();
               $('#school-fee-mapped-account').load('load-school-fee-mapped-account.php');
               $('#school-fee-mapping-fee-acc-name').val('');
               $('#txt-school-fee-acc-mapping').val('')
           }else{
               $('.progress').remove();
               alert(ansa);
           }
       });
   }
});

$('#std-class-name').blur(function(){
   var Class = $.trim($('#std-class-name :selected').attr('id'));
   
   if(Class=='0'){
       alert('Select Class Admitted');
   }else{
       $.post('insert_class_new_admitn_fee.php',{Class:Class},function(ansa){
           //alert(ansa);
           $('#tbl-admitn-sel-class-fee-account').load('load_class_new_admitn_fee.php');
            $('#lbl-admitn-total-fee-temp').load('load_admission_total_fee_temp.php')
            
       });
   }
});


$('#crt-suject-class').click(function(){
   var Class=$('#class-subject-mapping-class-acc-name :selected').attr('id'); 
   var Subj=$('#class-subject-mapping-fee-acc-name :selected').attr('id'); 
    
        if(Class=='0'){
            alert('Select Class');
            $('#class-subject-mapping-class-acc-name').focus();
            return false;
        }else if(Subj=='0'){
            alert('Select Subject');
            $('#class-subject-mapping-fee-acc-name').focus();
            return false;
        }else{
            $.post('class_subject.php',{Class:Class,Subj:Subj},function(ansa){
                if(ansa==1){
                    $('#class-subject-mapping-fee-acc-name').val('');
                }else{
                    alert(ansa);
                }
            });
        }
});

$('#btn-save-academic-rcd').click(function(){
    var CpNo=$.trim($('#lbl-exam-coupon-no').text());
    var GRmks=$.trim($('#txt-gen-remarks').val());
    var Achvmnt=$.trim($('#std-achvmtn').val());
    var Wkness=$.trim($('#std-wkness').val());
    
    if(CpNo==''){
        alert('Coupon No. not found');
        return false;
    }else if(GRmks==''){
        alert('Enter general remarks for student performance');
        $('#txt-gen-remarks').focus();
        return false;
    }else if(Achvmnt==''){
       alert('Enter achievement of student for the academic term');
        $('#std-achvmtn').focus();
        return false; 
    }else if(Wkness==''){
        alert('Enter area to focus on student for next academic term');
        $('#std-wkness').focus();
        return false;
    }else{
    $('body').append('<div class="progress">Processing...</div>');
        $.post('run_student_exams_records.php',{CpNo:CpNo, GRmks:GRmks,Achvmnt:Achvmnt,Wkness:Wkness},function(e){
            if(e==1){
                alert('Coupon No. not found');
                return false;
                $('.progress').remove();
            }else if(e==2){
                alert('Enter general remarks for student performance');
                return false;
                $('.progress').remove();
            }else if(e==3){
                alert('Active coupon not found');
                return false;
                $('.progress').remove();
            }else if(e==4){
                alert('Multiple coupons detected. Contact your system administrator');
                return false;
                $('.progress').remove();
            }else if(e==5){
                alert('Select student name from the list');
                return false;
                $('.progress').remove();
            }else if(e==6){
                alert('Student academic records already captured');
                return false;
                $('.progress').remove();
            }else if(e==7){
                alert('Error encountered. Contact your system administrator');
                $('.progress').remove();
            }else{
                 $('#txt-gen-remarks').val('');
                 $('#std-achvmtn').val('');
                 $('#std-wkness').val('');
                 $('#undelivered_laund_custname_csh').load('load_exams_score_stud_sel_temp_fname.php');
                 $('#undelivered_laund_telno_csh').load('load_exams_score_stud_sel_temp_classname.php'); 
                 $('#tbl_sel_exams_score_subject').load('load_sel_exams_score_student_subject.php');
                $('.progress').remove();
             }
        });
    }
});

$('#txt-edit_gen-remarks').blur(function(){
   var Rmks=$.trim($('#txt-edit_gen-remarks').val());
   
   if(Rmks==''){
       alert('Enter teacher\'s remarks');
       $('#txt-edit_gen-remarks').focus();
       return false;
   }else{
       $.post('update_edit_tch_rmks.php',{Rmks:Rmks},function(e){
          if(e==1){
              
          }else{
              alert(e);
          }
       });
   }
});

$('#btn-save_edit-academic-rcd').click(function(){
     var CpNo=$.trim($('#lbl-edit_exam-coupon-no').text());
    var GRmks=$.trim($('#txt-edit_gen-remarks').val());
    
    if(CpNo==''){
        alert('Coupon No. not found');
        return false;
    }else if(GRmks==''){
        alert('Enter general remarks for student performance');
        $('#txt-edit_gen-remarks').focus();
        return false;
    }else{
    $('body').append('<div class="progress">Processing...</div>');
        $.post('run_edit_student_exams_records.php',{CpNo:CpNo, GRmks:GRmks},function(f){
         // alert(f);
         $('#tbl-std-list-edit-exams-score').load('load-std-list-edit-exams-score.php');
            $('#edit_exams_std_fname').load('load_edit_exams_stud_sel_temp_fname.php');
            $('#edit_exams_std_id').load('load_edit_exams_stud_sel_temp_id.php');
            $('#tbl_edit_sel_exams_score_subject').load('load_sel_edit_exams_score_student.php');
            $('#lbl-edit_exam-coupon-no').load('load_exam_coupon_no.php');
            $('#lbl-edit_exam-coupon-title').load('load_exam_coupon_title.php');
            $.post('load_edit_tch_exams_rmks.php',{},function(e){
                 $('#txt-edit_gen-remarks').val(e);
            });
          $('.progress').remove();
        });
    }
});

$('#undo-std-promo-temp-list').click(function(){
  $('body').append('<div class="progress">Processing...</div>');
   $.post('undo_student_promo_temp_list.php',{},function(e){
     
       if(e==1){
          $('#tbl-promo-std-list-temp').load('load_student_promo_temp_list.php')
          $('#promo_coupon_no_temp').load('load_coupon_no_promo_temp.php');
          $('#promo_coupon_title_temp').load('load_coupon_title_promo_temp.php');
          $('#promo_class_name_temp').load('load_class_name_promo_temp.php');
           $('.progress').remove(); 
       }else{
           alert(e);
       }
       
   }); 
});

$('#process-std-promo').click(function(){
    var ClassID = $('#student-promo-classname :selected').attr('id');
    var ClassName=$('#student-promo-classname').val();
    
    if(ClassName==''){
        alert('Select Class Name');
        $('#student-promo-classname').focus();
        return false;
    }else if(ClassID=='0'){
         alert('Select Class Name');
        $('#student-promo-classname').focus();
        return false;
    }else{
     $('body').append('<div class="progress">Processing...</div>');
      $.post('sel_promo_std_list_temp.php',{CID:ClassID,CName:ClassName},function(e){
         if(e==1){
          $('#tbl-promo-std-list-temp').load('load_student_promo_temp_list.php')
          $('#promo_coupon_no_temp').load('load_coupon_no_promo_temp.php');
          $('#promo_coupon_title_temp').load('load_coupon_title_promo_temp.php');
          $('#promo_class_name_temp').load('load_class_name_promo_temp.php');
          $.post('load_promo_batch_no.php',{CID:ClassID},function(a){
             // alert(a);
              $('#lbl-promo-batch-no').text(a); 
              $('.progress').remove(); 
          });     
          $('.progress').remove(); 
         }else{
          alert(e);
          $('.progress').remove(); 
         }
          
      });
    }
    
});


$('#btn-std-promo').click(function(){
    var Desc=$.trim($('#txt-promo-desc-nrt').val());
    var PrmClass=$('#student-promo-empty-class :selected').attr('id');
    var BatchID=$.trim($('#lbl-promo-batch-no').text());  
    
    //alert(Desc+" "+PrmClass+" "+BatchID);
    if(Desc==''){
        alert('Enter narration for promoted class');
    }else if(PrmClass==''){
        alert('Select promoted class');
    }else if(BatchID==''){
        alert('Promotion batch no. not found. Undo current selection and restart the process again.')
    }else{
       $('body').append('<div class="progress">Processing...</div>');
          $.post('run_student_promo.php',{Desc:Desc,PrmClass:PrmClass,BatchID:BatchID},function(e){
              $('#tbl-promo-std-list-temp').load('load_student_promo_temp_list.php');
              $('#txt-promo-desc-nrt').val('');
              $('#lbl-promo-batch-no').text('');
              $('#promo_coupon_no_temp').load('load_coupon_no_promo_temp.php');
              $('#promo_coupon_title_temp').load('load_coupon_title_promo_temp.php');
              $('#promo_class_name_temp').load('load_class_name_promo_temp.php');
              $('#student-promo-empty-class').load('load_promo_empty_class.php');
              $('#student-promo-classname').load('load_empty_class_prom.php');
              $('#student-promo-empty-class').val('');
              //alert(e);
              $('.progress').remove(); 
          });
    }
});

$('#crt-new-nationale').click(function(){
   var National=$.trim($('#txt-nation-name').val()); 
   
   if(National==''){
       alert('Enter Country\'s Name ');
       $('#txt-nation-name').focus();
       return false;
   }else{
       $.post('new-garinmu-setup.php',{Nt:National},function(e){
          if(e==1){
              $('#txt-nation-name').val(''); 
            $('#txt-nation-name').focus();  
          }else{
              alert(e);
          }
       });
   }
});

$('#crt-new-section').click(function(){
    var Section=$.trim($('#txt-section-name').val());
    
    if(Section==''){
        alert('Enter Section\'s Name');
        $('#txt-section-name').focus();
        return false;
    }else{
        $.post('new_section_setup.php',{Section:Section},function(e){
           if(e==1){
               alert('Section created successfully');
               $('#student_section_table').load('load_distinct_student_section.php');
               $('#txt-section-name').val(''); 
               $('#txt-section-name').focus(); 
           }else{
               alert(e);
           }
        });
    }
});

$('#btn-class-genpop').click(function(){
   var Class=$('#rpt-class-genpop-accname :selected').attr('id');
    var FDate = $('#class-genpop-fdate').val();
    var LDate = $('#class-genpop-ldate').val();
    var CName=$('#rpt-class-genpop-accname').val();
    
     if(FDate==''){
        alert('Select report beginning date');
        $('#std-genpop-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select report ending date');
        $('#std-genpop-ldate').focus();
        return false;
    }else if(Class=='0'){
       alert('Select Class');
       $('#rpt-class-genpop-accname').focus();
       return false;
   }else{
       $.post('class-gen-pop-rpt.php',{Class:Class,LDate:LDate,FDate:FDate,CName:CName},function(ansa){
            //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "class-gen-pop-rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#btn-gender-genpop').click(function(){
   var Class=$('#rpt-gender-genpop-accname :selected').attr('id');
    var FDate = $('#gender-genpop-fdate').val();
    var LDate = $('#gender-genpop-ldate').val();
    var Gender=$('#rpt-gender-genpop-accname').val();
    
     if(FDate==''){
        alert('Select report beginning date');
        $('#std-genpop-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select report ending date');
        $('#std-genpop-ldate').focus();
        return false;
    }else if(Class=='0'){
       alert('Select Gender');
       $('#rpt-class-genpop-accname').focus();
       return false;
   }else{
       $.post('gender-gen-pop-rpt.php',{Class:Class,LDate:LDate,FDate:FDate,Gender:Gender},function(ansa){
            //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "gender-gen-pop-rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#rpt-student_pop-analysis').click(function(){
   $.post('general_pop_analysis_rpt.php',{},function(ansa){
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "general_pop_analysis_rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
   });
});

$('#btn-std-ntlpop').click(function(){
   var Ntl=$('#rpt-ntl-genpop-accname :selected').attr('id');
    var FDate = $('#std-ntlpop-fdate').val();
    var LDate = $('#std-ntlpop-ldate').val();
    
     if(FDate==''){
        alert('Select report beginning date');
        $('#std-ntlpop-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select report ending date');
        $('#std-ntlpop-ldate').focus();
        return false;
    }else if(Ntl=='0'){
       alert('Select Nationality');
       $('#rpt-ntl-genpop-accname').focus();
       return false;
   }else{
       $.post('ntl-gen-pop-rpt.php',{LDate:LDate,FDate:FDate,Ntl:Ntl},function(ansa){
            //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "ntl-gen-pop-rpt.php", "scrollbars=1,width=1100, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
       });
   }
});

$('#sel-mob-accname-csh').blur(function(){

   var AccNo=$.trim($('#sel-mob-accname-csh :selected').attr('id')); 
   if(AccNo=='0'){
       
   }else{
   $('body').append('<div class="progress">Processing...</div>');
      $.post('check_mob_acc_balance.php',{AccNo:AccNo},function(e){
        $('#lbl-csh-mob-bal-chk').text(e);
         // alert(e);
        $('.progress').remove();  
    });
   $('.progress').remove();  
   }
   
});

$('#sel-other-accname-csh').blur(function(){

   var AccNo=$.trim($('#sel-other-accname-csh :selected').attr('id')); 
   if(AccNo=='0'){
       
   }else{
   $('body').append('<div class="progress">Processing...</div>');
      $.post('check_ledger_balance.php',{AccNo:AccNo},function(e){
        $('#lbl-other-csh-bal-chk').text(e);
         // alert(e);
        $('.progress').remove();  
    });
   $('.progress').remove();  
   }
   
});

$('#crt-bulk-deposit-csh').click(function(){
   var AccNo=$.trim($('#sel-mob-accname-csh :selected').attr('id')); 
   var Amt = $.trim($('#txt-csh-bulk-amount').val());
   var Descr=$.trim($('#txt-csh-bulk-nrt').val());
   var RcptNo=$.trim($('#lbl-csh-mob-bulk-rcpt-no').text());
   
   if(AccNo=='0'){
       alert('Select Mobilization Account');
       $('#sel-mob-accname-csh').focus();
       return false;
   }else if(Amt<=0){
        alert('Amount cannot be less than or equal to zero(0)');
        $('#txt-csh-bulk-amount').focus();
        return false;
   }else if(Amt==''){
       alert('Enter Bulk Mobilization Amount');
           $('#txt-csh-bulk-amount').focus();
           return false;
   }else if(Descr==''){
       alert('Enter Mobilization Description');
       $('#txt-csh-bulk-nrt').focus();
       return false;
   }else if(RcptNo==''){
       alert('Receipt No. not detected. Sign out for three minutes. If problem persists, contact your system administrator');
       return false;
   }else{
       $('body').append('<div class="progress">Processing...</div>');

       $.post('run_bulk_mob_csh.php',{AccNo:AccNo,Amt:Amt,Desc:Descr,RecNo:RcptNo},function(e){
           if(e==1){
               $('.progress').remove();
               $('.form-text').val('');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-csh-mob-bulk-rcpt-no').load('naamu_track.php');
               $('#lbl-csh-mob-bal-chk').text('0');
               $.post('mob-voucher.php',{e:RcptNo},function(em){
                    var newWindow = window.open("", "mob-voucher.php", "scrollbars=1,width=1200, height=1000");
                   // window.print(e);
                  //write the data to the document of the newWindow
                   newWindow.document.body.innerHTML=(em);
               });
               $('#sel-mob-accname-csh').focus();
               
           }else{
               alert(e);
               $('.progress').remove();
           }
       });
   }
});

$('#btn-stock-ordered-rpt').click(function(){
    var SFDate=$.trim($('#stock-sales-fdate').val());
    var SLDate=$.trim($('#stock-sales-ldate').val());
    
    if(SLDate==''){
        alert('Select First Report Date');
        $('#stock-sales-fdate').focus();
        return false;
    }else if(SFDate==''){
         alert('Select Last Report Date');
        $('#stock-sales-ldate').focus();
        return false;
    }else{
        $.post('run_stock_ordered_report.php',{SLDate:SLDate,SFDate:SFDate},function(e){
             var newWindow = window.open("", "run_stock_ordered_report.php", "scrollbars=1,width=1200, height=1000");
            // window.print(e);
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(e);
            
        });
    }
});

$('#btn-stock-sales-rpt').click(function(){
    var SFDate=$.trim($('#stock-sales-o-fdate').val());
    var SLDate=$.trim($('#stock-sales-o-ldate').val());
    
    if(SLDate==''){
        alert('Select First Report Date');
        $('#stock-sales-o-fdate').focus();
        return false;
    }else if(SFDate==''){
         alert('Select Last Report Date');
        $('#stock-sales-o-ldate').focus();
        return false;
    }else{
        $.post('run_stock_sales_report.php',{SLDate:SLDate,SFDate:SFDate},function(e){
             var newWindow = window.open("", "run_stock_sales_report.php", "scrollbars=1,width=1300, height=1000");
            // window.print(e);
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(e);
            
        });
    }
});

$('#btn-stock-outs-rpt').click(function(){
    var SLDate=$.trim($('#stock-outs-ldate').val());
    
     if(SLDate==''){
         alert('Select Report Date');
        $('#stock-outs-ldate').focus();
        return false;
    }else{
        $.post('run_stock_outs_report.php',{SLDate:SLDate},function(e){
             var newWindow = window.open("", "run_stock_outs_report.php", "scrollbars=1,width=1300, height=1000");
            // window.print(e);
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(e);
            
        });
    }
});

$('#add_std_mob_pmt_temp').click(function(){
  var Amt= $.trim($('#mob-money-amt').val());
  var StdID=$('.tbl-mob-sel-temp').attr('id');
  var AccNo=$.trim($('#std-mob-posting-pmt-acc-name :selected').attr('id'));
  var AccName=$.trim($('#std-mob-posting-pmt-acc-name :selected').val());
  var NPD=$.trim($('#std-temp-mob-posting-npd').val());
  
  if(StdID==''){
      alert('Select student from the list');
      $('#mob-money-amt').focus();
      return false;
  }else if(Amt==''){
     alert('Select student from the list and enter amount ');
      $('#mob-money-amt').focus();
      return false;  
  }else if(AccNo=='0'){
      alert('Select account');
      $('#std-mob-posting-pmt-acc-name').focus();
      return false;
  }else if(AccName==''){
      alert('Select account');
      $('#std-mob-posting-pmt-acc-name').focus();
      return false;
  }else if(NPD==''){
      alert('Select Next Payment Date');
      $('#std-temp-mob-posting-npd').focus();
      return false;
  }else{
     $('body').append('<div class="progress">Processing...</div>');
     $.post('add_std_sel_mob_pmt_temp.php',{Amt:Amt,AccNo:AccNo,StdID:StdID,NPD:NPD},function(e){
         if(e==1){
           $('.progress').remove();
           $('#tbl-mob-posting-temp_view').load('load_mob_postings_temp_view.php');
           $('#active-mob-account').load('load_active_mob_account.php');
           $('#mob_posting_total_temp').load('load_sub_total_mob_posting.php');
            $('#tbl-mob-posting-std-sel-temp').load('load_sel_std_mob_posting_temp.php')
           $('#txt-std-mob-posting-name').val('');
           $('#txt-std-mob-posting-name').focus();
         }else{
             alert(e);
           $('.progress').remove();
         }
        
     });
  }
});

$('#add_mob_posting_overs').click(function(){
   var Amt=$.trim($('#mob-posting-overs').val());
   
   if(Amt==''){
       alert('Enter overs amount');
       $('#mob-posting-overs').focus();
       return false;
   }else if(Amt<='0'){
       alert('Overs must be more than zero(0)');
       $('#mob-posting-overs').focus();
       return false;
   }else{
     $('body').append('<div class="progress">Processing...</div>');
     
     $.post('add_mob_overs_amt.php',{Amt:Amt},function(e){
         alert(e);
           $('.progress').remove();
     });
   }
});

$('#btn-mob-postings').click(function(){
    var RecNo=$.trim($('#lbl-mob-pmt-rec-no').text());
    if(RecNo==''){
        alert('Receipt No. not found');
        return false;
    }else{
       $('body').append('<div class="progress">Processing...</div>');
       $.post('run_mob_posting.php',{RecNo:RecNo},function(e){
           
           if(e==1){
               $('.progress').remove();
               $('#lbl-mob-pmt-rec-no').load('naamu_track.php');
               $('#mob_posting_total_temp').load('load_sub_total_mob_posting.php');
               $('#tbl-mob-posting-temp_view').load('load_mob_postings_temp_view.php');
               $('#tbl-mob-posting-std-sel-temp').load('load_sel_std_mob_posting_temp.php')
               $('#std-mob-posting-pmt-acc-name').load('load_distinct_fee_name.php');
               $('#txt-std-mob-posting-name').focus();
           }else{
             alert(e);
             $('.progress').remove();
           }
         }); 
    }
   
});

$('#school-fee-mapping-class-acc-name').blur(function(){
  var e = $('#school-fee-mapping-class-acc-name :selected').attr('id');  
  
   $.post('insert-school-fee-mapped-account-temp.php',{e:e},function(){
       //alert(a);
       $('#school-fee-mapped-account').load('load-school-fee-mapped-account.php');
        
   });
});

$('#school-fee-mapping-fee-acc-name').blur(function(){
  var e = $('#school-fee-mapping-fee-acc-name :selected').attr('id');  

    $.post('load_fee_mapped_amount.php',{e:e},function(amt){
        $('#txt-school-fee-acc-mapping').val(amt);
      });
       
});


$('#admitn-fee-mapping-class-acc-name').blur(function(){
  var e = $('#admitn-fee-mapping-class-acc-name :selected').attr('id');  
  
   $.post('insert-admission-fee-mapped-account-temp.php',{e:e},function(){
       //alert(a);
       $('#admission-fee-mapped-account').load('load-admission-fee-mapped-account.php');
        
   });
});

$('#admitn-fee-mapping-fee-acc-name').blur(function(){
  var e = $('#admitn-fee-mapping-fee-acc-name :selected').attr('id');  

    $.post('load_admission_fee_mapped_amount.php',{e:e},function(amt){
        $('#txt-admitn-fee-acc-mapping').val(amt);
      });
       
});


$('#crt-new-studentnb').click(function(){
      var STDFName=$.trim($('#stdnb-fname').val());
      var STDID=$.trim($('#lb-studentnb-id').text());
      var SID=$.trim($('#lb-studentnb-code').text());
      var Gender=$('#stdnb-gender :selected').val();
      var STDDOB=$.trim($('#stdnb-dob').val());
      var STDAddress=$.trim($('#stdnb-address').val());
      var STDSchAttnd=$.trim($('#stdnb-schattnd').val());
      var STDParent=$.trim($('#stdnb-parent').val());
      var STDPhone=$.trim($('#stdnb-phone').val());
      var STDLoc=$.trim($('#stdnb-location').val());
      var ClassID=$('#stdnb-class-name :selected').attr('id');
      var STDClassName =$('#stdnb-class-name').val();
      var Nt=$('#stdnb-nationale :selected').attr('id');
      var Prf=$.trim($('#stdnb-parent-prf').val());
      var Zips=$.trim($('#stdnb-zip').val());
      var Relg=$.trim($('#stdnb-religion :selected').attr('id'));
      var Trpt=$.trim($('#std-transport-means-nb :selected').attr('id'));
      var Section=$.trim($('#std-sectionnb :selected').attr('id'));
      
      if(STDFName==''){
          alert("Enter Student's Full Name");
          $($('#stdnb-fname').focus());
          return false;
      }else if(STDID==''){
          alert('Failure Generating Student ID');
          return false;
      }else if(SID==''){
          alert('Failure Generating Student IDs');
          return false;
      }else if(STDDOB==''){
          alert("Select Student's date of birth");
          ($('#stdnb-dob').focus());
          return false;
      }else if(STDAddress==''){
          alert("Enter Student's Residence or Postal Address");
          ($('#stdnb-address').focus());
          return false;
      }else if(STDSchAttnd==''){
          alert("Enter Student's Last School Attended");
         $('#stdnb-schattnd').focus(); 
          return false;
      }else if(STDParent==''){
          alert("Enter Parent/ Guardian's Full Name");
          ($('#stdnb-parent').focus());
          return false;
      }else if(Zips==''){
           alert("Enter Country\'s ZIP Code");
          ($('#stdnb-zip').focus());
          return false;
      }else if(Zips=='0' || Zips=='00' || Zips=='000'){
           alert("ZIP Code cannot be zero(0)");
          ($('#stdnb-phone').focus());
          return false;
      }else if(STDPhone==''){
          alert("Enter Parent/ Guardian's Phone No.");
          ($('#stdnb-phone').focus());
          return false;
      }else if(STDLoc==''){
          alert("Enter student's location or pick-up point");
          ($('#stdnb-location').focus());
          return false;
      }else if(Section=='0' || Section==''){
          alert('Select Section');
          $('#std-sectionnb').focus();
          return false;
      }else if(ClassID=='0'){
          alert("Select Class Admitted");
          $('#stdnb-class_name').focus();
          return false;
      }else if(STDClassName==''){
          alert("Select Class Admitted");
          $('#stdnb-class_name').focus();
          return false;
      }else if(Gender==''){
          alert('Select Student Gender');
          $('#stdnb-gender').focus();
          return false;
      }else if(Relg==''){
           alert('Select Student Religion');
          $('#stdnb-religion').focus();
          return false;
      }else if(Nt=='' || Nt=='0'){
          alert('Select Student\'s Nationality');
          $('#stdnb-nationale').focus();
          return false;
      }else if(Prf==''){
          alert('Specify Parent/Guandian\'s Profession');
          $('#stdnb-parent-prf').focus();
          return false;
      }else if(Relg=='0'){
          alert('Select Student\'s Religion');
          $('#stdnb-religion').focus();
          return false;
      }else if(Trpt=='0' || Trpt==''){
          alert('Select student\'s means of transport');
          $('#std-transport-means-nb').focus();
          return false;
      }else{
          
        $('body').append('<div class="progress">Processing...</div>');  
          $.post('newtualibnb.php',{STDID:STDID,SID:SID,Relg:Relg,Zip:Zips,Section:Section,FName:STDFName,Nt:Nt,Prf:Prf,Trpt:Trpt,Gender:Gender, DOB:STDDOB, Address:STDAddress, SchAttnd:STDSchAttnd,Phone:STDPhone, Parent:STDParent,ClassID:ClassID,Loc:STDLoc},function(ansa){
              if(ansa==1){
                  alert("New student info saved successfully");
                  $.post('assign_new_student_id.php',{},function(e){
                    // alert(Class);
                      // alert(e);
                        $('#lb-studentnb-id').text(e); 
                     });
                     $.post('get_id_student.php',{},function(e){
                        // alert(e);
                         $('#lb-studentnb-code').text(e);
                     });
                  $('.form-text').val('');
                  $('#stdnb-fname').focus();
                  $('.progress').remove();
              }else{
                  alert(ansa);
                  $('.progress').remove();
              }
          });
      }
   });

$('#txt-edit-student-info').keyup(function(){
var e = $.trim($('#txt-edit-student-info').val());   

$('body').append('<div class="progress">Processing...</div>');
    $.post('edit_student_search_info.php',{e:e},function(er){
        $('#student_search_display').html(er);
        $('.progress').remove();
    });

});


$('#txt-write-off-arrears-std-search').keyup(function(){
var e = $.trim($('#txt-write-off-arrears-std-search').val());   

$('body').append('<div class="progress">Processing...</div>');
    $.post('write-off-std-arrears-search-info.php',{e:e},function(er){
        $('#write-off-arrears-std-search-display').html(er);
        $('.progress').remove();
    });

});


$('#txt-write-daily-off-arrears-std-search').keyup(function(){
var e = $.trim($('#txt-write-daily-off-arrears-std-search').val());   

$('body').append('<div class="progress">Processing...</div>');
    $.post('write-off-std-daily-arrears-search-info.php',{e:e},function(er){
        $('#write-off-daily-arrears-std-search-display').html(er);
        $('.progress').remove();
    });

});

$('#crt-other-csh-account').click(function(){
   var Acc=$.trim($('#sel-other-accname-csh :selected').attr('id'));
   var Amt=$.trim($('#txt-other-cash-amount').val());
   var Desc=$.trim($('#txt-other-cash-nrt').val());
   var Rec=$.trim($('#lbl-other-csh-rcpt-no').text());
   
   if(Acc=='0'){
       alert('Select Account Name');
       $('#sel-other-accname-csh').focus();
       return false;
   }else if(Amt==''){
       alert('Enter amount received');
       $('#txt-other-cash-amount').focus();
       return false;
   }else if(Amt<='0'){
       alert('Amount must be more than zero(0)');
       $('#txt-other-cash-amount').focus();
       return false;
   }else if(Desc==''){
       alert('Enter description');
       $('#txt-other-cash-nrt').focus();
       return false;
   }else if(Rec==''){
       alert('Receipt no. not found');
       return false;
   }else{
       //alert(Acc+" "+Amt+" "+Desc+" "+Rec);
       
        $.post('run_other_cash_receipt.php',{AccNo:Acc, Amt:Amt,Descr:Desc,RcptNo:Rec},function(ansa){
         
            if(ansa==1){
                alert('Transaction saved successfully');
                $('.form-text').val('');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-bank-dep-rcpt-no').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });
   }
});

//-//------------------------------------------------//-//-------

$('#crt-other-income-csh-account').click(function(){
   var Acc=$.trim($('#sel-other-income-accname-csh :selected').attr('id'));
   var Amt=$.trim($('#txt-other-income-cash-amount').val());
   var Desc=$.trim($('#txt-other-income-cash-nrt').val());
   var Rec=$.trim($('#lbl-other-income-csh-rcpt-no').text());
   
   if(Acc=='0'){
       alert('Select Account Name');
       $('#sel-other-income-accname-csh').focus();
       return false;
   }else if(Amt==''){
       alert('Enter amount received');
       $('#txt-other-income-cash-amount').focus();
       return false;
   }else if(Amt<='0'){
       alert('Amount must be more than zero(0)');
       $('#txt-other-income-cash-amount').focus();
       return false;
   }else if(Desc==''){
       alert('Enter description');
       $('#txt-other-income-cash-nrt').focus();
       return false;
   }else if(Rec==''){
       alert('Receipt no. not found');
       return false;
   }else{
       //alert(Acc+" "+Amt+" "+Desc+" "+Rec);
       
        $.post('run_other_income_cash_receipt.php',{AccNo:Acc, Amt:Amt,Descr:Desc,RcptNo:Rec},function(ansa){
         
            if(ansa==1){
                alert('Transaction saved successfully');
                $('.form-text').val('');
               $('#cashbook').load('load_cashbook_balance.php');
               $('#lbl-bank-dep-rcpt-no').load('naamu_track.php');
            }else{
                alert(ansa);
            }
        });
   }
});

//----/------////------------------------------------------------------

$('#btn-fee-repayment').click(function(){
   
    var FDate = $('#fee-rpmt-fdate').val();
    var LDate = $('#fee-rpmt-ldate').val();
    
    if(FDate==''){
        alert('Select beginning date');
        $('#class-mob-fdate').focus();
        return false;
    }else if(LDate == ''){
          alert('Select ending date');
        $('#class-mob-ldate').focus();
        return false;
    }else{
        //alert(FDate+" "+LDate);
                 
        $.post('fee-repayment-rpt.php',{FDate:FDate, LDate:LDate},function(ansa){
            
          //  $('#shw-daily-mob').html(ansa); 
          var newWindow = window.open("", "fee-repayment-rpt-rpt.php", "scrollbars=1,width=1250, height=1000");
          
           //write the data to the document of the newWindow
            newWindow.document.body.innerHTML=(ansa);
            
        });
    }
});

$('#btn-income-ldg-sttmtnt').click(function(){
   var FDate=$('#income-ldg-sttmtnt-fdate').val();
   var LDate=$('#income-ldg-sttmtnt-ldate').val();
   var AccNo=$.trim($('#rpt-inc-sttmnt-account-name :selected').attr('id'));
   
    if(FDate==''){
       alert('Select first statement date');
        $('#income-ldg-sttmtnt-fdate').focus();
        return false;
        }else if(LDate==''){
            alert('Select last statement Date');
          $('#income-ldg-sttmtnt-fdate').focus();
          return false;
       }else if(AccNo=='0'){
            alert('Select Account');
            $('#rpt-inc-sttmnt-account-name').focus();
            return false;
       }else{
            $.post('income_ledger_statement.php',{FDate:FDate, LDate:LDate,AccNo:AccNo},function(ansa){
                //  $('#shw-daily-mob').html(ansa); 
                //alert(AccountID);
              var newWindow = window.open("", "income_ledger_statement.php", "scrollbars=1,width=1250, height=1000");

               //write the data to the document of the newWindow
                newWindow.document.body.innerHTML=(ansa);

            }); 
       }
   
});

$('#btn-exp-ldg-sttmtnt').click(function(){
   var FDate=$('#exp-ldg-sttmtnt-fdate').val();
   var LDate=$('#exp-ldg-sttmtnt-ldate').val();
   var AccNo=$.trim($('#rpt-exp-sttmnt-account-name :selected').attr('id'));
   
    if(FDate==''){
       alert('Select first statement date');
        $('#exp-ldg-sttmtnt-fdate').focus();
        return false;
        }else if(LDate==''){
            alert('Select last statement Date');
          $('#exp-ldg-sttmtnt-fdate').focus();
          return false;
       }else if(AccNo=='0'){
            alert('Select Account');
            $('#rpt-exp-sttmnt-account-name').focus();
            return false;
       }else{
            $.post('exp_ledger_statement.php',{FDate:FDate, LDate:LDate,AccNo:AccNo},function(ansa){
                //  $('#shw-daily-mob').html(ansa); 
                //alert(AccountID);
              var newWindow = window.open("", "exp_ledger_statement.php", "scrollbars=1,width=1250, height=1000");

               //write the data to the document of the newWindow
                newWindow.document.body.innerHTML=(ansa);

            }); 
       }
   
});


$('#btn-daily-mob-analysis').click(function(){
    var Dt=$.trim($('#daily-mob-analysis-fdate').val());
    var CID=$.trim($('#rpt-mob-analysis-class-name :selected').attr('id'));
    var CN=$.trim($('#rpt-mob-analysis-class-name').val());
    
    if(Dt===''){
        alert('Select report date');
        $('#daily-mob-analysis-fdate').focus();
        return false;
    }else if(CN===''){
        alert('Select class');
        $('#rpt-mob-analysis-class-name').focus();
        return false;
    }else if(CID==='0'){
        alert('Select class');
        $('#rpt-mob-analysis-class-name').focus();
        return false;
    }else{
        $.post('insert_daily_mob_analysis_details.php',{CID:CID,Dt:Dt},function(){
            $.post('',{},function(){
               $.post('daily_mob_analysis_rpt.php',{FDate:Dt,CID:CID},function(ansa){
             
                   var newWindow = window.open("", "daily_mob_analysis_rpt.php", "scrollbars=1,width=1100, height=1000");

                    //write the data to the document of the newWindow
                     newWindow.document.body.innerHTML=(ansa);

                }); 
            });
        });
    }
});


$('#txt-std-account-tools').keyup(function(){
var e = $.trim($('#txt-std-account-tools').val());   

$('body').append('<div class="progress">Processing...</div>');
    $.post('search_student_account_tools_info.php',{e:e},function(er){
        $('#student_account-tools-display').html(er);
        $('.progress').remove();
    });

});


$('#txt-std-account-tools-react').keyup(function(){
var e = $.trim($('#txt-std-account-tools-react').val());   

$('body').append('<div class="progress">Processing...</div>');
    $.post('search_student_account_tools_info_react.php',{e:e},function(er){
        $('#search_student_account_tools_react_display').html(er);
        $('.progress').remove();
    });

});

$('#btn-deact-student-account-rpt').click(function(){
   var FDate=$('#deact-status-fdate-rpt').val(); 
   
   if(FDate==''){
       alert('Select Report Date');
       $('#deact-status-fdate-rpt').focus(); 
       return false;
   }else{
       $.post('rpt_deactivate_status_report.php',{DT:FDate},function(e){
            var newWindow = window.open("", "rpt_deactivate_status_report.php", "scrollbars=1,width=1250, height=1000");

            //write the data to the document of the newWindow
             newWindow.document.body.innerHTML=(e);
    });
   }
});

$('#crt-end-academic-coupon').click(function(){
    
   $.post('check_user_coupon.php',{},function(an){
       if(an==1){
            $.post('end_active_academic_coupon.php',{},function(e){
                if(e==1){
                    alert('Active academic coupon ended successfully');
                    $('#view_end_active_coupon').load('end_active_coupon_view.php');
                }else{
                    alert(e);
                }
            });
       }else{
           alert('Access Denied');
       }
        
    });
});


$('#crt-new-control').click(function(){
   var Name=$.trim($('#new-controlname').val());
   var ID=$.trim($('#lb-control-id').text());
   
   if(ID==''){
       alert('Control ID not found');
       return false;
   }else if(Name==''){
       alert('Enter Control Name');
       $('#new-controlname').focus();
       return false;
   }else{
       $.post('run_new_control.php',{ID:ID,Name:Name},function(e){
           if(e==1){
               $('#lb-control-id').load('get_new_control_id.php');
               $('#tbl_control_display').load('load_distinct_control_name.php');
                $('#new-controlname').val('');
                $('#new-controlname').focus();
           }else{
               alert(e);
           }
       });
   }
});

$('#ledger_control_id').change(function(){
   var ID = $('#ledger_control_id :selected').attr('id');
   
  if(ID==''){
      return false;
  }else{
      $.post('load_new_ledger_id.php',{ID:ID},function(e){
          $.post('load_distinct_control_ledger_name.php',{ID:ID},function(f){
               $('#tbl_control_ledger_display').html(f);
          });
          $('#lbl-ledger-id').text(e);
          $('#new-ledgername').focus();
      });
  }
});

$('#crt-new-ledger').click(function(){
   var CID=$.trim($('#ledger_control_id :selected').attr('id'));
   var LID=$.trim($('#lbl-ledger-id').text());
   var Name=$.trim($('#new-ledgername').val());
   var CName=$.trim($('#ledger_control_id').val());
   var CtID=$.trim($('#ledger_category_id :selected').attr('id'));
  // alert(CID+" "+LID+" "+Name); 
  if(CID=='0' || CID==''){
      alert('Select Control');
      $('#ledger_control_id').focus();
      return false;
  }else if(LID==''){
      alert('Ledger ID not found');
      return false;
  }else if(Name==''){
      alert('Enter Ledger Name');
      $('#new-ledgername').focus();
      return false;
  }else if(CtID=='0' || CtID==''){
      alert('Select Category');
      $('#ledger_category_id').focus();
      return false;
  }else{
      $.post('run_new_ledger.php',{CID:CID,LID:LID,Name:Name,CName:CName,CtID:CtID},function(e){
          if(e==1){
              alert('Ledger created successfully');
              $('#ledger_control_id').load('load_distinct_control_id_ledger.php');
              $('#ledger_category_id').load('load_distinct_ledger_category.php');
               $.post('load_distinct_control_ledger_name.php',{ID:CID},function(f){
               $('#tbl_control_ledger_display').html(f);
          });
              $('#new-ledgername').val('');
              $('#new-ledgername').focus();
          }else{
              alert(e);
          }
      });
  }
});

$('#crt-new-incoem-acc').click(function(){
  var Code=$.trim($('#lbl-active-pnl-inc-id').text());
  var LID=$.trim($('#lbl-inc-account-id').text());
  var Name=$.trim($('#new-inc-account-name').val());
  var CID=$.trim($('#lbl-inc-cat-id').text());
  var Bl=$.trim($('#income_status_bill :selected').attr('id'));
  
  if(Code==''){
      alert('Active Profit and Loss account not yet configured');
      return false;
  }else if(LID==''){
      alert('Income Account ID not found');
      return false;
  }else if(Name==''){
      alert('Enter Income Account name');
      $('#new-inc-account-name').focus();
      return false;
  }else if(CID==''){
      alert('Income Category ID not found');
      return false;
  }else if(Bl=='0' || Bl==''){
      alert('Select Income Account Status');
      $('#income_status_bill').focus();
      return false;
  }
  else{
    //  alert(Code+" "+LID+" "+Name+" "+CID);
    
    $.post('run_new_income_account.php',{Code:Code,LID:LID,Name:Name,CID:CID,Bl:Bl},function(e){
        if(e==1){
            alert('Income Account created successfully');
             $('#lbl-inc-account-id').load('load_distinct_income_account_id.php');
             $('#tbl_income_account_display').load('load_distinct_income_account_name.php');
             $('#new-inc-account-name').val('');
             $('#income_status_bill').val('');
             $('#new-inc-account-name').focus();
        }else{
            alert(e);
        }
    });
  }
});


$('#crt-new-expenditure-acc').click(function(){
  var Code=$.trim($('#lbl-active-pnl-exp-id').text());
  var LID=$.trim($('#lbl-exp-account-id').text());
  var Name=$.trim($('#new-exp-account-name').val());
  var CID=$.trim($('#lbl-exp-cat-id').text());
  
  if(Code==''){
      alert('Active Profit and Loss account not yet configured');
      return false;
  }else if(LID==''){
      alert('Expenditure Account ID not found');
      return false;
  }else if(Name==''){
      alert('Enter Expenditure Account name');
      $('#new-exp-account-name').focus();
      return false;
  }else if(CID==''){
      alert('Expenditure Category ID not found');
      return false;
  }else{
    //  alert(Code+" "+LID+" "+Name+" "+CID);
    
    $.post('run_new_expenditure_account.php',{Code:Code,LID:LID,Name:Name,CID:CID},function(e){
        if(e==1){
            alert('Expenditure Account created successfully');
             $('#lbl-exp-account-id').load('load_distinct_income_account_id.php');
             $('#tbl_expenditure_account_display').load('load_distinct_expenditure_account_name.php');
             $('#new-exp-account-name').val('');
             $('#new-exp-account-name').focus();
        }else{
            alert(e);
        }
    });
  }
});

$('#rpt-gl-account-chart').click(function(){
       window.open("gl_chart_of_account_rpt.php", "", "scrollbars=1,width=1250, height=1000");
})

$('#rpt-pnl-account-chart').click(function(){
       window.open("pnl_chart_of_account_rpt.php", "", "scrollbars=1,width=1250, height=1000");
});

$('#btn-gl-ldg-sttmtnt').click(function(){
   var FDate=$('#gl-ldg-sttmtnt-fdate').val();
   var LDate=$('#gl-ldg-sttmtnt-ldate').val();
   var AccNo=$.trim($('#rpt-gl-sttmnt-account-name :selected').attr('id'));

     if(AccNo=='0'){
            alert('Select Account');
            $('#rpt-gl-sttmnt-account-name').focus();
            return false;
       }else if(FDate==''){
            alert('Select first statement date');
             $('#gl-ldg-sttmtnt-fdate').focus();
             return false;
        }else if(LDate==''){
            alert('Select last statement Date');
          $('#gl-ldg-sttmtnt-ldate').focus();
          return false;
       }else{
            $.post('gledger_statement_rpt.php',{FDate:FDate, LDate:LDate,AccNo:AccNo},function(ansa){
                //  $('#shw-daily-mob').html(ansa); 
                //alert(AccountID);
              var newWindow = window.open("", "income_ledger_statement.php", "scrollbars=1,width=1250, height=1000");

               //write the data to the document of the newWindow
                newWindow.document.body.innerHTML=(ansa);

            }); 
       }
   
});

$('#btn-gen-mob-analysis').click(function(){
  var FDate=$('#gen-mob-analysis-fdate').val();
   var LDate=$('#gen-mob-analysis-ldate').val();
   var AccNo=$.trim($('#rpt-gen-mob-analysis-accname :selected').attr('id'));

     if(FDate==''){
            alert('Select first report date');
             $('#gen-mob-analysis-fdate').focus();
             return false;
        }else if(LDate==''){
            alert('Select last report Date');
          $('#gen-mob-analysis-ldate').focus();
          return false;
       }else if(AccNo=='0'){
            alert('Select Transport');
            $('#rpt-gen-mob-analysis-accname').focus();
            return false;
       }else {
        $('body').append('<div class="progress">Processing...</div>');  
        
        $.post('insert_gen_mobil_rpt_date.php',{FD:FDate,LD:LDate,Class:AccNo},function(e){
            
            if(e==1){
              
              $('.progress').remove();
            }else{
              alert(e);
              $('.progress').remove();
            }
           
          });
           
       }
});


$('#btn-detls-mob-analysis').click(function(){
   var FDate=$('#detls-mob-analysis-fdate').val();
   var LDate=$('#detls-mob-analysis-ldate').val();
   var AccNo=$.trim($('#rpt-detls-mob-analysis-accname :selected').attr('id'));
   var AccName=$.trim($('#rpt-detls-mob-analysis-accname').val());
   
     if(FDate==''){
            alert('Select first report date');
             $('#detls-mob-analysis-fdate').focus();
             return false;
        }else if(LDate==''){
            alert('Select last report Date');
          $('#detls-mob-analysis-ldate').focus();
          return false;
       }else if(AccNo=='0' || AccNo==''){
            alert('Select Transport');
            $('#rpt-detls-mob-analysis-accname').focus();
            return false;
       }else if(AccName==''){
           alert('Select Transport');
            $('#rpt-detls-mob-analysis-accname').focus();
            return false;
       }else {
        $('body').append('<div class="progress">Processing...</div>');  
        
        $.post('insert_detl_mobil_rpt_date.php',{FD:FDate,LD:LDate,SID:AccNo},function(e){
            
            if(e==1){
              
             // $.post('detail_mobilisation_report_analysis.php',{FD:FDate,LD:LDate,Class:AccNo},function(){
                  
                  window.open("detail_mobilization_analysis_rpt.php","My window","width=1500, height=1000,titlebar=yes");
                  
                   $('.progress').remove();
                   
                  //var newWindow = window.open("", "issue-unifrom-stationery.php", "scrollbars=1,width=1250, height=1000");

                  //write the data to the document of the newWindow
                  //newWindow.document.body.innerHTML=(ansa);
             // });
              
              $('.progress').remove();
            }else{
              alert(e);
              $('.progress').remove();
            }
           
          });
           
       }
});

$('#btn-gen-class-bill').click(function(){
   var CID=$.trim($('#rpt-gen-std-bill-class-name :selected').attr('id'));
   var DT=$.trim($('#gen-class-bill-fdate').val());
   
   
   if(CID=='' || CID=='0'){
       alert('Select Class ');
       $('#rpt-gen-std-bill-class-name').focus();
       return false;
   }else if(DT==''){
       alert('Select Class Billing Date');
       $('#gen-class-bill-fdate').focus();
       return false;
   }else{
       $('body').append('<div class="progress">Processing...</div>');  
  
       $.post('insert_gen_bill_dt_rpt.php',{CID:CID,DT:DT},function(e){
           if(e==1){
             $('.progress').remove();
             window.open("run_general_student_bill_rpt.php","General Student Billing Report","width:1000, height:1000, titlebar=yes");  
           }else{
               alert(e);
           }
           });
   }
});


});
