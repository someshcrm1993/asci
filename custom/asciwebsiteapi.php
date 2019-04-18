<?php

/*========================
By: Rathina Ganesh
    Date: 28th July 2017
========================*/


if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/utils.php');
require_once('include/entryPoint.php');
global $sugar_config,$db;

$url = $sugar_config['site_url'];
$username = $sugar_config['apiuser'];
$password = $sugar_config['apipass'];
$url = $url."/service/v4_1/rest.php";
$apiModule = array('Programmes','Enquiry','Nomination');
$apiAction = array('Create','Fetch'); 

 //function to make cURL request
function call($method, $parameters, $url){

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

function generateSession($username,$password,$url){
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
    return $session_id;
}

function getRecords($sessionID ,$module,$where,$select_fields ,$url,$order_by,$offset,$limit){

	if($max_result == '') {
		$max_result = 1000;
	}

	 //retrieve records ------------------------------------- 
    $get_entry_list_parameters = array(
         //session id
         'session' => $sessionID,
         //The name of the module from which to retrieve records
         'module_name' => $module,
         //The SQL WHERE clause without the word "where".
         'query' => $where,
         //The SQL ORDER BY clause without the phrase "order by".
         'order_by' => $order_by,
         //The record offset from which to start.
         'offset' => $offset,
         //Optional. The list of fields to be returned in the results
         'select_fields' => $select_fields,
         //A list of link names and the fields to be returned for each link name
         'link_name_to_fields_array' => array(
              array(
                   'name' => 'email_addresses',
                   'value' => array(
                        'id',
                        'email_address',
                        'opt_out',
                        'primary_address'
                   ),
              ),
         ),
         //The maximum number of results to return.
         'max_results' => $limit,
         //To exclude deleted records
         'deleted' => 0,
         //If only records marked as favorites should be returned.
         'Favorites' => false,

    );
    $result =call("get_entry_list" ,$get_entry_list_parameters,$url);
    return $result;
}

function createrecord($session_id,$module,$create_entry_parameters,$url){

  $set_entry_parameters = array(
     //session id
     "session" => $session_id,

     "module_name" => $module,

     //Record attributes
     "name_value_list" => $create_entry_parameters,
    );
  $set_entry_result = call("set_entry", $set_entry_parameters, $url);
  $record_id =$set_entry_result->id;
  return $record_id;

}

function set_relationship($session_id,$module,$moudleid,$linkname,$related_id,$url){
    $set_relationship_parameters = array(
        //session id
        'session' => $session_id,

        //The name of the module.
        'module_name' => $module,

        //The ID of the specified module bean.
        'module_id' => $moudleid,

        //The relationship name of the linked field from which to relate records.
        'link_field_name' => $linkname,

        //The list of record ids to relate
        'related_ids' => array(
            $related_id,
        ),

        //Sets the value for relationship based fields
        // 'name_value_list' => array(
        //     array(
        //         'name' => 'contact_role',
        //         'value' => 'Other'
        //     ),
        // ),

        //Whether or not to delete the relationship. 0:create, 1:delete
        'delete'=> 0,
    );
    $set_relationship_result = call("set_relationship", $set_relationship_parameters, $url);
    return $set_relationship_result;
}


function upload_photo($id){
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			return "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			return "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		return "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		return "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		return "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		 
		$target_file = $target_dir.$id."_photo";
		if (copy($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			return "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			 //print_r(error_get_last());
			return "Sorry, there was an error uploading your file.";
		}
		  
	}
}
$fp = fopen('php://input', 'r');

// print_r(apache_request_headers()['API_KEY']);exit();
if(apache_request_headers()['API_KEY'] == 'asci@w3b$it3' && in_array(apache_request_headers()['API_MODULE'], $apiModule) && in_array(apache_request_headers()['API_ACTION'], $apiAction)){

    $module = apache_request_headers()['API_MODULE'];
    $action = apache_request_headers()['API_ACTION'];
    
 	$fp = fopen('php://input', 'r');
    $rawData = json_decode(stream_get_contents($fp));
    $session_id = generateSession($username,$password,$url);
    // print_r($password);exit();

    if ($module == "Programmes" && $action == 'Fetch'){
        $year = $rawData->year;
        $offset = $rawData->offset;
        $limit = $rawData->limit;
        $programmeType = $rawData->programmeType;
        if(!isset($year) or empty($year)){
            $msg = array('Success'=>false,'Message' => 'Fields are missing');
        }else{
            $date = date('Y-m-d',strtotime('+1 day'));
            if(!empty($programmeType)){
                $programmeType = implode("','",$programmeType);
                $query =  "project_cstm.programme_year_c = '$year' and project.status = 'Offered' and project_cstm.start_date_c > '$date' and project_cstm.programme_type_c in ('$programmeType')";
            }else{
                $query =  "project_cstm.programme_year_c = '$year' and project.status = 'Offered' and project_cstm.start_date_c > '$date'";
            }
            $order_by = "start_date_c";
        	$select_fields = array('id','name','programme_type_c','area_subjects_c','start_date_c','end_date_c','date_receiving_nominee_c','ebd_date_c','programme_fee_c','usd_c','euro_c','programme_fee_non_res_c','usd_non_res_c','euro_non_res_c','description');
        	$records = getRecords($session_id,'Project',$query,$select_fields,$url,$order_by,$offset,$limit);
            // print_r($records);exit;
            $i=0;
        	foreach($records->entry_list as $record){
                $msg[$i]['programmeName'] = $record->name_value_list->name->value;
                $msg[$i]['crmid'] = $record->name_value_list->id->value;
                $msg[$i]['programmeType'] = strip_tags($record->name_value_list->programme_type_c->value);
                $msg[$i]['areaSubjects'] = $record->name_value_list->area_subjects_c->value;
                $msg[$i]['startDate'] = date('d-m-Y',strtotime($record->name_value_list->start_date_c->value));
                $msg[$i]['endDate'] = date('d-m-Y',strtotime($record->name_value_list->end_date_c->value));
                $msg[$i]['lastDateReceivingNominee'] = $record->name_value_list->date_receiving_nominee_c->value;
                if ($record->name_value_list->ebd_date_c->value) {
                    $ebd_date_c = date('d-m-Y',strtotime($record->name_value_list->ebd_date_c->value));
                }else{
                    $ebd_date_c = '';
                }
                 
                $msg[$i]['earlyBirdDiscount'] = $ebd_date_c;
                $msg[$i]['inr_res_fee'] = number_format($record->name_value_list->programme_fee_c->value,2, '.', '');
                $msg[$i]['usd_res_fee'] = number_format($record->name_value_list->usd_c->value,2, '.', '');
                $msg[$i]['euro_res_fee'] = number_format($record->name_value_list->euro_c->value,2, '.', '');
                $msg[$i]['inr_non_res_fee'] = number_format($record->name_value_list->programme_fee_non_res_c->value,2, '.', '');
                $msg[$i]['usd_non_res_fee'] = number_format($record->name_value_list->usd_non_res_c->value,2, '.', '');
                $msg[$i]['euro_non_res_fee'] = number_format($record->name_value_list->euro_non_res_c->value,2, '.', '');
                $msg[$i]['description'] = $record->name_value_list->description->value;
                $i++;
            }
        }
    }
    else if($module == "Enquiry" && $action == 'Create'){

        $salutation = $rawData->salutation;
        $first_name = $rawData->first_name;
        $last_name = $rawData->last_name;
        $email_id = $rawData->email_id;
        $designation = $rawData->designation_c;
        $phone_mobile = $rawData->phone_mobile;
        $description = str_replace("\\r\\n",' ', $rawData->description);
        $organisation = $rawData->organisation;
        $programme_id = $rawData->programme_id;
        $programme_type = $rawData->programme_type;
        // //~ $query = "SELECT prog_programmes.assigned_user_id,prog_programmes_cstm.form_year_c
        // //~ FROM  prog_programmes join prog_programmes_cstm on prog_programmes.id = prog_programmes_cstm.id_c
        // //~ WHERE prog_programmes.id =  '$programme_id_c'";
        // $query = "SELECT case when now() < prog_programmes.start_date  then prog_programmes.assigned_user_id  else '59'  end as assigned_user_id,prog_programmes_cstm.form_year_c
        // FROM  prog_programmes join prog_programmes_cstm on prog_programmes.id = prog_programmes_cstm.id_c
        // WHERE prog_programmes.id =  '$programme_id_c'";
        
        // $assigneduserresult = mysqli_query($conn, $query);
        // $assigneduserresultrow = mysqli_fetch_assoc($assigneduserresult); 
        // $assigned_user_id = $assigneduserresultrow['assigned_user_id'];
        // $form_year_c = $assigneduserresultrow['form_year_c'];

        // $enquiryquery = "SELECT count(*) as count FROM leads l join prog_programmes_leads_1_c pl on pl.prog_programmes_leads_1leads_idb=l.id where l.deleted = 0 and l.phone_mobile = '$phone_mobile' and pl.prog_programmes_leads_1prog_programmes_ida = '$programme_id_c' and pl.deleted = 0";
        // $enquiryqueryresult=$db->query($enquiryquery);
        // $enquiryrow = $db->fetchByAssoc($enquiryqueryresult);
        // $count = $enquiryrow['count'];
        // if(empty($count))
        // {
        if(!isset($first_name) or empty($first_name) or !isset($email_id) or empty($email_id)){
            $msg = array('Success'=>false,'Message' => 'Fields are missing');
        }else{
             $name_value_list = array(
                 array("name" => "salutation", "value" => $salutation),
                 array("name" => "first_name", "value" => $first_name),
                 array("name" => "last_name", "value" => $last_name),
                 array("name" => "email1", "value" => $email_id),
                 array("name" => "title", "value" => $designation),
                 array("name" => "phone_mobile", "value" => $phone_mobile),
                 array("name" => "description", "value" => $description),
                 array("name" => "organisation_website_c", "value" => $organisation),
                 array("name" => "assigned_user_id", "value" => '1'),
                 array("name" => "lead_source", "value" => "Web Site"),
                 array("name" => "programme_type_c", "value" => $programme_type),
                 );
        $id=createrecord($session_id,'Leads',$name_value_list,$url);
        set_relationship($session_id,'Leads',$id,'project_leads_1project_ida',$programme_id,$url);
        $msg = array('Success'=>'true','Enquiry Record ID'=>$id);
        }
        // }else{
        //     $msg = array('Success'=>'false','Message'=>"Duplicate Entry");
        // }
    } else if($module == "Fees Detail" && $action == 'Create'){
        $transaction_id_c = $rawData->transection_id;
        $status_c = $rawData->status;
        $check_amount_c = $rawData->amount;
        $bankReference = $rawData->bankreferenceNo;
        $bankId = $rawData->bankID;
        $bannkmerchantId = $rawData->bankMerchantID;
        $txnType = $rawData->TxnType;
        $crnName = $rawData->CurrencyName;
        $itemCode = $rawData->ItemCode;
        $pay_code = $rawData->pay_code;

        $program_id = $rawData->program_id;
        if(!isset($transaction_id_c) or empty($transaction_id_c) or !isset($status_c) or empty($status_c)){
            $msg = array('Success'=>false,'Message' => 'Fields are missing');
        }else{
            $nomi_nominations_scrm_fee_details_1nomi_nominations_ida = $rawData->nominee_id;
            foreach($nomi_nominations_scrm_fee_details_1nomi_nominations_ida as $nominee_id){
            	$name_value_list = array(

            		 array("name" => "transaction_id_c", "value" => $transaction_id_c),
            		 array("name" => "status_c", "value" => $status_c),
                     array("name" => "check_amount_c", "value" => $check_amount_c),
                     array("name" => "bank_reference_no_c", "value" => $bankreferenceNo),
                     array("name" => "bank_merchant_id_c", "value" => $bannkmerchantId),
                     array("name" => "bank_id_c", "value" => $bankID),
                     array("name" => "txn_type_c", "value" => $TxnType),
                     array("name" => "currency_name_c", "value" => $CurrencyName),
                     array("name" => "item_code_c", "value" => $ItemCode),
            		 array("name" => "pay_code_c", "value" => $pay_code),
            		 array("name" => "nomi_nominations_scrm_fee_details_1nomi_nominations_ida", "value" => $nominee_id)           	
            		 );
            	$id=createrecord($session_id,'scrm_Fee_Details',$name_value_list,$url);

                if($status_c == 'success'){
                    $name_value_list = array(
                         array("name" => "id", "value" => $nominee_id),
                         array("name" => "payment_received_c", "value" => "Yes"),
                         );                        
                }
                else{
                    $name_value_list = array(
                         array("name" => "id", "value" => $nominee_id),
                         array("name" => "payment_received_c", "value" => "No"),
                         );
                }
                createrecord($session_id,'nomi_Nominations',$name_value_list,$url);

            	$msg = array('Success'=>'true','Fee Record ID'=>$id);
            }
        }
    }else if ($module == "Nomination" && $action == 'Create'){
       
     
		//$programme_year_c = $rawData->programme_year_c;
		$programme_year_c = '2017';
		$photo = $rawData->photo;
		$programme_type_c = $rawData->programme_type_c;
		$project_contacts_2_name = $rawData->project_contacts_2_name;
		$first_name = $rawData->first_name;
		$last_name = $rawData->last_name;
		$linked_in_c = $rawData->linked_in_c;
		$twitter_handle_c = $rawData->twitter_handle_c;
		$phone_work = $rawData->phone_work;
		$phone_mobile = $rawData->phone_mobile;
		$phone_other = $rawData->phone_other;
		$do_not_call = $rawData->do_not_call;
		$designation_c = $rawData->designation_c;
		//$nomination_status_c = $rawData->nomination_status_c;
		$nomination_status_c = 'Nomination Received';
		$nominee_position_c = $rawData->nominee_position_c;
		$type_c = $rawData->type_c;
		//~ $reasons_for_rejection_c = $rawData->reasons_for_rejection_c;
		$birthdate = $rawData->birthdate;
		$age_c = $rawData->age_c;
		$certificate_name_c = $rawData->certificate_name_c;
		$gender_c = $rawData->gender_c;
		$account_name = $rawData->account_name;
		$phone_fax = $rawData->phone_fax;
		$certificate_issued_c = $rawData->certificate_issued_c;
		//~ $date_of_entry_into_govt_c = $rawData->date_of_entry_into_govt_c;
		$t_shirt_c = $rawData->t_shirt_c;
		$present_responsibilities_c = $rawData->present_responsibilities_c;
		$report_to_c = $rawData->report_to_c;
		$expectation_programme_c = $rawData->expectation_programme_c;
		$email1 = $rawData->email1;
		$primary_address_street = $rawData->primary_address_street;
		$alt_address_street = $rawData->alt_address_street;
		$description = $rawData->description;
		//~ $scrm_partner_contacts_contacts_1_name = $rawData->scrm_partner_contacts_contacts_1_name;
		//~ $scrm_accommodation_contacts_1_name = $rawData->scrm_accommodation_contacts_1_name;
		$passport_number_c = $rawData->passport_number_c;
		$visa_validity_c = $rawData->visa_validity_c;
		$self_sponsored_c = $rawData->self_sponsored_c;
		$sponsor_organisation_c = $rawData->sponsor_organisation_c;
		$tan_no_c = $rawData->tan_no_c;
		$tan_date_c = $rawData->tan_date_c;
		$pan_no_c = $rawData->pan_no_c;
		//~ $pan_date_c = $rawData->pan_date_c;
		//~ $currency_c = $rawData->currency_c;
		//~ $programme_fee_c = $rawData->programme_fee_c;
		//~ $payment_mode_c = $rawData->payment_mode_c;
		//~ $date_of_transfer_c = $rawData->date_of_transfer_c;
		//~ $payment_received_c = $rawData->payment_received_c;
		//~ $issuing_bank_c = $rawData->issuing_bank_c;
		//~ $issuing_city_c = $rawData->issuing_city_c;
		//~ $form_16a_recd_c = $rawData->form_16a_recd_c;
		//~ $tds_certificate_issued_c = $rawData->tds_certificate_issued_c;
		//~ $tds_deducted_c = $rawData->tds_deducted_c;
		//~ $reference_no_c = $rawData->reference_no_c;
		$name_of_the_insurance_agency_c = $rawData->name_of_the_insurance_agency_c;
		$policy_number_c = $rawData->policy_number_c;
		$validity_upto_c = $rawData->validity_upto_c;
		//~ $lead_source = $rawData->lead_source;
		$lead_source = 'Web Site';
		$assigned_user_name = $rawData->assigned_user_name;
		$contacts_scrm_travel_details_1_name = $rawData->contacts_scrm_travel_details_1_name;
		$enquiry_id_c = $rawData->enquiry_id_c;

            	$name_value_list = array(									
						array("name" => "transaction_id_c", "value" => $transaction_id_c),
						array("name" => "programme_year_c", "value" => $programme_year_c),
						array("name" => "photo", "value" => $photo),
						array("name" => "programme_type_c", "value" => $programme_type_c),
						array("name" => "project_contacts_2_name", "value" => $project_contacts_2_name),
						array("name" => "first_name", "value" => $first_name),
						array("name" => "last_name", "value" => $last_name),
						array("name" => "linked_in_c", "value" => $linked_in_c),
						array("name" => "twitter_handle_c", "value" => $twitter_handle_c),
						array("name" => "phone_work", "value" => $phone_work),
						array("name" => "phone_mobile", "value" => $phone_mobile),
						array("name" => "phone_other", "value" => $phone_other),
						array("name" => "do_not_call", "value" => $do_not_call),
						array("name" => "designation_c", "value" => $designation_c),
						array("name" => "nomination_status_c", "value" => $nomination_status_c),
						array("name" => "nominee_position_c", "value" => $nominee_position_c),
						array("name" => "type_c", "value" => $type_c),
						//~ array("name" => "reasons_for_rejection_c", "value" => $reasons_for_rejection_c),
						array("name" => "birthdate", "value" => $birthdate),
						array("name" => "age_c", "value" => $age_c),
						array("name" => "certificate_name_c", "value" => $certificate_name_c),
						array("name" => "gender_c", "value" => $gender_c),
						array("name" => "account_name", "value" => $account_name),
						array("name" => "phone_fax", "value" => $phone_fax),
						array("name" => "certificate_issued_c", "value" => $certificate_issued_c),
						//~ array("name" => "date_of_entry_into_govt_c", "value" => $date_of_entry_into_govt_c),
						array("name" => "t_shirt_c", "value" => $t_shirt_c),
						array("name" => "present_responsibilities_c", "value" => $present_responsibilities_c),
						array("name" => "report_to_c", "value" => $report_to_c),
						array("name" => "expectation_programme_c", "value" => $expectation_programme_c),
						array("name" => "email1", "value" => $email1),
						array("name" => "primary_address_street", "value" => $primary_address_street),
						array("name" => "alt_address_street", "value" => $alt_address_street),
						array("name" => "description", "value" => $description),
						//~ array("name" => "scrm_partner_contacts_contacts_1_name", "value" => $scrm_partner_contacts_contacts_1_name),
						//~ array("name" => "scrm_accommodation_contacts_1_name", "value" => $scrm_accommodation_contacts_1_name),
						array("name" => "passport_number_c", "value" => $passport_number_c),
						array("name" => "visa_validity_c", "value" => $visa_validity_c),
						array("name" => "self_sponsored_c", "value" => $self_sponsored_c),
						array("name" => "sponsor_organisation_c", "value" => $sponsor_organisation_c),
						array("name" => "tan_no_c", "value" => $tan_no_c),
						array("name" => "tan_date_c", "value" => $tan_date_c),
						array("name" => "pan_no_c", "value" => $pan_no_c),
						array("name" => "pan_date_c", "value" => $pan_date_c),
						//~ array("name" => "currency_c", "value" => $currency_c),
						//~ array("name" => "programme_fee_c", "value" => $programme_fee_c),
						//~ array("name" => "payment_mode_c", "value" => $payment_mode_c),
						//~ array("name" => "date_of_transfer_c", "value" => $date_of_transfer_c),
						//~ array("name" => "payment_received_c", "value" => $payment_received_c),
						//~ array("name" => "issuing_bank_c", "value" => $issuing_bank_c),
						//~ array("name" => "issuing_city_c", "value" => $issuing_city_c),
						//~ array("name" => "form_16a_recd_c", "value" => $form_16a_recd_c),
						//~ array("name" => "tds_certificate_issued_c", "value" => $tds_certificate_issued_c),
						//~ array("name" => "tds_deducted_c", "value" => $tds_deducted_c),
						//~ array("name" => "reference_no_c", "value" => $reference_no_c),
						array("name" => "name_of_the_insurance_agency_c", "value" => $name_of_the_insurance_agency_c),
						array("name" => "policy_number_c", "value" => $policy_number_c),
						array("name" => "validity_upto_c", "value" => $validity_upto_c),
						array("name" => "lead_source", "value" => $lead_source),
						array("name" => "assigned_user_name", "value" => $assigned_user_name),
						array("name" => "contacts_scrm_travel_details_1_name", "value" => $contacts_scrm_travel_details_1_name),
						array("name" => "enquiry_id_c", "value" => $enquiry_id_c),
          	
            		 );
            	$id=createrecord($session_id,'Contacts',$name_value_list,$url);
            	            	$msg = array('Success'=>'true','Nomination_Record_ID'=>$id);
				            	$Photo_status= upload_photo($id);
				            	$msg = array('Success'=>'true','Nomination_Record_ID'=>$id,'Photo status'=>$Photo_status);

    }else if ($module == "Nomination" && $action == 'Fetch'){
        	$query =  "";
        	$select_fields = array('id','nominated_id_c','salutation','first_name','last_name','email_r1_c','pay_code_c','programme_id_c','company_c');
        	$records = getRecords($session_id,'nomi_Nominations',$query,$select_fields,$url,$order_by,$offset,$limit);
        	$msg = $records->entry_list;
    }
    else{
    	$msg = array('Success'=>'false','Message'=>'Please check the module or action name');
    }
   
}else{
	$msg = array('Success'=>'false','Message' => 'Oops! Something went wrong');
}
// echo '<pre>';
	print_r(json_encode($msg));
// echo '</pre>';
exit;


?>
