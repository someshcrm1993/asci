<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/




global $beanList;
global $beanFiles;


if(empty($_REQUEST['module']))
{
	die("'module' was not defined");
}

if(empty($_REQUEST['record']))
{
	die("'record' was not defined");
}

if(!isset($beanList[$_REQUEST['module']]))
{
	die("'".$_REQUEST['module']."' is not defined in \$beanList");
}

if (!isset($_REQUEST['subpanel'])) {
    sugar_die('Subpanel was not defined');
}

$subpanel = $_REQUEST['subpanel'];
$record = $_REQUEST['record'];
$module = $_REQUEST['module'];

$collection = array();

if(isset($_REQUEST['collection_basic']) && $_REQUEST['collection_basic'][0] != 'null'){
    $_REQUEST['collection_basic'] = explode(',',$_REQUEST['collection_basic'][0]);
    $collection = $_REQUEST['collection_basic'];
}

if(empty($_REQUEST['inline']))
{
	insert_popup_header($theme);
}

//require_once('include/SubPanel/SubPanelDefinitions.php');
//require_once($beanFiles[$beanList[$_REQUEST['module']]]);
//$focus=new $beanList[$_REQUEST['module']];
//$focus->retrieve($record);

include('include/SubPanel/SubPanel.php');
$layout_def_key = '';
if(!empty($_REQUEST['layout_def_key'])){
	$layout_def_key = $_REQUEST['layout_def_key'];
}

$subpanel_object = new SubPanel($module, $record, $subpanel,null, $layout_def_key, $collection);

/*------------------------Subpanel Pagination on click icons ajax is running that time change design for activities and history --start-----Roshan Sarode----------------*/
if($subpanel=="history" || $subpanel=="activities")
{
$subpanel_object->setTemplateFile('include/SubPanel/RightTabPanelDynamic.html');
}else
{
$subpanel_object->setTemplateFile('include/SubPanel/SubPanelDynamic.html');
}
/*------------------------Subpanel Pagination on click icons ajax is running that time change design for activities and history --end-----Roshan Sarode----------------*/


echo (empty($_REQUEST['inline']))?$subpanel_object->get_buttons():'' ;  

$subpanel_object->display();

$jsAlerts = new jsAlerts();
if (!isset($_SESSION['isMobile'])) {
    echo $jsAlerts->getScript();
}

if(empty($_REQUEST['inline']))
{
	insert_popup_footer($theme);
}

