<?php
// ini_set('display_errors','On');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


require_once('include/MVC/View/views/view.detail.php');

class scrm_PartnersViewDetail extends ViewDetail {


 	function scrm_PartnersViewDetail(){
 		parent::ViewDetail();
 	}

 	function display(){
		global $db;
		global $current_user;
		$userid=$current_user->id;	

	echo $js2 = <<<RES
        <script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
  <script>
        $(document).ready(function(){
			//alert('Hai');
			$('td[field="mobile_number_c"]').append('<img src=\"custom/include/images/mob3.png\" title=\"Click here to Send SMS for the Contact\" class="smsimage" style=\" width:10px;height:17px;\" ></img>');
			
					$('#whole_subpanel_scrm_partners_scrm_partner_contacts_1').hide();
					$('#whole_subpanel_scrm_partners_leads_1').hide();
				$('td[field="mobile_number_c"]').click(function(){
				var mobile = $(this).text().trim();
				//alert(mobile);
				$('.smsimage').click(function(){
					var dataa = '<div style="width:200px;height:170px;padding-left:10px;"><br><br><br><textarea cols="25" rows="5" name="mob" id="mob" placeholder="Please enter your text here" style="font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"></textarea><br></div>';
					YAHOO.SUGAR.MessageBox.show({msg: dataa,title: '<center>Send SMS</center>', type:'confirm',
						 fn: function(confirm) {
							if (confirm == 'yes') {
							var smstext=$('#mob').val();
							if(smstext){
									
								
								var smstext=$('#mob').val();
							  currenturl=$(location).attr('href');
							  name = "module".replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
							  var regexS = "[\\?&]"+name+"=([^&#]*)";
							  var regex = new RegExp( regexS );
							  var results = regex.exec( window.location.href );
							  var module=results[1];
							  name = "record".replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
							  var regexS = "[\\?&]"+name+"=([^&#]*)";
							  var regex = new RegExp( regexS );
							  var results = regex.exec( window.location.href );
							  var recordid=results[1];
							  var userid='$userid';
							  var result;
							  
								 if(smstext){
									
								
								 $.ajax({
									url: 'sendsms.php',
									type:'POST',
									async: false,
									data:{
										mobile : mobile, 
										smstext : smstext,
										recordid : recordid,
										userid : userid,
										module: module,
										},
									}).done(function(data){
										location.reload(true);
										alert("SMS Sent Successfully");
								});
							}
							else{
								alert("SMS Text is Empty!Cant send SMS");
								
								}
							}
							}
						}
					});
					});
				}); 
					
					
					
				});
		
		</script>
RES;
	parent::display();
 	}
}

?>
