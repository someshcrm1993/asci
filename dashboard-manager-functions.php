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
 
class Mydashboard{
	
	public function getusername($id,$no)
	{
		global $db, $sugar_config;
		$id=$this->getuserid($id,$no);
		$result = $db->query("SELECT * FROM users WHERE id='".$id."' and deleted='0' ");
		$row = $db->fetchByAssoc($result);

		$name= $row['first_name']." ".$row['last_name'];
		
		echo json_encode(array(
       'name' => $name,
       'id' => $id,
       
   ));
	
	}
	
		public function getuserid($id,$no)
	{
		$id= substr($id, $no);
		return $id;
	}	
	
	
	
	
	   //~ public function aclrole_userlist($id,$no="NULL")
   //~ {
		//~ global $db, $sugar_config;
		//~ 
		//~ 
		//~ 
//~ 
		//~ echo '<ul id="user_list_id">';
		//~ echo '<li></li>';
//~ 
		//~ $aclrole_list = $db->query("select * from  acl_roles_users where role_id='".$id."' and deleted='0'");
		//~ while ($aclrolerow = $db->fetchByAssoc($aclrole_list)) {
		//~ $result = $db->query("select * from users where id='".$aclrolerow['user_id']."' and deleted='0' and deleted='0' and id!='".$id."'");
		//~ while ($row = $db->fetchByAssoc($result)) {
		//~ echo "<li><lable><input type='checkbox' name='aclrole_list[]' value='".$row['id']."' class='aclrole_checkbox' id='aclrole_list_".$row['id']."'> ".$row['first_name']." ".$row['last_name']."</lable></li>";
		//~ }
		//~ }
		//~ echo '</ul>';
	//~ }
		//~ public function securitygroup_userlist($id,$no="NULL")
	//~ {
		//~ global $db, $sugar_config;
		//~ echo '<ul id="user_list_id">';
		//~ echo '<li><label><input type="checkbox" id="securitygroup_select_all"/> Selecct All</label></li>';
//~ 
		//~ $securitygroups_list = $db->query("select * from  securitygroups_users where securitygroup_id='".$id."' and deleted='0'");
		//~ while ($securitygroupsrow = $db->fetchByAssoc($securitygroups_list)) {
		//~ $result = $db->query("select * from users where id='".$securitygroupsrow['user_id']."' and deleted='0' and id!='".$id."'");
		//~ while ($row = $db->fetchByAssoc($result)) {
		//~ echo "<li><lable><input type='checkbox' name='securitygroupuser_list[]' value='".$row['id']."' class='securitygroup_checkbox' id='securitygroupuser_list_".$row['id']."'> ".$row['first_name']." ".$row['last_name']."</lable></li>";
		//~ }
		//~ }
		//~ echo '</ul>';		
	//~ }
	//~ 
	
	
	
	}
?>
