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


class UpdateName {
	function update_name($bean,$event,$arguments)
	{
		$sales_user_name = $bean->users_sf_sales_forecast_1_name;
		$sales_year = $bean->year;
		$sales_quarter = $bean->quarter;

                //$GLOBALS['log']->fatal('sales_quarter : '.$sales_quarter);

		if($sales_quarter == '1')
		{
			$quarter ='Q1';
		}
		else if($sales_quarter == '2')
		{
			$quarter = 'Q2';
		}
		else if($sales_quarter == '3')
		{
			$quarter = 'Q3';
		}
		else if($sales_quarter == '4')
		{
				$quarter = 'Q4';
		}
		$Name = $sales_user_name.' '.'-'.' '.$sales_year.' '.'-'.' '. $quarter;
		$bean->name = $Name;
	}
}
?>
