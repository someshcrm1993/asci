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


class UpdateDescriptionCase{

function updateDescriptionFunctionCase($bean, $event, $arguments){

 global $db;
 $record_id = $bean->id;
 $query1 ="UPDATE  cases SET description = REPLACE(description, ', Tweeted by :', '\r\nTweeted by :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query1);

 $query2 ="UPDATE  cases SET description = REPLACE(description, ', Tweeted on :', '\r\nTweeted on :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query2);


 $query3 ="UPDATE  cases SET description = REPLACE(description, ', Link to tweet :', '\r\nLink to tweet :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query3);


 $description = $bean->description;
 //~ $GLOBALS['log']->fatal('Logic Hook Description : '.$description);

//7d5a5375-9d06-9549-56a6-565470343d66

//UPDATE  cases SET description = REPLACE(description, ', Tweeted by :', '\r\nTweeted by :') WHERE id = '7d5a5375-9d06-9549-56a6-565470343d66' AND deleted=0
//UPDATE  cases SET description = REPLACE(description, ', Link to tweet :', '\r\nLink to tweet :') WHERE id = '7d5a5375-9d06-9549-56a6-565470343d66' AND deleted=0

}

}



