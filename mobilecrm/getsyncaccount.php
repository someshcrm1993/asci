	<?php

		$assigned_user_id                   = urldecode($_REQUEST["assigned_user_id"]);
		$date_modified_sugar_format_sync    = urldecode($_REQUEST["date_modified_sugar_format_sync"]);

	    //include '../db_home.php';
	    include 'db.php';
	    include('dbclean.php');
		$prefix = "";
		$connection  = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);

		if(!$connection){
			$connected = 0;
		}

		if( $connection ){
		mysql_query ("set character_set_results='utf8'");
		$db_selected = mysql_select_db($mysql_database, $connection);
		$connected = 1;

	//Based on assingned_user
	$sql2 = "SELECT IFNULL( ac.id, '' ) AS id, IFNULL( ac.name, '' ) AS name,
	IFNULL( ac.phone_office, '' ) AS phone_office,
	IFNULL( ac.description, '' ) AS description,
	IFNULL( ac.assigned_user_id, '' ) AS assigned_user_id,
	IFNULL( u.user_name, '' ) AS user_name, CONCAT( IFNULL( u.first_name, '' ) , ' ',
	IFNULL( u.last_name, '' ) ) AS assigned_user_name,

	IFNULL( ac.website, '' )  AS website, 
    IFNULL( ac.annual_revenue, '' )  AS annual_revenue,
    IFNULL( ac.account_type, '' )  AS account_type,

    IFNULL( ac.billing_address_street, '' ) AS billing_address_street,
    IFNULL( ac.billing_address_city, '' ) AS billing_address_city,
    IFNULL( ac.billing_address_state, '' ) AS billing_address_state,
    IFNULL( ac.billing_address_postalcode, '' ) AS billing_address_postalcode,
    IFNULL( ac.billing_address_country, '' ) AS billing_address_country,

    IFNULL( ac.shipping_address_street, '' ) AS shipping_address_street,
    IFNULL( ac.shipping_address_city, '' ) AS shipping_address_city,
    IFNULL( ac.shipping_address_state, '' ) AS shipping_address_state,
    IFNULL( ac.shipping_address_postalcode, '' ) AS shipping_address_postalcode,
    IFNULL( ac.shipping_address_country, '' ) AS shipping_address_country,
    IFNULL( acc.account_attachments_c, '' ) AS accountAttachments,
    IFNULL( acc.account_documents_c, '' ) AS accountDocumentLinks,

	ac.date_entered as date_entered,
	ac.date_modified as date_modified

	FROM accounts AS ac
	LEFT JOIN accounts_cstm AS acc ON ac.id = acc.id_c
	LEFT JOIN users AS u ON ac.assigned_user_id = u.id

	WHERE ac.assigned_user_id = '$assigned_user_id' order by ac.date_modified DESC";

				$res2 = array();
				$j=0;
				$results2 = mysql_query($sql2, $connection);
					while ($row2 = mysql_fetch_array($results2)) {

						$res2[$j]['id']  = $row2['id'];

					     //get email id
						$email_address_id = '';
						$email_address = '';
						$rec_id = $row2['id'];

						$get_email_id = "SELECT email_address_id FROM email_addr_bean_rel
						WHERE bean_module = 'Accounts' AND bean_id = '$rec_id' AND deleted = 0";
						$get_email_id_res = mysql_query($get_email_id, $connection);

						if($get_email_id_res_row = mysql_fetch_array($get_email_id_res)){
							$email_address_id = $get_email_id_res_row['email_address_id'];
						}

						$get_email = "SELECT email_address FROM email_addresses WHERE id = '$email_address_id' AND deleted = 0";
						$get_email_res = mysql_query($get_email, $connection);
						if($get_email_res_row = mysql_fetch_array($get_email_res)){
							$email_address = $get_email_res_row['email_address'];
						}
						$res2[$j]['email_address']                = $email_address;

						$res2[$j]['name']                         = $row2['name'];
						$res2[$j]['assigned_user_id']             = $row2['assigned_user_id'];
						$res2[$j]['assigned_user_name']           = $row2['assigned_user_name'];
						$res2[$j]['description']                  = $row2['description'];
						$res2[$j]['date_entered']                 = $row2['date_entered'];
						$res2[$j]['date_modified']                = $row2['date_modified'];
						$res2[$j]['phone_office']                 = $row2['phone_office'];
						$res2[$j]['website']                      = $row2['website'];
						$res2[$j]['annual_revenue']               = $row2['annual_revenue'];
						$res2[$j]['account_type']                 = $row2['account_type'];
						$res2[$j]['billing_address_street']       = $row2['billing_address_street'];
						$res2[$j]['billing_address_city']         = $row2['billing_address_city'];
						$res2[$j]['billing_address_state']        = $row2['billing_address_state'];
						$res2[$j]['billing_address_postalcode']   = $row2['billing_address_postalcode'];
				        $res2[$j]['billing_address_country']      = $row2['billing_address_country'];
				        $res2[$j]['shipping_address_street']      = $row2['shipping_address_street'];
				        $res2[$j]['shipping_address_city']        = $row2['shipping_address_city'];
				        $res2[$j]['shipping_address_state']       = $row2['shipping_address_state'];
				        $res2[$j]['shipping_address_postalcode']  = $row2['shipping_address_postalcode'];
				        $res2[$j]['shipping_address_country']     = $row2['shipping_address_country'];
                        $res2[$j]['accountAttachments']           = $row2['accountAttachments'];
                        $res2[$j]['accountDocumentLinks']         = $row2['accountDocumentLinks'];
				      
						$j++;

					}

			mysql_close($connection);
		}

		$final_array = array();
		$final_array['accounts'] = $res2;

		if ($connected == 0) {
			$outputArrr = array();
			$outputArrr['Android'] = "failed to connect to db";
			 //echo ( json_encode($outputArrr));
			print_r( json_encode($outputArrr));

		} if($connected == 1) {
			$outputArr = array();
			$outputArr['Android'] = $final_array;
			 //echo ( json_encode($outputArr));
			print_r( json_encode($outputArr));
		}

?>
