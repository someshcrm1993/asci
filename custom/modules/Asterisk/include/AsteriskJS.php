<?php

/**
 * Asterisk SugarCRM Integration
 * (c) KINAMU Business Solutions AG 2009
 *
 * Parts of this code are (c) 2006. RustyBrick, Inc.  http://www.rustybrick.com/
 * Parts of this code are (c) 2008 vertico software GmbH
 * Parts of this code are (c) 2009 abcona e. K. Angelo Malaguarnera E-Mail admin@abcona.de
 * Parts of this code are (c) 2012 Blake Robertson. http://www.blakerobertson.com
 * http://www.sugarforge.org/projects/yaai/
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact KINAMU Business Solutions AG at office@kinamu.com
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 *
 * This file is added as an after_ui_frame logic hook by one of the manifest install scripts.  It calls:
 *    check_logic_hook_file("", "after_ui_frame",
 * 		array(1, 'Asterisk', 'custom/modules/Asterisk/include/AsteriskJS.php','AsteriskJS', 'echoJavaScript'));
 *
 */
//prevents directly accessing this file from a web browser
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

class AsteriskJS {

    function echoJavaScript() {
        // asterisk hack: include ajax callbacks in every sugar page except ajax requests:

        if ((!isset($_REQUEST['sugar_body_only']) || $_REQUEST['sugar_body_only'] != true) && $_REQUEST['action'] != 'modulelistmenu' &&
             $_REQUEST['action'] != "favorites" && $_REQUEST['action'] != 'Popup' && empty($_REQUEST['to_pdf']) &&
            (!empty($_REQUEST['module']) && $_REQUEST['module'] != 'ModuleBuilder') && empty($_REQUEST['to_csv']) && $_REQUEST['action'] != 'Login' &&
            $_REQUEST['module'] != 'Timesheets') {

            if(!empty( $GLOBALS['current_user']->asterisk_ext_c) &&
               (($GLOBALS['current_user']->asterisk_inbound_c == '1') || ($GLOBALS['current_user']->asterisk_outbound_c == '1')))
            {
               $pollRate = !empty($sugar_config['asterisk_listener_poll_rate']) ? $sugar_config['asterisk_listener_poll_rate'] : "5000";
			$userExt = !empty($GLOBALS['current_user']->asterisk_ext_c) ? $GLOBALS['current_user']->asterisk_ext_c : "Not Configured!";
			
			
		    echo '<link rel="stylesheet" type="text/css" media="all" href="custom/modules/Asterisk/include/asterisk.css">';
			if($GLOBALS['current_user']->asterisk_inbound_c == '1') {
			    echo '<script type="text/javascript" src="custom/modules/Asterisk/include/javascript/dialin.js"></script>';
				echo '<script type="text/javascript">AST_PollRate = ' . $pollRate . ';</script>';
			}
			if($GLOBALS['current_user']->asterisk_outbound_c == '1') {
			   echo '<script> AST_UserExtention = ' . $userExt . ';</script>';
			   echo '<script type="text/javascript" src="custom/modules/Asterisk/include/javascript/dialout.js"></script>';
			 }

			 
			/** BR Changes for adding inline chat boxes **/
			echo '<link type="text/css" rel="stylesheet" media="all" href="custom/modules/Asterisk/include/chat.css" />';
			echo '<link type="text/css" rel="stylesheet" media="all" href="custom/modules/Asterisk/include/screen.css" />';
			echo '<!--[if lte IE 7]>';
			echo '<link type="text/css" rel="stylesheet" media="all" href="custom/modules/Asterisk/include/screen_ie.css" />';
			echo '<![endif]-->';
            }
        }
    }
}

function getConfigBool($index,$defaultValue=0) {
    //return "1";
    if( !empty( $GLOBALS['sugar_config'][$index]) ) {
        return $GLOBALS['sugar_config'][$index];
    }
    else {
        return $defaultValue;
    }
}

?>
