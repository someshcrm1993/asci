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
//Date: 11th July 2017
//Group nominees who are having same mobile or e-mail into single contact
require_once('include/entryPoint.php');

global $db,$sugar_config;

$url = $sugar_config['site_url'];
$url = $url."/service/v4_1/rest.php";
$username = "admin";
$password = "simplecrm2015";

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
 

$sql = "SELECT * FROM contacts n join contacts_cstm nc on nc.id_c = n.id where n.id NOT IN (select scrm_partner_contacts_contacts_1contacts_idb from scrm_partner_contacts_contacts_1_c cn where cn.deleted =0) and n.deleted = 0 and (nc.email_o1_c <> '' or nc.email_r1_c <> '')";
$result = $db->query($sql);
while($row = $db->fetchByAssoc($result)){
    $nid = $row['id'];
    $mobile = (empty($row['phone_mobile']))? $row['phone_work'] : $row['phone_mobile'];
    $email = (empty($row['email_r1_c']))? $row['email_o1_c'] : $row['email_r1_c'];
    $salutation = $row['salutation'];
    $first_name = $row['first_name'];
    $birthdate = $row['dob'];
    $last_name = $row['last_name'];
    $primary_address_street = $row['address_line_r1_c'];
    $primary_address_street .= " ".$row['address_line_r2_c'];
    $primary_address_street .= " ".$row['address_line_r3_c'];
    $primary_address_country = $row['country3_c'];
    $primary_address_state = $row['state_r3_c'];
    $primary_address_city = $row['city3_c'];
    if(isset($primary_address_city)){
        $primary_address_city = explode("_", $primary_address_city);
        $primary_address_city = $primary_address_city[2];
    }
    if(isset($primary_address_state)){
        $primary_address_state = explode("_", $primary_address_state);
        $primary_address_state = $primary_address_state[1];
    }

    $primary_address_postalcode = $row['pin3_c'];
    $assigned_user_id = $row['assigned_user_id'];
    $username_c = (empty($email_r1_c))? $first_name : $email_r1_c;
    $password_c = randomPassword(6,"lower_case,upper_case,numbers");
    $rand_id = create_guid();

  $contactsql = "SELECT c.id as id FROM contacts c left join email_addr_bean_rel eb on c.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where ((c.phone_mobile = '$mobile_r1_c' and c.phone_mobile !='') or (e.email_address = '$email_r1_c' and e.email_address !='') or (c.first_name = '$first_name' and c.last_name = '$last_name' and c.birthdate = '$birthdate')) and c.deleted = 0";
  $contactresult = $db->query($contactsql);
  $contactrow = $db->fetchByAssoc($contactresult);
  $cid = $contactrow['id'];
    if(empty($cid)){
      $set_entry_parameters = array(
           "session" => $session_id,
           "module_name" => "Contacts",
           "name_value_list" => array(
                array("name" => "salutation", "value" => $salutation),
                array("name" => "first_name", "value" => $first_name),
                array("name" => "last_name", "value" => $last_name),
                  array("name" => "phone_mobile", "value" => $mobile_r1_c),
                array("name" => "status_c", "value" => '1'),
                  array("name" => "email1", "value" => $email_r1_c),
                  array("name" => "birthdate", "value" => $birthdate),
                  array("name" => "username_c", "value" => $username_c),
                  array("name" => "password_c", "value" => $password_c),
                  array("name" => "primary_address_street", "value" => $primary_address_street),
                  array("name" => "primary_address_city", "value" => $primary_address_city),
                  array("name" => "primary_address_state", "value" => $primary_address_state),
                  array("name" => "primary_address_country", "value" => $primary_address_country),
                array("name" => "primary_address_postalcode", "value" => $primary_address_postalcode),
                array("name" => "assigned_user_id", "value" => $assigned_user_id),
           ),
      );
      // echo "<pre>";
      // print_r($set_entry_parameters);
      $set_entry_result = call("set_entry", $set_entry_parameters, $url);
      $record_id =$set_entry_result->id;
      $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));
      $contactnomineerelatequery = "INSERT INTO contacts_nomi_nominations_1_c(id, date_modified, deleted, contacts_nomi_nominations_1contacts_ida, contacts_nomi_nominations_1nomi_nominations_idb) VALUES ('$rand_id','$date','0','$record_id','$nid')";
      $db->query($contactnomineerelatequery);   
  }else{
    $contactnomineerelatequery = "INSERT INTO contacts_nomi_nominations_1_c(id, date_modified, deleted, contacts_nomi_nominations_1contacts_ida, contacts_nomi_nominations_1nomi_nominations_idb) VALUES ('$rand_id','$date','0','$cid','$nid')";
      $db->query($contactnomineerelatequery); 
  }
  // echo "<br>";
}

// $sql = "SELECT l.id as lid,l.* FROM leads l left join leads_cstm lc on lc.id_c = l.id left join email_addr_bean_rel eb on l.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where  (l.contact_id = '' or l.contact_id IS NULL) and l.deleted = 0";
// $result = $db->query($sql);
// while($row = $db->fetchByAssoc($result)){
//     $lid = $row['lid'];
//     $phone_mobile = $row['phone_mobile'];
//     $email_address = $row['email_address'];
//     $first_name = $row['first_name'];
//     $last_name = $row['last_name'];

//     $contactsql = "SELECT c.id as id FROM contacts c left join email_addr_bean_rel eb on c.id = eb.bean_id left join email_addresses e on e.id = eb.email_address_id where ((c.phone_mobile = '$phone_mobile' and c.phone_mobile !='') or (e.email_address = '$email_address' and e.email_address !='') or (c.first_name = '$first_name' and c.last_name = '$last_name')) and c.deleted = 0";
//     $contactresult = $db->query($contactsql);
//     $contactrow = $db->fetchByAssoc($contactresult);
//     $cid = $contactrow['id'];
//     if(!empty($cid)){
//          echo "update leads set contact_id = '$cid' where leads.id = '$lid'";
//         // exit;
//         $db->query("update leads set contact_id = '$cid' where leads.id = '$lid'");
//     }
// }
