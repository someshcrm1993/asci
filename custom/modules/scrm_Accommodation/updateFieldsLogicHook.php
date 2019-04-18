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

   
    class updateFields
    {
    	static $already_ran = false;
        function updateName($bean, $event, $arguments)
        {
        	if(self::$already_ran == true) return;
        	self::$already_ran = true;
			if ($bean->location_c == "Bella Vista") {
				$bean->room_no_c = $bean->room_no_bv_c;
			}else if ($bean->location_c == "CPC_NEW") {
				$bean->room_no_c = $bean->room_no_cpc_new_c;			
			}else if ($bean->location_c == "CPC_OLD") {
				$bean->room_no_c = $bean->room_no_cpc_old_c;			
			}else if ($bean->location_c == "NDC") {
				$bean->room_no_c = $bean->room_no_ndc_c;			
			}

            //$bean->save();
        }
    }
    /*
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class updateFields
{
	//static $already_ran = false;

	public function updateFields($bean)
	{
		// if(self::$already_ran == true) return;
  //     	self::$already_ran = true;

		$bean->name = $bean->contacts_scrm_accommodation_1_name;

		// if ($bean->location_c == "Bella Vista") {
		// 	$bean->room_no_c = $bean->room_no_bv_c;
		// }else if ($bean->location_c == "CPC_NEW" || $bean->location_c == "CPC_OLD") {
		// 	$bean->room_no_c = $bean->room_no_cpc_c;			
		// }else if ($bean->location_c == "NDC") {
		// 	$bean->room_no_c = $bean->room_no_ndc_c;			
		// }		

	}

	// public function updateFieldsAS($bean)
	// {

	// 	$bean->name = $bean->contacts_scrm_accommodation_1_name;
	// 	$beanF = BeanFactory::getBean('scrm_Accommodation',$bean->id);

	// 	$beanF->name = $beanF->contacts_scrm_accommodation_1_name;
	// 	// print_r($beanF->name);exit();
	// 	$beanF->save();
	// 	$GLOBALS['log']->fatal($bean->id."bean id");
	// 	$GLOBALS['log']->fatal($beanF->name."bean id testing");
	// }
}
*/
?>
