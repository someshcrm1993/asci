<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
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

class AOS_InvoicesViewEdit extends ViewEdit {
	function AOS_InvoicesViewEdit(){
 		parent::ViewEdit();
 	}
	
	function display(){

		$this->ss->assign('id',$this->bean->id);
		$this->ss->assign('view','EditView');
		$this->populateInvoiceTemplates();
		

		if (isset($_REQUEST['proforma_invoice_id']) && $_REQUEST['proforma_invoice_id']) {
			$proforma_invoice_bean = BeanFactory::getBean('AOS_Quotes', $_REQUEST['proforma_invoice_id']);
			// print_r($proforma_invoice_bean->currency_id);exit();
			if ($proforma_invoice_bean) {
				$this->bean->name = $proforma_invoice_bean->name;
				$this->bean->aos_quotes_id_c = $_REQUEST['proforma_invoice_id'];
				$this->bean->proforma_invoice_c = $proforma_invoice_bean->name;
				$this->bean->regd_no_c = $proforma_invoice_bean->regd_no_c;
				$this->bean->due_date = $proforma_invoice_bean->expiration;
				$this->bean->pan_c = $proforma_invoice_bean->pan_c;
				$this->bean->assigned_user_name = $proforma_invoice_bean->assigned_user_name;
				$this->bean->kind_attention_c = $proforma_invoice_bean->kind_attention_c;
				$this->bean->description = $proforma_invoice_bean->description;
				$this->bean->currency_id = $proforma_invoice_bean->currency_id;
				$this->bean->programme_type_c = $proforma_invoice_bean->programme_type_c;
				$this->bean->project_aos_invoices_1_name = $proforma_invoice_bean->project_aos_quotes_1_name;
				$this->bean->project_aos_invoices_1project_ida = $proforma_invoice_bean->project_aos_quotes_1project_ida;
				$this->bean->programme_fee_c = $proforma_invoice_bean->programme_fee_c;
				$this->bean->programme_fee_non_res_c = $proforma_invoice_bean->programme_fee_non_res_c;
				$this->bean->invoice_type_c = $proforma_invoice_bean->invoice_type_c;
				$this->bean->billing_account = $proforma_invoice_bean->billing_account;
				$this->bean->billing_account_id = $proforma_invoice_bean->billing_account_id;
				$this->bean->tax_type_c = $proforma_invoice_bean->tax_type_c;
				$this->bean->billing_address_street = $proforma_invoice_bean->billing_address_street;
				$this->bean->billing_address_city = $proforma_invoice_bean->billing_address_city;
				$this->bean->billing_address_state = $proforma_invoice_bean->billing_address_state;
				$this->bean->billing_address_postalcode = $proforma_invoice_bean->billing_address_postalcode;
				$this->bean->billing_address_country = $proforma_invoice_bean->billing_address_country;
				$this->bean->participant_c = $proforma_invoice_bean->participant_c;
				$this->bean->participant_list_c = $proforma_invoice_bean->participant_list_c;
				$this->bean->total_amt = $proforma_invoice_bean->total_amt;
				$this->bean->discount_in_per_c = $proforma_invoice_bean->discount_in_per_c;
				$this->bean->discount_amount = $proforma_invoice_bean->discount_amount;
				$this->bean->subtotal_amount = $proforma_invoice_bean->subtotal_tax_amount;
				$this->bean->igst_c = $proforma_invoice_bean->igst_c;
				$this->bean->cgst_c = $proforma_invoice_bean->cgst_c;
				$this->bean->sgst_c = $proforma_invoice_bean->sgst_c;
				$this->bean->ugst_c = $proforma_invoice_bean->ugst_c;
				$this->bean->less_adjustments_c = $proforma_invoice_bean->less_adjustments_c;
				$this->bean->place_of_supply_c = $proforma_invoice_bean->place_of_supply_c;
				$this->bean->no_of_participants_c = $proforma_invoice_bean->no_of_participants_c;
				$this->bean->total_amount = $proforma_invoice_bean->total_amount;
				$this->bean->tax_amount = $proforma_invoice_bean->tax_amount;
				$this->bean->billing_account_id = $proforma_invoice_bean->billing_account_id;
				$this->bean->no_of_days_c = $proforma_invoice_bean->no_of_days_c;
	       		$this->bean->minimum_no_participant_c = $proforma_invoice_bean->minimum_no_participant_c;
	       		$this->bean->self_sponsored_c = $proforma_invoice_bean->self_sponsored_c;
	       		$this->bean->self_sponsor_c = $proforma_invoice_bean->self_sponsor_c;
	       		$this->bean->contact_id_c = $proforma_invoice_bean->contact_id_c;
	       		$this->bean->entry_1_c = $proforma_invoice_bean->entry_1_c;
	       		$this->bean->entry_2_c = $proforma_invoice_bean->entry_2_c;
	       		$this->bean->entry_3_c = $proforma_invoice_bean->entry_3_c;
	       		$this->bean->amount_1_c = $proforma_invoice_bean->amount_1_c;
	       		$this->bean->amount_2_c = $proforma_invoice_bean->amount_2_c;
	       		$this->bean->amount_3_c = $proforma_invoice_bean->amount_3_c;
	       		$this->bean->tax_payable_c = $proforma_invoice_bean->tax_payable_c;
	       		$this->bean->adjustment_note_c = $proforma_invoice_bean->adjustment_note_c;
	       		$this->bean->special_note_c = $proforma_invoice_bean->special_note_c;
	       		$this->bean->note_c = $proforma_invoice_bean->note_c;
	       		$this->bean->bank_c = $proforma_invoice_bean->bank_c;
				if ($proforma_invoice_bean->billing_account_id) {
					$accountBean = BeanFactory::getBean('Accounts',$this->bean->billing_account_id);
					$this->bean->client_gst1_c = $accountBean->client1_gst_c;
				}
				
				echo <<<EOD
						<script>
						$(document).ready(function(){
								setTimeout(function(){
										$('#currency_id_select').val('{$proforma_invoice_bean->currency_id}');
										$('#client_type_c').val('{$proforma_invoice_bean->client_type_c}');
										$('#currency_id_select').trigger('change');
										$('input[type=text]').each(function(){
											$(this).val($(this).val().replace(',',''));
										});
								}, 2500);
						});
						</script>
EOD;
				// print_r($proforma_invoice_bean);exit();
			}
		}

		if ($this->bean->billing_account_id) {
			$accountBean = BeanFactory::getBean('Accounts',$this->bean->billing_account_id);
			$this->bean->client_gst1_c = $accountBean->client1_gst_c;
		}

		if(empty($this->bean->id) && !empty($_REQUEST['project_aos_invoices_1project_ida'])){
			$programme = BeanFactory::getBean('Project',$_REQUEST['project_aos_invoices_1project_ida']);
	        $this->bean->programme_type_c = $programme->programme_type_c;
	        $this->bean->programme_fee_c = $programme->programme_fee_c;
	        $this->bean->programme_fee_non_res_c = $programme->programme_fee_non_res_c;
	        $this->bean->name = $programme->programme_id_c;
	        $this->bean->no_of_days_c = $programme->no_of_days_c;
	        $this->bean->minimum_no_participant_c = $programme->no_of_participants_c;
	        $this->bean->status = '';
	    }else{
	    	$programme = BeanFactory::getBean('Project',$this->bean->project_aos_invoices_1project_ida);
	    }

	    if ($programme) {
		    $nominationList = $programme->get_linked_beans('project_contacts_2');
		    $invoicedOrganisation = $programme->get_linked_beans('project_aos_invoices_1');
	    }else{
	    	$nominationList = array();
	    	$invoicedOrganisation = array();
	    }
	    
	    // $nominationList = $programme->get_linked_beans('project_contacts_2');
	    // $invoicedOrganisation = $programme->get_linked_beans('project_aos_invoices_1');
	    foreach($invoicedOrganisation as $value){
	    	if($value->stage_c != 'Cancelled'){
	    		$invoiced[$value->billing_account_id] = $value->billing_account;
	    	}
	    }
	    $invoiced = array_unique($invoiced);
	    $gst = array();
	    foreach($nominationList as $value){
	    	if(!empty($value->sponsor_organisation_c))
	    	$organisations[$value->account_id_c] = $value->sponsor_organisation_c;
	    	$bean = BeanFactory::getBean('Accounts', $value->account_id_c);
	    	$gst[$value->account_id_c] = $bean->client_gst1_c;
	    }

	    if(empty($this->bean->id)){
		    $organisationList = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Organisation Name</th><th>Invoice Status</th> </tr> </thead> <tbody style="text-align:center !important">';
	            foreach ($organisations as $organisationsId => $organisationName) {
	                if(isset($invoiced[$organisationsId])){
	                    $organisationList .= '<tr><td>'.$organisationName.'</td><td><span class="label label-success">Invoiced</span></td></tr>'; 
	                }else{
	                    $organisationList .= '<tr><td><a onclick="sendValues(\''.$organisationsId.'\',\''.str_replace("'", '', $organisationName).'\',\''.$gst[$organisationsId].'\');" data-name="'.$organisationName.'"  data-id ="'.$organisationsId.'" class="organisation">'.$organisationName.'</a></td><td><span class="label label-info">Not Invoiced</span></td></tr>'; 
	                }
	                
	        }
	        $organisationList .='</tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>';
	        echo $organisationList;
	       }else{
			    $organisationList = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Organisation Name</th><th>Invoice Status</th> </tr> </thead> <tbody style="text-align:center !important">';
		            foreach ($organisations as $organisationsId => $organisationName) {
		                    $organisationList .= '<tr><td><a onclick="sendValues(\''.$organisationsId.'\',\''.str_replace("'", '', $organisationName).'\',\''.$gst[$organisationsId].'\');" data-name="'.$organisationName.'"  data-id ="'.$organisationsId.'" class="organisation">'.$organisationName.'</a></td><td><span class="label label-info">Not Invoiced</span></td></tr>'; 
		                
		        }
		        $organisationList .='</tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>';
		        echo $organisationList;
	       }
        global $current_user;

		$role = ACLRole::getUserRoleNames($current_user->id);
		if (count($role)>0 && isset($role[0])) {
		    $role = $role[0];
		}else{
			//role is admin
		    $role = 'admin';
		}

		if($this->bean->stage_c == 'Closed for updates'){
			$params = array(
			  'module'=> 'AOS_Invoices',
			  'action'=>'DetailView', 
			  'record' => $this->bean->id,
			  'message' => 'You may not be authorized to edit the tax invoice, since it is closed for updates'
			);
			SugarApplication::redirect('index.php?' . http_build_query($params));
		}

		if($this->bean->stage_c != 'Draft-Tax Invoice' && $current_user->id == '6c318d02-f7eb-2ffc-0f0c-5943b3347c07'){
			$params = array(
			  'module'=> 'AOS_Invoices',
			  'action'=>'DetailView', 
			  'record' => $this->bean->id,
			  'message' => 'You may not be authorized to edit the tax invoice'
			);
			SugarApplication::redirect('index.php?' . http_build_query($params));
		}
		
		$discount = 2;
		if (isset($_REQUEST['project_aos_invoices_1project_ida'])) {
			$projectBean = BeanFactory::getBean('Project',$_REQUEST['project_aos_invoices_1project_ida']);

			if (strtotime(date('Y-m-d')) <= strtotime($projectBean->ebd_date_c)) {
				$discount = 3;
			}
		}

		echo <<<EOD
		<script>
		function sendValues(id,name, gst){
			$('#billing_account').val(name);
			$('#billing_account_id').val(id);
			$('#client_gst1_c').val(gst);
			$('#myModal').modal('toggle');
		}

			$(document).ready(function(){

				$("#stage_c option[value='Draft-Tax Invoice']").attr('disabled','disabled');
				$("#stage_c option[value='FO Approved']").attr('disabled','disabled');
				$("#stage_c option[value='Cancelled']").attr('disabled','disabled');
				$("#stage_c option[value='Closed for updates']").attr('disabled','disabled');
				if('{$current_user->id}' == '6c318d02-f7eb-2ffc-0f0c-5943b3347c07'){
					$("#stage_c option[value='Draft-Tax Invoice']").attr('disabled',false);
				}

				if('{$current_user->id}' == 'f2bafd26-a815-327b-d7ee-59d904200bc6'){
					$("#stage_c option[value='Draft-Tax Invoice']").attr('disabled',false);
					$("#stage_c option[value='FO Approved']").attr('disabled',false);
					$("#stage_c option[value='Cancelled']").attr('disabled',false);
					$("#stage_c option[value='Closed for updates']").attr('disabled',false);
				}

				if($('#special_note_c').val() == 'No'){
					$('#note_c').parent().parent().hide();
				}else{
					$('#note_c').parent().parent().show();
				}
				$('#special_note_c').on('change',function(){
					if($('#special_note_c').val() == 'No'){
						$('#note_c').parent().parent().hide();
					}else{
						$('#note_c').parent().parent().show();
					}
				});
				$('#subtotal_amount').attr('readonly',true);
				$('#cgst_c').attr('readonly',true);
				$('#sgst_c').attr('readonly',true);
				$('#igst_c').attr('readonly',true);
				$('#ugst_c').attr('readonly',true);
				$('#tax_amount').attr('readonly',true);
				$('#total_amt').attr('readonly',true);
				$('input[type=text]').each(function(){
						$(this).val($(this).val().replace(',',''));
					});
                $('#SAVE_HEADER').click(function(){
                    $(this).attr('disabled', true);

                    setTimeout(function(){
                        $('#SAVE_HEADER').attr('disabled', false);
                    },5000);
                });

				paymentStatus();
				$(document).on('change','#status',function(){
					paymentStatus();
				});

				function paymentStatus(){
					if($('#status').val() == 'Refund'){
						$('#detailpanel_2').show();
					}else{
						$('#detailpanel_2').hide();
					}					
				}


				$('#btn_billing_account').after('<button type="button" id="org" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><img src="themes/default/images/id-ff-select.png"></button> ');

				$('#btn_billing_account').hide();

				$('#project_aos_invoices_1_name_label').append('<span class="required">*</span>');
				addToValidate('EditView','project_aos_invoices_1_name','project_aos_invoices_1_name',true,'Programme Title');
				if($('#status').val() == 'PartiallyPaid' || $('#status').val() == 'Paid'){
					$('#payment_mode_c_label').parent().show();
				}else{
					$('#payment_mode_c_label').parent().hide();
				}
				$('#status').on('change',function(){
					if($('#status').val() == 'PartiallyPaid' || $('#status').val() == 'Paid'){
						$('#payment_mode_c_label').parent().show();
					}else{
						$('#payment_mode_c_label').parent().hide();
					}
				})
				if('$role' == 'FO'){
					//FO();	
				}
				if('$role' != 'FO'){
					$('#fo_approval_c').attr('disabled',true);	
				}
				
				if('$role' != 'PO(M1,M2,M3)' && '$role' != 'PO'){
					PO();	
				}

				function FO(){
					$('#due_date_trigger').hide();					
					$("#EditView :input").prop("readonly", true);
					$('#btn_project_aos_invoices_1_name').attr('disabled',true);
					$('#btn_clr_project_aos_invoices_1_name').attr('disabled',true);
					
					$('#btn_assigned_user_name').attr('disabled',true);
					$('#btn_clr_assigned_user_name').attr('disabled',true);

					$('#org').attr('disabled',true);
					$('#btn_clr_billing_account').attr('disabled',true);
					$('#invoice_date').attr('readonly',false);
					
				}

				function PO(){
					$('#approval_po_c').attr('disabled',true);
				}

				// if('{$this->bean->id}' != ''){
				// 	$('#org').attr('disabled',true);
				// 	$('#btn_clr_billing_account').attr('disabled',true);
				// }
				$('#number_label').html('Invoice Id:<span class="required">*</span>');
				$('#client_gst1_c').removeAttr('readonly');
				$('#invoice_reference_no_c').removeAttr('readonly');

				reasonForCancelation();
				$('#stage_c').on('change',function(){
					reasonForCancelation();
				});

			});
			function reasonForCancelation(){
				if($('#stage_c').val() == 'Cancelled'){
						$('#description_label').parent().show();
					}else{
						$('#description_label').parent().hide();
					}
			}
		</script>
EOD;

		parent::display();
	}
	
	function populateInvoiceTemplates(){
		global $app_list_strings;
		
		$sql = "SELECT id, name FROM aos_pdf_templates WHERE deleted='0' AND type='AOS_Invoices'";
		$res = $this->bean->db->query($sql);
		
		$app_list_strings['template_ddown_c_list'] = array();
		while($row = $this->bean->db->fetchByAssoc($res)){
			$app_list_strings['template_ddown_c_list'][$row['id']] = $row['name'];
		}
	}
}
?>
