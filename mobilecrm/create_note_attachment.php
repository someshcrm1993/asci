<?php

    //$url = "http://{site_url}/service/v4_1/rest.php";
    $url      = "http://161.202.21.7/mobilecrmdemo/service/v4_1/rest.php";
    $username = "admin";
    $password = "simplecrm2015";

    //login ---------------------------------------------------- 
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

    /*    
    echo "<pre>";
    print_r($login_result);
    echo "</pre>";
    */


    //get session id
    $session_id = $login_result->id;

    //create note ----------------------------------------------- 
    $set_entry_parameters = array(
         //session id
         "session" => $session_id,

         //The name of the module
         "module_name" => "Notes",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              //array("name" => "id", "value" => "9b170af9-3080-e22b-fbc1-4fea74def88f"),
              array("name" => "name", "value" => "Example Note"),
              array("name" => "parent_type", "value" => "Leads"),
              //array("name" => "parent_name", "value" => "Nitheesh Rajeevan"),
              array("name" => "parent_id", "value" => "85811019-9a83-3a4e-0177-586f85a5cff4"),
              array("name" => "description", "value" => "Test Attachment for Lead"),
         ),
    );

    $set_entry_result = call("set_entry", $set_entry_parameters, $url);

    /*    
    echo "<pre>";
    print_r($set_entry_result);
    echo "</pre>";
    */

    $note_id = $set_entry_result->id;

    $file_name      = "Yami-Gautam-Sweet";
    $file_extension = "jpg";
    $directory_path = "uploads/";

    //create note attachment -------------------------------------- 
    //$contents = file_get_contents ("/path/to/example_document.txt");
    $contents = file_get_contents ($directory_path.$file_name.".".$file_extension);

    /*  
    print_r($contents);
    print_r(base64_encode($contents));
    print_r(base64_decode(base64_encode($contents)));
    */

    $set_note_attachment_parameters = array(
        //session id
        "session" => $session_id,

        //The attachment details
        "note" => array(
            //The ID of the note containing the attachment.
            'id' => $note_id,

             //The name of the attachment
            'filename' => $file_name.'.'.$file_extension,

            //The binary contents of the file.
            'file' => base64_encode($contents),
        ),
    );

    $set_note_attachment_result = call("set_note_attachment", $set_note_attachment_parameters, $url);

    echo "<pre>";
    print_r($set_note_attachment_result);
    echo "</pre>";


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

?>