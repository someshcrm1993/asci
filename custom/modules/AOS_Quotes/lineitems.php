<?php
// ini_set('display_error',1);
// ini_set('display_startup_error',1);
// error_reporting(E_ALL);
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


    class lineitems
    {
        function relateList($bean, $event, $arguments)
        {
        	global $db,$current_user;
            // date_default_timezone_set('UTC');
           
            $invoiceID = $bean->aos_invoices_id_c;
            if($invoiceID){
                $db->query("update aos_invoices set currency_id = '$bean->currency_id',billing_account_id = '$bean->billing_account_id',billing_address_street = '$bean->billing_address_street',billing_address_city = '$bean->billing_address_city',billing_address_state = '$bean->billing_address_state',billing_address_postalcode = '$bean->billing_address_postalcode',billing_address_country = '$bean->billing_address_country',total_amt = '$bean->total_amt',discount_amount = '$bean->discount_amount',subtotal_amount = '$bean->subtotal_tax_amount',tax_amount = '$bean->tax_amount',total_amount = '$bean->total_amount' where id = '$invoiceID'");
                $db->query("update aos_invoices_cstm set place_of_supply_c = '$bean->place_of_supply_c',kind_attention_c = '$bean->kind_attention_c',client_type_c = '$bean->client_type_c',programme_fee_c = '$bean->programme_fee_c',programme_fee_non_res_c = '$bean->programme_fee_non_res_c',no_of_days_c = '$bean->no_of_days_c',minimum_no_participant_c = '$bean->minimum_no_participant_c',tax_type_c = '$bean->tax_type_c',client_gst1_c = '$bean->client_gst1_c',participant_c = '$bean->participant_c',cgst_c = '$bean->cgst_c',sgst_c = '$bean->sgst_c',ugst_c = '$bean->ugst_c',igst_c = '$bean->igst_c',adjustment_note_c = '$bean->adjustment_note_c',less_adjustments_c = '$bean->less_adjustments_c',discount_in_per_c = '$bean->discount_in_per_c',participant_list_c = '$bean->participant_list_c' where id_c = '$invoiceID'");

                $id = $invoiceID;
                $savedParticipantIds = array();
                $participant_list = json_decode(html_entity_decode($bean->participant_list_c));
                foreach($participant_list as $participant){
                    $participant_id[] = $participant->id;

                } 

               
                $participantid_query = $db->query("SELECT aos_invoices_contacts_1contacts_idb FROM aos_invoices_contacts_1_c WHERE aos_invoices_contacts_1aos_invoices_ida = '$id' and deleted = 0");
                while($participant_row = $db->fetchByAssoc($participantid_query)){
                    $savedParticipantIds[] = $participant_row['aos_invoices_contacts_1contacts_idb'];
                }
                foreach($participant_id as $pid){
                    if(!in_array($pid,$savedParticipantIds)){
                        $rec_id = create_guid();
                        $AOS_Invoices = BeanFactory::getBean('AOS_Invoices', $id);
                        $AOS_Invoices->load_relationship('aos_invoices_contacts_1');
                        $AOS_Invoices->aos_invoices_contacts_1->add($pid);
                    }
                }
                if(!empty($id)){
                    $diff_ids = array_diff($savedParticipantIds,$participant_id);
                    // print_r($diff_ids);print_r($savedParticipantIds);exit;
                    foreach($diff_ids as $delid){
                        $db->query("update aos_invoices_contacts_1_c set deleted = 1 where aos_invoices_contacts_1contacts_idb = '$delid'");
                    }
                }

                if(empty($participant_id)){
                    $db->query("update aos_invoices_contacts_1_c set deleted = 1 where aos_invoices_contacts_1aos_invoices_ida = '$id'");
                }
                
                // $db->query("update aos_invoices_cstm set proforma_stage_c = '$stage_c' where id_c = '$invoiceID'");
                // $invoiceBean = BeanFactory::getBean('AOS_Invoices', $invoiceID);
                // $invoiceBean->no_of_days_c = $bean->no_of_days_c;
                // $invoiceBean->billing_address_street = $bean->billing_address_street;
                // $invoiceBean->save();
            }

            $id = $bean->id;
            $savedParticipantIds = array();

            $participant_list = json_decode(html_entity_decode($bean->participant_list_c));
            foreach($participant_list as $participant){
                $participant_id[] = $participant->id;

            } 

            $participantid_query = $db->query("SELECT aos_quotes_contacts_1contacts_idb FROM aos_quotes_contacts_1_c WHERE aos_quotes_contacts_1aos_quotes_ida = '$id' and deleted = 0");
            while($participant_row = $db->fetchByAssoc($participantid_query)){
                $savedParticipantIds[] = $participant_row['aos_quotes_contacts_1contacts_idb'];
            }

            foreach($participant_id as $pid){

                if(!in_array($pid,$savedParticipantIds)){
                    $rec_id = create_guid();
                    $AOS_quotes = BeanFactory::getBean('AOS_Quotes', $id);
                    $AOS_quotes->load_relationship('aos_quotes_contacts_1');

                    $AOS_quotes->aos_quotes_contacts_1->add($pid);

                }
            }

            if(!empty($id)){
                $diff_ids = array_diff($savedParticipantIds,$participant_id);
                
                foreach($diff_ids as $delid){
                    $db->query("update aos_quotes_contacts_1_c set deleted = 1 where aos_quotes_contacts_1contacts_idb = '$delid'");
                }
            }

            if(empty($participant_id)){
                $db->query("update aos_quotes_contacts_1_c set deleted = 1 where aos_quotes_contacts_1aos_quotes_ida = '$id'");
            }
            // print_r($savedParticipantIds);
            // echo "<br>";
            // print_r($participant_id);exit;

        }
    }

?>
