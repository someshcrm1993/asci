<?php
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

//By : Aditya Harshey
//Date: 1 Aug 2017
//retun all the dropdowns list

ini_set('display_errors', 1);
if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
include_once('config.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');

global $app_list_strings,$db;
// print_r(error_get_last());exit();
echo json_encode($app_list_strings);
