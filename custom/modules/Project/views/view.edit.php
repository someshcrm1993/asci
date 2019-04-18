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


require_once('modules/Project/views/view.edit.php');

class CustomProjectViewEdit extends ProjectViewEdit{
	function ProjectViewEdit(){
		parent::ViewEdit();
		$this->useForSubpanel = true;
 	}	
    public function display(){
    	global $current_user;
    	if(empty($this->bean->id)){
          $this->bean->programme_year_c = $current_user->programme_year_c;
        }
        $role = ACLRole::getUserRoleNames($current_user->id);
        if (count($role)>0 && isset($role[0])) {
            $role = $role[0];
        }

        $disableDOTPApp = 'yes';
        if ($role == 'DOTP') {
            $disableDOTPApp = 'no';
        }

        $alreadyBookedBv = '';
        $alreadyBookedNdc = '';
        $alreadyBookedCpcNew = '';
        $alreadyBookedCpcOld = '';

        if ($this->bean->room_no_bv_c) {
			$alreadyBookedBv = str_replace("^","",$this->bean->room_no_bv_c);        	
        }

        if ($this->bean->room_no_ndc_c) {
			$alreadyBookedNdc = str_replace("^","",$this->bean->room_no_ndc_c);        	
        }

        if ($this->bean->room_no_cpc_new_c) {
			$alreadyBookedCpcNew = str_replace("^","",$this->bean->room_no_cpc_new_c);        	
        }

        if ($this->bean->room_no_cpc_old_c) {
			$alreadyBookedCpcOld = str_replace("^","",$this->bean->room_no_cpc_old_c);        	
        }        

    	echo '<div id = "dialog" title= "Warning!!!" style="display:none"><p>Sorry selected conference room is not available!</p></div>';
    	echo '<div id = "dialogDate" title= "Warning!!!" style="display:none"><p>Invalid date!</p></div>';

    	echo <<<EOD
    	<style>
    	#myModal table tr td{padding: 7px!important;}
    	.occupancy_div{ float:left; margin-right: 27px; }
    	#bv_accommodation td{ text-align:center; }
    	#bv_accommodation tr td:first-child{ text-align:left; padding-left:5px; font-weight:bold }
    	.blocked{    background: #eaeaea;color: #ccc!important;}
    	.available{	background: #49ba8e;color: #fff!important;	}
    	.occupied{	background: rgba(255, 12, 0, 0.65);color: #fff!important;	}
    	#cpc_old_Accommodation tr td{color: #000;}
    	#cpc_new_Accommodation tr td{color: #000; text-align: center; vertical-align: middle;}
    	</style>			

			<div id="myModal" class="modal fade">
				
					<div class="modal-dialog modal-lg">
						<!-- Modal content--> 
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" type="button" data-dismiss="modal">&times;</button> 
								<h4 class="modal-title">Check Availability</h4>
							</div>
							<div class="modal-body" style="height: 230px;">
							  <p>Default availability is shown based on current date as start date.</p>
							  <br>
							  <div class="occupancy_div">	
								<table class="table-bordered" cellpadding="4" cellspacing="7">
									<tbody>
										<tr>
											<td><strong>Conference rooms in CPC</strong></td>
											<td align="text-center">Capacity</td>
										</tr>
										<tr>
											<td>CPC-Auditorium (Seating only)</td>
											<td align="text-center"> <span id="cpc-audi">200</span></td>
										</tr>
										<tr>
											<td>CPC- EDP room</td>
											<td align="text-center"> <span id="cpc-edp">55</span></td>
										</tr>
										<tr>
											<td>CPC- CR I</td>
											<td align="text-center"> <span id="cpc-cr1">20</span></td>
										</tr>
										<tr>
											<td>CPC- CR II</td>
											<td align="text-center"> <span id="cpc-cr2">20</span></td>
										</tr>
										<tr>
											<td>CPC- CR III</td>
											<td align="text-center"> <span id="cpc-cr3">25</span></td>
										</tr>
										<tr>
											<td>CPC- CR IV</td>
											<td align="text-center"> <span id="cpc-cr4">30</span></td>
										</tr>
									</tbody>
								</table>
							  </div>
							  <div class="occupancy_div">
								<table class="table-bordered" cellpadding="4" cellspacing="7">
									<tbody>
										<tr>
											<td><strong>Conference rooms in BV</strong></td>
											<td align="text-center">Capacity</td>
										</tr>
										<tr>
											<td>BV CR 1 capacity</td>
											<td align="text-center"> <span id="bv1">50</span></td>
										</tr>
										<tr>
											<td>BV CR 2 capacity</td>
											<td align="text-center"> <span id="bv2">25</span></td>
										</tr>
										<tr>
											<td>BV CR 3 capacity </td>
											<td align="text-center"> <span id="bv3">20</span></td>
										</tr>
										<tr>
											<td>BV CR 4 capacity</td>
											<td align="text-center"> <span id="bv4">25</span></td>
										</tr>
										<tr>
											<td>BV CR 5 capacity</td>
											<td align="text-center"> <span id="bv5">30</span></td>
										</tr>
									</tbody>
								</table>
							  </div>
							  <div style="">
								<table class="table-bordered" cellpadding="4" cellspacing="7">
									<tbody>
										<tr>
											<td><strong>Conference Room in New Delhi Centre</strong></td>
											<td align="text-center">Capacity</td>
										</tr>
										<tr>
											<td>NDC-CR1</td>
											<td align="text-center"> <span id="bv1">50</span></td>
										</tr>
									</tbody>
								</table>
							  </div>
							</div>
							<p>* NA = Not Available</p>

							<div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div>
						</div>
					</div>
			</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg" style="width:1082px">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Occupancy chart</h4>
        </div>
        <div class="modal-body">
<div class="text-center"><h2>BV</h2></div>
<table class="table-bordered" cellpadding="10" cellspacing="0" style="width: 100%;" id="bv_accommodation"><colgroup span="25" width="85" ></colgroup>
<tbody>

<tr>
<td height="32" align="left" width="200px">Ground Floor</td>
<td class="available" id="bv1">1</td>
<td class="blocked" id="bv2">2</td>
<td class="available" id="bv3">3</td>
<td class="available" id="bv4">4</td>
<td class="available" id="bv5">5</td>
<td class="available" id="bv6">6</td>
<td class="available" id="bv7">7</td>
<td class="available" id="bv8">8</td>
<td class="available" id="bv9">9</td>
<td class="available" id="bv10">10</td>
<td class="available" id="bv11">11</td>
<td class="available" id="bv12">12</td>
<td class="available" id="bv12A">12A</td>
<td class="available" id="bv14">14</td>
<td class="available" id="bv15">15</td>
<td class="available" id="bv16">16</td>
<td class="available" id="bv17">17</td>
<td class="available" id="bv18">18</td>
<td class="available" id="bv19">19</td>
<td class="available" id="bv20">20</td>
<td class="available" id="bv21">21</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td height="17" align="left">First Floor</td>
<td class="available" id="bv101">101</td>
<td class="available" id="bv102">102</td>
<td class="available" id="bv103">103</td>
<td class="available" id="bv104">104</td>
<td class="available" id="bv105">105</td>
<td class="available" id="bv106">106</td>
<td class="available" id="bv107">107</td>
<td class="available" id="bv108">108</td>
<td class="available" id="bv109">109</td>
<td class="available" id="bv110">110</td>
<td class="available" id="bv111">111</td>
<td class="available" id="bv112">112</td>
<td class="available" id="bv113">113</td>
<td class="available" id="bv114">114</td>
<td class="available" id="bv115">115</td>
<td class="available" id="bv116">116</td>
<td class="available" id="bv117">117</td>
<td class="available" id="bv118">118</td>
<td class="available" id="bv119">119</td>
<td class="available" id="bv120">120</td>
<td class="available" id="bv121">121</td>
<td class="available" id="bv122">122</td>
<td class="available" id="bv123">123</td>
<td class="available" id="bv124">124</td>
</tr>
<tr>
<td height="17" align="left">Second Floor</td>
<td class="available" id="bv201">201</td>
<td class="available" id="bv202">202</td>
<td class="available" id="bv203">203</td>
<td class="available" id="bv204">204</td>
<td class="available" id="bv205">205</td>
<td class="available" id="bv206">206</td>
<td class="available" id="bv207">207</td>
<td class="available" id="bv208">208</td>
<td class="available" id="bv209">209</td>
<td class="available" id="bv210">210</td>
<td class="available" id="bv211">211</td>
<td class="available" id="bv212">212</td>
<td class="available" id="bv213">213</td>
<td class="available" id="bv214">214</td>
<td class="available" id="bv215">215</td>
<td class="available" id="bv216">216</td>
<td class="available" id="bv217">217</td>
<td class="available" id="bv218">218</td>
<td class="available" id="bv219">219</td>
<td class="available" id="bv220">220</td>
<td class="available" id="bv221">221</td>
<td class="available" id="bv222">222</td>
<td class="available" id="bv223">223</td>
<td class="available" id="bv224">224</td>
</tr>
<tr>
<td height="17" align="left">Third Floor</td>
<td class="available" id="bv301">301</td>
<td class="available" id="bv302">302</td>
<td class="available" id="bv303">303</td>
<td class="available" id="bv304">304</td>
<td class="available" id="bv305">305</td>
<td class="available" id="bv306">306</td>
<td class="available" id="bv307">307</td>
<td class="available" id="bv308">308</td>
<td class="available" id="bv309">309</td>
<td class="available" id="bv310">310</td>
<td class="available" id="bv311">311</td>
<td class="available" id="bv312">312</td>
<td class="available" id="bv313">313</td>
<td class="available" id="bv314">314</td>
<td class="available" id="bv315">315</td>
<td class="available" id="bv316">316</td>
<td class="available" id="bv317">317</td>
<td class="available" id="bv318">318</td>
<td class="available" id="bv319">319</td>
<td class="available" id="bv320">320</td>
<td class="available" id="bv321">321</td>
<td class="available" id="bv322">322</td>
<td class="available" id="bv323">323</td>
<td class="available" id="bv324">324</td>
</tr>
</tbody>
</table>
<br />
<div class="text-center"><h2>CPC Old</h2></div>
<table class="table-bordered" border="0" cellspacing="0" id="cpc_old_Accommodation">
	<colgroup span="4" width="80"></colgroup>
	<colgroup width="76"></colgroup>
	<colgroup width="211"></colgroup>
	<colgroup width="150"></colgroup>
	<colgroup width="182"></colgroup>
	<colgroup span="4" width="80"></colgroup>
	<colgroup width="150"></colgroup>
	<colgroup span="3" width="80"></colgroup>
	<tbody>
		<tr>
			<td rowspan="5" align="center" valign="middle" bgcolor="#B3A2C7" height="126">Ground Flor</td>
			<td colspan="4" align="center" valign="bottom" bgcolor="#E6B9B8">Office Rooms</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">Store</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
		</tr>
		<tr>
			<td align="center" valign="bottom" class="blocked" id="cpc_old4">4</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old5">5</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old6">6</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old7">7</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old8">8</td>
			<td align="center" valign="middle" class="available" id="cpc_old9">9</td>
			<td align="center" valign="middle" class="available" id="cpc_old10">10</td>
			<td align="center" valign="middle" class="available" id="cpc_old11">11</td>
			<td align="center" valign="middle" class="available" id="cpc_old12">12</td>
			<td align="center" valign="middle" class="available" id="cpc_old13">13</td>
			<td align="center" valign="middle" class="available" id="cpc_old14">14</td>
			<td align="center" valign="middle" class="available" id="cpc_old15">15</td>
			<td align="center" valign="middle" class="available" id="cpc_old16">16</td>
			<td align="center" valign="middle" class="available" id="cpc_old17">17</td>
			<td align="center" valign="middle" class="available" id="cpc_old18">18</td>
		</tr>
		<tr>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Server Room</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">Suite-1(Reserved for Guest faculty</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">Suite-2(Reserved for Registrar)</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" valign="bottom" class="available" id="cpc_old19">19</td>
			<td align="center" valign="bottom" class="available" id="cpc_old20">20</td>
			<td align="center" valign="bottom" class="available" id="cpc_old21">21</td>
			<td align="center" valign="bottom" class="available" id="cpc_old22">22</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old23">23</td>
			<td align="center" valign="bottom" class="available" id="cpc_old24">24</td>
			<td align="center" valign="bottom" class="available" id="cpc_old25">25</td>
			<td align="center" valign="bottom" class="available" id="cpc_old26">26</td>
			<td align="center" valign="bottom" class="available" id="cpc_old27">27</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
		</tr>		
		<tr>
			<td rowspan="5" align="center" valign="middle" bgcolor="#B3A2C7" height="99">First Floor</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">&nbsp;</td>
			<td colspan="5" align="center" valign="middle" bgcolor="#E6B9B8">Office Rooms</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
		</tr>
		<tr>
			<td align="center" valign="middle" class="blocked" id="cpc_oldCR2">CR2</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old106">106</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old107">107</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old108">108</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old109">109</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old110">110</td>
			<td align="center" valign="middle" class="available" id="cpc_old111">111</td>
			<td align="center" valign="middle" class="available" id="cpc_old112">112</td>
			<td align="center" valign="middle" class="available" id="cpc_old113">113</td>
			<td align="center" valign="middle" class="available" id="cpc_old114">114</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old115">115</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old116">116</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old117">117</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old118">118</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old119">119</td>
		</tr>
		<tr>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
			<td align="center" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Girls</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Girls</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Girls</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">F/Store</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">C-Lab</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Suite-3</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Girls </td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Girls </td>
			<td align="center" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" valign="middle" class="available" id="cpc_old120">120</td>
			<td align="center" valign="middle" class="available" id="cpc_old121">121</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old122">122</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old123">123</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old124">124</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old125">125</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old126">126</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old127">127</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old128">128</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old129">129</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old130">130</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old131">131</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old132">132</td>
			<td align="center" valign="middle" class="blocked" id="cpc_old133">133</td>
			<td align="center" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="bottom" height="20">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
			<td align="left" valign="bottom">&nbsp;</td>
		</tr>

		<tr>
			<td rowspan="5" align="center" valign="middle" bgcolor="#B3A2C7" height="100">Second floor</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">&nbsp;</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">Faculty</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">&nbsp;</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">Meeting</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">PGDHM's</td>
			<td align="center" valign="bottom" bgcolor="#E6B9B8">Admin's</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
		</tr>
		<tr>
			<td align="center" valign="bottom" class="blocked" id="cpc_oldCR3">CR3</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old206">206</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old207">207</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old208">208</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old209">209</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old210">210</td>
			<td align="center" valign="bottom" class="available" id="cpc_old211">211</td>
			<td align="center" valign="bottom" class="available" id="cpc_old212">212</td>
			<td align="center" valign="bottom" class="available" id="cpc_old213">213</td>
			<td align="center" valign="bottom" class="available" id="cpc_old214">214</td>
			<td align="center" valign="bottom" class="available" id="cpc_old215">215</td>
			<td align="center" valign="bottom" class="available" id="cpc_old216">216</td>
			<td align="center" valign="bottom" class="available" id="cpc_old217">217</td>
			<td align="center" valign="bottom" class="available" id="cpc_old218">218</td>
			<td align="center" valign="bottom" class="available" id="cpc_old219">219</td>
		</tr>
		<tr>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
			<td align="center" valign="bottom">&nbsp;</td>
		</tr>
		<tr>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#D7E4BD">DBR</td>
			<td align="center" valign="middle" bgcolor="#B9CDE5">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Boys</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Buildings</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Library</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">Recreation Room</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">SBR</td>
			<td align="center" valign="middle" bgcolor="#E6B9B8">GYM</td>
		</tr>
		<tr>
			<td align="center" valign="bottom" class="available" id="cpc_old220">220</td>
			<td align="center" valign="bottom" class="available" id="cpc_old221">221</td>
			<td align="center" valign="bottom" class="available" id="cpc_old222">222</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old223">223</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old224">224</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old225">225</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old226">226</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old227">227</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old228">228</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old229">229</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old230">230</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old231">231</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old232">232</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old233">233</td>
			<td align="center" valign="bottom" class="blocked" id="cpc_old234">234</td>
		</tr>
	</tbody>
</table>
<br>
<div class="text-center"><h2>CPC New</h2></div>
<table class="table-bordered" border="0" cellspacing="0" id="cpc_new_Accommodation">
	<colgroup width="117"></colgroup>
	<colgroup span="17" width="80"></colgroup>
	<tbody>
		<tr>
			<td align="left" valign="bottom" bgcolor="#B3A2C7" height="26">First Floor</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new101" class="available">101</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new102" class="available">102</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new103" class="available">103</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new104" class="available">104</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new105" class="available">105</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new106" class="available">106</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new107" class="available">107</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new108" class="available">108</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new109" class="available">109</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new110" class="available">110</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new111" class="available">111</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new112" class="available">112</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new113" class="available">113</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new114" class="available">114</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new115" class="available">115</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new116" class="available">116</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new117" class="available">117</span></td>
		</tr>
		<tr>
			<td align="left" valign="bottom" height="20">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
		</tr>
		<tr>
			<td align="left" valign="bottom" bgcolor="#B3A2C7" height="24">Second Floor</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new201" class="available">201</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new202" class="available">202</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new203" class="available">203</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new204" class="available">204</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new205" class="available">205</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new206" class="available">206</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new207" class="available">207</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new208" class="available">208</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new209" class="available">209</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new210" class="available">210</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new211" class="available">211</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new212" class="available">212</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new213" class="available">213</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new214" class="available">214</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new215" class="available">215</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new216" class="available">216</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new217" class="available">217</span></td>
		</tr>
		<tr>
			<td align="left" valign="bottom" height="20">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
			<td align="left" valign="bottom">&nbsp;</span></td>
		</tr>
		<tr>
			<td align="left" valign="bottom" bgcolor="#B3A2C7" height="20">Third Floor</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new301" class="available">301</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new302" class="available">302</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new303" class="available">303</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new304" class="available">304</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new305" class="available">305</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new306" class="available">306</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new307" class="available">307</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new308" class="available">308</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new309" class="available">309</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new310" class="available">310</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new311" class="available">311</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new312" class="available">312</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new313" class="available">313</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new314" class="available">314</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new315" class="available">315</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new316" class="available">316</span></td>
			<td align="right" valign="bottom" bgcolor="#B9CDE5" id="cpc_new317" class="available">317</span></td>
		</tr>
	</tbody>
</table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
			<script>
				$(document).ready(function(){

					$('#programme_id_c').attr("disabled",true);
					$('#room_no_bv_c option[value="2"]').attr("disabled",true);

					$('#status').change(function(){
						console.log($('#status').val());
						if($(this).val() == 'Proposal Stage'){
							removeFromValidate('EditView','start_date_c');
							removeFromValidate('EditView','end_date_c');

							$('#start_date_c_label').html('Start Date:');
							$('#end_date_c_label').html('End Date:');							
						}else{
							addToValidate('EditView','start_date_c','varchar',true,'Start Date');
							addToValidate('EditView','end_date_c','varchar',true,'End Date');
							
							$('#start_date_c_label').html('Start Date:<span class="required">*</span>');
							$('#end_date_c_label').html('End Date:<span class="required">*</span>');
						}
					});

					if('{$role}' !='PO(M1,M2,M3)' && '{$role}' !='PO'){
						$('#start_date_c').attr('disabled',true);
						$('#end_date_c').attr('disabled',true);

						$('#start_date_c_trigger').hide();
						$('#end_date_c_trigger').hide();

						$('#LBL_EDITVIEW_PANEL2 input').attr('disabled',true);
						$('#LBL_EDITVIEW_PANEL2 select').attr('disabled',true);
					}

					$('#selected_rooms_c').hide();
					Calendar.setup({
						minDate: new Date()
					});
					var d = new Date();
					var day = d.getDate();
					var selected_bv = '';
					var selected_cpc_new = '';
					var selected_cpc_old = '';
					var selected_ndc = '';
					$('#room_no_bv_c').change(function(){
						
						var selected = $(this).val();

						validationSoftBlock(selected, bv_booked, 'room_no_bv_c','bv','{$alreadyBookedBv}');	

					});

					$('#room_no_cpc_new_c').change(function(){
						
						var selected = $(this).val();
						validationSoftBlock(selected, cpc_new_booked, 'room_no_cpc_new_c','cpc_new','{$alreadyBookedCpcNew}');							
					});

					$('#room_no_cpc_old_c').change(function(){
						
						var selected = $(this).val();
						validationSoftBlock(selected, cpc_old_booked, 'room_no_cpc_old_c','cpc_old','{$alreadyBookedCpcOld}');							
					});

					$('#room_no_ndc_c').change(function(){
						
						var selected = $(this).val();
						validationSoftBlock(selected, ndc_booked, 'room_no_ndc_c','ndc','{$alreadyBookedCpcNdc}');							
					});										

					// var alreadyBookedBv = '{$this->bean->room_no_bv_c}';
					function validationSoftBlock(selected,booked, id,tableSelector,alreadyBooked){
						console.log('selected '+selected);
						if(alreadyBooked){
							alreadyBooked = alreadyBooked.split(',');
						}else{
							alreadyBooked = [];
						}
						
						if(tableSelector == 'bv'){
							selected_bv = '';
						}
						
						if(tableSelector == 'cpc_new'){
							selected_cpc_new = '';
						}
						
						if(tableSelector == 'cpc_old'){
							selected_cpc_old = '';
							var disabled = [4,5,6,7,8,23,'CR2',106,107,108,109,110,115,116,117,118,119,122,123,124,125,126,127,128,129,130,131,132,133,'CR3',206,207,208,209,210,223,224,225,226,227,228,229,230,231,232,233,234];
							
							$.each(disabled, function(i, item) {
							        
							        booked.push(item);
							});							
						}

						if(tableSelector == 'ndc'){
							selected_ndc = '';
						}
						
						var shown = false;
						for(var i=0; i<selected.length;i++){
							if(($.inArray(parseInt(selected[i]),booked) !== -1 || $.inArray(selected[i],booked) !== -1) && $.inArray(parseInt(selected[i]),alreadyBooked) === -1 && $.inArray(selected[i],alreadyBooked) === -1){
								$('#'+tableSelector+parseInt(selected[i])).addClass('blocked');
								$('#'+id+' option[value='+parseInt(selected[i])+']').prop('selected',false);
								// console.log(booked);
								bookedStr = booked.join(',');
								bookedStr = bookedStr.replace(/NaN,/g,'');
								if(!shown){
									alert('Alreay booked '+bookedStr);
									shown = true;
								}
								
							}else{
								
								if(tableSelector == 'bv'){
									selected_bv = selected_bv+', '+selected[i];
								}
								
								if(tableSelector == 'cpc_new'){
									selected_cpc_new = selected_cpc_new+', '+selected[i];
								}
								
								if(tableSelector == 'cpc_old'){
									selected_cpc_old = selected_cpc_old+', '+selected[i];
								}

								if(tableSelector == 'ndc'){
									selected_ndc = selected_ndc+', '+selected[i];
								}								
							}
						}
						
						$('#selected_rooms_c_label').html('Selected Rooms: <br><strong>BV:</strong> '+selected_bv.replace(/^,/, '')+'<br><br><strong>CPC New:</strong> '+selected_cpc_new.replace(/^,/, '')+'<br><br><strong>CPC Old:</strong> '+selected_cpc_old.replace(/^,/, '')+'<br><br><strong>NDC: </strong>'+selected_ndc.replace(/^,/, ''));					
					}
					showSelected('{$alreadyBookedBv}','bv');
					showSelected('{$alreadyBookedCpcNew}','cpc_new');
					showSelected('{$alreadyBookedCpcOld}','cpc_old');

					function showSelected(selected,tableSelector){
						if(selected){
							selected = selected.split(',');
							if(tableSelector == 'bv'){
								selected_bv = '';
							}
							
							if(tableSelector == 'cpc_new'){
								selected_cpc_new = '';
							}
							
							if(tableSelector == 'cpc_old'){
								selected_cpc_old = '';
							}

							if(tableSelector == 'ndc'){
								selected_ndc = '';
							}

							for(var i=0; i<selected.length;i++){
								
								if(tableSelector == 'bv'){
									selected_bv = selected_bv+', '+selected[i];
								}
								
								if(tableSelector == 'cpc_new'){
									selected_cpc_new = selected_cpc_new+', '+selected[i];
								}
								
								if(tableSelector == 'cpc_old'){
									selected_cpc_old = selected_cpc_old+', '+selected[i];
								}						
							}
							
							$('#selected_rooms_c_label').html('Selected Rooms: <br><strong>BV:</strong> '+selected_bv.replace(/^,/, '')+'<br><br><strong>CPC New:</strong> '+selected_cpc_new.replace(/^,/, '')+'<br><br><strong>CPC Old:</strong> '+selected_cpc_old.replace(/^,/, ''));																		
						}

					}

					function coloringAccommodations(booked, id){
						
						if (id == 'bv') {
							colorAccommodations(booked, 'bv_accommodation', id);
						}

						if (id == 'cpc_old') {
							colorAccommodations(booked, 'cpc_old_Accommodation', id);
						}

						if (id == 'cpc_new') {
							colorAccommodations(booked, 'cpc_new_Accommodation', id);
						}											
					}

					function colorAccommodations(booked, id1, id2){
					
						for(var i=0; i<booked.length;i++){
							
							$('#'+id1+' #'+id2+parseInt(booked[i])).removeClass('available');
							$('#'+id1+' #'+id2+parseInt(booked[i])).addClass('blocked');
								
						}
					
					}

					function coloringAccommodationsOccupied(booked, id){
						if(id == 'bv'){
							colorOccupancy(booked, 'bv_accommodation', id);												
						}

						if(id == 'cpc_old'){
							colorOccupancy(booked, 'cpc_old_Accommodation', id);												
						}

						if(id == 'cpc_new'){
							colorOccupancy(booked, 'cpc_new_Accommodation', id);												
						}


					}

					function colorOccupancy(booked, id1, id2) {
						for(var i=0; i<booked.length;i++){
								
							$('#'+id1+' #'+id2+parseInt(booked[i])).removeClass('available');
							$('#'+id1+' #'+id2+parseInt(booked[i])).removeClass('blocked');
							$('#'+id1+' #'+id2+parseInt(booked[i])).addClass('occupied');
								
						}
					}

					if('$disableDOTPApp' == "yes"){
						$('#dotp_approval_c').attr('disabled',true);
					}
					$('#occupancy_chart_c').hide();
					$('#occupancy_chart_2_c').hide();
					$('#occupancy_chart_c_label').html('<br><a class="button primary" href="javascript:;" id="occupancy_chart"  data-toggle="modal" data-target="#myModal">Check Availability</a>');
					$('#occupancy_chart_2_c_label').html('<br><a class="button primary" href="javascript:;" id="occupancy_chart"  data-toggle="modal" data-target="#myModal2">Occupancy Chart</a>');
					$('#myModal').on('shown.bs.modal', function() {
						checkAvailability();
					});

					$('#myModal2').on('shown.bs.modal', function() {
						checkOccupancy();
					});

					//get the status of booking of rooms
					var bv_booked;
					var cpc_new_booked;
					var cpc_old_booked;
					var ndc_booked;
					function updateOccupancyChart(){
    					// SUGAR.ajaxUI.showLoadingPanel();
    					// hideLoader();
    					setTimeout(function(){
							var start = $('#start_date_c').val();
							var end = $('#end_date_c').val();

							$.ajax({
							  method: "POST",
							  url: "index.php?entryPoint=ajaxCall",
							  data: {start: start, end: end, type:"getAccommodationsRoomsInProgramme"}
							}).success(function(rsp){
								rsp = JSON.parse(rsp);
								
								if(rsp.Success == true){
									// $.each( rsp.data, function( key, value ) {
									//   	$('#'+key).text(value);
									// });
									if(typeof(rsp.data.bv.blocked) != "undefined" && rsp.data.bv.blocked !=null){
										bv_booked = rsp.data.bv.blocked.replace(/\^/g, '').split(',');
										// console.log(bv_booked);
										bv_booked = bv_booked.map(function (x) { 
												    	return parseInt(x); 
													});		
										coloringAccommodations(bv_booked, 'bv');								
									}

									if(typeof(rsp.data.cpc_new.blocked) != "undefined" && rsp.data.cpc_new.blocked !=null){
										cpc_new_booked = rsp.data.cpc_new.blocked.replace(/\^/g, '').split(',');
										cpc_new_booked = cpc_new_booked.map(function (x) { 
												    	return parseInt(x); 
													});										

										coloringAccommodations(cpc_new_booked, 'cpc_new');

									}

									if(typeof(rsp.data.cpc_old.blocked) != "undefined" && rsp.data.cpc_old.blocked !=null){
										cpc_old_booked = rsp.data.cpc_old.blocked.replace(/\^/g, '').split(',');
										cpc_old_booked = cpc_old_booked.map(function (x) { 
												    	return parseInt(x); 
													});
										coloringAccommodations(cpc_old_booked, 'cpc_old');
									}

									if(typeof(rsp.data.ndc.blocked) != "undefined" && rsp.data.ndc.blocked !=null){
										ndc_booked = rsp.data.ndc.blocked.replace(/\^/g, '').split(',');
										ndc_booked = ndc_booked.map(function (x) { 
												    	return parseInt(x); 
													});									
									}

								}
							});		    					
						}, 1000);
	    			}
	    			updateOccupancyChart();
	    			checkOccupancy();
	    			var cpc_new_occupied;
	    			var cpc_old_occupied;
	    			var ndc_occupied;
	    			var bv_occupied;
	    			function checkOccupancy(){
		    			if('{$this->bean->id}' != ''){
			    				var start = $('#start_date_c').val();
								var end = $('#end_date_c').val();
								$.ajax({
								  method: "POST",
								  url: "index.php?entryPoint=ajaxCall",
								  data: {start: start, end: end, pid: '{$this->bean->id}', type:"getAccommodationsRoomsByProgramme"}
								}).success(function(rsp){
									rsp = JSON.parse(rsp);
									
									if(rsp.Success == true){
										// $.each( rsp.data, function( key, value ) {
										//   	$('#'+key).text(value);
										// });
										if(typeof(rsp.data.bv) != "undefined" && typeof(rsp.data.bv.booked) != "undefined" && rsp.data.bv.booked !=null){
											bv_occupied = rsp.data.bv.booked.replace(/\^/g, '').split(',');
											// console.log(bv_occupied);
											bv_occupied = bv_occupied.map(function (x) { 
													    	return parseInt(x); 
														});		
											coloringAccommodationsOccupied(bv_occupied, 'bv');								
										}

										if(typeof(rsp.data.cpc_new) != "undefined" && typeof(rsp.data.cpc_new.booked) != "undefined" && rsp.data.cpc_new.booked !=null){
											cpc_new_occupied = rsp.data.cpc_new.booked.replace(/\^/g, '').split(',');
											cpc_new_occupied = cpc_new_occupied.map(function (x) { 
													    	return parseInt(x); 
														});		

											coloringAccommodationsOccupied(cpc_new_occupied, 'cpc_new');

										}
										console.log(rsp.data);
										console.log(typeof(rsp.data.cpc_old) != "undefined" && typeof(rsp.data.cpc_old.booked) != "undefined" && rsp.data.cpc_old.booked !=null);
										if(typeof(rsp.data.cpc_old) != "undefined" && typeof(rsp.data.cpc_old.booked) != "undefined" && rsp.data.cpc_old.booked !=null){
											cpc_old_occupied = rsp.data.cpc_old.booked.replace(/\^/g, '').split(',');
											cpc_old_occupied = cpc_old_occupied.map(function (x) { 
													    	return parseInt(x); 
														});
											console.log('cpc_old_occupied')
											console.log(cpc_old_occupied)
											coloringAccommodationsOccupied(cpc_old_occupied, 'cpc_old');
										}

										if(typeof(rsp.data.cpc_old) != "undefined" && typeof(rsp.data.ndc.booked) != "undefined" && rsp.data.ndc.booked !=null){
											ndc_occupied = rsp.data.ndc.booked.replace(/\^/g, '').split(',');
											ndc_occupied = ndc_occupied.map(function (x) { 
													    	return parseInt(x); 
														});									
										}

									}	
								});    				
		    			}
	    			}
					$('#cr_no_c').change(function(){
						checkAvailability();
					});
					proposalworkorder();
					$('#programme_type_c').on('click',function(){
						proposalworkorder();
					});
					function proposalworkorder(){
						if($('#programme_type_c').val() == 'ICTP-On Campus' || $('#programme_type_c').val() == 'ICTP-Off Campus' || $('#programme_type_c').val() == 'Workshop/Seminar/Sponsored'){
							$('#project_opportunities_1_name_label').parent().show();
						}else{
							$('#project_opportunities_1_name_label').parent().hide();
						}
						if($('#programme_type_c').val() == 'ICTP-Off Campus'){
							$('#programme_fee_c').after('<b class="perunit">&nbsp;per day</b>');
							$('#usd_c').after('<b class="perunit">&nbsp;per day</b>');
							$('#euro_c').after('<b class="perunit">&nbsp;per day</b>');
							$('#programme_fee_non_res_c').after('<b class="perunit">&nbsp;per day</b>');
							$('#usd_non_res_c').after('<b class="perunit">&nbsp;per day</b>');
							$('#euro_non_res_c').after('<b class="perunit">&nbsp;per day</b>');
						}else{
							$('.perunit').hide();
						}
					}

					function checkAvailability(){
						$.ajax({
						  method: "POST",
						  url: "index.php?entryPoint=ajaxCall",
						  data: {start_date:$('#start_date_c').val(),end_date:$('#end_date_c').val(), type:"getCRAccommodations",cr_no:$('#cr_no_c').val()}
						}).success(function(rsp){
							rsp = JSON.parse(rsp);
							// console.log(rsp);
							
							if(rsp.Success == true){
								$.each( rsp.data, function( key, value ) {
								  	$('#'+key).text(value);
								});
								
								if(!rsp.data.book){
									$('#check_in_c_date').val('');
									$('#dialog').dialog();
								}
							}
						});						
					}

					//start date and end date validation
					$('#start_date_c_trigger, #end_date_c_trigger, #estimated_start_date_trigger, #estimated_end_date_trigger, #estimated_start_date1_c_trigger, #estimated_end_date1_c_trigger').attr('tabindex',2);

    				function hideLoader(){
						setTimeout(function(){
							
							SUGAR.ajaxUI.hideLoadingPanel();								
						}, 5000);
    				}

					$(document).on('blur','#start_date_c_trigger, #end_date_c_trigger, #start_date_c, #end_date_c', function(){
						updateOccupancyChart();
						setTimeout(function(){	
							if($('#start_date_c').val()){
								$('#estimated_start_date_label').hide();
								$('#estimated_start_date_label').next('td').hide();

								$('#estimated_end_date_label').hide();
								$('#estimated_end_date_label').next('td').hide();

								$('#estimated_start_date1_c_label').hide();
								$('#estimated_start_date1_c_label').next('td').hide();

								$('#estimated_end_date1_c_label').hide();
								$('#estimated_end_date1_c_label').next('td').hide();

								$('#estimated_start_date2_c_label').hide();
								$('#estimated_start_date2_c_label').next('td').hide();

								$('#estimated_end_date2_c_label').hide();
								$('#estimated_end_date2_c_label').next('td').hide();							
							}							
							d = new Date();
							var dd = d.getDate();
							var mm = d.getMonth()+1; //January is 0!

							var yyyy = d.getFullYear();
							if(dd<10){
							    dd='0'+dd;
							} 
							if(mm<10){
							    mm='0'+mm;
							} 
							var cDate = dd+'-'+mm+'-'+yyyy;							
							// var v1 = check_dates($('#start_date_c').val(),$('#end_date_c').val());
							// var v2 = check_dates(cDate,$('#start_date_c').val());
							// var v3 = check_dates(cDate,$('#end_date_c').val());

							// if(!v1){
							// 	$('#end_date_c').val('');
							// }

							// if(!v2){
							// 	$('#start_date_c').val('');
							// }

							// if(!v3){
							// 	$('#end_date_c').val('');
							// }

							if($('#start_date_c').val() && !$('#inauguration_date_time_c_date').val()){
								$('#inauguration_date_time_c_date').val($('#start_date_c').val());
							}
						}, 1000);

					});

					function receivingDateValidation(month){
						
						var mKey = months.indexOf(month.substring(0, month.length - 5));
						
						var start_date = $('#start_date_c').val();
						console.log((parseInt(mKey) +1 ) +', '+ parseInt(start_date.substring(3,6)));

						if((parseInt(mKey) +1 ) > parseInt(start_date.substring(3,6))){
							
							$('#container_date_receiving_nominee_c_trigger .calcell').removeClass('selectable');
							$('#container_ebd_date_c_trigger .calcell').removeClass('selectable');	

							console.log($('#container_ebd_date_c_trigger .calcell').removeClass('selectable'));
						}else if((parseInt(mKey) +1 ) == parseInt(start_date.substring(3,6))){
							for(var i = 31; i>parseInt(start_date.substring(0,2)); i--){
								
								$('#container_date_receiving_nominee_c_trigger table').find('.d'+i).removeClass('selectable');
							}

							for(var i = 1; i<parseInt(start_date.substring(0,2)); i++){
								
								$('#container_date_receiving_nominee_c_trigger table').find('.d'+i).removeClass('selectable');
								$('#container_date_receiving_nominee_c_trigger table').find('.d'+i).addClass('selectable');
							}

							for(var i = 31; i>parseInt(start_date.substring(0,2)); i--){
								
								$('#container_ebd_date_c_trigger table').find('.d'+i).removeClass('selectable');
							}

							for(var i = 1; i<parseInt(start_date.substring(0,2)); i++){
								
								$('#container_ebd_date_c_trigger table').find('.d'+i).removeClass('selectable');
								$('#container_date_receiving_nominee_c_trigger table').find('.d'+i).addClass('selectable');

							}							
						}else{
							$('#container_date_receiving_nominee_c_trigger .calcell').removeClass('selectable');
							$('#container_ebd_date_c_trigger .calcell').removeClass('selectable');

							$('#container_ebd_date_c_trigger .calcell').addClass('selectable');
							$('#container_ebd_date_c_trigger .calcell').addClass('selectable');	
						}						
					}

					var months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
					var m;


					$(document).on('blur','#estimated_start_date_trigger, #estimated_end_date_trigger', function(){
						setTimeout(function(){	
							d = new Date();
							var dd = d.getDate();
							var mm = d.getMonth()+1; //January is 0!

							var yyyy = d.getFullYear();
							if(dd<10){
							    dd='0'+dd;
							} 
							if(mm<10){
							    mm='0'+mm;
							} 
							var cDate = dd+'-'+mm+'-'+yyyy;							
							var v1 = check_dates($('#estimated_start_date').val(),$('#estimated_end_date').val());
							var v2 = check_dates(cDate,$('#estimated_start_date').val());
							var v3 = check_dates(cDate,$('#estimated_end_date').val());
	
							if(!v1){
								$('#estimated_end_date').val('');
							}

							if(!v2){
								$('#estimated_start_date').val('');
							}

							if(!v3){
								$('#estimated_end_date').val('');
							}
						}, 1000);

					});

					$(document).on('blur','#estimated_start_date1_c_trigger, #estimated_end_date1_c_trigger', function(){
						setTimeout(function(){	
							d = new Date();
							var dd = d.getDate();
							var mm = d.getMonth()+1; //January is 0!

							var yyyy = d.getFullYear();
							if(dd<10){
							    dd='0'+dd;
							} 
							if(mm<10){
							    mm='0'+mm;
							} 
							var cDate = dd+'-'+mm+'-'+yyyy;							
							var v1 = check_dates($('#estimated_start_date1_c').val(),$('#estimated_end_date1_c').val());
							var v2 = check_dates(cDate,$('#estimated_start_date1_c').val());
							var v3 = check_dates(cDate,$('#estimated_end_date1_c').val());

							if(!v1){
								$('#estimated_end_date1_c').val('');
							}

							if(!v2){
								$('#estimated_start_date1_c').val('');
							}

							if(!v3){
								$('#estimated_end_date1_c').val('');
							}
						}, 1000);

					});

					
					$('#date_receiving_nominee_c_trigger').attr('tabindex',2);
					$('#ebd_date_c_trigger').attr('tabindex',2);


					$(document).on('blur','#date_receiving_nominee_c_trigger', function(e){
						setTimeout(function(){	
							var start_date = $('#start_date_c').val();
													
							var v1 = check_dates($('#date_receiving_nominee_c').val(),start_date);

							if(!v1){
								$('#date_receiving_nominee_c').val('');
							}
						}, 1000);
					});					

					$(document).on('blur','#ebd_date_c_trigger', function(e){
						setTimeout(function(){	
							var start_date = $('#start_date_c').val();
													
							var v1 = check_dates($('#ebd_date_c').val(),start_date);

							if(!v1){
								$('#ebd_date_c').val('');
							}
						}, 1000);
					});										


					$('#inauguration_date_time_c_trigger').attr('tabindex',2);
					$(document).on('blur','#inauguration_date_time_c_trigger', function(){
						
						for(var i =1; i<day; i++){
							
							$('#container_inauguration_date_time_c_trigger table').find('.d'+i).removeClass('selectable');
						}		

					});										
					
					function getDate(sugardate) {
					    m = '';
					    d = '';
					    y = '';
					    var dateParts = sugardate.match(date_reg_format);
					    for (key in date_reg_positions) {
					        index = date_reg_positions[key];
					        if (key == 'm') {
					            m = dateParts[index];
					            m = (m * 1) - 1;
					        } else if (key == 'd') {
					            d = dateParts[index];
					        } else {
					            y = dateParts[index];
					        }
					    }
					    var dd = new Date(y, m, d);
					    return dd;
					}

					function check_dates(start,end) {
						console.log(start);
						console.log(end);
					    var jstart = start;
					    var jend = end;
					    // console.log(start+' '+end);
					    if (jstart != '' && jend != '') {
					        var start = getDate(jstart);
					        var end = getDate(jend);

					        if (start > end) {
					            // $('#end_date_c').val('');
					            $('#dialogDate').dialog();
					        
					            return false;
					        }
					    }
						
						return true;
					}

					function check_datesp(start,end) {
						setTimeout(function(){
						    var jstart = $('#estimated_start_date').val();
						    var jend = $('#estimated_end_date').val();
						    // console.log(start+' '+end);
						    if (jstart != '' && jend != '') {
						        var start = getDate(jstart);
						        var end = getDate(jend);

						        if (start > end) {
						            // $('#end_date_c').val('');
						            $('#dialogDate').dialog();
						        
						            return false;
						        }
						    }
						},300);
					}

					checkVenue();
					$('#venue_c').change(function(){
						checkVenue();
					});

					function checkVenue(){
						if($('#venue_c').val() == 'CR'){
							$('#hotel_c').parent('td').hide();
							$('#hotel_c_label').hide();

							$('#cr_no_c').parent('td').show();
							$('#cr_no_c_label').show();
						}else{
							$('#hotel_c').parent('td').show();
							$('#hotel_c_label').show();
							
							$('#cr_no_c').parent('td').hide();
							$('#cr_no_c_label').hide();

						}
					}

					$('#lump_sum_c').click(function(){
						checkLampSum();
						// $('#detailpanel_2').click();
					});

					$('#overseas_tour_c').change(function(){
						checkOverseas();
					});

					checkOverseas();
					function checkOverseas(){
						if($('#overseas_tour_c').val() == '' || $('#overseas_tour_c').val() == 'No'){
							$('#from_date_c').parent().parent('td').hide();
							$('#to_date_c').parent().parent('td').hide();
							$('#from_date_c_label').hide();
							$('#to_date_c_label').hide();							
							
							$('#overseas_name_c_label').hide();							
							$('#overseas_name_c').parent('td').hide();							
						}else{
							$('#from_date_c').parent().parent('td').show();
							$('#to_date_c').parent().parent('td').show();
							$('#from_date_c_label').show();
							$('#to_date_c_label').show();

							$('#overseas_name_c_label').show();							
							$('#overseas_name_c').parent('td').show();
						}
					}

					programmeTypeCheck();
					$('#programme_type_c').change(function(){
						programmeTypeCheck();
					});

					function announced(){
							$('#lump_sum_c').parent('td').hide();
							$('#lump_sum_c_label').hide();
							$('#detailpanel_4').hide();
							$('#detailpanel_3').show();
							$('#detailpanel_2').show();
							$('#detailpanel_3').show();							
					}

					function notAnnounced(){
							$('#lump_sum_c').parent('td').show();
							$('#lump_sum_c_label').show();
							$('#detailpanel_4').show();
							var checked = document.getElementById("lump_sum_c").checked;						
							if(!checked){
								$('#detailpanel_4').hide();

							}else{
								$('#detailpanel_4').show();
							}

							$('#detailpanel_3').hide();
							$('#detailpanel_2').show();
							
					}

					function programmeTypeCheck(){
						if(!($('#programme_type_c').val() == 'ICTP-Off Campus')){

							announced();
						}else{
							notAnnounced();
						}
					}

					checkLampSum();
					function checkLampSum(){
						var checked = document.getElementById("lump_sum_c").checked;						
						if(!checked){
							if(!($('#programme_type_c').val() == 'ICTP-Off Campus')){


								announced();
								$('#detailpanel_2').show();
								$('#detailpanel_3').show();
							}else{

								notAnnounced();
								$('#detailpanel_2').show();
								$('#detailpanel_3').hide();
							}

							$('#detailpanel_4').hide();
							
						}else{

							if(!($('#programme_type_c').val() == 'ICTP-Off Campus')){

								announced();
							}else{
								notAnnounced();
							}
							$('#detailpanel_4').show();

							$('#detailpanel_2').hide();
							$('#detailpanel_3').hide();
						}
					}  

					hideAll();
					//selectAccommodations();
					
					function hideAll(){
						// $('#room_no_cpc_new_c').parent('td').hide();
						// $('#room_no_cpc_new_c_label').hide();

						// $('#room_no_cpc_old_c').parent('td').hide();
						// $('#room_no_cpc_old_c_label').hide();

						// $('#room_no_bv_c').parent('td').hide();
						// $('#room_no_bv_c_label').hide();						
					}										

					$('#accommodation_c').attr('multiselect',true);
					$(document).change('#accommodation_c',function(){
						// selectAccommodations();
					});
					function selectAccommodations(){
						if($('#accommodation_c').val() == 'CPCNew'){
							showCPCNew();
							hideCPCOld();
							hideBV();
						}else if($('#accommodation_c').val() == 'CPCOld'){
							hideCPCNew();
							showCPCOld();
							hideBV();
						}else if($('#accommodation_c').val() == 'BV'){
							hideCPCNew();
							hideCPCOld();
							showBV();
							$('#room_no_bv_c option[value="2"]').attr("disabled",true);
						}else{
							hideAll();
						}
					}

					function showCPCNew(){
						$('#room_no_cpc_new_c').parent('td').show();
						$('#room_no_cpc_new_c_label').show();						
					}

					function hideCPCNew(){
						$('#room_no_cpc_new_c').parent('td').hide();
						$('#room_no_cpc_new_c_label').hide();						
					}					

					function showCPCOld(){
						$('#room_no_cpc_old_c').parent('td').show();
						$('#room_no_cpc_old_c_label').show();						
					}

					function hideCPCOld(){
						$('#room_no_cpc_old_c').parent('td').hide();
						$('#room_no_cpc_old_c_label').hide();						
					}				

					function showBV(){
						$('#room_no_bv_c').parent('td').show();
						$('#room_no_bv_c_label').show();
						$('#room_no_bv_c option[value="2"]').attr("disabled",true);						
					}

					function hideBV(){
						$('#room_no_bv_c').parent('td').hide();
						$('#room_no_bv_c_label').hide();						
					}															


				});
			</script>
EOD;
 		parent::display();
    }

}
