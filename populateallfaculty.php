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

	// $area=$_GET['area'];
	
	$i=0;
	
	$names = array();
	$ids = array();
	$facultyBean = BeanFactory::newBean('scrm_Partners');
	$list = $facultyBean->get_list(
									$order_by = "",
									$where = "",
									$row_offset = 0,
									$limit=-1,
									$max=-1,
									$show_deleted = 0
			);
	$i = 0;
	foreach ($list['list'] as $key => $value){
		$names[$key]=$value->name; 
		$ids[$key]=$value->id;
		$i++;
	}

	echo json_encode(array('result1'=>$names,'result2'=>$ids));	
	
?>  
