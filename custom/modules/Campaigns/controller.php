<?php

// By : Rathina Ganesh
// Date : 16th September 2017

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class CampaignsController extends SugarController
{
    function action_printMailingLabel()
    {
        global $sugar_config;
        $campaignBean = BeanFactory::getBean('Campaigns',$_REQUEST['record']);
        $prospectlistsBean = $campaignBean->get_linked_beans('prospectlists');
        $data = array();
        foreach ($prospectlistsBean as $prospectlistsBeankey => $prospectlistsBeanvalue) {
            $prospectListBean = BeanFactory::getBean('ProspectLists',$prospectlistsBeanvalue->id);
            $prospects = $prospectListBean->get_linked_beans('prospects');
            $contacts = $prospectListBean->get_linked_beans('contacts');
            $leads = $prospectListBean->get_linked_beans('leads');
            $accounts = $prospectListBean->get_linked_beans('accounts');
            $i=0;

            foreach ($prospects as $prospectskey => $prospectsvalue) {
                $data['prospects'][$i]['Orgname'] = '';
                $data['prospects'][$i]['name'] = $prospectsvalue->salutation." ".$prospectsvalue->first_name." ".$prospectsvalue->last_name;
                $data['prospects'][$i]['designation'] = $prospectsvalue->title;

                $data['prospects'][$i]['street'] = $prospectsvalue->primary_address_street;
                $data['prospects'][$i]['city'] = $prospectsvalue->primary_address_city;
                $data['prospects'][$i]['postal_code'] = $prospectsvalue->primary_address_postalcode;
                $data['prospects'][$i]['state'] = $prospectsvalue->primary_address_state;
                $data['prospects'][$i]['country'] = $prospectsvalue->primary_address_country;                 
                $data['prospects'][$i]['mobile'] = $prospectsvalue->phone_mobile;
                $data['prospects'][$i]['mobile1'] = $prospectsvalue->phone_work;
                $data['prospects'][$i]['mobile2'] = '';
                $data['prospects'][$i]['mobile3'] = '';
                $i++;
            }

            $i=0;
            foreach ($contacts as $contactskey => $contactsvalue) {
                $data['contacts'][$i]['Orgname'] = $contactsvalue->account_name;
                $data['contacts'][$i]['name'] = $contactsvalue->salutation." ".$contactsvalue->first_name." ".$contactsvalue->last_name;
                $data['contacts'][$i]['designation'] = $contactsvalue->designation_c;
                $data['contacts'][$i]['street'] = $contactsvalue->primary_address_street;
                $data['contacts'][$i]['city'] = $contactsvalue->primary_address_city;
                $data['contacts'][$i]['postal_code'] = $contactsvalue->primary_address_postalcode;
                $data['contacts'][$i]['state'] = $contactsvalue->primary_address_state;
                $data['contacts'][$i]['country'] = $contactsvalue->primary_address_country;                
                $data['contacts'][$i]['mobile'] = $contactsvalue->phone_mobile;
                $data['contacts'][$i]['mobile1'] = $contactsvalue->alternate_phone_c;
                $data['contacts'][$i]['mobile2'] = '';
                $data['contacts'][$i]['mobile3'] = '';
                $i++;
            }
            $i=0;
            foreach ($leads as $leadskey => $leadsvalue) {
                $data['leads'][$i]['Orgname'] = $leadsvalue->accounts_leads_1_name;
                $data['leads'][$i]['name'] = $leadsvalue->salutation." ".$leadsvalue->first_name." ".$leadsvalue->last_name;
                $data['leads'][$i]['designation'] = $leadsvalue->title;
                
                $data['leads'][$i]['postal_code'] = $leadsvalue->primary_address_postalcode;
                $data['leads'][$i]['street'] = $leadsvalue->primary_address_street;
                $data['leads'][$i]['city'] = $leadsvalue->primary_address_city;
                $data['leads'][$i]['state'] = $leadsvalue->primary_address_state;
                $data['leads'][$i]['country'] = $leadsvalue->primary_address_country;
                $data['leads'][$i]['mobile'] = $leadsvalue->phone_mobile;
                $data['leads'][$i]['mobile1'] = $leadsvalue->phone_work;
                $data['leads'][$i]['mobile2'] = '';
                $data['leads'][$i]['mobile3'] = '';
                $i++;
            }
            $i=0;
            foreach ($accounts as $accountskey => $accountsvalue) {
                $data['accounts'][$i]['Orgname'] = $accountsvalue->name;
                $data['accounts'][$i]['name'] = $accountsvalue->salutation1_c." ".$accountsvalue->name_of_sponsor_c;
                $data['accounts'][$i]['designation'] = $accountsvalue->designation_c;
                $data['accounts'][$i]['street'] = $accountsvalue->billing_address_street;
                $data['accounts'][$i]['city'] = $accountsvalue->billing_address_city;
                $data['accounts'][$i]['postal_code'] = $accountsvalue->billing_address_postalcode;
                $data['accounts'][$i]['state'] = $accountsvalue->billing_address_state;
                $data['accounts'][$i]['country'] = $accountsvalue->billing_address_country;                
                $data['accounts'][$i]['mobile'] = $accountsvalue->phone_office;
                $data['accounts'][$i]['mobile1'] = $accountsvalue->phone_alternate;
                $data['accounts'][$i]['mobile2'] = $accountsvalue->alternative_phone_c;
                $data['accounts'][$i]['mobile3'] = $accountsvalue->alternative_phone_c;
                $i++;
            }
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
        include 'print_mailing_label.php';
    }
}

?> 
