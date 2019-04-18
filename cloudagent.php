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
 
require_once('include/utils.php');
require_once('include/entryPoint.php');
global $db;
global $current_user;
$GLOBALS['log']->fatal("hello");
$scriptRoot = dirname(__FILE__);
$sugarRoot  = $scriptRoot.'/';
echo $sugarRoot;
$GLOBALS['log']->fatal("SugarRoot is".$sugarRoot );
//require_once($sugarRoot . "/include/nusoap/nusoap.php");
echo 'hai';
class SugarSoap
{
	public $sessionid;
	public $auth_array;
	public $endpoint;

	function __construct($endpoint, $something, $auth_array)
	{
		$this->auth_array = $auth_array;
		$this->endpoint = $endpoint;
		$this->login();
	}

	function login()
	{
		$login_result = $this->call('login', $this->auth_array);
		//echo "login ........ ".$login_result['id'];
		//print_r($login_result);
		$this->sessionid = $login_result->id;
		//echo "session id = ".$login_result->id;
		if( $this->sessionid == -1 ) {
			logLine("! REST login failed!\n");
			print_r($login_result);
		}
		return ($login_result);
	}
	function call($method, $parameters)
	{
 		//echo "REST CALL ".$method." ";
 		//print_r($parameters);
 		//echo "\n";
		ob_start();
		$curl_request = curl_init();
		 
		curl_setopt($curl_request, CURLOPT_URL, $this->endpoint);
		curl_setopt($curl_request, CURLOPT_POST, 1);
		curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($curl_request, CURLOPT_HEADER, 1);
		curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);
		 
		$jsonEncodedData = json_encode($parameters);
		 
		$post = array(
				"method" => $method,
				"input_type" => "JSON",
				"response_type" => "JSON",
				"rest_data" => $jsonEncodedData
		);
		 
		curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($curl_request);
		curl_close($curl_request);
		 
		$result = explode("\r\n\r\n", $result, 2);
		$response = json_decode($result[1]);
		ob_end_flush();
		 
 		//echo "return:\n";
 		//print_r($response);
 		//echo "\n";
		return $response;
	}
}
	
require_once($sugarRoot . 'config.php');
include_once($sugarRoot . 'config_override.php');

$sql_connection = mysql_connect($sugar_config['dbconfig']['db_host_name'], $sugar_config['dbconfig']['db_user_name'], $sugar_config['dbconfig']['db_password']);
$sql_db         = mysql_select_db($sugar_config['dbconfig']['db_name']);
// Prune asterisk_log
// Note only use this for development
//mysql_query('DELETE FROM asterisk_log');
//~ $sugarSoapEndpoint   = 'http://customerdemo1.simplecrmdemo.com' . "/service/v4/rest.php";//"/soap.php";
//~ $sugarSoapEndpoint   = 'http://internaldemo.simplecrmdemo.com' . "/service/v4/rest.php";//"/soap.php";

 //~ http://internaldemo.simplecrmdemo.com/
// Get SOAP config
//$sugarSoapEndpoint   = $sugar_config['site_url'] . "/soap.php";//"/soap.php";
//$sugarSoapEndpoint   = $sugar_config['site_url'] . "/service/v4/rest.php";//"/soap.php";
$sugarSoapEndpoint   = 'http://internaldemo.simplecrmdemo.com' . "/service/v4/rest.php";//"/soap.php";
//$sugarSoapEndpoint   = $sugarRoot . "service/v4/rest.php";//"/soap.php";
$sugarSoapUser       = $sugar_config['asterisk_soapuser'];
$sugarSoapCredential = md5($sugar_config['asterisk_soappass']);
    
// Here we check if LDAP Authentication is used, if so we must build credential differently
$q = mysql_query('select value from config where category=\'system\' and name=\'ldap_enabled\'');
$r = mysql_fetch_assoc($q);


//
// And finally open a SOAP connection to SugarCRM
//
//logLine("! Trying SOAP login endpoint=[$sugarSoapEndpoint] user=[$sugarSoapUser] password=[$sugarSoapCredential]\n");
$auth_array = array(
				'user_auth' => array(
						'user_name' => $sugarSoapUser,
						'password' => $sugarSoapCredential
				)
		);
		$soapClient = new SugarSoap($sugarSoapEndpoint, true, $auth_array); // This method logs in also
		$soapSessionId = $soapClient->sessionid;
		$userGUID      = $soapClient->call('get_user_id', array(
				$soapSessionId
		));

if( empty($userGUID) || empty($soapSessionId) || $userGUID == -1 ) {
	echo "! FATAL: REST login failed, something didnt get set by login... check your site_url:" . $soapSessionId . " user=" . $auth_array['user_auth']['user_name'] . " GUID=" . $userGUID . "\n";
   //logLine( "! FATAL: SOAP login failed, something didnt get set by login... check your site_url:" . $soapSessionId . " user=" . $auth_array['user_auth']['user_name'] . " GUID=" . $userGUID . "\n");
    die();
}
else {
    //logLine( "! Successful SOAP login id=" . $soapSessionId . " user=" . $auth_array['user_auth']['user_name'] . " GUID=" . $userGUID . "\n");
echo "! Successful REST login id=" . $soapSessionId . " user=" . $auth_array['user_auth']['user_name'] . " GUID=" . $userGUID . "\n";
 }
 
 
////~ 
// NEW CALL EVENT PARAMETERS
 $callerid=$_REQUEST['phno'];
 $ucid=$_REQUEST['ucid'];
 //$GLOBALS['log']->fatal("UCID BEFORE".$ucid);
 $type=$_REQUEST['type'];
 //$GLOBALS['log']->fatal("type is for outbound testing".$type);
 //$GLOBALS['log']->fatal("ucid".$ucid);


 //$GLOBALS['log']->fatal("truncate".$trun);
$did=$_REQUEST['did'];
$callerID=$_REQUEST['callerID'];
$skillName=$_REQUEST['skillName'];
$agentID=$_REQUEST['agentID'];
//$agentID=21255;
//$GLOBALS['log']->fatal("hello this is for testing the agent id".$agentID);
//$foragentid="SELECT agent_id_c FROM users_cstm WHERE agent_name_c='$agentID'";
$result =$db->query($foragentid);                                              
$row=$db->fetchByAssoc($result);
$foragentid1=$row['agent_id_c'];
//$GLOBALS['log']->fatal("for agent id".$foragentid1);


//$GLOBALS['log']->fatal("AGENT ID  IS".$agentID);
$compaignID=$_REQUEST['campaignId'];
$monitorUcid=$_REQUEST['monitorUcid'];

$uui=$_REQUEST['uui'];
$agentPhoneNumber=$_REQUEST['agentPhoneNumber'];
//$GLOBALS['log']->fatal("agent phone number is(new one) ".$agentPhoneNumber);
/*---------------------------------------*/
//$agentid=$current_user->agent_id_c;
//$query="SELECT asterisk_ext_c FROM users_cstm WHERE agent_id_c='$agentID' OR agent_name_c='$agentID'";
$query="SELECT agent_id_c FROM users_cstm WHERE asterisk_ext_c='$agentPhoneNumber'";
$result =$db->query($query);                                              
$row=$db->fetchByAssoc($result);
$callednumber=$row['agent_id_c'];
 if(!empty($callerid))
{
	$callerid=$_REQUEST['phno'];
$ucid=$_REQUEST['ucid'];
$GLOBALS['log']->fatal("phone number screen popup".$callerid);
//$GLOBALS['log']->fatal("ucid".$ucid);
 if($type=='manual'){
	 $type='outbound';
 
}
else if($type=='Progressive'){
	$ucid=$_REQUEST['ucid'];
	
	}
else{
	$ucid=substr($ucid, 0, -1);
 $GLOBALS['log']->fatal("UCID AFTER (sourceid)".$ucid);
	}
	
$did=$_REQUEST['did'];
// $GLOBALS['log']->fatal("did for screenpopup ".$did);
$callerID=$_REQUEST['callerID'];
// $GLOBALS['log']->fatal("callerid for screenpopup ".$callerID);
$skillName=$_REQUEST['skillName'];
// $GLOBALS['log']->fatal("skillname for screenpopup ".$skillName);
$agentID=$_REQUEST['agentID'];
// $GLOBALS['log']->fatal("hello this is for testing the agent id".$agentID);
$compaignID=$_REQUEST['campaignId'];
// $GLOBALS['log']->fatal("campaign id  for screenpopup".$compaignID);
$monitorUcid=$_REQUEST['monitorUcid'];
// $GLOBALS['log']->fatal("monitorucid  for screenpopup".$monitorUcid);

$uui1=$_REQUEST['uui'];
$GLOBALS['log']->fatal("uui  for screenpopup".$uui1);	
	$agentPhoneNumber=$_REQUEST['agentPhoneNumber'];
$GLOBALS['log']->fatal("agent phone number is(new one) ".$agentPhoneNumber);	
	
	
$set_entry_params = array(
						'session' => $soapSessionId,
						'module_name' => 'Calls',
						'name_value_list' => array(
							array(
								'name' => 'name',
								'value' => 'Successfull Call'
							),
							array(
								'name' => 'status',
								'value' => 'In Limbo'
							),
							array(
								'name' => 'assigned_user_id',
								'value' => $userGUID
							)
						)
					);
					$soapResult = $soapClient->call('set_entry', $set_entry_params);
                                        print_r( $soapResult );
					
				//$callRecordId = $soapResult['id'];
				$callRecordId = $soapResult->id;	
	
	
	//Inserting the Values into the Database
	$numb= $_REQUEST['cid'];
	$callDirection=$type;
	$GLOBALS['log']->fatal("type is for outbound testing before".$type);
	if($type=='inbound' || $type=='INBOUND')
	//if($type=='inbound')
	{
		$type='I';
	}
	//else if($type=='outbound' || $type='OUTBOUND' || $type='manual')
	else
	{
		$type='O';
	}
	$GLOBALS['log']->fatal("type is for outbound testing again".$type);
	$event='NewCall';
	$date = date('Y-m-d H:i:s');
	$query= "INSERT INTO ozonetel(Sourceid,Callednumber,timestampCall,did,Callerid,Skill_Name,Agent_ID,Campaign_ID,direction,uui,Event,callstate,call_record_id)
	VALUES ('$monitorUcid','$agentPhoneNumber','$date','$did','$callerid','$skillName','$agentID','$compaignID','$type','$uui','$event','Dial','$callRecordId')";
	$db1=$db->query($query);
	 // Update CALL record with direction...
						//
						$set_entry_params = array(
							'session' => $soapSessionId,
							'module_name' => 'Calls',
							'name_value_list' => array(
								array(
									'name' => 'id',
									'value' => $callRecordId
								),
								array(
									'name' => 'direction',
									'value' => $callDirection
								)
							)
						);
						
						$soapResult = $soapClient->call('set_entry', $set_entry_params);
	
	
}
 
 if(!empty($_REQUEST['data']))
{
	
	$event='Hangup';
	$data1= htmlspecialchars_decode($_REQUEST['data']);
	$data2=json_decode($data1,true);
	$GLOBALS['log']->fatal("DATA".print_r($data2,true));
	$transferredto=$data2['TransferredTo'];
	$receivedagent=$data2['DialedNumber'];	
	//$fordailednumber="SELECT asterisk_ext_c FROM users_cstm WHERE agent_name_c='$receivedagent'";
	$result =$db->query($fordailednumber);                                              
	$row=$db->fetchByAssoc($result);
	$fordailednumber1=$row['asterisk_ext_c'];
	$GLOBALS['log']->fatal("RECEIVED AGENT ".$receivedagent);
	$transfertype=$data2['TransferType'];
	$agentstatus=$data2['AgentStatus'];
	$customerstatus=$data2['CustomerStatus'];
	$did=$data2['Did'];
	$duration=$data2['Duration'];
	$audiofile=$data2['AudioFile'];
	$hangupby=$data2['HangupBy'];
	$starttime=$data2['StartTime'];
	$agent_name=$data2['AgentName'];
	$phonename=$data2['PhoneName'];
	$apikey=$data2['Apikey'];
	$location=$data2['Location'];
	$monitorucid=$data2['monitorUCID'];
	$fallbackrule=$data2['FallBackRule'];
	$status=$data2['Status'];
	$uui=$data2['UUI'];
	$dailstatus=$data2['DialStatus'];
	$endtime=$data2['EndTime'];
	$timetoanswer=$data2['TimeToAnswer'];
	$query = "SELECT direction,contact_id FROM ozonetel WHERE Sourceid='$monitorucid' ";
    $result =$db->query($query);                                              
    $row=$db->fetchByAssoc($result);
	$direction=$row['direction'];
	$callerid=$data2['CallerID'];
	$data2=json_decode($data1,true);
$GLOBALS['log']->fatal(print_r($data2,true));
// $GLOBALS['log']->fatal("moniterucid for call back".$data2['monitorUCID']);
// $GLOBALS['log']->fatal("transferred to for call back".$data2['TransferredTo']);
// $GLOBALS['log']->fatal("dailed number for call back".$data2['DialedNumber']);
// $GLOBALS['log']->fatal("type for call back".$data2['Type']);
// $GLOBALS['log']->fatal("transfer type for call back".$data2['TransferType']);
// $GLOBALS['log']->fatal("skill for call back".$data2['Skill']);
// $GLOBALS['log']->fatal("Agent status for call back".$data2['AgentStatus']);

// $GLOBALS['log']->fatal("customerstatus for call back".$data2['CustomerStatus']);
// $GLOBALS['log']->fatal("callerid for call back".$data2['CallerID']);
// $GLOBALS['log']->fatal("did for call back".$data2['Did']);
// $GLOBALS['log']->fatal("sno for call back".$data2['SNO']);
// $GLOBALS['log']->fatal("duration for call back".$data2['Duration']);
// $GLOBALS['log']->fatal("audio file for call back".$data2['AudioFile']);

// $GLOBALS['log']->fatal("hangupby for call back".$data2['HangupBy']);
// $GLOBALS['log']->fatal("start time for call back".$data2['StartTime']);
// $GLOBALS['log']->fatal("agent name for call back".$data2['AgentName']);
// $GLOBALS['log']->fatal("comments for call back".$data2['Comments']);
// $GLOBALS['log']->fatal("phone name for call back".$data2['PhoneName']);
// $GLOBALS['log']->fatal("apikey for callback".$data2['Apikey']);

// $GLOBALS['log']->fatal("location for call back".$data2['Location']);
// $GLOBALS['log']->fatal("agentuniqueid for callback".$data2['AgentUniqueID']);
// $GLOBALS['log']->fatal("disposition for call back".$data2['Disposition']);
// $GLOBALS['log']->fatal("moniter ucid for call back".$data2['monitorUCID']);
// $GLOBALS['log']->fatal("fall back rule for call back".$data2['FallBackRule']);
// $GLOBALS['log']->fatal("agentid for call back".$data2['AgentID']);

// $GLOBALS['log']->fatal("status for call back url".$data2['Status']);
// $GLOBALS['log']->fatal("uui for call back".$data2['UUI']);
// $GLOBALS['log']->fatal("dialstatus for call back".$data2['DialStatus']);
// $GLOBALS['log']->fatal("endtime for callback ".$data2['EndTime']);
// $GLOBALS['log']->fatal("timetoanswer for call back ".$data2['TimeToAnswer']);
// $GLOBALS['log']->fatal("dispositionset for call back".$data2['dispositionSet']);

	if ($direction == "I")
	{ 
		$callDirection = "Inbound";

    }
    else
    {
		$callDirection = "Outbound";
	}
		
		 if($callDirection == "Inbound") 
	{
		
		$callRecord = findCallByAsteriskDestId($monitorucid);
		$GLOBALS['log']->fatal("ARRAY DETAILS".print_r($callRecord,true));
		
		if ($callRecord)
 
                 {
					 
					 $GLOBALS['log']->fatal("Hai");
						$query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$receivedagent', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer',uistate='' WHERE Sourceid='$monitorucid'";
						$updateResult=$db->query($query);	
						//~ if(!empty($fordailednumber1)){
						//~ $query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$fordailednumber1', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer' WHERE Sourceid='$monitorucid'";
						//~ $updateResult=$db->query($query);
					//~ }else{
						//~ $query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$dailednumber', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer' WHERE Sourceid='$monitorucid'";
						//~ $updateResult=$db->query($query);
						//~ }
						$updateResult=$db->query($query);					 
						// if($updateResult)
						// {
						// 	 $assignedUser = $userGUID; 
						// 	 /* MECHANISM TO FIND ASTERISK EXTENSION  $asteriskExt*/
						// 	 //$asteriskExt=$dailednumber;
						// 	  $maybeAssignedUser = findUserByCloudAgentId($receivedagent);

      //                       if ($maybeAssignedUser)

      //                       {

      //                           $assignedUser = $maybeAssignedUser;
						// 		$GLOBALS['log']->fatal("CURRENT USER IS	".$assignedUser);
      //                           //echo "! Assigned user id set to $assignedUser\n";

      //                       }
					 
						// }
						 $qry = "select id from users join users_cstm on users.id = users_cstm.id_c where users_cstm.asterisk_ext_c='$receivedagent' ";
						$result = $db->query($qry);
						$row = $db->fetchByAssoc($result);
						$assignedUser = $row['id'];
						$qry = "select contact_id,call_record_id FROM ozonetel WHERE Sourceid = '$monitorucid' ";
						$result = $db->query($qry);
						$row = $db->fetchByAssoc($result);
						$parentID = $row['contact_id'];
						$call_record_id = $row['call_record_id'];
						$parentType="Contacts";
											// Calculate call duration...                        
                        $queryforcontact="INSERT INTO calls_contacts (call_id,contact_id,id) VALUES ('$call_record_id','$parentID','$call_record_id')";
                        $result =$db->query($queryforcontact);
                       $query = "SELECT timestampCall,duration,recording,contact_id FROM ozonetel WHERE Sourceid = '$monitorucid' ";
                        $result =$db->query($query);                                 
                         
                        $t=$db->fetchByAssoc($result);  
                        $startTime=strtotime($t['timestampCall']);                                            
                        $callDuration=$t['duration'];
                        $callDuration = strtotime("1970-01-01 $callDuration UTC");                         
                        $recording=$t['recording'];			
                        $callDurationSeconds=$callDuration%60;		
						$callDurationMinutes = (int)($callDuration / 60);
						$callDurationHours   = (int)($callDurationMinutes / 60);       
						$callStart= $startTime;
						$GLOBALS['log']->fatal("Call Duration".$callDuration);						
						$GLOBALS['log']->fatal("Call Recording".$recording);
						$GLOBALS['log']->fatal("Call Start Time".$callStart);
						
						$startdate = date('Y-m-d H:i:s',$startTime-19800);

                       

                        $callStatus = NULL;
                        $callName = NULL;
                        $callDescription = "";
                        if ($callDuration> 5)
                        {

                            $callStatus = "Held";
                            $callName = "Successfull call";
                        }
                        else
                          {

                            $callStatus = "Missed";
                            $callName = "Failed call ";
                            $callDescription  = "Missed/failed call\n";
                            $callDescription .= "------------------\n";
                            //$callDescription .= sprintf(" %-20s : %-40s\n", "Caller ID", $rawData['callerID']); 
                        }		
											
				///////////////////////////////////////// Establish Relationships with the Call and Contact/Account///////////////////////////////////
       //                          $beanID = NULL;
       //                          $beanType = NULL;
       //                          $parentID        = NULL;
       //                          $parentType      = NULL;
							
							// if( !empty($row['contact_id']) ){

							// 		$parentID=$row['contact_id'];
							// 		$parentType="Contacts";

							// 		$GLOBALS['log']->fatal("Contact Id already set by callListener to: " . $row['contact_id']);
       //                              //echo"Contact Id already set by callListener to: " . $contact['contact_id'] . "\n";
       //                              $beanID = $row['contact_id'];
       //                              $beanType = "Contacts";
       //                              //~ $contact_id = $row['contact_id'];
       //                              //~ $GLOBALS['log']->fatal("inside not empty of contact");
       //                          $GLOBALS['log']->fatal("call linking for inbound");
       //                          $contactid=$row['contact_id'];
       //                          $callrecordid=$callRecord['sweet']['id'];
       //                              $queryforcontact="INSERT INTO calls_contacts (call_id,contact_id,id) VALUES ('$callrecordid','$contactid','$callrecordid')";
       //                              $result =$db->query($queryforcontact);
       //   //                            $queryforaccount="select account_id from accounts_contacts where contact_id='$contactid' and deleted='0'";
       //   //                            $result =$db->query($queryforaccount);                                        
							// 		// $t=$db->fetchByAssoc($result);  
							// 		// $accountid=$t['account_id'];
							// 		// if(!empty($accountid)){
							// 		// $GLOBALS['log']->fatal("Hello account id found");	
							// 		// $parentID=$accountid;
							// 		// $parentType="Accounts";
							// 	// }
								
       //                          }
                                
                                  								$date=$t['timestampCall'];
								$date = new DateTime($date, new DateTimeZone('Asia/Calcutta'));
    $startDate=$date->format('Y-m-d\TH:i:sP') . "\n";
   setRelationshipBetweenCallAndBean($callRecord['sweet']['id'],$beanType,$beanID);
   
								$soapResult = $soapClient->call('set_entry', array(
									'session' => $soapSessionId,
									'module_name' => 'Calls',
									'name_value_list' => array(
										array(
											'name' => 'id',
											'value' => $callRecord['sweet']['id']
										),
										array(
											'name' => 'name',
											'value' => $callName
										),
										
										array(
											'name' => 'duration_hours',
											'value' =>$callDurationHours
										),
										array(
											'name' => 'duration_minutes',
											'value' => $callDurationMinutes
										),
										//~ 
										//~ array(
											//~ 'name' => 'duration_seconds',
											//~ 'value' => $callDuration
										//~ ),
										array(
											'name' => 'status',
											'value' => $callStatus
										),
										array(
					 						'name' => 'description',
											'value' => $callDescription
										),
										array(
											'name' => 'asterisk_caller_id_c',
											'value' => $callerid
										),
										array(
											'name' => 'date_start',
											'value' => $startdate
										),
										array(
											'name' => 'parent_type',
											'value' => $parentType 
										),
										array(
											'name' => 'parent_id',
											'value' => $parentID
										),
										array(
											'name' => 'assigned_user_id',
											'value' => $assignedUser
										),
										
										array(
											'name' => 'recording_c',
											'value' => $recording
										),
								
										array(
											'name' => 'duration_seconds_c', 
											'value' =>$callDurationSeconds
										),
									
										
										
										
										
									)
								));
					 
					 
					 
					 
				}
		
			}
			else//OUTBOUND	
			{
				$callRecord = findCallByAsteriskDestId($monitorucid);
		$GLOBALS['log']->fatal("ARRAY DETAILS".print_r($callRecord,true));
		
		if ($callRecord)
 
                 {
					 
					 $GLOBALS['log']->fatal("Hai");
						$query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$receivedagent', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer',uistate='' WHERE Sourceid='$monitorucid'";
						$updateResult=$db->query($query);	
						//~ if(!empty($fordailednumber1)){
						//~ $query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$fordailednumber1', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer' WHERE Sourceid='$monitorucid'";
						//~ $updateResult=$db->query($query);
					//~ }else{
						//~ $query = "UPDATE ozonetel SET Event='Hangup',callstate='Hangup',Transferred_to='$transferredto',Callednumber='$dailednumber', Transfer_Type='$transfertype',Agent_Status='$agentstatus' ,Customer_Status='$customerstatus',duration='$duration',recording='$audiofile',HangUpBy='$hangupby',timestampcall='$starttime',Agent_Name='$agent_name',Phone_Name='$phonename',API_Key='$apikey',Location='$location' ,FallBackRule='$fallbackrule',status='$status',timestampHangup='$endtime',Dail_Status='$dailstatus',TimeToAnswer='$timetoanswer' WHERE Sourceid='$monitorucid'";
						//~ $updateResult=$db->query($query);
						//~ }
						// $updateResult=$db->query($query);					 
						// if($updateResult)
						// {
						// 	 $assignedUser = $userGUID; 
						// 	 /* MECHANISM TO FIND ASTERISK EXTENSION  $asteriskExt*/
						// 	 //$asteriskExt=$dailednumber;
						// 	  $maybeAssignedUser = findUserByCloudAgentId($receivedagent);

      //                       if ($maybeAssignedUser)

      //                       {

      //                           $assignedUser = $maybeAssignedUser;
						// 		$GLOBALS['log']->fatal("CURRENT USER IS	".$assignedUser);
      //                           //echo "! Assigned user id set to $assignedUser\n";

      //                       }
					 
						// }
						
						// Calculate call duration...                        
                        $qry = "select id from users join users_cstm on users.id = users_cstm.id_c where users_cstm.asterisk_ext_c='$receivedagent' ";
						$result = $db->query($qry);
						$row = $db->fetchByAssoc($result);
						$assignedUser = $row['id'];
						$qry = "select contact_id,call_record_id FROM ozonetel WHERE Sourceid = '$monitorucid' ";
						$result = $db->query($qry);
						$row = $db->fetchByAssoc($result);
						$parentID = $row['contact_id'];
						$call_record_id = $row['call_record_id'];
						$parentType="Contacts";
                        $queryforcontact="INSERT INTO calls_contacts (call_id,contact_id,id) VALUES ('$call_record_id','$parentID','$call_record_id')";
                        $result =$db->query($queryforcontact);
						$GLOBALS['log']->fatal("New assignedUser".$assignedUser);
                       $query = "SELECT timestampCall,duration,recording FROM ozonetel WHERE Sourceid = '$monitorucid' ";
                        $result =$db->query($query);                                 
                         
                        $t=$db->fetchByAssoc($result);  
                        $startTime=strtotime($t['timestampCall']);                                            
                        $callDuration=$t['duration'];
                        $callDuration = strtotime("1970-01-01 $callDuration UTC");                         
                        $recording=$t['recording'];	
                        $callDurationSeconds=$callDuration%60;				
						$callDurationMinutes = (int)($callDuration / 60);
						$callDurationHours   = (int)($callDurationMinutes / 60);       
						$callStart= $startTime;
						// $GLOBALS['log']->fatal("Call Duration".$callDuration);						
						// $GLOBALS['log']->fatal("Call Recording".$recording);
						// $GLOBALS['log']->fatal("Call Start Time".$callStart);
						
						$startdate = date('Y-m-d H:i:s',$startTime-19800);

                       

                        $callStatus = NULL;
                        $callName = NULL;
                        $callDescription = "";
                        if ($callDuration> 5)
                        {

                            $callStatus = "Held";
                            $callName = "Successfull call";
                        }
                        else
                          {

                            $callStatus = "Missed";
                            $callName = "Failed call ";
                            $callDescription  = "Missed/failed call\n";
                            $callDescription .= "------------------\n";
                            //$callDescription .= sprintf(" %-20s : %-40s\n", "Caller ID", $rawData['callerID']); 
                        }		
											
				///////////////////////////////////////// Establish Relationships with the Call and Contact/Account///////////////////////////////////
                              
							
							// if( !empty($t['contact_id']) ){
							// 		$GLOBALS['log']->fatal("Contact Id already set by callListener to: " . $row['contact_id']);
							// 		// $parentID=$row['contact_id'];
							// 		// $parentType="Contacts";
       //                              //echo"Contact Id already set by callListener to: " . $contact['contact_id'] . "\n";
       //                              $beanID = $row['contact_id'];
       //                              $beanType = "Contacts";
       //                              $contactid=$row['contact_id'];
       //                              $callrecordid=$callRecord['sweet']['id'];
       //                              $queryforcontact="INSERT INTO calls_contacts (call_id,contact_id,id) VALUES ('$callrecordid','$contactid','$callrecordid')";
       //                              $result_contact =$db->query($queryforcontact);
       //                              //~ $contact_id = $row['contact_id'];
       //                              //~ $GLOBALS['log']->fatal("inside not empty of contact");
                                
                                
                                
       //   //                            $queryforaccount="select account_id from accounts_contacts where contact_id='$contactid' and deleted='0'";
       //   //                            $result =$db->query($queryforaccount);                                        
							// 		// $t=$db->fetchByAssoc($result);  
							// 		// $accountid=$t['account_id'];
							// 		// if(!empty($accountid)){
							// 		// $GLOBALS['log']->fatal("Hello account id found");	
							// 		// $parentID=$accountid;
							// 		// $parentType="Accounts";
							// 	// }
								
       //                          }
                                
                                
                        
                                  								$date=$t['timestampCall'];
								$date = new DateTime($date, new DateTimeZone('Asia/Calcutta'));
    $startDate=$date->format('Y-m-d\TH:i:sP') . "\n";
    //setRelationshipBetweenCallAndBean($callRecord['sweet']['id'],$beanType,$beanID);
    //~ $soapResult = $soapClient->call('set_relationship', 
								//~ 'session' => $soapSessionId,
								//~ array(
									//~ 'module1' => 'Calls',
                //~ 'module1_id' => $callRecordId,
                //~ 'module2' => $beanType,
                //~ 'module2_id' => $beanId,
									//~ ));
		$GLOBALS['log']->fatal("New assignedUser".$parentID);

								$soapResult = $soapClient->call('set_entry', array(
									'session' => $soapSessionId,
									'module_name' => 'Calls',
									'name_value_list' => array(
										array(
											'name' => 'id',
											'value' => $callRecord['sweet']['id']
										),
										array(
											'name' => 'name',
											'value' => $callName
										),
										
										array(
											'name' => 'duration_hours',
											'value' =>$callDurationHours
										),
										array(
											'name' => 'duration_minutes',
											'value' => $callDurationMinutes
										),
										//~ 
										//~ array(
											//~ 'name' => 'duration_seconds',
											//~ 'value' => $callDuration
										//~ ),
										array(
											'name' => 'status',
											'value' => $callStatus
										),
										array(
					 						'name' => 'description',
											'value' => $callDescription
										),
										array(
											'name' => 'asterisk_caller_id_c',
											'value' => $callerid
										),
										array(
											'name' => 'date_start',
											'value' => $startdate
										),
										array(
											'name' => 'parent_type',
											'value' => $parentType
										),
										//~ array(
											//~ 'name' => 'contact_name',
											//~ 'value' => $beanID
										//~ ),
										//~ array(
											//~ 'name' => 'contact_id',
											//~ 'value' => $beanID 
										//~ ),
										//~ array(
											//~ 'name' => 'parent_type',
											//~ 'value' => 'Accounts' 
										//~ ),
										array(
											'name' => 'parent_id',
											'value' => $parentID
										),
										array(
											'name' => 'assigned_user_id',
											'value' => $assignedUser
										),
										
										array(
											'name' => 'recording_c',
											'value' => $recording
										),
										array(
											'name' => 'duration_seconds_c',
											'value' =>$callDurationSeconds
										),
										//~ array(
											//~ 'name' => 'contact_id',
											//~ 'value' => $contactid
										//~ ),
										//~ array(
											//~ 'name' => 'contact_name',
											//~ 'value' => $beanID
										//~ ),
								
									
									
										
										
										
										
									)
								));
					 
					 
					 
					 
				}
				
				
				
				
				
			}	
		
	
	
	
	
}
 
 //FUNCTIONS
 
  function setRelationshipBetweenCallAndBean($callRecordId,$beanType, $beanId) {
    global $soapSessionId, $soapClient,$verbose_logging;

    if( !empty($callRecordId) && !empty($beanId) && !empty($beanType)  ) {
        $soapArgs   = array(
            'session' => $soapSessionId,
            'set_relationship_value' => array(
                'module1' => 'Calls',
                'module1_id' => $callRecordId,
                'module2' => $beanType,
                'module2_id' => $beanId
            )
        );

       // logLine("# Establishing relation to $beanType... Call ID: $callRecordId to Bean ID: $beanId\n");
        if( $verbose_logging ) {
            var_dump($soapArgs);
        }
        $soapResult = $soapClient->call('set_relationship', $soapArgs);
        isSoapResultAnError($soapResult);
    }
    else {
       // logLine("! Invalid Arguments passed to setRelationshipBetweenCallAndBean");
    }
}
 function findSugarObjectByPhoneNumber($aPhoneNumber)

{

    	$GLOBALS['log']->fatal("inside find contact");
    global $soapClient, $soapSessionId;
    $regje = $aPhoneNumber;
  
	
	$soapArgs = array(

         //session id
         'session' => $soapSessionId,

         //The name of the module from which to retrieve records
         'module_name' => 'Contacts',

         //The SQL WHERE clause without the word "where".
         //'query' => "(bhea_applicant.phone_home LIKE '$searchPattern') OR (bhea_applicant.phone_mobile LIKE '$searchPattern') OR (bhea_applicant.phone_work LIKE '$searchPattern') OR (bhea_applicant.phone_other LIKE '$searchPattern') OR (bhea_applicant.phone_fax LIKE '$searchPattern')",
          'query' => "contacts.phone_home REGEXP '$regje' OR contacts.phone_mobile REGEXP '$regje' OR contacts.phone_work REGEXP '$regje' OR contacts.phone_other REGEXP '$regje' OR contacts.phone_fax REGEXP '$regje'",

         //The SQL ORDER BY clause without the phrase "order by".
         'order_by' => "",

         //The record offset from which to start.
         'offset' => '0',

         //Optional. A list of fields to include in the results.
         'select_fields' => array(
              'id',
         ),

         /*
         A list of link names and the fields to be returned for each link name.
         Example: 'link_name_to_fields_array' => array(array('name' => 'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
         */
         'link_name_to_fields_array' => array(
         ),

         //The maximum number of results to return.
         'max_results' => '5',

         //To exclude deleted records
         'deleted' => '0',

         //If only records marked as favorites should be returned.
         'Favorites' => false,
    );
	
    $soapResult = $soapClient->call('get_entry_list', $soapArgs);
    $GLOBALS['log']->fatal("SOAP RESULT".print_r( $soapResult,true));
    $bool=isSoapResultAnError($soapResult);
    $GLOBALS['log']->fatal("BOOL VALUE".$bool);
    
       if( !isSoapResultAnError($soapResult))
    {
		
    $GLOBALS['log']->fatal("before decoded");
        $resultDecoded = decode_name_value_list($soapResult->entry_list[0]->name_value_list);
$GLOBALS['log']->fatal("DECODED SOAP RESULT IS".print_r( $resultDecoded,true ));
   
        return array(
            'type' => 'Contacts',
            'values' => $resultDecoded
        );
        
    $GLOBALS['log']->fatal("printing");
    }
    else{
    // Oops nothing found :-(
    return FALSE;
}

        

    }
 function findSugarAccountByPhoneNumber($aPhoneNumber)
{
	$GLOBALS['log']->fatal("inside find account");
    global $soapClient, $soapSessionId;
    $searchPattern = $aPhoneNumber;
    $aPhoneNumber = preg_replace( '/\D/', '', $aPhoneNumber); // removes everything that isn't a digit.
    //~ if( preg_match('/([0-9]{7})$/',$aPhoneNumber,$matches) ){
		//~ $aPhoneNumber = $matches[1];
	//~ }
	$regje = preg_replace( '/(\d)/', '$1\[^\\d\]*',$aPhoneNumber);
	$regje = '(' . $regje . ')$';  
	
	$soapArgs = array(

         //session id
         'session' => $soapSessionId,

         //The name of the module from which to retrieve records
         'module_name' => 'Accounts',

         //The SQL WHERE clause without the word "where".
         //'query' => "(bhea_applicant.phone_home LIKE '$searchPattern') OR (bhea_applicant.phone_mobile LIKE '$searchPattern') OR (bhea_applicant.phone_work LIKE '$searchPattern') OR (bhea_applicant.phone_other LIKE '$searchPattern') OR (bhea_applicant.phone_fax LIKE '$searchPattern')",
          'query' => "accounts.phone_alternate REGEXP '$regje' OR accounts.phone_office REGEXP '$regje' OR accounts.phone_fax REGEXP '$regje'",

         //The SQL ORDER BY clause without the phrase "order by".
         'order_by' => "",

         //The record offset from which to start.
         'offset' => '0',

         //Optional. A list of fields to include in the results.
         'select_fields' => array(
              'id',
         ),

         /*
         A list of link names and the fields to be returned for each link name.
         Example: 'link_name_to_fields_array' => array(array('name' => 'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
         */
         'link_name_to_fields_array' => array(
         ),

         //The maximum number of results to return.
         'max_results' => '5',

         //To exclude deleted records
         'deleted' => '0',

         //If only records marked as favorites should be returned.
         'Favorites' => false,
    );
	
    $soapResult = $soapClient->call('get_entry_list', $soapArgs);
       if( !isSoapResultAnError($soapResult))
    {
		
    $GLOBALS['log']->fatal("before decoded");
        $resultDecoded = decode_name_value_list($soapResult->entry_list[0]->name_value_list);
$GLOBALS['log']->fatal("DECODED SOAP RESULT IS".print_r( $resultDecoded,true ));
   
        return array(
            'type' => 'Accounts',
            'values' => $resultDecoded
        );
        
    $GLOBALS['log']->fatal("printing");
    }
    else{
    // Oops nothing found :-(
    return FALSE;
}
}
 
 function findUserByCloudAgentId($agentid)
{
	global $db;
    //logLine("# +++ findUserByAsteriskExtension($aExtension)\n");
	$GLOBALS['log']->fatal("Extension from findUserByAsteriskExtension is  ".$agentid);
	$qry = "select id from users join users_cstm on users.id = users_cstm.id_c where users_cstm.agent_id_c='$agentid' ";
	$result = $db->query($qry);
	$GLOBALS['log']->fatal("Query result is  ".$qry);
	if( $result ) {
		$row = $db->fetchByAssoc($result);
		return $row['id'];
	}
	else
	{
	
	return FALSE;
	}
	
}
 
 function findCallByAsteriskDestId($asteriskDestId)
{   global $db;
    global $soapClient, $soapSessionId, $verbose_logging;
    //logLine("# +++ findCallByAsteriskDestId($asteriskDestId)\n");
    
    //
    // First, fetch row in asterisk_log...
    //
    $GLOBALS['log']->fatal("CALL SERIAL NUMBER FROM findCallByAsteriskDestId".$asteriskDestId);
    //~ $query        = "SELECT * from kookoo WHERE Sourceid='$asteriskDestId' and Event='NewCall'";
    //~ $result =$db->query($query); 
    	$query = "SELECT * FROM ozonetel WHERE Sourceid = '$asteriskDestId' and Event='NewCall' ";
    $result =$db->query($query);   
    if ($result === FALSE) {
        return FALSE;
    }
    
    while ($row =$db->fetchByAssoc($result)) {
        $callRecId = $row['call_record_id'];
        $GLOBALS['log']->fatal("CALL RECORD IS".$callRecId );
       // logLine("! FindCallByAsteriskDestId - Found entry in asterisk_log recordId=$callRecId\n");
        
        //
        // ... then locate Object in Calls module:
        //
        $soapResult    = $soapClient->call('get_entry', array(
            'session' => $soapSessionId,
            'module_name' => 'Calls',
            'id' => $callRecId
        ));
        $resultDecoded = decode_name_value_list($soapResult->entry_list[0]->name_value_list);
        
		// echo ("# ** Soap call successfull, dumping result ******************************\n");
        // var_dump($soapResult);
      
        // var_dump($row);
        // echo ("# ***********************************************************************\n");
        
        //
        // also store raw sql data in case we need it later...
        //
        return array(
            'bitter' => $row,
            'sweet' => $resultDecoded
        );
    }
   // logLine( "! Warning, FindCallByAsteriskDestId results set was empty!\n");
    return FALSE;
}
 
 
 function decode_name_value_list(&$nvl)
{
    $result = array();
    
    foreach ($nvl as $nvlEntry) {
        $key          = $nvlEntry->name;
        $val          = $nvlEntry->value;
        $result[$key] = $val;
    } 
    return $result;
}
 
 function isSoapResultAnError($soapResult) {
		$retVal = FALSE;
		if ( isset($soapResult->error->number) && $soapResult->error->number != 0) {
			//logLine("! ***Warning: SOAP error*** " . $soapResult->error->number . " " . $soapResult->error->string . "\n");
			$retVal = TRUE;
		}
		else if( !isset($soapResult->result_count) || $soapResult->result_count == 0 ) {
			//logLine("! No results returned\n");
			$retVal = TRUE;
		}
		return $retVal; 
	}
 
 
 
 
 
 
?>
