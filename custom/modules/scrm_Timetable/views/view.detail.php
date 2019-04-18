<?php
//ini_set('display_errors', 'On'); 
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


require_once('include/MVC/View/views/view.detail.php');
class scrm_TimetableViewDetail extends ViewDetail
{	
    function display()
    {
		/* Modified by - Ashvin 
		   Date - 26-11-2018
		   Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784	  
		   Start
		*/
    	$msg = $_REQUEST['msg'];
        if($msg){
          echo "<script>
           $(document).ready(function(){
                    YAHOO.SUGAR.MessageBox.show({msg: '$msg', title: 'Message'});
            });
          </script>";
        }
		/* Modified by - Ashvin 
		   Date -26-11-2018
		   Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784	  
		   End
		*/
    	$this->ss->assign('id',$this->bean->id);

    	$sessions = $this->bean->get_linked_beans('scrm_timetable_scrm_session_information_1');
		$data = array();
		$timings = [
				0 => ['start_time'=>900,'end_time'=>1030],
				1 => ['start_time'=>1100,'end_time'=>1230],
				2 => ['start_time'=>1400,'end_time'=>1530],
				3 => ['start_time'=>1600,'end_time'=>1730],
				4 => ['start_time'=>1800,'end_time'=>1930],
		];

		$week_number = 0;
		foreach ($sessions as $key => $value) {


			// print_r($value->start_time_c);exit();
			$date = date_format(date_create($value->start_time_c),"d-m-Y");
			
			$week_number = date('W', strtotime($date));
			$slot = $value->slot_c;
			
			$slot = explode(',', $slot);
			
			if (count($slot)>1) {
				
				$data[$week_number][$date][round($value->slot_c - 1)]['slot_number'] = $value->slot_c;
			}else{

				if (!isset($data[$week_number][$date][round($value->slot_c - 1)]['slot_number']) || $data[$week_number][$date][round($value->slot_c - 1)]['slot_number'] == '' || !(count(explode(',', $data[$week_number][$date][round($value->slot_c - 1)]['slot_number'])) > 0)) {
					$data[$week_number][$date][round($value->slot_c - 1)]['slot_number'] = $value->slot_c;
				}
			}

			$slot = $slot[0];
			// echo $slot;exit();

		 	$l = count($data[$week_number][$date][round($value->slot_c - 1)]);
		 	if (round($value->slot_c - 2) >= 0 && !isset($data[$week_number][$date][round($value->slot_c - 2)])) {
				$data[$week_number][$date][round($value->slot_c - 2)] = array();				 
		 	}
	 		
	 		$data[$week_number][$date][round($slot-1)][($l-1)]['date'] = $value->start_time_c;
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['start_time'] = date_format(date_create($value->start_time_c),"H:i");
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['start_time_int'] = str_replace(':', '', $data[$week_number][$date][$key]['start_time']);

		 	$data[$week_number][$date][round($slot-1)][($l-1)]['end_time'] = date_format(date_create($value->end_time_c),"H:i");
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['end_time_int'] = str_replace(':', '', $data[$week_number][$date][$key]['end_time']);

		 	$data[$week_number][$date][round($slot-1)][($l-1)]['session_name'] = $value->name;
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['faculty_name'] = $value->faculty_name_c;
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['slot_number'] = $value->slot_c;
		 	$data[$week_number][$date][round($slot-1)][($l-1)]['show_timings'] = $value->show_timings_c;
	 				 	
		 	$slot_tmp = $data[$week_number][$date][round($slot-1)]['slot_number'];
		 	$show_timings_tmp = $data[$week_number][$date][round($slot-1)]['show_timings'];
		 	unset($data[$week_number][$date]['day_name']);
		 	unset($data[$week_number][$date][round($slot-1)]['slot_number']);
		 	usort($data[$week_number][$date][round($slot-1)], array($this, 'cmp'));

		 	$data[$week_number][$date][round($slot-1)]['slot_number'] = $slot_tmp;
		 	// $data[$week_number][$date][round($slot-1)]['show_timings'] = $show_timings_tmp;
		 	$data[$week_number][$date]['day_name'] = date_format(date_create($value->start_time_c),"l"); 
		 	$data[$week_number][$date]['date'] = $date;
			uasort($data[$week_number], array($this, 'cmp'));
 		}
		
		ksort($data);
		
		$projectBean = BeanFactory::getBean('Project',$this->bean->project_scrm_timetable_1project_ida);
		
		if(count($data)>1){
			$startdate = date_format(date_create($projectBean->start_date_c),"Y-m-d");
			$endtdate = date_format(date_create($projectBean->end_date_c),"Y-m-d");
			$startdate = DateTime::createFromFormat("Y-m-d", $startdate);
			$endtdate = DateTime::createFromFormat("Y-m-d", $endtdate);
			$startYear= $startdate->format("Y");
			$endYear= $endtdate->format("Y");
			if($endYear!=$startYear){
			$weekOrderChange=array();
			foreach($data as $DataKey=>$DataValue){
				$dateArray=array_keys($DataValue);			
				$weekOrderChange[$DataKey]=$dateArray[0];			
			}
			usort($weekOrderChange, array($this, "date_sort"));
			
			$dataTemp=$data;
			$data=array();			
			foreach($weekOrderChange as $k=>$v){
				foreach($dataTemp as $DataKey=>$DataValue){
					$dateArray=array_keys($DataValue);
					if($weekOrderChange[$k]==$dateArray[0]){
						$data[$DataKey]=$dataTemp[$DataKey];
						
					}
				}
			}
			}
		}
		
		/*Modified By Ashvin
		* Date: 27-12-2018
		* Reason: check is Multiweek Timetable or not
		*/
		$tFooterData=array();
		require_once('custom/modules/AOS_Contracts/database.php');
		$isMultiweek=0;

		if(count($data)>1){
			$isMultiweek=1;
			
			/*Load Weekwise TimeTable Footer
			  Date:27-12-2018
			  Added by Ashvin
			*/
			$query="SELECT tfc.weekno_c, tf.name, tf.description FROM scrm_timetable_footer tf 
			join scrm_timetable_footer_cstm tfc on tf.id=tfc.id_c
			where tfc.timetable_id_c = '".$this->bean->id."' limit ".count($data);
			/*Somesh Bawane
			Dt. 21/02/19
			reason: Added limit for removing extra footer*/
			$tFooter=$connection->prepare($query);
			$tFooter->execute();
			
			$i=0;
			while($row=$tFooter->fetch()){
				$tFooterData[$i]['name'] = $row['name'];
				$tFooterData[$i]['description'] = $row['description'];
				$tFooterData[$i]['weekno_c'] = $row['weekno_c'];
				$i++;				
			}
			/*End*/
		}else{
			$isMultiweek=0; //Not show the multiweek button
			/*Somesh Bawane
			Dt.27/03/19
			Added New condition if one week time table is present and need to show the footer*/
			$query="SELECT tfc.weekno_c, tf.name, tf.description FROM scrm_timetable_footer tf 
			join scrm_timetable_footer_cstm tfc on tf.id=tfc.id_c
			where tfc.timetable_id_c = '".$this->bean->id."' limit ".count($data);
			/*Somesh Bawane
			Dt. 21/02/19
			reason: Added limit for removing extra footer*/
			$tFooter=$connection->prepare($query);
			$tFooter->execute();
			
			$i=0;
			while($row=$tFooter->fetch()){
				$tFooterData[$i]['name'] = $row['name'];
				$tFooterData[$i]['description'] = $row['description'];
				$tFooterData[$i]['weekno_c'] = $row['weekno_c'];
				$i++;				
			}
		}
		/*End*/
		

		$table = $this->generateTableMultiWeek($data,$timings);

 		
 		$a = explode("<br>", htmlspecialchars_decode($this->bean->tea_timings_c));
		$this->ss->assign('tables',$table);
 		$this->ss->assign('data',$data); 		
 		$this->ss->assign('timings',$timings);
 		$this->ss->assign('isMultiweek',$isMultiweek);
 		// $this->ss->assign('a',$a);

		/*Changes made by Ashvin
		*  date:13-11-2018
		*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784
		*  Start
		*/
				
		$now = time(); // or your date as well	
		$date1 = date_format(date_create($projectBean->end_date_c),"d-m-Y");
	    $end_date = strtotime($date1);
		$datediff2 =  $now - $end_date ;
	    $afterEndDate=round($datediff2 / (60 * 60 * 24)); 
		
	    $afterEndDate	=$afterEndDate+1;	
		
		/*Changes made by Ashvin
		*  date:13-11-2018
		*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
		*  Ticket ID: 3784
		*  End
		*/
		
		/*Modified by Ashvin
		* Date:20-12-2018
		* Reason: Program Objective 
		* Start
		*/	
	    $query="SELECT ob.name,obc.first_objective_c,obc.third_objective_c,obc.fourth_objective_c,obc.second_objective_c,obc.fifth_objective_c FROM scrm_programme_objective ob 
		join scrm_programme_objective_cstm obc on ob.id=obc.id_c
		join project_scrm_programme_objective_1_c pc on pc.project_scrm_programme_objective_1scrm_programme_objective_idb = ob.id where pc.project_scrm_programme_objective_1project_ida = '".$this->bean->project_scrm_timetable_1project_ida."' ";
		$query=$connection->prepare($query);
		$query->execute();
		$programObjective=array();
		while($row=$query->fetch()){
			$programObjective['name'] = $row['name'];
			$programObjective['first_objective_c'] = $row['first_objective_c'];
			$programObjective['second_objective_c'] = $row['second_objective_c'];
			$programObjective['third_objective_c'] = $row['third_objective_c'];
			$programObjective['fourth_objective_c'] = $row['fourth_objective_c'];
			$programObjective['fifth_objective_c'] = $row['fifth_objective_c'];
		}
		
		/*Modified by Ashvin
		* Date:20-12-2018
		* Reason: Program Objective
		* End
		*/
		
		session_start();
 		$_SESSION['data'] = $data;
 		$_SESSION['project'] = $projectBean;
 		$_SESSION['timetable'] = $this->bean;
 		$_SESSION['a'] = $a;
 		$tableDoc = $this->generateTableMultiWeek($data,$timings,1);
 		$_SESSION['table'] = $tableDoc;
 		$_SESSION['tablehtml'] = $table;
 		$_SESSION['data2'] = $a;
 		$_SESSION['programObjective'] = $programObjective; //Added by Ashvin date:09-11-2018
 		$_SESSION['tFooterData'] = $tFooterData; //Added by Ashvin date:27-12-2018
 		
 		
        //call parent display method
 		$site_url = $sugar_config['site_url'];

        echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Programme date and Timetable date are not in synchronisation!!</p></div>';
        $synchronisation = 2;


        if ($pid = $this->bean->project_scrm_timetable_1project_ida) {
              $projectBean = BeanFactory::getBean('Project',$pid);

              if($projectBean->start_date_c != $this->bean->start_date_c || $projectBean->end_date_c != $this->bean->end_date_c){
                    $synchronisation = 3;
                    echo '<p style="color:red">*Programme date and Timetable date are not in synchronisation!</p>';
              }  
        }

 		echo <<<JS
		
		<style>
		.yui-module .hd, .yui-panel .hd{background-color:#2767A8 !important;background:#2767A8 none repeat scroll 0 0 !important;}
		.container-close{
			background:# url('../../../../index.php?entryPoint=getImage&themeName=SuiteR&imageName=dashletclose.png') no-repeat !important;
		}
		</style>
		<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
 		<script>
 		$(document).ready(function(){
            if('{$synchronisation}' == 3){
                $('#dialog').dialog();
            }
			/*Modiefied by Ashvin
			* Reason: hide timetable footer subpanel
			* Date: 27-12-2018
			*/
			$("#whole_subpanel_scrm_timetable_scrm_timetable_footer_2").hide();
			if('{$isMultiweek}'== 1){
				$("#whole_subpanel_scrm_timetable_scrm_timetable_footer_2").show();
			}
			/*End*/
			
			var ppd = '<tr><td><div style="padding-top:20px"><a href="javascript;"><i class="fa fa-user fa-6" aria-hidden="true" style="font-size: 3em;"></i></a></div></td><td></td><td><div style="padding-top:20px;float:left;padding-right: 30px;"><div style=""><strong>Primary Programme Director</strong></div><div>{$projectBean->assigned_user_name}</div></div><div style="padding-top:20px;float:left;"><div style=""><strong>Secondary Programme Director</strong></div><div>{$projectBean->spd_c}</div></div></td></tr>';

          	$('.moduleTitle table').eq(0).find('td table').eq(0).append(ppd);

 			$('#detail_header_action_menu').before('<a href="{$site_url}index.php?module=scrm_Timetable&action=printDocument&id={$this->bean->id}" class="glyphicon glyphicon-print fa-2x" style="margin-right: 14px;"></a>');
			
			$('#detail_header_action_menu').before('<a href="{$site_url}index.php?module=scrm_Timetable&action=printDocument2&id={$this->bean->id}" class="btn btn-sm" style="margin-right: 14px;">Long Format</a>');
			/*Changes made by Ashvin
			*  date:13-11-2018
			*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
			*  Ticket ID: 3784
			*  Start
			*/
			if('{$afterEndDate}'>8 ){
				$(".pull-right").hide();				
			
				$( "#show_link_scrm_timetable_scrm_session_information_1" ).click(function() {
				  $(".inlineButtons").hide();
				});
			}
			/*Changes made by Ashvin
			*  date:13-11-2018
			*  Reason: Revise and freeze; Work load report take freezed (after one week of programme end date);
			*  Ticket ID: 3784
			*  End
			*/
 		});

 		</script>
JS;
        parent::display();
        
    }
	
    public function generateTableMultiWeek($data=array(),$timings,$doc=0)
    {
		$table = array();
		
		foreach ($data as $key => $value) {
			if($doc==1)
			$table[] = $this->generateTableDoc($value, $timings);
			else
			$table[] = $this->generateTable($value, $timings);
		}

		return $table;	
    }
	
    public function generateTable($data=array(),$timings)
    {
    	$table = '';

		// $existingKeys = array_keys($data);

		// //you can use any value instead of null
		// $newKeys = array_fill_keys(range(min($existingKeys), max($existingKeys)), null);
		// $array += $newKeys;

    	foreach ($data as $date => $sessions) {
			
			// $s = ;
			// $tmp_session = $sessions;
			// unset($tmp_session['slot_number']);
			$existingKeys = array_keys($sessions);

			//you can use any value instead of null
			$newKeys = array_fill_keys(range(min($existingKeys), max($existingKeys)), []);
			$sessions += $newKeys;
	
			$table .= "<tr>";
			$table .= '<td style="text-align: center;" width="200px"><strong><div>'.$sessions["day_name"].'</div><div>'.$date.'</div></strong></td>';
			
			$td = 0;
			$continue = false;
			$merged = false;
			$i = 0;
			
			$continue = false;
			$continueFor = 0;
			for ($sessions2=0; $sessions2 < (count($sessions)-2); $sessions2++) { 
			// if ($date == '17-07-2018') {
			// }
					// if (key($sessions[$sessions2]) !== 'slot_number') {
					// 	# code...
					// }
					$slot = explode(',', $sessions[$sessions2]['slot_number']);
					
					if ($continueFor > 0) {
						--$continueFor;
					}

					if ($continue && !in_array(($sessions2+1), $slot)) {
						
						if ($continueFor == 0) {
							$continue = false;

						}
						
						continue;
							
					}

					$style = "";
					if ((count($sessions[$sessions2])) > 2) {
						$style = "padding: 0 !important;";
					}
					
					if ($continueFor == 0) {

						// ob_clean();
						// print_r($sessions2);exit;
						if (count($slot) > 1) {

							$c = count($slot);
							$table .= '<td style="text-align: center;'.$style.'" width="200px" colspan="'.$c.'"><table border-collapse="0" border="1" class="table table-bordered"><tr>';
							$continue = true;

							if (count($slot) > 1 && max($slot) > ($sessions2 + 1)) {
								$continueFor = count($slot) - 1;
							}
							
						// }else if (!((count($sessions[$sessions2])) > 2) && $continueForTemp != 1) {
						}else if (!((count($sessions[$sessions2])) > 2) && $continueForTemp != 1) {
								$table .= '<td style="text-align: center;'.$style.'" width="200px">';
								$continue = false;
							
						}else if(!((count($sessions[$sessions2])) > 2) && $continueForTemp == 1 && $continueFor == 0){
							$table .= '<td style="text-align: center;'.$style.'" width="200px">';
							$continue = false;
							/*Modified by Ashvin
							  Date:23-10-2018
							  Reason: We have created two sessions for slots 1 & 2. As there was a change in time table, I have merged slots 1 & 2 and deleted slot 2.But this impacted remaining sessions of that day like sessions from slot 3 are not displayed in the timetable. On the printed template these sessions are displayed below the merged slot. 
							  Start*/
							//$table .= '<td style="text-align: center;'.$style.'" width="200px">';
							//$continue = false;
							/*Modified by Ashvin
							  Date:23-10-2018
							  Reason: We have created two sessions for slots 1 & 2. As there was a change in time table, I have merged slots 1 & 2 and deleted slot 2.But this impacted remaining sessions of that day like sessions from slot 3 are not displayed in the timetable. On the printed template these sessions are displayed below the merged slot. 
							  End*/
						}

						if ((count($sessions[$sessions2])) > 2) {
							$table .= '<td style="text-align: center;'.$style.'" width="200px"><table border-collapse="0" border="1" class="table table-bordered"><tr>';
						}

					}

					for ($slots=0; $slots < (count($sessions[$sessions2]) - 1); $slots++) {
						if (key($sessions[$sessions2]) !== 'slot_number') {
							if (count($slot) > 1 || count($sessions[$sessions2]) > 2) {
								if ($sessions[$sessions2][$slots]['show_timings'] == 1) {
									$table .= '<td style="text-align: center;border: 1px solid #ddd" width="200px">'.'<div style="border-bottom: 1px solid #bbb4b4;width: 101%;font-size: 10px;">'.$sessions[$sessions2][$slots]["start_time"].' -'. $sessions[$sessions2][$slots]["end_time"].'</div>';
								}
								/*Somesh Bawane
								Dt. 21/02/19
								Reason: condition if faculty name is present show it with Hyphen else keep it blank*/
								if(!empty($sessions[$sessions2][$slots]["faculty_name"])){
									$table .= $sessions[$sessions2][$slots]["session_name"].'</div><div>-<small><strong>'.$sessions[$sessions2][$slots]["faculty_name"].'</strong></small></div></div>';
								}else{
									$table .= $sessions[$sessions2][$slots]["session_name"].'</div></div>';
								}
								$table .= '</td>';
							}else{
								//$table .= '<td>';//Ash
								if ($sessions[$sessions2][$slots]['show_timings'] == 1) {
									$table .= '<div style="border-bottom: 1px solid #bbb4b4;width: 105%;font-size: 10px;">'.$sessions[$sessions2][$slots]["start_time"].' -'. $sessions[$sessions2][$slots]["end_time"].'</div>';
								}
								/*Somesh Bawane
								Dt. 21/02/19
								Reason: condition if faculty name is present show it with Hyphen else keep it blank*/
								if(!empty($sessions[$sessions2][$slots]["faculty_name"])){
									$table .= $sessions[$sessions2][$slots]["session_name"].'</div><div>-<small><strong>'.$sessions[$sessions2][$slots]["faculty_name"].'</strong></small></div></div>';	
								}else{
									$table .= $sessions[$sessions2][$slots]["session_name"].'</div></div>';
								}
								/*Somesh Bawane
								Dt. 21/02/19
								Reason: condition if faculty name is present show it with Hyphen else keep it blank*/
								// $table .= '</td>';
							}
							
						}

						// echo $sessions[$sessions2][$slots]["session_name"]." ".$continueFor.' '.$continueForTemp." ".count($sessions[$sessions2])."<br>";
					}
					
					if ((count($sessions[$sessions2]) > 2) || (count($slot) > 1)) {
						$table .= '</tr></table>';
					}	

					//if ($continueFor == 0) {
						// $table .=  '$continueFor: '.$continueFor. '$continueForTemp: '.$continueForTemp.'</td>';
						$table .=  '</td>';
					//}

					$continueForTemp = $continueFor;
					// echo str_replace('<', '&lt;', $table);exit;
			}
			
			$i++;
			
			$table .= "</tr>";
		 	
		} 	

		// echo str_replace('<', '&lt;', $table);exit;
		// exit;
		return $table;	
    }

    public function generateTableDoc($data=array(),$timings)
    {
    	$table = '';

		// $existingKeys = array_keys($data);

		// //you can use any value instead of null
		// $newKeys = array_fill_keys(range(min($existingKeys), max($existingKeys)), null);
		// $array += $newKeys;

		foreach ($data as $date => $sessions) {
			
			// $s = ;
			// $tmp_session = $sessions;
			// unset($tmp_session['slot_number']);
			$existingKeys = array_keys($sessions);

			//you can use any value instead of null
			$newKeys = array_fill_keys(range(min($existingKeys), max($existingKeys)), []);
			$sessions += $newKeys;

			
          /* Modified by - Ashvin 
		     Date - 17-10-2018
		     Reason - SWS needs to fix the table formatting in the timetable document exported.		  
		  Start*/
			$table .= "<tr>";
			$table .= '<td style="border: 1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px"><strong><div>'.$sessions["day_name"].'</div><div>'.$date.'</div></strong></td>';

			$td = 0;
			$continue = false;
			$merged = false;
			$i = 0;
			
			$continue = false;
			$continueFor = 0;
			for ($sessions2=0; $sessions2 < (count($sessions)-2); $sessions2++) { 
			// if ($date == '11-05-2018') {

					// if (key($sessions[$sessions2]) !== 'slot_number') {
					// 	# code...
					// }
					$slot = explode(',', $sessions[$sessions2]['slot_number']);
					
					if ($continueFor > 0) {
						--$continueFor;
					}

					if ($continue && !in_array(($sessions2+1), $slot)) {
						
						if ($continueFor == 0) {
							$continue = false;

						}
						
						continue;
							
					}else{

					}

					$style = "";
					if ((count($sessions[$sessions2])) > 2) {
						$style = "padding: 0 !important;";
					}
					
					if ($continueFor == 0 ) {

						if (count($slot) > 1) {

							$c = count($slot);
							$table .= '<td valign="top" style="border: 1px solid #000;border-collapse: collapse;text-align: center;padding:5px; '.$style.'" width="200px" colspan="'.$c.'"><div><table class="table table-bordered" style="border-collapse: collapse;"><tr>';
							$continue = true;

							if (count($slot) > 1 && max($slot) > ($sessions2 + 1)) {
								$continueFor = count($slot) - 1;
							}
							
						}else if (!((count($sessions[$sessions2])) > 2) && $continueForTemp != 1) {
								$table .= '<td valign="top" style="border: 1px solid #000;border-collapse: collapse;text-align: center; padding:5px;'.$style.'" width="200px">';
								$continue = false;
							
						}else if(!((count($sessions[$sessions2])) > 2) && $continueForTemp == 1 && $continueFor == 0){
							$table .= '<td valign="top" style="text-align: center;'.$style.'" width="200px">';
							$continue = false;
						}else{
							/*Modified by Ashvin
							  Date:23-10-2018
							  Reason: We have created two sessions for slots 1 & 2. As there was a change in time table, I have merged slots 1 & 2 and deleted slot 2.But this impacted remaining sessions of that day like sessions from slot 3 are not displayed in the timetable. On the printed template these sessions are displayed below the merged slot. 
							  Start*/
							//$table .= '<td style="text-align: center;'.$style.'" width="200px">';
							//$continue = false;
							/*Modified by Ashvin
							  Date:23-10-2018
							  Reason: We have created two sessions for slots 1 & 2. As there was a change in time table, I have merged slots 1 & 2 and deleted slot 2.But this impacted remaining sessions of that day like sessions from slot 3 are not displayed in the timetable. On the printed template these sessions are displayed below the merged slot. 
							  End*/
						}

						if ((count($sessions[$sessions2])) > 2) {
							$table .= '<td valign="top" style="border: 1px solid #000;border-collapse: collapse;text-align: center;padding:5px;'.$style.'" width="200px"><div><table border-collapse="0" class="table table-bordered" style="border-collapse: collapse;"><tr>';
						}

					}

					for ($slots=0; $slots < (count($sessions[$sessions2]) - 1); $slots++) {
						if (key($sessions[$sessions2]) !== 'slot_number') {
							if (count($slot) > 1 || count($sessions[$sessions2]) > 2) {
								if($slots%2==0 && count($sessions[$sessions2]) > 2){
									if ($sessions[$sessions2][$slots]['show_timings'] == 1) {
										$table .= '<td valign="top" style="border-right: 1px solid #ddd;border-left: 0px solid #fff;border-top: 0px solid #fff;border-bottom: 0px solid #fff; border-collapse: collapse;text-align: center;padding:5px;" width="200px">'.'<div style="border-bottom: 1px solid #bbb4b4;width: 105%;font-size: 10px;border-collapse: collapse;">'.$sessions[$sessions2][$slots]["start_time"].' -'. $sessions[$sessions2][$slots]["end_time"].'</div>';
									}
								}else{
									if ($sessions[$sessions2][$slots]['show_timings'] == 1) {
										$table .= '<td valign="top" style="border: none; border-collapse: collapse;text-align: center;padding:5px;" width="200px">'.'<div style="border-bottom: 1px solid #bbb4b4;width: 105%;font-size: 10px;border-collapse: collapse;">'.$sessions[$sessions2][$slots]["start_time"].' -'. $sessions[$sessions2][$slots]["end_time"].'</div>';
									}
								}
								/*Somesh Bawane
								Dt. 21/02/19
								Reason: condition if faculty name is present show it with Hyphen else keep it blank*/
								if(!empty($sessions[$sessions2][$slots]["faculty_name"])){
									$table .= $sessions[$sessions2][$slots]["session_name"].'<div>-<small><strong>'.$sessions[$sessions2][$slots]["faculty_name"].'</strong></small></div>';
								}else{
									$table .= $sessions[$sessions2][$slots]["session_name"];
								}
								$table .= '</td>';
							}else{

								if ($sessions[$sessions2][$slots]['show_timings'] == 1) {
									$table .= '<div style="border-bottom: 1px solid #bbb4b4;width: 105%;font-size: 10px;border-collapse: collapse;">'.$sessions[$sessions2][$slots]["start_time"].' -'. $sessions[$sessions2][$slots]["end_time"].'</div>';
								}
								/*Somesh Bawane
								Dt. 21/02/19
								Reason: condition if faculty name is present show it with Hyphen else keep it blank*/
								if(!empty($sessions[$sessions2][$slots]["faculty_name"])){
									$table .= $sessions[$sessions2][$slots]["session_name"].'<div>-<small><strong>'.$sessions[$sessions2][$slots]["faculty_name"].'</strong></small></div>';
								}else{
									$table .= $sessions[$sessions2][$slots]["session_name"];
								}
								// $table .= '</td>';
							}
							
						}

						// echo $sessions[$sessions2][$slots]["session_name"]." ".$continueFor.' '.$continueForTemp." ".count($sessions[$sessions2])."<br>";
					}
			/* Modified by - Ashvin 
		           Date - 17-10-2018
		           Reason - SWS needs to fix the table formatting in the timetable document exported.		  
		        END*/
					if ((count($sessions[$sessions2]) > 2) || (count($slot) > 1)) {
						$table .= '</tr></table></div>';
					}	

					//if ($continueFor == 0) {
						$table .= '</td>';
					//}

					$continueForTemp = $continueFor;
					// echo str_replace('<', '&lt;', $table);exit;
			}
			
			$i++;
			
			$table .= "</tr>";
		 	
		} 	

		 //echo str_replace('<', '&lt;', $table);exit;
		// exit;
		return $table;	
    }



  //   public function generateTable($data=array(),$timings)
  //   {
  //   	$table = '';
		// foreach ($data as $date => $sessions) {
		// 	$table .= "<tr>";
		// 	$table .= '<td style="text-align: center;" width="200px"><strong><div>'.$sessions["day_name"].'</div><div>'.$date.'</div></strong></td>';
		// 	// if ($value['']) {
		// 	// 	$table .= '<td style="text-align: center;" width="200px"><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div> </td>';
		// 	// }
		// 	$td = 0;
		// 	$continue = false;
		// 	$merged = false;
		// 	foreach ($sessions as $key => $value) {
		// 		if ($continue) {
		// 			$continue = false;
		// 			continue;
		// 		}
		// 		if ($merged) {
		// 			// echo $td;exit();
		// 			$merged = false;
		// 			if (!($value['start_time_int'] >= $timings[$td]['start_time'] && $value['end_time_int'] <= $timings[$td]['end_time'])) {
		// 				++$td;
		// 				$table .= "<td></td>";

		// 				continue;
		// 			}
		// 		}

		// 		if ( $key !== 'day_name') {
		// 			if ($value['end_time_int'] == $timings[$td]['end_time'] && $value['start_time_int'] == $timings[$td]['start_time']) {
		// 				$table .= '<td style="text-align: center;" width="200px"><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div> </td>';
		// 				++$td;
		// 			}elseif ($value['start_time_int'] == $timings[$key]['start_time'] && $value['end_time_int'] < $timings[$key]['end_time']) {
		// 				$table .= '<td style="text-align: center;" width="200px"><div><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div></div>';

		// 				if (!($sessions[++$key]['start_time_int'] < $timings[++$key]['start_time'] && $sessions[++$key]['end_time_int'] <= $timings[$key]['end_time'])) {
		// 					$table .= '</td>';
		// 					++$td;
		// 				}

		// 			}elseif($value['end_time_int'] == $timings[$td]['end_time'] && $value['start_time_int'] == $timings[$td]['start_time']){
		// 				$table .= '<td style="text-align: center;" width="200px"><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div>'.$key.' </td>';
		// 				++$td;
		// 			}elseif ((($value['start_time_int'] >= $timings[$td]['start_time'] && $value['start_time_int'] <= $timings[$td]['end_time']) || ($value['start_time_int'] < $timings[$key]['start_time'] && $value['start_time_int'] > $timings[$td-1]['end_time'])) && ($value['end_time_int'] > $timings[$td]['end_time'] && $value['end_time_int'] > $timings[$td+1]['start_time'])) {
		// 				$table .= '<td style="text-align: center;" width="200px" colspan="2"><div style="padding-top:10px;"><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div></div> </td>';
		// 				++$td;
		// 				++$td;
		// 				$continue = true;
					
		// 			}elseif ($value['start_time_int'] < $timings[$key]['start_time'] && $value['end_time_int'] == $timings[$key-1]['end_time']) {
		// 				$table .= '<div style="padding-top:10px;"><div class="session-mix-time">'.$value["start_time"].' - '.$value["end_time"].'</div><div>'.$value["session_name"].'</div><div>-<small><strong>'.$value["faculty_name"].'</strong></small></div></div> </td>';
		// 				$merged = true;
		// 				++$td;

		// 			}else{
		// 				$table .= "<td>".(($value['start_time_int'] >= $timings[$key]['start_time'] && $value['start_time_int'] <= $timings[$key]['end_time']) || ($value['start_time_int'] < $timings[$key]['start_time'] && $value['start_time_int'] > $timings[$key-1]['end_time'])) && ($value['end_time_int'] > $timings[$key]['end_time'] && $value['end_time_int'] > $timings[$key+1]['start_time'])."</td>";
		// 			}
		// 		}
		// 	}
		//  	$table .= "</tr>";
		// } 	
		// return $table;	
  //   }

    function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {

	    $dates = array();
	    $current = strtotime($first);
	    $last = strtotime($last);

	    while( $current <= $last ) {

	        $dates[] = date($output_format, $current);
	        $current = strtotime($step, $current);
	    }

	    return $dates;
	}

	public function cmp($a, $b) {
	  if (strtotime($a['date']) == strtotime($b['date'])) {
	    return 0;
	  }

	  return (strtotime($a['date']) < strtotime($b['date'])) ? -1 : 1;
	}

	public function cmpMain($a, $b) {
	  if (strtotime($a['date']) == strtotime($b['date'])) {
	    return 0;
	  }

	  return (strtotime($a['date']) < strtotime($b['date'])) ? -1 : 1;
	}	
	function date_sort($a, $b) {
		return strtotime($a) - strtotime($b);
	}
}


?>
