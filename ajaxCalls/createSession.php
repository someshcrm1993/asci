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


    $url = "http://161.202.21.7/asci/dev/service/v4_1/rest.php";
    $username = "admin";
    $password = "password";

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
              "user_name" => 'admin',
              "password" => md5('simplecrm2015'),
              "version" => "1"
         ),
         "application_name" => "RestTest",
         "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters, $url);
  
	//get session id
    $session_id = $login_result->id;

    //create account ------------------------------------- 
    $set_entry_parameters = array(
         //session id
         "session" => $session_id,

         //The name of the module from which to retrieve records.
         "module_name" => "scrm_Session_Information",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              array("name" => "start_time_c", "value" => $_REQUEST['session_time_from']),
              array("name" => "faculty_name_c", "value" => $_REQUEST['faculty_name_c']),
              array("name" => "name", "value" => $_REQUEST['session_name']),
              array("name" => "end_time_c", "value" => $_REQUEST['session_time_to_c']),
              array("name" => "day_c", "value" => $_REQUEST['day_c']),
         ),
    );

    $set_entry_result = call("set_entry", $set_entry_parameters, $url);

	$set_relationship_parameters = array(
	    //session id
	    'session' => $session_id,

	    //The name of the module.
	    'module_name' => 'scrm_Session_Information',

	    //The ID of the specified module bean.
	    'module_id' => $set_entry_result->id,

	    //The relationship name of the linked field from which to relate records.
	    'link_field_name' => 'scrm_timetable_scrm_session_information_1',

	    //The list of record ids to relate
	    'related_ids' => array(
	        $_REQUEST['timetable_id'],
	    ),

	    //Sets the value for relationship based fields
	    'name_value_list' => array(
	        array(
	            'name' => 'contact_role',
	            'value' => 'Other'
	        ),
	    ),

	    //Whether or not to delete the relationship. 0:create, 1:delete
	    'delete'=> 0,
	);
	$set_entry_result = call("set_relationship", $set_relationship_parameters, $url);
    print_r($set_entry_result);exit();
    if ($set_entry_result) {
    	echo true;
    }else{
    	echo false;
    }

	
?>  
