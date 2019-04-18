<?php

if(!defined('sugarEntry')) define('sugarEntry', true);
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


require_once('include/entryPoint.php');

class CasesController extends SugarController{

	      public function action_create_records (){

			global $sugar_config; 
			global $db;

		        $module             = $_REQUEST['module'];
		        $action             = $_REQUEST['action'];
		        $to_pdf             = $_REQUEST['to_pdf'];
		        $case_name          = $_REQUEST['case_name'];
		        $priority           = $_REQUEST['priority'];
		        $twitter_handle_c   = $_REQUEST['twitter_handle_c'];
		        $description        = $_REQUEST['description'];
		        $case_status        = $_REQUEST['case_status'];	
                        $status_id          = $_REQUEST['status_id'];
                        $account_id         = $_REQUEST['account_id'];

                $GLOBALS['log']->fatal('Controller Description : '.$description);

		$case = new aCase();

		$case->name                    = $case_name;
		$case->status                  = $case_status;
		$case->description             = $description;  
		$case->tweet_id_c              = $status_id; 
		$case->twitter_handle_c        = $twitter_handle_c; 
		$case->priority                = $priority;
		$case->account_id              = $account_id;  
		  	   

		$query1  =   "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
		$value1  =   $db->query($query1);
		$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

		if(!$check1){
		$case->save();	
		$created = "y";
		}
		if($check1){
		$created = "n";
		}

		$sql = "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
		$result = $db->query($sql);

		if($row6 = $db->fetchByAssoc($result)){

		   $id_c = $row6['id_c'];                    
		}
                        $data2= array();
                        $data2['id_c']                = $id_c;
                        $data2['created']             = $created;
                       
			echo json_encode($data2);

              }    

function action_get_fb_data(){
      

global $db;  
  
//$dln = $_GET['dln'];

//$this->view_object_map['dln'] = $dln;  

//$this->view='response';

$recordId= $_REQUEST['recordId']; 
                
$selcect_value="SELECT * FROM cases, cases_cstm WHERE id=id_c  AND id='$recordId' AND deleted=0";
		$get_values_res=$db->query($selcect_value);			
		if($get_values_row=$db->fetchByAssoc($get_values_res))
		{
			$id                   = $get_values_row['id'];
			$case_name            = $get_values_row['name'];
			$case_source          = $get_values_row['source_c'];
			$posted_message_id    = $get_values_row['posted_message_id_c'];			
                        $post_from_id         = $get_values_row['post_from_id_c'];			
                        $post_from_first_name = $get_values_row['post_from_first_name_c']; 
			$post_from_last_name  = $get_values_row['post_from_last_name_c'];			

 
		}


		$data= array(); 

		$data['case_name']                = $case_name;
		$data['case_id']                  = $recordId;
		$data['case_source']              = $case_source;		
                $data['posted_message_id']        = $posted_message_id;
                $data['post_from_id']             = $post_from_id;
                $data['post_from_first_name']     = $post_from_first_name;
                $data['post_from_last_name']      = $post_from_last_name;

		echo json_encode($data);

         
}



} 
