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
class DeletingData
{
	public function getDeleteData(){
		global $db, $sugar_config;
		$current_date = date("Y-m-d");
		$query_accounts = "SELECT id FROM accounts where date(date_entered) = '$current_date'";
		$result_accounts = $db->query($query_accounts);
		while($row_accounts = $db->fetchByAssoc($result_accounts))
		{
			$account_id = $row_accounts['id'];
			$query_update = "DELETE FROM accounts where id='$account_id'";
			$result_update = $db->query($query_update);
		}
		$query_contacts = "SELECT id FROM contacts where date(date_entered)= '$current_date'";
		$result_contacts = $db->query($query_contacts);
		while($row_contacts = $db->fetchByAssoc($result_contacts))
		{
			$contact_id = $row_contacts['id'];
			$query_contacts_update = "DELETE FROM contacts where id = '$contact_id'";
			$result_contacts_update = $db->query($query_contacts_update);
		}
		$query_opportunities = "SELECT id FROM opportunities where date(date_entered)= '$current_date'";
		$result_opportunities = $db->query($query_opportunities);
		while($row_opportunities = $db->fetchByAssoc($result_opportunities))
		{
			$opp_id = $row_opportunities['id'];
			$query_opp_update = "DELETE FROM opportunities where id = '$opp_id'";
			$result_opp_update = $db->query($query_opp_update);
		}
		$query_leads = "SELECT id FROM leads where date(date_entered)= '$current_date'";
		$result_lead = $db->query($query_lead);
		while($row_lead = $db->fetchByAssoc($result_lead))
		{
			$lead_id = $row_lead['id'];
			$query_lead_update = "DELETE FROM leads where id = '$lead_id'";
			$result_lead_update = $db->query($query_lead_update);
		}
		$query_quotes = "SELECT id FROM aos_quotes where date(date_entered)= '$current_date'";
		$result_quotes = $db->query($query_quotes);
		while($row_quotes = $db->fetchByAssoc($result_quotes))
		{
			$quote_id = $row_quote['id'];
			$query_quote_update = "DELETE FROM aos_quotes where id = '$quote_id'";
			$result_quote_update = $db->query($query_quote_update);
		}
		$query_invoices = "SELECT id FROM aos_invoices where date(date_entered)= '$current_date'";
		$result_invoices = $db->query($query_invoices);
		while($row_invoices = $db->fetchByAssoc($result_invoices))
		{
			$invoice_id = $row_invoice['id'];
			$query_invoice_update = "DELETE FROM aos_invoices where id = '$invoice_id'";
			$result_invoice_update = $db->query($query_invoice_update);
		}
		$query_contracts = "SELECT id FROM aos_contracts where date(date_entered)= '$current_date'";
		$result_contracts = $db->query($query_contracts);
		while($row_contracts = $db->fetchByAssoc($result_contracts))
		{
			$contract_id = $row_contract['id'];
			$query_contract_update = "DELETE FROM aos_contracts where id = '$contract_id'";
			$result_contract_update = $db->query($query_contract_update);
		}
		$query_events = "SELECT id FROM fp_events where date(date_entered)= '$current_date'";
		$result_events = $db->query($query_events);
		while($row_events = $db->fetchByAssoc($result_events))
		{
			$event_id = $row_events['id'];
			$query_event_update = "DELETE FROM fp_events where id = '$event_id'";
			$result_event_update = $db->query($query_event_update);
		}
		$query_products = "SELECT id FROM aos_products where date(date_entered)= '$current_date'";
		$result_products = $db->query($query_products);
		while($row_products = $db->fetchByAssoc($result_products))
		{
			$product_id = $row_products['id'];
			$query_product_update = "DELETE FROM aos_products where id = '$product_id'";
			$result_product_update = $db->query($query_product_update);
		}
		$query_pr_category = "SELECT id FROM aos_product_categories where date(date_entered)= '$current_date'";
		$result_pr_category = $db->query($query_pr_category);
		while($row_pr_category = $db->fetchByAssoc($result_pr_category))
		{
			$pr_category_id = $row_pr_category['id'];
			$query_pr_category_update = "DELETE FROM aos_product_categories where id = '$pr_category_id'";
			$result_pr_category_update = $db->query($query_pr_category_update);
		}
		$query_cases= "SELECT id FROM cases where date(date_entered)= '$current_date'";
		$result_cases = $db->query($query_cases);
		while($row_cases = $db->fetchByAssoc($result_cases))
		{
			$case_id = $row_cases['id'];
			$query_cases_update = "DELETE FROM cases where id = '$case_id'";
			$result_cases_update = $db->query($query_cases_update);
		}
		$query_bugs= "SELECT id FROM bugs where date(date_entered)= '$current_date'";
		$result_bugs = $db->query($query_bugs);
		while($row_bugs = $db->fetchByAssoc($result_bugs))
		{
			$bug_id = $row_bugs['id'];
			$query_bug_update = "DELETE FROM bugs where id = '$bug_id'";
			$result_bug_update = $db->query($query_bug_update);
		}
		$query_documents= "SELECT id FROM documents where date(date_entered)= '$current_date'";
		$result_documents = $db->query($query_documents);
		while($row_documents = $db->fetchByAssoc($result_documents))
		{
			$document_id = $row_documents['id'];
			$query_document_update = "DELETE FROM documents where id = '$document_id'";
			$result_document_update = $db->query($query_document_update);
		}
		$query_calls= "SELECT id FROM calls where date(date_entered)= '$current_date'";
		$result_calls = $db->query($query_calls);
		while($row_calls = $db->fetchByAssoc($result_calls))
		{
			$call_id = $row_calls['id'];
			$query_calls_update = "DELETE FROM calls where id = '$call_id'";
			$result_calls_update = $db->query($query_calls_update);
		}
		$query_meetings= "SELECT id FROM meetings where date(date_entered)= '$current_date'";
		$result_meetings = $db->query($query_meetings);
		while($row_meetings = $db->fetchByAssoc($result_meetings))
		{
			$meeting_id = $row_meetings['id'];
			$query_meetings_update = "DELETE FROM meetings where id = '$meeting_id'";
			$result_meetings_update = $db->query($query_meetings_update);
		}
		$query_tasks= "SELECT id FROM tasks where date(date_entered)= '$current_date'";
		$result_tasks = $db->query($query_task);
		while($row_tasks = $db->fetchByAssoc($result_tasks))
		{
			$task_id = $row_task['id'];
			$query_task_update = "DELETE FROM tasks where id = '$task_id'";
			$result_task_update = $db->query($query_task_update);
		}
		$query_notes= "SELECT id FROM notes where date(date_entered)= '$current_date'";
		$result_notes = $db->query($query_notes);
		while($row_notes = $db->fetchByAssoc($result_notes))
		{
			$note_id = $row_notes['id'];
			$query_note_update = "DELETE FROM notes where id = '$note_id'";
			$result_note_update = $db->query($query_note_update);
		}
		$query_scrm_Partners= "SELECT id FROM scrm_Partners where date(date_entered)= '$current_date'";
		$result_scrm_Partners = $db->query($query_scrm_Partners);
		while($row_scrm_Partners = $db->fetchByAssoc($result_scrm_Partners))
		{
			$partner_id = $row_scrm_Partners['id'];
			$query_partner_update = "DELETE FROMscrm_Partners where id = '$partner_id'";
			$result_partner_update = $db->query($query_partner_update);
		}
		
		$query_workflow= "SELECT id FROM aow_workflow where date(date_entered)= '$current_date'";
		$result_workflow = $db->query($query_workflow);
		while($row_workflow = $db->fetchByAssoc($result_workflow))
		{
			$workflow_id = $row_workflow['id'];
			$query_workflow_update = "DELETE FROM aow_workflow where id = '$workflow_id'";
			$result_workflow_update = $db->query($query_workflow_update);
		}
		$query_reports= "SELECT id FROM aor_reports where date(date_entered)= '$current_date'";
		$result_reports= $db->query($query_reports);
		while($row_reports = $db->fetchByAssoc($result_reports))
		{
			$report_id = $row_report['id'];
			$query_report_update = "DELETE FROM aow_reports where id = '$report_id'";
			$result_report_update = $db->query($query_report_update);
		}
		$query_kb_category= "SELECT id FROM aok_knowledge_base_categories where date(date_entered)= '$current_date'";
		$result_kb_category = $db->query($query_kb_category);
		while($row_kb_category = $db->fetchByAssoc($result_kb_category))
		{
			$kb_category_id = $row_kb_category['id'];
			$query_category_update = "DELETE FROM aok_knowledge_base_categories where id = '$kb_category_id'";
			$result_category_update = $db->query($query_category_update);
		}
		$query_kb= "SELECT id FROM aok_knowledgebase where date(date_entered)= '$current_date'";
		$result_kb = $db->query($query_kb);
		while($row_kb = $db->fetchByAssoc($result_kb_category))
		{
			$kb_id = $row_kb['id'];
			$query_kb_update = "DELETE FROM aok_knowledgebase where id = '$kb_id'";
			$result_kb_update = $db->query($query_kb_update);
		}
	return true;	
	}
}
$sales = new DeletingData();
$sales->getDeleteData();
