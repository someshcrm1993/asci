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

   
    class updateRelationships
    {
    	static $already_ran = false;
        function updateRelationships($bean, $event, $arguments)
        {
        	if(self::$already_ran == true) return;
        	self::$already_ran = true;

        	if ($bean->participants_c) {
        		$participants = json_decode(html_entity_decode($bean->participants_c));
        		
                $accommodationId = $bean->id;
        		foreach ($participants as $key => $value) {
							
					$contactId = $value->id;

                    $bean->last_name = $value->name;
                    $bean->first_last_name = '';
					$bean->load_relationship('scrm_accommodation_contacts_1');

					$bean->scrm_accommodation_contacts_1->add($contactId);
				}        			
        	}
            // global $db;
            // $db->query("UPDATE scrm_accommodation SET last_name = '$bean->last_name', first_last_name= '$bean->last_name' WHERE id = '$bean->id'");
            // $bean->save();
        }
    }

?>
