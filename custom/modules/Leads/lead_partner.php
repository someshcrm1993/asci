<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class Lead_Partner 
{

    function lead_id_partner($bean, $event, $arguments)
    {

        global $db;
	$id = $bean->id;


//~ echo('Hi');
//~ exit;
#if ($arguments['related_module']=='Accounts'){
# $query111 = "UPDATE leads SET description = 'rtyrtyrt' where id='$id'  ";
#					$result111 =$db->query($query111);
#};


		global $db;
		$id = $bean->id;
        $status = $bean->status;
        $created_by = $bean->created_by;
        $scrm_partners_leads_1scrm_partners_ida = $bean->scrm_partners_leads_1scrm_partners_ida;


        $scrm_partner_contacts_leadsscrm_partner_contacts_ida = $bean->scrm_partner_contacts_leadsscrm_partner_contacts_ida;



        // $GLOBALS['log']->fatal("Created by".$created_by);

//if($created_by != '4d9a13f4-4a55-5c22-a39e-550acaa2ce1a' && $status =='New' ){

		//if($created_by != '830e9896-9c40-7a82-9bae-5544ce763b3d' && $status =='New' ){
		//~ if($created_by != 'c95e8d4d-f0fc-94dd-73a0-571f41a1a617' && $status =='New' ){
		if($created_by != 'db8f20f4-53df-7915-5af3-570fa32c74a3' && $status =='New' ){
        // $GLOBALS['log']->fatal("inside CRM");

			if(isset($scrm_partners_leads_1scrm_partners_ida)){
		
				    $query = "UPDATE leads_cstm  as lc 
								join scrm_partners_leads_1_c as spl 
								on spl.scrm_partners_leads_1leads_idb = lc.id_c 
								join scrm_partners as sp
								on sp.id=spl.scrm_partners_leads_1scrm_partners_ida
								SET lc.partner_status_c = 'In_Review'  where lc.id_c ='$id'";
					$result =$db->query($query);

				
			}

			if($scrm_partners_leads_1scrm_partners_ida==''){
                    $query = "UPDATE leads_cstm SET partner_status_c = ''  where id_c ='$id'";
					$result =$db->query($query);
			}

		}	

		//~ if($created_by == '773007c7-165c-6d18-e804-571b642e28e3' && $status =='New' ){
		//~ if($created_by == 'c95e8d4d-f0fc-94dd-73a0-571f41a1a617' && $status =='New' ){
		if($created_by == 'db8f20f4-53df-7915-5af3-570fa32c74a3' && $status =='New' ){
 	// $GLOBALS['log']->fatal("inside portal");
			//~ if(isset($scrm_partners_leads_1scrm_partners_ida)){
//~ 
				    //~ $query = "UPDATE leads_cstm  as lc 
								//~ join scrm_partners_leads_1_c as spl 
								//~ on spl.scrm_partners_leads_1leads_idb = lc.id_c 
								//~ join scrm_partners as sp
								//~ on sp.id=spl.scrm_partners_leads_1scrm_partners_ida
								//~ SET lc.partner_c = sp.name where lc.id_c ='$id'";
					//~ $result =$db->query($query);
			//~ }
//~ 
			//~ if($scrm_partners_leads_1scrm_partners_ida==''){
						        //~ $query = "UPDATE leads_cstm SET  partner_c ='' where id_c ='$id'";
								//~ $result =$db->query($query);
			//~ }
		}
	



    }
}
?>
