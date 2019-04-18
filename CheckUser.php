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
global $timedate;
global $current_user;
$assigned_user_id = $_GET['assigned_user_id'];
$year = $_GET['year'];
$quarter = $_GET['quarter'];
$query_sales = "SELECT count(SF.id) as sf_id
FROM sf_sales_forecast SF
JOIN users_sf_sales_forecast_1_c SFC ON SFC.users_sf_sales_forecast_1users_ida =  '$assigned_user_id'
AND SF.quarter = '$quarter'
AND SF.year =  '$year'
AND SF.deleted =0
AND SFC.users_sf_sales_forecast_1sf_sales_forecast_idb = SF.id";
$result = $db->query($query_sales);
$row = $db->fetchByAssoc($result);
echo $sales_forecast_id = $row['sf_id'];
