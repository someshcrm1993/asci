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
class updateFields{
	
	public function updateFields($bean)
	{
		echo "<pre>";
		print_r($bean);exit;
		// $bean->start_time_c = date_create_from_format('Y-m-d H:i',$bean->date1_c.' '.$bean->start_time_c)->format('Y-m-d H:i:s');
		// $bean->end_time_c = date_create_from_format('Y-m-d H:i',$bean->date1_c.' '.$bean->end_time_c)->format('Y-m-d H:i:s');

		// $bean->save();

	}
}

?>
