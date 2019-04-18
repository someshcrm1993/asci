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

class scrm_Admin_ArrangesViewDetail extends ViewDetail
{
 	
 	function scrm_stationeryViewDetail(){
 		parent::ViewDetail();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
        $role = ACLRole::getUserRoleNames($current_user->id);
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }else{
            //role is admin
            $role = 'admin';
        }       
        echo '<div id = "sync" title= "Warning!!!" style="display:none"><p>Programme date and Admin Arrangement date are not in synchronisation!!</p></div>';
        $synchronisation = 2;
        if ($pid = $this->bean->scrm_admin_arranges_project_1project_idb) {
              $projectBean = BeanFactory::getBean('Project',$pid);

              if($projectBean->start_date_c != $this->bean->programme_from_date_c || $projectBean->end_date_c != $this->bean->programme_to_date_c){
                    $synchronisation = 3;
                    echo '<p style="color:red">*Programme date and Admin Arrangement date are not in synchronisation!</p>';
              }  
        }       

    	$projectBean = BeanFactory::getBean('Project',$this->bean->scrm_admin_arranges_project_1project_idb);
    	echo '<div class="inlineEditIcon"> <!--?xml-stylesheet type="text/css" href="../css/style.css" ?--> <!--?xml-stylesheet type="text/css" href="../css/colourSelector.php" ?--> <svg version="1.1" id="inline_edit_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"> <g class="icon" id="Icon_6_"> <g> <path class="icon" d="M64,368v80h80l235.727-235.729l-79.999-79.998L64,368z M441.602,150.398 c8.531-8.531,8.531-21.334,0-29.865l-50.135-50.135c-8.531-8.531-21.334-8.531-29.865,0l-39.468,39.469l79.999,79.998 L441.602,150.398z"></path> </g> </g> </svg> </div>';
    	echo <<<JS
		<script>
 		$(document).ready(function(){
            if('{$synchronisation}' == 3){
                $('#sync').dialog();
            }            
 			var ppd = '<tr><td><div style="padding-top:20px"><a href="javascript;"><i class="fa fa-user fa-6" aria-hidden="true" style="font-size: 3em;"></i></a></div></td><td></td><td><div style="padding-top:20px;float:left;padding-right: 30px;"><div style=""><strong>Primary Programme Director</strong></div><div>{$projectBean->assigned_user_name}</div></div><div style="padding-top:20px;float:left;"><div style=""><strong>Secondary Programme Director</strong></div><div>{$projectBean->spd_c}</div></div><div style="padding-top:20px;float:left;padding-left: 25px;"><div style=""><strong>Programme Code</strong></div><div>{$projectBean->programme_id_c}</div></div></td></tr>';

          	$('.moduleTitle table').eq(0).find('td table').eq(0).append(ppd);
            $('#scrm_admin_arranges_scrm_industry_educational_visits_1_create_button').click(function(){
                setTimeout(function(){
                    $('#participants_c').val({$this->bean->no_of_participants_c});
                    console.log($('#participants_c').val({$this->bean->no_of_participants_c})); 
                },2000);
            });

		});
		</script>
JS;
    	parent::display();
    }
}
