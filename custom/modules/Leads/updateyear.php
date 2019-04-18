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


class updateyear
{
    function updateyearfunc($bean, $event, $arguments)
    {
		$programmeBean = $bean->get_linked_beans('project_leads_1','Project');
    	if (count($programmeBean)>0) {
    		if (isset($programmeBean[0]) && isset($programmeBean[0]->id)) {
    			$programme = BeanFactory::getBean('Project',$programmeBean[0]->id);
				if(!empty($programme))
				$bean->programme_year_c = $programme->programme_year_c;    		}
    	}
    }
}
?>
