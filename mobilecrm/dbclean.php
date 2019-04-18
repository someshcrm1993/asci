<?php
    //include '../db_home.php';
    include 'db.php';
	$prefix = "";
	$connection  = mysql_connect($mysql_hostname, $mysql_user, $mysql_password);

	if($connection){
        mysql_query ("set character_set_results='utf8'"); 
        $db_selected = mysql_select_db($mysql_database, $connection);

        $del1 = "DELETE accounts, accounts_cstm  FROM accounts  INNER JOIN accounts_cstm  
                 WHERE accounts.id = accounts_cstm.id_c and accounts.deleted = '1'";
        mysql_query($del1, $connection);
        $del2 = "DELETE FROM accounts WHERE deleted = '1'";
        mysql_query($del2, $connection);

        $del3 = "DELETE contacts, contacts_cstm  FROM contacts  INNER JOIN contacts_cstm  
                 WHERE contacts.id = contacts_cstm.id_c and contacts.deleted = '1'";
        mysql_query($del3, $connection);
        $del4 = "DELETE FROM contacts WHERE deleted = '1'";
        mysql_query($del4, $connection);

        $del5 = "DELETE opportunities, opportunities_cstm  FROM opportunities  INNER JOIN opportunities_cstm  
                 WHERE  opportunities.id = opportunities_cstm.id_c and opportunities.deleted = '1'";
        mysql_query($del5, $connection);
        $del6 = "DELETE FROM opportunities WHERE deleted = '1'";
        mysql_query($del6, $connection);

        $del7 = "DELETE leads, leads_cstm  FROM leads  INNER JOIN leads_cstm  
                 WHERE leads.id = leads_cstm.id_c and leads.deleted = '1'";
        mysql_query($del7, $connection);
        $del8 = "DELETE FROM leads WHERE deleted = '1'";
        mysql_query($del8, $connection);

        $del9 = "DELETE calls, calls_cstm  FROM calls  INNER JOIN calls_cstm  
                 WHERE calls.id = calls_cstm.id_c and calls.deleted = '1'";
        mysql_query($del9, $connection);
        $del10 = "DELETE FROM calls WHERE deleted = '1'";
        mysql_query($del10, $connection);

        $del11 = "DELETE meetings, meetings_cstm  FROM meetings  INNER JOIN meetings_cstm  
                  WHERE meetings.id = meetings_cstm.id_c and meetings.deleted = '1'";
        mysql_query($del11, $connection);
        $del12 = "DELETE FROM meetings WHERE deleted = '1'";
        mysql_query($del12, $connection);

        $del13 = "DELETE tasks, tasks_cstm  FROM tasks  INNER JOIN tasks_cstm  
                  WHERE tasks.id = tasks_cstm.id_c and tasks.deleted = '1'";
        mysql_query($del13, $connection);
        $del14 = "DELETE FROM tasks WHERE deleted = '1'";
        mysql_query($del14, $connection);

        $del15 = "DELETE FROM users WHERE deleted = 1";
        mysql_query($del15, $connection);

        $del16 = "DELETE FROM email_addr_bean_rel WHERE deleted = 1";
        mysql_query($del16, $connection);

        $del17 = "DELETE FROM email_addresses WHERE deleted = 1";
        mysql_query($del17, $connection);

        $del18 = "DELETE FROM accounts_contacts WHERE deleted = 1";
        mysql_query($del18, $connection);

        $del19 = "DELETE FROM accounts_opportunities WHERE deleted = 1";
        mysql_query($del19, $connection);


        mysql_close($connection);
	}

        // return to parent file
        // return;
        // return true;

?>
