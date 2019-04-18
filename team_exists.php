<?php

if(!defined('sugarEntry')) define('sugarEntry',true);
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
	
	require_once('include/utils.php');
	require_once('include/entryPoint.php');
	global $db;
	$team=$_REQUEST['team'];
	$query="SELECT count(*) as total FROM scrm_escalation_matrix INNER JOIN scrm_escalation_matrix_cstm ON scrm_escalation_matrix.id=scrm_escalation_matrix_cstm.id_c WHERE deleted='0' AND teams_c='$team'";
	$result=$db->query($query);
	$row=$db->fetchByAssoc($result);
	$total=$row['total'];
	$query_id="SELECT id FROM scrm_escalation_matrix INNER JOIN scrm_escalation_matrix_cstm ON scrm_escalation_matrix.id=scrm_escalation_matrix_cstm.id_c WHERE deleted='0' AND teams_c='$team'";
	$result_id=$db->query($query_id);
	$row_id=$db->fetchByAssoc($result_id);
	$id=$row_id['id'];
	echo $total.','.$id;
?>
