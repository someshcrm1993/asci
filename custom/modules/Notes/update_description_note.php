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

class UpdateDescriptionNote{

function updateDescriptionFunctionNote($bean, $event, $arguments){

 global $db;
 $record_id = $bean->id;
 $query1 ="UPDATE  notes SET description = REPLACE(description, ', Tweeted by :', '\r\nTweeted by :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query1);

 $query2 ="UPDATE  notes SET description = REPLACE(description, ', Tweeted on :', '\r\nTweeted on :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query2);


 $query3 ="UPDATE  notes SET description = REPLACE(description, ', Link to tweet :', '\r\nLink to tweet :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query3);

 $query4 ="UPDATE  notes SET description = REPLACE(description, ', Posted On :', '\r\nPosted On :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query4);

 $query5 ="UPDATE  notes SET description = REPLACE(description, ', Link to Facebook Profile :', '\r\nLink to Facebook Profile :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query5);

 $query4 ="UPDATE  notes SET description = REPLACE(description, ', Link to Post :', '\r\nLink to Post :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query4);

}

}



