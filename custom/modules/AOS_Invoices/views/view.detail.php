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


require_once('include/MVC/View/views/view.detail.php');

class AOS_InvoicesViewDetail extends ViewDetail {

	function AOS_InvoicesViewDetail(){
 		parent::ViewDetail();
 	}
	
	function display(){
		global $sugar_config;
		$this->populateInvoiceTemplates();
		$this->displayPopupHtml();

		$projectBean = BeanFactory::getBean('Project',$this->bean->project_aos_invoices_1project_ida);
		if ($projectBean) {
			$participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c != 'Accepted'");

		}else{
			$projectBean = array();
		}
		$count = count($participantsBean);
		$this->ss->assign('count',$count);
		$url = $sugar_config['site_url'];
		$this->ss->assign('url',$url);
		$this->ss->assign('view','EditView');
		if($_REQUEST['message']){
			echo '<div class="alert alert-danger">
			  <strong>'.$_REQUEST['message'].'</strong>
			</div>';
		}
		echo <<<EOD
		<script>
			$(document).ready(function(){
					paymentStatus();
					if($('#status').val() == 'PartiallyPaid' || $('#status').val() == 'Paid'){
						$('#payment_mode_c').parent().parent().parent().show();
					}else{
						$('#payment_mode_c').parent().parent().parent().hide();
					}
					var invoice_type = $('#invoice_type_c').val();
		
					if (invoice_type == 'Supplementary') {
						$('#accommodation_c').parent().parent().show();
			            
						$('#living_allowance_c').parent().parent().show();
			            
			            $('#other_reimbursement_c').parent().parent().show();
			            
					}else{
						$('#accommodation_c').parent().parent().hide();
			            
						$('#living_allowance_c').parent().parent().hide();
			           
			            $('#other_reimbursement_c').parent().parent().hide();
					}
					if (invoice_type == 'Special') {
			            $('#entry_1_c').parent().parent().parent().show();
						$('#entry_2_c').parent().parent().parent().show();
						$('#entry_3_c').parent().parent().parent().show();
			            
					}else{
						$('#entry_1_c').parent().parent().parent().hide();
						$('#entry_2_c').parent().parent().parent().hide();
						$('#entry_3_c').parent().parent().parent().hide();
						   							
					}
					function paymentStatus(){
						if('{$this->bean->status}' == 'Refund'){
							$('#detailpanel_2').show();
						}else{
							$('#detailpanel_2').hide();
						}					
					}
			});
		</script>
EOD;
		parent::display();
	}
	
	function populateInvoiceTemplates(){
		global $app_list_strings;
		
		$sql = "SELECT id, name FROM aos_pdf_templates WHERE deleted = 0 AND type='AOS_Invoices' AND active = 1";

		$res = $this->bean->db->query($sql);
        $app_list_strings['template_ddown_c_list'] = array();
		while($row = $this->bean->db->fetchByAssoc($res)){
			$app_list_strings['template_ddown_c_list'][$row['id']] = $row['name'];
		}
	}
	
	function displayPopupHtml(){
		global $app_list_strings,$app_strings, $mod_strings;
        $templates = array_keys($app_list_strings['template_ddown_c_list']);
        if($templates){
		
		echo '	<div id="popupDiv_ara" style="display:none;position:fixed;top: 39%; left: 41%;opacity:1;z-index:9999;background:#FFFFFF;">
				<form id="popupForm" action="index.php?entryPoint=generatePdf" method="post">
 				<table style="border: #000 solid 2px;padding-left:40px;padding-right:40px;padding-top:10px;padding-bottom:10px;font-size:110%;" >
					<tr height="20">
						<td colspan="2">
						<b>'.$app_strings['LBL_SELECT_TEMPLATE'].':-</b>
						</td>
					</tr>';
			foreach($templates as $template){
				$template = str_replace('^','',$template);
				$js = "document.getElementById('popupDivBack_ara').style.display='none';document.getElementById('popupDiv_ara').style.display='none';var form=document.getElementById('popupForm');if(form!=null){form.templateID.value='".$template."';form.submit();}else{alert('Error!');}";
				echo '<tr height="20">
				<td width="17" valign="center"><a href="#" onclick="'.$js.'"><img src="themes/default/images/txt_image_inline.gif" width="16" height="16" /></a></td>
				<td><b><a href="#" onclick="'.$js.'">'.$app_list_strings['template_ddown_c_list'][$template].'</a></b></td></tr>';
			}
		echo '		<input type="hidden" name="templateID" value="" />
				<input type="hidden" name="task" value="pdf" />
				<input type="hidden" name="module" value="'.$_REQUEST['module'].'" />
				<input type="hidden" name="uid" value="'.$this->bean->id.'" />
				</form>
				<tr style="height:10px;"><tr><tr><td colspan="2"><button style=" display: block;margin-left: auto;margin-right: auto" onclick="document.getElementById(\'popupDivBack_ara\').style.display=\'none\';document.getElementById(\'popupDiv_ara\').style.display=\'none\';return false;">Cancel</button></td></tr>
				</table>
				</div>
				<div id="popupDivBack_ara" onclick="this.style.display=\'none\';document.getElementById(\'popupDiv_ara\').style.display=\'none\';" style="top:0px;left:0px;position:fixed;height:100%;width:100%;background:#000000;opacity:0.5;display:none;vertical-align:middle;text-align:center;z-index:9998;">
				</div>
				<script>
					function showPopup(task){
						var form=document.getElementById(\'popupForm\');
						var ppd=document.getElementById(\'popupDivBack_ara\');
						var ppd2=document.getElementById(\'popupDiv_ara\');
						if('.count($templates).' == 1){
							form.task.value=task;
							form.templateID.value=\''.$template.'\';
							form.submit();
						}else if(form!=null && ppd!=null && ppd2!=null){
							ppd.style.display=\'block\';
							ppd2.style.display=\'block\';
							form.task.value=task;
						}else{
							alert(\'Error!\');
						}
					}
				</script>';
		}
		else{
			echo '<script>
				function showPopup(task){
				alert(\''.$mod_strings['LBL_NO_TEMPLATE'].'\');
				}
			</script>';
		}
	}
}
?>
