<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ini_set('display_errors','On');
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
		$prog_programmes_leads_1_name = $focus->prog_programmes_leads_1_name;
		$prog_programmes_leads_1prog_programmes_ida = $focus->prog_programmes_leads_1prog_programmes_ida;
		$organization_type = $focus->organization_type_c;
		$sector = $focus->sector_c;
		$address_line1 = $focus->address_line1_c;
		$address_line2 = $focus->address_line2_c;
		$address_line3 = $focus->address_line3_c;
		$country = $focus->country_c;
		$state = $focus->state_c;
		$city = $focus->city_c;
		$pin_code = $focus->pin_code_c;
		$phone = $focus->phone_work;
		$mobile = $focus->phone_mobile;
		$email_id = $focus->email1;
		// $email_id = $focus->email_id_c;
		$designation = $focus->department;
		
		$sql="SELECT address_line1_c,address_line2_c,address_line3_c,country_c,state_c,city_c,pin_c,mobile_c,email_c FROM `accounts_cstm` WHERE id_c='$organizationid'";
		$result = $db->query($sql);
		$row=$db->fetchByAssoc($result); 
	 
		$address1=$row['address_line1_c'];
		$address2=$row['address_line2_c'];	
		$address3=$row['address_line3_c'];
		$country1=$row['country_c'];	
		$state1=$row['state_c'];
		$city1=$row['city_c'];
		$pin1=$row['pin_c'];	
		$mobile1=$row['mobile_c'];
		$email1=$row['email_c'];
	
		$sql1="SELECT phone_office,phone_fax FROM `accounts` WHERE id='$organizationid' and deleted=0";
		$result1 = $db->query($sql1);
		$row1=$db->fetchByAssoc($result1); 
		$phone1=$row1['phone_office']; 
		$fax1=$row1['phone_fax'];
		
		echo $js=<<<EOF
			<form name="ConvertNomination" method="post" action="index.php">
			<input type="hidden" name="module" value="nomi_Nominations" />
			<input type="hidden" name="action" value="EditView" />
			<input type="hidden" name="return_module" value="Leads" />
			<input type="hidden" name="return_id" value="$id" />
			<input type="hidden" name="return_action" value="DetailView" />
			
			<input type="hidden" name="salutation" value="$salutation" />
			<input type="hidden" name="first_name" value="$first_name" />
 			<input type="hidden" name="last_name" value="$last_name" />
 			<input type="hidden" name="accounts_nomi_nominations_1_name" value="$organization" />
 			<input type="hidden" name="accounts_nomi_nominations_1accounts_ida" value="$organizationid" />
 			<input type="hidden" name="leads_nomi_nominations_2_name" value="$name" />
 			<input type="hidden" name="leads_nomi_nominations_2leads_ida" value="$id" />
 			<input type="hidden" name="prog_programmes_nomi_nominations_1_name" value="$prog_programmes_leads_1_name" />
 			<input type="hidden" name="prog_programmes_nomi_nominations_1prog_programmes_ida" value="$prog_programmes_leads_1prog_programmes_ida" />
 			<input type="hidden" name="type_of_orgranization" value="$organization_type" />
 			<input type="hidden" name="sector" value="$sector" />
 			<input type="hidden" name="address_line_r1_c" value="$address_line1" />
 			<input type="hidden" name="address_line_r2_c" value="$address_line2" />
 			<input type="hidden" name="address_line_r3_c" value="$address_line3" />
 			<input type="hidden" name="country3_c" value="$country" />
 			<input type="hidden" name="state_r3_c" value="$state" />
 			<input type="hidden" name="city3_c" value="$city" />
 			<input type="hidden" name="pin3_c" value="$pin_code" />
 			<input type="hidden" name="phone_r1_c" value="$phone" />
 			<input type="hidden" name="mobile_r1_c" value="$mobile" />
 			<input type="hidden" name="email_r1_c" value="$email_id" />
 			
 			<input type="hidden" name="address_line_o1_c" value="$address1" />
 			<input type="hidden" name="address_line_o2_c" value="$address2" />
 			<input type="hidden" name="address_line_o3_c" value="$address3" />
 			<input type="hidden" name="country1_c" value="$country1" />
 			<input type="hidden" name="state1_c" value="$state1" />
 			<input type="hidden" name="city1_c" value="$city1" />
 			<input type="hidden" name="pin1_c" value="$pin1" />
 			<input type="hidden" name="phone_o1_c" value="$phone1" />
 			<input type="hidden" name="mobile_o1_c" value="$mobile1" />
 			<input type="hidden" name="email_o1_c" value="$email1" />
 			<input type="hidden" name="fax_c" value="$fax1" />
 			<input type="hidden" name="designation" value="$designation" />
 			</form>
			<script type="text/javascript" language="javascript">
			document.ConvertNomination.submit();
			</script>
EOF;
	}
}
$app = new ConvertNomination();
?>
