<?php
include('modules/MySettings/StoreQuery.php');
class defaultSearch 
{ 
  function filterList(&$bean, $event, $arguments) 
  { 
    global $current_user, $sugar_config;
    // create instance of StoreQuery
    $squery= new StoreQuery();
   
    //specify query and save
    $squery->query=array('account_name_basic'=>'test1', 'module'=>'Users','searchFormTab'=>'basic_search','query'=>'true','action'=>'index');
    $squery->SaveQuery('Users');    

  }
}
?>
