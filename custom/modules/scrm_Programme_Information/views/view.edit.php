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

class scrm_Programme_InformationViewEdit extends ViewEdit {
	function scrm_Programme_InformationViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}
	
	function display(){
		parent::display();
		global $db;
		$wid = $_REQUEST['scrm_work_order_id'];
		$scrm_work_order = BeanFactory::getBean('scrm_Work_Order',$_REQUEST['scrm_work_order_id']);
		$proposal = BeanFactory::getBean('Opportunities',$scrm_work_order->scrm_work_order_opportunities_1opportunities_idb);
		$offeredProgramme = $db->query("SELECT p.id as id,p.name as name,p.status as status,pc.programme_type_c 
		FROM opportunities o
		JOIN opportunities_scrm_programme_details_1_c op ON op.opportunities_scrm_programme_details_1opportunities_ida = o.id
		JOIN scrm_programme_details pd ON pd.id = op.opportunities_scrm_programme_details_1scrm_programme_details_idb
		JOIN scrm_programme_details_cstm pdc ON pdc.id_c = pd.id
		JOIN project p ON p.id = pdc.project_id_c join project_cstm pc on pc.id_c = p.id where o.deleted = 0 and pd. deleted = 0 and op.deleted = 0 and p.deleted = 0 and o.id = '$proposal->id' and p.status = 'Offered' and p.id not in (select pic.project_id_c from scrm_work_order_scrm_programme_information_1_c wp join scrm_programme_information_cstm pic on pic.id_c = wp.scrm_work_f5d3rmation_idb where wp.deleted = 0 and wp.scrm_work_order_scrm_programme_information_1scrm_work_order_ida ='$wid')");
	    $programmeList = '<div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title" style="text-align:center !important">Organisations</h4> </div> <div class="modal-body"> <table class="table table-striped table-responsive"> <thead style="text-align:center !important"><tr> <th>Programme Name</th><th>Proposed Programme Status</th> </tr> </thead> <tbody style="text-align:center !important">';
	    while($row = $db->fetchByAssoc($offeredProgramme)){
	    	$id = $row['id'];
	    	$name = $row['name'];
	    	$status = $row['status'];
	    	$programme_type_c = $row['programme_type_c'];
            $programmeList .= '<tr><td><a onclick="sendValues(\''.$id.'\',\''.$name.'\',\''.$programme_type_c.'\');" data-name="'.$id.'"  data-id ="'.$organisationsId.'" class="programme">'.$name.'</a></td><td><span class="label label-info">'.$status.'</span></td></tr>'; 
		}

        $programmeList .='</tbody> </table> </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div> </div>';
        echo $programmeList;
		echo $js = <<<eod
		<script>
		function sendValues(id,name,type){
			$('#programme_c').val(name);
			$('#project_id_c').val(id);
			$('#programme_type_c').val(type);
			$('#myModal').modal('toggle');
		}
			$(document).ready(function(){
				$('#btn_programme_c').after('<button type="button" id="org" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><img src="themes/default/images/id-ff-select.png"></button> ');

				$('#btn_programme_c').hide();
				$('#programme_c').attr('readonly',true);
				// $('#btn_programme_c,#programme_c').on('change blur',function(){
				// 	var id = $('#project_id_c').val();
				// 	$.ajax({
				// 	  method: "POST",
				// 	  url: "index.php?entryPoint=ajaxCall",
				// 	  data: {type:"getProgrammeType",pid: id}
				// 	}).success(function(rsp){
				// 		rsp = JSON.parse(rsp);
				// 		$('#programme_type_c').val(rsp);
				// 		console.log(rsp);
				// 	});			
				// });
			});
eod;
	}
	
}
?>
