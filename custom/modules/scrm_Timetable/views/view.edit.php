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

class scrm_TimetableViewEdit extends ViewEdit
{
 	
 	function scrm_TimetableViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
        echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Programme date and Timetable date are not in synchronisation!!</p></div>';
        $synchronisation = 2;


        if ($pid = $this->bean->project_scrm_timetable_1project_ida) {
              $projectBean = BeanFactory::getBean('Project',$pid);

              if($projectBean->start_date_c != $this->bean->start_date_c || $projectBean->end_date_c != $this->bean->end_date_c){
                    $synchronisation = 3;
                    echo '<p style="color:red">*Programme date and Timetable date are not in synchronisation!</p>';
              }  
        }		
		/*Modified by Ashvin
		* Date:12-11-2018
		* Ticket ID:3784
		* Reason: Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
		* Start
		*/
		$flagFinalise=0;
		$now = time(); // or your date as well	
		$date1 = date_format(date_create($projectBean->end_date_c),"d-m-Y");
	    $end_date = strtotime($date1);
		$datediff2 =  $now - $end_date ;
	    $afterEndDate=round($datediff2 / (60 * 60 * 24)); 
		$timeTableBean = BeanFactory::getBean('scrm_Timetable',$this->bean->id);
	    $afterEndDate	=$afterEndDate+1;
		if($afterEndDate>8){
			$flagFinalise=1;
		}
		$flagFin=0;
		if($this->bean->finalise_c =='Yes'){
			$flagFin=1;
		}
		
		/*Modified by Ashvin
		* Date:12-11-2018
		* Ticket ID:3784
		* Reason: Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
		* End
		*/
        echo <<<JS

        <script>
        	$(document).ready(function(){
                if('{$synchronisation}' == 3){
                    $('#dialog').dialog();
                }
                $('#start_date_c').attr('readonly',true);
                $('#end_date_c').attr('readonly',true);
                $('#venue_c').attr('readonly',true);
                $('#no_of_days_c').attr('readonly',true);
                $('#programme_code_c').attr('readonly',true);
                $('#end_date_c_trigger').hide();
                $('#start_date_c_trigger').hide();
                
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
                    console.log(start + ' ' + end);
                    if (jstart != '' && jend != '') {
                        var start = getDate(jstart);
                        var end = getDate(jend);

                        if (start > end) {
                            // $('#end_date_c').val('');
                            $('#dialogDate').dialog();
                             $('#check_in_c_date').val('');
                             $('#check_out_c_date').val('');
                            return false;
                        }
                        return true;
                    }
                }

                $("#btn_project_scrm_timetable_1_name, #project_scrm_timetable_1_name").blur(function(){
                   var pid = $('#project_scrm_timetable_1project_ida').val();
                   
                   if(pid != '')
                   {
                        $.ajax({url:'popupproginfo.php', data:{pid1:pid},type:'GET',dataType:'json',success:function(result)
                        {
                            var start_date=result.a;
                            var end_date=result.b;
                            var venue=result.c;
                            var day=result.d
                            var pcode = result.g;
                            
                            $('#start_date_c').val('');
                            $('#end_date_c').val('');
                            $('#venue_c').val('');  
                            $('#no_of_days_c').val(''); 
                            $('#programme_code_c').val('');

                            $('#start_date_c').val(start_date);
                            $('#end_date_c').val(end_date);
                            $('#venue_c').val(venue);
                            $('#no_of_days_c').val(day);
                            $('#programme_code_c').val(pcode);

                        }
                        });
                   }
                   else
                   {
                        $('#name').val('');
                        $('#start_date_c').val('');
                        $('#end_date_c').val('');
                        $('#venue_c').val('');  
                        $('#no_of_days_c').val('');         
                        $('#programme_code_c').val('');

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

				if('{$flagFinalise}' == 1){
					$('#project_scrm_timetable_1_name').attr('disabled',true);
                    $('#btn_project_scrm_timetable_1_name').attr('disabled',true);
                    $('#btn_clr_project_scrm_timetable_1_name').attr('disabled',true);
                    
					$('#start_date_c').attr('disabled',true);
					$('#end_date_c').attr('disabled',true);
					$('#no_of_days_c').attr('disabled',true);
					$('#assigned_user_name').attr('disabled',true);
					$('#tea_timings_c').attr('disabled',true);
					
					$("input[name='finalise_c']").attr('disabled',true);
				}else{
					$('#project_scrm_timetable_1_name').attr('disabled',false);
                    $('#btn_project_scrm_timetable_1_name').attr('disabled',false);
                    $('#btn_clr_project_scrm_timetable_1_name').attr('disabled',false);
                    
					$('#start_date_c').attr('disabled',false);
					$('#end_date_c').attr('disabled',false);
					$('#no_of_days_c').attr('disabled',false);
					$('#assigned_user_name').attr('disabled',false);
					$('#tea_timings_c').attr('disabled',false);
					
					$("input[name='finalise_c']").attr('disabled',false);
				}
				
				
        	});
        </script>
JS;
        
        //call parent display method
        parent::display();
    }
}


?>
