<?php
  

if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');

require_once('include/database/DBManager.php');
require_once('config.php');
//global $sugar_config;
//$url = $sugar_config['site_url'];
global $db,$current_user;
  global $current_user,$user_id;
  $user_id=$current_user->id;
  //echo $user_id;
  $query="select asterisk_ext_c,agent_id_c,agent_name_c,agent_pin_c from users_cstm where id_c='$user_id'";
  $row=$db->query($query);
  $result=$db->fetchByAssoc($row);
  $phone=$result['asterisk_ext_c'];
  $agentpin=$result['agent_pin_c'];
  $agentid=$result['agent_id_c'];
echo "<iframe name='iframe' src='http://ca.ozonetel.com/OCCDV2/occdManager.do?
action=formLogin&customer=simplecrm_demo&agentid=$agentid&phoneNumber=$phone
&pin=$agentpin&orientation=vertical&loginURL=http://ca.ozonetel.com/OCCDV2/cloudagent/agent_cti_login.jsp&redirectURL=http://ca.ozonetel
.com/OCCDV2/cloudagent/agent_cti_toolbar.jsp' width='100%' height='600px'></iframe>";
    
?>
