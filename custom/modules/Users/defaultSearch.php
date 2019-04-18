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

include('modules/MySettings/StoreQuery.php');
class defaultSearch 
{ 
  function filterList(&$bean, $event, $arguments) 
  { 
    global $current_user, $sugar_config,$db;
    // create instance of StoreQuery
    
    $uid = $current_user->id;

    $yearQuery = $db->query("select uc.programme_year_c from users_cstm uc join users u on uc.id_c = u.id where uc.id_c = '$uid' and u.deleted = 0");
    $yearrow = $db->fetchByAssoc($yearQuery);
    $year = $yearrow['programme_year_c'];

    $this->setDefaultFilter($year);


    //Store the unique user id and logged in date
    $todayDate = date('Y-m-d');

    $checkLoggedinQuery = $db->query("select count(user_id) as count from users_audit where user_id = '$uid' and logged_in_date = '$todayDate'");
    $checkLoggedinQueryrow = $db->fetchByAssoc($checkLoggedinQuery);
    $count = $checkLoggedinQueryrow['count'];

    if(empty($count)){
        $insertUserIDQuery = $db->query("insert into users_audit (user_id,logged_in_date) values ('$uid','$todayDate')");
    }
   

  }

  function updatefilter(&$bean, $event, $arguments) 
  {
    global $current_user, $sugar_config,$db;
    $year = $bean->programme_year_c;
    $this->setDefaultFilter($year);
  }

  function setDefaultFilter($year){

    $startdate = date('d-m-').$year;
    $toyear = $year+1;
    $enddate = date('d-m-Y',strtotime('+30 days',strtotime($startdate)));
    $squery= new StoreQuery();
     //specify query and save
    $squery->query=array('programme_year_c_basic'=>$year,'start_range_start_date_c_basic'=>$startdate,'start_date_c_basic_range_choice'=>'between','end_range_start_date_c_basic'=>$enddate, 'module'=>'Project','searchFormTab'=>'basic_search','query'=>'true','action'=>'index');
    // $squery->query=array('programme_year_c_basic'=>$year,'start_range_start_date_c_basic'=>'','start_date_c_basic_range_choice'=>'next_30_days','end_range_start_date_c_basic'=>'', 'module'=>'Project','searchFormTab'=>'basic_search','query'=>'true','action'=>'index');
    $squery->SaveQuery('Project');

    $squery->query=array('programme_year_c_basic'=>$year, 'module'=>'Contacts','searchFormTab'=>'basic_search','query'=>'true','action'=>'index');
    $squery->SaveQuery('Contacts');


  }
}
