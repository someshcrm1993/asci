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
        $sql2 = "SELECT IFNULL( op.id, '' ) AS id, IFNULL( op.name, '' ) AS name,
        IFNULL( op.amount, '' ) AS amount, IFNULL( op.description, '' ) AS description,
        IFNULL( op.assigned_user_id, '' ) AS assigned_user_id,
        IFNULL( u.user_name, '' ) AS user_name, CONCAT( IFNULL( u.first_name, '' ) , ' ',
        IFNULL( u.last_name, '' ) ) AS assigned_user_name,
        IFNULL( op.sales_stage, '' ) AS sales_stage,
        IFNULL( op.date_closed, '' ) AS date_closed,
        IFNULL( op.opportunity_type, '' ) AS opportunity_type,
        IFNULL( op.next_step, '' ) AS next_step,
        IFNULL( op.amount, '' ) AS amount,
        IFNULL( op.currency_id, '' ) AS currency_id,
        IFNULL(ao.account_id, '' ) AS account_id,
        IFNULL(aa.name, '' ) AS account_name,
        IFNULL( opc.opportunity_attachments_c, '' ) AS opportunityAttachments,
        IFNULL( opc.opportunity_documents_c, '' ) AS opportunityDocumentLinks,

        op.date_entered as date_entered,
        op.date_modified as date_modified

        FROM opportunities AS op
        LEFT JOIN opportunities_cstm AS opc ON op.id = opc.id_c
        LEFT JOIN accounts_opportunities AS ao ON ao.opportunity_id = op.id
        LEFT JOIN accounts AS aa ON ao.account_id = aa.id
        LEFT JOIN users AS u ON op.assigned_user_id = u.id

    WHERE op.assigned_user_id = '$assigned_user_id' AND op.date_modified >=  '$date_modified_sugar_format_sync' order by op.date_modified DESC";

            $currency_name ="";
            $res2 = array();
            $j=0;
            $results2 = mysql_query($sql2, $connection);
            while ($row2 = mysql_fetch_array($results2)) {

                $res2[$j]['id']                           = $row2['id'];
                $res2[$j]['name']                         = $row2['name'];
                $res2[$j]['amount']                       = $row2['amount'];
                $res2[$j]['assigned_user_id']             = $row2['assigned_user_id'];
                $res2[$j]['assigned_user_name']           = $row2['assigned_user_name'];
                $res2[$j]['description']                  = $row2['description'];
                $res2[$j]['date_entered']                 = $row2['date_entered'];
                $res2[$j]['date_modified']                = $row2['date_modified'];
                $res2[$j]['sales_stage']                  = $row2['sales_stage'];
                $res2[$j]['date_closed']                  = $row2['date_closed'];
                $res2[$j]['opportunity_type']             = $row2['opportunity_type'];
                $res2[$j]['next_step']                    = $row2['next_step'];
                $res2[$j]['amount']                       = $row2['amount'];
                $res2[$j]['account_id']                   = $row2['account_id'];
                $res2[$j]['account_name']                 = $row2['account_name'];
                $res2[$j]['opportunityAttachments']       = $row2['opportunityAttachments'];
                $res2[$j]['opportunityDocumentLinks']     = $row2['opportunityDocumentLinks'];


                if ($row2['currency_id'] == '-99') {
                   $currency_name = "US Dollar : $";
                }if ($row2['currency_id'] == 'a96df56d-bb30-a59f-47ea-56e7ff5d9c31') {
                   $currency_name = "Rupees : ₹";
                }if ($row2['currency_id'] == 'e0f20181-2612-661f-c6a9-578346cd8986') {
                   $currency_name = "Singapore : $";
                }
                $res2[$j]['currency_name']   = $currency_name;

                $j++;

            }
    }

            mysql_close($connection);

            $final_array = array();
            $final_array['opportunities'] = $res2;

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
