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

   
    class NomineeColorCoding
    {
        function showstatus($bean, $event, $arguments)
        {
            global $db;
 
            switch ($bean->nomination_status_c) {

                case 'Accepted':
                $color = 'label-success';
                break;
                case 'Screened by PO':
                $color = 'label-primary';
                break;
                case "Nomination Received":
                $color = 'label-default';
                break;
                case "Dropped Out":
                $color = 'label-warning';
                break;
                case 'Rejected':
                $color = 'label-danger';
                break;
                case 'Commitment':
                $color = 'label-info';
                break;
                
            }
            $bean->nomination_status_c = '<span class="label '.$color.'">'.$GLOBALS['app_list_strings']['nomination_status_list'][$bean->nomination_status_c].'</span>';
            $id = $bean->id;
            $checkImageResult = $db->query("select photo from contacts where id = '$id'");
            $imageRow = $db->fetchByAssoc($checkImageResult);
            $img = $imageRow['photo'];
            if(isset($img)){
                $bean->event_status_id = '<img src="index.php?entryPoint=download&amp;id='.$id.'_photo&amp;type=Contacts" style="max-width: 50px;max-height: 30px; border-radius: 100px;" height="80">';
            }else{
                $bean->event_status_id = '<img src="custom/modules/Contacts/user.png" style="max-width: 50px;max-height: 30px; border-radius: 100px;" height="80">';
            }
           
            
        }
    }

?>
