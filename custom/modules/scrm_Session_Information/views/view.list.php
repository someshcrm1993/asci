<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class scrm_Session_InformationViewList extends ViewList
{
	 public function __construct() {
        parent::ViewList();
        $this->useForSubpanel = true;
        //~ $this->useModuleQuickCreateTemplate = true; 
    }

 	public function display()
 	{

        // $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
 		parent::display();
 	}

    // public function listViewPrepare() {
    //     if(empty($_REQUEST['orderBy'])) { //check if the user has asked for an order, if not proceed 
    //             $_REQUEST['orderBy'] = 'start_time_c'; //set the field to order by NOTE: MUST BE ALL CAPS! 
    //             $_REQUEST['sortOrder'] = 'asc'; //set the order, ascending or descending 
    //     } 
    //     parent::listViewPrepare(); //continue running the extended function's code        
    // }
}
