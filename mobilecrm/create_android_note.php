    <?php

        $username                           = urldecode($_REQUEST["username"]);
        $password                           = urldecode($_REQUEST["password"]);
        $url                                = urldecode($_REQUEST["url"]);
        $module_name                        = urldecode($_REQUEST["module_name"]);
        $api_url                            = "$url/service/v4_1/rest.php";

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
        //$result = $parameters;
        return $response;
        }

        //login ---------------------------------------------
        $login_parameters = array(
            "user_auth" => array(
                "user_name" => $username,
                "password" => md5($password),
                "version" => "1"
            ),
            "application_name" => "MobileUserAuthentication",
            "name_value_list" => array(),
        );

        $loginResult = call("login", $login_parameters, $api_url);

        if (isset($loginResult->name) && $loginResult->name == 'Invalid Login') {
            $outputArrr = array();
            $outputArrr['android'] = $loginResult;
            //echo ( json_encode($outputArrr));
            print_r( json_encode($outputArrr));

        } 
        else {
            $file_content_size_mobile = urldecode($_REQUEST["file_content_size_mobile"]);
            $file_content           = urldecode($_REQUEST["file_content"]);
            $file_content_size_crm  = strlen($file_content);
            $file_name              = urldecode($_REQUEST["file_name"]);
            $fileMimeType           = urldecode($_REQUEST["fileMimeType"]);
            $file_extension         = urldecode($_REQUEST["fileExtension"]);

            $parent_type            = urldecode($_REQUEST["parent_type"]);
            $parent_id              = urldecode($_REQUEST["parent_id"]);
            $module_name            = urldecode($_REQUEST["module_name"]);
            $note_name              = "Example Note";
            $note_description       = "Test Attachment for Lead";

            //get session id
            $session_id = $loginResult->id;

            //create note ----------------------------------------------- 
            $set_entry_parameters = array(
                //session id
                "session" => $session_id,

                //The name of the module
                "module_name" => $module_name,

                //Record attributes
                "name_value_list" => array(
                    //to update a record, you will nee to pass in a record id as commented below
                    //array("name" => "id", "value" => "9b170af9-3080-e22b-fbc1-4fea74def88f"),
                    array("name" => "name", "value" => $note_name),
                    array("name" => "parent_type", "value" => $parent_type),
                    array("name" => "parent_id", "value" => $parent_id),
                    array('name' => 'file_mime_type','value' => $fileMimeType),
                    array('name' => 'filename','value' => "Yami-Gautam-Sweet.jpg"),
                    array("name" => "description", "value" => $note_description),
                ),
            );

            $set_entry_result = call("set_entry", $set_entry_parameters, $api_url);
            $note_id = $set_entry_result->id;

            //add attachment(s) for the note ----------------------------------------------- 
            //$file_name      = "Yami-Gautam-Sweet";
            //$file_extension = "jpg";
            $directory_path = "uploads/";

            //create note attachment -------------------------------------- 
            //$contents = file_get_contents ("/path/to/example_document.txt");
            //$contents = file_get_contents ($directory_path.$file_name.".".$file_extension);
            $contents = $file_content;

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

            $set_note_attachment_result = call("set_note_attachment", $set_note_attachment_parameters, $api_url);
            $note_attachment_id = $set_note_attachment_result->id;

            $res2 = array();
            $j=0; $result_count = count($set_entry_result);

            for ($f=0; $f< $result_count; $f++) { 
                //$res2[$f]['file_content']        = $file_content;
                $res2[$f]['parent_type']         = $parent_type;
                $res2[$f]['parent_id']           = $parent_id;
                $res2[$f]['module_name']         = $module_name;
                $res2[$f]['note_id']             = $note_id;
                $res2[$f]['note_attachment_id']  = $note_attachment_id;
                $res2[$f]['file_content_size_mobile']   = $file_content_size_mobile;
                $res2[$f]['file_content_size_crm']   = $file_content_size_crm;
            }

            $final_array = array();
            $final_array['results'] = $res2;

            //$outputArr['android'] = $setEntryResult;   
            $outputArr = array();
            $outputArr['android'] = $final_array;
            //echo ( json_encode($outputArr));
            print_r(json_encode($outputArr));

        }
 
?>
