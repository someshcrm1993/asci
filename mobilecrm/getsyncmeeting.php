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
$sql2 = "SELECT IFNULL( me.id, '' ) AS id, IFNULL( me.name, '' ) AS name, IFNULL( me.parent_type, '' ) AS parent_type,
         IFNULL( me.parent_id, '' ) AS parent_id, IFNULL( me.status, '' ) AS status,IFNULL( me.date_start, '' ) AS date_start,
         IFNULL( me.date_end, '' ) AS date_end,IFNULL( me.description, '' ) AS description, IFNULL( me.location, '' ) AS location,
         IFNULL( me.assigned_user_id, '' ) AS assigned_user_id,me.date_entered as date_entered,me.date_modified as date_modified,
         IFNULL( u.user_name, '' ) AS user_name, 
         CONCAT( IFNULL( u.first_name, '' ) , ' ', IFNULL( u.last_name, '' ) ) AS assigned_user_full_name

FROM meetings AS me
LEFT JOIN meetings_cstm AS mec ON me.id = mec.id_c
LEFT JOIN users AS u ON me.assigned_user_id = u.id
WHERE me.assigned_user_id = '$assigned_user_id' AND me.date_modified >=  '$date_modified_sugar_format_sync' order by me.date_modified DESC";

            $res2 = array();
            $j=0;
            $results2 = mysql_query($sql2, $connection);
                    while ($row2 = mysql_fetch_array($results2)) {

                    $res2[$j]['id']                           = $row2['id'];
                    $res2[$j]['name']                         = $row2['name'];
                    $res2[$j]['date_entered']                 = $row2['date_entered'];
                    $res2[$j]['date_modified']                = $row2['date_modified'];

                    $res2[$j]['status']                       = $row2['status'];
                    $res2[$j]['parent_type']                  = $row2['parent_type'];
                    $res2[$j]['parent_id']                    = $row2['parent_id'];

                    //Get parent_name 
                    $parent_name = "";
                    $parent_id   = $row2['parent_id'];
                    $parent_type = $row2['parent_type'];
                    $table_name  = strtolower($parent_type);

                    if ($table_name != '') {

                        if ($table_name == 'leads' || $table_name == 'contacts') {
                            $sql3 = "SELECT IFNULL( tn.first_name, '' ) AS first_name, 
                                          IFNULL( tn.last_name, '' ) AS last_name
                                          FROM $table_name AS tn
                                          WHERE tn.id = '$parent_id' AND tn.deleted = 0";
                        }

                        else {
                            $sql3 = "SELECT IFNULL( tn.name, '' ) AS name
                                          FROM $table_name AS tn
                                          WHERE tn.id = '$parent_id' AND tn.deleted = 0";
                        }

                        $get_parent = mysql_query($sql3, $connection);
                        $numResults = mysql_num_rows($get_parent);
                        if ($numResults > 0) {
                        $values = mysql_fetch_assoc($get_parent);
                        $name  = $values['name'];
                        $fName = $values['first_name'];
                        $lName = $values['last_name'];
                        }
                        mysql_free_result($get_parent);

                    }
                    if ($name == '') {
                        $name =$fName." ".$lName;
                    }
                    $parent_name = $name;
                    $res2[$j]['parent_name']                  = $parent_name;

                    $res2[$j]['date_start']                   = $row2['date_start'];
                    $res2[$j]['date_end']                     = $row2['date_end'];
                    $res2[$j]['description']                  = $row2['description'];
                    $res2[$j]['location']                     = $row2['location'];
                    $res2[$j]['assigned_user_name']           = $row2['assigned_user_full_name'];
                    $res2[$j]['assigned_user_id']             = $row2['assigned_user_id'];

                    $j++;

                    }

                mysql_close($connection);

            }

            $final_array = array();
            $final_array['meetings'] = $res2;

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
