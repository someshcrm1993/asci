<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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





require_once('include/Dashlets/DashletGenericChart.php');

class SalesRepPerformanceDashlet extends DashletGenericChart
{
   
    public $pbss_sales_stages = array();

    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'SF_Sales_Forecast';

    /**
     * @see DashletGenericChart::__construct()
     */
    public function __construct(
        $id,
        array $options = null
    )
    {
        global $timedate;

        if(empty($options['title']))
            $options['title'] = translate('LBL_PERFORMANCE_FORM_TITLE', 'Home');

        parent::__construct($id,$options);
    }

    /**
     * @see DashletGenericChart::displayOptions()
     */
    public function displayOptions()
    {
        global $app_list_strings;

        if (!empty($this->pbss_sales_stages) && count($this->pbss_sales_stages) > 0)
            foreach ($this->pbss_sales_stages as $key)
                $selected_datax[] = $key;
        else
            $selected_datax = array_keys($app_list_strings['sales_stage_dom']);

        $this->_searchFields['pbss_sales_stages']['options'] = $app_list_strings['sales_stage_dom'];
        $this->_searchFields['pbss_sales_stages']['input_name0'] = $selected_datax;

        return parent::displayOptions();
    }

    /**
     * @see DashletGenericChart::display()
     */
    public function display()
    {
        global $current_user, $sugar_config;
        
         //get login user id
        $login_user_id = $current_user->id;

        $is_currency = true;
        $thousands_symbol = translate('LBL_OPP_THOUSANDS', 'Charts');

        $currency_symbol = $sugar_config['default_currency_symbol'];
        if ($current_user->getPreference('currency')){

            $currency = new Currency();
            $currency->retrieve($current_user->getPreference('currency'));
            $currency_symbol = $currency->symbol;
        }
		
		//get the current quarter
		$curMonth = date("m", time());
		$curQuarter = ceil($curMonth/3);
		
		$curYear=date('Y'); 

        $data = $this->getChartData($this->constructQuery($login_user_id,$curQuarter,$curYear));
        //$GLOBALS['log']->fatal($data,"get Chart Data");
        $chartReadyData = $this->prepareChartData($data);

        $jsontarget = $chartReadyData['target'];
        $jsonactual = $chartReadyData['actual'];  
        
        $colorcodepart1= round($jsontarget/3);
        $colorcodepart2= $colorcodepart1+$colorcodepart1;
        $colorcodepart3= $colorcodepart2+$colorcodepart1;
        
        //$GLOBALS['log']->fatal($jsontarget);
        //$GLOBALS['log']->fatal($jsonactual);          

        //TODO find a better way of doing this
        $canvasId = 'rGraphFunnel'.uniqid();

        //These are taken in the same fashion as the hard-coded array above
        $module = 'SF_Sales_Forecast';
        $action = 'index';
        $query  ='true';
        $searchFormTab ='advanced_search';

        $chartWidth     = 900;
        $chartHeight    = 500;

        $autoRefresh = $this->processAutoRefresh();//$autoRefresh

        $colours = "['#a6cee3','#1f78b4','#b2df8a','#33a02c','#fb9a99','#e31a1c','#fdbf6f','#ff7f00','#cab2d6','#6a3d9a','#ffff99','#b15928']";
        //<canvas id='$canvasId' width='$chartWidth' height='$chartHeight'>[No canvas support]</canvas>
        //<canvas id='test123'  width='$chartWidth' height='$chartHeight'>[No canvas support]</canvas>

        //There is always an ending anchor value, hence this check is that the data array is less than 2

        if(empty($jsontarget))
        {
            return "<h3 class='noGraphDataPoints'>No Results</h3>";
        }



 $chart = <<<EOD
        <input type='hidden' class='module' value='$module' />
        <input type='hidden' class='action' value='$action' />
        <input type='hidden' class='query' value='$query' />
        <input type='hidden' class='searchFormTab' value='$searchFormTab' />
        <input type='hidden' class='userId' value='$login_user_id' />      
             $autoRefresh
                    
        
        <script type="text/javascript" src="custom/include/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['gauge']});
		google.charts.setOnLoadCallback(drawChart);
		
/*

	  if(google) {
		google.charts.load('visualization', '1.1', {
			packages: ['gauge'],
			callback: function() {
				drawChart();
			}
		} )
	}
*/
		
		function drawChart() {

		 var data = google.visualization.arrayToDataTable([
			[ {label: 'Sales'}, {label: 'actual', type: 'number'} ],
			['Sales', $jsonactual]
       ]);
		  var options = {
			width: 400,
			height: 300,
			min: 0,
			max: $jsontarget,	
			
			redFrom: 0,
			redTo: $colorcodepart1,	
			yellowFrom: $colorcodepart1,
			yellowTo: $colorcodepart2,
			greenFrom: $colorcodepart2,
			greenTo: $colorcodepart3,	
			minorTicks: 3			
		  };

		  var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
		  chart.draw(data, options);

		}
		</script>
		
		<body>
			<div id="chart_div" style="width: 300px; height: 300px; margin:0 auto;  position: relative;"></div>
		</body>  	
  	
EOD;
        return $chart;
    }

    /**
     * awu: Bug 16794 - this function is a hack to get the correct sales stage order until
     * i can clean it up later
     *
     * @param  $query string
     * @return array
     */
    function getChartData(
        $query
    )
    {
        global $app_list_strings, $db;

        $data = array();
        $temp_data = array();
       
        $result = $db->query($query);
        while($row = $db->fetchByAssoc($result, false))
            $temp_data[] = $row;

		return $temp_data;
    }

    /**
     * @see DashletGenericChart::constructQuery()
     */
    protected function constructQuery($login_user_id,$curQuarter,$curYear)
    {

		$query = "SELECT TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from S.sales_target)) AS target, TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from S.opportunities_won)) AS actual
FROM sf_sales_forecast as S
JOIN users_sf_sales_forecast_1_c as US ON US.users_sf_sales_forecast_1sf_sales_forecast_idb=S.id
WHERE US.users_sf_sales_forecast_1users_ida='".$login_user_id."' AND S.quarter='".$curQuarter."' AND S.year='".$curYear."' AND S.deleted=0 AND US.deleted=0 LIMIT 1";
		//$GLOBALS['log']->fatal($query);
        return $query;
    }

    protected function prepareChartData($data)
    {
        //return $data;
        $chart['target']='';
        $chart['actual']='';
              
        foreach($data as $i)
        {           
            $chart['target']=$i['target'];
            $chart['actual']=$i['actual'];         
        }
        
        return $chart;
    }


}
