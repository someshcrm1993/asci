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

class updateFields
{
	
	public function updateFields($bean)
	{
	  $GLOBALS['log']->logLevel('Fatal');
	  $GLOBALS['log']->fatal('after save');			
		global $app_list_strings;

		$bean->name = $app_list_strings['events_list'][$bean->events_c];
		$bean->save();
	}

	public function after_save_method($bean)
	{
	  $GLOBALS['log']->logLevel('Fatal');
	  $GLOBALS['log']->fatal('after save');	
	}
}

?>
