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
	include_once('include/SugarPHPMailer.php');
	include_once('include/utils/db_utils.php');
	require_once('include/utils.php');
	include('custom/include/language/en_us.lang.php');
	global $db,$body,$body_main,$app_list_strings;
	global $sugar_config;

	header("Content-type: application/vnd.ms-word");
	 
	header("Content-Disposition: attachment;Filename=LOP.doc");    

	ob_clean();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Word Report</title>
</head>
<body>
<style type="text/css">
	 p.MsoNormal, li.MsoNormal, div.MsoNormal
	    {
	    font-size:12.0pt;
	    font-family:"Times New Roman";}
	@page Section1
	    {size:595.3pt 841.9pt;
	    margin: 28.8pt 42pt 19.6pt 20pt;}
	div.Section1
	    {page:Section1;}
	  
	  .temprow
	  {
	    border:1px solid #ff00000;
	    height:220px;
	  }
	.box {
	  float: left;
	  margin: 1em;
	}
</style>
<div class="Section1">
	<div class="MsoNormal">
		<div class="" align="center">
			<img src="<?php echo $sugar_config['site_url'] ?>custom/modules/Project/asci_small_logo.jpg" height="50" width="50" style="width: 2%">
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA :: HYDERABAD - 500 082</h4>
			
			<h4><?php echo $projectBean->name ?></h4><strong>(
    						<?php
			   					echo date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y"); 
			   				?>		
			   				)
			</strong>			
			<h4>Program Directors: <?php echo $projectBean->assigned_user_name; ?>  <?php echo $projectBean->spd_c == ''? '' : '&'.$projectBean->spd_c; ?><br>
			Program Code:- <?php echo $projectBean->programme_id_c; ?>
			</h4>
			<br>
			<h5><u>LIST OF PARTICIPANTS</u></h5>
			<table align="center" width="100%" cellpadding="0" cellspacing="0">
				<tbody border="1" style="border: 1px solid #000;">
					<tr>
						<td style="border: 1px solid #000;">SI No.</td>
						<td style="border: 1px solid #000;">Room No.</td>
						<td style="border: 1px solid #000;">Name</td>
						<td style="border: 1px solid #000;">Designation & Organization</td>
					</tr>
						<?php 
							$i = 0;
							foreach ($newData as $value) {
								echo "<tr>";
								$and = ' & <div>';
								$end = '</div>';
								if ($value['designation_c'] == '' && $value['sponsor_organisation_c'] != '') {
									$and = '';	
								}else if($value['sponsor_organisation_c'] == ''){
									$and = '';
								}

								$org = null;
								if ($value['account_id']) {
									$org = BeanFactory::getBean('Accounts',$value['account_id']);
								}
								$room = $db->getOne("SELECT room_no_c FROM scrm_accommodation_cstm WHERE locate('{$value["id"]}',participants_c) > 0");
								echo "<td style='border: 1px solid #000;'>".++$i."</td>";
								echo "<td style='border: 1px solid #000;'>".$room."</td>";
								echo "<td style='border: 1px solid #000;'>".$value['name']."</td>";
								echo "<td style='border: 1px solid #000;'>".$value['designation_c']."<br>".$value['account_name'];
								if ($org) {
									echo "<br>".$org->billing_address_street."<br>".$org->billing_address_city.' - '.$org->billing_address_postalcode."<br>".$org->billing_address_state."<br>".$org->billing_address_country."<br>".$value['phone_mobile']."<br>".$value['phone_work']."</td>";
								}
								echo "</tr>";
							}
						?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html>
<?php exit; ?>
