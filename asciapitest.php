<?php
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

// Create Enquiry
$postData = array(
"salutation" => "Mr.",
"first_name" => "Rathina rel",
"last_name" => "Ganesh",
"email_id" => "ganesh@simplecrm.com.sg",
"designation_c" => "Software Engineer",
"phone_mobile" => "8877776815",
"description" => "Message",
"organisation" => "SimpleCRM",
"programme_id" => "95e6867c-f5ca-7183-706f-5995310f92bb",
"programme_type" => "Announced",
);
//programmeType = "Announced","ICTP-On Campus","ICTP-Off Campus","Seminar","Sponsored","Workshop ON Campus","Workshop OFF Campus","Long Duration";
$crmUrl = 'http://161.202.21.7/asci/uat';
$postData = json_encode($postData);
$url = $crmUrl.'/index.php?entryPoint=asciwebsiteapi';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:asci@w3b$it3','API_ACTION:Create','API_MODULE:Enquiry','Content-Type: application/json','Content-Length: ' . strlen($postData))
 );
$result = curl_exec($ch);
curl_close($ch);

echo $result;
exit;

//Fetch MDP Program

$crmUrl = 'http://161.202.21.7/asci/uat';
$postData = array(
"year" => "2017",
"offset" => "0",
"limit" => "20",
"programmeType" => array("Announced"),
);
//programmeType = ,"ICTP-On Campus","ICTP-Off Campus","Seminar","Sponsored","Workshop ON Campus","Workshop OFF Campus","Long Duration";
$postData = json_encode($postData);
$url = $crmUrl.'/index.php?entryPoint=asciwebsiteapi';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:asci@w3b$it3','API_ACTION:Fetch','API_MODULE:Programmes','Content-Type: application/json','Content-Length: ' . strlen($postData))
 );
$result = curl_exec($ch);
curl_close($ch);
echo $result;

exit;
 $crmUrl = 'http://161.202.21.7/asci/uat';
$postData = array(
"year" => "2017",
"offset" => "1",
"limit" => "20",
);
$postData = json_encode($postData);
$url = $crmUrl.'/index.php?entryPoint=asciwebsiteapi';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = [
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    'API_KEY:asci@w3b$it3',
    'API_ACTION:Fetch',
    'API_MODULE:Programmes',
];
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($postData))
curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");

$result = curl_exec($ch);
curl_close($ch);
echo $result;
exit;

$crmUrl = 'http://161.202.21.7/asci/uat';
$postData = array(
"programme_type_c" => "Announced",
"project_contacts_2_name" => "1",
"first_name" => "Vivek",
"last_name" => "Shanti",
"linked_in_c" => "vivek@linked.in",
"twitter_handle_c" => "vivek@twitter.in",
"phone_work" => "07184253689",
"phone_mobile" => "7709982939",
"phone_other" => "02055889966",
"do_not_call" => "1",
"designation_c" => "Manager",
//"nomination_status_c" => "Nomination Received",
"nominee_position_c" => "CEO",
"type_c" => "Residential",
//~ "reasons_for_rejection_c" => "Not available ",
"birthdate" => "2017-07-29",
"age_c" => "23",
"certificate_name_c" => "Certified in Managment",
"gender_c" => "Male",
"account_name" => "SimpleCRM",
"phone_fax" => "7845124578",
"certificate_issued_c" => "Yes",
//~ "date_of_entry_into_govt_c" => "1",
"t_shirt_c" => "M",
"present_responsibilities_c" => "1",
"report_to_c" => "1",
"expectation_programme_c" => "1",
"email1" => "vivek@gmail.com",
"primary_address_street" => "Lokmany tilak socity , near kalyn bhavan, bandra, Mumbai , Maharashtra , India",
"alt_address_street" => "Lokmany tilak socity , near kalyn bhavan, bandra, Mumbai , Maharashtra , India",
"description" => "Test Record",
//~ "scrm_partner_contacts_contacts_1_name" => "1",
//~ "scrm_accommodation_contacts_1_name" => "1",
"passport_number_c" => "784512369856523",
"visa_validity_c" => "2020-07-29",
"self_sponsored_c" => "yes",
"sponsor_organisation_c" => "SimpleCRM",
"tan_no_c" => "154515TT",
"tan_date_c" => "2017-07-29",
"pan_no_c" => "AVSE56789",
"pan_date_c" => "2017-07-29",
//~ "currency_c" => "1",
//~ "programme_fee_c" => "",
//~ "payment_mode_c" => "1",
//~ "date_of_transfer_c" => "29-07-2020",
//~ "payment_received_c" => "1",
//~ "issuing_bank_c" => "1",
//~ "issuing_city_c" => "1",
//~ "form_16a_recd_c" => "1",
//~ "tds_certificate_issued_c" => "1",
//~ "tds_deducted_c" => "1",
//~ "reference_no_c" => "1",
"name_of_the_insurance_agency_c" => "LIC",
"policy_number_c" => "14857865356565",
"validity_upto_c" => "29-07-2020",
//~ "lead_source" => "1",
"assigned_user_name" => "1",
"contacts_scrm_travel_details_1_name" => "1",
"enquiry_id_c" => "1",
);
$postData = json_encode($postData);
$url = $crmUrl.'/index.php?entryPoint=asciwebsiteapi';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:asci@w3b$it3','API_ACTION:Create','API_MODULE:Nomination','Content-Type: application/json','Content-Length: ' . strlen($postData))
 );
$result = curl_exec($ch);
curl_close($ch);
$result=explode('[Nomination_Record_ID] => ',$result);
$tmpID=$result[1];
echo $ID=substr($tmpID, 0, 36);
$Photo_status=upload_photo($ID);
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	 
	$target_file = $target_dir.$ID."_photo";
    if (copy($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
       print_r(error_get_last());
}
//~ echo $result[Nomination_Record_ID];
//Sample Reponse

/*==========================================================
Array
(
    [0] => Array
        (
            [programmeName] => Social Impact Assessment
            [crmid] => 1219bf82-6701-0e58-9a95-590ff96d4152
            [programmeType] => Announced
            [areaSubjects] => 
            [startDate] => 2017-06-15
            [endDate] => 2017-06-24
            [lastDateReceivingNominee] => 
            [earlyBirdDiscount] => 
            [inr_res_fee] => 
            [usd_res_fee] => 
            [euro_res_fee] => 
            [inr_non_res_fee] => 
            [usd_non_res_fee] => 
            [euro_non_res_fee] => 
        )

    [1] => Array
        (
            [programmeName] => Marketing Excellence
            [crmid] => 222067b4-5c64-4b9b-a329-5979745c295f
            [programmeType] => Announced
            [areaSubjects] => Marketing
            [startDate] => 2017-08-14
            [endDate] => 2017-08-18
            [lastDateReceivingNominee] => 
            [earlyBirdDiscount] => 
            [inr_res_fee] => 54000.000000
            [usd_res_fee] => 1485.000000
            [euro_res_fee] => 
            [inr_non_res_fee] => 50000.000000
            [usd_non_res_fee] => 1425.000000
            [euro_non_res_fee] => 
        )
)
=======================================================*/

//Create Enquiry
// $postData = array(
// "salutation" => "Mr.",
// "first_name" => "Rathina",
// "last_name" => "Ganesh",
// "email_id_c" => "ganesh@simplecrm.com.sg",
// "designation_c" => "Software Engineer",
// "phone_mobile" => "8877776815",
// "enquiry_date_c" => "2016-10-17",
// "message_c" => "Message",
// "company_c" => "SimpleCRM",
// "programme_type" => "OEP",
// "programme_id_c" => "540",
// "cfrom" => "contac1t",
// );

// $postData = json_encode($postData);

// $url = 'http://eepcrm.iima.ac.in/crm/index.php?entryPoint=iimarecords';

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_PROXY,             "192.168.32.3");         
//         curl_setopt($ch, CURLOPT_PROXYPORT,         "8080");
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:iim@w3b$it3','API_ACTION:Create','API_MODULE:Enquiry',
//                    'Content-Type: application/json',
//                'Content-Length: ' . strlen($postData))
//  );


// $result = curl_exec($ch);
// curl_close($ch);

// echo $result;



//Fetch Nomination
// $url = 'http://161.202.21.7/iima/dev/index.php?entryPoint=iimarecords';

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:iim@w3b$it3','API_ACTION:Fetch','API_MODULE:Nomination',
//                    'Content-Type: application/json')
//  );


// $result = curl_exec($ch);
// curl_close($ch);

// echo $result;

//Create Fees Details
// $postData = array(
// "amount" => "1000",
// "status" => "success",
// "transection_id" => "1111",
// "company_name" => "company",
// "pay_code" => "paycode",
// "program_id" => "programmeid",
// "nominee_id" => array("d30e8fc6-f705-c5c9-e1c9-5819817c8757","8470fea3-0936-7a57-70a4-581980ae3725"),
// );

// $postData = json_encode($postData);

// $url = 'http://161.202.21.7/iima/dev/index.php?entryPoint=iimarecords';

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch,CURLOPT_HTTPHEADER, array('API_KEY:iim@w3b$it3','API_ACTION:Create','API_MODULE:Fees Detail',
//                    'Content-Type: application/json',
//                'Content-Length: ' . strlen($postData))
//  );


// $result = curl_exec($ch);
// curl_close($ch);

// echo $result;

// $data=array(
// 		"name"=>'rathina ganesh',
// 		"email"=>'ganesh@simplecrm.com.sg',
// 		"nomination_id"=>'123',
// 		"company_name"=>'SimpleCRM',
// 		"pay_code"=>'IIMEX123',
// 		"program_id"=>'233'
// 		);
// 		$string=http_build_query($data);
// 		$ch=curl_init("www.areinfotech.in/IIMA-ExecEd/get-paycode.php");
// 		curl_setopt($ch,CURLOPT_POST,true);
// 		curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
// 		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
// 		curl_exec($ch);
// 		curl_close($ch);
