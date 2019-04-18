<?php
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

require_once('include/MVC/View/views/view.edit.php');

class scrm_Work_OrderViewEdit extends ViewEdit
{
 	
 	function scrm_Work_OrderViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
        
        echo <<<JS

        <script>
        	$(document).ready(function(){

                //toggleSP();
                showDescription();
                $('#proposal_status_asci_c').on('change',function(){
                    showDescription();
                });
                function showDescription(){
                    if($('#proposal_status_asci_c').val() != "Others"){
                        $('#description').parent().parent().hide();
                    }else{
                        $('#description').parent().parent().show();
                    }
                }
                addToValidate('EditView','project_scrm_work_order_1_name','project_scrm_work_order_1_name',true,'');
        		$('#project_scrm_work_order_1_name_label').append('<span class="required">*</span>');
          //       $('#programme_type_c').change(function(){
          //           toggleSP();
        		// });

                // function toggleSP(){
                //     if($('#programme_type_c').val() == 'Workshop/Seminar/Sponsored'){
                //         showSP();
                //     }else{
                //         hideSP();
                //     }                    
                // }
                $(document).on('blur','#scrm_work_order_opportunities_1_name,#btn_scrm_work_order_opportunities_1_name',function(){
                   
                        $.ajax({
                          method: "POST",
                          url: "index.php?entryPoint=ajaxCall",
                          data: {scrm_work_order_opportunities_1opportunities_idb: $('#scrm_work_order_opportunities_1opportunities_idb').val(), type:"getProposalId"}
                        }).success(function(rsp){
                            rsp = JSON.parse(rsp);
                            $('#asci_rpf_reference_c').val(rsp.asci_rpf_reference_c);
                            $('#lead_fac_1_centre_c').val(rsp.lead_fac_1_centre_c);
                            $('#lead_fac_2_centre_c').val(rsp.lead_fac_2_centre_c);
                            $('#lead_faculty_1_c').val(rsp.lead_faculty_1_c);
                            $('#scrm_partners_id_c').val(rsp.scrm_partners_id_c);
                            $('#lead_faculty_2_c').val(rsp.lead_faculty_2_c);
                            $('#scrm_partners_id1_c').val(rsp.scrm_partners_id1_c);
                        });
                });
        		function showSP(){
	        			$('#min_participants_per_batch_c').parent('td').show();	
	        			$('#min_participants_per_batch_c_label').show();

                        $('#max_participants_per_batch_c').parent('td').show(); 
                        $('#max_participants_per_batch_c_label').show();

                        $('#sp_total_expected_revenue_c').parent('td').show(); 
                        $('#sp_total_expected_revenue_c_label').show();

                        $('#utilisation_certificate_req_c').parent().parent('td').show(); 
                        $('#utilisation_certificate_req_c_label').show();                        
        		}

        		function hideSP(){
                        $('#min_participants_per_batch_c').parent('td').hide(); 
                        $('#min_participants_per_batch_c_label').hide();

                        $('#max_participants_per_batch_c').parent('td').hide(); 
                        $('#max_participants_per_batch_c_label').hide();

                        $('#sp_total_expected_revenue_c').parent('td').hide(); 
                        $('#sp_total_expected_revenue_c_label').hide();

                        $('#utilisation_certificate_req_c').parent().parent('td').hide(); 
                        $('#utilisation_certificate_req_c_label').hide();       
        		}
        	});
        </script>
JS;
        
        //call parent display method
        parent::display();
    }
}


?>
