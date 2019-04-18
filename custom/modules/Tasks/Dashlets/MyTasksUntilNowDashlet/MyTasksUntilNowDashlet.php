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


// ini_set('display_errors','On');


require_once('include/Dashlets/DashletGeneric.php');


class MyTasksUntilNowDashlet extends DashletGeneric { 
    function MyTasksUntilNowDashlet($id, $def = null) {
        global $current_user, $app_strings;
		require('custom/modules/Tasks/Dashlets/MyTasksUntilNowDashlet/MyTasksUntilNowDashlet.data.php');
		
        parent::DashletGeneric($id, $def);
        
        if(empty($def['title'])) $this->title = translate('LBL_LIST_MY_TASKS_UNTIL_NOW', 'Tasks');

        $this->searchFields = $dashletData['MyTasksUntilNowDashlet']['searchFields'];
        $this->columns = $dashletData['MyTasksUntilNowDashlet']['columns'];
                
        $this->seedBean = new Task();        
    }    
    
    public function programmeData($id='', $week_array, $connection)
    {
        
        // $query="SELECT 
        //          project.name,
        //          project_cstm.start_date_c, 
        //          project_cstm.end_date_c,
        //          count(scrm_accommodation_cstm.id_c) as occupied
        //      FROM project 
        //      INNER JOIN project_cstm ON project_cstm.id_c = project.id
        //      LEFT JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida = project.id
        //      LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb
        //      LEFT JOIN scrm_accommodation ON scrm_accommodation.id = scrm_accommodation_cstm.id_c
        //      WHERE project.deleted = '0'
        //      AND (scrm_accommodation.id is NULL OR scrm_accommodation.deleted = '0')
        //      AND project.id = $id
        //      GROUP BY project.id";
        $query="SELECT 
                    project.id,
                    project.name
                FROM project 
                INNER JOIN project_cstm ON project_cstm.id_c = project.id
                WHERE
                 ((project_cstm.start_date_c BETWEEN '".$week_array[0]."' AND '".$week_array[7]."')
                OR (project_cstm.end_date_c BETWEEN '".$week_array[0]."' AND '".$week_array[7]."'))
                AND project.deleted = '0'
                GROUP BY project.id";
        // echo $query;exit();
        // print_r($connection);exit();
        // echo strstr($week_array[0], ' ');exit();
        $query=$connection->prepare($query);
        $query->execute();

        // while () {
        //  # code...
        // }
        $data = '';
        // print_r($week_array);exit();
        while($row = $query->fetch()){
            
            $data .= '<tr>';
            $data .= '<td>'.$row['name'].'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[0], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[1], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[2], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[3], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[4], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[5], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[6], $connection).'</td>';
            $data .= '<td>'.$this->getOccupied($row['id'], $week_array[7], $connection).'</td>';
            $data .= '</tr>';
        }

        return $data;

    }


    public function getOccupied($id, $date, $connection)
    {
        $query="SELECT 
                    project.name as project_name,
                    SUM(CASE WHEN scrm_accommodation_cstm.accommodation_type_c = 'Executive Hostel' THEN 1 ELSE 0 END) AS eh
                FROM project
                INNER JOIN project_cstm ON project.id = project_cstm.id_c
                INNER JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida = project.id
                LEFT JOIN scrm_accommodation ON scrm_accommodation.id = project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb
                LEFT JOIN scrm_accommodation_cstm ON scrm_accommodation_cstm.id_c = scrm_accommodation.id
                WHERE project.deleted = '0'
                AND project_scrm_accommodation_1_c.deleted = '0'
                AND scrm_accommodation.deleted = '0'
                AND date(scrm_accommodation_cstm.check_in_c) <= '{$date}'  
                AND date(scrm_accommodation_cstm.check_out_c) >= '{$date}'
                AND scrm_accommodation.deleted = '0'
                AND project.id = '{$id}'
                ";
        // echo $query; exit();

        $query=$connection->prepare($query);
        $query->execute();

        $row = $query->fetch();
        if (!$row['eh']) {
            return 0;
        }
        return $row['eh'];
    }

    function display() {
            $ss = new Sugar_Smarty();
            //assign variables
            // $ss->assign('greeting', $this->dashletStrings['LBL_GREETING']);
            // $ss->assign('id', $this->id);
            // $ss->assign('height', $this->height);
            echo <<<EOD
                <style>
                    @media (min-width: 1200px){
                        .container2 {
                            width: 736px !important;
                            overflow-x: scroll !important;
                        }
                    }

                </style>
                <script>
                $(document).ready(function(){
                    $('#dashletPanel').hide();
                });
                </script>
EOD;
        global $sugar_config,$db,$current_user;
        $dateFormat = $current_user->getPreference('datef');;
        $url = $sugar_config['site_url'];   

        require_once('custom/modules/AOS_Contracts/database.php');
        
        if (!isset($_POST['to_date']) || !$_POST['to_date']) {
                $date = date('d-m-Y');
        }else{
            $date = $_POST['to_date'];          
        }
        $str = '';
        $my_date = $date; 
        $week = date("W", strtotime($my_date)); // get week
        $y =    date("Y", strtotime($my_date)); // get year
        $first_date =  date('d-m-Y',strtotime($y."W".$week)); //first date 
        $first_date = date('d-m-Y', strtotime($first_date."-2 day"));
         // echo $first_date;exit();
        $first_date = strtotime($first_date);
        $week_array = array();
        for($i=0 ;$i<=7; $i++) {
              $week_array[] = date('l d-m-Y', strtotime("+ {$i} day", $first_date));
        }

        for($i=0 ;$i<=7; $i++) {
              $week_array2[] = date('Y-m-d', strtotime("+ {$i} day", $first_date));
        }       

        $str .= '
            <form name = "run" method = "post" action = "" style="margin-top:50px">
             
            <div style = "background-color:#EEE">
            <br>
            <center>
            <h2>WEEKLY OCCUPANCY STATEMENT</h2>
            <br>
            <table width="50%">
                <tr>
                    <td>Date</td>
                    <td>
                        <input type = "text" name = "to_date" id = "to_date" value="'.$_POST["to_date"].'"><img border="0" src="themes/SuiteR/images/jscalendar.gif" id="frb" align="absmiddle" />
                        <script type="text/javascript">
                            Calendar.setup({inputField   : "to_date",
                            ifFormat      :    "%d-%m-%Y",
                            button       : "frb",
                            align        : "right"});
                        </script>
                    </td>                   
                </tr>
            </table>
            </center>
            <br>
            <div class="text-center">
            <button type="submit" name="state" class="btn btn-primary">Run</button>
            &nbsp&nbsp&nbsp&nbsp
            <button id="clear"  class="btn btn-primary">Clear</button>          
            <div>
            </div>
            </form>
            ';           
    
        $data = '';
        $data .= '<table id="" class="display example" class="table table-bordered" cellspacing="0" width="100%">';
        $data .= '<thead>';
        $data .= '<tr>';
        $data .= '<td>Project Name</td>';
        foreach ($week_array as $key => $value) {
            $data .= '<td>'.str_replace(' ', '<br>', $value).'</td>';
        }
        $data .= '</tr>';
        $data .= '</thead>';
        $data .= '<tbody>';
        $data .= $this->programmeData('sadsad', $week_array2, $connection);
        $data .= '</tbody>';
        $data .= '</table>';    

// print_r(error_get_last());exit();
// echo $temp_data;exit();
     $html =<<<HTML

            <style>
                td,th
                { text-align:center !important;}
                @media (min-width: 1200px)
                .container2 {
                    width: 736px!important;
                    overflow-x: scroll!important;
                }

            </style>
            <link rel="stylesheet" href="custom/modules/AOS_Contracts/Report.css" type="text/css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0"/>

            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-flash-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
            <script type="text/javascript" language="javascript" class="init">


        $(document).ready(function() {
            $('.example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ]                       
            } );
        } );


            </script>

            <div class="container2" style="padding-top:40px">
                <section>
                    $data
                </section>
            </div>
         <script>
          $(document).ready(function(){
            $("#clear").click(function(){
                    $("select option").removeAttr("selected");
                    $("#from_date").val("");
                    $("#to_date").val("");
                    return false;
                }); 
            $("#showquery").click(function(){
                $('#showq').toggle();
                    return false;
                });
            });
          </script>

            
HTML;
            
            $str .= $html;
            return parent::display().$str; // return parent::display for title and such
        }

    // function process($lvsParams = array()) {
    //         global $timedate, $current_user;
    //         $format = $timedate->get_date_time_format($current_user);
    //         $dbformat = date('Y-m-d H:i:s', strtotime(date($format)));
    // // MYSQL database
    //         $lvsParams['custom_where'] = ' AND DATE_FORMAT(tasks.date_start, "%Y-%m-%d %H:%i:%s") <= "'.  $dbformat.'" ';
    //         // MSSQL 
    // // $lvsParams['custom_where'] = " AND REPLACE(CONVERT(varchar, tasks.date_start,111),'/','-') = '".$dbformat."')";
    //         parent::process($lvsParams);
    //      } 
}


?>
