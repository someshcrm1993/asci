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

   
    class ColorCoding
    {
        function showstatus($bean, $event, $arguments)
        {
            global $db;
 
        	switch ($bean->programme_type_c) {

        		case 'Announced':
        		$color = 'label-default';
        		break;
        		case "ICTP-On Campus":
        		$color = 'label-primary';
        		break;
        		case "ICTP-Off Campus":
        		$color = 'label-success';
        		break;
                case 'Seminar':
                $color = 'label-info';
                break;
                case 'Sponsored':
                $color = 'label-info';
                break;
                case 'Workshop ON Campus':
                $color = 'label-info';
                break;
        		case 'Workshop OFF Campus':
        		$color = 'label-info';
        		break;
        		case 'Long Duration':
        		$color = 'label-warning';
        		break;
        		
        	}

            switch ($bean->status) {
                case 'Offered':
                    $statuscolor = 'label-success';
                    break;
                
                case 'Not Offered':
                    $statuscolor = 'label-danger';
                    break;
                
                case 'Cancelled':
                    $statuscolor = 'label-warning';
                    break;
                
                case 'Deferred':
                    $statuscolor = 'label-info';
                    break;
                
                case 'Conducted':
                    $statuscolor = 'label-default';
                    break;
                    
                case 'Proposal Stage':
                    $statuscolor = 'label-primary';
                    break;
            }

            $bean->programme_type_c = '<span class="label '.$color.'">'.$bean->programme_type_c.'</span>';
        	$bean->status = '<span class="label '.$statuscolor.'">'.$bean->status.'</span>';
            $contacts = $bean->get_linked_beans('project_contacts_2');
            $status = array();
            foreach ($contacts as $value) {
                $status[] = $value->nomination_status_c;
            }
            $countstatus = array_count_values($status);
            $noofparticipants = (empty($countstatus["Accepted"])) ? '0' : $countstatus["Accepted"];
            $bean->priority = '<span class="label label-info">'.count($status).' N</span>';
            $bean->priority .= '<span class="label label-success" style="margin-left: 5px;">'.$noofparticipants.' P</span>';
            
        }
    }

?>
