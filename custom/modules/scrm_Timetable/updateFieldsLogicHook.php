<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class updateFields{

	static $already_ran = false;
	
	/**
	 * @param $interval
	 * @param $datefrom
	 * @param $dateto
	 * @param bool $using_timestamps
	 * @return false|float|int|string
	 */
	function Weekdiff($interval, $datefrom, $dateto, $using_timestamps = false)
	{
		/*
		$interval can be:
		yyyy - Number of full years
		q    - Number of full quarters
		m    - Number of full months
		y    - Difference between day numbers
			   (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
		d    - Number of full days
		w    - Number of full weekdays
		ww   - Number of full weeks
		h    - Number of full hours
		n    - Number of full minutes
		s    - Number of full seconds (default)
		*/

		if (!$using_timestamps) {
			$datefrom = strtotime($datefrom, 0);
			$dateto   = strtotime($dateto, 0);
		}

		$difference        = $dateto - $datefrom; // Difference in seconds
		$months_difference = 0;

		switch ($interval) {
			case 'yyyy': // Number of full years
				$years_difference = floor($difference / 31536000);
				if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
					$years_difference--;
				}

				if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
					$years_difference++;
				}

				$datediff = $years_difference;
			break;

			case "q": // Number of full quarters
				$quarters_difference = floor($difference / 8035200);

				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}

				$quarters_difference--;
				$datediff = $quarters_difference;
			break;

			case "m": // Number of full months
				$months_difference = floor($difference / 2678400);

				while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					$months_difference++;
				}

				$months_difference--;

				$datediff = $months_difference;
			break;

			case 'y': // Difference between day numbers
				$datediff = date("z", $dateto) - date("z", $datefrom);
			break;

			case "d": // Number of full days
				$datediff = floor($difference / 86400);
			break;

			case "w": // Number of full weekdays
				$days_difference  = floor($difference / 86400);
				$weeks_difference = floor($days_difference / 7); // Complete weeks
				$first_day        = date("w", $datefrom);
				$days_remainder   = floor($days_difference % 7);
				$odd_days         = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?

				if ($odd_days > 7) { // Sunday
					$days_remainder--;
				}

				if ($odd_days > 6) { // Saturday
					$days_remainder--;
				}

				$datediff = ($weeks_difference * 5) + $days_remainder;
			break;

			case "ww": // Number of full weeks
				$datediff = floor($difference / 604800);
			break;

			case "h": // Number of full hours
				$datediff = floor($difference / 3600);
			break;

			case "n": // Number of full minutes
				$datediff = floor($difference / 60);
			break;

			default: // Number of full seconds (default)
				$datediff = $difference;
			break;
		}

		return $datediff;
	}
	function updateFields($bean, $event, $arguments){
		if(self::$already_ran == true) return; 
		self::$already_ran = true;

		global $db,$sugar_config;	
		// date_default_timezone_set('UTC');			
		$number_of_days = $bean->no_of_days_c;
		$total_number_of_sessions = $number_of_days * 4;
		$timings = [
				0 => ['start_time'=>'03:30','end_time'=>'5:00'],
				1 => ['start_time'=>'5:30','end_time'=>'7:00'],
				2 => ['start_time'=>'8:30','end_time'=>'10:00'],
				3 => ['start_time'=>'10:30','end_time'=>'12:00'],
				4 => ['start_time'=>'12:30','end_time'=>'14:00']
		];

		if ($bean->session_info_check_c) {
			for($r=1;$r<=$number_of_days;$r++)
			{
				for($i=0;$i<5;$i++)
				{
					$date = $bean->start_date_c.' '.$timings[$i]['start_time'];
					// print_r($date);exit();

					$date = DateTime::createFromFormat('Y-m-d H:i', $date);
					$date = $date->format('Y-m-d H:i');
					$date = strtotime("+".($r-1)." day", strtotime($date));

					$date = date("Y-m-d H:i:s", $date);
				

					$new_session = BeanFactory::newBean('scrm_Session_Information');
					$new_session->name = "Day ".$r." - Session ".($i+1);
					$new_session->slot_c = $i+1;
					// $new_session->day_c = "Day ".$r;
					$new_session->faculty_id_c = "Faculty ".$r;
					$new_session->start_time_c = $date;
					$date = $bean->start_date_c.' '.$timings[$i]['end_time'];
					// print_r($date);exit();
					$date = DateTime::createFromFormat('Y-m-d H:i', $date);
					$date = $date->format('Y-m-d H:i');
					$date = strtotime("+".($r-1)." day", strtotime($date));

					$date = date("Y-m-d H:i:s", $date);
					/*code by ashvin
						  date: remove sunday from long format timetable
						  Date:28-12-2018
						*/
					$d =  date_format(date_create($date),"M d, Y, l");
						
					$dateDay=date_format(date_create($date),"l");
					if($dateDay=="Sunday") { continue; }
					/*end*/
					
					$new_session->end_time_c = $date;
					$new_session->scrm_timetable_scrm_session_information_1scrm_timetable_ida = $bean->id;
					$new_session->scrm_timetable_scrm_session_information_1_name = $bean->project_scrm_timetable_1_name;
					$new_session->save();		
		
				}
			}
			/*Code by Ashvin
			  Date:24-12-2018
			  Reason: Update Timmtable footer week wise
			  Start
			*/
			
			$Startdate = date_format(date_create($bean->start_date_c),"d-m-Y");	
			$Enddate = date_format(date_create($bean->end_date_c),"d-m-Y");		
			$noWeeks=$this->Weekdiff('ww', $Enddate, $Startdate, false);		
			$noWeek = abs($noWeeks);

			if($noWeek>0){
				
				for($j=1;$j<=$noWeek+1;$j++){
					$new_Footer = BeanFactory::newBean('scrm_timetable_footer');
					$new_Footer->name = $bean->project_scrm_timetable_1_name."- Timetable: Week- ".$j;
					$new_Footer->description = " ";
					$new_Footer->weekno_c = $j;
					$new_Footer->timetable_id_c = $bean->id;
					$new_Footer->scrm_timetable_scrm_timetable_footer_1scrm_timetable_ida = $bean->id;
					$new_Footer-> scrm_timetable_scrm_timetable_footer_1_name = $bean->project_scrm_timetable_1_name;
					$new_Footer->save();
				}
			}
			
			/*Code by Ashvin
			  Date:24-12-2018
			  Reason: Update Timmtable footer week wise
			  End
			*/
		}	
		
		$bean->session_info_check_c = 0;
		$bean->name = $bean->project_scrm_timetable_1_name;
		$bean->save();
	}

}



