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

//By : Rathina Ganesh
//Date: 29th Jan 2017
//Group nominees who are having same mobile or e-mail into single contact

require_once('include/entryPoint.php');
ini_set('display_errors', 1);
global $db,$sugar_config;
$url = $sugar_config['site_url'];
$url = $url."/service/v4_1/rest.php";
$username = "admin";
$password = "asci@1956";
$portal_url_api = 'http://161.202.21.7/asci/portal/public/portalweb';
$portal_url = 'http://161.202.21.7/asci/portal/public';
//function to make cURL request
function call($method, $parameters, $url)
{
    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
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

    return $response;
}


function apiCallToPortal($data=array(),$url)
{
    // ob_start();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    // receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);
    $response = json_decode($server_output);
    // print_r($response);exit();
    // ob_end_flush();
    
    return $response;
}

//login --------------------------------------------- 
$login_parameters = array(
     "user_auth" => array(
          "user_name" => $username,
          "password" => md5($password),
          "version" => "1"
     ),
     "application_name" => "RestTest",
     "name_value_list" => array(),
);

$login_result = call("login", $login_parameters, $url);


//get session id
$session_id = $login_result->id;


function randomPassword($length, $characters) {
 
// $length - the length of the generated password
// $characters - types of characters to be used in the password
 
// define variables used within the function    
    $symbols = array();
    $password = '';
    $used_symbols = '';
    $pass = '';
 
// an array of different character types    
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
 
    $characters = split(",",$characters); // get characters types to be used for the passsword
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $password .= $used_symbols[$n]; // add the character to the password string
        }
    
    return $password; // return the generated password
}
 

$sql = "SELECT nc.*, n.*,b2.email_address FROM contacts n join contacts_cstm nc on nc.id_c = n.id JOIN ( SELECT eabr.bean_id,ea.email_address FROM email_addr_bean_rel eabr JOIN email_addresses ea ON ( ea.id = eabr.email_address_id )) as b2 ON b2.bean_id = n.id where n.id NOT IN (select scrm_partner_contacts_contacts_1contacts_idb from  scrm_partner_contacts_contacts_1_c cn where cn.deleted =0) and n.deleted = 0";

$result = $db->query($sql);
 
while($row = $db->fetchByAssoc($result)){

    $nid = $row['id'];
    $mobile = (empty($row['phone_mobile']))? $row['phone_work'] : $row['phone_mobile'];
    $email = $row['email_address'];
    $salutation = $row['salutation'];
    $first_name = $row['first_name'];
    $birthdate = $row['birthdate'];
    $last_name = $row['last_name'];
    // $status = $row['nomination_status_c'];
    $primary_address_street = $row['primary_address_street'];
    $primary_address_country = $row['primary_address_country'];
    $primary_address_state = $row['primary_address_state'];
    $primary_address_city = $row['primary_address_city'];

    $primary_address_postalcode = $row['primary_address_postalcode'];
    $assigned_user_id = $row['assigned_user_id'];

    $rand_id = create_guid();
    $contactsql = "SELECT c.id as id FROM scrm_partner_contacts c inner join scrm_partner_contacts_cstm cstm on cstm.id_c = c.id left join email_addr_bean_rel eb on c.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where ((c.phone_mobile = '$mobile' and c.phone_mobile !='') or (e.email_address = '$email' and e.email_address !='') or (c.first_name = '$first_name' and c.last_name = '$last_name' and cstm.birthdate_c = '$birthdate')) and c.deleted = 0";


    $contactresult = $db->query($contactsql);
    
    $contactrow = $db->fetchByAssoc($contactresult);
    $cid = $contactrow['id'];
    $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));
    if (empty($cid)) {
      $set_entry_parameters = array(
           "session" => $session_id,
           "module_name" => "scrm_Partner_Contacts",
           "name_value_list" => array(
                array("name" => "salutation", "value" => $salutation),
                array("name" => "first_name", "value" => $first_name),
                array("name" => "last_name", "value" => $last_name),
                array("name" => "phone_mobile", "value" => $mobile),
                // array("name" => "status_c", "value" => $status),
                array("name" => "email1", "value" => $email),
                array("name" => "birthdate_c", "value" => $birthdate),
                array("name" => "primary_address_street", "value" => $primary_address_street),
                array("name" => "primary_address_city", "value" => $primary_address_city),
                array("name" => "primary_address_state", "value" => $primary_address_state),
                array("name" => "primary_address_country", "value" => $primary_address_country),
                array("name" => "primary_address_postalcode", "value" => $primary_address_postalcode),
                array("name" => "assigned_user_id", "value" => $assigned_user_id),
           ),
      );

      // echo "<pre>";
      // print_r($set_entry_parameters);exit();

      $set_entry_result = call("set_entry", $set_entry_parameters, $url);
      $record_id =$set_entry_result->id;
      
     
      $contactnomineerelatequery = "INSERT INTO scrm_partner_contacts_contacts_1_c(id, date_modified, deleted, scrm_partner_contacts_contacts_1scrm_partner_contacts_ida, scrm_partner_contacts_contacts_1contacts_idb) VALUES ('$rand_id','$date','0','$record_id','$nid')";
      // print_r($contactnomineerelatequery);exit();
       

      if ($set_entry_result) {
        $data = array();
        if ($email) {
          $data['email'] = $email;
          $data['name'] = $last_name;
          $data['crm_id'] = $record_id;
          $data['dept'] = 2;
        }

        $rsp = apiCallToPortal($data,$portal_url_api.'/create_user');
        print_r($rsp);       
        if ($rsp) {

          if ($rsp->Success) {
              
              if (count($rsp->data)>0) {
                      
                      $set_entry_parameters = array(
                           "session" => $session_id,
                           "module_name" => "scrm_Partner_Contacts",
                           "name_value_list" => array(
                                array(
                                    "name" => "id",
                                    "value" => $record_id
                                ),
                                array("name" => "portal_reset_password_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
                           ),
                      );
                      $set_entry_result = call("set_entry", $set_entry_parameters, $url);                    
                      print_r($set_entry_result);
                  
              }
          }
        
        }

      }
      
    }else{
        $contactnomineerelatequery = "INSERT INTO scrm_partner_contacts_contacts_1_c(id, date_modified, deleted, scrm_partner_contacts_contacts_1scrm_partner_contacts_ida, scrm_partner_contacts_contacts_1contacts_idb) VALUES ('$rand_id','$date','0','$cid','$nid')";
    }
    $db->query($contactnomineerelatequery);
    
   
    // print_r(error_get_last());
	
}
