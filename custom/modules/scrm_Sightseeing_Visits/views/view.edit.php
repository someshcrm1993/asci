<?php

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

require_once('modules/Project/views/view.edit.php');

class scrm_Sightseeing_VisitsViewEdit extends ViewEdit{
	
	function scrm_Sightseeing_VisitsViewEdit(){
		parent::ViewEdit();
		$this->useForSubpanel = true;

 	}
    
    public function display(){

    	echo <<<EOD
    		<script>
    			$(document).ready(function(){
    				
    				visitNameDropdownCheck();	
    				$('#visit_names_c').change(function(){
    					visitNameDropdownCheck();
    				});

    				function visitNameDropdownCheck(){
						if($('#visit_names_c').val() == 'other'){
							$('#description_label').show();
							$('#description').parent('td').show();
						}else{
							$('#description_label').hide();
							$('#description').parent('td').hide();							
						}    					
    				}
    			});
    		</script>
EOD;
		parent::display();
    }
}
