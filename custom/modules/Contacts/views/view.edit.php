<?php

require_once('include/MVC/View/views/view.edit.php');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


class ContactsViewEdit extends ViewEdit {

    function ContactsViewEdit(){
        parent::ViewEdit();
    } 

    function display(){
        global $sugar_config,$db,$current_user;

        if(empty($this->bean->id)){
          $programme = BeanFactory::getBean('Project',$_REQUEST['project_contacts_2project_ida']);
          $this->bean->programme_type_c = $programme->programme_type_c;
          $this->bean->programme_year_c = $current_user->programme_year_c;
        }
        if(!empty($_REQUEST['email1'])){
          $email_id = $_REQUEST['email1'];
          $this->bean->emailAddress->addresses = $_REQUEST['email1'];
          echo $email = <<<email
           <script type="text/javascript">
           $(document).ready(function(){
                  setTimeout(function(){
                    $('#Contacts0emailAddress0').val('{$email_id}');
                    
                  },1000);
          });
          </script>
email;
        }
        if($_REQUEST['return_module'] == 'Leads'){
            $this->bean->enquiry_id_c = $_REQUEST['return_id'];
        }
        $js=<<<abc
        <script type="text/javascript">

              $(document).ready(function(){
                passportCheck();
                $('#nationality_c').on('change',function(){
                  passportCheck();
                });
                $('#enquiry_id_c').parent().parent().hide();
                  Calendar.setup ({
                    inputField : "birthdate",
                    form : "EditView",
                    ifFormat : "%d-%m-%Y %H.%M",
                    daFormat : "%d-%m-%Y %H.%M",
                    button : "birthdate_trigger",
                    singleClick : false,
                    dateStr : "",
                    startWeekday: 0,
                    step : 1,
                    mindate: "04-07-2017",
                    weekNumbers:false
                  }
                  );
                  //make organisation relate field mandatory
                  addToValidate('EditView','account_name','varchar',true,'Organisation:');    
                  $('#account_name_label').html('Organisation Name: <font color="red">*</font>');                   
                  
                  function calculateAge(dateString) { // birthday is a date
                    var mdate = dateString.toString();
                    var yearThen = parseInt(mdate.substring(6,10), 10);
                    var monthThen = parseInt(mdate.substring(3,5), 10);
                    var dayThen = parseInt(mdate.substring(0,2), 10);
                    
                    var today = new Date();
                    var birthday = new Date(yearThen, monthThen-1, dayThen);
                    
                    var differenceInMilisecond = today.valueOf() - birthday.valueOf();
                    
                    var year_age = Math.floor(differenceInMilisecond / 31536000000);
                    var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
                    
                    if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
                        alert("Happy B'day!!!");
                    }
                    
                    var month_age = Math.floor(day_age/30);
                    
                    day_age = day_age % 30;
                    
                    if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
                        return 0;
                        // $("#exact_age").text("Invalid birthday - Please try again!");
                    }
                    else {
                       return year_age;
                        // $("#exact_age").html("You are<br/><span id=\"age\">" + year_age + " years " + month_age + " months " + day_age + " days</span> old");
                    }
                  }

                  $('#birthdate_trigger').attr('tabindex',2);
                  
                  $(document).on('click','#container_birthdate_trigger .calcell',function(){
                     var dateI = $('#birthdate_trigger').prev('input');
                      setTimeout(function(){
                        var date = dateI.val();
                        var birthday = calculateAge(date);
                        if(birthday != 0){
                          $('#age_c').val(birthday);
                        }                        
                      }, 1000);
                  });

                  $('#birthdate_trigger, #container_birthdate_trigger_c, #birthdate').blur(function(){
                      var dateI = $('#birthdate_trigger').prev('input');
                      setTimeout(function(){
                        var date = dateI.val();
                        var birthday = calculateAge(date);
                        $('#age_c').val(birthday);
                      }, 1000);
                  });

                  $('#birthdate').blur(function(){
                        console.log($(this).val());
                        var date = $(this).val();
                        var birthday = calculateAge(date);
                        $('#age_c').val(birthday);
                  });

                  $('#project_contacts_2_name_label').append('<span class="required">*</span>');
                  addToValidate('EditView','project_contacts_2_name','project_contacts_2_name',true,'Programme Title');
                  sp();
                  //ss();
                  rejected();
                  makerequired();

                  $('#remove_button').attr('onclick','');

                  $('#remove_button').on('click',function(){
                     
                      $('#photo_new').css('display','block');
                      $('#photo_old').css('display','none');

                  });

                  $('#programme_type_c').on('change',function(){
                     sp();
                  });
                  $('#self_sponsored_c').on('click',function(){  
                    ss();
                  });

                  $('#nomination_status_c').on('change',function(){
                     rejected();
                     makerequired();
                  });
                  
                  
              });
              
              function passportCheck(){
                var nationality = $('#nationality_c').val();
                  if(nationality != 'Indian'){
                    addToValidate('EditView','passport_number_c','varchar',true,'Passport Number::');    
                    $('#passport_number_c_label').html('Passport Number: <font color="red">*</font>');
                  }else{
                    removeFromValidate('EditView','passport_number_c');    
                    $('#passport_number_c_label').html('Passport Number:');
                  }
              }
              function makerequired()
             {
                var status = $('#nomination_status_c').val(); 
                if(status == 'Rejected'){ 
                    addToValidate('EditView','reasons_for_rejection_c','varchar',true,'Reasons for Rejection:');    
                    $('#reasons_for_rejection_c_label').html('Reasons for Rejection: <font color="red">*</font>'); 
                }
                else{
                    removeFromValidate('EditView','reasons_for_rejection_c');                        
                    $('#reasons_for_rejection_c_label').html('Reasons for Rejection:');
                }
            }

              function ss(){
                if($('#self_sponsored_c').is(':checked')){
                      $('#sponsor_organisation_c').val($('#account_name').val());
                      $('#account_id_c').val($('#account_id').val());                      
                      $('#sponsor_organisation_c').attr('readonly',true);                      
                      $('#btn_clr_sponsor_organisation_c').attr('disabled',true);                      
                      $('#btn_sponsor_organisation_c').attr('disabled',true);

                      removeFromValidate('EditView','account_id');    
                      removeFromValidate('EditView','account_name');    
                      removeFromValidate('EditView','account_id_c');    
                      removeFromValidate('EditView','sponsor_organisation_c');    
                      $('#account_name_label').html('Organisation Name:');
                      $('#sponsor_organisation_c_label').html('Sponsor Organisation:');

                      hideWhenSS();                      
                    }
                    else{
                      $('#sponsor_organisation_c').val('');
                      $('#account_id_c').val('');
                      $('#sponsor_organisation_c').attr('readonly',false);                      
                      $('#btn_clr_sponsor_organisation_c').attr('disabled',false);                      
                      $('#btn_sponsor_organisation_c').attr('disabled',false);

                      addToValidate('EditView','account_id','varchar',true,'organisation Name:'); 
                      addToValidate('EditView','account_name','varchar',true,'organisation Name:'); 
                      addToValidate('EditView','sponsor_organisation_c','varchar',true,'organisation Name:'); 
                      addToValidate('EditView','account_id_c','varchar',true,'organisation Name:'); 
                      $('#account_name_label').html('Organisation Name: <font color="red">*</font>');
                      $('#sponsor_organisation_c_label').html('Sponsor Organisation: <font color="red">*</font>');

                      showWhenSS();  
                    }

              }

              function hideWhenSS(){
                $('#tan_date_c_label').hide();
                $('#tan_date_c').parent().hide();

                $('#tan_no_c_label').hide();
                $('#tan_no_c').parent().hide();
                
                $('#pan_no_c_label').hide();
                $('#pan_no_c').parent().hide();

                $('#pan_date_c_label').hide();
                $('#pan_date_c').parent().hide();     

                $('#sponsor_details_c_label').hide();
                $('#sponsor_details_c').parent().hide();                                
              }

              function showWhenSS(){
                $('#tan_date_c_label').show();
                $('#tan_date_c').parent().show();

                $('#tan_no_c_label').show();
                $('#tan_no_c').parent().show();
                
                $('#pan_no_c_label').show();
                $('#pan_no_c').parent().show();

                $('#pan_date_c_label').show();
                $('#pan_date_c').parent().show();                

                $('#sponsor_details_c_label').show();
                $('#sponsor_details_c').parent().show();                                
              }
              

              function sp(){
                if($('#programme_type_c').val() == 'Sponsored'){
                    $('#date_of_entry_into_govt_c_label').parent().show();
                }else{
                    $('#date_of_entry_into_govt_c_label').parent().hide();
                }
              }

              function rejected(){
                 if($('#nomination_status_c').val() == 'Rejected'){
                    $('#reasons_for_rejection_c_label').parent().show();
                }else{
                    $('#reasons_for_rejection_c_label').parent().hide();
                }
                
              }

        </script>
abc;
echo $js;
      parent::display();
    }

}
