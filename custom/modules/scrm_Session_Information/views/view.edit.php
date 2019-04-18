<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class scrm_Session_InformationViewEdit extends ViewEdit
{
     public function __construct() {
        parent::ViewEdit();
        $this->useForSubpanel = true;
        //~ $this->useModuleQuickCreateTemplate = true; 
    }

    public function display()
    {
        global $db;
        // $id = $this->bean->id;
        echo '<div id = "dialog" title= "Warning!!!" class="dialog"><p>* End time should not be lesser than start time</p></div>';
        echo '<div id = "dialogProgrammeDate" title= "Warning!!!" class="dialog"><p>* Please select date between programme start and end date!</p></div>';
   //      ob_clean();
        // print_r($_REQUEST);exit();
        $fac_id = $this->bean->faculty_id_c;
        if (isset($_REQUEST['scrm_timetable_scrm_session_information_1scrm_timetable_ida'])) {
            $timetableBean = BeanFactory::getBean('scrm_Timetable',$_REQUEST['scrm_timetable_scrm_session_information_1scrm_timetable_ida']);        
            $timetableId = $timetableBean->id;    
        }else{

            $timetableId = $db->getOne("SELECT scrm_timetable_scrm_session_information_1scrm_timetable_ida as tid FROM scrm_timetable_scrm_session_information_1_c WHERE scrm_timetc7f4rmation_idb ='".$_REQUEST['record']."'");
             $timetableBean = BeanFactory::getBean('scrm_Timetable',$timetableId);
        }
        // ob_clean();
        // print_r(date_create_from_format('d-m-Y H.i',$this->bean->start_time_c));
        // print_r(date_get_last_errors());
        // exit();

        //ob_clean();
        /*Modified By:Ashvin
          Date:19-10-2018
          Reason: When a session is edited, session timings are not displayed though there are no changes in the timings
          Start
        */
        global $current_user;  
        $dateFormat = $current_user->getPreference('datef');        
        
        $start = $this->bean->start_time_c;
        $end = $this->bean->end_time_c;
        /*$h = date_format(date_create_from_format($dateFormat.' H:i', $this->bean->start_time_c),'H');
        $i = date_format(date_create_from_format($dateFormat.' H:i', $this->bean->start_time_c),'i'); 
        $he = date_format(date_create_from_format($dateFormat.' H:i', $this->bean->end_time_c),'H');
        $ie = date_format(date_create_from_format($dateFormat.' H:i', $this->bean->end_time_c),'i');*/
        $h = date('H',strtotime($start));
        $i = date('i',strtotime($start)); 
        $he = date('H',strtotime($end));
        $ie = date('i',strtotime($end));

        /*Modified By:Ashvin
          Date:19-10-2018
          Reason: When a session is edited, session timings are not displayed though there are no changes in the timings
          End
        */
        //echo $h;exit;
        $projectId = $db->getOne("SELECT project_scrm_timetable_1project_ida as pid FROM project_scrm_timetable_1_c WHERE project_scrm_timetable_1scrm_timetable_idb ='".$timetableId."'");

        $projectBean = BeanFactory::getBean('Project',$timetableBean->project_scrm_timetable_1project_ida);
		/*Changes made by Ashvin
		*  date:26-11-2018
		*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784
		*  Start
		*/
		$flagFinalise=0;
		$now = time(); // or your date as well	
		$date1 = date_format(date_create($projectBean->end_date_c),"d-m-Y");
	    $end_date = strtotime($date1);
		$datediff2 =  $now - $end_date ;
	    $afterEndDate=round($datediff2 / (60 * 60 * 24)); 
		
	    $afterEndDate	=$afterEndDate+1;
		if($afterEndDate>8){
			$flagFinalise=1;
		}
		/*Changes made by Ashvin
		*  date:26-11-2018
		*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784
		*  End
		*/
		
        echo <<<JS
        <style>
            .dialog{    text-align:left!important;overflow: hidden!important;zoom: 1!important;padding: 0 25px 3px 0!important;z-index: 1!important;    }
        </style>
		<script src="https://momentjs.com/downloads/moment.js"></script>
        <script>

                var dateField;
                var start_date = '{$projectBean->start_date_c}';
                var end_date = '{$projectBean->end_date_c}';
                
                function checkStatus(){
                    
                    //console.log('sadasdas asdasd ad ');
                    var error_1 = 1;
                    dateField = $('#start_time_c_trigger').prev('input');

                    // var msg = 
                    var data = dateValidation();
                    console.log(data);
                    var error_2 = 1;
                    dateField = $('#end_time_c_trigger').prev('input');
                    var data_2 = dateValidation();
                    console.log(data_2);

                    var s = $('#start_time_c').val();
                    var e = $('#end_time_c').val();
                    
                    
                    var error = false;
                    if (data.error || data_2.error) {
                        if (data.msg != data_2.msg) {
                            alert(data.msg+' '+data_2.msg);    
                        }else{
                            alert(data.msg);
                        }

                        error = true;
                    }else{
                        $.ajax({
                          method: "POST",
                          url: "index.php?entryPoint=ajaxCall",
                          data: {type:"getCheckOverlapping",start_date: s, end_date: e, id: '{$timetableId}', sid: '{$this->bean->id}'},
                          async: false
                        }).success(function(rsp){
                            var r = JSON.parse(rsp);
                            if (r.length > 0) {
                                
                                var msg = '';
                                msg += "This session is Overlapping with below session,";
                                for (var i = 0; i < r.length; i++) {
                                    console.log(r[i]);
                                    msg += '\\n ';
                                    msg += '\\n Session Name: '+r[i].name;
                                    msg += '\\n Start Time: '+r[i].start_time_c;
                                    msg += '\\n End Time: '+r[i].end_time_c;
                                }
                                
                                alert(msg);

                                error = true;
                            }
                        });                        
                    }

                    if (error) {
                        return false;
                    }else{
                        return true;
                    }
                    
                }


                // var ran = false;
                function dateValidation(){
                    
                    var error = false;
                    
                    date = dateField.val();
                    // var date = $(this).prev('input').val();
                    var validate1 = check_dates(start_date,date);
                    var validate2 = check_dates(date,end_date);
                    // console.log(validate1);
                    // console.log(date);
                    var date1 = $('#start_time_c_date').val();
                    var date2 = $('#end_time_c_date').val();
                    var validate3 = true;
                    if(date1 && date2){
                        validate3 = check_dates(date1,date2);
                    }
                    
                    var msg = '';
                    if(!validate1 || !validate2){
                            // alert('Date is not in range');
                        // $('#dialogProgrammeDate').dialog();

                        // $('#SAVE_HEADER').attr('disabled',true);
                        error = true;
                        msg = "Please select date between programme start and end date!";
                    }

                    if(!validate3){
                            // alert('Date is not in range');
                        // $('#dialog').dialog();
                        // $('#SAVE_HEADER').attr('disabled',true);
                        error = true;
                        msg = " End time should not be lesser than start time";
                    }

                    if(error){
                        // $('#SAVE_HEADER').attr('disabled',true);
                    }else{
                        // $('#SAV E_HEADER').attr('disabled',true);
                    }
                

                    ran = true;
                    var response = {"error": error, "msg": msg};
                    return response;
                }       

                function check_dates(start,end) {
            
                    var jstart = start;
                    var jend = end;
                    console.log(start=='undefined');
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


            $(document).ready(function(){

                

                $('#faculty_name_c_label').hide();
                $('#faculty_name_c').parent('td').hide();

                // $(document).on('change', '#end_time_c_hours, #start_time_c_hours', function (e) {    
                
                //     if($('#start_time_c_hours').val() > $('#end_time_c_hours').val())
                //     {
                //         if($('#end_time_c_hours').val() != ''){
                //             $('#dialog').dialog();                          
                //         }                       
                //         $('#end_time_c_hours').prop('selectedIndex',0);
                //         $('#end_time_c_minutes').prop('selectedIndex',0);
                //         $('#end_time_c_meridiem').prop('selectedIndex',0);
                //     }
                // });
                $(document).on('change', '#faculty_id_c', function (e) {     
                    e.preventDefault();
                    var selMulti = $.map($("#faculty_id_c option:selected"), function (el, i) {
                             return $(el).text();
                         });                    
                    var faname = $('#faculty_name_c').val(selMulti.join(" | "));
                });

                $(document).on('click', '.calcell', function (e) {     
                    e.preventDefault();
                    // var start = $('#start_time_c_date').val();
                    // $('#end_time_c_date').val(start);
                });

                $('#start_time_c_trigger').attr('tabindex',2);
                $('#end_time_c_trigger').attr('tabindex',2);
                
                var start_date = '{$projectBean->start_date_c}';
                var end_date = '{$projectBean->end_date_c}';
                var dateField;
                var ran;
                $("#start_time_c_trigger, #end_time_c_trigger, #start_time_c_date, #end_time_c_date").blur(function(){
                        ran = false;
                        dateField = $(this).prev('input');
                        console.log($(this).prev('input'));
                        //setTimeout(dateValidation, 1000);
                });

                $('#action_buttons').click(function(){
                    alert('asdsa')
                    //dateValidation();
                });

                function dateValidation(){
                    
                    var error = false;

                    if(!ran){                        
                        date = dateField.val();
                        // var date = $(this).prev('input').val();
                        var validate1 = check_dates(start_date,date);
                        var validate2 = check_dates(date,end_date);
                        // console.log(validate1);
                        // console.log(date);
                        var date1 = $('#start_time_c_date').val();
                        var date2 = $('#end_time_c_date').val();
                        var validate3 = true;
                        if(date1 && date2){
                            validate3 = check_dates(date1,date2);
                        }
                        
                        
                        if(!validate1 || !validate2){
                                // alert('Date is not in range');
                            $('#dialogProgrammeDate').dialog();

                            // $('#SAVE_HEADER').attr('disabled',true);
                            error = true;
                        }

                        if(!validate3){
                                // alert('Date is not in range');
                            $('#dialog').dialog();
                            // $('#SAVE_HEADER').attr('disabled',true);
                            error = true;
                        }

                        if(error){
                            // $('#SAVE_HEADER').attr('disabled',true);
                        }else{
                            // $('#SAVE_HEADER').attr('disabled',true);
                        }
                    }
                    ran = true;
                    return error;
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
                    console.log(start=='undefined');
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

                timingDropdown();
                function timingDropdown(){
                    $('#start_time_c_hours, #end_time_c_hours').find('option').remove();
                    $('#start_time_c_hours, #end_time_c_hours').append($("<option></option>").attr("value",'').text(''));
                    for(i=06;i<=20;i++){
                        $('#start_time_c_hours, #end_time_c_hours').append($("<option></option>").attr("value",i).text(i));
                    }                    
                }     
                
                //setTimeout(function(){
                    $('#start_time_c_hours').val('{$h}'.replace(/^0+/, ''));
                    // $('#start_time_c_minutes').val('{$i}'.replace(/^0+/, ''));

                    $('#end_time_c_hours').val('{$he}'.replace(/^0+/, ''));
                    $('#end_time_c_minutes').val('{$ie}'.replace(/^0+/, ''));                           
                    
                    $('#start_time_c').val('{$start}');                           
                    $('#end_time_c').val('{$end}');                           
                //}, 500)

                // $('#start_time_c_minutes').val('{$i}'.replace(/^0+/, ''));

				/*Modified by Ashvin
				* Date:26-11-2018
				* Ticket ID:3784
				* Reason: Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
				* Start
				*/
				if('{$flagFinalise}' == 1){
					DisableField(1);				
					$('#scrm_timetable_scrm_session_information_1_name').attr('disabled',true);
					$('#btn_scrm_timetable_scrm_session_information_1_name').attr('disabled',true);
					$('#btn_clr_scrm_timetable_scrm_session_information_1_name').attr('disabled',true);
				}else{
					DisableField(0);
					$('#scrm_timetable_scrm_session_information_1_name').attr('disabled',false);
					$('#btn_scrm_timetable_scrm_session_information_1_name').attr('disabled',false);
					$('#btn_clr_scrm_timetable_scrm_session_information_1_name').attr('disabled',false);
				}
				function DisableField(op){
					if(op == 1){					
						$('#slot_c').attr('disabled',true);
						$('#name').attr('disabled',true);
						$('#faculty_id_c').attr('disabled',true);
						
						$('#start_time_c_date').attr('disabled',true);
						$('#end_time_c_date').attr('disabled',true);
						$('#start_time_c_hours').attr('disabled',true);
						$('#start_time_c_minutes').attr('disabled',true);
						$('#end_time_c_hours').attr('disabled',true);
						$('#end_time_c_minutes').attr('disabled',true);
						
						$("#description").attr('disabled',true);
						$("#start_time_c_trigger").hide();
						$("#end_time_c_trigger").hide();
					}else{
						$('#slot_c').attr('disabled',false);
						$('#name').attr('disabled',false);
						$('#faculty_id_c').attr('disabled',false);
						
						$('#start_time_c_date').attr('disabled',false);
						$('#start_time_c_hours').attr('disabled',false);
						$('#end_time_c_date').attr('disabled',false);
						$('#start_time_c_minutes').attr('disabled',false);
						$('#end_time_c_hours').attr('disabled',false);
						$('#end_time_c_minutes').attr('disabled',false);
						
						$("#description").attr('disabled',false);
						$("#start_time_c_trigger").show();
						$("#end_time_c_trigger").show();
					}
				}
				
				
				$("#btn_scrm_timetable_scrm_session_information_1_name, #scrm_timetable_scrm_session_information_1_name").blur(function(){
                   var tid = $('#scrm_timetable_scrm_session_information_1scrm_timetable_ida').val();
                   
                   if(tid != '')
                   {
                        $.ajax({url:'timetablepopupproginfo.php', data:{pid1:tid},type:'GET',dataType:'json',success:function(result)
                        {
                            var start_date=result.a;
                            var end_date=result.b;                            
                            var day=result.d;
                            var curr_date=result.e;
							var fromDate = end_date, 
								toDate = curr_date, 
								from, to, druation;
						  
							from = moment(fromDate, 'YYYY-MM-DD'); 
							to = moment(toDate, 'YYYY-MM-DD'); 
							
							
							duration = to.diff(from, 'days')
							if(duration>6){
								DisableField(1);
							}else{
								DisableField(0);
							}
							
                        }
                        });
                   }
                   
            
                });   				
				/*Modified by Ashvin
				* Date:26-11-2018
				* Ticket ID:3784
				* Reason: Revise and freeze; Work load report take freezed (after one week of programme end date); sessions for feedback; faculty work load report:
				* End
				*/
				
            });
        </script>
JS;
        parent::display();
    }
}
