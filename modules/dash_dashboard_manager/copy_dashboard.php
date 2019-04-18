<link rel="stylesheet" type="text/css" href="custom/themes/default/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="custom/themes/default/css/dashboard-manager.css">
<script type="text/javascript" src="custom/themes/default/javascript/jquery.dataTables.min.js">	</script>
<script type="text/javascript" src="custom/themes/default/javascript/custom-dashboard-manager.js">	</script>

<?php
if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
global $db, $sugar_config;

if(isset($_POST['copy']) or $_POST['copy']=="Apply")
{
			$querycheck='SELECT 1 FROM deleted_users_dashlets';
			$query_result=$db->query($querycheck);
			if ($query_result === FALSE)
			{
			$create_table=$db->query("create table deleted_users_dashlets(id INT(11) NOT NULL AUTO_INCREMENT,assigned_user_id VARCHAR(255), contents LONGTEXT, created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,category VARCHAR(255),PRIMARY KEY (id))");
			}
			$content_query = $db->query("SELECT * FROM user_preferences where deleted='0' and category='Home' and  	assigned_user_id='".$_POST['copy_from']."' ");
			$content_row = $db->fetchByAssoc($content_query);
//		 print_r($content_row);


				if($_POST['all_user_selected_click']=="all_selected")
				{
				$result = $db->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT u.id, (SELECT CONCAT( COALESCE(users.first_name
				,''), ' ', COALESCE(users.last_name,'') ) as rn from users where u
				.reports_to_id=users.id) AS report_name, CONCAT( COALESCE(u.first_name,''), ' ', COALESCE(u.last_name,'') ) AS name,  u.id AS id, u.title AS title, u.department AS department, u.reports_to_id AS reports_to_id, ea.email_address AS email FROM user_preferences AS up LEFT JOIN users AS u ON u.id = up.assigned_user_id LEFT JOIN email_addr_bean_rel AS ebr ON ebr.bean_id = u.id LEFT JOIN email_addresses AS ea ON ea.id = ebr.email_address_id where u.deleted = '0' AND up.deleted =0 AND up.category = 'Home' AND ebr.bean_module = 'Users' AND ebr.deleted = '0' AND u.id != '".$_POST['copy_from']."'");
				while($row =  $db->fetchByAssoc($result)){ 
				$all_user[]=$row['id'];
				}	  
				$_POST['user_list']=$all_user; 
				}

			if($_POST['all_user_role_selected_click']=="all_selected")
			{
			$aclrole_list = $db->query("select * from  acl_roles_users where role_id='".$_POST['acl_roles_list']."' and deleted='0'");
			while ($aclrolerow = $db->fetchByAssoc($aclrole_list)) {

			$result = $db->query("select * from users where id='".$aclrolerow['user_id']."' and deleted='0' and id!='".$_POST['copy_from']."'");
			while ($row = $db->fetchByAssoc($result)) {
			$all_id[]=$row['id'];
			}	
			}
			$_POST['aclrole_list']=$all_id; 
			}

				if($_POST['all_user_team_selected_click']=="all_selected")
				{
				$security_list = $db->query("select * from  securitygroups_users where securitygroup_id='".$_POST['securitygroup_list']."' and deleted='0'");
				while ($securityrow = $db->fetchByAssoc($security_list)) {

				$result = $db->query("select * from users where id='".$securityrow['user_id']."' and deleted='0' and id!='".$_POST['copy_from']."'");
				while ($row = $db->fetchByAssoc($result)) {
				$all_id[]=$row['id'];
				}	
				}
				$_POST['securitygroupuser_list']=$all_id; 
				}


			if(count($_POST['user_list'])>=1)
			{
			$change_dashlet_request=$_POST['user_list'];	
			}
			else if(!empty($_POST['acl_roles_list']))
			{
			$change_dashlet_request=$_POST['aclrole_list'];
			}
			else if(!empty($_POST['securitygroup_list']))
			{
			$change_dashlet_request=$_POST['securitygroupuser_list'];
			}

//echo "<pre>";
//print_r($change_dashlet_request);

				$up=0;
				foreach($change_dashlet_request as $cg)
				{
				$backup_detail = $db->query("SELECT * FROM user_preferences where assigned_user_id='".$cg."' and category='Home' and deleted='0' ");
				$backup_row = $db->fetchByAssoc($backup_detail);
				$insert_backup=$db->query("INSERT INTO deleted_users_dashlets(assigned_user_id, contents, category)
				VALUES ('".$backup_row['assigned_user_id']."','".$backup_row['contents']."','".$backup_row['category']."')");
				if($insert_backup)
				{
				//echo "UPDATE user_preferences SET contents='".$content_row['contents']."' WHERE id='".$backup_row['id']."'";
				$update=$db->query("UPDATE user_preferences SET contents='".$content_row['contents']."' WHERE id='".$backup_row['id']."'"); 
				if($update)
				{
				$up++;
				}
				}
				}

	echo "<div class=' alert alert-success'> Dashboard copied successfully for ".$up." users.   <a class='pull-right ' style='font-size:22px;margin-top:-8px' data-dismiss='alert' href='#'><strong>x</strong></a></div>";	
	
}
?>




		<div style="min-height:500px">
		<h1>Copy Dashboard </h1>
		<hr>	
		<div id="posts_content">
		<table class='table  copy-table display list' ><thead><tr ><td><strong>User Name</strong></td><td><strong>Email Id</strong></td><td><strong>Reports to</strong></td><td><strong>Title</strong></td><td><strong>Department</strong></td><td><strong>Action</strong></td></tr></thead><tbody>
		</tbody></table>
		</div>
		</div>



  <div class="modal fade" id="view_dashboard_modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="" method="post" name="copy_form" id="copy_form">
        <div class="modal-header">
    
          <br>
          <h4 class="modal-title">View Dashboard
			<div class="dropdown pull-right">
			<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Select Viewers
			<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
			<li role="presentation"><a role="menuitem" tabindex="-1" id="user_link" href="#">Users</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" id="role_link" href="#">Roles</a></li>
			<li role="presentation" class="divider"></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" id="team_link" href="#">Teams</a></li>
			</ul>
			</div>
          </h4>
        </div>
        <div class="modal-body">
			
			<p> You wan't to copy <strong><span id="view_name"></span></strong> dashboard to</p>
			<input type='hidden' name="copy_from" id="copy_from" >
			<br>
			
				<div id="users_list">
				<h2>Select Users </h2>
				<input type='hidden' name='all_user_selected_click' id='all_user_selected_click' value=''>
				<table class='table  copy-users-table display list select' width='100%' ><thead><tr >
				<td>
				<?php 
				$result = $db->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT u.id, (SELECT CONCAT( COALESCE(users.first_name
				,''), ' ', COALESCE(users.last_name,'') ) as rn from users where u
				.reports_to_id=users.id) AS report_name, CONCAT( COALESCE(u.first_name,''), ' ', COALESCE(u.last_name,'') ) AS name,  u.id AS id, u.title AS title, u.department AS department, u.reports_to_id AS reports_to_id, ea.email_address AS email FROM user_preferences AS up LEFT JOIN users AS u ON u.id = up.assigned_user_id LEFT JOIN email_addr_bean_rel AS ebr ON ebr.bean_id = u.id LEFT JOIN email_addresses AS ea ON ea.id = ebr.email_address_id where u.deleted = '0' AND up.deleted =0 AND up.category = 'Home' AND ebr.bean_module = 'Users' AND ebr.deleted = '0' AND u.id != '".$_POST['copy_from']."'");
				$tot_users = $result->num_rows;
				?>
				<div class="dropdown" style="border: 1px solid #2767A8;padding:4px 6px 4px 6px !important;vertical-align:middle;border-radius:3px;">
				<label style="float:left"><input type='checkbox' value='1' id='user_select_all' name='user_select_all'/> </label>
				<div id="menu1" data-toggle="dropdown" >
				<span class="caret dropdown-toggle " style="margin-left:10px"></span></div>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="padding:0px">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="select_all_user_link">Select All <?php echo "(".($tot_users-1).")"; ?></a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="deselect_all_user_link">Deselect All</a></li>
				</ul>
				</div>
				</td>
				<td><strong>User Name</strong></td><td><strong>Email Id</strong></td><td><strong>Reports to</strong></td><td><strong>Title</strong></td><td><strong>Department</strong></td></tr></thead>
				</table>
				</div>
					<div id="roles_list" >
					<h2>Select Role </h2>
					<div class="row">
					<div class="col-sm-6 ">
					<select name="acl_roles_list" id="acl_roles_list">
					<option value=""></option>	  
					<?php
					$result = $db->query("select * from acl_roles where deleted='0'");
					while ($row = $db->fetchByAssoc($result)) {
					echo "<option value='".$row['id']."'>".$row['name']."</option>";
					}
					?>
					</select>
					</div>
					<div id="view_aclroleuserlist" class="col-sm-12">
					<input type='hidden' name='all_user_role_selected_click' id='all_user_role_selected_click' value=''>
					<table class='table  copy-roles-users-table display list select' width='100%' ><thead><tr >
					<td>
					<div class="dropdown" style="border: 1px solid #2767A8;padding:4px 6px 4px 6px !important;vertical-align:middle;border-radius:3px;">
					<label style="float:left"><input type="checkbox" id="aclrole_select_all"/> </label>
					<div id="menu1" data-toggle="dropdown" >
					<span class="caret dropdown-toggle " style="margin-left:10px"></span></div>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="padding:0px">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="select_all_user_role_link">Select All </a></li>
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="deselect_all_user_role_link">Deselect All</a></li>
					</ul>
					</div>
					</td>
					<td><strong>User Name</strong></td><td><strong>Email Id</strong></td><td><strong>Reports to</strong></td><td><strong>Title</strong></td><td><strong>Department</strong></td></tr></thead>
					</table>
					</div>
					</div>
					</div>
				<div id="teams_list">
				<h2>Select Team</h2>  
				<div class="row">
				<div class="col-sm-6 ">
				<select name="securitygroup_list" id="securitygroup_list">
				<option value=""></option>	  
				<?php
				$result = $db->query("select * from securitygroups where deleted='0'");
				while ($row = $db->fetchByAssoc($result)) {
				echo "<option value='".$row['id']."'>".$row['name']."</option>";

				}
				?>
				</select>
				</div>
				<br>
				<div id="view_securitygrouplist" class="col-sm-12">
				<input type='hidden' name='all_user_team_selected_click' id='all_user_team_selected_click' value=''>					
				<table class='table copy-teams-users-table display list select' width='100%' ><thead><tr >
				<td>
				<div class="dropdown" style="border: 1px solid #2767A8;padding:4px 6px 4px 6px !important;vertical-align:middle;border-radius:3px;">
				<label style="float:left"><input type="checkbox" id="securitygroup_select_all"/> </label>
				<div id="menu1" data-toggle="dropdown" >
				<span class="caret dropdown-toggle " style="margin-left:10px"></span></div>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="padding:0px">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="select_all_user_team_link">Select All </a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="deselect_all_user_team_link">Deselect All</a></li>
				</ul>
				</div>
				</td>
				<td><strong>User Name</strong></td><td><strong>Email Id</strong></td><td><strong>Reports to</strong></td><td><strong>Title</strong></td><td><strong>Department</strong></td></tr></thead>
				</table>
				</div>
				</div>
				</div>                    
          
          
        </div>
        <div class="modal-footer">
		  <input type="submit" class="btn btn-default" name="copy" id="copy" value="Apply"/>	
          <input type="button" class="btn btn-default" id="close-button-dashboard_modal" data-dismiss="modal" value="Close" />
        </div>
                  </form>
      </div>
    </div>
  </div>
