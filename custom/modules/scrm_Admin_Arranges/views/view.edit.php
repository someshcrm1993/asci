<?php
/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SimpleCRM <info@simplecrm.com.sg>
 */


require_once('include/MVC/View/views/view.edit.php');

class scrm_Admin_ArrangesViewEdit extends ViewEdit
{
 	
 	function scrm_Admin_ArrangesViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
        global $current_user;
        
        $role = ACLRole::getUserRoleNames($current_user->id);
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }else{
            //role is admin
            $role = 'admin';
        }       
        echo '<div id = "sync" title= "Warning!!!" style="display:none"><p>Programme date and Admin Arrangement date are not in synchronisation!!</p></div>';
        $synchronisation = 2;
        if ($pid = $this->bean->scrm_admin_arranges_project_1project_idb) {
              $projectBean = BeanFactory::getBean('Project',$pid);
              // ob_clean();
              // print_r($projectBean);exit();
              if($projectBean->start_date_c != $this->bean->programme_from_date_c || $projectBean->end_date_c != $this->bean->programme_to_date_c){
                    $synchronisation = 3;
                    echo '<p style="color:red">*Programme date and Admin Arrangement date are not in synchronisation!</p>';
              }  
        }         
        // $this->bean->inauguration_date_time_c = '20-07-2017 22:22:22';
        echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Date not in range!</p></div>';
        echo '<div id = "dialogY" title= "Warning!!!" style="display:none"><p>Please select Yoga time between 6 to 8 AM only!!</p></div>';

        echo <<<JS

        <script>
        	$(document).ready(function(){
                if('{$synchronisation}' == 3){
                    $('#sync').dialog();
                }

                if('$role' != 'AIRO'){
                       $('#approval_airo_c').attr('disabled',true); 
                }
                // $('#scrm_admin_arranges_project_1_name').attr('readonly',true);
                // $('#btn_scrm_admin_arranges_project_1_name').attr('disabled',true);
                // $('#btn_clr_scrm_admin_arranges_project_1_name').attr('disabled',true);
                // $('#programme_from_date_c').attr('readonly',true);
                // $('#programme_to_date_c').attr('readonly',true);
                // $('#inauguration_date_time_c_date').attr('readonly',true);
                // $('#inauguration_date_time_c_hours option:not(:selected)').prop('disabled', true);
                // $('#inauguration_date_time_c_minutes option:not(:selected)').prop('disabled', true);
                // $('#no_of_participants_c').attr('readonly',true);
                // $('#conference_room_c option:not(:selected)').prop('disabled', true);
                // $('#programme_from_date_c_trigger').hide();
                // $('#programme_to_date_c_trigger').hide();
                // $('#inauguration_date_time_c_trigger').hide();

                $('#programme_from_date_c_trigger').attr('tabindex',2);
                $('#programme_to_date_c_trigger').attr('tabindex',2);
                $('#inaugural_date_time_c_trigger').attr('tabindex',2);
                $('#special_event_date_time_c_trigger').attr('tabindex',2);
                $('#pc_lcd_date_time_c_trigger').attr('tabindex',2);
                $('#audio_recording_1_date_time_c_trigger').attr('tabindex',2);
                $('#audio_recording_2_c_trigger').attr('tabindex',2);
                $('#video_recording_1_date_time_c_trigger').attr('tabindex',2);
                $('#video_recording_2_c_trigger').attr('tabindex',2);
                $('#other_c_trigger').attr('tabindex',2);
                $('#yoga_date_time_c_trigger').attr('tabindex',2);
                $('#inauguration_date_time_c_trigger').attr('tabindex',2);
                $('#airo_briefing_date_and_time_c_trigger').attr('tabindex',2);
                $('#group_photograph_date_time_c_trigger').attr('tabindex',2);
                
                var start_date = $('#programme_from_date_c').val();
                var end_date = $('#programme_to_date_c').val();
                $("#programme_from_date_c_trigger, #programme_to_date_c_trigger").blur(function(){
                    setTimeout(function(){
                        start_date = $('#programme_from_date_c').val();
                        end_date = $('#programme_to_date_c').val();
                    }, 1000);
                });

                $("#inaugural_date_time_c_trigger, #special_event_date_time_c_trigger, #pc_lcd_date_time_c_trigger, #audio_recording_1_date_time_c_trigger, #audio_recording_2_c_trigger, #video_recording_1_date_time_c_trigger, #video_recording_2_c_trigger, #other_c_trigger, #inauguration_date_time_c_trigger, #airo_briefing_date_and_time_c_trigger, #group_photograph_date_time_c_trigger").blur(function(){
                        var dateField = $(this).prev('input');
                        
                        setTimeout(function(){
                            date = dateField.val();
                            // var date = $(this).prev('input').val();
                            var validate1 = check_dates(start_date,date);
                            var validate2 = check_dates(date,end_date);
                            // console.log(validate1);
                            // console.log(date);
                            if(!validate1 || !validate2){
                                    // alert('Date is not in range');
                                $('#dialog').dialog();
                            }
                        }, 1000);
                });

                $(document).on('change','#yoga_date_time_c_hours, #yoga_date_time_c_minutes',function(){
                    checkYoga();
                });                    
                
                $("#yoga_date_time_c_trigger").blur(function(){
                     setTimeout(function(){
                        checkYoga();
                     }, 1000);
                });
                function checkYoga(){
                    var hours = $('#yoga_date_time_c_hours').val();
                    var minutes = $('#yoga_date_time_c_minutes').val();
                    
                    if(hours != '' && hours == 8){
                        if(minutes != '' && minutes >0){
                            $('#dialogY').dialog();
                        }
                    }

                    if(hours != '' && (hours > 8 || hours < 6)){
                        $('#dialogY').dialog();
                    }                    
                }

                function getDate(sugardate) {
                    m = '';
                    d = '';
                    y = '';
                    var dateParts = sugardate.match(date_reg_format);
                    for (key in date_reg_positions) {
                        index = date_reg_positions[key];
                        if (key == 'm') {
                            m = dateParts[index];
                            m = (m * 1) - 1;
                        } else if (key == 'd') {
                            d = dateParts[index];
                        } else {
                            y = dateParts[index];
                        }
                    }
                    var dd = new Date(y, m, d);
                    return dd;
                }

                function check_dates(start,end) {
                    var jstart = start;
                    var jend = end;
                    console.log(start+' >> '+end);
                    if (jstart != '' && jend != '') {
                        var start = getDate(jstart);
                        var end = getDate(jend);

                        if (start > end) {
                            // $('#end_date_c').val('');
                            $('#dialogDate').dialog();
                        
                            return false;
                        }
                        return true;
                    }
            
                }

                $("#btn_scrm_admin_arranges_project_1_name, #scrm_admin_arranges_project_1_name").blur(function(){
                   var pid = $('#scrm_admin_arranges_project_1project_idb').val();
                   
                   if(pid != '')
                   {
                        $.ajax({url:'popupproginfo.php', data:{pid1:pid},type:'GET',dataType:'json',success:function(result)
                        {
                            var start_date=result.a;
                            var end_date=result.b;
                            var venue=result.c;
                            var day=result.d
                            
                            $('#programme_from_date_c').val('');
                            $('#programme_to_date_c').val('');
                        
                            $('#programme_from_date_c').val(start_date);
                            $('#programme_to_date_c').val(end_date);
                        }
                        });
                   }
                   else
                   {
                        $('#name').val('');
                        $('#programme_from_date_c').val('');
                        $('#programme_to_date_c').val('');              
                   }
            
                });     

                $("#btn_clr_project_scrm_timetable_1_name").click(function() 
                {
                    $('#name').val('');
                    $('#start_date_c').val('');
                    $('#end_date_c').val('');
                    $('#venue_c').val('');  
                    $('#no_of_days_c').val('');     
                });

                addToValidate('EditView','scrm_admin_arranges_project_1_name','scrm_admin_arranges_project_1_name',true,'Programme Title');
                
                $('#scrm_admin_arranges_project_1_name_label').append('<span class="required">*</span>');       
        	});
        </script>
JS;
        
        //call parent display method
        parent::display();

    }
}


?>
