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

class scrm_AccommodationViewDetail extends ViewDetail
{
 	
 	function scrm_AccommodationViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
     //    ob_clean();
    	// print_r($this->bean);exit();
        // ob_clean();
        // print_r($this->bean->name);exit();
        $participants = json_decode(html_entity_decode($this->bean->participants_c));
        $participants = array_map(function($o){ 
                                    return '<li class="list-group-item"><a target="_blank" href="'.$sugar_config["site_url"].'?&action=DetailView&module=Contacts&record='.$o->id.'">'.$o->name.'</a></li>';
                                 }, $participants
                        );
        $this->bean->participants_c = '<ul class="list-group">'.implode('', $participants).'</ul>';        
    	
        echo <<<EOD
    		<script>
    			$(document).ready(function(){
                    $('#participant_list_c').parent('div').parent('div').hide();
	    			$('#room_no_c').after({$this->bean->room_no_c});
                    $('#room_no_bv_c').parent('div').parent('div').hide();
                    $('#room_no_cpc_new_c').parent('div').parent('div').hide();
                    $('#room_no_cpc_old_c').parent('div').parent('div').hide();
                    $('#room_no_ndc_c').parent('div').parent('div').hide();
                    $('#whole_subpanel_scrm_accommodation_contacts_1').hide();
                    var value = '{$this->bean->guest_type_c}';
                    console.log(value);

                    if( value== 'Guest Faculty' || value == 'Guest Speaker' || value == 'Faculty' || value == 'DG'){
                        $('#contacts_scrm_accommodation_1contacts_ida').parent().parent('div').hide();
                    }else{
                        $('#scrm_partners_scrm_accommodation_1scrm_partners_ida').parent().parent('div').hide();
                    }          

                    if('{$this->bean->accommodation_type_c}' == 'Hotel'){
                            
                            $('#location_c').parent().parent('td').hide();

                            $('#type_of_room_c').parent().parent('td').hide();
                            
                            // $('#no_of_adults_c').parent().parent('td').hide();
                            
                            // $('#no_of_children_c').parent().parent('td').hide();

                            // $('#check_in_c_date').parent().parent('td').hide();

                            // $('#check_out_c_date').parent().parent('td').hide();

                            $('#room_no_c').parent('div').parent('div').hide();
                    }           
    			});
    		</script>
EOD;
// print_r(error_get_last());exit();
 		parent::display();
    }
}
