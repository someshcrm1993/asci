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
        
        .fbb_tbl {
            background: #ffffff none repeat scroll 0 0;
            border-radius: 5px;
            box-shadow: 0 0 5px 5px #dddddd;
            /* max-width: 500px; 
    text-align: center; */
        }
    </style>
    <?php
    	session_start();
    	if (isset($_SESSION['success'])) {
    		echo "<div class='alert alert-success'>Bank details has been updated successfully!</div>";
    		unset($_SESSION['success']);
    	}
    ?>
    <div class="col-md-6">
        <form id="update_bank_inr" method="post" action="index.php?module=Administration&action=configureBankDetails">
            <table class="table fbb_tbl" style="margin-top:10% !important; background: #FFFFFF !important;padding: 2% 1% 1% 1% !important;padding-top: 1% !important;font-size:12px !important;">

                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 160% !important;color:#3A5795 !important;">
                            <label style="margin:2%;"> Bank Details For INR </label>
                        </th>
                    </tr>
                </thead>
                <tbody>



					<?php
						foreach ($sugar_config['bank']['inr'] as $key => $value) {
							echo "<tr>";
							echo "<td>";
							echo "<label style='margin-left:20%;margin-top:7%; color:#3A5795 !important;'>".$key."</label>";
							echo "</td>";
							echo "<td>";
							echo " <input style='width:95% !important;padding:2% !important;' type='text' class='form-control' name='".$key."' value='".$value."'>";
							echo "</td>";
							echo "</tr>";
						}
					?>
							<tr>
	                            <td colspan="2" style="padding-top: 3% !important;padding-left: 55% !important;">
                                	<a href="index.php?module=Administration&action=index" style="text-decoration:none !important;">
                                    <input type="button" value="Cancel" style="background-color:#FF3737 !important; color:#FFFFFF !important;"> </a>
                                	<input type="submit" value="Update" style="background-color:#85BA12 !important; color:#FFFFFF !important;">
                            	</td>
                            </tr>
                </tbody>
            </table>
            <input type="hidden" name="bank_details" value="inr">
        </form>
    </div>

    <div class="col-md-6">
        <form id="update_bank_usd" method="post" action="index.php?module=Administration&action=configureBankDetails">
            <table  class="table fbb_tbl" style="margin-top:10% !important; background: #FFFFFF !important;padding: 2% 1% 1% 1% !important;padding-top: 1% !important;font-size:12px !important;">

                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 160% !important;color:#3A5795 !important;">
                            <label style="margin:2%;"> Bank Details For USD</label>
                        </th>
                    </tr>
                </thead>
                <tbody>


					<?php
						foreach ($sugar_config['bank']['usd'] as $key => $value) {
							echo "<tr>";
							echo "<td>";
							echo "<label style='margin-left:20%;margin-top:7%; color:#3A5795 !important;'>".$key."</label>";
							echo "</td>";
							echo "<td>";
                            echo " <input style='width:95% !important;padding:2% !important;' type='text' class='form-control' name='".$key."' value='".$value."'>";
							echo "</td>";
							echo "</tr>";
						}
					?>
							<tr>
	                            <td colspan="2" style="padding-top: 3% !important;padding-left: 55% !important;">
                                	<a href="index.php?module=Administration&action=index" style="text-decoration:none !important;">
                                    <input type="button" value="Cancel" style="background-color:#FF3737 !important; color:#FFFFFF !important;"> </a>
                                	<input type="submit" value="Update" style="background-color:#85BA12 !important; color:#FFFFFF !important;">
                            	</td>
                            </tr>

                </tbody>
            </table>
            <input type="hidden" name="bank_details" value="usd">
        </form>
    </div>

    <div class="col-md-6">
        <form id="update_bank_signature" method="post" action="index.php?module=Administration&action=configureBankDetails">
            <table class="table fbb_tbl" style="margin-top:10% !important; background: #FFFFFF !important;padding: 2% 1% 1% 1% !important;padding-top: 1% !important;font-size:12px !important;">

                <thead>
                    <tr>
                        <th colspan="2" style="font-size: 160% !important;color:#3A5795 !important;">
                            <label style="margin:2%;">Update Signature</label>
                        </th>
                    </tr>
                </thead>
                <tbody>


					<tr>
						<td colspan="2" style="font-size: 130% !important;color:#3A5795 !important;">
                            <label style="margin:2%;">Proforma Invoice</label>
                        </td>
					</tr>	
					<tr>
						<td>
							<label style='margin-left:20%;margin-top:7%; color:#3A5795 !important;'>Finance Officer</label>
						</td>
						
						<td>
							<input style='width:95% !important;padding:2% !important;' type='text' class='form-control' name='proforma' value='<?php echo $sugar_config['bank']['signature']['proforma']; ?>'>
						</td>
					</tr>

					<tr>
						<td colspan="2" style="font-size: 130% !important;color:#3A5795 !important;">
                            <label style="margin:2%;">Invoice</label>
                        </td>
					</tr>	
					<tr>
						<td>
							<label style='margin-left:20%;margin-top:7%; color:#3A5795 !important;'>Finance Officer</label>
						</td>
						
						<td>
							<input style='width:95% !important;padding:2% !important;' type='text' class='form-control' name='invoice' value='<?php echo $sugar_config['bank']['signature']['invoice']; ?>'>
						</td>
					</tr>
					<tr>
                        <td colspan="2" style="padding-top: 3% !important;padding-left: 55% !important;">
                        	<a href="index.php?module=Administration&action=index" style="text-decoration:none !important;">
                            <input type="button" value="Cancel" style="background-color:#FF3737 !important; color:#FFFFFF !important;"> </a>
                        	<input type="submit" value="Update" style="background-color:#85BA12 !important; color:#FFFFFF !important;">
                    	</td>
                    </tr>

                </tbody>
            </table>
            <input type="hidden" name="bank_details" value="signature">
        </form>
    </div>
    <?php 
	if(isset($_POST['bank_details'])){
		$postData = $_POST;
		// ob_clean();
		// print_r($_POST);exit();
		require_once 'modules/Configurator/Configurator.php';
		$configurator = new Configurator();
		$configurator->loadConfig(); 
		if ($_POST['bank_details'] != 'signature') {
			foreach ($_POST as $key => $value) {
				if ($value != '' && !empty($value) && $key != 'bank_details') {
					$configurator->config['bank'][$_POST['bank_details']][str_replace('_', ' ', $key)] = $value;
				}
			}
		}else{
			foreach ($_POST	 as $key => $value) {
				if ($value != '' && !empty($value) && $key != 'bank_details') {
					$configurator->config['bank'][$_POST['bank_details']][str_replace('_', ' ', $key)] = $value;
				}
			}			
		}
		// ob_clean();
		// print_r($configurator);exit();

		$configurator->saveConfig(); // save changes

		$_SESSION['success'] = true;
		header("Location: index.php?module=Administration&action=configureBankDetails"); 
	}
?>
