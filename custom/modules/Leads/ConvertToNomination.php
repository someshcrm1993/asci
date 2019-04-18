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


// ini_set('display_errors','On');
require_once('modules/Leads/Lead.php');

class ConvertNomination
{
	function ConvertNomination()
	{
		global $db,$sugar_config;
		$id=$_REQUEST['record'];
		$focus=new Lead();
		
		$focus->retrieve($id);
		$salutation = $focus->salutation;
		$first_name = $focus->first_name;
		$last_name = $focus->last_name;
		$name = $first_name." ".$last_name;
		$organization = $focus->accounts_leads_1_name;
		$organizationid = $focus->accounts_leads_1accounts_ida;
		$programme_type_c = $focus->programme_type_c;
		$project_leads_1_name = $focus->project_leads_1_name;
		$project_leads_1project_ida = $focus->project_leads_1project_ida;
		$organization_type = $focus->organisation_type_c;
		$primary_address_street = $focus->primary_address_street;
		$primary_address_city = $focus->primary_address_city;
		$primary_address_state = $focus->primary_address_state;
		$primary_address_country = $focus->primary_address_country;
		$primary_address_postalcode = $focus->primary_address_postalcode;
		$phone = $focus->phone_work;
		$mobile = $focus->phone_mobile;
		$email_id = $focus->email1;
		$designation = $focus->title;
		
		echo $js=<<<EOF
			<form name="ConvertNomination" method="post" action="index.php">
			<input type="hidden" name="module" value="Contacts" />
			<input type="hidden" name="action" value="EditView" />
			<input type="hidden" name="return_module" value="Leads" />
			<input type="hidden" name="return_id" value="$id" />
			<input type="hidden" name="return_action" value="DetailView" />
			
			<input type="hidden" name="salutation" value="$salutation" />
			<input type="hidden" name="first_name" value="$first_name" />
 			<input type="hidden" name="last_name" value="$last_name" />
 			<input type="hidden" name="account_name" value="$organization" />
 			<input type="hidden" name="account_id" value="$organizationid" />
 			<input type="hidden" name="project_contacts_2_name" value="$project_leads_1_name" />
 			<input type="hidden" name="project_contacts_2project_ida" value="$project_leads_1project_ida" />
 			<input type="hidden" name="designation_c" value="$designation" />
 			<input type="hidden" name="primary_address_street" value="$primary_address_street" />
 			<input type="hidden" name="primary_address_city" value="$primary_address_city" />
 			<input type="hidden" name="primary_address_state" value="$primary_address_state" />
 			<input type="hidden" name="primary_address_country" value="$primary_address_country" />
 			<input type="hidden" name="primary_address_postalcode" value="$primary_address_postalcode" />
 			<input type="hidden" name="phone_work" value="$phone" />
 			<input type="hidden" name="phone_mobile" value="$mobile" />
 			<input type="hidden" name="email1" value="$email_id" />
 			</form>
			<script type="text/javascript" language="javascript">
			document.ConvertNomination.submit();
			
			</script>
EOF;
	}
}
$app = new ConvertNomination();
?>
