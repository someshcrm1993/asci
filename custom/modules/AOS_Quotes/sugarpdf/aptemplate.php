<?php 
$lops = '';
$amtSplit = '';
$res = 0;
$nres = 0;
foreach($participantList as $part){
    if($part->type == 'Residential'){
        $res++;
    }else{
        $nres++;
    }
}
/* Added by ashvin
   Date:13-11-2018
   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
   Ticket Id:3784
   Start
*/
$Amount_text='Amount';
if(!empty($refundToClient)) $Amount_text='Refundable Amount'; 
/* Added by ashvin
   Date:13-11-2018
   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
   Ticket Id:3784
   End
*/
if($res + $nres  >3){

     if ($discount_in_per != 0) {
        $discount_table = '
            <tr>
                <td colspan="4" align="" width="100%">
                    &nbsp;&nbsp;Less: Discount - '.$discount_in_per.'%
                </td>
            </tr>  
            <tr><td colspan="4"></td></tr>

                    <tr>
                        <td colspan="4" align="right" width="100%">
                            Sub Total&nbsp;&nbsp;
                        </td>
                    </tr>   
        ';
        $discount_amt_clm = '
        <tr>
            <td colspan="1"  align="right" width="100%">
                        '.$discount_amount.'
            </td>      
        </tr> 
        <tr><td colspan="1"></td></tr>
        <tr>
                        <td align="right" width="100%">
                            '.$subtotal_amount.'
                        </td>
                    </tr>  
                ';
    }

    $invoiceBody = <<<EOD
    <td colspan="3"  width="100%">
                <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td align="left" colspan="4">
                            &nbsp;&nbsp;Fee as per the annexure enclosed 
                        </td> 
                    </tr>
                    <tr><td colspan="4"></td></tr>
                    $discount_table   
                </table>
            </td>
            <td colspan="1"  align="center"  width="100%">
                <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                    <tr><td></td></tr>
                    <tr>
                        <td align="right">
                            $total_amt
                        </td>
                    </tr>
                    <tr><td></td></tr>
                    $discount_amt_clm
                    
                </table>
            </td>
EOD;

         
$invoice_data = <<<EOD
        <b align="center" style="font-size:26px">PROFORMA INVOICE</b><br>
       

        <table width="100%" border="1" style="font-size:26px" cellpadding="0">
        <tr>
            <td>    
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;PAN : <b>$pan_c</b>
                            </td> 
                        </tr>
                        
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice No : <b>$invoice_number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice Date : <b>$invoice_date</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Code : <b>$programme_id_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Director(s) : <b>$PDs</b>
                            </td> 
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$regd_no_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Tax is Payable on Reverse Charge: <b>{$invoice->tax_payable_c}</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>Telangana / 36</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Category : <b>Commercial Training & Coaching</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;SAC Code : <b>999293</b>
                            </td> 
                        </tr>
                    </table>
                </td>
        </tr>
        <tr>
                <td colspan="2" align="center">
                    <b>Details of Receiver (Billed to)</b>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="90%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;To: 
                            </td> 
                        </tr>
                        <tr>
                            <td width="100%">
                               &nbsp;<span style='word-wrap: break-word;word-break:break-all'><b>$billing_account</b></span>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_street</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_city - $billing_address_postalcode</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_state</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_country</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                
                            </td> 
                        </tr>
                        $kindAttention
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>$billing_address_state / $state_code_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$client_gst1_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Place of Supply : <b>$place_of_supply_c</b>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr> 
             <tr>
                <td>
                   <table width="90%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                    				&nbsp;Title: <b>$sub</b>
                    			</td>
                    		</tr>
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                                   &nbsp;From : <b>$start_date_c</b>
                                </td> 
                                <td>
                                   &nbsp;To:    <b>$end_date_c</b>
                                </td> 
                            </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="1" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td colspan="3" align="center"  width="100%">
                                Particulars
                            </td>
                            <td colspan="1"  align="center"  width="100%">
                                Amount $currency_word_abbr
                            </td>
                        </tr>
                        <tr>
                            $invoiceBody
                        </tr>
                        
                        $invoiceTaxTable
                        $lessAdjustment
                        <tr>
                            <td colspan="3" align="right" width="100%">
                                Grand Total&nbsp;
                            </td>
                            <td colspan="1" align="right" width="100%">
                                $total_amount
                            </td>
                        </tr>
						$refundToClient
                        <tr>
                            <td colspan="4" align="justify">
                                &nbsp;&nbsp;Total $Amount_text in Words ($currency_word $amountInWords Only)
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        
        $bankDetails
        
        
       
EOD;

        $this->writeHTML($invoice_data, true, false, false, false, '');
        $this->AddPage();
        $this->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->writeHTML($headerData, true, false, false, false, '');
        // $this->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $this->Ln();
$slno = 1;
 foreach($participantList as $participant){
    $participantType = ($participant->type == "NonResidential")? "Non Residential" : $participant->type;
        if($participant->type == 'NonResidential'){
            $fee = $programme_fee_non_res_c;
            $lops .= '<tr>
                                <td colspan="1" align="center"  width="100%">
                                    '.$slno.'
                                </td>
                                <td colspan="5" align="left"  width="100%">
                                    &nbsp;'.$participant->name.'
                                </td>
                                <td colspan="2"  align="center"  width="100%">
                                    '.$participantType.'
                                </td>
                                <td colspan="2"  align="right"  width="100%">
                                    '.$fee.'
                                </td>
                            </tr>';
                                $slno++;
        }                    
    }  
 foreach($participantList as $participant){
    $participantType = ($participant->type == "NonResidential")? "Non Residential" : $participant->type;
        if($participant->type == 'Residential'){
            $fee = $programme_fee_c;
            $lops .= '<tr>
                                <td colspan="1" align="center"  width="100%">
                                    '.$slno.'
                                </td>
                                <td colspan="5" align="left"  width="100%">
                                    &nbsp;'.$participant->name.'
                                </td>
                                <td colspan="2"  align="center"  width="100%">
                                    '.$participantType.'
                                </td>
                                <td colspan="2"  align="right"  width="100%">
                                    '.$fee.'
                                </td>
                            </tr>';
                                $slno++;
        }                       
    }  
                     $lops .= '<tr>
                            <td colspan="8" align="right"  width="100%">
                                <b>Sub Total</b>&nbsp;&nbsp;&nbsp;
                            </td>
                            <td colspan="2"  align="right"  width="100%">
                                '.$total_amt.'
                            </td>
                        </tr>';
        
$invoice_data = <<<EOD
        <b align="center" style="font-size:26px">ANNEXURE TO PROFORMA INVOICE</b><br>
       

        <table width="100%" border="1" style="font-size:26px" cellpadding="0">
        <tr>
            <td>    
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;PAN : <b>$pan_c</b>
                            </td> 
                        </tr>
                        
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice No : <b>$invoice_number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice Date : <b>$invoice_date</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Code : <b>$programme_id_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Director(s) : <b>$PDs</b>
                            </td> 
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$regd_no_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Tax is Payable on Reverse Charge: <b>{$invoice->tax_payable_c}</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>Telangana / 36</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Category : <b>Commercial Training & Coaching</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;SAC Code : <b>999293</b>
                            </td> 
                        </tr>
                    </table>
                </td>
        </tr>
        <tr>
                <td colspan="2" align="center">
                    <b>Details of Receiver (Billed to)</b>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="90%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;To: 
                            </td> 
                        </tr>
                        <tr>
                            <td width="100%">
                               &nbsp;<span style='word-wrap: break-word;word-break:break-all'><b>$billing_account</b></span>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_street</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_city - $billing_address_postalcode</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_state</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_country</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                
                            </td> 
                        </tr>
                        $kindAttention
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>$billing_address_state / $state_code_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$client_gst1_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Place of Supply : <b>$place_of_supply_c</b>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr> 
             <tr>
                <td>
                	<table width="90%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                    				&nbsp;Title: <b>$sub</b>
                    			</td>
                    		</tr>
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                                   &nbsp;From : <b>$start_date_c</b>
                                </td> 
                                <td>
                                   &nbsp;To:    <b>$end_date_c</b>
                                </td> 
                            </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="1" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td colspan="1" align="center"  width="100%">
                                <b>S No</b>
                            </td>
                            <td colspan="5" align="center"  width="100%">
                                <b>Name of the Participant</b>
                            </td>
                            <td colspan="2"  align="center"  width="100%">
                                <b>Status</b>
                            </td>
                            <td colspan="2"  align="center"  width="100%">
                                <b>Fees $currency_word_abbr</b>
                            </td>
                        </tr>
                        $lops
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" style="font-size:26px" cellpadding="0">
           
            <tr>
                <td align="left">
                </td>
            </tr>
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
                    <b>$signature</b>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Programmes Officer</b>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" style="font-size:26px" cellpadding="0">
            <tr>
                <td>
                   <b><u>Note</u>:</b> Kindly share the payment details to email id poffice@asci.org.in
                </td>
            </tr>
        </table>
EOD;
    $proformaPDF = 'proforma_'.date('YmdHis').'.pdf';    
    $_SESSION["proformaPDF"]= $proformaPDF;
    $this->writeHTML($invoice_data, true, false, false, false, '');
    $fp = fopen($sugar_config['upload_dir'].$proformaPDF,'wb');
    fclose($fp);
    $this->Output($sugar_config['upload_dir'].$proformaPDF,'F');

            }else{

                 if ($discount_in_per != 0) {
                    $discount_table = '
                        <tr>
                            <td colspan="4" align="" width="100%">
                                &nbsp;&nbsp;Less: Discount - '.$discount_in_per.'%
                            </td>
                        </tr>  
                        <tr>
                            <td colspan="4" align="right" width="100%">
                                Sub Total&nbsp;&nbsp;
                            </td>
                        </tr>      
                    ';
                    $discount_amt_clm = '
                    <tr>
                        <td colspan="1"  align="right" width="100%">
                                    '.$discount_amount.'
                        </td>      
                    </tr> 
                    <tr>
                        <td colspan="1" align="right" width="100%">
                            '.$subtotal_amount.'
                        </td>
                    </tr>  
                            ';
                }
                
                $slno = 1;
                if($res){
                    $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;Residential Participants</td></tr>";
                    $amtSplit .= "<tr><td></td></tr>";
                    foreach($participantList as $participant){
                        if($participant->type == 'Residential'){
                            $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;".$slno.". ".$participant->name." </td></tr>";
                            $amtSplit .= "<tr><td align=\"right\">".$programme_fee_c."</td></tr>";
                            $slno++;
                        }
                    } 
                }
                $slno = 1;
                if($nres){
                    $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;Non-Residential Participants</td></tr>";
                    $amtSplit .= "<tr><td></td></tr>";
                    foreach($participantList as $participant){
                        if($participant->type == 'NonResidential'){
                            $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;".$slno.". ".$participant->name." </td></tr>";
                            $amtSplit .= "<tr><td align=\"right\">".$programme_fee_non_res_c."</td></tr>";
                            $slno++;
                        }
                    } 
                }
                if(($res > 1 || $nres > 1) || ($res == 1 && $nres == 1)){ 
                    $displaySubTotal = ' <tr>    
                                    <td align="right" colspan="4">
                                        Sub Total&nbsp;&nbsp;
                                    </td>
                                </tr>';
                    $displaySubTotalAmount = '<tr>    
                                    <td align="right">
                                        '.$total_amt.'
                                    </td>
                                </tr>';
                }

                $invoiceBody = <<<EOD
                <td colspan="3"  width="100%">
                            <table width="100%" border="0" style="font-size:26px" cellpadding="0">

                                <tr>
                                    <td align="left" colspan="4">
                                        &nbsp;&nbsp;<u>Fee :</u>
                                    </td> 
                                </tr>
                                $lops
                                $displaySubTotal
                                $discount_table
                            </table>
                        </td>
                        <td colspan="1"  align="center"  width="100%">
                            <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                                <tr>
                                    <td>
                                        
                                    </td>
                                </tr>
                                $amtSplit
                                $displaySubTotalAmount
                                $discount_amt_clm
                            </table>
                        </td>
EOD;

$invoice_data = <<<EOD
        <b align="center" style="font-size:26px">PROFORMA INVOICE</b><br>
       

        <table width="100%" border="1" style="font-size:26px" cellpadding="0">
        <tr>
            <td>    
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;PAN : <b>$pan_c</b>
                            </td> 
                        </tr>
                        
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice No : <b>$invoice_number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Proforma Invoice Date : <b>$invoice_date</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Code : <b>$programme_id_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Programme Director(s) : <b>$PDs</b>
                            </td> 
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$regd_no_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Tax is Payable on Reverse Charge: <b>{$invoice->tax_payable_c}</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>Telangana / 36</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Category : <b>Commercial Training & Coaching</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;SAC Code : <b>999293</b>
                            </td> 
                        </tr>
                    </table>
                </td>
        </tr>
        <tr>
                <td colspan="2" align="center">
                    <b>Details of Receiver (Billed to)</b>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="90%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;To: 
                            </td> 
                        </tr>
                        <tr>
                            <td width="100%">
                               &nbsp;<span style='word-wrap: break-word;word-break:break-all'><b>$billing_account</b></span>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_street</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_city - $billing_address_postalcode</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_state</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;<b>$billing_address_country</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                
                            </td> 
                        </tr>
                        $kindAttention
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td>
                               &nbsp;State / Code : <b>$billing_address_state / $state_code_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;GSTIN: <b>$client_gst1_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Place of Supply : <b>$place_of_supply_c</b>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr> 
             <tr>
                <td>
                   <table width="90%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                    				&nbsp;Title: <b>$sub</b>
                    			</td>
                    		</tr>
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                            <tr>
                                <td>
                                   &nbsp;From : <b>$start_date_c</b>
                                </td> 
                                <td>
                                   &nbsp;To:    <b>$end_date_c</b>
                                </td> 
                            </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="100%" border="1" style="font-size:26px" cellpadding="0">
                        <tr>
                            <td colspan="3" align="center"  width="100%">
                                Particulars
                            </td>
                            <td colspan="1"  align="center"  width="100%">
                                Amount $currency_word_abbr
                            </td>
                        </tr>
                         <tr>
                            $invoiceBody
                        </tr>
                        

                        $invoiceTaxTable
                        $lessAdjustment
                        <tr>
                            <td colspan="3" align="right" width="100%">
                                Grand Total&nbsp;
                            </td>
                            <td colspan="1" align="right" width="100%">
                                $total_amount
                            </td>
                        </tr>
						$refundToClient
                        <tr>
                            <td colspan="4" align="justify">
                                &nbsp;&nbsp;Total $Amount_text in Words ($currency_word $amountInWords Only)
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>  
       $bankDetails
        
        
       
EOD;
        $proformaPDF = 'proforma_'.date('YmdHis').'.pdf';
        $_SESSION["proformaPDF"]= $proformaPDF;
        $this->writeHTML($invoice_data, true, false, false, false, '');
        $fp = fopen($sugar_config['upload_dir'].$proformaPDF,'wb');
        fclose($fp);
        $this->Output($sugar_config['upload_dir'].$proformaPDF,'F'); 

}