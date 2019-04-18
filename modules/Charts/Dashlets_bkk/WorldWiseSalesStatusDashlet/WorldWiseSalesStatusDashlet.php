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

class WorldWiseSalesStatusDashlet extends DashletGenericChart
{
    public $pbss_date_start;
    public $pbss_date_end;
    public $pbss_sales_stages = array();

    /**
     * @see DashletGenericChart::$_seedName
     */
    protected $_seedName = 'Opportunities';

    /**
     * @see DashletGenericChart::__construct()
     */
    public function __construct(
        $id,
        array $options = null
    )
    {
        global $timedate;

        if(empty($options['pbss_date_start']))
            $options['pbss_date_start'] = $timedate->nowDbDate();

        if(empty($options['pbss_date_end']))
            $options['pbss_date_end'] = $timedate->asDbDate($timedate->getNow()->modify("+6 months"));

        if(empty($options['title']))
            $options['title'] = translate('LBL_WORLD_WISE_FORM_TITLE', 'Home');

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

        $is_currency = true;
        $thousands_symbol = translate('LBL_OPP_THOUSANDS', 'Charts');

        $currency_symbol = $sugar_config['default_currency_symbol'];
        if ($current_user->getPreference('currency')){

            $currency = new Currency();
            $currency->retrieve($current_user->getPreference('currency'));
            $currency_symbol = $currency->symbol;
        }


        $data = $this->getChartData($this->constructQuery());
        //$GLOBALS['log']->fatal($data,"get Chart Data");
        $chartReadyData = $this->prepareChartData($data, $currency_symbol, $thousands_symbol);

        $jsonData = json_encode($chartReadyData['data']);
        $jsonLabels = json_encode($chartReadyData['labels']);
        $jsonLabelsAndValues = json_encode($chartReadyData['labelsAndValues']);
        
        $total = $chartReadyData['total'];

        $startDate = $this->pbss_date_start;
        $endDate = $this->pbss_date_end;

        //TODO find a better way of doing this
        $canvasId = 'rGraphFunnel'.uniqid();

        //These are taken in the same fashion as the hard-coded array above
        $module = 'Opportunities';
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
        if(!is_array($chartReadyData['data']))
        {
            return "<h3 class='noGraphDataPoints'>$this->noDataMessage</h3>";
        }


 $chart = <<<EOD
        <input type='hidden' class='module' value='$module' />
        <input type='hidden' class='action' value='$action' />
        <input type='hidden' class='query' value='$queryable' />
        <input type='hidden' class='searchFormTab' value='$searchFormTab' />
        <input type='hidden' class='userId' value='$userId' />
        <input type='hidden' class='startDate' value='$startDate' />
        <input type='hidden' class='endDate' value='$endDate' />
             $autoRefresh
             
    <script type="text/javascript" src="custom/include/loader.js"></script>
    <script type="text/javascript" src="custom/include/jsapi.js"></script>
    <script type="text/javascript">
      //google.charts.load('current', {packages:["geochart"]});
      //google.charts.setOnLoadCallback(drawWorldMap);
      
      
      if(google) {
		google.load('visualization', '1.0', {
			packages: ['geochart'],
			callback: function() {
				drawWorldMap();
			}
		} )
	}

      function drawWorldMap() {		
		var json_data = $jsonData;
		var json_labels = $jsonLabels;		  
			
		var data=[];
		var Header= ['Country', 'Sum($)'];
		data.push(Header);
		for (var i = 0; i < json_labels.length; i++) {
		  var temp=[];
		  temp.push(json_labels[i]);
		  temp.push(json_data[i]);		  
		 
		  data.push(temp);
		}
		
		var chartdata = google.visualization.arrayToDataTable(data);

		var options={

			region: 'world',
			displayMode: 'regions',
			//resolution: 'provinces',
			backgroundColor: '#81d4fa',
			//datalessRegionColor: '#f8bbd0',
			//defaultColor: '#f5f5f5',  
			//colors: ['#D73218', '#F8BE5B', '#70A042']
			colors: ['#FFFFCE','#FEAD5D','#B6072A']	
		};

		var worldchart = new google.visualization.GeoChart(document.getElementById('worldchart-colors'));
        worldchart.draw(chartdata, options);
      }
      
      </script>
      
      <body>
		<div id="worldchart-colors" style="width: 100%; height: 433px; align=center;"></div>
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
        $selected_datax = array();

        $user_sales_stage = $this->pbss_sales_stages;
        $tempx = $user_sales_stage;

/*
        //set $datax using selected sales stage keys
        if (count($tempx) > 0) {
            foreach ($tempx as $key) {
                $datax[$key] = $app_list_strings['region_list'][$key];
                $selected_datax[] = $key;
            }
        }
        else {
            $datax = $app_list_strings['region_list'];
            $selected_datax = array_keys($app_list_strings['region_list']);
        }
        //~ $GLOBALS['log']->fatal($selected_datax);
*/

        $result = $db->query($query);
        while($row = $db->fetchByAssoc($result, false))
            $temp_data[] = $row;

/*
        // reorder and set the array based on the order of selected_datax
        foreach($selected_datax as $region_c){
            foreach($temp_data as $key => $value){
				//~ $GLOBALS['log']->fatal($value,"for each loop");
                if ($value['region_c'] == $region_c){
                    $value['region_c'] = $app_list_strings['region_list'][$value['region_list']];
                    $value['key'] = $region_c;
                    $value['value'] = $value['region_c'];
                    $data[] = $value;
                    unset($temp_data[$key]);
                }
            }
        }
        return $data;
*/
		return $temp_data;
    }

    /**
     * @see DashletGenericChart::constructQuery()
     */
    protected function constructQuery()
    {

		$query = "SELECT A.billing_address_country as country, sum(amount_usdollar) AS total 
FROM opportunities 
JOIN accounts_opportunities AO ON AO.opportunity_id=opportunities.id
JOIN accounts A ON A.id=AO.account_id 
WHERE opportunities.sales_stage IN('Closed Won') and opportunities.deleted=0 and A.deleted=0 and AO.deleted=0 GROUP BY opportunities.sales_stage, A.billing_address_country";
		//$GLOBALS['log']->fatal($query);
        return $query;
    }

    protected function prepareChartData($data,$currency_symbol, $thousands_symbol)
    {
        //return $data;
        $chart['labels']=array();
        $chart['data']=array();
        $total = 0;
        foreach($data as $i)
        {
            //$chart['labelsAndValues'][]=$i['key'].' ('.$currency.(int)$i['total'].')';
            $chart['labelsAndValues'][]=$i['country'].' ('.$currency_symbol.(int)$i['total'].$thousands_symbol.')';
            $chart['labels'][]=$i['country'];
            $chart['data'][]=(int)$i['total'];
            $total+=(int)$i['total'];
        }
        //The funnel needs n+1 elements (to bind the shape to as per http://www.rgraph.net/demos/funnel-interactive-key.html)
        //$chart['data'][]=1;
        $chart['total']=$total;
        return $chart;
    }


}
