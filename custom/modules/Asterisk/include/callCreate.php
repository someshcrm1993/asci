<?php 
/**
 * Asterisk SugarCRM Integration 
 * (c) KINAMU Business Solutions AG 2009
 * 
 * Parts of this code are (c) 2006. RustyBrick, Inc.  http://www.rustybrick.com/
 * Parts of this code are (c) 2008 vertico software GmbH  
 * Parts of this code are (c) 2009 abcona e. K. Angelo Malaguarnera E-Mail admin@abcona.de
 * http://www.sugarforge.org/projects/yaai/
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact KINAMU Business Solutions AG at office@kinamu.com
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 */

//if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//require_once('include/utils.php');
//require_once('include/export_utils.php');

 //~ global $sugar_config;
 //~ global $locale;
global $current_user;

//~ // what are these for?? 
//~ chdir("../");
//~ chdir("../");
//~ chdir("../");
//~ chdir("../");

require_once('include/entryPoint.php');
//~ require_once ('log4php/LoggerManager.php');
//~ 
//~ $GLOBALS['log'] = LoggerManager::getLogger('SugarCRM');
//~ $GLOBALS['log']->fatal("TEST");

// get the Asterisk Detail from the Configuration
//~ $server = $sugar_config['asterisk_host'];
//~ $port = (int)$sugar_config['asterisk_port'];
//~ $Username = "Username: " . $sugar_config['asterisk_user'] . "\r\n";
//~ $Secret = "Secret: " . $sugar_config['asterisk_secret'] . "\r\n";
//~ $context = $sugar_config['asterisk_context'];

// start the Session ... get the User

// Edit: The snippet below was what was used on Sugar 6.1 instead of getting it from the $current_user object.
// WHEN used on 6.4.0 - I would get an out of memory error! See: 
//require_once('modules/Users/User.php');
//session_start(); 
//$cUser = new User();
//$cUser->retrieve($_SESSION['authenticated_user_id']);
//$extension 	= $cUser->asterisk_ext_c;

$agentNo = $current_user->asterisk_ext_c;
$agentName=$current_user->agent_name_c;
//printr($current_user);
//print $extension . "<BR><BR>";

// Take the user supplied pattern, we find the part with the #'s (which are the ext)... then we get something like 
// asterisk_dialout_channel == "SIP/###"   --> $matches[1] == SIP/, $matches[2] == "###", $matches[3] is "".
// asterisk_dialout_channel == "Local/###@sugarsip/n"   --> $matches[1] == Local/, $matches[2] == "###", $matches[3] is "@sugarsip/n".
//~ preg_match('/([^#]*)(#+)([^#]*)/',$sugar_config['asterisk_dialout_channel'],$matches);
//~ $channel = $matches[1] . $extension . $matches[3];
//~ 
//~ logLine("Creating Call, channel for originate command is: $channel\n");	
												//~ 
//~ $socket = fsockopen($server, $port, $errno, $errstr, 20);
	//~ 
	//~ if (!$socket) {
		//~ echo "errstr ($errno) <br>\n";
				//~ 
	//~ } else { 
	//~ // log on to Asterisk
	//~ fputs($socket, "Action: Login\r\n"); 
	//~ fputs($socket, $Username); 
	//~ fputs($socket, $Secret);
	//~ fputs($socket, "\r\n");	
	//~ $result = fgets($socket,128);
	//~ echo("Login Response: " . $result);
	//~ logLine("[CreateCall] Login Result: $result\n");
	//~ 
	//format Phone Number
	$number = $_GET['phoneNr'];
	//~ $prefix = $sugar_config['asterisk_prefix'];
	//~ $number = str_replace("+", "00", $number);
	//~ $number = str_replace(array("(", ")", " ", "-", "/", "."), "", $number);
	//$number = '0'.$number;
	
	
	//file_get_contents("http://kookoo.in/outbound/outbound.php?phone_no=$agentNo&api_key=KK936a1a13535618bd426883b3fe90f934&extra_data=<response><dial>$number</dial></response>");
	//file_get_contents("http://kookoo.in/outbound/outbound.php?phone_no=$agentNo&api_key=KK936a1a13535618bd426883b3fe90f934&url=http://54.254.208.151/MCNet/dev_new/dial.php?dial_to=$number");
	//file_get_contents("http://cloudagent.in/CAServices/PhoneManualDial.php?apiKey=KKa0b4d119d33389e81ee9c49657eb0cca&userName=bhea_tech&custNumber=$number&phoneName=$agentName&did=918067417503");

//Revert the below url for bhea account.
		// file_get_contents("http://cloudagent.in/CAServices/PhoneManualDial.php?apiKey=KKa0b4d119d33389e81ee9c49657eb0cca&userName=bhea_tech&custNumber=$number&phoneName=$agentName&did=918067417503");
//*Edited by Vivek
file_get_contents("http://cloudagent.in/CAServices/PhoneManualDial.php?apiKey=KK69e65119fc649a7c99babd12bf14f257&userName=simplecrm_demo&custNumber=$number&phoneName=$agentName&did=918033512287");

//~ file_get_contents("http://cloudagent.in/CAServices/PhoneManualDial.php?apiKey=KKa0b4d119d33389e81ee9c49657eb0cca&userName=bhea_tech&custNumber=$number&phoneName=$agentName&did=918067417503");
//*	
		// file_get_contents("http://api1.cloudagent.in/CAServices/PhoneManualDial.php?apiKey=KK16ac14c15562cc77ee8cf1acee03cb37&userName=logistiks&custNumber=$number&phoneName=$agentName&did=914030160442");


	// file_get_contents("http://cloudagent.in/CAServices/AgentManualDial.php?api_key=KK16ac14c15562cc77ee8cf1acee03cb37&username=logistiks&agentID=$agentName&campaignName=inbound_914030160442&customerNumber=$number&uui=");
	
	//~ echo "Originate Params: Number: $number, Channel: $channel, Context: $context, Exten: $number...\n";
	//~ 
	//~ 
	//~ 
	//~ // dial number
	//~ fputs($socket, "Action: originate\r\n");		
	//~ fputs($socket, "Channel: ". $channel ."\r\n");	
	//~ fputs($socket, "Context: ". $context ."\r\n");		
	//~ fputs($socket, "Exten: " . $number . "\r\n");		
	//~ fputs($socket, "Priority: 1\r\n");		
	//~ fputs($socket, "Callerid:" . $_REQUEST['phoneNr'] ."\r\n");	
	//~ fputs($socket, "Variable: CALLERID(number)=" . $extension . "\r\n");
	//~ fputs($socket, "Action: Logoff\r\n\r\n");
	//~ fputs($socket, "\r\n");	
	//~ 
	//~ $result = fgets($socket,128);
	//~ echo("Originate/Logout Response: " . $result);
	//~ 
        //~ /*("Action: Monitor\r\nChannel: $channel\r\n"
                               //~ ."File: $filename\r\nFormat: $format\r\n"
                               //~ ."Mix: $mix\r\n\r\n");/*
         //~ * 
         //~ */
        //~ 
        //~ // log on to Asterisk
	//~ fputs($socket, "Action: Login\r\n"); 
	//~ fputs($socket, $Username); 
	//~ fputs($socket, $Secret);
	//~ fputs($socket, "\r\n");	
	//~ $result = fgets($socket,128);
	//~ echo("Login Response: " . $result);
	//~ logLine("[CreateCall] Login Result: $result\n");
        //~ 
        //~ $filename = 'test1';
        //~ $format = 'gsm';
        //~ $mix = 1;
        //~ $response = fputs($socket, "Action: Monitor\r\nChannel: $channel\r\n"
                               //~ ."File: $filename\r\nFormat: $format\r\n"
                               //~ ."Mix: $mix\r\n\r\n");
        //~ if (strpos($response, "Success") === false) {
            //~ echo "[Call Monitor] Fail. Result was : $response\n";
        //~ } else {
            //~ // return true;
        //~ }
        //~ fputs($socket, "Action: Logoff\r\n\r\n");
	//~ fputs($socket, "\r\n");	
	//~ 
	//~ $result = fgets($socket,128);
        //~ echo("Monitor/Logout Response: " . $result);
	//~ //var_dump($result);
	//~ //var_dump($channel);
	//~ //var_dump($context);
	//~ //var_dump($number);
	//~ sleep(1);
	//~ 
	//~ // close socket
	//~ fclose($socket);
	//~ 
	//~ }
        
/* Test Popup for Outbound calls
 * 
 */
        
//~ $responseArray = array();
//~ if(count($response) == 0){
	//~ print json_encode(array("."));
//~ }else{
	//~ foreach($response as $item){
	//~ 
		//~ ob_start();
		//~ require("custom/modules/Asterisk/include/ShowCall.html");
		//~ $item['html'] = ob_get_contents();
		//~ $item['html'] = str_replace("\n", "", $item['html']);
		//~ $item['html'] = str_replace("\t", "", $item['html']);
		//~ $item['html'] = str_replace("\r", "", $item['html']);
		//~ ob_clean();
		//~ 
//~ /*
        //~ if( $sugar_config['asterisk_gravatar_integration_enabled'] ) {
		    //~ if( !empty($gravEmailAddress) ) {
			    //~ $gravHash = md5( strtolower( trim( $gravEmailAddress ) ) );
		    	//~ $item['html'] .= '<img src="http://www.gravatar.com/avatar/'. $gravHash . '?s=160">';
		    //~ }
		    //~ $item['html'] .= '<a onclick="if ( DCMenu.menu ) DCMenu.menu(\'Contacts\',\'Create Contact\', true); return false;" href="#">Create Contact</a><BR>';
		    //~ $item['html'] .= '<a href="index.php?module=Contacts&action=EditView&phone_work=' . $phoneToFind .'">Number2</a>';
        //~ }
//~ */
		//~ $responseArray[] = $item;
	//~ }
	//~ print json_encode($responseArray);
	//~ ob_flush();
//~ }



/**
 * Another var_dump() alternative, for debugging use.
 *
 * @param mixed $data Data to be dumped on screen.
 * @param boolean $exit Whether to terminate script after dump.
 */
//~ function printr($data, $exit = TRUE) {
  //~ if ($data) {
    //~ print '<pre>';
    //~ print_r($data);
    //~ print '</pre>';
  //~ }
  //~ //if ($exit) {
  //~ //  exit;
 //~ // }
 //~ }
 //~ 
 //~ function logLine($str)
//~ {
   //~ // print($str); 
	//~ 
	//~ // if logging is enabled.
	//~ if( !empty($sugar_config['asterisk_log_file']) ) 
	//~ {
		//~ $myFile = $sugar_config['asterisk_log_file']; // Might be a performance issue being here... 
		//~ $fh = fopen($myFile, 'a') or die("can't open file");
		//~ fwrite($fh, $str);
		//~ fclose($fh);
	//~ }
//~ }
?>
