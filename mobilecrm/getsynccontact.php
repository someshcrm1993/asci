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
    $sql2 = "SELECT IFNULL( co.id, '' ) AS id, IFNULL( co.first_name, '' ) AS first_name, IFNULL( co.last_name, '' ) AS last_name,
    IFNULL( co.description, '' ) AS description,
    IFNULL( co.assigned_user_id, '' ) AS assigned_user_id,
    IFNULL( u.user_name, '' ) AS user_name, CONCAT( IFNULL( u.first_name, '' ) , ' ',
    IFNULL( u.last_name, '' ) ) AS assigned_user_name, IFNULL( co.title, '' ) AS title,
    IFNULL( co.phone_work, '' ) AS phone_work, IFNULL( co.phone_mobile, '' ) AS phone_mobile,
    IFNULL( co.primary_address_street, '' ) AS primary_address_street,
    IFNULL( co.primary_address_city, '' ) AS primary_address_city,
    IFNULL( co.primary_address_state, '' ) AS primary_address_state,
    IFNULL( co.primary_address_postalcode, '' ) AS primary_address_postalcode,
    IFNULL( co.primary_address_country, '' ) AS primary_address_country,
    IFNULL( co.alt_address_street, '' ) AS alt_address_street,
    IFNULL( co.alt_address_city, '' ) AS alt_address_city,
    IFNULL( co.alt_address_state, '' ) AS alt_address_state,
    IFNULL( co.alt_address_postalcode, '' ) AS alt_address_postalcode,
    IFNULL( co.alt_address_country, '' ) AS alt_address_country,
    IFNULL(aco.account_id, '' ) AS account_id,
    IFNULL(aa.name, '' ) AS account_name,

    co.date_entered as date_entered,
    co.date_modified as date_modified,
    IFNULL( coc.latitude_c, '' ) AS latitude,
    IFNULL( coc.longitude_c, '' ) AS longitude,
    IFNULL( coc.contact_profile_picture_c, '' ) AS contactProfilePicture,
    IFNULL( coc.contact_attachments_c, '' ) AS contactAttachments,
    IFNULL( coc.contact_documents_c, '' ) AS contactDocumentLinks,
    IFNULL( coc.contact_audio_links_c, '' ) AS contactAudioRecordLinks

    FROM contacts AS co
    LEFT JOIN contacts_cstm AS coc ON co.id = coc.id_c
    LEFT JOIN accounts_contacts AS aco ON aco.contact_id = co.id
    LEFT JOIN accounts AS aa ON aco.account_id = aa.id
    LEFT JOIN users AS u ON co.assigned_user_id = u.id
    WHERE co.assigned_user_id = '$assigned_user_id' AND co.date_modified >=  '$date_modified_sugar_format_sync' order by co.date_modified DESC";

    $res2 = array();
    $j=0;
    $results2 = mysql_query($sql2, $connection);
    while ($row2 = mysql_fetch_array($results2)) {

        $res2[$j]['id']                           = $row2['id'];

         //get email id
        $email_address_id = '';
        $email_address = '';
        $rec_id = $row2['id'];

        $get_email_id = "SELECT email_address_id FROM email_addr_bean_rel
        WHERE bean_module = 'Contacts' AND bean_id = '$rec_id' AND deleted = 0";
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

        $res2[$j]['first_name']                   = $row2['first_name'];
        $res2[$j]['last_name']                    = $row2['last_name'];
        $res2[$j]['assigned_user_id']             = $row2['assigned_user_id'];
        $res2[$j]['assigned_user_name']           = $row2['assigned_user_name'];
        $res2[$j]['description']                  = $row2['description'];
        $res2[$j]['date_entered']                 = $row2['date_entered'];
        $res2[$j]['date_modified']                = $row2['date_modified'];
        $res2[$j]['title']                        = $row2['title'];
        $res2[$j]['phone_work']                   = $row2['phone_work'];
        $res2[$j]['phone_mobile']                 = $row2['phone_mobile'];
        $res2[$j]['primary_address_street']       = $row2['primary_address_street'];
        $res2[$j]['primary_address_city']         = $row2['primary_address_city'];
        $res2[$j]['primary_address_state']        = $row2['primary_address_state'];
        $res2[$j]['primary_address_postalcode']   = $row2['primary_address_postalcode'];
        $res2[$j]['primary_address_country']      = $row2['primary_address_country'];
        $res2[$j]['alt_address_street']           = $row2['alt_address_street'];
        $res2[$j]['alt_address_city']             = $row2['alt_address_city'];
        $res2[$j]['alt_address_state']            = $row2['alt_address_state'];
        $res2[$j]['alt_address_postalcode']       = $row2['alt_address_postalcode'];
        $res2[$j]['alt_address_country']          = $row2['alt_address_country'];
        $res2[$j]['account_id']                   = $row2['account_id'];
        $res2[$j]['account_name']                 = $row2['account_name'];
        $res2[$j]['latitude']                     = $row2['latitude'];
        $res2[$j]['longitude']                    = $row2['longitude'];
        $res2[$j]['contactProfilePicture']        = $row2['contactProfilePicture'];
        $res2[$j]['contactAttachments']           = $row2['contactAttachments'];
        $res2[$j]['contactDocumentLinks']         = $row2['contactDocumentLinks'];
        $res2[$j]['contactAudioRecordLinks']      = $row2['contactAudioRecordLinks'];

        $j++;
    }

    mysql_close($connection);
}



$final_array = array();
$final_array['contacts'] = $res2;

if ($connected == 0) {
    $outputArrr = array();
    $outputArrr['Android'] = "failed to connect to db";
    //echo ( json_encode($outputArrr));
    print_r(json_encode($outputArrr));

} if($connected == 1) {
    $outputArr = array();
    $outputArr['Android'] = $final_array;
    //echo ( json_encode($outputArr));
    print_r(json_encode($outputArr));
}

?>
