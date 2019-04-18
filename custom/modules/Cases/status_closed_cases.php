<?php

//Nitheesh R
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


class StatusClosedCases {

function statusClosedCases($bean, $event, $arguments){


global $db;    
global $current_user;
$current_user_id = $current_user->id;
$current_user_full_name =$current_user->full_name;

$timeDate = new TimeDate();
$dbDate = date('Y-m-d H:i:s');
$localDate = $timeDate->to_display_date_time($dbDate, true, true, $current_user);

$currentCaseName      = $bean->name;
$currentCaseID        = $bean->id;
$caseStatus           = $bean->status;
$accountName          = $bean->account_name;
$accountId            = $bean->account_id;   
$case_resolution      = $bean->resolution;

if($caseStatus=='Closed_Closed'){

$dateformat = $current_user->getPreference('datef');
date_default_timezone_set('Asia/Kolkata');
$now = new DateTime();

if($dateformat=='d/m/Y'){
 $correct = $now->format('d/m/Y H:i:s');    
}
$cor = $now->format('d-m-Y @ H:i:s'); 

       $note_name = $currentCaseName." - "."closed.";
       //$note_content = "The case named ".$currentCaseName." is closed by ".$current_user_full_name." on ".$cor.".";
       $note_content = $case_resolution;
       $parent_type = "Cases";

       $objnote         = BeanFactory::getBean('Notes');
       $noteName        = $objnote->name               = $note_name;
       $noteDescription = $objnote->description        = $note_content;
		          $objnote->parent_type        = $parent_type;
		          $objnote->parent_name        = $currentCaseName;
		          $objnote->parent_id          = $currentCaseID;
		          $objnote->assigned_user_name = $current_user_full_name;
		          $objnote->assigned_user_id   = $current_user_id;

$qry1="SELECT id FROM notes WHERE name = '$noteName' AND  parent_type = '$parent_type' AND parent_id = '$currentCaseID' AND deleted= 0";

// AND description = '$note_content' 

		$value1=$db->query($qry1);
                $check1  =   $get_values_row1=$db->fetchByAssoc($value1);
		if(!$check1)
		{
		$objnote->save();	
		}

		if($check1)
		{

		
		}

                
             }                    
     
    }
}
