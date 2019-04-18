<?php
/*
Author : Rathina Ganesh 
Date : 23rd May 2017
*/

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class CustomCalendar{

	public function __construct(){

	}

	public function getBean($module,$id){
		return $bean = BeanFactory::getBean($module, $id);
	}

	public function getlinkedBean($linkName,$beanName,$id,$module){
		$bean = $this->getBean($module, $id);
		return $relatedBean = $bean->get_linked_beans($linkName,$beanName); 
	}

	public function fetchCalendarData($module,$dateType,$color){
		$bean = BeanFactory::getBean($module);
		$bean_list = $bean->get_full_list("");
		$data = array();
		$i=0;
		foreach($bean_list as $value){
			$contacts = $value->get_linked_beans('project_contacts_2');
			$status = array();
            foreach ($contacts as $contact) {
                $status[] = $contact->nomination_status_c;
            }
            $countstatus = array_count_values($status);
			$data[$i]['id'] = $value->id; 
			$data[$i]['url'] = 'index.php?action=DetailView&module='.$module.'&record='.$value->id.'&return_module='.$module.'&return_action=DetailView'; 
			$noofparticipants = (empty($countstatus["Accepted"])) ? '0' : $countstatus["Accepted"];
			$data[$i]['title'] = $value->name.", PD - ".$value->assigned_user_name.", Participants - ".$noofparticipants; 
			switch ($dateType) {
				case 'start_end':
					$data[$i]['start'] = date('Y-m-d',strtotime($value->start_date_c)); 
					$data[$i]['end'] = date('Y-m-d',strtotime($value->end_date_c)); 
					$data[$i]['tooltip'] = $value->name.", PD - ".$value->assigned_user_name.' Confirmed Slot ('.$data[$i]['start']." - ".$data[$i]['end'].")"; 
					break;
				case 'pstart_end1':
					$data[$i]['start'] = date('Y-m-d',strtotime($value->estimated_start_date)); 
					$data[$i]['end'] = date('Y-m-d',strtotime($value->estimated_end_date)); 
					$data[$i]['tooltip'] = $value->name.", PD - ".$value->assigned_user_name.' Tentative Slot 1('.$data[$i]['start']." - ".$data[$i]['end'].")"; 
					break;
				case 'pstart_end2':
					$data[$i]['start'] = date('Y-m-d',strtotime($value->estimated_start_date1_c)); 
					$data[$i]['end'] = date('Y-m-d',strtotime($value->estimated_end_date1_c));
					$data[$i]['tooltip'] = $value->name.", PD - ".$value->assigned_user_name.' Tentative Slot 2('.$data[$i]['start']." - ".$data[$i]['end'].")";  
					break;
			}
			
			$data[$i]['color'] = $color; 
			$i++;
		}
		return $data;
	}

	public function displayCalendar($calendarData){
		require_once('custom/calendar.html');
	}

	public function displayData($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	
}

$calendar = new CustomCalendar();
if($_REQUEST['dd']){
	global $db;
	// $bean = BeanFactory::getBean('ACLRoles');
	// foreach($bean->get_full_list("") as $key=>$value){
	// 	echo $value->name."<br>";
	// }
	$bean = BeanFactory::getBean('Project');
	$SecurityGroupsBean = BeanFactory::getBean('SecurityGroups');
	foreach($SecurityGroupsBean->get_full_list("") as $key=>$value){
		$sgArray[$value->name] = $value->id;
	}
	// print_r($sgArray);
	// foreach($bean->get_full_list("") as $key=>$value){
	// 	$sid = $sgArray[$value->centre_c];
	// 	$recid = create_guid();
	// 	$date = date('Y-m-d H:i:s');
	// 	$pid = $value->id;
	// 	$module = 'Project';
	// 	$selectQueryResult = $db->query("SELECT id,count(id) as count FROM securitygroups_records WHERE deleted = 0 and securitygroup_id = '$sid' and record_id = '$pid'");
 //        while($row = $db->fetchByAssoc($selectQueryResult)){
 //        	if($row['count']){
 //        		echo 'exist '.$row['id'];
 //        	}else{
 //        		$db->query("INSERT INTO securitygroups_records(id, securitygroup_id, record_id, module, date_modified, modified_user_id, created_by, deleted) VALUES ('$recid','$sid','$pid','$module','$date','1','1','0')");
 //        	}
        	
 //        }
		
		
	// 	// echo $value->id."==>".$value->centre_c."<br>";
	// }
	// require_once('custom/include/language/en_us.lang.php');
	// global $app_list_strings;
	// foreach($GLOBALS['app_list_strings'][$_REQUEST['dd']] as $ddKey=>$ddValue){
	// 	echo $ddKey."<br>";
	// }
	exit();
}
$calendarData = $calendar->fetchCalendarData('Project','start_end','green');
$start_enddata = $calendarData;
$calendarData = $calendar->fetchCalendarData('Project','pstart_end1','orange');
$pstart_end1data = $calendarData;
$start_pstart = array_merge($start_enddata,$pstart_end1data);
$calendarData = $calendar->fetchCalendarData('Project','pstart_end2','yellow');
$pstart_end2data = $calendarData;
$finalData = array_merge($start_pstart,$pstart_end2data);
$calendar->displayCalendar($finalData);
// $calendar->displayData($finalData);
// $calendar->displayData($calendar->getlinkedBean('opportunities','Opportunities','ce61b641-7289-0358-72db-5902d37d7d70','Accounts'));
/*AJAX requests*/
// if($_REQUEST['type'] == 'patchDate'){
// 		$record_id = $_REQUEST['record_id'];
// 		$date = $_REQUEST['date'];
// 		$bean = $calendar->getBean('Project', $record_id);
// 		$bean->description = date('Y-m-d H:i:s',strtotime($date));
// 		$bean->save();
// 		exit;
// 	}
?>
