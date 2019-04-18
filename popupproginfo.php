<?php

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

	global $db;

	$pid=$_GET['pid1'];

	$progBean = BeanFactory::getBean('Project',$pid);
	 
	$start_date=$progBean->start_date_c; 
	$end_date=$progBean->end_date_c;
	$pcode = $progBean->programme_id_c;
	$fee = number_format($progBean->programme_fee_c, 2, '.', ''); 
	$fee_usd = number_format($progBean->usd_c, 2, '.', ''); 
	$overSeas = $progBean->overseas_tour_c;  

	if(!empty($start_date)){
		$start = date("d-m-Y", strtotime($start_date));
	}
	if(!empty($end_date)){
		$end = date("d-m-Y", strtotime($end_date));
	}
	$start1 = strtotime($start_date);
	$end1 = strtotime($end_date);
	
	$days = ceil(abs($end1 - $start1) / 86400)+1;
	
	$venue=$progBean->venue_c;

	function currencyConverter($currency_from,$currency_to,$currency_input){
		$yql_base_url = "http://query.yahooapis.com/v1/public/yql";
		$yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
		$yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
		$yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
		$yql_session = curl_init($yql_query_url);
		curl_setopt($yql_session, CURLOPT_RETURNTRANSFER,true);
		$yqlexec = curl_exec($yql_session);
		$yql_json =  json_decode($yqlexec,true);
		$currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];

		return $currency_output;
	}

	/*if ($fee_usd) {
		$currency_input = $fee_usd;
		//currency codes : http://en.wikipedia.org/wiki/ISO_4217
		$currency_from = "USD";
		$currency_to = "INR";
		$fee_usd = currencyConverter($currency_from,$currency_to,$currency_input);
		$fee_usd = number_format($fee_usd, 2, '.', ''); 
	}*/	

	//echo json_encode(array("a"=>"$start_date","b"=>"$end_date","c"=>"$venue","d"=>"$days"));
	
	echo json_encode(array("a"=>"$start","b"=>"$end","c"=>"$venue","d"=>"$days","e"=>$fee,"f"=>$fee_usd,"g"=>$pcode,"h"=>$overSeas));
?>  
