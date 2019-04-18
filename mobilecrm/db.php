<?php
if(!defined('sugarEntry'))
define('sugarEntry', true);
//global $sugar_config;
include '../config.php';
$mysql_hostname     = $sugar_config['dbconfig']['db_host_name'];
$mysql_user         = $sugar_config['dbconfig']['db_user_name'];
$mysql_database     = $sugar_config['dbconfig']['db_name'];
$mysql_password     = $sugar_config['dbconfig']['db_password'];

$db_host_instance       = $sugar_config['dbconfig']['db_host_instance'];
$db_type                = $sugar_config['dbconfig']['db_type'];
$db_port                = $sugar_config['dbconfig']['db_port'];
$db_manager             = $sugar_config['dbconfig']['db_manager'];
?>
