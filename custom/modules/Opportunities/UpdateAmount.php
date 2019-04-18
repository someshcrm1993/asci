<?php
ini_set('display_errors','On');
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


class UpdateAmount {
	function Update_Amount($bean,$event,$arguments)
	{
		$beanFetched = $bean->fetched_row;
		$old_sales_stage = $bean->fetched_row['sales_stage'];
		$old_opportunity_amount = $bean->fetched_row['amount'];
		$old_actual_date = $bean->fetched_row['actual_date_closed_c'];
		global $db;
		$current_date = date('d-m-Y');
		 $CurrentDate = explode('-',$current_date);
		 $year = $CurrentDate[2];
		$month = $CurrentDate[1];
		 if(($month == '01') || ($month == '02') || ($month == '03'))
		{
			$quarter = '1';
		}
		else if(($month =='04') || ($month =='05') || ($month =='06'))
		{
			$quarter ='2';
		}
		else if(($month =='07') || ($month =='08') || ($month == '09'))
		{
			$quarter ='3';
		}
		else if(($month =='10') || ($month =='11') || ($month =='12'))
		{
			$quarter = '4';
		}
		//~ echo $quarter;
		//~ exit;
		$opportunity_amount = $bean->amount;
		$opportunity_id = $bean->id;
		$sales_stage = $bean->sales_stage;
		$assigned_user_id = $bean->assigned_user_id;
		$query_sales_related_id = "SELECT SF.opportunities_won as opportunities_won,SF.id as sales_forecast_id FROM sf_sales_forecast SF JOIN users_sf_sales_forecast_1_c SFC ON SFC.users_sf_sales_forecast_1users_ida =  '$assigned_user_id' AND SF.quarter = '$quarter' AND SF.year =  '$year' AND SF.deleted =0 AND SFC.users_sf_sales_forecast_1sf_sales_forecast_idb = SF.id";
		$result_sales_related = $db->query($query_sales_related_id);
		$row_sales_related = $db->fetchByAssoc($result_sales_related);
		$opportunity_won = $row_sales_related['opportunities_won'];
		$sales_forecast_id = $row_sales_related['sales_forecast_id'];
		//~ exit;
		//$quarter = $row_sales['quarter'];
		//~ echo $sales_stage;
		//~ echo $old_sales_stage;
		//~ echo $old_opportunity_amount;
		//~ echo $opportunity_amount;
		//~ exit;
		if($sales_stage != $old_sales_stage)
		{
			if($sales_stage =='Closed Won')
			{
			$new_opportunity_won = $opportunity_won + $opportunity_amount;
			$update_sales_allocated = "UPDATE sf_sales_forecast set opportunities_won='$new_opportunity_won' where id='$sales_forecast_id' and year='$year' and quarter='$quarter'";
			//$GLOBALS['log']->fatal($update_sales_allocated);
			$result_update_sales_allocated = $db->query($update_sales_allocated);
			}
			else if($old_sales_stage=='Closed Won'){
			$new_opportunity_won = $opportunity_won - $opportunity_amount;
			$update_sales_allocated = "UPDATE sf_sales_forecast set opportunities_won='$new_opportunity_won' where id='$sales_forecast_id' and year='$year' and quarter='$quarter'";
			//~ exit;
			//$GLOBALS['log']->fatal($update_sales_allocated,"Old Closed Won");
			$result_update_sales_allocated = $db->query($update_sales_allocated);
			}
		}
		else if(($sales_stage =='Closed Won') && ($old_sales_stage =='Closed Won'))
		{
			if($old_opportunity_amount != $opportunity_amount)
			{
				$new_opportunity_won = $opportunity_won - $old_opportunity_amount;
				$New_Opportunity_won = $new_opportunity_won + $opportunity_amount;
				$update_sales_allocated = "UPDATE sf_sales_forecast set opportunities_won='$New_Opportunity_won' where id='$sales_forecast_id' and year = '$year' and quarter='$quarter'";
				//$GLOBALS['log']->fatal($update_sales_allocated,"Old Opportunity amount");
				$result_update_sales_allocated = $db->query($update_sales_allocated);
			}
		}

		$queryResult = $db->query("SELECT count(*) as count from opportunities where deleted=0");
		$opportunities = $db->fetchByAssoc($queryResult);


		// print_r(str_replace(' ', '', $bean->programme_year_c)/$opportunities['count']);
		if (empty($bean->fetched_row)) {
			$bean->proposal_id_c = date('Y').'-'.(date('Y')+1).'/'.($opportunities['count']+1);
			$bean->asci_rpf_reference_c = date('Y').'-'.(date('Y')+1).'/'.($opportunities['count']+1);		
		}

	}
}
?>
