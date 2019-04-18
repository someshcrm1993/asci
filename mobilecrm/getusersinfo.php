<?php

                $usersimplecrmId        = urldecode($_REQUEST["usersimplecrmId"]);    
                   
                //include '../db_home.php';
                include 'db.php';
                $prefix = "";
            	$connection  = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);
            	
            	if(!$connection){
            	 $connected = 0;
            	}

                if($connection){
                    mysql_query ("set character_set_results='utf8'"); 
                    $db_selected = mysql_select_db($mysql_database, $connection);
                    //mysql_select_db('rf_dev_crm');
                    $connected = 1;

                    $sql3 = "SELECT IFNULL(id,'') AS id, IFNULL(first_name,'') AS first_name, 
                    IFNULL(last_name,'') AS last_name, IFNULL(user_name,'') AS user_name,
                    is_admin AS is_admin 
                    FROM users  
                    WHERE deleted = 0 AND status = 'Active' ";

                            $res3 = array();
                            $l=0; $n = 0;
                            $results3 = mysql_query($sql3, $connection);
                            while ($row3 = mysql_fetch_array($results3)) {
                            $res3[$l]['id']             = $row3['id'];
                            $res3[$l]['first_name']     = $row3['first_name'];
                            $res3[$l]['last_name']      = $row3['last_name'];
                            $res3[$l]['user_name']      = $row3['user_name'];
                            $res3[$l]['is_admin']       = $row3['is_admin'];

                            $l++;

                            }

                    mysql_close($connection);
                }

                $final_array = array();
                $final_array['users'] = $res3;

                if ($connected == 0) {   
                    $outputArrr = array();
                    $outputArrr['Android'] = "failed to connect to db";   
                    //echo (json_encode($outputArrr));
                    print_r(json_encode($outputArrr));

                } if($connected == 1) {
                    $outputArr = array();
                    $outputArr['Android'] = $final_array;   
                    //echo (json_encode($outputArr));
                    print_r(json_encode($outputArr)); 
        	  }

?>
