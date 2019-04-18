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
require_once('config.php');
global $db, $sugar_config;
$path= $_POST['path'];
$id= $_POST['id'];

if(empty($id))
{
$id=$_POST['module_id'];	
}
$field= $_POST['field'];
$module= strtolower($_POST['module']);
$full_path=$_POST['path'].$id."_".$field;



$result = $db->query("UPDATE ".$module."_cstm SET ".$field."='' WHERE id_c='".$id."'");
 
if($result) {
if(!empty($_POST['path'])) {
	unlink($full_path);
	echo $f_result="true";
}
}else
{
	$result2 = $db->query("UPDATE ".$module." SET ".$field."='' WHERE id='".$id."'");
	if($result2) {
	if(!empty($_POST['path'])) {
	unlink($full_path);
	echo $f_result="true";
	}
}
}

?>
