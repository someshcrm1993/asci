<?php
if(!defined('sugarEntry')) define('sugarEntry',true);
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
	
	require_once('include/utils.php');
	require_once('include/entryPoint.php');
	global $db;
	$mobile=$_REQUEST['mobile'];
	$smstexts=$_REQUEST['smstext'];
	$smstext=str_replace(' ','%20',$smstexts);
	$GLOBALS['log']->fatal($smstext);
	$recordid=$_REQUEST['recordid'];
	$userid=$_REQUEST['userid'];
	$module=$_REQUEST['module'];
		$GLOBALS['log']->fatal($module);
	//~ $teamid=$_REQUEST['teamid'];
	//$GLOBALS['log']->fatal("team id from contacts module".$teamid);
	//~ $mobile='9901401459';
	//~ $smstext='test';
	// create a new cURL resource
//~ $ch = curl_init("http://login.tbulksms.com/API/WebSMS/Http/v1.0a/index.php?username=rfcrm&password=smscrm123&sender=RFHELP&to=$mobile&message=$smstext&reqid=1&format=text&route_id=21");
//~ 
//~ // set URL and other appropriate options
//~ curl_setopt($ch, CURLOPT_URL, "http://login.tbulksms.com/API/WebSMS/Http/v1.0a/index.php?username=rfcrm&password=smscrm123&sender=RFHELP&to=$mobile&message=$smstext&reqid=1&format=text&route_id=21");
//~ curl_setopt($ch, CURLOPT_HEADER, 0);
//~ curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//~ 
//~ // grab URL and pass it to the browser
//~ $output = curl_exec($ch);
//~ 
//~ // close cURL resource, and free up system resources
//~ curl_close($ch);
//~ $GLOBALS['log']->fatal($output);

//~ $mobile= '$mobile';
//~ $message = "New ticket has been registered for you,ticket number : 10.Our support team will get in touch with you for further follow-ups.";
//~ $Data = str_replace(' ', '+', $message);
$sms_service_url = "alerts.sinfini.com";
$sender ="scrmid";
$api_key="A21f5742a6e05ccfd60e60a3bf5983217";
$sms_response_format = "php";


$url="http://$sms_service_url/api/v3/index.php?method=sms&api_key=$api_key&to=$mobile&sender=$sender&message=$smstext&format=$sms_response_format&custom=1,2&flash=0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url); 
$response = curl_exec($ch);
curl_close($ch);
	//~ $response=file_get_contents("http://login.tbulksms.com/API/WebSMS/Http/v1.0a/index.php?username=rfcrm&password=smscrm123&sender=RFHELP&to=$mobile&message=$smstext&reqid=1&format=text&route_id=21");
	$GLOBALS['log']->fatal($response);
	date_default_timezone_set('UTC');
	$date= date('Y-m-d H:i:s');
	$recid=create_guid();
	$query = "INSERT INTO scrm_sms(id,name,date_entered,date_modified,modified_user_id,description,created_by,assigned_user_id) VALUES('$recid','$mobile','$date','$date','$date','$smstexts','$userid','$userid')";
	$result= $db->query($query);
	//$idrelation=create_guid();
	if($module == 'scrm_Partners'){
	$idrelation=create_guid();
	$query_relation="INSERT INTO scrm_sms_scrm_partners_c
(id,date_modified,scrm_sms_scrm_partnersscrm_partners_ida,scrm_sms_scrm_partnersscrm_sms_idb) VALUES ('$idrelation','$date','$recordid','$recid')";
	$result_relation=$db->query($query_relation);
}
else if($module == 'scrm_Partner_Contacts'){
	$idrelation=create_guid();
	$query_relation="INSERT INTO scrm_sms_scrm_partner_contacts_c
(id,date_modified,scrm_sms_scrm_partner_contactsscrm_partner_contacts_ida,scrm_sms_scrm_partner_contactsscrm_sms_idb) VALUES ('$idrelation','$date','$recordid','$recid')";
	$result_relation=$db->query($query_relation);
}
?>
