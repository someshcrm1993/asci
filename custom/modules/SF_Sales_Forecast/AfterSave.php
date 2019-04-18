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


class AfterSave {
	function AfterSave($bean,$event,$arguments)
	{
		global $db;
		$sales_forecast_id=$bean->id;
		$sales_year = $bean->year;
		$sales_quarter = $bean->quarter;
		$assigned_user_id = $bean->users_sf_sales_forecast_1users_ida;
		//~ $quarter = $bean->quarter;
		 $opportunity ="SELECT sum(amount) as amount, EXTRACT(MONTH FROM OC.actual_date_closed_c ) as month from opportunities O JOIN users_sf_sales_forecast_1_c SFC ON SFC.users_sf_sales_forecast_1users_ida =  '$assigned_user_id'  JOIN opportunities_cstm OC ON OC.id_c = O.id where O.sales_stage='Closed Won' and O.deleted=0 and EXTRACT(YEAR FROM OC.actual_date_closed_c) ='$sales_year' and O.assigned_user_id='$assigned_user_id'";
		 $result  = $db->query($opportunity);
		 $row = $db->fetchByAssoc($result);
		 $amount = $row['amount'];
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
		//~ echo $sales_year;
		//~ echo $year;
		//~ echo $sales_quarter;
		//~ echo $quarter;
		//~ exit;
		if(($sales_quarter == $quarter) && ($sales_year == $year))
		{
			$related_opporunities = "UPDATE sf_sales_forecast SET opportunities_won ='$amount' where sf_sales_forecast.id='$sales_forecast_id' and sf_sales_forecast.year='$year' and sf_sales_forecast.quarter='$quarter' and sf_sales_forecast.deleted=0";
		//~ exit;
			//$GLOBALS['log']->fatal($related_opporunities);
		$result_opportunities = $db->query($related_opporunities);
		}
		else
		{
			$related_opporunities = "UPDATE sf_sales_forecast SET opportunities_won ='0.00' where sf_sales_forecast.id='$sales_forecast_id' and sf_sales_forecast.year='$sales_year' and sf_sales_forecast.quarter='$sales_quarter' and sf_sales_forecast.deleted=0";
		//~ exit;
			//$GLOBALS['log']->fatal($related_opporunities);
		$result_opportunities = $db->query($related_opporunities);
		}
	}
}	


?>
