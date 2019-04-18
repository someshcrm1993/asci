<?php

//ini_set('display_errors', 1);
echo "<h4>Simple Twitter API Test</h4>";
    require_once('TwitterAPIExchange.php');
     
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "3314276305-KyQVwTOduBgOTz38MWQM6CqCv7C2Ae6RpCvpj5q",
        'oauth_access_token_secret' => "Ksx3ZhdXivUBTBCfS8Yqwg5pYFOXrGTjnVMIVqBCG5ORi",
        'consumer_key' => "mTt5NxsCp2Ki0j4v3n1jNfcuy",
        'consumer_secret' => "o2Hlbi7T0rOmuiM1i1FPPemjgGFn2iQYgSoXOYS6SjqtHMVyV1"
    );

//Access Level : Read, write, and direct messages
//Owner : simplemrc
//Owner ID : 3314276305 

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

$requestMethod = "GET";

//$getfield = '?screen_name=nitheesh670&count=20';
//rathina_ganesh, nitheesh670, simplemrc


///////////////////////////////////////////////////////////////////

// I

#//json data
#$getfield = '?screen_name=nitheesh670&count=20';
#$twitter = new TwitterAPIExchange($settings);
#   echo  $twitter->setGetfield($getfield)
#             ->buildOauth($url, $requestMethod)
#             ->performRequest();


#echo "<pre>";
#print_r($twitter);
#echo "</pre>";

////////////////////////////////////////////////////////////////////


// II

#$getfield = '?screen_name=nitheesh670&count=20';
#$twitter = new TwitterAPIExchange($settings);
#$string = json_decode($twitter->setGetfield($getfield)
#         ->buildOauth($url, $requestMethod)
#         ->performRequest(),$assoc = TRUE);

#if($string["errors"][0]["message"] != "") {

#echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
#exit();

#}

#echo "<pre>";
#print_r($string);
#echo "</pre>";

//////////////////////////////////////////////////////////////////


// III
//echo $_GET;
echo "<pre>";
print_r($_GET);
echo "</pre>";


//   if we add some users data while calling this file
//   twitter/littleApp.php?user=nitheesh670&count=5

//rathina_ganesh, nitheesh670, simplemrc
if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "simplemrc";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

$count = 0;

foreach($string as $items)
    {
        echo "Time and Date of Tweet: ".$items['created_at']."<br />";
        echo "Tweet: ". $items['text']."<br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Followers: ". $items['user']['followers_count']."<br />";
        echo "Friends: ". $items['user']['friends_count']."<br />";
        echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
$count++;
    }

echo "count : ".$count;

echo "<pre>";
print_r($string);
echo "</pre>";


?>
