<?php

echo "<h4>Simple Twitter API Test</h4>";
    require_once('TwitterAPIExchange.php');
     
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "3314276305-KyQVwTOduBgOTz38MWQM6CqCv7C2Ae6RpCvpj5q",
        'oauth_access_token_secret' => "Ksx3ZhdXivUBTBCfS8Yqwg5pYFOXrGTjnVMIVqBCG5ORi",
        'consumer_key' => "mTt5NxsCp2Ki0j4v3n1jNfcuy",
        'consumer_secret' => "o2Hlbi7T0rOmuiM1i1FPPemjgGFn2iQYgSoXOYS6SjqtHMVyV1"
    );

$url = "https://api.twitter.com/1.1/favorites/list.json";

$requestMethod = "GET";

$getfield = '?count=10&screen_name=nitheesh670';

$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);

echo "<pre>";
print_r($string);
echo "</pre>";


?>
