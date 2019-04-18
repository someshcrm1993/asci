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


require_once('include/MVC/View/views/view.detail.php');

class scrm_BudgetViewEdit extends ViewEdit
{
    function currencyConverter($currency_from,$currency_to,$currency_input){
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
        $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        $yql_session = curl_init($yql_query_url);
        curl_setopt($yql_session, CURLOPT_RETURNTRANSFER,true);
        $yqlexec = curl_exec($yql_session);
        $yql_json =  json_decode($yqlexec,true);
        $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];

        return $currency_output;
    }

    function convertCurrency($amount, $from, $to){
        $data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
       
        return number_format(round($converted, 3),2);
    }

    function display()
    {
        $budget_configurations = BeanFactory::getBean('Budget Configurations','706ac685-5584-11e7-89c6-9a7ed5fb1238');

        //fetch current user role
        global $current_user;
        // 3 means false
        $usd = 3;
        if (isset($_REQUEST['prog_fee_per_participant_usd_c'])) {
            if ($_REQUEST['prog_fee_per_participant_usd_c'] != '') {

                $currency_input = $_REQUEST['prog_fee_per_participant_usd_c'];
                //currency codes : http://en.wikipedia.org/wiki/ISO_4217
                $currency_from = "USD";
                $currency_to = "INR";
                // $fee_usd = $this->currencyConverter($currency_from,$currency_to,$currency_input);
                $fee_usd = $this->convertCurrency($currency_input,$currency_from,$currency_to);
 
                // $this->bean->prog_fee_per_participant_usd_c = number_format($fee_usd, 2, '.', ''); 
                $usd = 2;
            }
        }

        $role = ACLRole::getUserRoleNames($current_user->id);
        
        $role['ad'] = 'ad';
        $role['vis'] = 'vis';
        // ob_clean();
        // print_r($this->bean);exit;
		$roles_str='';
		if(in_array('Area Chairperson',$role)){
			$roles_str='AC';
		}
		if(in_array('FAC/PD',$role)){
			$roles_str .=',PD';
		} // DOTP
		if(in_array('DOTP',$role)){
			$roles_str .=',DOTP';
		}
		if(in_array('Centre Director',$role)){
			$roles_str .=',CD';
		}
        $acp = 3;
        if ($this->bean->ac_approval_c == 'Yes') {
        	$acp = 2;
        }
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }else{
            //role is admin
            $role = false;
        }

       // echo "xxxx---->".$role;

		$programme_type_c="";
        if (isset($_REQUEST['project_scrm_budget_1project_ida']) && $_REQUEST['project_scrm_budget_1project_ida'] != '') {
			
            $programme_bean = BeanFactory::getBean('Project', $_REQUEST['project_scrm_budget_1project_ida']);
            $overSeas = $programme_bean->overseas_tour_c;
			$programme_type_c=$programme_bean->programme_type_c;
        }else{
			$programme_bean = BeanFactory::getBean('Project', $this->bean->project_scrm_budget_1project_ida);
            $overSeas = $programme_bean->overseas_tour_c;            
			$programme_type_c=$programme_bean->programme_type_c;
		}
		

        echo <<<EOD
        <style>
            #LBL_EDITVIEW_PANEL2 h5, #detailpanel_3 h5
             {
                padding: 0 0 10px 0;
                margin: 0 0 10px 0;
                color:#2767A8;
                border-bottom: 1px solid #dddddd;
            }        
        </style>
        <script>
            $(document).ready(function(){
				var rolesStr="{$roles_str}";
				var rolesArr = rolesStr.split(",");
				
				$('#training_infrastructure_c_label').next('td').remove();
				$('#training_infrastructure_c_label').css({"font-weight":"bold"});
				var Ttraining_infrastructurehtml=$('#training_infrastructure_c_label').html();
				var res = Ttraining_infrastructurehtml.replace(":", "");
				$('#training_infrastructure_c_label').html(res);
				$('#training_infrastructure_c_label').attr('colspan',2);

                var pgid = $('#project_scrm_budget_1project_ida').val();

                if("{$overSeas}" == "No" || "{$overSeas}" == ""){
                    $('#detailpanel_9').hide();
                    $('#study_tour_c').parent('td').hide();
                    $('#study_tour_c_label').hide();
                    removeFromValidate('EditView','faculty_per_diem_c');
                }

                if('{$acp}' == 2){
                    $('#detailpanel_1 :input').attr('disabled',true);
                    $('#detailpanel_2 :input').attr('disabled',true);
                    $('#detailpanel_3 :input').attr('disabled',true);
                    $('#detailpanel_4 :input').attr('disabled',true);
                    $('#detailpanel_5 :input').attr('disabled',true);
                    $('#detailpanel_6 :input').attr('disabled',true);
                    $('#detailpanel_7 :input').attr('disabled',true);
                    $('#detailpanel_8 :input').attr('disabled',true);
                    $('#detailpanel_9 :input').attr('disabled',true);
                    //$('#detailpanel_1 :input').attr('disabled',true);

                    $('#accomodation_c').attr('disabled',false);
                    $('#CANCEL_HEADER').attr('disabled',false);
                    $('#SAVE_HEADER').attr('disabled',false);
                    $('#SAVE_FOOTER').attr('disabled',false);
                    $('#CANCEL_FOOTER').attr('disabled',false);                    

                	$('#cd_approval_c').attr('disabled',false);
                	$('#dotp_approval_c').attr('disabled',false);
                }
                if({$usd} == 2){
                   // $('#prog_fee_per_participant_usd_c').val('{$fee_usd}');
                }
                $('#prg_fee_per_participant_c').after('<label>As per Work Order/ Communciation from Client / Program brochure</label>')

                $('#prog_fee_per_participant_usd_c').after('<label>As per Work Order/ Communciation from Client / Program brochure</label>')

                $('#no_foreign_usd_participants_c').after('<label>Communciation from client for ICTPs/ Nominations for Announced Programmes</label>')

                $('#brochure_printing_costs_c').after('<label>*Rs.6500 per programme for brochures; cost includes pdf and e-flyers</label><label>*Rs.45.00 per brochure for flagship programmes such as ASCI-AMP, SEC etc. Premium rate applies.</label><label>*Rs.3500 for e brochure and e flyer only</label>')
                
                $('#advertisement_cost_c').after('<label>*As per actuals</label>')

                $('#mailing_costs_c').after('<label>*Rs.18/- per brochure for domestic courier</label><label>*Cost for other means of internal mailing costs may be obtained from P.O.</label>')

                $('#training_kit_c').after('<label>Rs.900/- X No. of participants + 2; Training kit includes College bag, pen, note pad, pendrive, certificate folder, docket file and enclosures</label>')

 				$('#group_photo_c').after('<label>Rs.50/- X No. of participants + 4</label>')

 				$('#books_journals_etc_c').after('<label>As approved by DoTP</label>')

 				$('#mess_charges_c').after('<label>Rs.850/- per participant per day and Rs.500/- for non-residential participants</label>')

 				$('#hostel_charges_c').after('<label>Rs.1150/- per participant per day</label><label>Nil for non-residential participants</label>')

 				$('#arrival_departure_cost_c').after('<label>Rs.1200/- per participant</label>')

 				$('#p_reading_material_c').after('<label>Only for programmes where hard copies are provided: Re.1/- per page X No. of pages</label>')

 				$('#material_for_distribution_c').after('<label>As per Actuals</label>')

 				$('#total_c').after('<label>As per norm: 1.5 times participants fee to include guest speaker honorarium. Travel, incidentals and momentoes</label>')

 				$('#fees_c').after('<label>As approved by DoTP</label>')

 				$('#caps_and_t_shirts_c').after('<label>T shirt and Cap Rs.425/-  X No. of participants + 2 - approved when programme has Outbound component</label>')

 				$('#business_simulation_c').after('<label>As approved by DoTP</label>')

 				$('#module_outsourcing_c').after('<label>As approved by DoTP</label>')

 				$('#sound_light_show_c').after('<label>Rs.140/- per participant </label>')

 				$('#ramoji_film_city_c').after('<label>Rs.1600/- per participant</label>')

 				$('#others_visits_c').after('<label>As per actuals</label>')

 				$('#bus_charges_c').after('<label>Rs.5000/- for transport for Golkonda; Rs.8000/- for each trip of 8 hours for other visits </label>')

 				$('#videography_c').after('<label>Rs.8000/- for full day and Rs.4500/- for half day  </label>')

 				$('#hire_of_laptops_c').after('<label>As per estimate provided by Computer Centre </label>')

 				$('#cultural_event_c').after('<label>As per Actuals </label>')

 				$('#faculty_cost_c').after('<label>Rs.35000/- per day</label>')

 				$('#programmes_at_asci_c').after('<label>Rs.19000/- per day plus Rs.800/- per participant per day</label>')

 				$('#programmes_off_campus_c').after('<label>Rs.12000/- per day</label>')

 				$('#corporate_overhead_c').after('<label>Rs.12000/- per day plus Rs.500/- per participant per day for On-campus Programmes</label>')
 				
				/*Modified by Ashvin
				* Date:13-11-2018
				* Reason: Helping text for CD approval saying ‘Please select your CD for approval’
				* Ticket ID:3784
				* Start
				*/
				$('#btn_clr_ac_assigned_to_c').after('<label>Please select your AC for approval</label>');
				$('#btn_clr_cd_assigned_to_c').after('<label>Please select your CD for approval</label>');
				$('#btn_clr_dotp_assigned_user_c').after('<label>Please select your DOTP for approval</label>');
				
				/*Modified by Ashvin
				* Date:13-11-2018
				* Reason: Helping text for CD approval saying ‘Please select your CD for approval’
				* Ticket ID:3784
				* End
				*/

                $('#study_tour_c').attr('readonly',true);

                addToValidate('EditView','project_scrm_budget_1_name','project_scrm_budget_1_name',true,'Project Title');
                
                $('#project_scrm_budget_1_name_label').append('<span class="required">*</span>');


                $('#study_tour_c').after('<a href="#detailpanel_3" class="btn btn-sm">Click to Add study Tour</a>');    
                  $('[href="#detailpanel_3"]').click(function() {
                  $("html,body").animate({scrollTop: $("#sub_total_overhead_expd_c").offset().top},1200, "easeOutBounce");
                  return false;
                  });

                //ajax call fetch programme details 
                if('$role'=='DOTP'){
                    showDOTPApprovals();
                }else if('$role' == 'Centre Director'){
                    showCDApprovals();
                }else if('$role' == 'Area Chairperson'){
                    showacApprovals();
                }else if('$role' == 'FAC/PD'){
					showassignto();
				}else{
                    hideAllRoles();
                }
				var dotp_assigned_user_c=$("#dotp_assigned_user_c").val().trim();
				if($.inArray("PD", rolesArr) !== -1 && $.inArray("AC", rolesArr) !== -1 && $.inArray("CD", rolesArr) !== -1 ){
					
					showCDApprovals();
					$('#ac_assigned_to_c').val('$current_user->name');
                    $('#user_id2_c').val('$current_user->id');
				}
				
				
				
				/*Modified by Ashvin
				  Date:26-10-2018
				  Reason: FOR PD open AC/CD/DOTP for assigning depend on condition
				*/
				function showassignto(){
					
					var ac_assigned_to_c='';
					var cd_assigned_to_c='';
					var dotp_assigned_user_c='';
					
					ac_assigned_to_c=$("#ac_assigned_to_c").val();
					cd_assigned_to_c=$("#cd_assigned_to_c").val();
					dotp_assigned_user_c=$("#dotp_assigned_user_c").val();
					ac_assigned_to_c=ac_assigned_to_c.trim();
					dotp_assigned_user_c=dotp_assigned_user_c.trim();
					cd_assigned_to_c=cd_assigned_to_c.trim();
					
					var ac_approval_c='';
					ac_approval_c=$("#ac_approval_c").val();
					ac_approval_c=ac_approval_c.trim();
						
					if((ac_assigned_to_c !="" || cd_assigned_to_c !="" || dotp_assigned_user_c !="") ){
						
					}
					$('#ac_approval_c').prop('disabled', 'disabled');
                    $('#cd_approval_c').prop('disabled', 'disabled');
                    $('#dotp_approval_c').prop('disabled', 'disabled');
					
					$('#remark_ac_c').attr('disabled',true);
                    $('#remark_cd_c').attr('disabled',true);
                    $('#remark_dotp_c').attr('disabled',true);
					
					$("#cd_assigned_to_c").attr('disabled',true);
					$("#btn_cd_assigned_to_c").attr('disabled',true);
					$("#btn_clr_cd_assigned_to_c").attr('disabled',true);
					
					$("#dotp_assigned_user_c").attr('disabled',true);
					$("#btn_dotp_assigned_user_c").attr('disabled',true);
					$("#btn_clr_dotp_assigned_user_c").attr('disabled',true);
					
					
					
					if(ac_assigned_to_c==""){
						$('#ac_assigned_to_c').attr('disabled',false);
						$('#btn_ac_assigned_to_c').attr('disabled',false);
						$('#btn_clr_ac_assigned_to_c').attr('disabled',false);
					}else{
						
						
						if(ac_approval_c=='No'){						
							$('#ac_assigned_to_c').attr('disabled',false);
							$('#btn_ac_assigned_to_c').attr('disabled',false);
							$('#btn_clr_ac_assigned_to_c').attr('disabled',false);
						}else{
							$('#detailpanel_1 :input').attr('disabled',true);
							$('#detailpanel_2 :input').attr('disabled',true);
							$('#detailpanel_3 :input').attr('disabled',true);
							$('#detailpanel_4 :input').attr('disabled',true);
							$('#detailpanel_5 :input').attr('disabled',true);
							$('#detailpanel_6 :input').attr('disabled',true);
							$('#detailpanel_7 :input').attr('disabled',true);
							$('#detailpanel_8 :input').attr('disabled',true);
							$('#detailpanel_9 :input').attr('disabled',true);
							$('#CANCEL_HEADER').attr('disabled',false);
							$('#SAVE_HEADER').attr('disabled',false);
							$('#SAVE_FOOTER').attr('disabled',false);
							$('#CANCEL_FOOTER').attr('disabled',false);    
							$('#ac_assigned_to_c').attr('disabled',true);
							$('#btn_ac_assigned_to_c').attr('disabled',true);
							$('#btn_clr_ac_assigned_to_c').attr('disabled',true);
							
						}
					}
					var assigned_user_name="";
					assigned_user_name=$("#assigned_user_name").val().trim();
					
					if(ac_assigned_to_c !="" && ac_assigned_to_c==assigned_user_name){
						
						$('#ac_approval_c').prop('disabled', false);
						$('#remark_ac_c').prop('disabled', false);
						$('#ac_assigned_to_c').attr('disabled',false);
							$('#btn_ac_assigned_to_c').attr('disabled',false);
							$('#btn_clr_ac_assigned_to_c').attr('disabled',false);
						$("#cd_assigned_to_c").attr('disabled',false);
						$("#btn_cd_assigned_to_c").attr('disabled',false);
						$("#btn_clr_cd_assigned_to_c").attr('disabled',false);
						$('#detailpanel_1 :input').attr('disabled',false);
							$('#detailpanel_2 :input').attr('disabled',false);
							$('#detailpanel_3 :input').attr('disabled',false);
							$('#detailpanel_4 :input').attr('disabled',false);
							$('#detailpanel_5 :input').attr('disabled',false);
							$('#detailpanel_6 :input').attr('disabled',false);
							$('#detailpanel_7 :input').attr('disabled',false);
							$('#detailpanel_8 :input').attr('disabled',false);
							$('#detailpanel_9 :input').attr('disabled',false);
					}
					var cd_approval_c=$("#cd_approval_c").val();
					if(cd_assigned_to_c!="" && cd_approval_c=='No'){
						$("#cd_assigned_to_c").attr('disabled',false);
						$("#btn_cd_assigned_to_c").attr('disabled',false);
						$("#btn_clr_cd_assigned_to_c").attr('disabled',false);
						$('#detailpanel_1 :input').attr('disabled',false);
							$('#detailpanel_2 :input').attr('disabled',false);
							$('#detailpanel_3 :input').attr('disabled',false);
							$('#detailpanel_4 :input').attr('disabled',false);
							$('#detailpanel_5 :input').attr('disabled',false);
							$('#detailpanel_6 :input').attr('disabled',false);
							$('#detailpanel_7 :input').attr('disabled',false);
							$('#detailpanel_8 :input').attr('disabled',false);
							$('#detailpanel_9 :input').attr('disabled',false);
					}else{
						if(cd_assigned_to_c!=""){
						$("#cd_assigned_to_c").attr('disabled',true);
						$("#btn_cd_assigned_to_c").attr('disabled',true);
						$("#btn_clr_cd_assigned_to_c").attr('disabled',true);
						}
					}
					
					if(assigned_user_name==cd_assigned_to_c){
						$("#cd_approval_c").prop('disabled', false);
						$("#remark_cd_c").attr('disabled',false);
						$("#cd_assigned_to_c").attr('disabled',false);
						$("#dotp_assigned_user_c").attr('disabled',false);
						$("#btn_cd_assigned_to_c").attr('disabled',false);
						$("#btn_dotp_assigned_user_c").attr('disabled',false);
						$("#btn_clr_dotp_assigned_user_c").attr('disabled',false);
						$("#btn_clr_cd_assigned_to_c").attr('disabled',false);
						$('#detailpanel_1 :input').attr('disabled',false);
							$('#detailpanel_2 :input').attr('disabled',false);
							$('#detailpanel_3 :input').attr('disabled',false);
							$('#detailpanel_4 :input').attr('disabled',false);
							$('#detailpanel_5 :input').attr('disabled',false);
							$('#detailpanel_6 :input').attr('disabled',false);
							$('#detailpanel_7 :input').attr('disabled',false);
							$('#detailpanel_8 :input').attr('disabled',false);
							$('#detailpanel_9 :input').attr('disabled',false);
					}
					
					var dotp_approval_c=$("#dotp_approval_c").val().trim();
					if(dotp_assigned_user_c!="" && dotp_approval_c=='No'){
						
						$("#dotp_assigned_user_c").attr('disabled',false);
						$("#btn_dotp_assigned_user_c").attr('disabled',false);
						$("#btn_clr_dotp_assigned_user_c").attr('disabled',false);
						$('#detailpanel_1 :input').attr('disabled',false);
							$('#detailpanel_2 :input').attr('disabled',false);
							$('#detailpanel_3 :input').attr('disabled',false);
							$('#detailpanel_4 :input').attr('disabled',false);
							$('#detailpanel_5 :input').attr('disabled',false);
							$('#detailpanel_6 :input').attr('disabled',false);
							$('#detailpanel_7 :input').attr('disabled',false);
							$('#detailpanel_8 :input').attr('disabled',false);
							$('#detailpanel_9 :input').attr('disabled',false);
						
					}else{
						if(dotp_assigned_user_c!="" ){
							$("#dotp_assigned_user_c").attr('disabled',true);
							$("#btn_dotp_assigned_user_c").attr('disabled',true);
							$("#btn_clr_dotp_assigned_user_c").attr('disabled',true);
							if(dotp_assigned_user_c==cd_assigned_to_c){
								$("#dotp_approval_c").attr('disabled',false);
								$("#remark_dotp_c").attr('disabled',false);
								$("#dotp_assigned_user_c").attr('disabled',false);
						$("#btn_dotp_assigned_user_c").attr('disabled',false);
						$("#btn_clr_dotp_assigned_user_c").attr('disabled',false);
							}
						}
					}
					
					
					
				}
				/*Modified by Ashvin
				  Date:26-10-2018
				  Reason: change radio to dropdown
				  End
				*/ 
                function hideAllRoles(){
                    /*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					*/
                    $('#ac_approval_c').prop('disabled', 'disabled');
                    $('#cd_approval_c').prop('disabled', 'disabled');
                    $('#dotp_approval_c').prop('disabled', 'disabled');
                    /*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					  End
					*/                                      

                    $('#ac_assigned_to_c').attr('disabled',true);
                    $('#btn_ac_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_ac_assigned_to_c').attr('disabled',true);

                    $('#cd_assigned_to_c').attr('disabled',true);
                    $('#btn_cd_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_cd_assigned_to_c').attr('disabled',true);
                    $("input[name='ac_approval_c']").attr('disabled',true);
                    

                    $('#ac_assigned_to_c').attr('disabled',true);
                    $('#btn_ac_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_ac_assigned_to_c').attr('disabled',true);

                    $('#dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_clr_dotp_assigned_user_c').attr('disabled',true);                
                    $("input[name='cd_approval_c']").attr('disabled',true);

                    // $('#dotp_approval_c_label').hide();
                    //$("input[name='dotp_approval_c']").attr('disabled',true);
                    
                    $('#cd_assigned_to_c').attr('disabled',true);
                    $('#btn_cd_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_cd_assigned_to_c').attr('disabled',true);

                    $('#dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_clr_dotp_assigned_user_c').attr('disabled',true);

                    $('#remark_ac_c').attr('disabled',true);
                    $('#remark_cd_c').attr('disabled',true);
                    $('#remark_dotp_c').attr('disabled',true);
                }

                function showDOTPApprovals(){   
					$('#detailpanel_1 :input').attr('disabled',true);
					$('#detailpanel_2 :input').attr('disabled',true);
					$('#detailpanel_3 :input').attr('disabled',true);
					$('#detailpanel_4 :input').attr('disabled',true);
					$('#detailpanel_5 :input').attr('disabled',true);
					$('#detailpanel_6 :input').attr('disabled',true);
					$('#detailpanel_7 :input').attr('disabled',true);
					$('#detailpanel_8 :input').attr('disabled',true);
					$('#detailpanel_9 :input').attr('disabled',true);
					
					$('#assigned_user_name').attr('disabled',true);
					$('#btn_assigned_user_name').attr('disabled',true);
					$('#btn_clr_assigned_user_name').attr('disabled',true);
					/*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					*/
                    $('#ac_approval_c').prop('disabled', 'disabled');
                    $('#cd_approval_c').prop('disabled', 'disabled');
                    $('#dotp_approval_c').prop('disabled', false);
                    /*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					  End
					*/ 
					
                    $('#dotp_assigned_user_c').val('$current_user->name');
                    $('#user_id_c').val('$current_user->id');

                    $('#ac_assigned_to_c').attr('disabled',true);
                    $('#btn_ac_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_ac_assigned_to_c').attr('disabled',true);

                    $('#cd_assigned_to_c').attr('disabled',true);
                    $('#btn_cd_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_cd_assigned_to_c').attr('disabled',true);

                    $('#remark_ac_c').attr('disabled',true);
                    $('#remark_cd_c').attr('disabled',true);
                    $('#remark_dotp_c').attr('disabled',false);
					
					
                }

                function showCDApprovals(){               
					$('#detailpanel_1 :input').attr('disabled',true);
					$('#detailpanel_2 :input').attr('disabled',true);
					$('#detailpanel_3 :input').attr('disabled',true);
					$('#detailpanel_4 :input').attr('disabled',true);
					$('#detailpanel_5 :input').attr('disabled',true);
					$('#detailpanel_6 :input').attr('disabled',true);
					$('#detailpanel_7 :input').attr('disabled',true);
					$('#detailpanel_8 :input').attr('disabled',true);
					$('#detailpanel_9 :input').attr('disabled',true);
					/*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					*/
                    $('#ac_approval_c').prop('disabled', 'disabled');
                    $('#cd_approval_c').prop('disabled', false);
                    $('#dotp_approval_c').prop('disabled', 'disabled');
                    /*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					  End
					*/
					
                    $('#cd_assigned_to_c').val('$current_user->name');
                    $('#user_id1_c').val('$current_user->id');
					
					$('#assigned_user_name').attr('disabled',true);
					$('#btn_assigned_user_name').attr('disabled',true);
					$('#btn_clr_assigned_user_name').attr('disabled',true);
					
					$('#cd_assigned_to_c').attr('disabled',true);
					$('#btn_cd_assigned_to_c').attr('disabled',true);
					$('#btn_clr_cd_assigned_to_c').attr('disabled',true);
					
					
                    $('#ac_assigned_to_c').attr('disabled',true);
                    $('#btn_ac_assigned_to_c').attr('disabled',true);
                    $('#btn_clr_ac_assigned_to_c').attr('disabled',true);

                     $('#dotp_assigned_user_c').attr('disabled',false);
                     $('#btn_dotp_assigned_user_c').attr('disabled',false);
                     $('#btn_clr_dotp_assigned_user_c').attr('disabled',false);                
                    
                    $('#remark_ac_c').attr('disabled',true);
                    $('#remark_cd_c').attr('disabled',false);
                    $('#remark_dotp_c').attr('disabled',true);
					var dotp_assigned_user_c='';
					dotp_assigned_user_c=$("#dotp_assigned_user_c").val()
					var dotp_approval_c=$("#dotp_approval_c").val()
					if(dotp_assigned_user_c!="" ){
						$(':input').attr('disabled',true);
						$('#CANCEL_HEADER').attr('disabled',false);
						$('#SAVE_HEADER').attr('disabled',false);
						$('#SAVE_FOOTER').attr('disabled',false);
						$('#CANCEL_FOOTER').attr('disabled',false);  
						$('#dotp_assigned_user_c').attr('disabled',true);
						$('#btn_dotp_assigned_user_c').attr('disabled',true);
						$('#btn_clr_dotp_assigned_user_c').attr('disabled',true);     
					}else{
						$('#dotp_assigned_user_c').attr('disabled',false);
						$('#btn_dotp_assigned_user_c').attr('disabled',false);
						$('#btn_clr_dotp_assigned_user_c').attr('disabled',false);  
					}
					var dotp_approval_c=$("#dotp_approval_c").val().trim();
					if(dotp_approval_c=='No'){
						$('#detailpanel_1 :input').attr('disabled',true);
						$('#detailpanel_2 :input').attr('disabled',true);
						$('#detailpanel_3 :input').attr('disabled',true);
						$('#detailpanel_4 :input').attr('disabled',true);
						$('#detailpanel_5 :input').attr('disabled',true);
						$('#detailpanel_6 :input').attr('disabled',true);
						$('#detailpanel_7 :input').attr('disabled',true);
						$('#detailpanel_8 :input').attr('disabled',true);
						$('#detailpanel_9 :input').attr('disabled',true);
					}
					var dotp_assigned_user_c=$("#dotp_assigned_user_c").val().trim();
					if($.inArray("PD", rolesArr) !== -1 && $.inArray("CD", rolesArr) !== -1 && dotp_assigned_user_c=="" && $.inArray("AC", rolesArr) == -1){
						$('#detailpanel_1 :input').attr('disabled',false);
						$('#detailpanel_2 :input').attr('disabled',false);
						$('#detailpanel_3 :input').attr('disabled',false);
						$('#detailpanel_4 :input').attr('disabled',false);
						$('#detailpanel_5 :input').attr('disabled',false);
						$('#detailpanel_6 :input').attr('disabled',false);
						$('#detailpanel_7 :input').attr('disabled',false);
						$('#detailpanel_8 :input').attr('disabled',false);
						$('#detailpanel_9 :input').attr('disabled',false);
						$("#ac_assigned_to_c").attr('disabled',true);
						$("#btn_ac_assigned_to_c").attr('disabled',true);
						$("#btn_clr_ac_assigned_to_c").attr('disabled',true);
						$('#ac_approval_c').prop('disabled', true);
						
						$('#remark_ac_c').attr('disabled',true);
						
												
					}
					var dotp_assigned_user_c=$("#dotp_assigned_user_c").val().trim();
					var dotp_approval_c=$("#dotp_approval_c").val().trim();
					if($.inArray("PD", rolesArr) !== -1 && $.inArray("CD", rolesArr) !== -1 && $.inArray("AC", rolesArr) !== -1 && dotp_assigned_user_c!="" && (dotp_approval_c =='' )){
						$('#detailpanel_1 :input').attr('disabled',true);
						$('#detailpanel_2 :input').attr('disabled',true);
						$('#detailpanel_3 :input').attr('disabled',true);
						$('#detailpanel_4 :input').attr('disabled',true);
						$('#detailpanel_5 :input').attr('disabled',true);
						$('#detailpanel_6 :input').attr('disabled',true);
						$('#detailpanel_7 :input').attr('disabled',true);
						$('#detailpanel_8 :input').attr('disabled',true);
						$('#detailpanel_9 :input').attr('disabled',true);
						$("#ac_assigned_to_c").attr('disabled',true);
						$("#btn_ac_assigned_to_c").attr('disabled',true);
						$("#btn_clr_ac_assigned_to_c").attr('disabled',true);
												
					}
					if($.inArray("PD", rolesArr) !== -1 && $.inArray("CD", rolesArr) !== -1 && $.inArray("AC", rolesArr) !== -1 && dotp_assigned_user_c=="" && (dotp_approval_c =='' )){
						
						$('#detailpanel_1 :input').attr('disabled',false);
						$('#detailpanel_2 :input').attr('disabled',false);
						$('#detailpanel_3 :input').attr('disabled',false);
						$('#detailpanel_4 :input').attr('disabled',false);
						$('#detailpanel_5 :input').attr('disabled',false);
						$('#detailpanel_6 :input').attr('disabled',false);
						$('#detailpanel_7 :input').attr('disabled',false);
						$('#detailpanel_8 :input').attr('disabled',false);
						$('#detailpanel_9 :input').attr('disabled',false);
						$("#ac_assigned_to_c").attr('disabled',true);
						$("#btn_ac_assigned_to_c").attr('disabled',true);
						$("#btn_clr_ac_assigned_to_c").attr('disabled',true);
												
					}
					
                }

                function showacApprovals(){					
					
					$('#detailpanel_1 :input').attr('disabled',true);
					$('#detailpanel_2 :input').attr('disabled',true);
					$('#detailpanel_3 :input').attr('disabled',true);
					$('#detailpanel_4 :input').attr('disabled',true);
					$('#detailpanel_5 :input').attr('disabled',true);
					$('#detailpanel_6 :input').attr('disabled',true);
					$('#detailpanel_7 :input').attr('disabled',true);
					$('#detailpanel_8 :input').attr('disabled',true);
					$('#detailpanel_9 :input').attr('disabled',true);
					
					$('#assigned_user_name').attr('disabled',true);
					$('#btn_assigned_user_name').attr('disabled',true);
					$('#btn_clr_assigned_user_name').attr('disabled',true);
					/*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					*/
                    $('#ac_approval_c').prop('disabled', false);
                    $('#cd_approval_c').prop('disabled', 'disabled');
                    $('#dotp_approval_c').prop('disabled', 'disabled');
                    /*Modified by Ashvin
					  Date:26-10-2018
					  Reason: change radio to dropdown
					  End
					*/
                   

                    $('#ac_assigned_to_c').val('$current_user->name');
                    $('#user_id2_c').val('$current_user->id');
					
					$("#assigned_user_name").attr('disabled',true);
					$("#btn_assigned_user_name").attr('disabled',true);
					$("#btn_clr_assigned_user_name").attr('disabled',true);
                    
					$("#ac_assigned_to_c").attr('disabled',true);
					$("#btn_ac_assigned_to_c").attr('disabled',true);
					$("#btn_clr_ac_assigned_to_c").attr('disabled',true);
					
                    $('#dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_dotp_assigned_user_c').attr('disabled',true);
                    $('#btn_clr_dotp_assigned_user_c').attr('disabled',true);
					
					$("#cd_assigned_to_c").attr('disabled',false);
					$("#btn_cd_assigned_to_c").attr('disabled',false);
					$("#btn_clr_cd_assigned_to_c").attr('disabled',false);
					
                    $('#remark_ac_c').attr('disabled',false);
                    $('#remark_cd_c').attr('disabled',true);
                    $('#remark_dotp_c').attr('disabled',true);
					var cd_assigned_to_c=$("#cd_assigned_to_c").val().trim();
					var ac_approval_c=$("#ac_approval_c").val().trim();
					if(cd_assigned_to_c!="" && ac_approval_c =="Yes"){
						$('#ac_approval_c').prop('disabled', true);
						 $('#remark_ac_c').attr('disabled',true);
					}
					var cd_approval_c=$("#cd_approval_c").val().trim();
					if(cd_assigned_to_c!="" && cd_approval_c =="No"){
						$('#detailpanel_1 :input').attr('disabled',true);
						$('#detailpanel_2 :input').attr('disabled',true);
						$('#detailpanel_3 :input').attr('disabled',true);
						$('#detailpanel_4 :input').attr('disabled',true);
						$('#detailpanel_5 :input').attr('disabled',true);
						$('#detailpanel_6 :input').attr('disabled',true);
						$('#detailpanel_7 :input').attr('disabled',true);
						$('#detailpanel_8 :input').attr('disabled',true);
						$('#detailpanel_9 :input').attr('disabled',true);
					}
					
					if($.inArray("PD", rolesArr) !== -1 && $.inArray("AC", rolesArr) !== -1 && cd_assigned_to_c==""){
						$('#detailpanel_1 :input').attr('disabled',false);
						$('#detailpanel_2 :input').attr('disabled',false);
						$('#detailpanel_3 :input').attr('disabled',false);
						$('#detailpanel_4 :input').attr('disabled',false);
						$('#detailpanel_5 :input').attr('disabled',false);
						$('#detailpanel_6 :input').attr('disabled',false);
						$('#detailpanel_7 :input').attr('disabled',false);
						$('#detailpanel_8 :input').attr('disabled',false);
						$('#detailpanel_9 :input').attr('disabled',false);
						$("#ac_assigned_to_c").attr('disabled',false);
						$("#btn_ac_assigned_to_c").attr('disabled',false);
						$("#btn_clr_ac_assigned_to_c").attr('disabled',false);
					}
					var dotp_approval_c=$("#dotp_approval_c").val().trim();
					if(dotp_approval_c=='No'){
						$('#detailpanel_1 :input').attr('disabled',true);
						$('#detailpanel_2 :input').attr('disabled',true);
						$('#detailpanel_3 :input').attr('disabled',true);
						$('#detailpanel_4 :input').attr('disabled',true);
						$('#detailpanel_5 :input').attr('disabled',true);
						$('#detailpanel_6 :input').attr('disabled',true);
						$('#detailpanel_7 :input').attr('disabled',true);
						$('#detailpanel_8 :input').attr('disabled',true);
						$('#detailpanel_9 :input').attr('disabled',true);
					}
                }           

                var day = 0;
                var a;
				function cal_no_of_day(){
					var pid = $('#project_scrm_budget_1project_ida').val();
                   
                   if(pid != '')
                   {
                        $.ajax({url:'popupproginfo.php', data:{pid1:pid},type:'GET',dataType:'json',success:function(result)
                        {
                            
                            day=result.d;
                            var fee = result.e;
                            var f_usd = (result.f  == '' ? 0 : result.f); 
							if(fee){
                            $('#no_of_days_c').val(''); 
                            $('#prg_fee_per_participant_c').val(''); 
							
                            $('#no_of_days_c').val(day);
                            $('#prg_fee_per_participant_c').val(fee);
                            $('#prog_fee_per_participant_usd_c').val(f_usd);
							
							}
							calculateProgramme();  
							/*Added by Ashvin
							* Date:13-11-2018
							* Ticket ID:3784
							* Reason: 35000 * no. of days is Faculty cost(charged expenditure) auto calculate
							* Start
							*/	
														
						    var fCost=0;							    
						    if(day >0){
							   fCost=35000*day;
							   $("#faculty_cost_c").val(fCost);							   
						    }							
								
						   /*Added by Ashvin
							* Date:13-11-2018
							* Ticket ID:3784
							* Reason: 35000 * no. of days is Faculty cost(charged expenditure) auto calculate
							* End
							*/ 
							
							
                        }
                        });
                   }
                   else
                   { 
                        $('#no_of_days_c').val('');                         
                   }
				}
				setTimeout(function(){ cal_no_of_day(); }, 5000);

                $("#btn_project_scrm_budget_1_name, #project_scrm_budget_1_name").blur(function(){
                   cal_no_of_day();
            
                });

                if(day == '') { day = 0; }

                //sight seeing calulations
                
                calculateSoundAndOthers($('#sight_seeing_norms_c').val());

                $('#sight_seeing_norms_c').change(function(){
                
                    calculateSoundAndOthers($('#sight_seeing_norms_c').val());
                
                });

                function calculateSoundAndOthers(value){

                    var pp = parseInt((a=$('#no_of_participants_c').val()) == '' ? 0 : a);
                    var pp_usd = parseInt((a=$('#no_foreign_usd_participants_c').val()) == '' ? 0 : a);
                    var npp = pp + pp_usd;
                    
                    if($.inArray('Golkonda Sound & Light Show', value) !== -1){
                        $('#sound_light_show_c').parent('td').show();
                        $('#sound_light_show_c_label').show();

                        $('#sound_light_show_c').val(parseInt(140*npp));
                    }else{
                        $('#sound_light_show_c').parent('td').hide();
                        $('#sound_light_show_c_label').hide();
                        $('#sound_light_show_c').val(0);
                    }

                    if($.inArray('Ramoji Film City', value) !== -1){
                        $('#ramoji_film_city_c').parent('td').show();
                        $('#ramoji_film_city_c_label').show();
                        $('#ramoji_film_city_c').val(npp*1600);
                    }else{
                        $('#ramoji_film_city_c').parent('td').hide();
                        $('#ramoji_film_city_c_label').hide(); 
                        $('#ramoji_film_city_c').val(0);
                    }

                    if($.inArray('City Tour', value) !== -1){
                        $('#city_tour_c').parent('td').show();
                        $('#city_tour_c_label').show();
                        $('.cthelp').remove();
                        $('#city_tour_c').after('<label class="cthelp">*City Tour based on actual expenses: Chowmohalla: Rs 50/- for Indians & Rs.300/- for foreigners, Charminar: Rs.10/- for Indians & Rs.100/- for foreigners, Salar Jung Museum: Rs.20/- for Indians and Rs.500/- for foreigners<label>')
                    }else{
                        $('#city_tour_c').parent('td').hide();
                        $('#city_tour_c_label').hide();                        
                    }

                    if($.inArray('Others', value) !== -1){
                        $('#others_c').parent('td').show();
                        $('#others_c_label').show();
                    }else{
                        $('#others_c').parent('td').hide();
                        $('#others_c_label').hide();                        
                    }
                }

                //calculate Programme
                var programme_sum;
                $(document).on('blur change paste','#no_of_participants_c, #prog_fee_per_participant_usd_c, #no_foreign_usd_participants_c, #service_tax_c,#usd_to_inr_rate_c',function(){
                    calculateProgramme();
                });   

                function calculateProgramme(){
                    var no_of_p = parseInt((a=$('#no_of_participants_c').val()) == '' ? 0 : a);
                    var fee = parseFloat((a = $('#prg_fee_per_participant_c').val()) == '' ? 0 : a.replace(/,/g , ""));
                    // var tax = parseFloat((a = $('#service_tax_c').val()) == '' ? 0 : a.replace(/,/g , ""));
                    var tax = 0;

                    var fee_usd = parseFloat((a=$('#prog_fee_per_participant_usd_c').val()) == '' ? 0 : a.replace(/,/g , ""));

                    var no_of_p_usd = parseInt((a=$('#no_foreign_usd_participants_c').val()) == '' ? 0 : a);
                    
					/*Added by Ashvin
					  Date:06-12-2018
					  Reason:Conversion Rate
					  Start
					*/
					var conRate=parseFloat((a = $('#usd_to_inr_rate_c').val()) == '' ? 1 : a.replace(/,/g , ""));					
					var total_pro_fee_for_usd=fee_usd * conRate * no_of_p_usd;
					$("#programmefee_for_foreignpart_c").val(total_pro_fee_for_usd);
                    if(no_of_p && fee){

                        // console.log((no_of_p * fee) + (total_pro_fee_for_usd));

                        programme_sum = (no_of_p * fee) + (total_pro_fee_for_usd);
                        $('#total_programme_income_c').val(programme_sum.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    }

                    var revenue = ((no_of_p * fee) + (total_pro_fee_for_usd) + tax);
                    $('#total_revenue_c').val(revenue.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));                      
					
                    if(no_of_p){
                        $('#training_kit_c').val(900*(no_of_p + no_of_p_usd +2));
                        $('#group_photo_c').val((no_of_p+no_of_p_usd+4)*50);
                        $('#faculty_cost_c').val(day*35000);
						
						var training_infra=0.00;
						var training_infra1=0.00;
						var corporate_overhead=0.00;
						if('{$programme_type_c}'=="ICTP-Off Campus" || '{$programme_type_c}'=="Workshop OFF Campus"){
						   training_infra=day*12000;
						   $("#programmes_off_campus_c").val(training_infra);
					    }
					    if('{$programme_type_c}'=="ICTP-On Campus" || '{$programme_type_c}'=="Announced" || '{$programme_type_c}'=='Long Duration' || '{$programme_type_c}'=='Sponsored' || '{$programme_type_c}'=='Workshop ON Campus' || '{$programme_type_c}'=="Seminar"){						   
						   training_infra=(19000+(800*(no_of_p+no_of_p_usd)))*day;
						   corporate_overhead=(12000+(500*(no_of_p+no_of_p_usd)))*day;
						   $("#programmes_at_asci_c").val(training_infra);
					    }
						
						
						$("#corporate_overhead_c").val(corporate_overhead);
                    }
                }

                $(document).on('blur change paste','#LBL_EDITVIEW_PANEL2 input[type=text], #detailpanel_1 input[type=text]',function(){
                    calculateProgramme();
                    update();

                });

                function update(){
					
                    $('#sub_total_cash_exp_c').val(calculateCashExpenditure());
                    $('#sub_total_charge_exp_c').val(calculateChargedExpenditure());
                    $('#contribution_available_ohds_c').val(calculateContributionOverheads());
                    $('#sub_total_overhead_exac_c').val(calculateOverheadsExpenditure());
                    $('#sub_total_overhead_expd_c').val(calculateOverheadExp());

                    $('#total_expenditure_c').val(parseFloat(cashExpenditure) + parseFloat(chargedExpenditure) + parseFloat(overheadExp));
                    if($('#total_programme_income_c').val() != ''){
                        $('#surplus_deficit_c').val(parseFloat((a = $('#total_programme_income_c').val()) == ''? 0 : a.replace(/,/g , "")) -(parseFloat(cashExpenditure) + parseFloat(chargedExpenditure) + parseFloat(overheadExp)));
                    }
                    $('#total_guest_fac_exp_c').val(calculateGuestExp());                    
                    $('#total_c').val(calculateGuestExp());                    
                }

                function calculateOverheadExp(){
                    return overheadExp = parseFloat((typeof $('#training_infrastructure_c').val() =="undefined" ||(a = $('#training_infrastructure_c').val()) == '') ? 0: a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#corporate_overhead_c').val() =="undefined" ||(a = $('#corporate_overhead_c').val()) == '') ? 0: a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#programmes_at_asci_c').val() =="undefined" ||(a = $('#programmes_at_asci_c').val()) == '') ? 0: a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#programmes_off_campus_c').val() =="undefined" ||(a = $('#programmes_off_campus_c').val()) == '') ? 0: a.replace(/,/g , ""));
                }

                var cashExpenditure = 0;
                function calculateCashExpenditure(){					
					
                	/*Somesh Bawane
                	Dt. 1-3-19
                	Reason: As per documentation correction of calculating sight seeing*/

					//calculating sound and light show
					var sound = 0;
					sound = parseFloat($('#sound_light_show_c').val()) * parseFloat(140);
					
					//calculating RFC
					var rfc = 0;
					rfc = parseFloat($('#ramoji_film_city_c').val()) * parseFloat(1600);
					
                    return cashExpenditure = parseFloat((typeof $('#brochure_printing_costs_c').val() =="undefined" ||(a = $('#brochure_printing_costs_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#advertisement_cost_c').val() =="undefined" ||(a = $('#advertisement_cost_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#mailing_costs_c').val() =="undefined" ||(a = $('#mailing_costs_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#training_kit_c').val() =="undefined" ||(a = $('#training_kit_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#group_photo_c').val() =="undefined" ||(a = $('#group_photo_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#books_journals_etc_c').val() =="undefined" ||(a = $('#books_journals_etc_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#mess_charges_c').val() =="undefined" ||(a = $('#mess_charges_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#hostel_charges_c').val() =="undefined" ||(a = $('#hostel_charges_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#arrival_departure_cost_c').val() =="undefined" ||(a = $('#arrival_departure_cost_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#p_reading_material_c').val() =="undefined" ||(a = $('#p_reading_material_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#material_for_distribution_c').val() =="undefined" ||(a = $('#material_for_distribution_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((typeof $('#total_c').val() =="undefined" ||(a = $('#total_c').val()) == '')? 0 : a.replace(/,/g , "")) 
                    + parseFloat((a = $('#sound_light_show_c').val()) == ''? 0 : a.replace(/,/g , "")) 
					+ parseFloat((a = $('#ramoji_film_city_c').val()) == ''? 0 : a.replace(/,/g , "")) 
					+ parseFloat((a = $('#city_tour_c').val()) == ''? 0 : a.replace(/,/g , "")) 
					+ parseFloat((a = $('#others_visits_c').val()) == ''? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#bus_charges_c').val() =="undefined" || (a = $('#bus_charges_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((a = $('#other_misc_expenditure_c').val()) == ''? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#videography_c').val() =="undefined" ||(a = $('#videography_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#cultural_event_c').val() =="undefined" ||(a = $('#cultural_event_c').val()) == '')? 0 : a.replace(/,/g , ""))
					+ parseFloat((typeof $('#fees_c').val() =="undefined" ||(a = $('#fees_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#caps_and_t_shirts_c').val() =="undefined" ||(a = $('#caps_and_t_shirts_c').val()) == '')? 0 : a.replace(/,/g , ""))
					+ parseFloat((typeof $('#business_simulation_c').val() =="undefined" ||(a = $('#business_simulation_c').val()) == '')? 0 : a.replace(/,/g , ""))
					+ parseFloat((typeof $('#module_outsourcing_c').val() =="undefined" ||(a = $('#module_outsourcing_c').val()) == '')? 0 : a.replace(/,/g , ""))
					+ parseFloat((typeof $('#hire_of_laptops_c').val() =="undefined" || (a = $('#hire_of_laptops_c').val()) == '')? 0 : a.replace(/,/g , ""));
                }

                var chargedExpenditure = 0;
                function calculateChargedExpenditure(){
                    return chargedExpenditure = parseFloat((a = $('#faculty_cost_c').val()) == ''? 0 : a.replace(/,/g , ""));        
                }

                function calculateContributionOverheads(){
                    if($('#total_programme_income_c').val() != ''){
                        return parseFloat((a = $('#total_programme_income_c').val()) == ''? 0 : a.replace(/,/g , "") ) - (parseFloat((a = $('#sub_total_cash_exp_c').val()) == '' ? 0 : a.replace(/,/g , ""))); 
                    }
                }
                var overheadsExpenditure = 0;
                function calculateOverheadsExpenditure(){
                    return overheadsExpenditure = parseFloat($('#training_infrastructure_c').val() == ''? 0 : $('#training_infrastructure_c').val()) + parseFloat($('#corporate_overhead_c').val() == ''? 0 : $('#corporate_overhead_c').val());    
                }

                // $(document).on('blur change paste','#brochure_printing_costs_c',function(){
                //  calculateBrochurePrinting();
                // });   

                function calculateBrochurePrinting(){
                    // var brochure_printing_cost = $('#brochure_printing_costs_c').val();
                    // if(brochure_printing_cost){
                    //  var sum = {$budget_configurations->brochure_pr_brochure_per_prg_c} + {$budget_configurations->flagship_prog_brochure_c} + {$budget_configurations->e_brochure_and_e_flyer_c}; 
                    // } 
                }


                //study tour budget
                $(document).on('blur change paste','#LBL_EDITVIEW_PANEL2 input[type=text], #LBL_EDITVIEW_PANEL3 input[type=text], #LBL_EDITVIEW_PANEL7 input[type=text], #LBL_EDITVIEW_PANEL8 input[type=text], #LBL_EDITVIEW_PANEL5 input[type=text], #LBL_EDITVIEW_PANEL9 input[type=text], #LBL_EDITVIEW_PANEL10 input[type=text], #LBL_EDITVIEW_PANEL11 input[type=text]',function(){
                    $('#total_expenditure_k_p_c').val(calculateKP());
                    $('#total_travel_stay_c').val(calculateTravel());
                    $('#total_faculty_allowance_c').val(calculateAllowances());
                    $('#total_other_expenses_c').val(calculateOtherExp());
                    var gt = parseFloat(kp) + parseFloat(travelTotal) + parseFloat(allowances) + parseFloat(otherExp);
                    $('#grand_total_c').val(gt)
                    $('#study_tour_c').val(gt);
                    calculateProgramme();
                    update();
                });
                var a;
                var b;
                var kp = 0;
                function calculateKP(){
                        return kp = parseFloat((b = $('#expenditure_knowledge_prtn_c').val()) == '' ? 0 : b.replace(/,/g , "")) + parseFloat((a = $('#tax_c').val()) == '' ? 0 : (a.replace(/,/g , "")*b.replace(/,/g , ""))/100); 
                }

                var travelTotal = 0;
                function calculateTravel(){
                    return  travelTotal = parseFloat((a = $('#air_fare_participants_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#air_fare_pg_d_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#accomodation_c').val())== '' ? 0 : a.replace(/,/g , ""))+ parseFloat((a = $('#board_food_expenses_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#airport_transfers_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#tour_expenses_coach_c').val())== '' ? 0 : a.replace(/,/g , ""));
                }

                var allowances = 0;
                function calculateAllowances(){
                    return  allowances = parseFloat((a = $('#faculty_per_diem_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#fac_allowance_tour_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#special_grant_warm_cloth_c').val())== '' ? 0 : a.replace(/,/g , ""));
                }

                var otherExp = 0;
                function calculateOtherExp(){
                    return otherExp = parseFloat((a = $('#international_roaming_data_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#miscellaneous_expenses_gift_c').val())== '' ? 0 : a.replace(/,/g , "")) + parseFloat((a = $('#contingencies_c').val())== '' ? 0 : a.replace(/,/g , ""));
                }           

                var guestExp = 0;
                function calculateGuestExp(){
                    return guestExp = + parseFloat((typeof $('#travel_c').val() =="undefined" ||(a = $('#travel_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#honorarium_c').val() =="undefined" ||(a = $('#honorarium_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#incidentals_c').val() =="undefined" ||(a = $('#incidentals_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					+ parseFloat((typeof $('#mementoes_c').val() =="undefined" ||(a = $('#mementoes_c').val()) == '')? 0 : a.replace(/,/g , "")) 
					;
					/*+ parseFloat((typeof $('#total_c').val() =="undefined" ||(a = $('#total_c').val()) == '')? 0 : a.replace(/,/g , ""))*/
				}
 

            }); 

        </script>
EOD;
        parent::display();
    }
}
