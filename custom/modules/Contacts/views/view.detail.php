<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


require_once('modules/Contacts/views/view.detail.php');

class CustomContactsViewDetail extends ContactsViewDetail{

    function ContactsViewDetail(){
        parent::ViewDetail();
    } 

    public function display(){

        global $sugar_config;

        $msg = $_REQUEST['msg'];
        if($msg){
          echo "<script>
           $(document).ready(function(){
                    YAHOO.SUGAR.MessageBox.show({msg: '$msg', title: 'Message'});
            });
          </script>";
        }

        echo $js=<<<abc
        <script type="text/javascript">
              $(document).ready(function(){
                 
                $('#whole_subpanel_contacts_cases_1').hide();
                $('#whole_subpanel_contact_aos_quotes').hide();
                $('#whole_subpanel_contact_aos_invoices').hide();
                sp();
                ss();
                rejected();
                $('#enquiry_id_c').parent().parent().hide();
                
              });

                
               function ss(){
                if($('#self_sponsored_c').is(':checked')){
                  $('#sponsor_organisation_c').parent().parent().hide();
                }else{
                  $('#sponsor_organisation_c').parent().parent().show();
                }
              }

              function sp(){
                if($('#programme_type_c').val() == 'Sponsored'){
                    $('#date_of_entry_into_govt_c').parent().parent().show();
                }else{
                    $('#date_of_entry_into_govt_c').parent().parent().hide();
                }
              }

              function rejected(){
                 if($('#nomination_status_c').val() == 'Rejected'){
                    $('#reasons_for_rejection_c').parent().parent().show()
                }else{
                    $('#reasons_for_rejection_c').parent().parent().hide()
                }
              }
        </script>
abc;



//Twitter integration starts
  global $sugar_config; global $db;
        $site_url = $sugar_config['site_url'];
  $id=$this->bean->id;
  $twitter_handle = $this->bean->twitter_handle_c;
  
$js1 = <<<BOC
<div id="dialog" title="Dialog Title"><span style="color:green; font-size:15px;"></span></div>
<div id="imageLoading"></div>
<link rel="stylesheet" type="text/css" href="custom/include/bootstrap/style.css">
<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
<script type="text/javascript">                
	$(document).ready(function() {
		var twitter_handle = '$twitter_handle';
		//Adding twitter icon, if twitter handle is present
		if(twitter_handle){   
			$('#twitter_handle_c').append('<img id="contact_twitter_handle" width="20" height="15" src="custom/include/images/twitter_logo.png" >');
		}
		$('#contact_twitter_handle').on('click',function(){
			$('#imageLoading').css('display','block'); 
			var twitter_handle = '$twitter_handle';
			var module='Contacts'; 
			var action='get_tweets';
			var to_pdf='true';  
			if(twitter_handle){
				$.ajax({
					type: "GET", 
					async: false,
					url: "index.php",
					data: 
					{   
						module:module,
						action:action,
						to_pdf:to_pdf,
						twitter_handle:twitter_handle,
					},//parameters  
					success: function(response)
					{
						//$('#imageLoading').css('display','none'); .fadeOut("slo
						$('#imageLoading').fadeOut("slow");
						objData  = jQuery.parseJSON(response);

						twitter_data                =   objData.twitter_data;
						got_twitter_data            =   objData.got_twitter_data;
						result_count                =   objData.result_count;
						twitter_display_name        =   objData.twitter_display_name;
						twitter_profile_picture_url =   objData.twitter_profile_image_url;
       
						if(got_twitter_data =='yes'){

							var data = '<div style="width:100%;"><div id="favourites" class="tab-pane fade in active"><table style="margin-top:5px;" class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><th class="narrowWidthType" style="text-align:left;padding-left:2px;" >Published On</th><th class="narrowWidthType" style="text-align:left;padding-left:30px;">Message</th><th class="narrowWidthType" style="padding-left:30px;">Retweets</th><th class="narrowWidthType" style="padding-left:40px;">Favourites</th><th class="narrowWidthType" style="padding-right:35px;"><span>Actions</span></th><th></th></tr></thead><tbody class="listViewTableContents">'+twitter_data+'<tr class="listViewEntries mm_normal mm_clickable loadmore" data-maxid="m625691784786481151"><td></td><td></td><td></td><td><center><span class="more"></span></center></td><td></td><td></td></tr></tbody></table></div></div>';

							YAHOO.SUGAR.MessageBox.show({msg: data, title: '<span style="padding-left:30px;"><a href="https://twitter.com/$twitter_handle" target="_blank" title="'+twitter_display_name+'"><img width="40" height="40" src="'+twitter_profile_picture_url+'"></a> <font color="#E2264D"> '+twitter_display_name+' </font> </span><span style="padding-left:30%;"><font color="#008080">Recent Tweets</font></span><img width="20" height="15" src="custom/include/images/twitter_logo.png" style="padding-left:5px;padding-bottom:4px;" id="contact_twitter_handle_popup"><input id="close_button" type="button" style="padding-left:10px;padding-right:10px;margin-left:42%;" value="X">', 
 
							});

							$('.container-close').hide();

							$('#close_button').on('click', function() {

							YAHOO.SUGAR.MessageBox.hide();

							});

							$('.actions_dd').on('change', function() {

								//var option_id = $(this).children(":selected").attr("id");
								  var selector_id = $(this).attr("id");				
 
								var split           = selector_id.split('_');
								var pattern         = split[0];
								var res_array_count = split[1];
								var hidu_data = $('#hids_'+res_array_count).val();
								var split_hidu_data = hidu_data.split('abcd0123dcba');
								var tweet                      = split_hidu_data[0];
								var tweet                      = tweet.replace('<br/>',' ');
								var status_id                  = split_hidu_data[1];
								var published_date             = split_hidu_data[2];
								var page_or_user_dispaly_name  = split_hidu_data[3];
								var page_or_user_screen_name   = split_hidu_data[4];
								var image_url                  = split_hidu_data[5];

								var page_or_user_dispaly_name_split = page_or_user_dispaly_name.split(' ');
								var page_or_user_dispaly_name_split1 = page_or_user_dispaly_name_split[0];
								var page_or_user_dispaly_name_split2 = page_or_user_dispaly_name_split[1];
								first_namee = page_or_user_dispaly_name_split1;
								last_namee  = page_or_user_dispaly_name_split2;

								if (page_or_user_dispaly_name_split2 == undefined || page_or_user_dispaly_name_split2 == null) {
								first_namee = '';
								last_namee  = page_or_user_dispaly_name_split1;
								}

								var desc = 'Tweet : '+tweet+', Tweeted by : '+page_or_user_dispaly_name+', Tweeted on : '+published_date+', Link to tweet : https://twitter.com/string/status/'+status_id;

								var case_desc = '<p>Tweet : '+tweet+' </p><p>Tweeted by : '+page_or_user_dispaly_name+'</p><p>Tweeted on : '+published_date+'</p><p>Link to tweet : <a href="https://twitter.com/string/status/'+status_id+'" target="_blank">Tweet</a></p>';

								var tweet                      = split_hidu_data[0];
								var tweet                      = tweet.replace('<br/>',' ');
								var status_id                  = split_hidu_data[1];
								var published_date             = split_hidu_data[2];
								var page_or_user_dispaly_name  = split_hidu_data[3];
								var page_or_user_screen_name   = split_hidu_data[4];
								var image_url                  = split_hidu_data[5];

								var module_type = this.value;
								
								if(module_type == 'Add Contact' ){

								$('#imageLoading').css('display','block'); 

								var module_name = 'Contacts';
								var module =  module_name; 
								var action = 'create_records';
								var to_pdf = 'true';  
								var first_name = first_namee;
								var last_name  = last_namee;
								var twitter_handle_c   = page_or_user_screen_name;
								var lead_source        = "Twitter";
								var description        = desc;
								var status_id          = status_id;
								var email              = "";
								var salutation         = "";
								var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f"; 

								$.ajax({
									type: "GET", 
									async: false,
									url: "index.php",
									data: 
									{   
										   module:module,
										   action:action,
										   to_pdf:to_pdf,
										   first_name:first_name,
										   last_name:last_name,
										   twitter_handle_c:twitter_handle_c,
										   lead_source:lead_source,
										   description:description,
													   status_id:status_id,
													   account_id:account_id,
										  
									},//parameters  
									  success: function(response)
									  {

												  $('#imageLoading').fadeOut("slow"); 
														$('.span_notification').remove();
									  objData     = jQuery.parseJSON(response);
														var rec_id  =   objData.id_c;
														var created =   objData.created;
														var site_url = '$site_url';
														var span_notify_id = 'notify_'+res_array_count;
														var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

								if(created == 'y'){
								$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Nomination</a></b> created</span>');
								}
								if(created == 'n'){
								$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Nomination</a></b> Exists</span>');
								}
														}

								});


								// to clear selected value of dd
									$(".actions_dd option:selected").removeAttr("selected");
								}

						if(module_type == 'Add Lead' ){
						var module_name = 'Leads';
						$('#imageLoading').css('display','block'); 
						var module =  module_name; 
						var action = 'create_records';
						var to_pdf = 'true';  
						var first_name = first_namee;
						var last_name  = last_namee;
						var twitter_handle_c   = page_or_user_screen_name;
						var lead_source        = "Twitter";
						var description        = desc;
						var lead_status        = "New"; 
						var status_id          = status_id;
						$.ajax({
							type: "GET", 
							async: false,
							url: "index.php",
							data: 
							{   
								   module:module,
								   action:action,
								   to_pdf:to_pdf,
								   first_name:first_name,
								   last_name:last_name,
								   twitter_handle_c:twitter_handle_c,
								   lead_source:lead_source,
								   description:description,
								   lead_status:lead_status,
											   status_id:status_id,
								  

							},//parameters  
							  success: function(response)
							  {

										  $('#imageLoading').fadeOut("slow"); 
												$('.span_notification').remove();
							  objData     = jQuery.parseJSON(response);
												var rec_id  =   objData.id_c;
												var created =   objData.created;
												var site_url = '$site_url';
												var span_notify_id = 'notify_'+res_array_count;
												var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

						if(created == 'y'){
						$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Enquiry</a></b> created</span>');
						}
						if(created == 'n'){
						$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Enquiry</a></b> Exists</span>');
						}
												}

						});

						// to clear selected value of dd
						$(".actions_dd option:selected").removeAttr("selected");

						}



					if(module_type == 'Add Case' ){
					var module_name = 'Cases';

					$('#imageLoading').css('display','block'); 

					var module =  module_name; 
					var action = 'create_records';
					var to_pdf = 'true'; 
					var status_id          = status_id;
					var twitter_handle_c   = page_or_user_screen_name;
					var case_name          = 'Twitter : '+tweet;
					var description        = case_desc; 
					var priority           = "P2";      
					var case_status        = "New";
					var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f";  

					$.ajax({
						type: "GET", 
						async: false,
						url: "index.php",
						data: 
						{   
							   module:module,
							   action:action,
							   to_pdf:to_pdf,
							   twitter_handle_c:twitter_handle_c,
							   description:description,
										   status_id:status_id,
							   case_name:case_name,
							   priority:priority,
							   case_status:case_status,
							   account_id:account_id,
							  

						},//parameters  
						  success: function(response)
						  {

									  $('#imageLoading').fadeOut("slow");
											$('.span_notification').remove(); 
						  objData     = jQuery.parseJSON(response);
											var rec_id  =   objData.id_c;
											var created =   objData.created;
											var site_url = '$site_url';
											var span_notify_id = 'notify_'+res_array_count;
											var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

					if(created == 'y'){
					$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Case</a></b> created</span>');
					}
					if(created == 'n'){
					$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Case</a></b> Exists</span>');
					}

											}

					});

					// to clear selected value of dd
					$(".actions_dd option:selected").removeAttr("selected");
					}


					if(module_type == 'Add Opportunity' ){

					var module_name = 'Opportunities';

					$('#imageLoading').css('display','block'); 

					var module             =  module_name; 
					var action             = 'create_records';
					var to_pdf             = 'true'; 
					var status_id          = status_id;
					var twitter_handle_c   = page_or_user_screen_name;
					var opportunity_name   = 'Twitter : '+tweet;
					var description        = desc;      
					var sales_stage        = "Prospecting"; 
					var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f"; 
					var lead_source        = "Twitter"; 
					var opportunity_type   = "New Business"; 
					var amount             = "1000000";
					var probability        = "30";
					var date_closed        = "$date_closed";

					$.ajax({
						type: "GET", 
						async: false,
						url: "index.php",
						data: 
						{   
							   module:module,
							   action:action,
							   to_pdf:to_pdf,
							   twitter_handle_c:twitter_handle_c,
							   description:description,
										   status_id:status_id,
							   account_id:account_id,
							   opportunity_name:opportunity_name,
							   sales_stage:sales_stage,
							   lead_source:lead_source,
							   opportunity_type:opportunity_type,
							   amount:amount,
							   probability:probability,
							   date_closed:date_closed,

							  

						},//parameters  
						  success: function(response)
						  {

									  $('#imageLoading').fadeOut("slow");
											$('.span_notification').remove(); 
						  objData     = jQuery.parseJSON(response);
											var rec_id  =   objData.id_c;
											var created =   objData.created;
											var site_url = '$site_url';
											var span_notify_id = 'notify_'+res_array_count;
											var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

					if(created == 'y'){
					$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Proposal</a></b> created</span>');
					}
					if(created == 'n'){
					$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Proposal</a></b> Exists</span>');
					}

											}

					});

					// to clear selected value of dd
					$(".actions_dd option:selected").removeAttr("selected");
					}


});   // on-change of action dd


}     // if = yes condition


if(got_twitter_data !='yes'){

YAHOO.SUGAR.MessageBox.show({msg: '<span style="color:red;">Error while connecting with Twitter</span>', title: '<span style="padding-left:5px;"><font color="#008080">Recent Tweets</font></span><a target="_blank" href="https://twitter.com/$twitter_handle"><img width="20" height="15" id="contact_twitter_handle_popup" style="padding-left:5px;padding-bottom:4px;" src="custom/include/images/twitter_logo.png"></a>', 
 
});

} // if != yes condition


}    // main ajax call success

}); // main ajax call

}  // if close

}); // on-click twitter image

}); //main close

function closePopup()
 {
    YAHOO.SUGAR.MessageBox.hide();
 }

        </script>
BOC;
          
        echo $js1;

parent::display();


    }
}
