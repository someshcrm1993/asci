<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors','On');
global $db, $app_list_strings,$sugar_config;
 


echo $fullrecord_query    = "select id_c, programme_id_c as programme_id_c from project_cstm limit 0,2000";
echo "<br><pre> ";
$i=1;
	$fullrecord_result   = $db->query($fullrecord_query);
        while($getrecords = $db->fetchByAssoc($fullrecord_result))
        {
			
			echo $new_un_code=$getrecords['id_c'];echo "<br/>";
			echo $new_code=$getrecords['programme_id_c'];echo "<br/>";
            echo $getContact_id="select project_contacts_2contacts_idb from project_contacts_2_c where project_contacts_2project_ida like'".$new_un_code."%'";
			echo "<br/>";
			
			$getContact_id_result   = $db->query($getContact_id);
			while($getrecords2 = $db->fetchByAssoc($getContact_id_result))
			{
				print_r($getrecords2);
				if(!empty($getrecords2)){
				echo "<br>Total Updated Records : ".$i."<br>";echo "<br/>";
				echo "New Unique Code : ";
				//echo $new_un_code=$getrecords['programme_id_c'];echo "<br/>";
				echo "<br>";
				print_r($getrecords2);
			   echo    $update_query="UPDATE contacts_cstm SET programme_id_c ='".$new_code."'  WHERE id_c like '".$getrecords2['project_contacts_2contacts_idb']."%'";
				$updated_result   = $db->query($update_query);
				if($updated_result){
					echo "<br>Record Updated Successfully --->".$getrecords['id_c'];
					 $i++;
				}else{
					echo "<br>Record Not Updated Successfully --->".$getrecords['id_c'];
				}
				}
			}
			
			echo $getleads_id="select project_leads_1leads_idb from project_leads_1_c where project_leads_1project_ida like'".$new_un_code."%'";
			echo "<br/>";
			
			$getlead_id_result   = $db->query($getleads_id);
			while($getrecords3 = $db->fetchByAssoc($getlead_id_result))
			{
				print_r($getrecords3);
				if(!empty($getrecords3)){
				echo "<br>Total Updated Records : ".$i."<br>";echo "<br/>";
				echo "New Unique Code : ";
				//echo $new_un_code=$getrecords['programme_id_c'];echo "<br/>";
				echo "<br>";
				print_r($getrecords2);
			   echo    $update_query="UPDATE leads_cstm SET programme_id_c ='".$new_code."'  WHERE id_c like '".$getrecords3['project_leads_1leads_idb']."%'";
				$updated_result   = $db->query($update_query);
				if($updated_result){
					echo "<br>Record Updated Successfully --->".$getrecords['id_c'];
					 $i++;
				}else{
					echo "<br>Record Not Updated Successfully --->".$getrecords['id_c'];
				}
				}
			}
			
			
        }
        

        
        
       
?>