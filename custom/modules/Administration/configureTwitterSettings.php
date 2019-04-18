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

<div class="col-md-8">
   <form id="update-settings" method="post" action="index.php?module=Administration&action=configureTwitterSettings">
	  <table id="fbb_tbl" class="table" style="margin-top:10px !important;margin-right:auto !important;margin-bottom:2% !important;margin-left:25% !important; background: #FFFFFF !important;padding: 2% 1% 1% 1% !important;padding-top: 1% !important;font-size:12px !important;">

		<thead>
		 <tr><th colspan="2" style="font-size: 160% !important;color:#3A5795 !important;" > <img width="20" height="20" src="themes/SuiteR/images/twit3.png"> <label style="margin:1%;"> TWITTER CONFIGURATION </label> </th></tr>
		 </thead>
		 <tbody>

			<?php if($_GET['success']){?>
				<tr><td colspan="2"><p id="message" type="text" name="message" style="margin-left:6%;color:green !important;font-weight:bold !important;font-style:italic !important;">Twitter settings updated successfully!</p></td></tr>
<script type="text/javascript">
//var elem1 = document.getElementById("message");
//elem1.data ='';
</script>
			<?php 
				}
			?>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;">Page ID </label></td><td><input style="width:95% !important;" id="twitter_page_id" type="text" class="form-control" name="twitter_page_id" value="<?php echo $sugar_config['twitter_page_id'];?>"></td></tr>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Page Name </label></td><td><input style="width:95% !important;" id="twitter_page_name" type="text" class="form-control" name="twitter_page_name" value="<?php echo $sugar_config['twitter_page_name'];?>"></td style="color:#FFFFFF !important;"></tr>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Page Twitter Handle </label></td><td><input style="width:95% !important;" id="twitter_page_handle" type="text" class="form-control" name="twitter_page_handle" value="<?php echo $sugar_config['twitter_page_handle'];?>"></td></tr>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Twitter App Consumer Key </label></td><td><input style="width:95% !important;" id="twitter_app_consumer_key" type="text" class="form-control" name="twitter_app_consumer_key" value="<?php echo $sugar_config['twitter_app_consumer_key'];?>"></td style="color:#FFFFFF !important;"></tr>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Twitter App Consumer Secret </label></td><td><input style="width:95% !important;" id="twitter_app_consumer_secret" type="text" class="form-control" name="twitter_app_consumer_secret" value="<?php echo $sugar_config['twitter_app_consumer_secret'];?>"></td style="color:#FFFFFF !important;"></tr>

<tr><td><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Twitter App Access Token  </label></td><td><input style="width:95% !important;" id="twitter_app_oauth_access_token" type="text" class="form-control" name="twitter_app_oauth_access_token" value="<?php echo $sugar_config['twitter_app_oauth_access_token'];?>"></td style="color:#FFFFFF !important;"></tr>

<tr><td style="width:30%"><label style="margin-left:20%;margin-top:9px; color:#3A5795 !important;" >Twitter App Access Token Secret  </label></td><td><input style="width:95% !important;" id="twitter_app_oauth_access_token_secret" type="text" class="form-control" name="twitter_app_oauth_access_token_secret" value="<?php echo $sugar_config['twitter_app_oauth_access_token_secret'];?>"></td style="color:#FFFFFF !important;"></tr>
				  
<td colspan="2" style="padding-bottom: 2% !important;padding-top: 1% !important;padding-left: 55% !important;">
<a href="index.php?module=Administration&action=index" style="text-decoration:none !important;">
<input type="button"  value="Cancel" style="background-color:#FF3737 !important; color:#FFFFFF !important;" > </a>  <input type="submit"  value="Update" style="background-color:#85BA12 !important; color:#FFFFFF !important;"></td>
		</tr>
		</tbody>
	  </table>
	</form>
</div>
<?php 
	if(isset($_POST['twitter_page_id'])){

require_once 'modules/Configurator/Configurator.php';
$configurator = new Configurator();
$configurator->loadConfig(); // it will load existing configuration in config variable of object

$configurator->config['twitter_page_id']           = $_POST['twitter_page_id'];
$configurator->config['twitter_page_name']         = $_POST['twitter_page_name'];
$configurator->config['twitter_app_consumer_key']  = $_POST['twitter_app_consumer_key'];
$configurator->config['twitter_app_consumer_secret']  = $_POST['twitter_app_consumer_secret'];
$configurator->config['twitter_app_oauth_access_token']  = $_POST['twitter_app_oauth_access_token'];
$configurator->config['twitter_app_oauth_access_token_secret']  = $_POST['twitter_app_oauth_access_token_secret'];
$configurator->config['twitter_page_handle']       = $_POST['twitter_page_handle'];


$configurator->saveConfig(); // save changes
header("Location: index.php?module=Administration&action=configureTwitterSettings&success=true"); 
//header("Location: index.php?module=Administration&action=index&success=true"); 

	}
?>
