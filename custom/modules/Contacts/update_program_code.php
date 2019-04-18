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

class update_program_code
{
    static $already_ran = false;
    public function program_code($bean)
    {
		
        
        global $db, $sugar_config;
		//print_r($bean->project_contacts_2project_ida);exit;
		$idddd=$bean->project_contacts_2project_ida;
		 $query="select id_c, programme_id_c as programme_id_c from project_cstm where id_c = '".$idddd."'";
		$fullrecord_result   = $db->query($query);
		$getrecords = $db->fetchByAssoc($fullrecord_result);
        
		$record_id = $bean->id;
		  $query1 ="UPDATE contacts_cstm SET programme_id_c ='".$getrecords['programme_id_c']."'  WHERE id_c = '".$record_id."'";
		 $db->query($query1);
		
    }
    
    
}

?>