<?php
/*
Main cron file of facebook integration(Lead management + Case management)
Created by : Nitheesh.R
Date       : Jan-08-2016
email      : nitheesh@simplecrm.com.sg  

facebook api version : 2.3
*/
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

global $sugar_config, $current_user, $db;
$access_token = $sugar_config['facebook_page_access_token'];
$page_id      = $sugar_config['facebook_page_id'];
$page_name    = $sugar_config['facebook_page_name'];

//get this value from config file/other ways
$assigned_user_id   = "746c64c4-6656-a101-3a6e-55d72a3e1628";
$current_user->id   = "1"; // To avoid empty created_by and edited_by field
//$current_user->id = $assigned_user_id;

//add more keyword programatically if needed
$keyword_array      = array('recommend','propose','internet plans','internet plan',
	                        'introduce','internets','advise','suggest','home loan',
	                        'car loan','loan');

//Get page data
try {
	$page_details       = "https://graph.facebook.com/".$page_id."/feed?&method=GET&access_token=" .$access_token;
	$response           = file_get_contents($page_details);
	$response           = json_decode($response);
	$data               = $response->data;
} catch (Exception $e) {
    echo 'Caught Exception: ',  $e->getMessage(), "\n";
}

// echo "<pre>";
// print_r($data);
// echo "</prev>";
// exit;

foreach($data as $data_comment){

$comment_id             = $data_comment->id;
$message                = $data_comment->message;
$message_from_name      = $data_comment->from->name;
$message_from_id        = $data_comment->from->id;
$message_created_time   = $data_comment->created_time;
$message_updated_time   = $data_comment->updated_time;
$message                = strtolower($message);

//LEAD MANAGEMENT - Start

//use keyword_array or directly check with all keywords.
foreach ($keyword_array as $keyword) {
 if ( strpos($message,$keyword) !== false){

$posted_user_id = $message_from_id;
$user_details= "https://graph.facebook.com/".$posted_user_id."?&method=GET&access_token=" .$access_token;
$response202 = file_get_contents($user_details);
$response202 = json_decode($response202);

$message_from_name       = $response202->name;
$message_from_first_name = $response202->first_name;
$message_from_last_name  = $response202->last_name;
$message_from_id         = $response202->id;

$fb_link_to_user ="https://www.facebook.com/".$message_from_id;
$fb_link_to_post ="https://www.facebook.com/".$comment_id;

$lead_full_name                = $message_from_name;
$lead_first_name               = $message_from_first_name;
$lead_last_name                = $message_from_last_name;
$lead_facebook_id              = $message_from_id;
$lead_source                   = "Facebook";
$time_and_date_of_post         = $message_created_time; // $Published_date
$time_and_date_of_post_split   = split("T", $time_and_date_of_post);
$date                          = $time_and_date_of_post_split['0'];
$time                          = str_replace("+0000","",$time_and_date_of_post_split['1']);
$time                          = rtrim($time_and_date_of_post_split['1'], "+0000");
$time_corrected                = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
$time_and_date_of_post_correct = $date." ".$time_corrected;

$lead_description         = "Post : ".$message." \n Posted On : ".$time_and_date_of_post_correct." \n Link to Facebook Profile : ".$fb_link_to_user." \n Link to Post : ".$fb_link_to_post;

    $lead = new Lead();
    $lead->first_name              = $lead_first_name;
    $lead->last_name               = $lead_last_name;
    $lead->lead_source             = $lead_source;
    $lead->description             = $lead_description;
    $lead->assigned_user_id        = $assigned_user_id;
    $lead->posted_message_id_c     = $comment_id;
    $lead->post_from_id_c          = $message_from_id;
    $lead->status                  = "New";
    $lead->classification_c        = "Warm";

//consider deleted = 0 also if needed.
$query1  =   "SELECT id_c FROM leads_cstm, leads WHERE id = id_c AND posted_message_id_c = '$comment_id'";
$value1  =   $db->query($query1);
$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

if(!$check1){
$lead->save();
}

//create note based on user reply to comment in fb
$page_details2      = "https://graph.facebook.com/".$comment_id."/comments?&method=GET&access_token=" .$access_token;
$response2          = file_get_contents($page_details2);
$response2          = json_decode($response2);
$data_out40         = $response2->data;

foreach($data_out40 as $data_out50_comment){

$comment_id_out50             = $data_out50_comment->id;
$message_out50                = $data_out50_comment->message;
$message_from_name_out50      = $data_out50_comment->from->name;
$message_from_id_out50        = $data_out50_comment->from->id;
$message_created_time_out50   = $data_out50_comment->created_time;

$query9  =   "SELECT id_c FROM leads_cstm,leads WHERE id_c = id AND deleted = 0  AND posted_message_id_c = '$comment_id' ";
$result9 =   $db->query($query9);
$check9  =   $get_values_row9  = $db->fetchByAssoc($result9);

$lead_id_c = $get_values_row9['id_c'];

$time_and_date_of_post         = $message_created_time_out50; // $Published_date
$time_and_date_of_post_split   = split("T", $time_and_date_of_post);
$date                          = $time_and_date_of_post_split['0'];
$time                          = str_replace("+0000","",$time_and_date_of_post_split['1']);
$time                          = rtrim($time_and_date_of_post_split['1'], "+0000");
$time_corrected                = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
$time_and_date_of_post_correct = $date." ".$time_corrected;
$fb_link_to_user               = "https://www.facebook.com/".$message_from_id_out50;
$fb_link_to_post               = "https://www.facebook.com/".$comment_id_out50;

$note_description         = "Post : ".$message_out50." \n Posted On : ".$time_and_date_of_post_correct." \n Link to Facebook Profile : ".$fb_link_to_user." \n Link to Post : ".$fb_link_to_post;

$parent_type        = "Leads";
$parent_id          = $lead_id_c;
$name               = "Facebook : ".$message_out50;
$note_description   = $note_description;
$post_data_in_fb    = "posted";

$note = new Note();

$note->name                  = $name;
$note->description           = $note_description;
$note->parent_type           = $parent_type;
$note->parent_id             = $parent_id;
$note->assigned_user_id      = $assigned_user_id;
$note->post_id_c             = $comment_id;
$note->comment_id_c          = $comment_id_out50;
$note->post_data_in_fb_c     = $post_data_in_fb;

//consider deleted = 0 also if needed.
$query8  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND post_id_c = '$comment_id' and comment_id_c = '$comment_id_out50' ";
$value8  =   $db->query($query8);
$check8  =   $get_values_row8  = $db->fetchByAssoc($value8);

if(!$check8){
if($message_from_name_out50 != $page_name  ){
$note->save();
}
}

$page_details3= "https://graph.facebook.com/".$comment_id_out50."/comments?&method=GET&access_token=" .$access_token;
$response3 = file_get_contents($page_details3);
$response3= json_decode($response3);

$data_out60  = $response3->data;
foreach($data_out60 as $data_out70_comment){

 $comment_id_out70             = $data_out70_comment->id;
 $message_out70                = $data_out70_comment->message;
 $message_from_name_out70      = $data_out70_comment->from->name;
 $message_from_id_out70        = $data_out70_comment->from->id;
 $message_created_time_out70   = $data_out70_comment->created_time;

$query90  =   "SELECT id_c FROM leads_cstm,leads WHERE id_c = id AND deleted = 0  AND posted_message_id_c = '$comment_id' ";
$result90 =   $db->query($query90);
$check90  =   $get_values_row90  = $db->fetchByAssoc($result90);

$lead_id_c = $get_values_row90['id_c'];

$time_and_date_of_post         = $message_created_time_out70; // $Published_date
$time_and_date_of_post_split   = split("T", $time_and_date_of_post);
$date                          = $time_and_date_of_post_split['0'];
$time                          = str_replace("+0000","",$time_and_date_of_post_split['1']);
$time                          = rtrim($time_and_date_of_post_split['1'], "+0000");
$time_corrected                = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
$time_and_date_of_post_correct = $date." ".$time_corrected;


$fb_link_to_user ="https://www.facebook.com/".$message_from_id_out70;
$fb_link_to_post ="https://www.facebook.com/".$comment_id_out70;

$note_description         = "Post : ".$message_out70." \n Posted On : ".$time_and_date_of_post_correct." \n Link to Facebook Profile : ".$fb_link_to_user." \n Link to Post : ".$fb_link_to_post;

$parent_type        = "Leads";
$parent_id          = $lead_id_c;
$name               = "Facebook : ".$message_out70;
$note_description   = $note_description;
$post_data_in_fb    = "posted";

    $note2 = new Note();
    $note2->name                  = $name;
    $note2->description           = $note_description;
    $note2->parent_type           = $parent_type;
    $note2->parent_id             = $parent_id;
    $note2->assigned_user_id      = $assigned_user_id;
    $note2->post_id_c             = $comment_id;
    $note2->comment_id_c          = $comment_id_out50;
    $note2->comment_reply_id_c    = $comment_id_out70;
    $note2->post_data_in_fb_c     = $post_data_in_fb;

//consider deleted = 0 also if needed.
$query80  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND post_id_c = '$comment_id' and comment_reply_id_c = '$comment_id_out70' and comment_id_c = '$comment_id_out50' ";
$value80  =   $db->query($query80);
$check80  =   $get_values_row80  = $db->fetchByAssoc($value80);

if(!$check80){
if($message_from_name_out70 != $page_name ){
$note2->save();
}
}

}

}

//comment note content in fb post
$query2  = "SELECT id_c FROM leads_cstm,leads WHERE id_c = id AND deleted = 0 AND posted_message_id_c = '$comment_id' ";
$result2 = $db->query($query2);
$check2  =   $get_values_row2  = $db->fetchByAssoc($result2);
if($check2){

$lead_record_id  = $get_values_row2['id_c'];
$parent_type     = 'Leads';
$query8          = "SELECT id, name, description FROM notes, notes_cstm WHERE id=id_c AND parent_type ='$parent_type' AND parent_id ='$lead_record_id' AND post_data_in_fb_c !='posted' AND deleted = 0 ";
$result8         = $db->query($query8);

$comments = new stdClass;
$comments->data = array();

while($row8 = $db->fetchByAssoc($result8)){
    $comment = new stdClass;
    $comment->description = $row8['description'];
    $comment->id = $row8['id'];
    $comment->name = $row8['name'];
    $comments->data[] = $comment;
}

$comments_data = $comments->data;

foreach($comments_data as $comt_data){

$note_description = $comt_data->description;
$note_id          = $comt_data->id;
$note_description = urlencode($note_description);

if($note_description != ''){
$page_details5 = "https://graph.facebook.com/".$comment_id."/comments?method=POST&message=".$note_description."&access_token=" .$access_token;
$response5     = file_get_contents($page_details5);
//$response5   = json_decode($response5);
$query800      = "update notes, notes_cstm set post_data_in_fb_c ='posted' WHERE id=id_c AND  id_c ='$note_id'  AND deleted = 0 ";
$result800     = $db->query($query800);
}

}

}

 break;
 }
}// lead if close
//LEAD MANAGEMENT - End




//CASE MANAGEMENT - Start

if ( strpos($message,'not') !== false || strpos($message,'defect') !== false || strpos($message,'defects') !== false || strpos($message,'issues') !== false || strpos($message,'issue') !== false ||  strpos($message,'not working') !== false || strpos($message,'no working') !== false || strpos($message,'no work') !== false  ||  strpos($message,'complaints') !== false || strpos($message,'complaint') !== false || strpos($message,'problems') !== false || strpos($message,'problem') !== false || strpos($message,'error') !== false || strpos($message,'errors') !== false ){



$user_idd = $message_from_id;
$user_details20= "https://graph.facebook.com/".$user_idd."?&method=GET&access_token=" .$access_token;
$response20 = file_get_contents($user_details20);
$response20= json_decode($response20);

$message_from_name       = $response20->name;
$message_from_first_name = $response20->first_name;
$message_from_last_name  = $response20->last_name;
$message_from_id         = $response20->id;
$message_from_gender     = $response20->gender;


$fb_link_to_user ="https://www.facebook.com/".$message_from_id;
$fb_link_to_post ="https://www.facebook.com/".$comment_id;

$time_and_date_of_post         = $message_created_time; // $Published_date  
$time_and_date_of_post_split   = split("T", $time_and_date_of_post);
$date                          = $time_and_date_of_post_split['0'];
$time                          =  str_replace("+0000","",$time_and_date_of_post_split['1']);
$time                          = rtrim($time_and_date_of_post_split['1'], "+0000");
$time_corrected                = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
$time_and_date_of_post_correct = $date." ".$time_corrected;

$case_description         = "Post:".$message.",Posted On : ".$time_and_date_of_post_correct
                           .",Link to Facebook Profile : ".$fb_link_to_user.",Link to Post : ".$fb_link_to_post;

$GLOBALS['log']->fatal('case description :'.$case_description);

$account_name       = "SimpleWorks";
$account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f";
$case_priority      = "P2";
$case_status        = "Open_New";
$subject            = "Facebook : ".$message;
$description        = $message.' - '.$message_from_name;
$assigned_user_name = "Administrator";
$assigned_user_id   = "1";
$team_id            = "1";
$case_source        = "Facebook";
$state              = "Open";

    $case = new aCase();

    $case->name                    = $subject;
    $case->status                  = $case_status;
    $case->priority                = $case_priority;
    $case->source_c                = $case_source;
    $case->account_name            = $account_name;
    $case->account_id              = $account_id;
    $case->description             = $description;
    $case->assigned_user_name      = $assigned_user_name;
    $case->assigned_user_id        = $assigned_user_id;
    $case->posted_message_id_c     = $comment_id;
    //$case->team_id                 = $team_id;
    $case->post_from_id_c          = $message_from_id;
    $case->post_from_first_name_c  = $message_from_first_name;
    $case->post_from_last_name_c   = $message_from_last_name;
    $case->state                   = $state;

global $db;

//$query1  = "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND deleted = 0 AND posted_message_id_c = '$comment_id'";

$query1  = "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND posted_message_id_c = '$comment_id'";
$value1  =   $db->query($query1);
$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

if(!$check1){
$case->save();
echo '<b>Case created.</b>'; echo '<br>';
}

$user_details2= "https://graph.facebook.com/".$comment_id."/comments?&method=GET&access_token=" .$access_token;
$response2 = file_get_contents($user_details2);
$response2= json_decode($response2);


$data_outu         = $response2->data;

foreach($data_outu as $data_outu_comment){

$comment_id_outu             = $data_outu_comment->id;
$message_outu                = $data_outu_comment->message;
$message_from_name_outu      = $data_outu_comment->from->name;
$message_from_id_outu        = $data_outu_comment->from->id;
$message_created_time_outu   = $data_outu_comment->created_time;


$query9  =   "SELECT id_c FROM cases_cstm,cases WHERE id_c = id AND deleted = 0  AND posted_message_id_c = '$comment_id' ";
$result9 =   $db->query($query9);
$check9  =   $get_values_row9  = $db->fetchByAssoc($result9);

$case_id_c = $get_values_row9['id_c'];



$parent_type        = "Cases";
$parent_id          = $case_id_c;
$name               = "Facebook : ".$message_outu;
$note_description   = $message_outu." "."by : ".$message_from_name_outu." "."on : ".$message_created_time_outu;
$assigned_user_name = "Administrator";
$assigned_user_id   = "1";
$team_id            = "1";
$post_data_in_fb    ="posted";

    $note = new Note();

    $note->name                  = $name;
    $note->description           = $note_description;
    $note->parent_type           = $parent_type;
    $note->parent_id             = $parent_id;
    $note->assigned_user_name    = $assigned_user_name;
    $note->assigned_user_id      = $assigned_user_id;
    $note->post_id_c             = $comment_id;
    $note->comment_id_c          = $comment_id_outu;
    //$note->team_id               = $team_id;
    $note->post_data_in_fb_c     = $post_data_in_fb;



global $db;

//$query8  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND deleted = 0 AND post_id_c = '$comment_id' and comment_id_c = '$comment_id_outu' ";

$query8  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND post_id_c = '$comment_id' and comment_id_c = '$comment_id_outu' ";
$value8  =   $db->query($query8);
$check8  =   $get_values_row8  = $db->fetchByAssoc($value8);

if(!$check8){
if($message_from_name_outu !='SCRM'  ){

$note->save();
echo '<b>Note created.</b>'; echo '<br>';

}

}



$user_details3= "https://graph.facebook.com/".$comment_id_outu."/comments?&method=GET&access_token=" .$access_token;
$response3 = file_get_contents($user_details3);
$response3= json_decode($response3);

$data_outuu  = $response3->data;

foreach($data_outuu as $data_outuu_comment){

 $comment_id_outuu             = $data_outuu_comment->id;
 $message_outuu                = $data_outuu_comment->message;
 $message_from_name_outuu      = $data_outuu_comment->from->name;
 $message_from_id_outuu        = $data_outuu_comment->from->id;
 $message_created_time_outuu   = $data_outuu_comment->created_time;

$query90  =   "SELECT id_c FROM cases_cstm,cases WHERE id_c = id AND deleted = 0  AND posted_message_id_c = '$comment_id' ";
$result90 =   $db->query($query90);
$check90  =   $get_values_row90  = $db->fetchByAssoc($result90);

$case_id_c = $get_values_row90['id_c'];


$parent_type        = "Cases";
$parent_id          = $case_id_c;
$name               = "Facebook : ".$message_outuu;
$note_description   = $message_outuu." "."by : ".$message_from_name_outuu." "."on : ".$message_created_time_outuu;
$assigned_user_name = "Administrator";
$assigned_user_id   = "1";
$team_id            = "1";
$post_data_in_fb    = "posted";


    $note2 = new Note();

    $note2->name                  = $name;
    $note2->description           = $note_description;
    $note2->parent_type           = $parent_type;
    $note2->parent_id             = $parent_id;
    $note2->assigned_user_name    = $assigned_user_name;
    $note2->assigned_user_id      = $assigned_user_id;
    $note2->post_id_c             = $comment_id;
    $note2->comment_id_c          = $comment_id_outu;
    $note2->comment_reply_id_c    = $comment_id_outuu;
    $note2->post_data_in_fb_c     = $post_data_in_fb;
    //$note2->team_id               = $team_id;


global $db;

//$query80  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND deleted = 0 AND post_id_c = '$comment_id' and comment_reply_id_c = '$comment_id_outuu' and comment_id_c = '$comment_id_outu' ";

$query80  = "SELECT id_c FROM notes_cstm, notes WHERE id = id_c AND post_id_c = '$comment_id' and comment_reply_id_c = '$comment_id_outuu' and comment_id_c = '$comment_id_outu' ";
$value80  =   $db->query($query80);
$check80  =   $get_values_row80  = $db->fetchByAssoc($value80);

if(!$check80){
if($message_from_name_outuu !='SCRM' ){

$note2->save();
echo '<b>Note created.</b>'; echo '<br>';

}

}

}

}

$query2  = "SELECT id_c FROM cases_cstm,cases WHERE id_c = id AND deleted = 0 AND posted_message_id_c = '$comment_id' ";
$result2 = $db->query($query2);
$check2  =   $get_values_row2  = $db->fetchByAssoc($result2);
if(!$check2){

}
if($check2){

$case_record_id  = $get_values_row2['id_c'];

$parent_type = 'Cases';
$query8      = "SELECT id, name, description FROM notes, notes_cstm WHERE id=id_c AND parent_type ='$parent_type' AND parent_id ='$case_record_id' AND post_data_in_fb_c !='posted' AND deleted = 0 ";
$result8     = $db->query($query8);

$comments = new stdClass;
$comments->data = array();

while($row8 = $db->fetchByAssoc($result8)){

    $comment = new stdClass;
    $comment->description = $row8['description'];
    $comment->id = $row8['id'];
    $comment->name = $row8['name'];
    $comments->data[] = $comment;


}


$comments_data = $comments->data;

echo "<pre>";
print_r($comments_data);
echo "</pre>";

foreach($comments_data as $cd){
echo $desci =  $cd->description;
echo "<br>";
}

$comments_data0 = $comments_data[0];
$comments_data1 = $comments_data[1];
$desc1 = $comments_data0->description;
$id1 = $comments_data0->id;
$desc2 = $comments_data1->description;
$id2 = $comments_data1->id;

// $desc1 = str_replace(' ', '+', $desc1);
// $desc2 = str_replace(' ', '+', $desc2);

$desc1 = urlencode($desc1);
$desc2 = urlencode($desc2);

if($desc1 != ''){
echo "desc1 :".$desc1;
$user_details5 = "https://graph.facebook.com/".$comment_id."/comments?method=POST&message=".$desc1."&access_token=" .$access_token;
$response5 = file_get_contents($user_details5);
//$response5 = json_decode($response5);
$query800      = "update notes, notes_cstm set post_data_in_fb_c ='posted' WHERE id=id_c AND  id_c ='$id1'  AND deleted = 0 ";
$result800     = $db->query($query800);

}
if($desc2 != ''){
echo "desc2 :".$desc2;
$user_details6 = "https://graph.facebook.com/".$comment_id."/comments?method=POST&message=".$desc2."&access_token=" .$access_token;
$response6 = file_get_contents($user_details6);
//$response6 = json_decode($response6);
$query800      = "update notes, notes_cstm set post_data_in_fb_c ='posted' WHERE id=id_c AND  id_c ='$id2'  AND deleted = 0 ";
$result800     = $db->query($query800);
}



}



} // case if close

//CASE MANAGEMENT - End


} // main foreach

?>
