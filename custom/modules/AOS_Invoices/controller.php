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

class AOS_InvoicesController extends SugarController{

	function action_sendInvoiceToPO()
	{
        require_once('modules/EmailTemplates/EmailTemplate.php');
    	

        $template = new EmailTemplate();
        $userBean = BeanFactory::getBean('Users','5eb35c29-8944-28f5-3f1c-59436623fb2e');
        $email = $userBean->email1;
        
        if (isset($_REQUEST['email_to']) && $_REQUEST['email_to'] == 'DOTP') {
            $userDOTPBean = BeanFactory::getBean('Users','e6c3eb5b-0918-80d5-d66e-5943b2b84660');
            $email = $userDOTPBean->email1; 
            $template->retrieve_by_string_fields(array('id' => '3108f764-8a67-2781-d5d0-59451a176374','type'=>'email'));
        }else{
            $template->retrieve_by_string_fields(array('id' => '61c56f2a-158c-4ebe-fa88-594230bd447d','type'=>'email'));            
        }

        //Parse Body HTMLcc
        $template->body_html = $template->parse_template_bean($template->body_html,$userBean->module_dir,$userBean);
        $this->generatePDF($_REQUEST['id']);
        

        $this->sendEmail($template->subject,$template->body_html,$email);

        SugarApplication::redirect('index.php?module=AOS_Invoices&action=DetailView&record='.$_REQUEST['id']);

    }

    public function sendEmail($subject,$body,$email)
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
        $mail->AddAttachment('custom/modules/AOS_Invoices/invoice.pdf', 'invoice.pdf', 'base64', 'application/pdf');
        // print_r($mail);exit();
        @$mail->Send(); 
    }

    public function generatePDF($id)
    {
        require_once 'include/Sugarpdf/Sugarpdf.php';

        // create the pdf and save to file system
        $pdf = new Sugarpdf();
       
        $pdf->AddPage();

        $image_file = K_PATH_IMAGES.'company_logo.png';
        $pdf->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $headerData = <<<EOD
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:30px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:30px">Phone: 0091-040- 66533086, Tele. Fax: 0091-040- 23317237</td></tr>
          <tr><td align="center" style="font-size:30px">e-mail: fo@asci.org.in</td></tr>
          </table>
EOD;
        $pdf->writeHTML($headerData, true, false, false, false, '');
        $pdf->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $pdf->Ln();
        
        $record_id = $id;
        $invoice = BeanFactory::getBean('AOS_Invoices', $record_id);
        $programme = $invoice->get_linked_beans('project_aos_invoices_1','AOS_Invoices');
        $start_date_c = $programme[0]->start_date_c;
        $end_date_c = $programme[0]->end_date_c; 
        $duration = date('F d',strtotime($start_date_c))." - ".date('d',strtotime($end_date_c)).", ".date('Y',strtotime($start_date_c));
        $participantList = json_decode(html_entity_decode($invoice->participant_list_c));
        $programme_type_c = $invoice->programme_type_c;        
        $sub = $invoice->name;
        $number = $invoice->number;
        $ref = $invoice->description;
        $invoice_date = $invoice->invoice_date;
        $pan_c = $invoice->pan_c;
        $regd_no_c = $invoice->regd_no_c;
        $category_c = $invoice->category_c;
        $currency_id = $invoice->currency_id;
        $billing_account = $invoice->billing_account;
        $billing_address_street = $invoice->billing_address_street;
        $billing_address_city = $invoice->billing_address_city;
        $billing_address_state = $invoice->billing_address_state;
        $billing_address_country = $invoice->billing_address_country;
        $billing_address_postalcode = $invoice->billing_address_postalcode;
        $kind_attention_c = $invoice->kind_attention_c;
        $no_of_participants_c = $invoice->no_of_participants_c;
        $programme_fee_c = number_format($invoice->programme_fee_c,2);
        $project_aos_invoices_1_name = $invoice->project_aos_invoices_1_name;
        $total_amt = number_format($invoice->total_amt,2);
        $tax_amount = number_format($invoice->tax_amount,2);
        $total_amount = number_format($invoice->total_amount,2);
        $s_t_c = number_format($invoice->s_t_c,2);
        $s_b_c = number_format($invoice->s_b_c,2);
        $k_k_c = number_format($invoice->k_k_c,2);
        // $this->SetFont(PDF_FONT_NAME_MAIN, '', 12);
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $amountInWords = ucwords($f->format($invoice->total_amount));

      

        if($currency_id == "-99"){
            $currency_name = 'Rs.&nbsp;';
            $currency_word = 'Rupees';
            $bankDetails = ' <table width="100%" border="0" style="font-size:30px" cellpadding="0">
            <tr>
                <td>
                    We will be grateful if you could send the payment to the undersigned, favoring "<b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b>" payable at Hyderabad or alternatively you could remit the payment by Direct Transfer to our Bank account as detailed below, at the earliest under intimation to us.
                </td>
            </tr>
        </table>
        <table width="100%" border="1" style="font-size:30px" cellpadding="0">
            <tr>
                <td colspan="2" align="center">
                    <b>B A N K D E T A I L S</b>
                </td>
            </tr>
            <tr>
                <td>
                   Bank Name 
                </td>
                <td>
                   State Bank of India
                </td>
            </tr>
            <tr>
                <td>
                   Address line 1 
                </td>
                <td>
                   6-3- 1092, Ist floor, A Block
                </td>
            </tr>
            <tr>
                <td>
                   Address line 2 
                </td>
                <td>
                   Bella Vista Branch
                </td>
            </tr>
            <tr>
                <td>
                   Address line 3
                </td>
                <td>
                   Hyderabad – 500 082
                </td>
            </tr>
            <tr>
                <td>
                   Beneficiary Account Name
                </td>
                <td>
                   Administrative Staff College of India
                </td>
            </tr>
            <tr>
                <td>
                   Bank Account Number 
                </td>
                <td>
                   62090698675
                </td>
            </tr>
            <tr>
                <td>
                   Bank MICR No
                </td>
                <td>
                   500004008
                </td>
            </tr>
            <tr>
                <td>
                   NEFT IFSC Code
                </td>
                <td>
                   SBHY0020063
                </td>
            </tr>

        </table>
        <table width="100%" border="0" style="font-size:30px" cellpadding="0">
            <tr>
                <td align="left">
                    Thanking you,
                </td>
            </tr>
            <tr>
                <td align="right">
                    Yours sincerely,
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
                    
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Namrata Somani</b>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Finance Officer</b>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" style="font-size:30px" cellpadding="0">
            <tr>
                <td colspan="1">
                    <b><u>Note:</u></b>
                </td>
                <td colspan="9" align="justify">
                    1. It is mandatory to mention our Invoice No and your Organisation name while remitting the fee through bank transfer / wire transfer.
                </td>
            </tr>
            <tr>
                <td colspan="1">
                </td>
                <td colspan="9" align="justify">
                    2. Please intimate through a mail, while making payment to fo@asci.org.in with bank transaction I D.
                </td>
            </tr>
        </table>';
        }
        else if($currency_id == "5d3103c2-4a19-b7bf-75da-592586ee4aec"){
            $currency_name = 'US $&nbsp;';
            $currency_word = 'US Dollars';
            $bankDetails = ' <table width="100%" border="0" style="font-size:30px" cellpadding="0">
            <tr>
                <td>
                    We will be grateful if you could remit the payment by Wire Transfer to our account as detailed below, at the earliest.
                </td>
            </tr>
        </table>
        <table width="100%" border="1" style="font-size:30px" cellpadding="3">
            <tr>
                <td rowspan="3">
                   Receiver’s Correspondent Bank
                </td>
                <td>
                   Bank of America, New York (SWIFT: BOFAUS3N)
                </td>
            </tr>
            <tr>
                <td>
                    Via Chips ABA 0959 for Account UID 002473
                </td>
            </tr>
            <tr>
                <td>
                   Via Fedwire 026009593
                </td>
            </tr>
            <tr>
                <td>
                   For Credit of
                </td>
                <td>
                    State Bank of India, Treasury Department, Mumbai, India, SWIFT BIC – SBHYINBB002, Nostro A/c No.6550992180.
                </td>
            </tr>
            <tr>
                <td>
                   Ultimate Beneficiary
                </td>
                <td>
                    ADMINISTRATIVE STAFF COLLEGE OF INDIA, Account No.62090698960, State Bank of India, Bellavista Branch, Raj Bhavan Road, Hyderabad.
                </td>
            </tr>
            

        </table>
        <table width="100%" border="0" style="font-size:30px" cellpadding="0">
            <tr>
                <td align="left">
                    Thanking you,
                </td>
            </tr>
            <tr>
                <td align="right">
                    Yours sincerely,
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
                    
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Namrata Somani</b>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Finance Officer</b>
                </td>
            </tr>
        </table>';
        }

        if($programme_type_c == 'Announced'){
            $lops = '<tr>';
            $slno = 1;
            foreach($participantList as $participant){
                $lops .= "<td></td><td align=\"justify\" colspan=\"3\">".$slno.". ".$participant->name."</td><td></td>";
                $slno++;
            } 
            $lops .= '</tr>';
            $content = 'Fee for the training programme on "'.$project_aos_invoices_1_name.'" held during '.$duration.' in respect of the following:';
        }else{
            $content = 'Fee for the training programme on "'.$project_aos_invoices_1_name.'" held during '.$duration;
            $lops = "<tr><td></td><td align=\"justify\" colspan=\"3\">Fee @ $currency_name $programme_fee_c /- pp -- for $no_of_participants_c participants</td><td></td></tr>";
        }

        $invoice_data = <<<EOD
        <b align="center" style="font-size:30px">T A X  I N V O I C E</b><br>
        <table width="100%" border="1" style="font-size:30px">
            <tr>
                <td>
                    <table width="100%" border="0" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td>
                               To: 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b>$billing_account</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b>$billing_address_street</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b>$billing_address_city</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b>$billing_address_state</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b>$billing_address_country - $billing_address_postalcode</b> 
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               <b><u>Kind.Attn:</u> &nbsp;&nbsp;$kind_attention_c</b> 
                            </td> 
                        </tr>
                    </table>
                </td> 
                <td>
                    <table width="100%" border="0" style="font-size:30px" cellpadding="4">
                        <tr>
                            <td>
                               Invoice No: <b>$number</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               Date: <b>$invoice_date</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               PAN: <b>$pan_c</b>
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               SERVICE TAX REGD NO: <b>$regd_no_c</b>
                            </td> 
                        </tr>
                         <tr>
                            <td>
                               CATEGORY: <b>$category_c</b>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr> 
            <tr>
                <td colspan="2">
                    Sub: $sub
                </td> 
            </tr>
            <tr>
                <td colspan="2">
                    Ref: $ref
                </td>
            </tr>
        </table>

        <table width="100%" border="1" style="font-size:30px" cellpadding="0">
            <tr>
                <td colspan="3" align="center">
                    <b>P A R T I C U L A R S</b>
                </td>
                <td colspan="1"  align="center">
                    A M O U N T
                </td>
            </tr>
             <tr>
                <td colspan="3">
                    <table width="100%" border="0" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td>
                               
                            </td>
                            <td colspan="3">
                               
                            </td> 
                            <td>
                               
                            </td> 
                        </tr>
                        <tr>
                            <td>
                               
                            </td>
                            <td align="justify" colspan="3">
                               $content
                            </td> 
                            <td>
                               
                            </td> 
                        </tr>
                        $lops
                        <tr>
                            <td>
                               
                            </td>
                            <td colspan="3">
                               
                            </td> 
                            <td>
                               
                            </td> 
                        </tr>
                    </table>
                </td>
                <td colspan="1"  align="center">
                    <table width="100%" border="0" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                $total_amt
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
             <tr>
                <td colspan="3">
                    <table width="100%" border="1" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td colspan="3">
                               Service Tax on the above @14%
                            </td>
                            <td colspan="1">
                               $s_t_c
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                               Swachh Bharat Cess @ 0.50%
                            </td>
                            <td colspan="1">
                               $s_b_c
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                               Krishi Kalyan Cess @ 0.50%
                            </td>
                            <td colspan="1">
                               $k_k_c
                            </td>
                        </tr>

                    </table>
                </td>
                <td colspan="1"  align="center">
                     <table width="100%" border="0" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                $tax_amount
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    Total $currency_name
                </td>
                <td colspan="1" align="center">
                    $total_amount
                </td>
            </tr>
            <tr>
                <td colspan="4" align="justify">
                    Total Amount in Words <b>($currency_word &nbsp;$amountInWords Only)</b>
                </td>
            </tr>
        </table>
       $bankDetails
        
        
       
EOD;
        $pdf->writeHTML($invoice_data);
        // save the PDF to filesystem
        $pdf->Output('custom/modules/AOS_Invoices/invoice.pdf', 'F');

    }
}

?>
