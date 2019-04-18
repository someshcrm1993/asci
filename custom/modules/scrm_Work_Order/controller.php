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

class scrm_Work_OrderController extends SugarController{
    public function pre_editview()
        {
        //IF we have a prospect id leads convert it to a lead
        if (empty($this->bean->id) && !empty($_REQUEST['return_module']) &&$_REQUEST['return_module'] == 'Opportunities' ) {
 
            $opportunity = BeanFactory::newBean('Opportunities');
            $opportunity->retrieve($_REQUEST['return_id']);
            
            if ($opportunity->deleted == 0){
	            $this->bean->accounts_scrm_work_order_1_name = $opportunity->account_name;
	            $this->bean->accounts_scrm_work_order_1accounts_ida = $opportunity->account_id;
	            $this->bean->utilisation_cert_req_c = $opportunity->utilisation_cert_req_c;
	            $this->bean->lead_fac_1_centre_c = $opportunity->lead_fac_1_centre_c;
	            $this->bean->lead_fac_2_centre_c = $opportunity->lead_fac_2_centre_c;
	            $this->bean->lead_faculty_2_c = $opportunity->lead_faculty_2_c;
	            $this->bean->lead_faculty_1_c = $opportunity->lead_faculty_1_c;
	            $this->bean->scrm_partners_id_c = $opportunity->scrm_partners_id_c;
	            $this->bean->scrm_partners_id1_c = $opportunity->scrm_partners_id1_c;
	            $this->bean->ais_convertedccounts_scrm_work_order_1accounts_ida = $opportunity->accounts_opportunities_1accounts_ida;
	            $this->bean->project_scrm_work_order_1project_ida = $opportunity->project_opportunities_1project_ida;
	            $this->bean->proposal_id_c = $opportunity->proposal_id_c;
	            $this->bean->scrm_work_order_opportunities_1_name = $opportunity->name;
	            $this->bean->scrm_work_order_opportunities_1opportunities_idb = $opportunity->id;
	            $this->bean->client_work_order_date_c = $opportunity->client_rpf_date_c;
	            $this->bean->client_work_order_reference_c = $opportunity->client_rpf_ref_number_c;
	            $this->bean->sp_total_expected_revenue_c = $opportunity->total_expected_revenue_c;
	            $this->bean->asci_rpf_reference_c = $opportunity->asci_rpf_reference_c;
	        }

            $_POST['is_converted']=true;
        }

        return true;
    }

 	function action_editview(){
		$this->view = 'edit';
		return true;
	}

}

?>
