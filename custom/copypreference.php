<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('config.php');
global $db, $sugar_config;
$contentquery="select contents from user_preferences where assigned_user_id = '1' and category = 'global'";
$query_result=$db->query($contentquery);
$queryRow = $db->fetchByAssoc($query_result);
$contents = $queryRow['contents'];
$create_table=$db->query("update user_preferences set contents ='$contents' where  category = 'global'");
 