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

class scrm_BudgetViewDetail extends ViewDetail
{

    function display()
    {
        global $sugar_config;
        $projectBean = BeanFactory::getBean('Project',$this->bean->project_scrm_budget_1project_ida);
        $url = $sugar_config['site_url'];
        // echo $url;exit;
		$overSeas = $projectBean->overseas_tour_c;  
        echo <<<EOD
        <script>
                $(document).ready(function(){
					
					if("{$overSeas}" == "No" || "{$overSeas}" == ""){
						$('#detailpanel_9').hide();
						$('#study_tour_c').parent('td').hide();
						$('#study_tour_c_label').hide();
						
					}
                    $('#detailpanel_4 h4').text('');
                    var ppd = '<tr><td><div style="padding-top:20px"><a href="javascript;"><i class="fa fa-user fa-6" aria-hidden="true" style="font-size: 3em;"></i></a></div></td><td></td><td><div style="padding-top:20px;float:left;padding-right: 30px;"><div style=""><strong>Primary Programme Director</strong></div><div>{$projectBean->assigned_user_name}</div></div><div style="padding-top:20px;float:left;"><div style=""><strong>Secondary Programme Director</strong></div><div>{$projectBean->spd_c}</div></div><div style="padding-top:20px;float:left;padding-left: 25px;"><div style=""><strong>Programme Code</strong></div><div>{$projectBean->programme_id_c}</div></div></td></tr>';

                    $('.moduleTitle table').eq(0).find('td table').eq(0).append(ppd);

                    $('#detail_header_action_menu').before('<a href="{$url}/index.php?module=scrm_Budget&action=printDoc&id={$this->bean->id}" class="btn btn-info btn-sm" style="margin-right: 14px;">View Budget</a>');
                });   
        </script>
EOD;
        parent::display();
    }
}
