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

	require_once('config.php');
	global $sugar_config;
?>
<style type="text/css">
/*  body{background-color:white;} */
#fbb_tbl {
    background: #ffffff none repeat scroll 0 0;
    border-radius: 5px;
    box-shadow: 0 0 5px 5px #dddddd;
    /* max-width: 500px; 
    text-align: center; */
}
</style>

<div class="col-md-6">
   <form id="update-settings" method="post" action="index.php?module=Administration&action=configureFacebookSettings">
	  <table id="fbb_tbl" class="table" style="margin-top:10% !important;margin-right:auto !important;margin-bottom:22% !important;margin-left:40% !important; background: #FFFFFF !important;padding: 2% 1% 1% 1% !important;padding-top: 1% !important;font-size:12px !important;">

		<thead>
		 <tr><th colspan="2" style="font-size: 160% !important;color:#3A5795 !important;" > <img width="20" height="20" src="themes/SuiteR/images/face3.gif"><label style="margin:2%;"> FACEBOOK CONFIGURATION </label> </th></tr>
		 </thead>
		 <tbody>

			<?php if($_GET['success']){?>
				<tr><td colspan="2"><p id="message" type="text" name="message" style="margin-left:6%;color:green !important;font-weight:bold !important;font-style:italic !important;">Facebook settings updated successfully!</p></td></tr>
<script type="text/javascript">
//var elem1 = document.getElementById("message");
//elem1.data ='';
</script>
			<?php 
				}
			?>

<tr><td><label style="margin-left:20%;margin-top:7%; color:#3A5795 !important;">Page ID </label></td><td><input style="width:95% !important;padding:2% !important;" id="page_id" type="text" class="form-control" name="page_id" value="<?php echo $sugar_config['facebook_page_id'];?>"></td></tr>
<tr><td><label style="margin-left:20%;margin-top:7%; color:#3A5795 !important;" >Page Name </label></td><td><input style="width:95% !important;padding:2% !important;" id="page_name" type="text" class="form-control" name="page_name" value="<?php echo $sugar_config['facebook_page_name'];?>"></td style="color:#FFFFFF !important;"></tr>
<tr><td><label style="margin-left:20%;margin-top:7%; color:#3A5795 !important;" >App ID </label></td><td><input style="width:95% !important;padding:2% !important;" id="app_id" type="text" class="form-control" name="app_id" value="<?php echo $sugar_config['facebook_app_id'];?>"></td></tr>
<tr><td><label style="margin-left:20%;margin-top:7%; color:#3A5795 !important;">Secret ID </label></td><td><input style="width:95% !important;padding:2% !important;" id="secret_id" type="text" class="form-control" name="secret_id" value="<?php echo $sugar_config['facebook_secret_id'];?>"></td></tr>
				  

<td colspan="2" style="padding-top: 3% !important;padding-left: 55% !important;">
<a href="index.php?module=Administration&action=index" style="text-decoration:none !important;">
<input type="button"  value="Cancel" style="background-color:#FF3737 !important; color:#FFFFFF !important;" > </a>  <input type="submit"  value="Update" style="background-color:#85BA12 !important; color:#FFFFFF !important;"></td>
		</tr>
		</tbody>
	  </table>
	</form>
</div>
<?php 
	if(isset($_POST['page_id'])){

require_once 'modules/Configurator/Configurator.php';
$configurator = new Configurator();
$configurator->loadConfig(); // it will load existing configuration in config variable of object

$configurator->config['facebook_service_url']      = $_POST['facebook_service_url'];
$configurator->config['facebook_page_id']          = $_POST['page_id'];
$configurator->config['facebook_page_name']          = $_POST['page_name'];
$configurator->config['facebook_app_id']           = $_POST['app_id'];
$configurator->config['facebook_secret_id']        = $_POST['secret_id'];

$configurator->saveConfig(); // save changes
header("Location: index.php?module=Administration&action=configureFacebookSettings&success=true"); 
//header("Location: index.php?module=Administration&action=index&success=true"); 

	}
?>
