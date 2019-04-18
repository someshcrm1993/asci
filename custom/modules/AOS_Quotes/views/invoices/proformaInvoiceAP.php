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
	 
	header("Content-Disposition: attachment;Filename=proformaInvoiceAP.doc");    

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
	    font-size:10.0pt;
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
	.floatLeft{
		float: left;
	}
	.floatRight{
		/*float: right;*/
		margin-left: 100px;
	}
</style>
	<div class="Section1">
    	<div class="MsoNormal">
    		<table cellspacing="0" cellpadding="7">
    			<tbody>
    				<tr valign="top">
    					<td width="161" height="70">
    						<p class="western" align="justify">
    							<img src="<?php echo $sugar_config['site_url']; ?>custom/modules/AOS_Quotes/proform_doc_logo.png" width="163" height="78" name="Picture 1" align="bottom" border="0" hspace="1">
    						</p>
						
    					</td>
						<td width="520" align="center" style="font-family: Arial, serif;">
							<div style="padding-top: 20px!important;">
								<span align="center" style="color: #404040;">
								<em><strong style="color: #404040;">ADMINISTRATIVE STAFF COLLEGE OF INDIA</strong>
								</em>
								</span>
								<br>
								<span style="font-size: 14px;">
								Bella Vista, Hyderabad - 500 082, Telangana (India)<br>Phones: 0091-40-66534247, Fax: 0091-40- 66534356 / 23324365 / 23312954<br>E-mail: <strong>poffice@asci.org.in</strong>, URL: http://www.asci.org.in
								</span>								
							</div>

						</td>
    				</tr>
    			</tbody>
    		</table>
    		<br>

    		<div><?php echo $userBean->name; ?><br>Programs Officer</div>
    		<div align="right">Date: <?php echo date('d-M-Y'); ?></div>
    		<br>
    		<div>
	    		<table cellspacing="0" cellpadding="0" border="0" height ="50cm">
	    			<tbody>
	    				<tr>
	    					<td>1.</td>
	    					<td>Name of the Participants</td>
	    					<td><?php echo implode(', <br>', $participants); ?></td>
	    				</tr>
	    				<tr>
	    					<td>2.</td>
	    					<td>No. of participants</td>
	    					<td><?php echo $proformaInvoiceBean->no_of_participants_c; ?></td>
	    				</tr>    				
	    				<tr>
	    					<td>3.</td>
	    					<td>Program Code</td>
	    					<td></td>
	    				</tr>    
	    				<tr>
	    					<td>4.</td>
	    					<td>Title of the Program</td>
	    					<td><?php echo $proformaInvoiceBean->name; ?></td>
	    				</tr>
	    				<tr>
	    					<td>5.</td>
	    					<td>Fee </td>
	    					<td><?php echo $proformaInvoiceBean->programme_fee_c; ?></td>
	    				</tr>    	
	    				<tr>
	    					<td></td>
	    					<td align="right" width="300">Service Tax @ (“Applicable rate”) </td>
	    					<td><?php echo $proformaInvoiceBean->tax_amount; ?></td>
	    				</tr>    				    			
	    				<tr>
	    					<td></td>
	    					<td align="right">Total </td>
	    					<td><?php echo $proformaInvoiceBean->total_amt; ?></td>
	    				</tr>    	
	    				<tr>
	    					<td>6</td>
	    					<td>Sponsor Organization</td>
	    					<td><?php echo $proformaInvoiceBean->billing_account; ?></td>
	    				</tr>
	    				<tr>
	    					<td>7</td>
	    					<td>Kind Attention</td>
	    					<td><?php echo $proformaInvoiceBean->kind_attention_c; ?></td>
	    				</tr>        
	    				<tr>
	    					<td><strong>8</strong></td>
	    					<td><strong>PAN NO: AAATA2442A</strong></td>
	    					<td><strong>SERVICE TAX REGD NO: AAATA2442AST001</strong></td>
	    				</tr>        				    				
	    			</tbody>
	    		</table>
	    	</div>
    		<p>
    			We will be grateful if you could send the payment to the undersigned, favoring “ADMINISTRATIVE<br>STAFF COLLEGE OF INDIA “ payable at Hyderabad or alternatively you could remit th'e payment by Direct Transfer to our Bank account as detailed below, at the earliest under intimation to us. 
    		</p>
    		<div align="center">
    			<table>
    				<tbody>
    					<tr>
    						<td colspan="2">BANK PARTICULARS</td>
    					</tr>
    					<tr>
    						<td>Bank Name</td>
    						<td>State Bank of Hyderabad</td>
    					</tr>
    					<tr>
    						<td>Address line 1</td>
    						<td>6-3-1092, Ist floor, A Block</td>
    					</tr>
    					<tr>
    						<td>Address line 2</td>
    						<td>Raj Bhavan Road Branch, (Bellavista)</td>
    					</tr>
    					<tr>
    						<td>Address line 3</td>
    						<td>Hyderabad – 500 082</td>
    					</tr>
    					<tr>
    						<td>Beneficiary Account Name</td>
    						<td>Administrative Staff College of India</td>
    					</tr>
    					<tr>
    						<td>Bank Account Number</td>
    						<td>62090698675</td>
    					</tr>
    					<tr>
    						<td>Bank MICR No</td>
    						<td>500004008</td>
    					</tr>
    					<tr>
    						<td>NEFT IFSC Code</td>
    						<td>SBHY0020063</td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    		<p align="center">
    			*Please Note: It is mandatory to mention our Program Code and your Organization Name while<br>remitting the fee through Bank Transfer / Wire Transfer.
    		</p>
    		<br><?php echo $userBean->name; ?>

		</div>
 	</div>
</body>
</html>
<?php exit; ?>
