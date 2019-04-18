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

$url = "https://api.twitter.com/1.1/favorites/create.json";


$requestMethod = "POST";

$postfields = array(
'id' => '627398202954678272' // id of tweet which is to be favorite
);

//Perform the request!

$twitter = new TwitterAPIExchange($settings);

$string = json_decode( $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest(),$assoc = TRUE);

echo "<pre>";
print_r($string);
echo "</pre>";


?>
