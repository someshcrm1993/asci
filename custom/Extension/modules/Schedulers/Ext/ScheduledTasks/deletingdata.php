<?php
    $job_strings[]='deletingdata';
    function deletingdata()
    {
		require_once('include/entryPoint.php');
		$db = DBManagerFactory::getInstance();
		$query_account = "SELECT id,actual_support_hours_c,purchased_support_hours_c FROM accounts,accounts_cstm where id = id_c and deleted=0";//it will select the id,Actual Support hours and Purchased Supported Hours
		$result_account = $db->query($query_account);
		while($row_result = $db->fetchByAssoc($result_account))
		{
			$id = $row_result['id'];//account id
			$actual_hours = $row_result['actual_support_hours_c'];//Actual Support Hours
			$purchased_hours = $row_result['purchased_support_hours_c'];//Purchased Support Hours
			$remaining_hours = $purchased_hours - $actual_hours;//Remaining Hours
			$update_query = "UPDATE accounts_cstm SET remaining_hours_c='$remaining_hours' WHERE id_c = '".$id."'";//Updating the Remaining Hours difference to Acccounts
			$result_update_query = $db->query($update_query);
		}
		return true;
		
	}
?>
