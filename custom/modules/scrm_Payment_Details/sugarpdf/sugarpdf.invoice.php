<?php
/**************************
Invoice PDF for Payment
Author: Rathina Ganesh
Date: 4th Dec 2017
**************************/

// ini_set('display_errors','On');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ob_start();
require_once('include/Sugarpdf/Sugarpdf.php');

class scrm_Payment_DetailsSugarpdfpayment extends Sugarpdf
{
    /**
     * Override
     */
    function process(){
        $this->display();
        $this->buildFileName();
    }

    /**
     * Custom header
     */
    public function Header()
    {
        
    }

     public function getIndianCurrency($number)
    {
           $no = round($number);
           $point = round($number - $no, 2) * 100;
           $hundred = null;
           $digits_1 = strlen($no);
           $i = 0;
           $str = array();
           $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
           while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2; 
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
             } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          
          $paise = ($point) ? "" . ($words[$point / 10] . " " . $words[$point % 10]) . ' Paise' : '';
          return $result . "" . $points . $paise;
    }


    /**
     * Custom header
     */
    public function Footer()
    {
        $this->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $this->MultiCell(0,0,'TCPDF Footer', 0, 'C');
    }

    /**
     * Main content
     */
    function display()
    {
        setlocale(LC_MONETARY, 'en_IN');
        global $sugar_config;
        $this->AddPage();
        //add a display page
        $image_file = K_PATH_IMAGES.'company_logo.png';
        $this->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $headerData = <<<EOD
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:25px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:25px">Phone: 0091-040- 66533086, Tele. Fax: 0091-040- 23317237</td></tr>
          <tr><td align="center" style="font-size:25px">e-mail: fo@asci.org.in</td></tr>
          </table>
EOD;
        $this->writeHTML($headerData, true, false, false, false, '');
        $this->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $this->Ln();

        $record_id = $_REQUEST['record'];
        $invoice = BeanFactory::getBean('scrm_Payment_Details', $record_id);
        // $programme = $invoice->get_linked_beans('project_aos_invoices_1','AOS_Invoices');
        $invoice_number_c = $invoice->invoice_number_c;
        $fees_c = "Rs. ".number_format($invoice->fees_c + $invoice->tax_amount_c,2);
        $accounts_scrm_payment_details_1_name = $invoice->accounts_scrm_payment_details_1_name;
        $project_scrm_payment_details_1_name = $invoice->project_scrm_payment_details_1_name;
        $payment_date_c = date('d-F-Y',strtotime($invoice->payment_date_c));

        $am = number_format($invoice->fees_c + $invoice->tax_amount_c,2);
        $amountInWords = ucwords($this->getIndianCurrency(floatval(str_replace(',', '', $am))));

 $payment_data = <<<EOD
            <table width="100%" border="" style="font-size:30px" cellpadding="2">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>No     :   {$invoice_number_c}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Date   :   {$payment_date_c}</td>
            </tr>
            </table>
        <b align="center" style="font-size:35px"><u>R E C E I P T</u></b><br><br><br>
        <table width="100%" border="0" style="font-size:35px" cellpadding="4">
            <tr>
                <td>RECEIVED with thanks from  :</td>
                <td colspan=2>{$accounts_scrm_payment_details_1_name}</td>
            </tr>
            <tr>
                <td>The sum of Rupees                :</td>
                <td colspan=2>{$amountInWords}Only</td>
            </tr>
            <tr>
                <td>Towards                                  :</td>
                <td colspan=2><b>Fee for the programme on "{$project_scrm_payment_details_1_name}"</b></td>
            </tr>
            <tr>
                <td rowspan=2>Same Bank Transfer No.        :</td>
                <td colspan=2>Dated {$payment_date_c} Through</td>
            </tr>
            <tr>
                <td colspan=2>Branch</td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <table width="100%" border="" style="font-size:27px" cellpadding="2">
            <tr>
                <td></td>
                <td></td>
                <td>for Administrative Staff College of India</td>
            </tr>
        </table>
        <table width="100%" border="" style="font-size:27px" cellpadding="2">
            <tr>
                <td><u><b>{$fees_c}</b></u></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Cheques Subject to realisation</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
EOD;
        $this->writeHTML($payment_data, true, false, false, false, '');
    }

    /**
     * Build filename
     */
    function buildFileName()
    {
        $this->fileName = 'payment.pdf';
    }

    /**
     * This method draw an horizontal line with a specific style.
     */
    protected function drawLine()
    {
        $this->SetLineStyle(array('width' => 0.85 / $this->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(220, 220, 220)));
        $this->MultiCell(0, 0, '', 'T', 0, 'C');
    }
}
?>