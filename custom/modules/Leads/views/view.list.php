<?php
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

class LeadsViewList extends ViewList
{
    public function preDisplay() {
        parent::preDisplay();
        $this->lv->targetList = true;
		
		echo <<<EOD
        <script>
             $(document).ready(function(){
				function copyprogramcode(){
					var pid = $('#project_leads_1project_ida_basic').val();
                   
                   if(pid != '')
                   {
                        $.ajax({url:'popupproginfo.php', data:{pid1:pid},type:'GET',dataType:'json',success:function(result)
                        {
                            var pcode=result.g;
                            $('#programme_id_c_basic').val(pcode);
							
							
                        }
                        });
                   }
                   else
                   { 
                        $('#programme_id_c_basic').val('');                         
                   }
				}
				

                $("#project_leads_1_name_basic, #btn_project_leads_1_name_basic").blur(function(){
                   copyprogramcode();    
									   
                }); 
				$(document).on('blur change paste','#project_leads_1_name_basic, #btn_project_leads_1_name_basic',function(){
                    copyprogramcode();
					
                });
				$("#Leadsbasic_searchSearchForm").mouseup(function(){
					copyprogramcode();
				});
				$("#Leadsbasic_searchSearchForm").mousedown(function(){
					copyprogramcode();
				});
				$('#search_form_clear').on('click',function(){
					
					//document.getElementById("search_form_clear").click(); 
					$('#programme_id_c_basic').val('');
					$('#project_leads_1project_ida_basic').val("");	
					setTimeout(function(){ if($('#project_leads_1project_ida_basic').val()=="") {copyprogramcode(); } }, 1000);
                }); 
}); 				
        </script>
EOD;
    }
}
