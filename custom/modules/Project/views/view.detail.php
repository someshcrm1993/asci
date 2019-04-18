<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


require_once('modules/Project/views/view.detail.php');
class CustomProjectViewDetail extends ProjectViewDetail{
    public function display(){

        $date_closed = date('Y-m-d', strtotime(' +30 day')); // current_date + 30 days

        global $sugar_config;

        $aop_portal_enabled = !empty($sugar_config['aop']['enable_portal']) && !empty($sugar_config['aop']['enable_aop']);
        require_once('custom/modules/Contacts/metadata/listviewdefs.php');
        $lops = $this->bean->get_linked_beans('project_contacts_2','', 'name', 0, -1, 0, "nomination_status_c='Accepted'");

        if(empty($lops)){
            $lop = '<p style="text-align:center !important">No Data</p>';
            echo '<script>
            $("document").ready(function(){
                $("#whole_subpanel_project_aos_invoices_1").hide();
                $("#whole_subpanel_project_aos_quotes_1").hide();
                $("#whole_subpanel_project_scrm_accommodation_1").hide();
                $("#whole_subpanel_project_scrm_travel_details_1").hide();
            });
            </script>';
        }else{
            $lop = ' <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Profile Pic</th><th>Name</th><th> Organisation</th> <th>Email</th> <th>Mobile</th> </tr> </thead> <tbody style="text-align:center !important">';
            foreach ($lops as $value) {
                $img = $value->photo;
                if(empty($img)){
                    $photo = '<img src="custom/modules/Contacts/user.png" style="max-width: 50px;max-height: 30px; border-radius: 100px;" height="80">';
                   
                }else{
                    $photo = '<img src="index.php?entryPoint=download&amp;id='.$value->id.'_photo&amp;type=Contacts" style="max-width: 50px;max-height: 30px; border-radius: 100px;" height="80">';
                }
                $lop .= '<tr><td>'.$photo.'</td> <td><a href="index.php?module=Contacts&action=DetailView&record='.$value->id.'">'.$value->name.'</a></td><td>'.$value->account_name.'</td> <td>'.$value->email1.'</td> <td>'.$value->phone_mobile.'</td> </tr>';
        }
        $lop .="</tbody> </table> ";
        }
        
        $this->ss->assign("AOP_PORTAL_ENABLED", $aop_portal_enabled);
        $days = 0;
        if(!(empty($this->bean->start_date_c)) && !(empty($this->bean->end_date_c))){
            $start1 = strtotime($this->bean->start_date_c);
            $end1 = strtotime($this->bean->end_date_c);
            $days = ceil(abs($end1 - $start1) / 86400)+1;
        }
       

        require_once('modules/AOS_PDF_Templates/formLetter.php');
        formLetter::DVPopupHtml('Project');
        parent::display();

        $participantsBean = $this->bean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
        if (count($participantsBean)>0) {
            $createAccommodation = 3;
        }else{
            $createAccommodation = 2;
        }

        echo $js=<<<abc
        <script type="text/javascript">
              $(document).ready(function(){

                if ({$createAccommodation} == 2) {
                    $('#scrm_Accommodation_create_button').unbind('click');
                    $('#project_scrm_accommodation_1_select_button').unbind('click');
                    
                }

                if('{$this->bean->venue_c}' == 'CR'){
                    $('#hotel_c').parent().parent('div').hide();
                }

                if('{$this->bean->overseas_tour_c}' == '' || '{$this->bean->overseas_tour_c}' == 'No'){
                    $('#from_date_c').parent().parent('div').hide();
                    $('#to_date_c').parent().parent('div').hide();
                }

                // if(!('{$this->bean->programme_type_c}' == 'ICTP-On Campus' || '{$this->bean->programme_type_c}' == 'ICTP-Off Campus')){
                //     $('#detailpanel_4').hide(); 
                // }else{
                //     $('#detailpanel_3').hide();  
                // }



                if($('#scrm_admin_arranges_project_1scrm_admin_arranges_ida').text() == ''){
                        $('div[field=scrm_admin_arranges_project_1_name]').before('<a href="index.php?module=scrm_Admin_Arranges&action=EditView&scrm_admin_arranges_project_1_name={$this->bean->name}&scrm_admin_arranges_project_1project_idb={$this->bean->id}&programme_from_date_c={$this->bean->start_date_c}&programme_to_date_c={$this->bean->end_date_c}&no_of_participants_c={$this->bean->no_of_participants_c}&inauguration_date_time_c={$this->bean->inauguration_date_time_c}&conference_room_c={$this->bean->cr_no_c}"><i class="fa fa-plus"></i></a>');
                }
                if($('#project_scrm_timetable_1scrm_timetable_idb').text() == ''){
                        $('div[field=project_scrm_timetable_1_name]').before('<a href="index.php?module=scrm_Timetable&action=EditView&project_scrm_timetable_1_name={$this->bean->name}&project_scrm_timetable_1project_ida={$this->bean->id}&start_date_c={$this->bean->start_date_c}&end_date_c={$this->bean->end_date_c}&programme_code_c={$this->bean->programme_id_c}&no_of_days_c={$days}"><i class="fa fa-plus"></i></a>');
                }
                if($('#project_opportunities_1opportunities_idb').text() == ''){
                        $('div[field=project_opportunities_1_name]').before('<a href="index.php?module=Opportunities&action=EditView&programme_type_c={$this->bean->programme_type_c}&project_opportunities_1_name={$this->bean->name}&project_opportunities_1project_ida={$this->bean->id}"><i class="fa fa-plus"></i></a>');
                }
                if($('#project_scrm_work_order_1scrm_work_order_idb').text() == ''){
                        $('div[field=project_scrm_work_order_1_name]').before('<a href="index.php?module=scrm_Work_Order&action=EditView&programme_type_c={$this->bean->programme_type_c}&project_scrm_work_order_1_name={$this->bean->name}&project_scrm_work_order_1project_ida={$this->bean->id}"><i class="fa fa-plus"></i></a>');
                }
                if($('#project_scrm_budget_1scrm_budget_idb').text() == ''){
                        $('div[field=project_scrm_budget_1_name]').before('<a href="index.php?module=scrm_Budget&action=EditView&project_scrm_budget_1_name={$this->bean->name}&project_scrm_budget_1project_ida={$this->bean->id}&prg_fee_per_participant_c={$this->bean->programme_fee_c}&prog_fee_per_participant_usd_c={$this->bean->usd_c}"><i class="fa fa-plus"></i></a>');
                }
                
                var ppd = '<tr><td><div style="padding-top:20px"><a href="javascript;"><i class="fa fa-user fa-6" aria-hidden="true" style="font-size: 3em;"></i></a></div></td><td></td><td><div style="padding-top:20px;float:left;padding-right: 30px;"><div style=""><strong>Primary Programme Director</strong></div><div>{$this->bean->assigned_user_name}</div></div><div style="padding-top:20px;float:left;"><div style=""><strong>Secondary Programme Director</strong></div><div>{$this->bean->spd_c}</div></div></td></tr>';

                $('.moduleTitle table').eq(0).find('td table').eq(0).append(ppd);
                // $('.moduleTitle .row').prepend(kpi);
                $('#whole_subpanel_cases').hide();
                $('#whole_subpanel_am_projectholidays_project').hide();
                $('#whole_subpanel_project_resources').hide();
                $('#whole_subpanel_aos_quotes_project').hide();
                if($('#programme_type_c').val() != 'Sponsored')
                {
                    $('#whole_subpanel_accounts').hide();
                }
                $('#whole_subpanel_projecttask').hide();
                $('#whole_subpanel_contacts').hide();
                $('#whole_subpanel_opportunities').hide();
                $('#whole_subpanel_project_documents_1').hide();

                //adding print button
                $('#detail_header_action_menu').before('<a href="{$sugar_config['site_url']}index.php?module=Project&action=printLOPDocument&id={$this->bean->id}" class="btn btn-info btn-sm" style="margin-right: 14px;" title="Print LOP">Download LOP</a>');
                
                if('{$this->bean->status}' == 'Deferred'){   
                    $('#detail_header_action_menu').before('<a href="{$sugar_config['site_url']}index.php?module=Project&action=sendCancellationDeffered&id={$this->bean->id}" class="btn btn-info btn-sm" style="margin-right: 14px;" title="Send deferred programme advice">Send deferred programme advice</a>');
                }
                
                if('{$this->bean->status}' == 'Cancelled'){
                    $('#detail_header_action_menu').before('<a href="{$sugar_config['site_url']}index.php?module=Project&action=sendCancellationToNominations&id={$this->bean->id}" class="btn btn-info btn-sm" style="margin-right: 14px;" title="Send Cancellation Advice To Nominees">Send Cancellation Advice To Nominees</a>');
                }

                $('#detail_header_action_menu').before('<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View LOP</button>  <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">List of Participants</h4> </div> <div class="modal-body"> <p>$lop</p> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>');
                    
                    programmeTypeCheck();

                    function announced(){
                            $('#lump_sum_c').parent('div').hide();
                            
                            $('#detailpanel_4').hide();
                    }

                    function notAnnounced(){

                            $('#detailpanel_3').hide();
                    }

                    function programmeTypeCheck(){
                        if(!('{$this->bean->programme_type_c}' == 'ICTP-Off Campus')){

                            announced();
                        }else{
                            notAnnounced();
                        }
                    }
                    
                    if('{$this->bean->lump_sum_c}' == '0'){
                        $('#detailpanel_4').hide(); 
                        
                    }
                    
                    //selectAccommodations();
                    function selectAccommodations(){
                        if('{$this->bean->accommodation_c}' == 'CPCNew'){
                            
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(0).hide();
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(1).hide();

                        }else if('{$this->bean->accommodation_c}' == 'CPCOld'){
            
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(0).children('div').eq(1).hide();                            
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(1).hide();
                            
                        }else if('{$this->bean->accommodation_c}' == 'BV'){
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(0).children('div').eq(1).hide();
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(0).hide();
                            
                        }else{

                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(0).children('div').eq(1).hide();
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(0).hide();
                            $('#LBL_EDITVIEW_PANEL5').children('div').eq(1).children('div').eq(1).hide();                            
                        }
                    }              

                    checkVenue();
                    function checkVenue(){
                        if('{$this->bean->venue_c}' == 'Hotel'){
                            
                            $('#cr_no_c').parent('div').parent('div').hide();
                        
                        }
                    }

                    //hide select rooms and occupancy chart button
                    $('#LBL_EDITVIEW_PANEL5').children('div').eq(2).hide();
                    $('#LBL_EDITVIEW_PANEL5').children('div').eq(0).children('div').eq(0).hide();

                    $('#occupancy_chart_c').parent('div').parent('div').hide();

              });



        </script>
abc;



    }
}
