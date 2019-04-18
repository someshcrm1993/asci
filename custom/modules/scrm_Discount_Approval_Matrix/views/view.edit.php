<?php
//~ ini_set('display_errors','On');
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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

class scrm_Discount_Approval_MatrixViewEdit extends ViewEdit
{
	
 	public function __construct()
 	{
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
 	
 	public function display(){
		global $db,$sugar_config;
		
		$site_url = $sugar_config['site_url'];
		
		//Dynamic Teams Dropdown
		$select_teams ="select id, name from securitygroups where deleted='0'";
        $select_teams_result = $db->query($select_teams);
       
       
        while ($select_teams_row = $db->fetchByAssoc($select_teams_result)) {
			$teams_arr[$select_teams_row['id']]=$select_teams_row['name'];             
        }
        
        $original_dd_name=$this->fetch_field_options('SecurityGroups','teams_list');
		$GLOBALS['app_list_strings'][$original_dd_name]=$teams_arr;
		
		$id=$this->bean->id;
		echo $javascript = <<<EOD
		<script>
		$(document).ready(function(){
		$('#detailpanel_2').hide();
		$('#detailpanel_3').hide();
		$('#detailpanel_4').hide();
		var approval_level = $('#approval_levels_c').val();
			if(approval_level.indexOf('Level1') != -1){
				$('#detailpanel_2').show();
				
			}
			else{
				$('#detailpanel_2').hide();	
				$('#discount1_c').val('');
			}
			if(approval_level.indexOf('Level2') != -1){
				$('#detailpanel_3').show();
				
			}
			else{
				$('#detailpanel_3').hide();	
				$('#discount2_c').val('');
			}
			if(approval_level.indexOf('Level3') != -1){
				$('#detailpanel_4').show();
				
			}
			else{
				$('#detailpanel_4').hide();	
				$('#discount3_c').val('');
			}
		$('#approval_levels_c').bind('change', function() {
			var approval_level = $('#approval_levels_c').val();
			if(approval_level.indexOf('Level1') != -1){
				$('#detailpanel_2').show();
				
			}
			else{
				$('#detailpanel_2').hide();	
				$('#discount1_c').val('');
			}
			if(approval_level.indexOf('Level2') != -1){
				$('#detailpanel_3').show();
				
			}
			else{
				$('#detailpanel_3').hide();	
				$('#discount2_c').val('');
			}
			if(approval_level.indexOf('Level3') != -1){
				$('#detailpanel_4').show();
				
			}
			else{
				$('#detailpanel_4').hide();	
				$('#discount3_c').val('');
			}
			});
		});
		</script>
EOD;
	parent::display();	
	}
	 function fetch_field_options($module,$field) {
           
		global $dictionary,$sugar_config,$beanFiles,$beanList,$app_strings;
		$bean_name = $beanList[$module];
		require_once($beanFiles[$bean_name]);
		$mod_obj = new $bean_name();
		 //~ echo "<pre>"; print_r($mod_obj->field_defs);
		foreach ($mod_obj->field_defs as $key=>$value)
		{
			if($key==$field)
			{
				return $value['options'];
			}
			
		}
	}
}
?>
