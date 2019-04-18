<?php

if(!defined('sugarEntry')) define('sugarEntry', true);
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


require_once('include/entryPoint.php');

echo "Connected";

session_start();

$app_id             = '1613277135628605';
$app_secret         = 'bfc9d0ec036c5d9ba08285891e101add';


$redirect_url        = 'http://internaldemo.simplecrmdemo.com/facebook.php';
require_once __DIR__ . "/custom/include/facebook/autoload.php";
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;
use FacebookAds\Object\LeadgenForm;

FacebookSession::setDefaultApplication($app_id , $app_secret);
$helper = new FacebookRedirectLoginHelper($redirect_url);



   $user_profile = Array();
   $request = new FacebookRequest(
   $session,
    'GET', '/1705178363077892/feed?fields=comments'
    );


 $response = $request->execute();
 $user_profile = $response->getGraphObject()->asArray();
 $data         = $user_profile['data'];

#echo "<pre>";
#print_r($data);
#echo "</pre>";

echo $accessToken = $session->getAccessToken();
echo "<br>";
// Exchange the short-lived token for a long-lived token.
echo $longLivedAccessToken = $accessToken->extend();
echo "<br>";

// Get a list of pages that this user admins; requires "manage_pages" permission
$request = new FacebookRequest($session, 'GET', '/me/accounts?fields=name,access_token,perms');
$pageList = $request->execute()
  ->getGraphObject()
  ->asArray();

$pageList_data = $pageList['data'];

echo "<pre>";
print_r($pageList_data);
echo "</pre>";


$page_access = $pageList_data[0];

echo "page access_token :".$pageAccessToken = $page_access->access_token;

?>
