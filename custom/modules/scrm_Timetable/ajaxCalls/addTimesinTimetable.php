<?php
     if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    // if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    // print_r(error_get_last());exit();
    global $sugar_config;

    $url = $sugar_config['site_url']."/service/v4_1/rest.php";
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

    //login -------------------------------------------- 
    $login_parameters = array(
         "user_auth" => array(
              "user_name" => $sugar_config['crmuser'],
              "password" => md5($sugar_config['crmpass']),
              "version" => "1"
         ),
         "application_name" => "RestTest",
         "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters, $url);

    // $timeRange = $_POST['']
    //get session id
    $session_id = $login_result->id;

    $get_entry_parameters = array(
         //session id
         'session' => $session_id,

         //The name of the module from which to retrieve records
         'module_name' => "scrm_Timetable",

         //The ID of the record to retrieve.
         'id' =>  $_POST['timetable_time_id'],
    );
    
    $get_entry_result = call("get_entry", $get_entry_parameters, $url);
    $timeRange = $get_entry_result->entry_list[0]->name_value_list->time_range_c->value;

    if ($timeRange == '') {
        $timeRange = array();
    }else{
        $timeRange = json_decode(html_entity_decode($timeRange),true);
       
    }

    $json = array();
    $json['start_time'] = $_POST['session_time_from'];
    $json['end_time'] = $_POST['session_time_to_c'];
    $timeRange[] = $json;
    $timeRange = json_encode($timeRange); 
    //create contacts ------------------------------------ 
    $set_entry_parameters = array(
         //session id
         "session" => $session_id,

         //The name of the module from which to retrieve records.
         "module_name" => "scrm_Timetable",

         //Record attributes
         "name_value_list" => array(
             
                //to update a record, you will nee to pass in a record id as commented below
                array("name" => "id", "value" => $_POST['timetable_time_id']),
                array("name" => "time_range_c", "value" => $timeRange),
             
         ),
    );

    $set_entry_result = call("set_entry", $set_entry_parameters, $url);

    function pr($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        exit();
    }
?>