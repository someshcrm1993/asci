<?php
//By : Rathina Ganesh
//Date: 29th Jan 2017
//Group nominees who are having same mobile or e-mail into single contact

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
ini_set('display_errors', 1);
global $db,$sugar_config;
$url = $sugar_config['site_url'];
$url = $url."/service/v4_1/rest.php";
$username = "admin";
$password = "asci@1956";
$portal_url_api = 'http://161.202.21.7/asci/portal_uat/public/portalweb';
$portal_url = 'http://161.202.21.7/asci/portal_uat/public';

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

$sql = "SELECT nc.*, n.*,b2.email_address FROM accounts n join accounts_cstm nc on nc.id_c = n.id JOIN ( SELECT eabr.bean_id,ea.email_address FROM email_addr_bean_rel eabr JOIN email_addresses ea ON ( ea.id = eabr.email_address_id )) as b2 ON b2.bean_id = n.id where n.deleted = 0 and (nc.password_reset_link_c IS NULL or nc.password_reset_link_c = '')";
 
$result = $db->query($sql);


while($row = $db->fetchByAssoc($result)){
// print_r($row);
    $date = date('Y-m-d H:i:s', strtotime('-5 hours -30 minutes'));

    if ($row) {
      $data = array();
      if ($row['email_address']) {
        $data['email'] = $row['email_address'];
        $data['name'] = $row['name_of_sponsor_c'] != '' ? $row['name_of_sponsor_c'] : $row['name'];
        $data['crm_id'] = $row['id'];
        $data['dept'] = 3;
      }

      $rsp = apiCallToPortal($data,$portal_url_api.'/create_user');

       // ob_clean();
       // print_r($rsp);exit();
      if (isset($rsp->Success)) {

        if ($rsp->Success) {
            
            if (count($rsp->data)>0) {
                    
                $set_entry_parameters = array(
                     "session" => $session_id,
                     "module_name" => "Accounts",
                     "name_value_list" => array(
                          array(
                              "name" => "id",
                              "value" => $row['id']
                          ),
                          array("name" => "password_reset_link_c", "value" => $portal_url.'/password/reset/'.$rsp->data->token),
                     ),
                );
                $set_entry_result = call("set_entry", $set_entry_parameters, $url);                    
                print_r($set_entry_result);
                
            }
        }
      
      }

    }
}
