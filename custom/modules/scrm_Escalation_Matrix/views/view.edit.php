<?php

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


class scrm_Escalation_MatrixViewEdit extends ViewEdit {   
function scrm_Escalation_MatrixViewEdit() {
 		parent::ViewEdit();
 	}
//global $db;

    public function display() {
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
		//echo $id;

		
	echo "<script>
		$(document).ready(function() {
			
		var team=$('#teams_c').val();
		
		var total;
					$.ajax({
										url: 'team_exists.php',
										type:'GET',
										async: false,
										data:{
											team : team, 
											
											},
										}).done(function(data){
										total=data;	
									});
			if(total>1){
				
				$('#teams_c').parent().append('<span class = \"remove\" style=\"color:red\">Escalation Settings are defined for selected Team</span>');
				$('#SAVE_HEADER').attr('disabled',true);
				$('#SAVE_FOOTER').attr('disabled',true);
			}
			else{
				$('#SAVE_HEADER').attr('disabled',false);
				$('#SAVE_FOOTER').attr('disabled',false);
			}
			$('#teams_c').on('change',function(){
			var team=$('#teams_c').val();
			var team_name=$('#teams_c').text();
			//~ alert(team);
			//~ alert(team_name);
			var total;
			var total_correct;
			var id;
					$.ajax({
										url: 'team_exists.php',
										type:'GET',
										async: false,
										data:{
											team : team, 
											
											},
										}).done(function(data){
										total=data.split(',');
										//alert(total);
										total_correct=total['0'];
										//alert(total_correct);
										id=total['1'];
										//$id1=id;
										//alert(id);
									});
			if(total_correct>=1 && id!='$id'){
				
				
				$('#teams_c').parent().append('<p class = \"remove\"><span class = \"remove\" style=\"color:red\">Escalation Specs are already defined for team, Kindly use the below link to modify/update the settings</span><br class=\"remove\"><a href=\'$site_url/index.php?module=scrm_Escalation_Matrix&return_module=scrm_Escalation_Matrix&action=EditView&record='+id+'\' class = \"remove\">Escalation URL</a></p>');
				$('#SAVE_HEADER').attr('disabled',true);
				$('#SAVE_FOOTER').attr('disabled',true);
			}
			else{
				$('.remove').html('');
				$('#SAVE_HEADER').attr('disabled',false);
				$('#SAVE_FOOTER').attr('disabled',false);
			}
			
			});
		var escalationlevel = $('#escalation_level_c').val();
		var escalation_level_one_mins = $('#escalation_minutes_level1_c').val();

		$('#escalation_minutes_level2_c option').filter(function() {
			return $(this).val() <= escalation_level_one_mins;
		}).attr('disabled', true);
		var escalation_level_two_mins = $('#escalation_minutes_level2_c').val();
		$('#escalation_minutes_level3_c option').filter(function() {
			return $(this).val() <= escalation_level_two_mins;
		}).attr('disabled', true);
		
		if(escalationlevel.indexOf('Level1') != -1){
			
			$('#detailpanel_2').show();
			
		}
		else{
			$('#detailpanel_2').hide();				
			$('#escalation_minutes_level1_c').val('');
		}
		if(escalationlevel.indexOf('Level2') != -1){
			$('#detailpanel_3').show();
			
		}
		else{
			$('#detailpanel_3').hide();	
			$('#escalation_minutes_level2_c').val('');
		}
		if(escalationlevel.indexOf('Level3') != -1){
			$('#detailpanel_4').show();
			
		}
		else{
			$('#detailpanel_4').hide();
			$('#escalation_minutes_level3_c').val('');	
		}
		$('#escalation_minutes_level1_c').bind('change', function(event) {
			
			var escalation_level_one_mins = $('#escalation_minutes_level1_c').val();
			//alert(escalation_level_one_mins);
			$('#escalation_minutes_level2_c option').filter(function() {
				return $(this).val() <= escalation_level_one_mins;
			}).attr('disabled', true);
			$('#escalation_minutes_level2_c option').filter(function() {
				return $(this).val() > escalation_level_one_mins;
			}).attr('disabled', false);
		});
		$('#escalation_minutes_level2_c').bind('change', function(event) {
			
			var escalation_level_two_mins = $('#escalation_minutes_level2_c').val();
			$('#escalation_minutes_level3_c option').filter(function() {
				return $(this).val() <= escalation_level_two_mins;
			}).attr('disabled', true);
				var escalation_level_two_mins= $('#escalation_minutes_level2_c').val();
			$('#escalation_minutes_level3_c option').filter(function() {
				return $(this).val() > escalation_level_two_mins;
			}).attr('disabled', false);
		});
		$('#escalation_level_c').bind('change', function() {
			
			var escalationlevel = $('#escalation_level_c').val();
			if(escalationlevel.indexOf('Level1') != -1){
				$('#detailpanel_2').show();
				
			}
			else{
				$('#detailpanel_2').hide();	
				$('#escalation_minutes_level1_c').val('');
			}
			if(escalationlevel.indexOf('Level2') != -1){
				$('#detailpanel_3').show();
				
			}
			else{
				$('#detailpanel_3').hide();	
				$('#escalation_minutes_level2_c').val('');
			}
			if(escalationlevel.indexOf('Level3') != -1){
				$('#detailpanel_4').show();
				
			}
			else{
				$('#detailpanel_4').hide();	
				$('#escalation_minutes_level3_c').val('');
			}
		});
		});
     </script>";

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
