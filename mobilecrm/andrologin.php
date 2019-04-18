<?php

$username   = urldecode($_REQUEST["username"]);
$password   = urldecode($_REQUEST["password"]);
$site_url   = urldecode($_REQUEST["url"]);
$api_url    = "$site_url/service/v4_1/rest.php";

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
$login_result = call("login", $login_parameters, $api_url);

if(isset($login_result->name) && $login_result->name == 'Invalid Login'){
//echo "Invalid user details";
}


$outputArrr = array();
$outputArrr['Android'] = $login_result;
//echo ( json_encode($outputArrr));
print_r( json_encode($outputArrr));


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
