<?php
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

class AOR_Chart extends Basic {

    var $colours = "['#1f78b4','#a6cee3','#b2df8a','#33a02c','#fb9a99','#e31a1c','#fdbf6f','#ff7f00','#cab2d6','#6a3d9a','#ffff99','#b15928']";
	var $new_schema = true;
	var $module_dir = 'AOR_Charts';
	var $object_name = 'AOR_Chart';
	var $table_name = 'aor_charts';
	var $importable = true;
	var $disable_row_level_security = true ;
	
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $modified_by_name;
	var $created_by;
	var $created_by_name;
	var $description;
	var $deleted;
	var $created_by_link;
	var $modified_user_link;

    var $type;
    var $x_field;
    var $y_field;
    var $noDataMessage = "No Results";



	function AOR_Chart(){
		parent::Basic();
	}

    function save_lines(array $post,AOR_Report $bean,$postKey){
        $seenIds = array();
        if(isset($post[$postKey.'id'])) {
            foreach ($post[$postKey . 'id'] as $key => $id) {
                if ($id) {
                    $aorChart = BeanFactory::getBean('AOR_Charts', $id);
                } else {
                    $aorChart = BeanFactory::newBean('AOR_Charts');
                }
                $aorChart->name = $post[$postKey . 'title'][$key];
                $aorChart->type = $post[$postKey . 'type'][$key];
                $aorChart->x_field = $post[$postKey . 'x_field'][$key];
                $aorChart->y_field = $post[$postKey . 'y_field'][$key];
                $aorChart->aor_report_id = $bean->id;
                $aorChart->save();
                $seenIds[] = $aorChart->id;
            }
        }
        //Any beans that exist but aren't in $seenIds must have been removed.
        foreach($bean->get_linked_beans('aor_charts','AOR_Charts') as $chart){
            if(!in_array($chart->id,$seenIds)){
                $chart->mark_deleted($chart->id);
            }
        }
    }

    private function getValidChartTypes(){
        return array('bar','line','pie','radar','rose', 'grouped_bar', 'stacked_bar');
    }


    private function getColour($seed,$rgbArray = false){
        $hash = md5($seed);
        $r = hexdec(substr($hash, 0, 2));
        $g = hexdec(substr($hash, 2, 2));
        $b = hexdec(substr($hash, 4, 2));
        if($rgbArray){
            return array('R'=>$r,'G'=>$g,'B'=>$b);
        }
        $highR = $r + 10;
        $highG = $g + 10;
        $highB = $b + 10;
        $main = '#'.str_pad(dechex($r),2,'0',STR_PAD_LEFT)
            .str_pad(dechex($g),2,'0',STR_PAD_LEFT)
            .str_pad(dechex($b),2,'0',STR_PAD_LEFT);
        $highlight = '#'.dechex($highR).dechex($highG).dechex($highB);
        return array('main'=>$main,'highlight'=>$highlight);
    }

    function buildChartImageBar($chartPicture,$recordImageMap = false){
        $scaleSettings = array("DrawSubTicks" => false, "LabelRotation" => 30, 'MinDivHeight' => 50);
        $chartPicture->drawScale($scaleSettings);
        $chartPicture->drawBarChart(array("RecordImageMap"=>$recordImageMap));
    }

    function buildChartImagePie($chartPicture,$chartData, $reportData,$imageHeight, $imageWidth, $xName,$recordImageMap){
        $PieChart = new pPie($chartPicture,$chartData);
        $x = 0;
        foreach($reportData as $row){
            $PieChart->setSliceColor($x,$this->getColour($row[$xName],true));
            $x++;
        }
        $PieChart->draw2DPie($imageWidth/3,$imageHeight/2,array("Border"=>TRUE,'Radius'=>200,''=>true,"RecordImageMap"=>$recordImageMap));
        $PieChart->drawPieLegend($imageWidth*0.7,$imageHeight/3, array('FontSize'=>10,"FontName"=>"modules/AOR_Charts/lib/pChart/fonts/verdana.ttf",'BoxSize'=>14));
    }

    function buildChartImageLine($chartPicture, $recordImageMap = false){
        $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"GridR"=>200,"GridG"=>200,"GridB"=>200,'MinDivHeight' => 50,"LabelRotation" => 30);
        $chartPicture->drawScale($scaleSettings);
        $chartPicture->drawLineChart(array("RecordImageMap"=>$recordImageMap));
    }

    function buildChartImageRadar($chartPicture, $chartData,$recordImageMap){
        $SplitChart = new pRadar();
        $Options = array("LabelPos"=>RADAR_LABELS_HORIZONTAL,"RecordImageMap"=>$recordImageMap);
        $SplitChart->drawRadar($chartPicture,$chartData,$Options);

    }

    public function buildChartImage(array $reportData, array $fields,$asDataURI = true, $generateImageMapId = false){
        global $current_user;
        require_once 'modules/AOR_Charts/lib/pChart/pChart.php';

        if($generateImageMapId !== false){
            $generateImageMapId = $current_user->id."-".$generateImageMapId;
        }

        $html = '';
        if(!in_array($this->type, $this->getValidChartTypes())){
            return $html;
        }
        $x = $fields[$this->x_field];
        $y = $fields[$this->y_field];
        if(!$x || !$y){
            //Malformed chart object - missing an axis field
            return '';
        }
        $xName = str_replace(' ','_',$x->label) . $this->x_field;
        $yName = str_replace(' ','_',$y->label) . $this->y_field;

        $chartData = new pData();
        $chartData->loadPalette("modules/AOR_Charts/lib/pChart/palettes/navy.color", TRUE);
        $labels = array();
        foreach($reportData as $row){
            $chartData->addPoints($row[$yName],'data');
            $chartData->addPoints($row[$xName],'Labels');
            $labels[] = $row[$xName];
        }

        $chartData->setSerieDescription("Months","Month");
        $chartData->setAbscissa("Labels");

        $imageHeight = 700;
        $imageWidth = 700;

        $chartPicture = new pImage($imageWidth,$imageHeight,$chartData);
        if($generateImageMapId){
            $imageMapDir = create_cache_directory('modules/AOR_Charts/ImageMap/'.$current_user->id.'/');
            $chartPicture->initialiseImageMap($generateImageMapId,IMAGE_MAP_STORAGE_FILE,$generateImageMapId,$imageMapDir);
        }

        $chartPicture->Antialias = True;

        $chartPicture->drawFilledRectangle(0,0,$imageWidth-1,$imageHeight-1,array("R"=>240,"G"=>240,"B"=>240,"BorderR"=>0,"BorderG"=>0,"BorderB"=>0,));

        $chartPicture->setFontProperties(array("FontName"=>"modules/AOR_Charts/lib/pChart/fonts/verdana.ttf","FontSize"=>14));

        $chartPicture->drawText($imageWidth/2,20,$this->name,array("R"=>0,"G"=>0,"B"=>0,'Align'=>TEXT_ALIGN_TOPMIDDLE));
        $chartPicture->setFontProperties(array("FontName"=>"modules/AOR_Charts/lib/pChart/fonts/verdana.ttf","FontSize"=>6));

        $chartPicture->setGraphArea(60,60,$imageWidth-60,$imageHeight-100);

        switch($this->type){
            case 'radar':
                $this->buildChartImageRadar($chartPicture, $chartData, !empty($generateImageMapId));
                break;
            case 'pie':
                $this->buildChartImagePie($chartPicture,$chartData, $reportData,$imageHeight, $imageWidth, $xName, !empty($generateImageMapId));
                break;
            case 'line':
                $this->buildChartImageLine($chartPicture, !empty($generateImageMapId));
                break;
            case 'bar':
            default:
                $this->buildChartImageBar($chartPicture, !empty($generateImageMapId));
                break;
        }
        if($generateImageMapId) {
            $chartPicture->replaceImageMapTitle("data", $labels);
        }
        ob_start();
        $chartPicture->render('');
        $img = ob_get_clean();
        if($asDataURI){
            return 'data:image/png;base64,'.base64_encode($img);
        }else{
            return $img;
        }
    }

    public function buildChartHTML(array $reportData, array $fields,$index = 0, $chartType = AOR_Report::CHART_TYPE_PCHART, AOR_Field $mainGroupField = null){
        switch($chartType){
            case AOR_Report::CHART_TYPE_PCHART:
                return $this->buildChartHTMLPChart($reportData,$fields,$index);
            case AOR_Report::CHART_TYPE_CHARTJS:
                return $this->buildChartHTMLChartJS($reportData,$fields);
            case AOR_Report::CHART_TYPE_RGRAPH:
                return $this->buildChartHTMLRGraph($reportData,$fields, $mainGroupField);
        }
        return '';
    }


    private function buildChartHTMLRGraph(array $reportData, array $fields, AOR_Field $mainGroupField = null){
        $html = '';
        if(!in_array($this->type, $this->getValidChartTypes())){
            return $html;
        }
        $x = $fields[$this->x_field];
        $y = $fields[$this->y_field];
        if(!$x || !$y){
            //Malformed chart object - missing an axis field
            return '';
        }
        $xName = str_replace(' ','_',$x->label) . $this->x_field;
        $yName = str_replace(' ','_',$y->label) . $this->y_field;

        $defaultHeight = 400;
        $defaultWidth = 600;

        switch($this->type){
            /*
             //Polar was not implemented for the previous library (it is not in the getValidChartTypes method)
            case 'polar':
                $chartFunction = 'PolarArea';
                $data = $this->getPolarChartData($reportData, $xName,$yName);
                $config = $this->getPolarChartConfig();
                break;
            */
            case 'radar':
                $chartFunction = 'Radar';
                $data = $this->getRGraphBarChartData($reportData, $xName,$yName);
                $config = $this->getRadarChartConfig();
                $chart = $this->getRGraphRadarChart(json_encode($data['data']), json_encode($data['labels']),json_encode($data['tooltips']), $this->name, $this->id, $defaultHeight,$defaultWidth);
                break;
            case 'pie':
                $chartFunction = 'Pie';
                $data = $this->getRGraphBarChartData($reportData, $xName,$yName);
                $config = $this->getPieChartConfig();
                $chart = $this->getRGraphPieChart(json_encode($data['data']), json_encode($data['labels']),json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth);
                break;
            case 'line':
                $chartFunction = 'Line';
                $data = $this->getRGraphBarChartData($reportData, $xName,$yName);
                $config = $this->getLineChartConfig();
                $chart = $this->getRGraphLineChart(json_encode($data['data']), json_encode($data['labels']),json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth);
                break;
            case 'rose':
                $chartFunction = 'Rose';
                $data = $this->getRGraphBarChartData($reportData, $xName,$yName);
                $config = $this->getRoseChartConfig();
                $chart = $this->getRGraphRoseChart(json_encode($data['data']), json_encode($data['labels']),json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth);
                break;
            case 'grouped_bar':

		//start - for solving issue related to grouped_bar - futureCRM
	        if($mainGroupField==null){
		     echo "<b>Please select <font color='green'>Main Group</font> for <font color='green'>Grouped Bar</font> Chart.</b>";
		         return false;
		}
		//end - for solving issue related to grouped_bar - futureCRM

                $chartFunction = 'Grouped bar';
                $data = $this->getRGraphGroupedBarChartData($reportData, $xName,$yName, $mainGroupField);
                $config = $this->getGroupedBarChartConfig();
                $chart = $this->getRGraphGroupedBarChart(json_encode($data['data']), json_encode($data['labels']), json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth, true);
                break;
            case 'stacked_bar':

		//start - for solving issue related to stacked_bar - futureCRM
	        if($mainGroupField==null){
		    echo "<b>Please select <font color='green'>Main Group</font> for <font color='green'>Stacked Bar</font> Chart.</b>";
		         return false;
		}
		//end - for solving issue related to stacked_bar - futureCRM

                $chartFunction = 'Stacked bar';
                $data = $this->getRGraphGroupedBarChartData($reportData, $xName,$yName, $mainGroupField);
                $config = $this->getStackedBarChartConfig();
                $chart = $this->getRGraphGroupedBarChart(json_encode($data['data']), json_encode($data['labels']), json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth, false);
                break;
            case 'bar':
            default:
                $chartFunction = 'Bar';
                $data = $this->getRGraphBarChartData($reportData, $xName,$yName);
                $config = $this->getBarChartConfig();
                $chart = $this->getRGraphBarChart(json_encode($data['data']), json_encode($data['labels']), json_encode($data['tooltips']), $this->name, $this->id,  $defaultHeight,$defaultWidth);
                break;
        }

        return $chart;
    }

    private function getRGraphRoseChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400)
    {
        $dataArray = json_decode($chartDataValues);
        if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
        $html = '';
        $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas'></canvas>";
        $html .= <<<EOF
        <script>
            new RGraph.Rose({
            id: '$chartId',
            options:{
                //title: '$chartName',
                //labels: $chartLabelValues,
                //textSize:8,
                textSize:10,
                //titleSize:10,
                 tooltips:$chartTooltips,
                tooltipsEvent:'onmousemove',
                tooltipsCssClass: 'rgraph_chart_tooltips_css',
                colors: $this->colours,
                colorsSequential:true
            },
            data: $chartDataValues
        }).draw();
        </script>
EOF;
        return $html;
    }



    //I have not used a parameter for getRGraphBarChart to say whether to group etc, as the future development could be quite different
    //for both, hence the separate methods.  However, the $grouped parameter allows us to specify whether the chart is grouped (true)
    //or stacked (false)
    private function getRGraphGroupedBarChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400, $grouped = false)
    {
        //$keys = array_keys($chartTooltips);


        $i=0;
        foreach($chartDataValues as $rowKey => $row) {
            foreach($row as $key => $value) {
                $_tooltips[$rowKey][$key] = $chartTooltips[$i];
                $i++;
            }
        }


        $dataArray = json_decode($chartDataValues);
        $grouping = 'grouped'; //$mainGroupField->label; //'grouped';
        if(!$grouped)
            $grouping='stacked';
        if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
        $html = '';
        $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas'></canvas>";
        $html .= <<<EOF
        <script>
            new RGraph.Bar({
            id: '$chartId',
            data: $chartDataValues,
            options: {
                grouping:'$grouping',
                backgroundGrid:false,
                backgroundGrid:false,
                gutterBottom: 150,
                //gutterTop:40,
                //gutterLeft:30,
                title: '$chartName',

                tooltips:$chartTooltips,
                tooltipsEvent:'onmousemove',
                tooltipsCssClass: 'rgraph_chart_tooltips_css',

                gutterLeft:100,
                shadow:false,
                titleSize:10,
                labels: $chartLabelValues,
                textSize:10,
                textAngle: 90,
                colors: $this->colours
            }
        }).draw();
        </script>
EOF;
        return $html;
    }



    private function getRGraphBarChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400)
    {
        $dataArray = json_decode($chartDataValues);
        if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
       // print_r($chartDataValues);
       //~ $col_arr="['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477','#66AA00','#B82E2E','#316395','#994499','#22AA99','#AAAA11','#6633CC','#E67300','#8B0707','#329262','#5574A6','#3B3EAC']";
//~ 
        //~ $html = '';
        //~ $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas'></canvas>";
   //~ 
        //~ $html .= <<<EOF
        //~ <script>
            //~ new RGraph.Bar({
            //~ id: '$chartId',
            //~ data: $chartDataValues,
            //~ options: {
            //~ title: '$chartName',
                //~ gutterBottom: 150,
                //~ gutterLeft:100,
                //~ gutterTop:50,
                //~ title: '$chartName',
                //~ labels: $chartLabelValues,
                //~ colorsSequential:true,
                //~ textAngle: 90,
                //~ textSize:10,
                //~ titleSize:10,
              //~ 
                //~ tooltips:$chartTooltips,
                //~ tooltipsCssClass: 'rgraph_chart_tooltips_css',
                //~ tooltipsEvent:'onmousemove',
                //~ 
            //~ yaxis: false,
            //~ backgroundGrid:false,
            //~ backgroundGridBorder: false,
//~ 
                //~ //colors: $this->colours,
                //~ colors:$col_arr
            //~ }
        //~ }).grow();
        //~ </script>
//~ EOF;
    
    
$chartHeight=$chartHeight."px";
$chartWidth=$chartWidth."px";
    $bar_lv = json_decode($chartLabelValues);
$bar_dv =json_decode($chartDataValues);
$barcomb_arr = array_combine(array_values($bar_lv),array_values($bar_dv));
$colours = array('#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477','#66AA00','#B82E2E','#316395','#994499','#22AA99','#AAAA11','#6633CC','#E67300','#8B0707','#329262','#5574A6','#3B3EAC');

$colur_count=1;
//print_r($colours);
foreach($barcomb_arr as $k=>$v)
{
	
 $col_color=$colours[$colur_count++];	
 if(empty($col_color))
 {
$col_color="blue";	 
 }
 $bar_cht.="['".$k."',".$v.",'color:".$col_color."'],";	
}
//print_r($bar_cht);

$html .= <<<EOT
	 
    <script type="text/javascript">
      $(document).ready(function(){
		  
			$(window).resize(function(){
			drawChart();
			});
    //  google.charts.load('current', {'packages':['bar']});
    //  google.charts.setOnLoadCallback(drawStuff);


function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('number', 'Value');
    data.addColumn({type: 'string', role: 'style'});
    data.addRows([
       $bar_cht
    ]);
    

    var chart = new google.visualization.ColumnChart(document.querySelector('#chart_div$chartId'));
   
    chart.draw(data, {
	//	title: '$chartName',
//        height: "$chartHeight",
 //       width: "$chartWidth",
        legend: {
            position: 'none'
        }
    });
}
google.load('visualization', '1', {packages:['corechart'], callback: drawChart});

  });

    </script>


    <div id="chart_div$chartId" class="google_chart"></div><br>


EOT;
    
    
        return $html;
    }

    private function getRGraphRadarChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400)
    {
        $dataArray = json_decode($chartDataValues);
        if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
        $html = '';
        $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas'></canvas>";
        $html .= <<<EOF
        <script>
            new RGraph.Radar({
            id: '$chartId',
            data: $chartDataValues,
            options: {
                title: '$chartName',
                labels: $chartLabelValues,
                textSize:10,


                tooltips:$chartTooltips,
                tooltipsEvent:'onmousemove',
                tooltipsCssClass: 'rgraph_chart_tooltips_css',

                colors: $this->colours
            }
        }).draw();
        </script>
EOF;
        return $html;
    }

    private function getRGraphPieChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400)
    {
	    $dataArray = json_decode($chartDataValues);
       if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
/*
        if($chartHeight > 400)
            $chartHeight = 400;
        if($chartWidth > 600)
            $chartWidth = 400;
*/
//~ $col_arr="['#3366CC','#DC3912','#FF9900','#109618','#990099','#3B3EAC','#0099C6','#DD4477','#66AA00','#B82E2E','#316395','#994499','#22AA99','#AAAA11','#6633CC','#E67300','#8B0707','#329262','#5574A6','#3B3EAC']";
//~ 
        //~ $html .= '';
        //~ $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas' ></canvas>";
       // class='resizableCanvas'
        //~ $html .= <<<EOF
        //~ <script>
            //~ new RGraph.Pie({
            //~ id: '$chartId',
            //~ data: $chartDataValues,
            //~ options: {
                //~ title: '$chartName',
                //~ 
				//~ textSize:10,
                //~ titleSize:10,
                //~ gutterTop:60,
                //~ shadow: false,
                 //~ tooltips:$chartTooltips,
                //~ tooltipsEvent:'onmousemove',
                //~ tooltipsCssClass: 'rgraph_chart_tooltips_css',
                //~ labels: $chartLabelValues,
                //~ //colors: $this->colours
                //~ colors : $col_arr,
                //~ labelsSticks:true,
                //~ linewidth: 1,
				//~ variant: 'donut',
				//~ gutterLeft:110,
				//~ shadowBlur:0,
	//			strokestyle: 'rgba(0,0,0,0)',
	//			exploded: 0,
				//~ 
//~ 
				//~ 
            //~ }
        //~ }).roundRobin();
        //~ </script>
//~ EOF;

    
$chartHeight=$chartHeight."px";
$chartWidth=$chartWidth."px";
$clv = json_decode($chartLabelValues);
$cdv =json_decode($chartDataValues);
$comb_arr = array_combine(array_values($clv),array_values($cdv));

foreach($comb_arr as $k=>$v)
{
	
 $pie_cht.="['".$k."',".$v."],";	

}
		$html .= <<<EOT
		<style>
		 path[d^="M587,346L600,353L587,359Z"] {fill: #2767AB;}
		 path[d^="M559,359L559,346L546,353Z"] {fill: #2767AB;}
		 path[d^="M439,369L451,375L439,381Z"] {fill: #2767AB}
		 text[fill^="#0011cc"] {fill: #2767AB;}

		</style>
		<script type="text/javascript">
     
          $(document).ready(function(){
			  
			$(window).resize(function(){
			drawChart();
			});

     // google.charts.load("current", {packages:["corechart"]});
     // google.charts.setOnLoadCallback(drawChart);
      
        if(google) {
		google.load('visualization', '1', {
			packages: ['corechart'],
			callback: function() {
				drawChart();
			}
		} )
	}
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
       
          ['Type', 'Value'],
          $pie_cht
          
        ]);

        var options = {
      //  title: "$chartName",
		legend: {position: 'right',alignment:'center',},
		chartArea:{width:600,height:300},
		//pieSliceText:'label',
		pieHole: 0.4,
	    };
       var chart = new google.visualization.PieChart(document.getElementById('$chartId'));
        chart.draw(data, options);
      }
  })
    </script>
      <div id="$chartId" class="google_chart"></div><br>
EOT;

		return $html;
    }

    private function getRGraphLineChart($chartDataValues, $chartLabelValues,$chartTooltips, $chartName= '', $chartId, $chartHeight = 400, $chartWidth = 400)
    {
        $dataArray = json_decode($chartDataValues);
        if(!is_array($dataArray)||count($dataArray) < 1)
        {
            return "<h3>$this->noDataMessage</h3>";
        }
        //~ $html = '';
        //~ $html .= "<canvas id='$chartId' width='$chartWidth' height='$chartHeight' class='resizableCanvas'></canvas>";
        //~ $html .= <<<EOF
        //~ <script>
            //~ new RGraph.Line({
            //~ id: '$chartId',
            //~ data: $chartDataValues,
            //~ options: {
                //~ title: '$chartName',
                 //~ gutterBottom: 50,
                 //~ gutterLeft:100,
                 //~ gutterTop:50,
                //~ // tickmarks:'encircle',
                 //~ textSize:10,
                //~ titleSize:10,
                //~ //title: '$chartName',
                 //~ labels: $chartLabelValues,
                  
                //~ tooltips:$chartTooltips,
                //~ tooltipsEvent:'onmousemove',
                //~ tooltipsCssClass: 'rgraph_chart_tooltips_css',
//~ 
                //~ tickmarks:'circle',
//~ 
                //~ textAngle: 90,
                //~ //titleSize:10,
                 //~ backgroundGrid:false,
                //~ colors: $this->colours
                //~ linewidth: 2,
                //~ colors: [['red','black']],
                //~ colorsAlternate: true,
                //~ textAccessible: true
            //~ }
        //~ }).draw();
        //~ </script>
//~ EOF;


$chartHeight=$chartHeight."px";
$chartWidth=$chartWidth."px";
$linelv = json_decode($chartLabelValues);
$linedv =json_decode($chartDataValues);
$line_comb_arr = array_combine(array_values($linelv),array_values($linedv));

foreach($line_comb_arr as $k=>$v)
{
	
 $line_cht.="['".$k."',".$v."],";	

}
//print_r($line_cht);
  $html .= <<<EOF
  
  <script>
$(document).ready(function(){
		$(window).resize(function(){
		drawLineChart();
		});
	
	 if(google) {
		google.load('visualization', '1', {
			packages: ['corechart'],
			callback: function() {
				drawLineChart();
			}
		} )
	}
	 function drawLineChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'Values'],
          $line_cht
        ]);

        var options = {
        //  title: '$chartName',
          curveType: 'function',
          legend: 'none',
          pointSize: 8,
          
          vAxis: { viewWindow: {
            min:0
        }},
        };

        var chart = new google.visualization.LineChart(document.getElementById('$chartId'));

        chart.draw(data, options);
    
    

    
      }

	
	})
	
	

</script>
   <div id="$chartId"  class="google_chart"></div><br>

  
EOF;
  
        return $html;
    }

    private function buildChartHTMLChartJS(array $reportData, array $fields){
        $html = '';
        if(!in_array($this->type, $this->getValidChartTypes())){
            return $html;
        }
        $x = $fields[$this->x_field];
        $y = $fields[$this->y_field];
        if(!$x || !$y){
            //Malformed chart object - missing an axis field
            return '';
        }
        $xName = str_replace(' ','_',$x->label) . $this->x_field;
        $yName = str_replace(' ','_',$y->label) . $this->y_field;

        switch($this->type){
            case 'polar':
                $chartFunction = 'PolarArea';
                $data = $this->getPolarChartData($reportData, $xName,$yName);
                $config = $this->getPolarChartConfig();
                break;
            case 'radar':
                $chartFunction = 'Radar';
                $data = $this->getRadarChartData($reportData, $xName,$yName);
                $config = $this->getRadarChartConfig();
                break;
            case 'pie':
                $chartFunction = 'Pie';
                $data = $this->getPieChartData($reportData, $xName,$yName);
                $config = $this->getPieChartConfig();
                break;
            case 'line':
                $chartFunction = 'Line';
                $data = $this->getLineChartData($reportData, $xName,$yName);
                $config = $this->getLineChartConfig();
                break;
            case 'bar':
            default:
                $chartFunction = 'Bar';
                $data = $this->getBarChartData($reportData, $xName,$yName);
                $config = $this->getBarChartConfig();
                break;
        }
        $data = json_encode($data);
        $config = json_encode($config);
        $chartId = 'chart'.$this->id;
        $html .= "<h3>{$this->name}</h3>";
        $html .= "<canvas id='{$chartId}' width='400' height='400'></canvas>";
        $html .= <<<EOF
        <script>
        $(document).ready(function(){
            SUGAR.util.doWhen("typeof Chart != 'undefined'", function(){
                var data = {$data};
                var ctx = document.getElementById("{$chartId}").getContext("2d");
                console.log('Creating new chart');
                var config = {$config};
                var chart = new Chart(ctx).{$chartFunction}(data, config);
                var legend = chart.generateLegend();
                $('#{$chartId}').after(legend);
            });
        });
        </script>
EOF;
        return $html;
    }

    private function buildChartHTMLPChart(array $reportData, array $fields,$index = 0){
        $html = '';
        $imgUri = $this->buildChartImage($reportData,$fields,true,$index);
        $img = "<img id='{$this->id}_img' src='{$imgUri}'>";
        $html .= $img;
        $html .= <<<EOF
<script>
SUGAR.util.doWhen("typeof addImage != 'undefined'", function(){
    addImage('{$this->id}_img','{$this->id}_img_map','index.php?module=AOR_Charts&action=getImageMap&to_pdf=1&imageMapId={$index}');
});
</script>
EOF;
        return $html;
    }

    private function getShortenedLabel($label, $maxLabelSize = 20)
    {
        if(strlen($label) > $maxLabelSize)
        {
            return substr($label,0,$maxLabelSize).'...';
        }
        else
            return $label;
    }


    private function getRGraphGroupedBarChartData($reportData, $xName,$yName, AOR_Field $mainGroupField){


        // get z-axis name

        $zName = null;
        foreach($reportData[0] as $key => $value) {
            $field = str_replace(' ', '_', $mainGroupField->label);
            if (preg_match('/^' . $field . '[0-9]+/', $key)) {
                $zName = $key;
                break;
            }
        }



        // get grouped values

        $data = array();
        $tooltips = array();

        $usedKeys = array();
        foreach($reportData as $key => $row) {
            $filter = $row[$xName];
            foreach($reportData as $key2 => $row2) {
                if($row2[$xName] == $filter && !in_array($key, $usedKeys)) {
                    $data      [ $row[$xName]  ]   [] = (float) $row[$yName];
                    $tooltips  [ $row[$xName]  ]   [] = $row[$zName];
                    $usedKeys[] = $key;
                }
            }
        }

        $_data = array();
        foreach($data as $label => $values) {
            foreach($values as $key => $value) {
                $_data[$label][$tooltips[$label][$key]] = $value;
            }
        }
        $data = $_data;


        // make data format for charts

        $_data = array();
        $_labels = array();
        $_tooltips = array();
        foreach($data as $label => $values) {
            $_labels[] = $this->getShortenedLabel($label) . $this->getChartDataNameLabel($label);
            $_values = array();
            foreach($values as $tooltip => $value) {
                $_tooltips[] = $tooltip . " ($value)";
                $_values[] = $value;
            }
            $_data[] = $_values;
        }


        $chart = array(
            'data' => $_data,
            'labels' => $_labels,
            'tooltips' => $_tooltips,
        );

        return $chart;


    }

    private function getRGraphBarChartData($reportData, $xName,$yName){
        $chart['labels']=array();
        $chart['data']=array();
        $chart['tooltips']=array();

     foreach($reportData as $row){
            
            //$chart['labels'][] = $this->getShortenedLabel($row[$xName]) . $this->getChartDataNameLabel($row[$xName]);
            //$chart['tooltips'][] = $row[$xName] . $this->getChartDataNameLabel($row[$xName]);

            //Start - for correcting chart display - futureCRM
            $chart['labels'][] = $this->getShortenedLabel($row[$xName]);
            $chart['tooltips'][] = $row[$xName] .' : '. (float)$row[$yName];
            //End - for correcting chart display - futureCRM

            $chart['data'][] = (float)$row[$yName];

        }
        return $chart;
    }


    private function getBarChartData($reportData, $xName,$yName){
        $data = array();
        $data['labels'] = array();
        $datasetData = array();
        foreach($reportData as $row){
            $data['labels'][] = $row[$xName] . $this->getChartDataNameLabel($row[$xName]);
            $datasetData[] = $row[$yName];
        }

        $data['datasets'] = array();
        $data['datasets'][] = array(
            'fillColor' => "rgba(151,187,205,0.2)",
            'strokeColor' => "rgba(151,187,205,1)",
            'pointColor' => "rgba(151,187,205,1)",
            'pointStrokeColor' => "#fff",
            'pointHighlightFill' => "#fff",
            'pointHighlightStroke' => "rgba(151,187,205,1)4",
            'data'=>$datasetData);
        return $data;
    }

    private function getChartDataNameLabel($name) {
        if(isset($GLOBALS['app_list_strings'])) {
            $keys = array_keys($GLOBALS['app_list_strings']);
            foreach ($keys as $key) {
                if (isset($GLOBALS['app_list_strings'][$key][$name])) {
                    return " [{$GLOBALS['app_list_strings'][$key][$name]}]";
                }
            }
        }
        return '';
    }

    private function getLineChartData($reportData, $xName,$yName){
        return $this->getBarChartData($reportData, $xName,$yName);
    }

    private function getBarChartConfig(){
        return array();
    }
    private function getLineChartConfig(){
        return $this->getBarChartConfig();
    }

    private function getGroupedBarChartConfig()
    {
        return $this->getBarChartConfig();
    }

    private function getStackedBarChartConfig()
    {
        return $this->getBarChartConfig();
    }

    private function getRoseChartConfig(){
        return $this->getBarChartConfig();
    }

    private function getRadarChartData($reportData, $xName,$yName){
        return $this->getBarChartData($reportData, $xName,$yName);
    }

    private function getPolarChartData($reportData, $xName,$yName){
        return $this->getPieChartData($reportData, $xName,$yName);
    }

    private function getRadarChartConfig(){
        return array();
    }

    private function getPolarChartConfig(){
        return $this->getPieChartConfig();
    }
    private function getPieChartConfig(){
        $config = array();
        $config['legendTemplate'] = "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;<%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>";
        return $config;
    }

    private function getPieChartData($reportData, $xName,$yName){
        $data = array();

        foreach($reportData as $row){
            if(!$row[$yName]){
                continue;
            }
            $colour = $this->getColour($row[$xName]);
            $data[] = array(
                'value' => (int)$row[$yName],
                'label' => $row[$xName] . $this->getChartDataNameLabel($row[$xName]),
                'color' => $colour['main'],
                'highlight' => $colour['highlight'],
            );
        }
        return $data;
    }


}
