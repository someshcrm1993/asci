<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "3314276305-KyQVwTOduBgOTz38MWQM6CqCv7C2Ae6RpCvpj5q",
    'oauth_access_token_secret' => "Ksx3ZhdXivUBTBCfS8Yqwg5pYFOXrGTjnVMIVqBCG5ORi",
    'consumer_key' => "ykZFlJDGuWe4N83rVKK68S01c",
    'consumer_secret' => "4UxXoSPBRAdnIF4DkMKOwujCHB79hYOyn6N9z6AFLBPqTbIClF"
);


/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
echo $twitter->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?screen_name=J7mbo';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
