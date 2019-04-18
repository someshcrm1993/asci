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

$required_scope = ' public_profile,user_about_me,user_actions.books,user_actions.fitness,user_actions.music,user_actions.news,user_actions.video,user_birthday,user_education_history,user_events,user_friends,user_games_activity,user_hometown,user_likes,user_location,user_managed_groups,user_photos,user_posts,user_relationship_details,user_relationships,user_religion_politics,user_status,user_tagged_places,user_videos,user_website,user_work_history,ads_management,ads_read,email,manage_pages,publish_actions,publish_pages,read_custom_friendlists,read_insights,read_page_mailboxes,rsvp_event
';
//user_groups, manage_notifications, read_mailbox, read_stream


		$redirect_url        = 'http://internaldemo.simplecrmdemo.com/facebook.php';
        require_once __DIR__ . "/custom/include/facebook/autoload.php";
		use Facebook\FacebookSession;
		use Facebook\FacebookRequest;
		use Facebook\GraphUser;
		use Facebook\FacebookRedirectLoginHelper;

		FacebookSession::setDefaultApplication($app_id , $app_secret);
		$helper = new FacebookRedirectLoginHelper($redirect_url);

		try {
		  $session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
		    die(" Error : " . $ex->getMessage());
		} catch(\Exception $ex) {
		    die(" Error : " . $ex->getMessage());
		}

		if (!$session){

			$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
			header("location:$login_url");

		}
else{

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



#foreach ($pageList_data as $page) {
#echo "<br>";echo "<br>";
#  echo "page access_token :".$pageAccessToken = $page->access_token;
#  // Store $pageAccessToken and/or
#  // send requests to Graph on behalf of the page

#echo "<br>";echo "<br>";
#}


}


/*
exit;

	require_once('config.php');
	global $sugar_config;
        require_once 'modules/Configurator/Configurator.php';

		$configurator = new Configurator();
		$configurator->loadConfig(); // it will load existing configuration in config variable of object
                $configurator->config['facebook_page_access_token']     = $pageAccessToken;
		$configurator->saveConfig(); // save changes

echo "connected successfully and saved session data";
*/

?>
