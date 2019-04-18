<?php
/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,programme
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


//Controller class to make twitter api call and data handling of api response
class ContactsController extends SugarController{
   
    function action_Popup(){
		if(!empty($_REQUEST['html']) && $_REQUEST['html'] == 'mail_merge'){
			$this->view = 'mailmergepopup';
		}else{
			$this->view = 'popup';
		}
	}
	
    function action_ValidPortalUsername()
    {
		$this->view = 'validportalusername';
    }

    function action_RetrieveEmail()
    {
        $this->view = 'retrieveemail';	
    }

    function action_ContactAddressPopup()
    {
		$this->view = 'contactaddresspopup';
    }

    function action_SendNominationAcceptance()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $db, $sugar_config;
        
        $contact = BeanFactory::getBean('Contacts',$_REQUEST['id']);
        $programme = BeanFactory::getBean('Project',$contact->project_contacts_2project_ida);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $ictp = false;
        $template = new EmailTemplate();
        if ($programme->programme_type_c == "ICTP-On Campus" || $programme->programme_type_c == "ICTP-Off Campus") {
            $template->retrieve_by_string_fields(array('id' => '5bb070e3-5736-3ecc-a23f-5a092430594d','type'=>'email'));
            $ictp = true;    
        }else{
            if ($contact->self_sponsored_c) {
                $template->retrieve_by_string_fields(array('id' => 'a6898711-14e6-7d35-1f31-5a092a49fa47','type'=>'email'));   
            }else{            
                // $template->retrieve_by_string_fields(array('id' => 'ccb21de9-5259-e55c-885c-59c791be9e17','type'=>'email'));
                $template->retrieve_by_string_fields(array('id' => 'e4ff38b7-be8d-c8d0-504a-5a092518a523','type'=>'email'));
                $template->body_html = str_replace('one_day_before_start_date',  date('d-m-Y', strtotime('-1 day', strtotime($programme->start_date_c))), $template->body_html);
            }
        }        

        // print_r($contact->project_contacts_2project_ida);exit();

        //Parse Body HTML
        $template->body_html = $template->parse_template_bean($template->body_html,$contact->module_dir,$contact);
        $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);

        if ($ictp === false) {
            if ($ppd) {
                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
            }else{
                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
            }

            if ($spd) {
                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
            }else{
                $template->body_html = str_replace(' – PD1, spd_name - PD2', '', $template->body_html);
            }

            if ($contact->self_sponsored_c) {
                $template->body_html = str_replace('10_days_before', date('d-m-Y', strtotime('-10 day', strtotime($programme->start_date_c))), $template->body_html);
            }            
        }
        
        $contactPartner = $contact->get_linked_beans('scrm_partner_contacts_contacts_1','scrm_Partner_Contacts');
        
        if (count($contactPartner)>0) {
            $template->body_html = str_replace('password_reset', $contactPartner[0]->portal_reset_password_c, $template->body_html);             
        }    

        $template->subject = str_replace('project_name', $programme->name, $template->subject);
        
        // echo $template->body_html;exit();
        // $this->sendEmail($template->subject,$template->body_html,'aditya@simplecrm.com.sg');exit();
        if ($sugar_config['appInTesting']) {
            $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);
        }else{
            $this->sendEmail($template->subject,$template->body_html,$contact->email1);            
        }

        $today = date('Y-m-d');
        $db->query("UPDATE contacts_cstm SET nomination_letter_date_c = '{$today}' WHERE contacts_cstm.id_c = '$contact->id}'");
        
		/* Modified by Ashvin
		*  Date:19-11-2018
 		*  Ticket ID:3784
		*  Reason: Acceptance letters to Sponsors – Only bulk updates are available. This needs to be modified
		*  Start - Email Template
		*/
		$template->retrieve_by_string_fields(array('id' => '2172b4ca-76c2-48c7-fccb-5a0929215c20','type'=>'email'));
		$template->subject = str_replace('project_name', $programme->name, $template->subject);
		$sponsor = BeanFactory::getBean('Accounts',$contact->account_id);
		
		$nomination_name=$contact->name;
		
		if ($sponsor) {
			$template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
			$template->body_html = str_replace('nomination_list', $nomination_name, $template->body_html);
			if ($ppd) {
				$template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
				$template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
			}else{
				$template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
				$template->body_html = str_replace('ppd_email', '', $template->body_html);            
			}

			if ($spd) {
				$template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
			}else{
				$template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
			}                  
			$template->body_html = str_replace('one_day_before', date('d-m-Y', strtotime('-1 day', strtotime($programme->start_date_c))), $template->body_html);
			
			
			 if ($sugar_config['appInTesting']) {
				$this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);
			}else{ 
				$emails .= ', '.$sponsor->email1;
				$this->sendEmail($template->subject,$template->body_html,$sponsor->email1);            
			}  
		}
		/* Modified by Ashvin
		*  Date:19-11-2018
 		*  Ticket ID:3784
		*  Reason: Acceptance letters to Sponsors – Only bulk updates are available. This needs to be modified
		*  End
		*/
		
        $this->redirectTO($_REQUEST['id'],$contact->email1.','.$sponsor->email1);
    }

    function action_SendRejectionToSponsor()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        global $db, $sugar_config;
       
        $contact = BeanFactory::getBean('Contacts',$_REQUEST['id']);
        $programme = BeanFactory::getBean('Project',$contact->project_contacts_2project_ida);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $spd = null;
        if ($programme->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
        }

        $template = new EmailTemplate();
        $ictp = true;
        if ($programme->programme_type_c != "ICTP-On Campus" && $programme->programme_type_c != "ICTP-Off Campus") {
                $template->retrieve_by_string_fields(array('id' => '2f84ff39-f0a8-c545-ec7c-5a0994577dda','type'=>'email'));   
                $ictp = false; 
        }        
        // print_r($contact->project_contacts_2project_ida);exit();

        //Parse Body HTML
        $template->body_html = $template->parse_template_bean($template->body_html,$contact->module_dir,$contact);
        $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);

        if ($ictp === false) {
            if ($ppd) {
                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
            }else{
                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
            }

            if ($spd) {
                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
            }else{
                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
            }
            
            $template->subject = str_replace('project_name', $programme->name, $template->subject);
            // echo $template->body_html;exit();
            // $this->sendEmail($template->subject,$template->body_html,'aditya@simplecrm.com.sg');exit();
            // echo "<pre>";
            // print_r($contact);exit();
            $sponsor = BeanFactory::getBean('Accounts',$contact->account_id_c);
            // print_r($sponsor);exit();
            if ($sugar_config['appInTesting']) {
                $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);
            }else{
                $this->sendEmail($template->subject,$template->body_html,$sponsor->email1);            
            }
        }   
        
        $this->redirectTO($_REQUEST['id'],$sponsor->email1);
    }    


    public function redirectTO($id,$email){
        $queryParams = array(
            'module' => 'Contacts',
            'action' => 'DetailView',
            'record' => $id,
            'msg' => 'E-mail sent successfully to '.$email
        );
        SugarApplication::redirect('index.php?' . http_build_query($queryParams));
    }

    function action_SendNominationRejection()
    {
        require_once('modules/EmailTemplates/EmailTemplate.php');
        
        $template = new EmailTemplate();
        // $template->retrieve_by_string_fields(array('id' => 'b53257c9-a26c-ddba-a264-59c7935f2508','type'=>'email'));
        global $sugar_config, $db;
        
        $contact = BeanFactory::getBean('Contacts',$_REQUEST['id']);
        
        $programme = BeanFactory::getBean('Project',$contact->project_contacts_2project_ida);
        $ppd = null;
        if ($programme->assigned_user_id) {
            $ppd = BeanFactory::getBean('Users',$programme->assigned_user_id);
        }

        $spd = null;
        if ($programme->scrm_partners_id_c) {
            $spd = BeanFactory::getBean('scrm_Partners',$programme->scrm_partners_id_c);
        }

        $ictp = false;
        $template = new EmailTemplate();
        if ($programme->programme_type_c == "ICTP-On Campus" || $programme->programme_type_c == "ICTP-Off Campus") {
            $ictp = true;
        }
        
        if ($ictp === false) {
            
            $template->retrieve_by_string_fields(array('id' => '7b40a137-ba13-4267-2bda-5a092c4b6aee','type'=>'email'));
            //Parse Body HTML
            $template->body_html = $template->parse_template_bean($template->body_html,$contact->module_dir,$contact);
            $template->body_html = $template->parse_template_bean($template->body_html,$programme->module_dir,$programme);
            
            if ($ppd) {
                $template->body_html = str_replace('ppd_name', $ppd->full_name, $template->body_html);
                $template->body_html = str_replace('ppd_email', $ppd->email1, $template->body_html);
            }else{
                $template->body_html = str_replace('ppd_name', 'ASCI', $template->body_html);
                $template->body_html = str_replace('ppd_email', '', $template->body_html);            
            }

            if ($spd) {
                $template->body_html = str_replace('spd_name', $spd->name, $template->body_html);
            }else{
                $template->body_html = str_replace(' – PD1, spd_name – PD2', '', $template->body_html);
            }            

            $template->subject = str_replace('project_name', $programme->name, $template->subject);
            // $this->sendEmail($template->subject,$template->body_html,'aditya@simplecrm.com.sg');exit();
            if ($sugar_config['appInTesting']) {
                $this->sendEmail($template->subject,$template->body_html,$sugar_config['test_email']);
            }else{
                $this->sendEmail($template->subject,$template->body_html,$contact->email1);            
            }
        }

        $this->redirectTO($_REQUEST['id'],$contact->email1);
    }
    
    public function sendEmail($subject,$body,$email)
    {
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');
        $emailObj = new Email(); 

        $defaults = $emailObj->getSystemDefaultEmail(); 
        
        $mail = new SugarPHPMailer(); 

        $mail->setMailerForSystem(); 
        $mail->From = $defaults['email']; 
        $mail->FromName = $defaults['name']; 
        
        $mail->Subject = $subject; 
        $mail->Body = $body; 
        $mail->prepForOutbound(); 
        $mail->AddAddress($email);
        $mail->isHTML(true); 
        // print_r($mail);exit();
        @$mail->Send(); 
    }
    function action_CloseContactAddressPopup()
    {
    	$this->view = 'closecontactaddresspopup';
    }    


	       public function action_get_tweets() {


		global $sugar_config;

		$twitter_app_oauth_access_token        = $sugar_config['twitter_app_oauth_access_token'];
		$twitter_app_oauth_access_token_secret = $sugar_config['twitter_app_oauth_access_token_secret'];
		$twitter_app_consumer_key              = $sugar_config['twitter_app_consumer_key'];
		$twitter_app_consumer_secret           = $sugar_config['twitter_app_consumer_secret'];

	        $twitter_handle   = $_REQUEST['twitter_handle'];

         // Twitter connection through api and data fetching in json format
         require_once('custom/include/twitter/twitter_api_php_master/TwitterAPIExchange.php');
     
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
                          'oauth_access_token'        => $twitter_app_oauth_access_token,
       			  'oauth_access_token_secret' => $twitter_app_oauth_access_token_secret,
        		  'consumer_key'              => $twitter_app_consumer_key,
        		  'consumer_secret'           => $twitter_app_consumer_secret
                         );

//Fetch user details - start

$url1 = "https://api.twitter.com/1.1/users/show.json";
$requestMethod1 = "GET";

//https://api.twitter.com/1.1/account/verify_credentials.json

$getfield1 = "?screen_name=$twitter_handle";
$twitter1 = new TwitterAPIExchange($settings);
$string1 = json_decode($twitter1->setGetfield($getfield1)
->buildOauth($url1, $requestMethod1)
->performRequest(),$assoc = TRUE);

        $twitter_id                      = $string1['id'];
        $twitter_display_name            = $string1['name'];
        $twitter_screen_name             = $string1['screen_name'];
        $twitter_user_location           = $string1['location'];
        $twitter_followers_count         = $string1['followers_count'];
        $twitter_friends_count           = $string1['friends_count']; //following count
        $twitter_listed_count            = $string1['listed_count'];
        $twitter_account_created_at      = $string1['created_at'];
        $twitter_favourites_count        = $string1['favourites_count'];
        $twitter_utc_offset              = $string1['utc_offset'];
        $twitter_time_zone               = $string1['time_zone'];
        $twitter_geo_enabled             = $string1['geo_enabled'];
        $twitter_verified                = $string1['verified'];
        $twitter_statuses_count          = $string1['statuses_count']; //tweets count
        $twitter_language                = $string1['lang'];
        $twitter_profile_image_url       = $string1['profile_image_url'];
        $twitter_profile_image_url_https = $string1['profile_image_url_https'];
        $twitter_following               = $string1['following'];
      

//Fetch user details - end

	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$requestMethod = "GET";
        $count = 5;
	$getfield = "?screen_name=$twitter_handle&count=$count";

	$twitter = new TwitterAPIExchange($settings);
	$string = json_decode($twitter->setGetfield($getfield)
	->buildOauth($url, $requestMethod)
	->performRequest(),$assoc = TRUE);
	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

        $array_count = 0;

        foreach($string as $items){

    	$time_and_date_of_tweet = $items['created_at']; // $Published_date	
    	$time_and_date_of_tweet_split = split(" ", $time_and_date_of_tweet);
	$time_and_date_of_tweet_split['0'];
	$time_and_date_of_tweet_split['1'];
	$time_and_date_of_tweet_split['2'];
	$time_and_date_of_tweet_split['3'];
	$time_and_date_of_tweet_split['5'];
	$time = $time_and_date_of_tweet_split['3'];
	$time_corrected = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
	$time_and_date_of_tweet_correct = $time_and_date_of_tweet_split['0']." ".$time_and_date_of_tweet_split['2']."-".$time_and_date_of_tweet_split['1']."-".$time_and_date_of_tweet_split['5']." ".$time_corrected;

	$time_and_date_of_tweet_correct = $time_and_date_of_tweet_split['2']."-".$time_and_date_of_tweet_split['1']."-".$time_and_date_of_tweet_split['5']." ".$time_corrected;

        $Published_date           = $time_and_date_of_tweet_correct;
        $tweet 			  = $items['text']; // $message
        $message 		  = $tweet;
        $tweet_id		  = $items['id'];
        $tweeted_by 		  = $items['user']['name'];
        $tweeted_by_id 		  = $items['user']['id'];
        $tweeted_by_screen_name   = $items['user']['screen_name'];
        $tweeted_by_location      = $items['user']['location'];
        $tweeted_by_description   = $items['user']['description'];
        $tweet_lang 		  = $items['lang'];
        $tweet_source 		  = $items['source'];
        $retweet_count 		  = $items['retweet_count'];  //  $retweets_count
        $actual_retweet_count 	  = $retweet_count; 
        $favorite_count 	  = $items['favorite_count']; // $favourites_count
        $actual_favorite_count    = $favorite_count; 

        $retweeted_status = $items['retweeted_status'];
        $arr_length = count($retweeted_status);

        // retweet some other tweet
	if($arr_length != 0){

	$retweeted_status_id                                  = $items['retweeted_status']['id']; // $status_id
	$retweeted_status_created_at                          = $items['retweeted_status']['created_at'];
	$retweeted_status_text                                = $items['retweeted_status']['text']; // $data_content
	$retweeted_status_source                              = $items['retweeted_status']['source'];
	$retweeted_status_lang                                = $items['retweeted_status']['lang'];
	$retweeted_status_favorited                           = $items['retweeted_status']['favorited'];
	$retweeted_status_retweeted                           = $items['retweeted_status']['retweeted'];
	$retweeted_status_user_name                           = $items['retweeted_status']['user']['name']; // $page_or_user_dispaly_name
	$retweeted_status_user_id                             = $items['retweeted_status']['user']['id'];
        $retweeted_status_user_screen_name                    = $items['retweeted_status']['user']['screen_name']; // $page_or_user_screen_name
        $retweeted_status_user_location                       = $items['retweeted_status']['user']['location']; 
        $retweeted_status_user_description                    = $items['retweeted_status']['user']['description']; 
	$retweeted_status_user_profile_image_url              = $items['retweeted_status']['user']['profile_image_url']; // $image_url
        $retweeted_status_user_screen_profile_image_url_https = $items['retweeted_status']['user']['profile_image_url_https']; // $image_url
                     
        $retweeted_status_user_profile_profile_background_image_url         = $items['retweeted_status']['profile_background_image_url']; 
        $retweeted_status_user_profile_profile_background_image_url_https   = $items['retweeted_status']['profile_background_image_url_https']; 

        $retweeted_status_user_profile_profile_sidebar_border_color         = $items['retweeted_status']['profile_sidebar_border_color']; 
      
        $retweeted_status_user_profile_profile_use_background_image         = $items['retweeted_status']['profile_use_background_image']; 
        $retweeted_status_user_profile_followers_count                      = $items['retweeted_status']['followers_count']; 
        $retweeted_status_user_profile_friends_count                        = $items['retweeted_status']['friends_count']; //following count
        $retweeted_status_user_profile_listed_count                         = $items['retweeted_status']['listed_count']; 
        $retweeted_status_user_profile_created_at                           = $items['retweeted_status']['created_at']; 
        $retweeted_status_user_profile_favourites_count                     = $items['retweeted_status']['favourites_count']; 
        $retweeted_status_user_profile_utc_offset                           = $items['retweeted_status']['utc_offset']; 
        $retweeted_status_user_profile_time_zone                            = $items['retweeted_status']['time_zone']; 
       
       
        $retweeted_status_user_profile_statuses_count                       = $items['retweeted_status']['statuses_count']; //tweets count
        $retweeted_status_user_profile_lang                                 = $items['retweeted_status']['lang']; 
        $retweeted_status_user_profile_following                            = $items['retweeted_status']['following']; 
        $retweeted_status_is_quote_status                                   = $items['retweeted_status']['is_quote_status']; 
        $retweeted_status_retweet_count                                     = $items['retweeted_status']['retweet_count']; 
        $retweeted_status_favorite_count                                    = $items['retweeted_status']['favorite_count']; 

        $status_id = $retweeted_status_id;
        //$data_content = $retweeted_status_text;
        $page_or_user_dispaly_name = $retweeted_status_user_name;
        $page_or_user_screen_name = $retweeted_status_user_screen_name;
        $image_url = $retweeted_status_user_profile_image_url;
	$actual_retweet_count  = $retweeted_status_retweet_count;
	$actual_favorite_count = $retweeted_status_favorite_count;

	}

	if($arr_length == 0){

        $is_quote_status = $items['is_quote_status'];

        // tweet newly with some other tweet(quoted tweet).
	if( $is_quote_status == 1 ){

	$quoted_status_id                                  = $items['quoted_status']['id']; // $status_id
	$quoted_status_created_at                          = $items['quoted_status']['created_at'];
	$quoted_status_text                                = $items['quoted_status']['text']; // $data_content
	$quoted_status_source                              = $items['quoted_status']['source']; 
	$quoted_status_retweet_count                       = $items['quoted_status']['retweet_count']; 
	$quoted_status_favorite_count                      = $items['quoted_status']['favorite_count']; 
	$quoted_status_is_quote_status                     = $items['quoted_status']['is_quote_status']; 
	$quoted_status_user_name                           = $items['quoted_status']['user']['name']; // $page_or_user_dispaly_name
	$quoted_status_user_id                             = $items['quoted_status']['user']['id'];
	$quoted_status_user_screen_name                    = $items['quoted_status']['user']['screen_name']; // $page_or_user_screen_name
	$quoted_status_user_profile_image_url              = $items['quoted_status']['user']['profile_image_url']; // $image_url
	$quoted_status_user_screen_profile_image_url_https = $items['quoted_status']['user']['profile_image_url_https']; // $image_url

        $quoted_status_tweeted_by_profile_location                           = $items['quoted_status']['user']['location'];
        $quoted_status_tweeted_by_profile_description                        = $items['quoted_status']['user']['description'];
        $quoted_status_tweeted_by_profile_followers_count                    = $items['quoted_status']['user']['followers_count'];
        $quoted_status_tweeted_by_profile_friends_count                      = $items['quoted_status']['user']['friends_count']; // following_count
        $quoted_status_tweeted_by_profile_listed_count                       = $items['quoted_status']['user']['listed_count'];
        $quoted_status_tweeted_by_profile_created_at                         = $items['quoted_status']['user']['created_at'];
        $quoted_status_tweeted_by_profile_favourites_count                   = $items['quoted_status']['user']['favourites_count'];
        $quoted_status_tweeted_by_profile_utc_offset                         = $items['quoted_status']['user']['utc_offset'];
        $quoted_status_tweeted_by_profile_time_zone                          = $items['quoted_status']['user']['time_zone'];
        $quoted_status_tweeted_by_profile_statuses_count                     = $items['quoted_status']['user']['statuses_count']; // tweets
        $quoted_status_tweeted_by_profile_lang                               = $items['quoted_status']['user']['lang'];
        $quoted_status_tweeted_by_profile_profile_background_image_url       = $items['quoted_status']['user']['profile_background_image_url'];
        $quoted_status_tweeted_by_profile_profile_background_image_url_https = $items['quoted_status']['user']['profile_background_image_url_https'];
        $quoted_status_tweeted_by_profile_profile_banner_url                 = $items['quoted_status']['user']['profile_banner_url'];
        $quoted_status_tweeted_by_profile_following                          = $items['quoted_status']['user']['following'];

        $status_id = $quoted_status_id;
        //$data_content = $quoted_status_text;
        $page_or_user_dispaly_name = $quoted_status_user_name;
        $page_or_user_screen_name = $quoted_status_user_screen_name;
        $image_url = $quoted_status_user_profile_image_url;
	$actual_retweet_count  = $quoted_status_retweet_count;
	$actual_favorite_count = $quoted_status_favorite_count;

	}

	if( $is_quote_status != 1 ){

        $tweeted_user_name                                     = $items['user']['name']; // $page_or_user_dispaly_name
        $tweeted_by_user_id                                    = $items['user']['id'];
        $tweeted_by_screen_name                                = $items['user']['screen_name']; // $page_or_user_screen_name
        $tweeted_by_profile_image_url                          = $items['user']['profile_image_url']; // $image_url
        $tweeted_by_profile_image_url_https                    = $items['user']['profile_image_url_https']; // $image_url
        $tweeted_by_profile_location                           = $items['user']['location'];
        $tweeted_by_profile_description                        = $items['user']['description'];
        $tweeted_by_profile_followers_count                    = $items['user']['followers_count'];
        $tweeted_by_profile_friends_count                      = $items['user']['friends_count']; // following_count
        $tweeted_by_profile_listed_count                       = $items['user']['listed_count'];
        $tweeted_by_profile_created_at                         = $items['user']['created_at'];
        $tweeted_by_profile_favourites_count                   = $items['user']['favourites_count'];
        $tweeted_by_profile_utc_offset                         = $items['user']['utc_offset'];
        $tweeted_by_profile_time_zone                          = $items['user']['time_zone'];
        $tweeted_by_profile_statuses_count                     = $items['user']['statuses_count']; // tweets
        $tweeted_by_profile_lang                               = $items['user']['lang'];
        $tweeted_by_profile_profile_background_image_url       = $items['user']['profile_background_image_url'];
        $tweeted_by_profile_profile_background_image_url_https = $items['user']['profile_background_image_url_https'];
        $tweeted_by_profile_profile_banner_url                 = $items['user']['profile_banner_url'];
        $tweeted_by_profile_following                          = $items['user']['following'];

        $tweet                                   = $items['text']; // $data_content
        $tweet_id                                = $items['id']; // $status_id
	$tweet_retweet_count                     = $items['retweet_count'];
	$tweet_favorite_count                    = $items['favorite_count'];
	$tweet_is_quote_status                   = $items['is_quote_status'];
	$tweet_lang                              = $items['lang'];
	$tweet_source                            = $items['source'];

        $status_id = $tweet_id;
        //$data_content = $tweet;
        $page_or_user_dispaly_name = $tweeted_user_name;
        $page_or_user_screen_name = $tweeted_by_screen_name;
        $image_url = $tweeted_by_profile_image_url;
	$actual_retweet_count  = $tweet_retweet_count;
	$actual_favorite_count = $tweet_favorite_count;

	}

	} 
    
           $array_count++;

	   //$message = str_replace("'", "\'", $message); // Replaces all ' with \'.
	   //$message = str_replace ('"','\"', $message ) ;
           $message = preg_replace("/(\r?\n){2,}/", "\n\n", $message);
	   $message = preg_replace("/[\r\n]{2,}/", "\n\n", $message);
	   $message = preg_replace("/[\r\n]+/", "\n", $message);
	   $message = wordwrap($message,60, ' <br/>', true); //comment this line or increase the rate, if the data(message) is too much large or having "
	   $message = nl2br($message);
	   $message = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $message));
	   $message = preg_replace( "/\r|\n/", "", $message );
	   $message = str_replace(array("\r", "\n"), '', $message);
           //for removing bad data
           $message = filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		$hids  = "hids_".$array_count;
		$trs   = "trs_".$array_count;
		$msg   = "msg_".$array_count;
		$tds   = "tds_".$array_count;
		$sels  = "sels_".$array_count;

$hid_data = $message."abcd0123dcba".$status_id."abcd0123dcba".$Published_date."abcd0123dcba".$page_or_user_dispaly_name."abcd0123dcba".$page_or_user_screen_name."abcd0123dcba".$image_url;

        //$remove = array("\n", "\r\n", "\r");
       // $str = str_replace($remove, ' ', $str);

   //echo $val = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

$tbody .= '<tr id="'.$trs.'" class="listViewEntries mm_normal mm_clickable"><td class="narrowWidthType table_padding_margin">'.$Published_date.'</td><td class="narrowWidthType table_padding_margin table_message_padding"><span id="'.$msg.'" ><span><a title="'.$page_or_user_dispaly_name.'" target="_blank" href="https://twitter.com/'.$page_or_user_screen_name.'"><img width="20" height="20" src="'.$image_url.'"></a></span>&nbsp;&nbsp;<span><a class="feedText" style="text-decoration:none;color:inherit" data-trigger="hover" data-placement="top" rel="popover" data-content="'.$data_content.'" target="_blank" href="https://twitter.com/string/status/'.$status_id.'">'.$message.'</a></span></span></td><td><center> '.$actual_retweet_count.'</center></td><td><center>'.$actual_favorite_count.'</center></td><td id="'.$tds.'" class="narrowWidthType table_padding_margin"><div class="actions"><select class="actions_dd" id="'.$sels.'" style="color:green; margin-left:10px;"><option id="nothing" name="nothing" value=""></option><option id="actions_add_lead" name="actions_add_lead" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" value="Add Lead">Add Enquiry</option><option value="Add Contact" id="actions_add_contact" name="actions_add_contact" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Nomination</option><option  id="actions_add_opportunities" name="actions_add_opportunities" value="Add Opportunity" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Proposal</option><option id="actions_add_case" name="actions_add_case" value="Add Case" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Case</option></select></div></td><td></td></tr><tr><input type="hidden" value="'.$hid_data.'" id="'.$hids.'"></tr>';


        }
		        $data= array();
                        $data['result_count']                = $array_count;
		        $data['twitter_data']                = $tbody;
		        $data['got_twitter_data']            = "yes";
                        $data['twitter_display_name']        = $twitter_display_name;
                        $data['twitter_profile_image_url']   = $twitter_profile_image_url;
			echo json_encode($data);
	       }

	      public function action_create_records (){

			global $sugar_config; 
			global $db;

		        $module             = $_REQUEST['module'];
		        $action             = $_REQUEST['action'];
		        $to_pdf             = $_REQUEST['to_pdf'];
		        $first_name         = $_REQUEST['first_name'];
		        $last_name          = $_REQUEST['last_name'];
		        $twitter_handle_c   = $_REQUEST['twitter_handle_c'];
		        $lead_source        = $_REQUEST['lead_source'];
		        $description        = $_REQUEST['description'];
                        $status_id          = $_REQUEST['status_id'];
		        $account_id         = $_REQUEST['account_id'];


		$contact = new Contact();

		$contact->first_name              = $first_name;
		$contact->last_name               = $last_name;
		$contact->lead_source             = $lead_source;
		$contact->description             = $description;  
		$contact->tweet_id_c              = $status_id; 
		$contact->twitter_handle_c        = $twitter_handle_c;  
		$contact->account_id              = $account_id;     
		  	   
		//$query1  =   "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
                $query1  =   "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  twitter_handle_c  = '$twitter_handle_c' AND lead_source = '$lead_source'";

		$value1  =   $db->query($query1);
		$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

		if(!$check1){
		$contact->save();	
		$created = "y";
		}
		if($check1){
		$created = "n";
		}

		$sql = "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  twitter_handle_c  = '$twitter_handle_c' AND lead_source = '$lead_source'";
		$result = $db->query($sql);

		if($row6 = $db->fetchByAssoc($result)){

		   $id_c = $row6['id_c'];                    
		}
                        $data2= array();
                        $data2['id_c']                = $id_c;
                        $data2['created']             = $created;
                       
			echo json_encode($data2);

              }  

} 
