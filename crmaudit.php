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

//By Rathina Ganesh
//Date: 03rd June 2017
ini_set("display_errors", 'On');
require_once('config.php');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
if(file_exists('include/tcpdf/config/lang/eng.php')) {
	include_once('include/tcpdf/config/lang/eng.php'); 
} else {
	die('TCPDF lang not found');
}
if(file_exists('include/tcpdf/config/tcpdf_config.php')) {
	include_once('include/tcpdf/config/tcpdf_config.php');
} else {
	die('TCPDF config not found');
}
if(file_exists('include/tcpdf/tcpdf.php')) {
	include_once('include/tcpdf/tcpdf.php');
} else {
	die('TCPDF not found');
}


//pdf for crmaudit
class CRMAudit extends TCPDF {
	protected $from_date;
	protected $to_date;
    
	
	public function printPdf($from_date,$to_date) {
        // global $db;
		global $current_user,$app_list_strings,$sugar_config;

       
        $db = DBManagerFactory::getInstance();
		// create new PDF document
		$pdf = new CRMAudit(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Rathina Ganesh');
		$pdf->SetTitle('PDF');
		$pdf->SetSubject('PDF');
		$pdf->SetKeywords('TCPDF, PDF, PDF, custom PDF');
		$pdf->SetFont('helvetica', '', 8, '', true);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 40,'','');
			// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetFooterMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		//~ $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		

		// Add a page
		$pdf->AddPage();
		//~ $pdf->setPrintHeader(false);
        $from_date = $from_date;
        $to_date = $to_date;

        $module_list = $GLOBALS['moduleList'];

        $module_list = array("Accounts","Contacts","Leads");
        $module_list = array_map('strtolower', $module_list);

        $loggedinquery="SELECT logged_in_date as Logged_In_Date,count(user_id) as Unique_Users
                FROM users_audit ua where date(logged_in_date) BETWEEN '$from_date' and '$to_date' 
                group by logged_in_date";
        $query=$db->query($loggedinquery);
        while($row=$db->fetchByAssoc($query)){
            $data['loggedin'][$row['Logged_In_Date']] = $row['Unique_Users'];
        }

       	foreach ($module_list as $module) {
       		$recordCreatedQuery="SELECT COUNT( m.id ) AS count, DATE( m.date_entered ) AS Date_Entered
                    FROM $module m
                    WHERE m.deleted =0 and date(m.date_entered) BETWEEN '$from_date' and '$to_date' 
                    GROUP BY DATE( m.date_entered ) ";
	        $query=$db->query($recordCreatedQuery);
	        while($row=$db->fetchByAssoc($query)){
	            $data[$module][$row['Date_Entered']] = $row['count'];
	        }
       	}
       
        // $module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));
       

        $begin = new DateTime( $from_date);
        $end = new DateTime( $to_date );

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $csvHeader = '';
        $header = '<tr><th align="center">Date</th>
            <th align="center"># of Unique Logins</th>';
        $csvHeader .= '"Date","# of Unique Logins",';
        foreach ($module_list as $module) {
        	
            $header .= '<th align="center"># of New '.ucwords($module).'</th>';
            $csvHeader .= '"# of New ' . ucwords($module). '",';
        }
        $header .= '</tr>';
        $csvHeader .= "\n";

        $csvRow ='';
        foreach ( $period as $dt )
        {
            $date = $dt->format( "Y-m-d" );
            $tableRow .='<tr>';
            $tableRow .='<td align="center">'.$dt->format( "dS F Y (l)" ).'</td>';
            $csvRow .= '"' . $dt->format( "dS F Y (l)" ) . '",';
            $tableRow .='<td align="center">'.(!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') .'</td>';
            $csvRow .= '"' . (!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') . '",';
            foreach ($module_list as $module) {
            	$tableRow .='<td align="center">'.(!empty($data[$module][$date]) ? $data[$module][$date] : '0') .'</td>';
            	$csvRow .= '"' . (!empty($data[$module][$date]) ? $data[$module][$date] : '0') . '",';
            }
            $tableRow .='</tr>'; 
            $csvRow .= "\n";
        }
    ob_clean();
 //    header('Content-type: application/csv');
	// header('Content-Disposition: attachment; filename=crmaudit.csv');
	$csv = $csvHeader . $csvRow;
	file_put_contents("crmaudit.csv", $csv, LOCK_EX);
    $html =<<<HTML
        <!DOCTYPE html>
        <html>
        <head>

            
        </head>

        <body>
            <div style="padding-top:40px">
                <section>
                    

                    <table id="example" class="display" border="1" cellspacing="0" width="100%">
                            $header

                        <tbody>
                    $tableRow
                        </tbody>
                    </table>

                    
                        </div>

                    </div>
                </section>
            </div>

        </body>
       
        </html>
            
HTML;

		$pdf->writeHTML($html, true, false, false, false, '');
		ob_clean();		 	
        $pdf->Output('crmaudit.pdf', 'F');
		// $pdf->Output('crmaudit.pdf', 'I');

		require_once('modules/Emails/Email.php');
		require_once('include/SugarPHPMailer.php');
		include_once('include/utils/db_utils.php'); 
		$emailObj = new Email();
		$email = 'ganesh@simplecrm.com.sg';
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$mail->From = $current_user->email1;
		$mail->FromName = $current_user->full_name;
		$mail->Subject = 'CRM Audit';
		$mail->Body = 'Hi,<br><br> Please find the attached crm audit from '.$from_date.' to '.$to_date;
		$mail->isHTML(true);
		$mail->prepForOutbound();
		$mail->AddAddress($email);
		$mail->AddAttachment('crmaudit.pdf', 'crmaudit.pdf', 'base64', 'application/pdf');
		$mail->AddAttachment('crmaudit.csv', 'crmaudit.csv', 'base64', 'application/csv');
		// Prepare for sending
		$mail->prepForOutbound();
		$mail->setMailerForSystem();

		$mail->Send();
		
		
		
	}

	// public function fetchRecordCountByModule($module){
	// 	//For Generating dynamic query

	// 	$bean = BeanFactory::newBean($module);

	// 	$order_by = '';
	// 	$where = '';
	// 	$fields = array(
	// 	    'id',
	// 	    'date_entered',
	// 	    'name',
	// 	);

	// 	return $sql = $bean->create_new_list_query($order_by, $where, $fields);

	// }
	
}
$from_date = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : date('Y-m-')."1";
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y-m-d');
$pdf = new CRMAudit();
$pdf->printPdf($from_date,$to_date);
?>
