<?php

/*

$res = array(
              array(
		   array("name" => "first_name", "value" => "Test1"),
		   array("name" => "last_name", "value" => "Contact1"),
		   array("name" => "phone_mobile", "value" => "81"),
		   array("name" => "state_c", "value" => "KARNATAKA"),
		  ),
              array(
		   array("name" => "first_name", "value" => "Test2"),
		   array("name" => "last_name", "value" => "Contact2"),
		   array("name" => "phone_mobile", "value" => "82"),
		   array("name" => "state_c", "value" => "KARNATAKA"),
		  )
            );

*/


        $username    = urldecode($_REQUEST["username"]);
        $password    = urldecode($_REQUEST["password"]);
        $url         = urldecode($_REQUEST["url"]);
        $module_name = urldecode($_REQUEST["module_name"]);
        $api_url     = "$url/service/v4_1/rest.php";

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
            $outputArrr['Android'] = $loginResult;
            //echo ( json_encode($outputArrr));
            print_r( json_encode($outputArrr));

        } else {

            $json            = urldecode($_REQUEST["jsonParam"]);
            $jsonData        = json_decode($json);
            $jsonData_data   = $jsonData->data;
            $jsonData_data_count = count($jsonData_data);


            $resull = array();
            $nameValueList = array();
	          $k=0;
            $jsonData_data_array = array();
            for($k;$k<$jsonData_data_count;$k++){
            $jsonData_data_array_each = $jsonData_data[$k];

            foreach ($jsonData_data_array_each as $key => $value) {
            $nameValueList[] = array("name" => $key, "value" => $value);
            }
		if(count($nameValueList)){
		   $resull[] = array_push($resull, $nameValueList);
		}
            $nameValueList = array();
            //unset($nameValueList);
            }

            $resull_count = count($resull);

            $p=0;
            $final_data_array = array();
            for($p;$p<$resull_count;$p++){
            $resull_each = $resull[$p];
            if (!is_numeric($resull_each)) {
                    $final_data_array [] = $resull_each;
	    }
            }


           //Here add logic for creating new records

            $sessionID = $loginResult->id;
            $setEntryParameters = array(
                 //session id
                "session" => $sessionID,
                //The name of the module from which to retrieve records.
                "module_name" => $module_name,
                //Record attributes
                //to update a record, you will nee to pass in a record id as commented below
                "name_value_list" => $final_data_array,

            );
            $setEntryResult = call("set_entries", $setEntryParameters, $api_url);
            //$setEntryResult_id = $setEntryResult->id;

            $outputArr = array();
            $outputArr['Android'] = $setEntryResult;
            //echo ( json_encode($outputArr));
            print_r( json_encode($outputArr));

	  }


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

?>
