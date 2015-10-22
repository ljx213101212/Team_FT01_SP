<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 21/10/15
 * Time: 1:11 PM
 */

require "../twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
//namespace Abraham\TwitterOAuth;


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token'        => "3190620692-td9gKtFzefnHa1HUQfLgqSYktdCINYcyAVO9Y27",
    'oauth_access_token_secret' => "ikFAm5aKTkyZfchDFJrWIf8xr4KHPrkCqOwRm79UhqUcU",
    'consumer_key'              => "tj5gC8eInAhyFqDZzLxj9yfJb",
    'consumer_secret'           => "5LT4EEgkRErSDIDVsMEc0najghfF2hrIdtRO7Vo8kmYV3S657P",
);

$CONSUMER_KEY = "tj5gC8eInAhyFqDZzLxj9yfJb";
$CONSUMER_SECRET = "5LT4EEgkRErSDIDVsMEc0najghfF2hrIdtRO7Vo8kmYV3S657P";
$access_token = "3190620692-td9gKtFzefnHa1HUQfLgqSYktdCINYcyAVO9Y27";
$access_token_secret = "ikFAm5aKTkyZfchDFJrWIf8xr4KHPrkCqOwRm79UhqUcU";


$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token, $access_token_secret);

$response = array();
$content = $connection->get("account/verify_credentials");

$hash_text;
$statuses;
$length_of_tweets = 5;
$result = array();


//build_multiple_hashtag_search("this has a #hashtag a  #badhash-tag and a #goodhash_tag");


if (isset ($_GET['hash_text'])){
    $hash_text = $_GET['hash_text'];
    $hash_result = build_multiple_hashtag_search($hash_text);
    $statuses = $connection->get("search/tweets", array("q" => $hash_result,"until"=>"2015-10-21"));
    $response["success"] = $hash_text;
    build_up_result_array($statuses);
    echo send_array();
}else{
    $response["error"] = "can not find hash_text in your get request!";
    echo json_encode($response);
}


function build_multiple_hashtag_search($hash_text){

    $return_value="";
    preg_match_all("/(#\w+)/", $hash_text, $matches);
    for ($i = 0 ; $i < sizeof($matches[0]); $i++){

        if ($i != sizeof($matches[0]) - 1) {
            $return_value = $return_value . "%23" . $matches[0][$i] . "+OR+";
        }else{
            $return_value = $return_value ."%23" . $matches[0][$i];
        }
    }


    return $return_value;


}

//print_r ($statuses->statuses[0]);
//
//print_r("<br>");




function build_up_result_array($statuses){

    GLOBAL $length_of_tweets;
    GLOBAL $result;
    for ($i = 0; $i < $length_of_tweets; $i++){
        $result[$i] = $statuses->statuses[$i];
    }
}

//print_r($result[4]->text);


function send_array()
{

    $response["display"] = array();
    GLOBAL $length_of_tweets;
    GLOBAL $result;
    for ($i = 0; $i < $length_of_tweets; $i++) {
        $display = array();
        $display["user_img"] = $result[$i]->user->profile_image_url;
        $display["username"] = $result[$i]->user->name;
        $display["text"] = $result[$i]->text;

//        $display["user_img"] = $result[$i]['user']['profile_image_url'];
//        $display["username"] = $result[$i]['user']['name'];
//        $display["text"] = $result[$i]['text'];

        array_push($response["display"], $display);
    }

    return json_encode($response);

}




//$result;
//$response = array();
//if (isset($_POST['result'])){
//
//     $result = $_POST['result'];
////     echo $result[0]['created_at'];
////     echo $result[0]['text'];
////     echo $result[0]['user']['profile_image_url'];
////     echo $result[0]['user']['name'];
//
//
//    //$temp = json_decode($result,true);
//
//     //echo count($result);
//
//     $length_of_post = count($result);
//
//    $response["display"] = array();
//    for ($i = 0 ; $i < $length_of_post ; $i++){
//         $display = array();
//         $display["user_img"] = $result[$i]['user']['profile_image_url'];
//         $display["username"] = $result[$i]['user']['name'];
//         $display["text"] = $result[$i]['text'];
//
//        array_push($response["display"],$display);
//    }
//
//    echo json_encode($response);
//     //echo $result;
//     //print_r($result);
//     //print_r(json_encode($temp));
//
//}

//function filter($array){
//
//    $filtered_array = array();
//    for($i = 0; $i < count($array); $i++){
//        if($array[$i] == $filter)
//            $filtered_array[] = array[i]
//    }
//    return $filtered_array
//}

//$response = array();
//$url = 'http://wenzhixin.net.cn/p/bootstrap-table/docs/data1.json';
//$content = file_get_contents($url);
//$json = json_decode($content, true);
//$response = json_encode($json);

//echo json_encode($temp);

?>