<?php


ini_set('display_errors', 1);
echo "<h4>Simple Twitter API Test</h4>";
    require_once('TwitterAPIExchange.php');
     
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "3314276305-KyQVwTOduBgOTz38MWQM6CqCv7C2Ae6RpCvpj5q",
        'oauth_access_token_secret' => "Ksx3ZhdXivUBTBCfS8Yqwg5pYFOXrGTjnVMIVqBCG5ORi",
        'consumer_key' => "mTt5NxsCp2Ki0j4v3n1jNfcuy",
        'consumer_secret' => "o2Hlbi7T0rOmuiM1i1FPPemjgGFn2iQYgSoXOYS6SjqtHMVyV1"
    );

//Choose URL and Request Method

//$url = 'https://api.twitter.com/1.1/blocks/create.json';


//$url = "https://api.twitter.com/1.1/statuses/retweet/241259202004267009.json";

//$url = "https://api.twitter.com/1.1/direct_messages/new.json?text=hello%2C%20tworld.%20welcome%20to%201.1.&screen_name=simplemrc";


$url = "https://api.twitter.com/1.1/favorites/list.json?count=2&screen_name=episod";

$requestMethod = 'GET';

//Choose POST fields

//rathina_ganesh, nitheesh670, simplemrc

$postfields = array(
   // 'screen_name' => 'simplemrc', 
   // 'status' => 'Test Tweet'
);

//Perform the request!

$twitter = new TwitterAPIExchange($settings);
     $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();


$string = json_decode( $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest(),$assoc = TRUE);

echo "<pre>";
print_r($string);
echo "</pre>";

// Post Update
//$content = $connection->post('statuses/update', array('status' => 'Test Tweet'));

?>
