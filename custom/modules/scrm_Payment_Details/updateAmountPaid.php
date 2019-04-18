<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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

/**
* 
*/
class updateAmountPaid
{
	
	public function sumAmount($bean)
	{
        global $db;
        if($bean->aos_invoices_scrm_payment_details_1aos_invoices_ida){
        	$invoiceId = $_REQUEST['aos_invoices_scrm_payment_details_1aos_invoices_ida'];
			$query = "SELECT fees_c,tax_amount_c FROM scrm_payment_details p join scrm_payment_details_cstm pc on pc.id_c = p.id join aos_invoices_scrm_payment_details_1_c ap on ap.aos_invoices_scrm_payment_details_1scrm_payment_details_idb = p.id join aos_invoices i on i.id = ap.aos_invoices_scrm_payment_details_1aos_invoices_ida where p.deleted = 0 and ap.deleted = 0 and i.deleted = 0 and ap.aos_invoices_scrm_payment_details_1aos_invoices_ida = '$invoiceId'";
			$result = $db->query($query);
			$row = $db->fetchByAssoc($result);
			$amount = $row['fees_c'] + $row['tax_amount_c'];

			$invoice = new AOS_Invoices();
			$invoice->retrieve($invoiceId);
			$invoice->status = 'PartiallyPaid';	
			if($invoice->subtotal_amount == $amount){
				$invoice->status = 'Paid';	
			}
			$invoice->actual_payment_made_c = $amount;	
			$invoice->payment_mode_c = $bean->mode_of_payment_c;	
			$invoice->save();
        }
        
	}

	// public function sumAmountBeforeDelete($bean)
	// {
 //        global $db;
 //        $paymentID = $_REQUEST['record'];
	// 	echo $query = "SELECT aos_invoices_scrm_payment_details_1aos_invoices_ida FROM scrm_payment_details p join aos_invoices_scrm_payment_details_1_c ap on ap.aos_invoices_scrm_payment_details_1scrm_payment_details_idb = p.id where ap.aos_invoices_scrm_payment_details_1scrm_payment_details_idb = '$paymentID'";exit;
	// 	$result = $db->query($query);
	// 	$row = $db->fetchByAssoc($result);
	// 	$invoiceId = $row['aos_invoices_scrm_payment_details_1aos_invoices_ida'];

	// 	$query = "SELECT sum(fees_c) as TotalPaid FROM scrm_payment_details p join scrm_payment_details_cstm pc on pc.id_c = p.id join aos_invoices_scrm_payment_details_1_c ap on ap.aos_invoices_scrm_payment_details_1scrm_payment_details_idb = p.id join aos_invoices i on i.id = ap.aos_invoices_scrm_payment_details_1aos_invoices_ida where p.deleted = 0 and ap.deleted = 0 and i.deleted = 0 and ap.aos_invoices_scrm_payment_details_1aos_invoices_ida = '$invoiceId'";
	// 	$result = $db->query($query);
	// 	$row = $db->fetchByAssoc($result);
	// 	$amount = $row['TotalPaid'];

	// 	$invoice = new AOS_Invoices();
	// 	$invoice->retrieve($invoiceId);
	// 	$invoice->status = 'PartiallyPaid';	
	// 	if($invoice->subtotal_amount == $amount){
	// 		$invoice->status = 'Paid';	
	// 	}
	// 	$invoice->actual_payment_made_c = $amount;	
	// 	$invoice->payment_mode_c = $bean->mode_of_payment_c;	
	// 	$invoice->save();
	// }
}

?>
