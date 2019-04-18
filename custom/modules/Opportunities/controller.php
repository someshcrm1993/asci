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

class OpportunitiesController extends SugarController{

	      public function action_create_records (){

			global $sugar_config; 
			global $db;

		        $module                   = $_REQUEST['module'];
		        $action                   = $_REQUEST['action'];
		        $to_pdf                   = $_REQUEST['to_pdf'];
		        $twitter_handle_c         = $_REQUEST['twitter_handle_c'];
		        $lead_source              = $_REQUEST['lead_source'];
		        $description              = $_REQUEST['description'];
                        $status_id                = $_REQUEST['status_id'];
		        $opportunity_name         = $_REQUEST['opportunity_name'];
		        $sales_stage              = $_REQUEST['sales_stage'];
		        $opportunity_type         = $_REQUEST['opportunity_type'];
		        $account_id               = $_REQUEST['account_id'];	
		        $amount                   = $_REQUEST['amount'];
		        $probability              = $_REQUEST['probability'];
		        $date_closed              = $_REQUEST['date_closed'];
	    
		      

		$opportunity = new Opportunity();

		$opportunity->status                  = $lead_status;
		$opportunity->lead_source             = $lead_source;
		$opportunity->description             = $description;  
		$opportunity->tweet_id_c              = $status_id; 
		$opportunity->twitter_handle_c        = $twitter_handle_c;   
	        $opportunity->name                    = $opportunity_name;
	        $opportunity->sales_stage             = $sales_stage;
	        $opportunity->opportunity_type        = $opportunity_type;
	        $opportunity->account_id              = $account_id;
	        $opportunity->amount                  = $amount;
	        $opportunity->probability             = $probability;
	        $opportunity->date_closed             = $date_closed;
		  	   

$query1  =   "SELECT id_c FROM opportunities_cstm, opportunities WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
		$value1  =   $db->query($query1);
		$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

		if(!$check1){
		$opportunity->save();	
		$created = "y";
		}
		if($check1){
		$created = "n";
		}

$sql = "SELECT id_c FROM opportunities_cstm, opportunities WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
		$result = $db->query($sql);

		if($row6 = $db->fetchByAssoc($result)){

		   $id_c = $row6['id_c'];                    
		}
                        $data2= array();
                        $data2['id_c']                = $id_c;
                        $data2['created']             = $created;
                       
			echo json_encode($data2);

              }   

} 
