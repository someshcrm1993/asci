<?php

if(!defined("sugarEntry")) define("sugarEntry", true);
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
	
	require_once("include/entryPoint.php");
	global $db;
	date_default_timezone_set("UTC");
	
	$data=$_REQUEST;
	
	// print_r($data);
	// exit;


	//Add to do Action

		if($data['action_popup']=="add_to_do"){

			// print_r($data);
			// exit;

				$bean = BeanFactory::newBean("Tasks");

			
				$reminder = $_REQUEST["reminder"];
		    	$parent_id= $_REQUEST["parent_id"];

		    	//echo 
		    	$assigned_user_id=$_REQUEST["assigned_user_id"];

		    	$parent_type=$_REQUEST["parent_type"];
		    	$subject=$_REQUEST["subject"];
		    	$direction=$_REQUEST["direction"];
		    	$status=$_REQUEST["status2"];

		    	$date = $_REQUEST["date1"];
		    	$date_start_hours=$_REQUEST["date_start_hours"];
		    	$date_start_minutes=$_REQUEST["date_start_minutes"];
		    	$date_start_meridiem=$_REQUEST["date_start_meridiem"];


		    	$hours=$_REQUEST["hours"];
		    	$minutes=$_REQUEST["minutes"];
		    	$description=$_REQUEST["description"];
    	

    			$time=$date_start_hours.":".$date_start_minutes." ".strtoupper($date_start_meridiem);

		
				$time=date("H:i:s", strtotime("$time")); 
				$datetime = date("Y-m-d", strtotime($date) );
				$datetime=$datetime." ".$time;

				
				$bean->name = "$subject";
				$bean->date_entered = "$date";
				$bean->date_modified = "$date";
				$bean->modified_user_id = "$assigned_user_id";
				$bean->created_by = "$assigned_user_id";
				$bean->description = "$description";
				$bean->assigned_user_id = "$assigned_user_id";
				$bean->date_start = "$datetime";
				$bean->date_due = "$datetime";
				$bean->parent_type = "$parent_type";
				$bean->status = "$status2";
				$bean->parent_id = "$parent_id";
		
				$bean->save();
				echo "_success";
				exit;

		}

	//Add to do Action end







	//Schedule meeting action

	if($data['action_popup']=="meeting"){


		if(!isset($_REQUEST['parent_type']) and empty($_REQUEST['parent_type'])){
			
			echo "_fail";
			exit;

		}


		// print_r($data);
		// exit;


		$bean = BeanFactory::newBean("Meetings");


		$reminder = $_REQUEST["reminder"];
    	$parent_id= $_REQUEST["parent_id"];

    	//echo 
    	$assigned_user_id=$_REQUEST["assigned_user_id"];

    	$parent_type=$_REQUEST["parent_type"];
    	$subject=$_REQUEST["subject"];
    	$direction=$_REQUEST["direction"];
    	$status=$_REQUEST["status"];

    	$date = $_REQUEST["date1"];
    	$date_start_hours=$_REQUEST["date_start_hours"];
    	$date_start_minutes=$_REQUEST["date_start_minutes"];
    	$date_start_meridiem=$_REQUEST["date_start_meridiem"];


    	$hours=$_REQUEST["hours"];
    	$minutes=$_REQUEST["minutes"];
    	$description=$_REQUEST["description"];
    	
   

    	$bean->email_reminder_time = "$reminder";
    	$bean->parent_id = "$parent_id";
    	$bean->modified_user_id = "$assigned_user_id";
    	$bean->created_by = "$assigned_user_id";
    	$bean->parent_type = "$parent_type";
    	$bean->name = "$subject";
    	$bean->direction = "$direction";
    	$bean->status = "$status";
    	$bean->duration_hours = "$hours";
    	$bean->duration_minutes = "$minutes";
    	$bean->description = "$description";

    	$bean->reminder_time = "$reminder";
		$bean->email_reminder_time = "$reminder";

		
		$bean->date_entered = "$date";
		$bean->date_modified = "$date";

		//$datetime = $date." ".$date_start_hours.":".$date_start_minutes.$date_start_meridiem;
		
		$time=$date_start_hours.":".$date_start_minutes." ".strtoupper($date_start_meridiem);

		
		$time=date("H:i:s", strtotime("$time")); 
		$datetime = date("Y-m-d", strtotime($date) );
		$datetime=$datetime." ".$time;
		//echo $datetime;
		//$end_datetime = date("Y-m-d H:i:s",strtotime("+ $date_start_hours hour + 30 minute",(strtotime($datetime))));
		//echo $end_datetime;

		$bean->date_start = "$datetime";
			
		$bean->assigned_user_id = $assigned_user_id;

		if(!$bean->save()){


			echo "_fail";
		}

		$record_id = $bean->id;
		//echo $record_id;
		$meeting_user_rel_ID=create_guid();


		$db->query("INSERT INTO `meetings_users`(`id`, `meeting_id`, `user_id`, `required`, `accept_status`, `date_modified`, `deleted`) VALUES ('$meeting_user_rel_ID','$record_id','$assigned_user_id','1','accept','$date','0')");

		echo "_success";
		exit;

	}

	//Schedule meeting action end






	//Log call Action

	if($data['action_popup']=="log_call"){


		// echo "call logged";
		// exit;
		if(!isset($_REQUEST['parent_type']) and empty($_REQUEST['parent_type'])){
			
			echo "_fail";
			exit;

		
		}

		$bean = BeanFactory::newBean("Calls");

		
		$accept_status='accept';

	

    	$reminder = $_REQUEST["reminder"];
    	$parent_id= $_REQUEST["parent_id"];

    	//echo 
    	$assigned_user_id=$_REQUEST["assigned_user_id"];

    	$parent_type=$_REQUEST["parent_type"];
    	$subject=$_REQUEST["subject"];
    	$direction=$_REQUEST["direction"];
    	$status=$_REQUEST["status"];

    	$date = $_REQUEST["date"];
    	$date_start_hours=$_REQUEST["date_start_hours"];
    	$date_start_minutes=$_REQUEST["date_start_minutes"];
    	$date_start_meridiem=$_REQUEST["date_start_meridiem"];


    	$hours=$_REQUEST["hours"];
    	$minutes=$_REQUEST["minutes"];
    	$description=$_REQUEST["description"];
    	
   

    	$bean->email_reminder_time = "$reminder";
    	$bean->parent_id = "$parent_id";
    	$bean->modified_user_id = "$assigned_user_id";
    	$bean->created_by = "$assigned_user_id";
    	$bean->parent_type = "$parent_type";
    	$bean->name = "$subject";
    	$bean->direction = "$direction";
    	$bean->status = "$status";
    	$bean->duration_hours = "$hours";
    	$bean->duration_minutes = "$minutes";
    	$bean->description = "$description";

    	$bean->reminder_time = "$reminder";
		$bean->email_reminder_time = "$reminder";

		
		$bean->date_entered = "$date";
		$bean->date_modified = "$date";

		//$datetime = $date." ".$date_start_hours.":".$date_start_minutes.$date_start_meridiem;
		
		$time=$date_start_hours.":".$date_start_minutes." ".strtoupper($date_start_meridiem);

		
		$time=date("H:i:s", strtotime("$time")); 
		$datetime = date("Y-m-d", strtotime($date) );
		$datetime=$datetime." ".$time;
		//echo $datetime;
		//$end_datetime = date("Y-m-d H:i:s",strtotime("+ $date_start_hours hour + 30 minute",(strtotime($datetime))));
		//echo $end_datetime;

		$bean->date_start = "$datetime";


		//End date time is not needed
		$bean->date_end = "$datetime";


		$bean->assigned_user_id = $assigned_user_id;
		//exit;
		if(!$bean->save()){


			echo "_fail";
		}

		$record_id = $bean->id;
		//echo $record_id;
		$call_user_rel_ID=create_guid();

		// echo "INSERT INTO `calls_users` (`id`, `call_id`, `user_id`, 	`required`,`date_modified`,`accept_status`, `deleted`) VALUES ('$call_user_rel_ID','$record_id','$assigned_user_id','1','$date','accept','0')";

		$db->query("INSERT INTO `calls_users` (`id`, `call_id`, `user_id`, 	`required`,`date_modified`,`accept_status`, `deleted`) VALUES ('$call_user_rel_ID','$record_id','$assigned_user_id','1','$date','accept','0')");

		echo "_success";

		exit;

	}






	//Delete Action
	if($data['action']=="delete"){

			//echo "_success";

			// print_r($data);
			// exit;
			$module=strtolower($data['module']);

			//echo
			$query="UPDATE `$module` SET `deleted` =1 WHERE id='$data[id]'";

			if($db->query($query)){
					echo "_success";
					exit;
				}else{
					echo "_fail";
					exit;
				}

	}

	//
	

	exit;
?>
