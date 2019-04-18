<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM standard edition is an extension to SuiteCRM 7.8.5 and SugarCRM Community Edition 6.5.24. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


require_once('include/MVC/View/views/view.edit.php');

class scrm_Payment_DetailsViewEdit extends ViewEdit {

	public $useForSubpanel = true;
    function scrm_Payment_DetailsViewEdit(){
        parent::ViewEdit();
    }

    function display(){
        
        global $sugar_config;
	//Added by Rathina Ganesh on 4th Dec 2017
        if(empty($this->bean->id) && !empty($_REQUEST['aos_invoices_id'])){
	        $invoiceBean = BeanFactory::getBean('AOS_Invoices',$_REQUEST['aos_invoices_id']);
		    $this->bean->invoice_date_c = $invoiceBean->invoice_date;
		    $this->bean->programme_type_c = $invoiceBean->programme_type_c;
		    $this->bean->invoice_number_c = $invoiceBean->number;
		    $this->bean->accounts_scrm_payment_details_1_name = $invoiceBean->billing_account;
		    $this->bean->accounts_scrm_payment_details_1accounts_ida = $invoiceBean->billing_account_id;
		    $this->bean->client_gst_number_c = $invoiceBean->client_gst1_c;
		    $this->bean->project_scrm_payment_details_1_name = $invoiceBean->project_aos_invoices_1_name;
		    $this->bean->project_scrm_payment_details_1project_ida = $invoiceBean->project_aos_invoices_1project_ida;
		    $projectBean = BeanFactory::getBean('Project',$invoiceBean->project_aos_invoices_1project_ida);
		    $this->bean->name = $projectBean->programme_id_c;
	    }
	    parent::display();
    }

}
