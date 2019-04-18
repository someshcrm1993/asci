<?php
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

class scrm_TimetableController extends SugarController{

	function action_sendTimetableToPO()
	{
        require_once('modules/EmailTemplates/EmailTemplate.php');
        include_once('include/utils/db_utils.php');
        global $db;

        $template = new EmailTemplate();
        $template->retrieve_by_string_fields(array('id' => '94d18c3a-8bff-8321-8728-594232fe2b13','type'=>'email'));
        
        $userBean = BeanFactory::getBean('Users','5eb35c29-8944-28f5-3f1c-59436623fb2e');
        $timetable = BeanFactory::getBean('scrm_Timetable',$_REQUEST['id']);
        
        $project = BeanFactory::getBean('Project',$timetable->project_scrm_timetable_1project_ida);

        //$sessions = $timetable->get_linked_beans('scrm_timetable_scrm_session_information_1');
        /*Somesh Bawane
        Dt.25/02/2018
        reason: Wrong query hence not getting records*/
        $query = "SELECT ssi.name, ssic.* FROM scrm_timetable_scrm_session_information_1_c stsci JOIN scrm_session_information_cstm ssic ON ssic.id_c = stsci.scrm_timetc7f4rmation_idb
        JOIN scrm_session_information ssi On ssi.id = ssic.id_c
        WHERE stsci.scrm_timetable_scrm_session_information_1scrm_timetable_ida = '".$_REQUEST['id']."' ORDER BY start_time_c";
        
        $result_dateentered = $db->query($query);
        $data = array();
        while ($row_dateentered = $db->fetchByAssoc($result_dateentered)) {
            $date = date_format(date_create($row_dateentered['start_time_c']),"d-m-Y");
            $data[$date][$key]['date'] = $row_dateentered['start_time_c'];
            $data[$date][$key]['start_time'] = date_format(date_create($row_dateentered['start_time_c']),"H:i");
            $data[$date][$key]['end_time'] = date_format(date_create($row_dateentered['end_time_c']),"H:i");
            $data[$date][$key]['session_name'] = $row_dateentered['name'];
            $data[$date][$key]['faculty_name'] = $row_dateentered['faculty_name_c'];
            unset($data[$date]['day_name']);
            usort($data[$date], array($this, 'cmp'));
            $data[$date]['day_name'] = date_format(date_create($row_dateentered['start_time_c']),"l");
        }
       
        /*Somesh Bawane
        Dt.25/02/2018
        reason: Wrong query hence not getting records*/
        
        /*foreach ($sessions as $key => $value) {
            // print_r($value->start_time_c);exit();
            $date = date_format(date_create($value->start_time_c),"d-m-Y");
            $data[$date][$key]['date'] = $value->start_time_c;
            $data[$date][$key]['start_time'] = date_format(date_create($value->start_time_c),"H:i");
            $data[$date][$key]['end_time'] = date_format(date_create($value->end_time_c),"H:i");
            $data[$date][$key]['session_name'] = $value->name;
            $data[$date][$key]['faculty_name'] = $value->faculty_name_c;
            unset($data[$date]['day_name']);
            usort($data[$date], array($this, 'cmp'));
            
            $data[$date]['day_name'] = date_format(date_create($value->start_time_c),"l");  
        }*/
       // ksort($data);
        $table = '';
        // $table .= header("Content-type: application/vnd.ms-word");
        // $table .= header("Content-Disposition: attachment;Filename=Timetable.doc");
        $file = $this->getDoc($data);
        file_put_contents("Timetable.doc", $file, LOCK_EX);
    
        //Parse Body HTMLcc
        $template->body_html = $template->parse_template_bean($template->body_html,$project->module_dir,$project);
        
        $this->sendEmail($template->subject,$template->body_html,$userBean->email1,$file);
        
		$queryParams = array(
            'module' => 'scrm_Timetable',
            'action' => 'DetailView',
            'record' => $_REQUEST['id'],
            'msg' => 'E-mail sent successfully to PO',
        );
        SugarApplication::redirect('index.php?' . http_build_query($queryParams));
		
    }

    public function sendEmail($subject,$body,$email,$file)
    {
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');
        $emailObj = new Email(); 

        $defaults = $emailObj->getSystemDefaultEmail(); 
        
        $mail = new SugarPHPMailer(); 

        $mail->setMailerForSystem(); 
        $mail->From = $defaults['email']; 
        $mail->FromName = $defaults['name']; 
        
        $mail->Subject = $subject; 
        $mail->Body = $body; 
        $mail->prepForOutbound(); 
        $mail->AddAddress($email);
        $mail->isHTML(true); 
        $mail->AddAttachment('Timetable.doc', 'Timetable.doc', 'base64', 'application/vnd.ms-word');
        @$mail->Send(); 
    }

    public function getDoc($data)
    {
        require_once('include/entryPoint.php');
        include_once('include/SugarPHPMailer.php');
        include_once('include/utils/db_utils.php');
        include('custom/include/language/en_us.lang.php');
        global $db,$body,$body_main,$app_list_strings;
        global $sugar_config,$app_list_strings;
        $table = '';        
            // $table .= header("Content-type: application/vnd.ms-word");
            // $table .= header("Content-Disposition: attachment;Filename=Timetable.doc");
        foreach ($data as $date => $sessions) {
            $table .= "<tr>";
            $table .= "<td style='text-align: center;'><div>{$sessions['day_name']}</div><div>{$date}</div></td>";
            foreach ($sessions as $key => $value) {
                if($key != 'day_name'){
                    $table .= "<td style='text-align: center;'><div class='session-mix-time'>{$value['start_time']} - {$value['end_time']}</div><div>{$value['session_name']}</div><div>-<small><strong>{$value['faculty_name']}</strong></small></div> </td>";
                }
            }
            $table .= "</tr>";
        }
        $projectBean = $_SESSION['project'];

        $prgdate = date_format(date_create($projectBean->start_date_c),"M d").' to '.date_format(date_create($projectBean->end_date_c),"M d, Y");
        $prgimg = $sugar_config["site_url"].'custom/modules/Project/asci_small_logo.jpg';
        $head = '<div align="center">
			
			<h4>ADMINISTRATIVE STAFF COLLEGE OF INDIA<br>BELLA VISTA : HYDERABAD - 500 082</h4>
						
		</div>';


        $html =<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Word Report</title>
<style>
<!--
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {
    font-size:12.0pt;
    font-family:"Times New Roman";}
@page Section1
    {size:595.3pt 841.9pt;
    margin: 28.8pt 42pt 19.6pt 20pt;}
div.Section1
    {page:Section1;}
  
  .temprow
  {
    border:1px solid #ff00000;
    height:220px;
  }
 
    .glyphicon-minus{
        color: red!important;
    }
    .right span:hover{
        cursor: pointer;
        /*background-color: #eee; */
    }

    table .glyphicon-plus{
        cursor: pointer;
        display: block!important;
        padding-bottom: 4px;
    }
    table td div span:hover{
        cursor: pointer;
        /*background-color: #2382D5; */
    }

    table td div .glyphicon-remove{
        padding-left: 4px!important;
    }

    .drop{
        padding: 0!important;
    }
    .w50{
        width: 50%!important;display: inline-block;
    }
    .w33{
        width: 33.3333333333%!important;display: inline-block;
    }

    .w25{
        width: 25%!important;display: inline-block;
    }
    .w100{
        width: 100%!important;
    }
    .session-data{
        border:1px solid #ddd;padding: 9px;;
    }
    .session-mix-time{
        font-size: 10px;
        width: auto;
        border-bottom: 1px solid #ddd;
        padding-left: 27px;
        padding-bottom: 2px;
    }
    .popover.clockpicker-popover{
        z-index: 9999;
    }
table#timetable_table{
        border: 1px solid #ddd;
}

-->
</style>
</head>
<body>
  <div class="Section1">
    <div class="MsoNormal">
        <div class="right">
        	$head
			<div align="center"><strong><span>Time Session</span></strong></div>
            <table id="timetable_table" class="table table-bordered table-responsive"  border="1">
                <tr>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<span>Day</span>/<span>Date</span>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	09:00 - 10:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	11:00 - 12:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	14:00 - 15:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;padding:5px;" width="200px">
						<strong>	16:00 - 17:30</strong>
					</td>
					<td style="border:1px solid #000;border-collapse: collapse;text-align: center;" width="200px">
						<strong>	18:00 - 19:30</strong>
					</td>
				</tr>

                $table
        
        </div>


   </div>
   </div>
</body>
</html>
EOD;
    return $html;
    }

    public function cmp($a, $b) {
        $val1 = strtotime($a['date']);
        $val2 = strtotime($b['date']);
      if ($val1 == $val2) {
        return 0;
      }

      return ($val1 < $val2) ? -1 : 1;
    }
}

?>
