<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
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
global $db;
$id = null;
//Handle Cases Feedback
if(isset($_REQUEST['id'])){

$id = $_REQUEST['id'];
$case_id = $_REQUEST['case_id'];
$date_modified = $_REQUEST['date_modified'];
$resolution_time = $_REQUEST['resolution_time'];
$explaination_time = $_REQUEST['explaination_time'];
$resolution_result = $_REQUEST['resolution_result'];
$recommendation_time = $_REQUEST['recommendation_time'];
$recommendation_friend_likely_c = $_REQUEST['recommendation_friend_likely_c'];
$description = $_REQUEST['description'];
$on_website = $_REQUEST['on_website'];
$service_rating = $_REQUEST['service_rating'];
$assigned_user_id = $_REQUEST['assigned_user_id'];

//$query1 = "UPDATE cases_cstm SET feedback_submitted_c = 'yes', feedback_date_entered_c = '".$date_modified."', feedback_resolution_time_c = '".$resolution_time."', feedback_explaination_time_c = '".$explaination_time."', feedback_resolution_result_c = '".$resolution_result."', feedback_recommendation_time_c = '".$recommendation_time."', feedback_recommend_friend_c = '".$recommendation_friend_likely_c."', feedback_description_c = '".$description."', feedback_on_website_c = '".$on_website."', feeback_case_id_c = '".$id."', feeback_service_rating_c = '".$service_rating."'  WHERE id_c = '".$id."'"; 

//$result = $db->query($query1);

       $objfeedback = BeanFactory::getBean('scrm_Feedback');
       //$installationCaseName=$objfeedback->name="New_Customer_Installation-".$accountName;
       //$objfeedback->cases_scrm_feedback_1_name = $accountName;
       $objfeedback->cases_scrm_feedback_1cases_ida = $id;
       //$objfeedback->assigned_user_name= $current_user_full_name;
       //$objfeedback->assigned_user_id  = $current_user_id;
        $objfeedback->feeback_case_id_c = $id; 
        $objfeedback->feedback_date_entered_c = $date_modified; 
        $objfeedback->feedback_resolution_time_c = $resolution_time; 
        $objfeedback->feedback_explaination_time_c = $explaination_time; 
        $objfeedback->feedback_resolution_result_c = $resolution_result; 
        $objfeedback->feedback_recommendation_time_c = $recommendation_time; 
        $objfeedback->feedback_recommend_friend_c = $recommendation_friend_likely_c; 
        $objfeedback->feedback_description_c = $description; 
        $objfeedback->feedback_on_website_c = $on_website; 
        $objfeedback->feeback_service_rating_c = $service_rating;
        $objfeedback->assigned_user_id = $assigned_user_id; 
    
       
       //HERE ONLY NAME IS CONSIDERED BUT BETTER TO PUT MORE FILTERING
//$qry1="select name from cases where name = '$installationCaseName' and deleted= 0 ";

		//$value1=$db->query($qry1);
                //$check1  =   $get_values_row1=$db->fetchByAssoc($value1);
		//if(!$check1)
		//{
		$objfeedback->save();	
		//}
       

#	feeback_case_id                         - case_id             - textfield - feeback_case_id_c
#	feedback_date_entered                   - 2016/03/11 11:37:40 - textfield - feedback_date_entered_c 
#	feedback_resolution_time                - Yes                 - textfield - feedback_resolution_time_c
#	feedback_explaination_time              - Yes                 - textfield - feedback_explaination_time_c 
#	feedback_resolution_result              - Yes                 - textfield - feedback_resolution_result_c
#	feedback_recommendation_time            - Yes                 - textfield - feedback_recommendation_time_c
#	feedback_recommendation_friend_likely_c - 10                  - textfield - feedback_recommend_friend_c
#	feedback_description                    - Good service.       - textarea  - feedback_description_c
#	feedback_on_website                     - Yes                 - textfield - feedback_on_website_c
#	feedback_submitted                      - no                  - textfield - feedback_submitted_c
#	feeback_email_sent                      - no                  - textfield - feeback_email_sent_c
#	feeback_service_rating                  - Excellent           - textfield - feeback_service_rating_c



#resolution time - Was your issue resolved the first time you reported it?
#explanation time - Was the engineer able to clearly articulate the troubleshooting steps on the call?
#resolution result - Were you able to understand the tech support engineer clearly?
#recommendation time - Will you recommend our service to your contacts?
#recommendation friend likely - How likely is it that you would recommend our company to friends or colleagues? - 10
#service rating - How would you rate your overall satisfaction with SimpleCRM Support? - Excellent
#description - Remarks/Comments:
#on website -Will you allow us to use these remarks as testimonial on our website and in print?
#edit_button, duplicate_button



//UPDATE cases_cstm  SET feedback_resolution_result_c = 'Yes' WHERE feedback_resolution_result_c IS NULL AND id_c='100b2987-d7d5-e20d-79b0-563a2782f72c';

//UPDATE cases_cstm  SET feedback_resolution_result_c = 'Yes' WHERE feedback_resolution_result_c IS NULL;

//SELECT feedback_resolution_result_c FROM `cases_cstm` WHERE id_c='100b2987-d7d5-e20d-79b0-563a2782f72c'


}
?>
<html>
	<head>
		<link rel="icon" href="favicon.ico" type="image/ico">
		<title>Customer Satisfaction Survey</title>
	</head>
	<body>
		
		<img src="custom/include/images/simple_logo.png" >
		<hr />
		<H3>Customer Satisfaction Survey</H3>

		<hr />
<br />
<center>
	<font size='4' face='verdana'>
        <p>Thank you for your feedback.</p><p>Team SimpleCRM Support</p>
	</font>	
<center>
<br />
<br />
<br />
<hr />
		<center>
			<font size="4" face="verdana">For any kind of Support in Future, Please Call: <span style="color:#2B60DE;">+91 85 5392 1122</span></font>
		</center>
		
		<hr /><br /><br />
	</body>
</html>
