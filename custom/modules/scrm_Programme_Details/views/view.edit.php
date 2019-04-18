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


require_once('include/MVC/View/views/view.edit.php');

class scrm_Programme_DetailsViewEdit extends ViewEdit {
	public $useForSubpanel = true;
	function scrm_Programme_DetailsViewEdit(){
 		parent::ViewEdit();
 	}
	
	function display(){
		parent::display();
		echo <<<JS

        <script>
        	$(document).ready(function(){
				$('#duration_in_working_days_c, #number_of_batches_c').change(function(){
                     var total = $('#duration_in_working_days_c').val() * $('#number_of_batches_c').val();
                    $('#total_no_of_calendar_week_c').val(total);
                });
                $('#btn_programme_c,#programme_c').on('change blur',function(){
					var id = $('#project_id_c').val();
					$.ajax({
					  method: "POST",
					  url: "index.php?entryPoint=ajaxCall",
					  data: {type:"getProgrammeType",pid: id}
					}).success(function(rsp){
						rsp = JSON.parse(rsp);
						$('#programme_type_c').val(rsp);
						console.log(rsp);
					});			
				});
            });
JS;
	}
	
}
?>
