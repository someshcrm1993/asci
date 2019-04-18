<?php 
$lops = '';
$amtSplit = '';

/* Added by ashvin
   Date:13-11-2018
   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
   Ticket Id:3784
   End
*/
$Amount_text='Amount';
if(!empty($refundToClient)) $Amount_text='Refundable Amount';
/* Added by ashvin
   Date:13-11-2018
   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
   Ticket Id:3784
   End
*/

if($totalLOP < $agreed_no_of_participants_c){

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
$lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;Residential Participants: ($currency_name $programme_fee_c x $res)</td></tr>";
    $invoiceBody = <<<EOD
    <td colspan="3"  width="100%">
                <table width="100%" border="0" style="font-size:26px" cellpadding="0">
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td align="left" colspan="4">
                            &nbsp;&nbsp;Fee per participant @ $currency_name $programme_fee_c for $noOfDays days for a minimum of $agreed_no_of_participants_c participants. 
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
        <b align="center" style="font-size:26px">TAX INVOICE</b><br>
       

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
                               &nbsp;Tax Invoice No : <b>$invoice_number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Tax Invoice Date : <b>$invoice_date</b>
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
                    $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;Residential Participants: ($currency_name $programme_fee_c x $res)</td></tr>";
                    
                    $amtSplit .= "<tr><td align=\"right\">".$residentTotalFee."</td></tr>";
                }
                $slno = 1;
                if($nres){
                    $lops .= "<tr><td colspan=\"4\">&nbsp;&nbsp;Non-Residential Participants: ($currency_name $programme_fee_non_res_c x $nres)</td></tr>";
                    
                    $amtSplit .= "<tr><td align=\"right\">".$nonResidentTotalFeetotalFee."</td></tr>";
                    $subtotal = '<tr>    
                                    <td align="right" colspan="4">
                                        Sub Total&nbsp;&nbsp;
                                    </td>
                                </tr>'; 
                    $subtotalamt = '<tr>    
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
                                $subtotal
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
                                $subtotalamt
                                $discount_amt_clm
                            </table>
                        </td>
EOD;

$invoice_data = <<<EOD
        <b align="center" style="font-size:26px">TAX INVOICE</b><br>
       

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
                               &nbsp;Tax Invoice No : <b>$invoice_number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               &nbsp;Tax Invoice Date : <b>$invoice_date</b>
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

}