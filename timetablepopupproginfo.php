<?php

if(!defined('sugarEntry')) define('sugarEntry', true);
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

	require_once('include/entryPoint.php');

	global $db;

	$pid=$_GET['pid1'];

	$progBean = BeanFactory::getBean('scrm_Timetable',$pid);
	 
	$start_date=$progBean->start_date_c; 
	$end_date=$progBean->end_date_c;
	

	if(!empty($start_date)){
		$start = date("Y-m-d", strtotime($start_date));
	}
	if(!empty($end_date)){
		$end = date("Y-m-d", strtotime($end_date));
	}
	$curr_date=date("Y-m-d");
	
	$days = $progBean->no_of_days_c;
	
	$venue=$progBean->venue_c;

	
	echo json_encode(array("a"=>"$start","b"=>"$end","c"=>"$venue","d"=>"$days","e"=>$curr_date));
?>  
