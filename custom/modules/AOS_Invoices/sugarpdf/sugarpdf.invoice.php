<?php
/**************************
Invoice PDF for LOP
Author: Rathina Ganesh
Date: 30th may 2017
**************************/

//ini_set('display_errors','On');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ob_start();
require_once('include/Sugarpdf/Sugarpdf.php');

class AOS_InvoicesSugarpdfinvoice extends Sugarpdf
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

    /**
     * Custom header
     */
    public function Footer()
    {
        $this->SetFont(PDF_FONT_NAME_MAIN, '', 8);
        $this->MultiCell(0,0,'TCPDF Footer', 0, 'C');
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
                $plural = (($counter = count($str)) && $number > 9) ? '' : null;
                $hundred = ($counter == 1 && $str[0]) ? 'and ' : null;
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
          
          $paise = ($point) ? "" . ($words[$point / 10] . "" . $words[$point % 10]) . ' Paise' : '';
          return rtrim($result);
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
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:26px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:26px">Phone: +91-40- 66534224, Tele. Fax: +91-40- 66534356</td></tr>
          <tr><td align="center" style="font-size:26px">e-mail: income@asci.org.in</td></tr>
          </table>
EOD;
        $this->writeHTML($headerData, true, false, false, false, '');
        // $this->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $this->Ln();

        $record_id = $_REQUEST['record'];
        $invoice = BeanFactory::getBean('AOS_Invoices', $record_id);
        $programme = $invoice->get_linked_beans('project_aos_invoices_1','AOS_Invoices');
        $start_date_c = $programme[0]->start_date_c;
        $end_date_c = $programme[0]->end_date_c;
        $programme_id_c = $programme[0]->programme_id_c; 
        $primaryDirector = $programme[0]->assigned_user_name; 
        $agreed_no_of_participants_c = $invoice->minimum_no_participant_c; 
        $scrm_partners_id_c = $programme[0]->scrm_partners_id_c; 
        $secondaryDirector = BeanFactory::getBean('scrm_Partners', $scrm_partners_id_c);
        $secondaryDirector = $secondaryDirector->name;
        $PDs = $primaryDirector;
        if(!empty($secondaryDirector)){
            $PDs = $primaryDirector.", ".$secondaryDirector;
        }
        $duration = date('F d',strtotime($start_date_c))." - ".date('d',strtotime($end_date_c)).", ".date('Y',strtotime($start_date_c));
        $participantList = json_decode(html_entity_decode($invoice->participant_list_c));
        $programme_type_c = $invoice->programme_type_c;        
        // $sub = $invoice->name;
        // $number = $invoice->number;
        $noOfDays = $invoice->no_of_days_c;
        $invoice_number = $invoice->invoice_reference_no_c;
        $special_note_c = $invoice->special_note_c;
        $adjustment_note_c = $invoice->adjustment_note_c;
        if($adjustment_note_c){
            $adjustment_note_c = '( '.$adjustment_note_c.' )';
        }
        $note_c = $invoice->note_c;
        if($special_note_c == 'Yes'){
            $special_note = '<tr>
                <td align="left">
                   Note : '.$note_c.'
                </td>
            </tr>';
        }else{
            $special_note = '';
        }
        $client_gst1_c = $invoice->client_gst1_c;
        $place_of_supply_c = $invoice->place_of_supply_c;
        $ref = $invoice->description;
        $invoice_date = $invoice->invoice_date;
        $pan_c = $invoice->pan_c;
        $regd_no_c = $invoice->regd_no_c;
        $category_c = $invoice->category_c;
        $currency_id = $invoice->currency_id;
        $bank_c = $invoice->bank_c;
        $billing_account = $invoice->billing_account;
        $billing_address_street = $invoice->billing_address_street;
        $billing_address_city = $invoice->billing_address_city;
        $billing_address_state = $invoice->billing_address_state;
        $billing_address_country = $invoice->billing_address_country;
        $billing_address_postalcode = $invoice->billing_address_postalcode;
        $kind_attention_c = explode("-", $invoice->kind_attention_c);
        if(count($kind_attention_c) == 2){
            $kindAttention ='<tr>
                            <td>
                               &nbsp;<b><u>Kind.Attn:</u> &nbsp;&nbsp;'.$kind_attention_c[0].'</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$kind_attention_c[1].'</b>
                            </td> 
                        </tr>';
        }else{
            $kindAttention ='<tr>
                            <td>
                               &nbsp;<b><u>Kind.Attn:</u> &nbsp;&nbsp;'.$kind_attention_c[0].'</b> 
                            </td> 
                        </tr>';
        }
        $no_of_participants_c = $invoice->no_of_participants_c;
        $additionalParticipants = $no_of_participants_c - $agreed_no_of_participants_c;
        $state_code_c = substr($client_gst1_c, 0,2);
        // $programme_fee_c = money_format('%!n',str_replace(',','',number_format((float)$invoice->programme_fee_c,2)));
        $programme_fee_c = money_format('%!.0n',round($invoice->programme_fee_c))."&nbsp;";
        // $programme_fee_non_res_c = money_format('%!n',str_replace(',','',number_format((float)$invoice->programme_fee_non_res_c,2)));
        $programme_fee_non_res_c = money_format('%!.0n',round($invoice->programme_fee_non_res_c))."&nbsp;";
        $project_aos_invoices_1_name = $invoice->project_aos_invoices_1_name;
        // $total_amt = money_format('%!n',str_replace(',','',number_format((float)$invoice->total_amt,2)));
        $total_amt = money_format('%!.0n',round($invoice->total_amt))."&nbsp;";
        // $less_adjustments_c = money_format('%!n',str_replace(',','',number_format((float)$invoice->less_adjustments_c)));
        $less_adjustments_c = money_format('%!.0n',round($invoice->less_adjustments_c))."&nbsp;";
      
        // $subtotal_amount = money_format('%!n',str_replace(',','',number_format((float)$invoice->subtotal_amount,2)));
        $subtotal_amount = money_format('%!.0n',round($invoice->subtotal_amount))."&nbsp;";
        // $tax_amount = money_format('%!n',str_replace(',','',number_format((float)$invoice->tax_amount,2)));
        $tax_amount = money_format('%!.0n',round($invoice->tax_amount))."&nbsp;";
        // $total_amount = money_format('%!n',str_replace(',','',number_format((float)$invoice->total_amount,2)));
        $total_amount = money_format('%!.0n',round($invoice->total_amount))."&nbsp;";
        $res = 0;
        $nres = 0;
        foreach($participantList as $part){
            if($part->type == 'Residential'){
                $res++;
            }else{
                $nres++;
            }
        }
        $totalLOP = $res+$nres;
        $residentTotalFee = money_format('%!.0n',round($invoice->programme_fee_c * $res))."&nbsp;";
        $nonResidentTotalFeetotalFee = money_format('%!.0n',round($invoice->programme_fee_non_res_c * $nres))."&nbsp;";
        $totalAmountAndLessAdj = $invoice->total_amount + $invoice->less_adjustments_c;
        // $totalAmountAndLessAdj = money_format('%!n',str_replace(',','',number_format((float)$totalAmountAndLessAdj)));
        $totalAmountAndLessAdj = money_format('%!.0n',round($totalAmountAndLessAdj))."&nbsp;";
          if(!empty((int)$invoice->less_adjustments_c)){
             $lessAdjustment = '<tr>
                            <td colspan="3" align="right" width="100%">
                                Sub Total&nbsp;
                            </td>
                            <td colspan="1" align="right" width="100%">
                                '.$totalAmountAndLessAdj.'
                            </td>
                            </tr>
                            <tr> 
                                <td colspan="3" align="left" width="100%">
                                   &nbsp;&nbsp;Less: Adjustments '.$adjustment_note_c.'
                                </td>
                                <td colspan="1" align="right" width="100%">
                                        '.$less_adjustments_c.'
                                </td> </tr>
                                ';
        }
		/* Added by ashvin
		   Date:13-11-2018
		   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
		   Ticket Id:3784
		   Start
		*/		
		$refundToClient="";
		
		if((int)$invoice->total_amount<0){
			
			$refundToClient='<tr>
				<td colspan="3" align="right" width="100%">
					Refund to Client&nbsp;
				</td>
				<td colspan="1" align="right" width="100%">
					'.str_replace('-','',$total_amount).'
				</td>
			</tr>';
		}		
		/* Added by ashvin
		   Date:13-11-2018
		   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
		   Ticket Id:3784
		   End
		*/
        // $cgst = money_format('%!n',str_replace(',','',number_format((float)$invoice->cgst_c,2)));
        $cgst = money_format('%!.0n',round($invoice->cgst_c))."&nbsp;";
        // $sgst = money_format('%!n',str_replace(',','',number_format((float)$invoice->sgst_c,2)));
        $sgst = money_format('%!.0n',round($invoice->sgst_c))."&nbsp;";
        // $igst = money_format('%!n',str_replace(',','',number_format((float)$invoice->igst_c,2)));
        $igst = money_format('%!.0n',round($invoice->igst_c))."&nbsp;";
        // $ugst = money_format('%!n',str_replace(',','',number_format((float)$invoice->ugst_c,2)));
        $ugst = money_format('%!.0n',round($invoice->ugst_c))."&nbsp;";
        $discount_amount = money_format('%!.0n',round($invoice->discount_amount))."&nbsp;";
        $discount_in_per = $invoice->discount_in_per_c == '' ? 0 : number_format((float)$invoice->discount_in_per_c);
        $sub = $project_aos_invoices_1_name;
        $discount_table = '';
        // print_r($discount_in_per_c);exit();ac
       
        // $this->SetFont(PDF_FONT_NAME_MAIN, '', 12);
		$total_str_amount=str_replace('-','',$invoice->total_amount); // Added by ashvin
        $f = new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
        $amountInWords = ucwords($f->format($total_str_amount));
        // $am = number_format($invoice->total_amount,2);
        $am = money_format('%!.0n',round($total_str_amount))."&nbsp;";
// print_r(ucwords($this->getIndianCurrency(floatval(str_replace(',', '', $am)))));exit;
        // if ($currency_id == "-99") {
        if(!empty((int)$total_str_amount)){ 
            $amountInWords = str_replace("And", "and", ucwords($this->getIndianCurrency(floatval(str_replace(',', '', $am)))));
        }else{
            $amountInWords = "Zero"; 
        }
        // }

        //check for igst ;
        //if the state is same then igst should be 0 otherwise igst = cgst + sgst 
        //and cgst = sgst = 0
          
        $cgst_rate = 9;
        $sgst_rate = 9;
        $igst_rate = 18;
        $ugst_rate = 9;

        $signature = $sugar_config['bank']['signature']['invoice'];

        $supplementary_invoice = '';
        if ($invoice->invoice_type_c == 'Supplementary') {
            $supplementary_invoice = "
                <table width='100%' border='1' style='font-size:26px;border:1px solid #000!important' cellpadding='0'>
                            <tr>
                                <td style='border:1px solid #000;' colspan='3'>Accommodation</td>
                                <td style='border:1px solid #000;' > {$invoice->accommodation_c}</td>
                            </tr>
                            <tr>
                                <td style='border:1px solid #000;' colspan='3'>Living Allowance</td>
                                <td style='border:1px solid #000;'>{$invoice->living_allowance_c}</td>
                            </tr>
                            <tr>
                                <td style='border:1px solid #000;' colspan='3'>Other Reimbursement</td>
                                <td style='border:1px solid #000;'>{$invoice->other_reimbursement_c}</td>
                            </tr>
                </table>
            ";        
        }           



        $invoice_table = '<table width="100%" border="1" style="font-size:26px" cellpadding="0" align="center">
                        <tr>
                            <td>Tax Description</td>
                            <td>Tax Rate</td>
                            <td>Tax Amount</td>
                        </tr>';

        
        
          if (strpos($invoice->tax_type_c,'CGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td align='left'>
                       Central GST (CGST)
                    </td>
                    <td>
                       $cgst_rate%
                    </td>
                    <td align=\"right\">
                       $cgst
                    </td>
                </tr>
            ";
        }

        if (strpos($invoice->tax_type_c, 'SGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td align='left'>
                       State GST (SGST)
                    </td>
                    <td>
                       $sgst_rate%
                    </td>
                    <td align=\"right\">
                       $sgst
                    </td>
                </tr>
            ";
        }

        if (strpos($invoice->tax_type_c, 'IGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td align='left'>
                       Integrated GST (IGST)
                    </td>
                    <td>
                        $igst_rate%
                    </td>
                    <td align=\"right\">
                       $igst
                    </td>
                </tr>
            ";
        }

        if (strpos($invoice->tax_type_c, 'UGST') !== false) {
            $invoice_table .= "
               <tr>
                    <td align='left'>
                       UTGST
                    </td>
                    <td>
                        $ugst_rate%
                    </td>
                    <td align=\"right\">
                       $ugst
                    </td>
                </tr>
            ";
        }     


        $invoice_table .= '</table>';   
        if($invoice->client_type_c != 'Government Department'){
            $invoiceTaxTable = <<<invoice
    <tr>
                    <td colspan="3"  width="100%">
                        {$invoice_table}
                    </td>
                    <td colspan="1"  align="center"  width="100%" border="0">
                         <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    $tax_amount
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
invoice;
}else{

}
        if($currency_id == "-99"){
            $currency_name = 'Rs.&nbsp;';
            $currency_word = 'Rupees';
            $currency_word_abbr = '(INR)';
        }else if($currency_id == "5d3103c2-4a19-b7bf-75da-592586ee4aec"){
            $currency_name = 'US $&nbsp;';
            $currency_word = 'US Dollars';
            $currency_word_abbr = '(US $)';
        }

            
        if($bank_c == "India"){
            
            $bankDetailsGenerate = '';
            foreach ($sugar_config['bank']['inr'] as $key => $value) {
                $bankDetailsGenerate .= "<tr>";
                $bankDetailsGenerate .= "<td width='80%'>&nbsp;&nbsp;";
                $bankDetailsGenerate .= $key;
                $bankDetailsGenerate .= "</td>";
                $bankDetailsGenerate .= "<td width='120%'>&nbsp;&nbsp;";
                $bankDetailsGenerate .= $value;
                $bankDetailsGenerate .= "</td>";
                $bankDetailsGenerate .= "</tr>";
            }
            $bankDetails = ' <table width="100%" border="0" style="font-size:26px" cellpadding="0">
        
        </table>
        <br>
        <table width="100%" border="1" style="font-size:26px" cellpadding="0">
            <tr>
                <td colspan="2" align="center">
                    <b>B A N K  D E T A I L S</b>
                </td>
            </tr>
            '.$bankDetailsGenerate.'

        </table>
        <table width="100%" border="0" style="font-size:26px" cellpadding="0">
           
            <tr>
                <td align="left">
                </td>
            </tr>
            '.$special_note.'
            <tr>
                <td align="right">
                    for Administrative Staff College of India
                </td>
            </tr>

            <tr>
                <td align="right">
                    
                </td>
            </tr>
                        
            <tr>
                <td align="right">
                    <b>'.$sugar_config['bank']['signature']['invoice'].'</b>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Finance Officer</b>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" style="font-size:26px" cellpadding="0">
            <tr>
                <td>
                   <b><u>Note</u>:</b> Kindly share the payment details to email id income@asci.org.in
                </td>
            </tr>
        </table>';
        }
        else if($bank_c == "Foreign"){
            
            $bankDetailsGenerate = '';
                    foreach ($sugar_config['bank']['usd'] as $key => $value) {
                        $bankDetailsGenerate .= "<tr>";
                        $bankDetailsGenerate .= "<td width='80%'>&nbsp;&nbsp;";
                        $bankDetailsGenerate .= $key;
                        $bankDetailsGenerate .= "</td>";
                        $bankDetailsGenerate .= "<td width='120%'>&nbsp;&nbsp;";
                        $bankDetailsGenerate .= $value;
                        $bankDetailsGenerate .= "</td>";
                        $bankDetailsGenerate .= "</tr>";
                    }
            // $bankDetailsGenerate = '';
            // foreach ($sugar_config['bank']['usd'] as $key => $value) {
            //     $bankDetailsGenerate .= "<tr>";
            //     if (strpos($key,'Correspondent Bank') !== false && strpos($key,'Chips') === false && strpos($key,'Fedwire') === false) {
            //         $bankDetailsGenerate .= '<td rowspan="3">';
            //         $bankDetailsGenerate .= $key;
            //         $bankDetailsGenerate .= '</td>';
            //     }else{
            //         if (strpos($key,'Correspondent Bank') === false){
            //             $bankDetailsGenerate .= '<td>';
            //             $bankDetailsGenerate .= $key;
            //             $bankDetailsGenerate .= '</td>';  
            //         }
            //     }

            //     $bankDetailsGenerate .= '<td>';
            //     $bankDetailsGenerate .= $value;
            //     $bankDetailsGenerate .= '</td>';
            //     $bankDetailsGenerate .= '</tr>';
            // }

            $bankDetails = ' <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                
                </table>
                <br>
                <table width="100%" border="1" style="font-size:26px" cellpadding="0">
                    <tr>
                        <td colspan="2" align="center">
                            <b>B A N K  D E T A I L S</b>
                        </td>
                    </tr>
                    '.$bankDetailsGenerate.'

                </table>
        <table width="100%" border="0" style="font-size:26px" cellpadding="0">
            <tr>
                        <td align="left">
                        </td>
                    </tr>
                    '.$special_note.'
                    <tr>
                        <td align="right">
                            for Administrative Staff College of India
                        </td>
                    </tr>

                    <tr>
                        <td align="right">
                            
                        </td>
                    </tr>
                                
                    <tr>
                        <td align="right">
                            <b>'.$signature.'</b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <b>Finance Officer</b>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                    <tr>
                        <td>
                           <b><u>Note</u>:</b> Kindly share the payment details to email id income@asci.org.in
                        </td>
                    </tr>
        </table>
        ';
        }

      
        if($invoice->invoice_type_c == 'Special'){
            require_once('specialtemplate.php');
        }else if($invoice->programme_type_c == 'Announced'){
            require_once('aptemplate.php');
        }else if($invoice->programme_type_c == 'ICTP-On Campus'){
            require_once('ictpontemplate.php');
        }else if($invoice->programme_type_c == 'ICTP-Off Campus'){
            require_once('ictpofftemplate.php');
        }
    }

    /**
     * Build filename
     */
    function buildFileName()
    {
        $this->fileName = 'invoice.pdf';
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