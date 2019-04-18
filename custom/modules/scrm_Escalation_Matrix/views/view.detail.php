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


class scrm_Escalation_MatrixViewDetail extends ViewDetail {   
function scrm_Escalation_MatrixViewDetail() {
 		parent::ViewDetail();
 	}

    public function display() {

		//$id = $_REQUEST['record'];
         $js1 = <<<YUO
	<script>
	//var j=0,k=0;
	$(document).ready(function(){
		var escalationlevel = $('#escalation_level_c').val();
		//alert(escalationlevel);
		if(escalationlevel.indexOf('Level1') != -1){
			
			$('#detailpanel_2').show();
		}
		else{
			$('#detailpanel_2').hide();
		}
		if(escalationlevel.indexOf('Level2') != -1){
			
			$('#detailpanel_3').show();
		}
		else{
			$('#detailpanel_3').hide();
		}
		if(escalationlevel.indexOf('Level3') != -1){
			
			$('#detailpanel_4').show();
		}
		else{
			$('#detailpanel_4').hide();
		}
});
	</script>
YUO;
echo $js1;
parent::display();
	}
}
