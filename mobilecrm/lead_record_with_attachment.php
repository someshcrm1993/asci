<?php

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
    $assignedUserId = $loginResult->name_value_list->user_id->value;

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





// Add logic to create attachments for records - start

//Add complete logic under this if
if($module_name == 'Leads'){

$setEntryResult_ids = $setEntryResult->ids;
$res_count          = sizeof($setEntryResult_ids);
$y                  = 0;

//check $res_count > 0{}
for($y;$y<$res_count;$y++){

$res_id = $setEntryResult_ids[$y];

$mobile_offline_unique_id_c = "";
$ind_array = $final_data_array[$y];

foreach($ind_array as $ind_arr){

if($ind_arr['name'] =='mobile_offline_unique_id_c'){

$mobile_offline_unique_id_c = $ind_arr['value'];
$mobile_offline_unique_id_c = "scrm";


// Logic to store file - start

$file_path = "uploads/";
    
//Loop through each file

$success = array();
$failure = array();
        
    for($i=0; $i<count($_FILES['uploaded_file']['name']); $i++) {
      //Get the temp file path
      $tmpFilePath = $_FILES['uploaded_file']['tmp_name'][$i];
     
/*    $filenamee = $_FILES['uploaded_file']['name'][$i];  
    $myText = (string)$filenamee;
    //$myText = print_r($username)
    $myText = "\n".$myText."\n";
    $filename = "testFiles.txt";
    $fh = fopen($filename, "a");
    fwrite($fh, $myText);
    fclose($fh);*/

      //Make sure we have a filepath
      if ($tmpFilePath != ""){
        //Setup our new file path
        $newFilePath = "uploads/".$mobile_offline_unique_id_c."_".$_FILES['uploaded_file']['name'][$i];
    
        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        $success[] = $newFilePath;
        }else{
            $failure[] = $newFilePath;
        }
        
        
      }
    }
    
$result = array("username" => $username, "Success"=>$success,"Failure"=>$failure);  
//echo json_encode($result);

// Logic to store file - end


// Logic to add profile picture - start

$image_name = "image.jpg";
$sour       = "uploads/".$image_name;
$dest       = "../profile_pictures/".$res_id."_".$image_name;

if (copy($sour, $dest)) {
    echo "success";
}
else{
    echo "not success";
}

include 'db.php';
$prefix = "";
$connection  = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);

if(!$connection){
$connected = 0;
}

if($connection){
mysql_query ("set character_set_results='utf8'");
$db_selected = mysql_select_db($mysql_database, $connection);
$connected = 1;

//$update_contact_image = "UPDATE contacts, contacts_cstm SET contact_photo_c = '$image_name' WHERE id = id_c AND id_c = '$res_id' AND deleted = 0";

$update_lead_image = "UPDATE leads, leads_cstm SET lead_profile_photo_c = '$image_name' WHERE id = id_c AND id_c = '$res_id' AND deleted = 0";

$update_image_res = mysql_query($update_lead_image, $connection);

mysql_close($connection);
}

// Logic to add profile picture - end

// Add logic to create notes under the parent record.

$files = glob("uploads/$mobile_offline_unique_id_c*".".*");

// Process through each file in the list
// and output its extension
if (count($files) > 0){

    foreach ($files as $file){
    $info = pathinfo($file);
    //echo "<br>File Found : ".$info["basename"]."<br>";
    //echo "dirname : ".$info["dirname"]."<br>";
    //echo "basename : ".$info["basename"]."<br>";
    //echo "extension : ".$info["extension"]."<br>";
    //echo "filename : ".$info["filename"]."<br>";

    //get session id
    $sessionID = $loginResult->id;

    //create note ----------------------------------------------- 
    $set_entry_parameters = array(
         //session id
         "session" => $sessionID,

         //The name of the module
         "module_name" => "Notes",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              //array("name" => "id", "value" => "9b170af9-3080-e22b-fbc1-4fea74def88f"),
              array("name" => "name", "value" => $info["filename"]),
              array("name" => "parent_type", "value" => "Leads"),
              //array("name" => "parent_name", "value" => "Nitheesh Rajeevan"),
              array("name" => "parent_id", "value" => $res_id),
              array("name" => "assigned_user_id", "value" => $assignedUserId),
              array("name" => "description", "value" => "Attachment for Lead"),
         ),
    );

    $set_entry_result = call("set_entry", $set_entry_parameters, $api_url);

    /*    
    echo "<pre>";
    print_r($set_entry_result);
    echo "</pre>";
    */

    $note_id = $set_entry_result->id;

    $file_name      = $info["filename"];
    $file_extension = $info["extension"];
    //$directory_path = "uploads";
    $directory_path = $info["dirname"];

    //create note attachment -------------------------------------- 
    $contents = file_get_contents ($directory_path."/".$file_name.".".$file_extension);
    //$contents = file_get_contents ($directory_path."/".$info["basename"]);

    $new_file_name = str_replace($mobile_offline_unique_id_c."_", "", $file_name);
    //$new_file_name = chop($file_name,$mobile_offline_unique_id_c);
    
    $set_note_attachment_parameters = array(
        //session id
        "session" => $sessionID,

        //The attachment details
        "note" => array(
            //The ID of the note containing the attachment.
            'id' => $note_id,

             //The name of the attachment
            'filename' => $new_file_name.'.'.$file_extension,

            //The binary contents of the file.
            'file' => base64_encode($contents),
        ),
    );

    $set_note_attachment_result = call("set_note_attachment", $set_note_attachment_parameters, $api_url);

/*    
    echo "<pre>";
    print_r($set_note_attachment_result);
    echo "</pre>";
*/


//remove files after successfull creation of notes
if (is_file($directory_path."/".$info["basename"])) {
    unlink($directory_path."/".$info["basename"]);
}



    }
}

else{
//echo "<br>No file name exists called $compartment. Regardless of extension.<br>";
}






}

}

}
 
}


// Add logic to create attachments for records - end


            $outputArr = array();
            $outputArr['Android'] = $result;
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


function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

?>
