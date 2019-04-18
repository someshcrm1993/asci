<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class AOS_QuotesController extends SugarController
{
    public function action_proformaInvoiceAP()
    {
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$_REQUEST['id']);
        $ap = $proformaInvoiceBean->get_linked_beans('project_aos_quotes_1');

        $participants = json_decode(html_entity_decode($proformaInvoiceBean->participant_list_c));
        $participants = array_map(function($o){ 
                                return $o->name;
                             }, $participants
                    );
        $userBean = BeanFactory::getBean('Users','5eb35c29-8944-28f5-3f1c-59436623fb2e');
        
        include 'custom/modules/AOS_Quotes/invoices/proformaInvoiceAP.php';
    }

	public function action_SendProformaInvoiceToClient()
	{
		include 'custom/modules/AOS_Quotes/send_email.php';
	}

	function action_sendQuoteToPO()
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
            $template->retrieve_by_string_fields(array('id' => '5933545e-122f-4fd6-9716-594369abba28','type'=>'email'));            
        }
        
        //Parse Body HTMLcc
        $template->body_html = $template->parse_template_bean($template->body_html,$userBean->module_dir,$userBean);
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$_REQUEST['id']);
        
        if ($proformaInvoiceBean->programme_type_c == 'Announced') {
            $this->ap($_REQUEST['id']);
        }else if ($proformaInvoiceBean->programme_type_c == 'ICTP-On Campus') {
            $this->ictpOn($_REQUEST['id']);
        }else if ($proformaInvoiceBean->programme_type_c == 'ICTP-Off Campus') {
            $this->ictpOff($_REQUEST['id']);
        }else{
            SugarApplication::redirect('index.php?module=AOS_Quotes&action=DetailView&record='.$_REQUEST['id']);
        }

        $this->sendEmail($template->subject,$template->body_html,$email);

        SugarApplication::redirect('index.php?module=AOS_Quotes&action=DetailView&record='.$_REQUEST['id']);
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
        $mail->AddAttachment('custom/modules/AOS_Quotes/quote.pdf', 'quote.pdf', 'base64', 'application/pdf');
        // print_r($mail);exit();
        @$mail->Send(); 
    }

    public function ap($id)
    {
        require_once 'include/Sugarpdf/Sugarpdf.php';

        // create the pdf and save to file system
        $pdf = new Sugarpdf();
        $pdf->AddPage();

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$id);
        $ap = $proformaInvoiceBean->get_linked_beans('project_aos_quotes_1');

        $participants = json_decode(html_entity_decode($proformaInvoiceBean->participant_list_c));
        $i = array_keys($participants);

        $participants = array_map(function($o,$i){

                                return '<div>'.++$i.'. '.$o->name.'</div>';
                             }, $participants,$i
                    );    
        $no_of_participants = count($participants);

        $participants = implode('', $participants);
        // echo $participants;exit();

        $pdf->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $pdf->Ln();

        $image_file = K_PATH_IMAGES.'company_logo.png';
        $pdf->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $fee_per_day = number_format($proformaInvoiceBean->programme_fee_c, 2, '.', '');
        $tax_amt = number_format($proformaInvoiceBean->tax_amount, 2, '.', '');

        $s_b_c = number_format($proformaInvoiceBean->s_b_c, 2, '.', '');
        $k_k_c = number_format($proformaInvoiceBean->k_k_c, 2, '.', '');
        $total = number_format($proformaInvoiceBean->total_amt, 2, '.', '');

        $now = date('d-M-Y');
        $html = <<<EOD
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:30px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:30px">Phone: 0091-040- 66533086, Tele. Fax: 0091-040- 23317237</td></tr>
          <tr><td align="center" style="font-size:30px">e-mail: fo@asci.org.in</td></tr>
          </table>

          
              <div>
            <table style="font-size:30px"   >
                <tbody>
                    <tr>
                        <td align="left">
                            <div>{$ap[0]->assigned_user_name}</div>
                            <div> Programmes Officer</div>
                        </td>
                        <td align="right">Date: {$now}</td>
                    </tr>
                </tbody>
            </table>
            <br>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td width="20%">1.</td>
                            <td width="140%">Name of the Participants</td>
                            <td width="140%"><div>{$participants}</div></td>
                        </tr>
                        <tr>
                            <td width="20%">2.</td>
                            <td width="140%">No. of participants</td>
                            <td width="140%">{$no_of_participants}</td>
                        </tr>                   
                        <tr>
                            <td width="20%">3.</td>
                            <td width="140%">Program Code</td>
                            <td width="140%"></td>
                        </tr>    
                        <tr>
                            <td width="20%">4.</td>
                            <td width="140%">Title of the Program</td>
                            <td width="140%">{$proformaInvoiceBean->name}</td>
                        </tr>
                        <tr>
                            <td width="20%">5.</td>
                            <td width="140%">Fee </td>
                            <td width="140%">{$fee_per_day}</td>
                        </tr>       
                        <tr>
                            <td width="20%"></td>
                            <td width="140%" align="right">Service Tax @ (“Applicable rate”) </td>
                            <td width="140%">{$tax_amt}</td>
                        </tr>                                   
                        <tr>
                            <td width="20%"></td>
                            <td width="140%" align="right">Total </td>
                            <td width="140%">{$total}</td>
                        </tr>       
                        <tr>
                            <td width="20%">6.</td>
                            <td width="140%">Sponsor Organization</td>
                            <td width="140%">{$proformaInvoiceBean->billing_account}</td>
                        </tr>
                        <tr>
                            <td width="20%">7.</td>
                            <td width="140%">Kind Attention</td>
                            <td width="140%">{$proformaInvoiceBean->kind_attention_c}</td>
                        </tr>        
                        <tr>
                            <td width="20%"><strong>8.</strong></td>
                            <td width="140%"><strong>PAN NO: AAATA2442A</strong></td>
                            <td width="140%"><strong>SERVICE TAX REGD NO: AAATA2442AST001</strong></td>
                        </tr>                                           
                    </tbody>
                </table>
            </div>
            <br>
                We will be grateful if you could send the payment to the undersigned, favoring “ADMINISTRATIVE STAFF COLLEGE OF INDIA “ payable at Hyderabad or alternatively you could remit th'e payment by Direct Transfer to our Bank account as detailed below, at the earliest under intimation to us. 
            <br>
            
            <div>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td colspan="2">BANK PARTICULARS</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>State Bank of Hyderabad</td>
                        </tr>
                        <tr>
                            <td>Address line 1</td>
                            <td>6-3-1092, Ist floor, A Block</td>
                        </tr>
                        <tr>
                            <td>Address line 2</td>
                            <td>Raj Bhavan Road Branch, (Bellavista)</td>
                        </tr>
                        <tr>
                            <td>Address line 3</td>
                            <td>Hyderabad – 500 082</td>
                        </tr>
                        <tr>
                            <td>Beneficiary Account Name</td>
                            <td>Administrative Staff College of India</td>
                        </tr>
                        <tr>
                            <td>Bank Account Number</td>
                            <td>62090698675</td>
                        </tr>
                        <tr>
                            <td>Bank MICR No</td>
                            <td>500004008</td>
                        </tr>
                        <tr>
                            <td>NEFT IFSC Code</td>
                            <td>SBHY0020063</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
                *Please Note: It is mandatory to mention our Program Code and your Organization Name while<br>remitting the fee through Bank Transfer / Wire Transfer.
            
            <br><br>
            <div style="font-size:30px">V Naga Swapna</div>
            </div>
EOD;
// print_r(error_get_last());exit();

        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->Output('custom/modules/AOS_Quotes/quote.pdf', 'F');

    }

    public function ictpOn($id='')
    {
        require_once 'include/Sugarpdf/Sugarpdf.php';

        // create the pdf and save to file system
        $pdf = new Sugarpdf();
        $pdf->AddPage();

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$id);
        $ap = $proformaInvoiceBean->get_linked_beans('project_aos_quotes_1');

        $participants = json_decode(html_entity_decode($proformaInvoiceBean->participant_list_c));
        $i = array_keys($participants);

        $participants = array_map(function($o,$i){

                                return '<div>'.++$i.'. '.$o->name.'</div>';
                             }, $participants,$i
                    );    
        $no_of_participants = count($participants);

        $participants = implode('', $participants);
        // echo $participants;exit();

        $pdf->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $pdf->Ln();

        $image_file = K_PATH_IMAGES.'company_logo.png';
        $pdf->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $fee_per_day = number_format($proformaInvoiceBean->programme_fee_c, 2, '.', '');
        $tax_amt = number_format($proformaInvoiceBean->tax_amount, 2, '.', '');

        $s_b_c = number_format($proformaInvoiceBean->s_b_c, 2, '.', '');
        $k_k_c = number_format($proformaInvoiceBean->k_k_c, 2, '.', '');
        $total = number_format($proformaInvoiceBean->total_amt, 2, '.', '');

        $now = date('d-M-Y');
        $html = <<<EOD
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:30px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:30px">Phone: 0091-040- 66533086, Tele. Fax: 0091-040- 23317237</td></tr>
          <tr><td align="center" style="font-size:30px">e-mail: fo@asci.org.in</td></tr>
          </table>

          
              <div>
            <table style="font-size:30px"   >
                <tbody>
                    <tr>
                        <td align="left">
                            <div>{$ap[0]->assigned_user_name}</div>
                            <div> Programmes Officer</div>
                        </td>
                        <td align="right">Date: {$now}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <strong style="font-size:30px"><u>PROFORMA INVOICE FOR ICTP ON CAMPUS (IN INR)</u></strong>
            <br><br>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td width="20%">1.</td>
                            <td width="140%">No. of participants</td>
                            <td width="140%">{$no_of_participants}</td>
                        </tr>                   
                        <tr>
                            <td width="20%">2.</td>
                            <td width="140%">Program Code</td>
                            <td width="140%"></td>
                        </tr>    
                        <tr>
                            <td width="20%">3.</td>
                            <td width="140%">Title of the Program</td>
                            <td width="140%">{$proformaInvoiceBean->name}</td>
                        </tr>
                        <tr>
                            <td width="20%">4.</td>
                            <td width="140%">Fee per day Rs.”Amount” for minimum of 25 participants </td>
                            <td width="140%">{$fee_per_day}</td>
                        </tr>       
                        <tr>
                            <td width="20%">5.</td>
                            <td width="140%">Service Tax on the above @(Applicable Rate)</td>
                            <td width="140%">{$tax_amt}</td>
                        </tr>                                   
                        <tr>
                            <td width="20%">6.</td>
                            <td width="140%" align="">Swachh Bharat Cess @(Applicable R e)at</td>
                            <td width="140%">{$s_b_c}</td>
                        </tr>  
                        <tr>
                            <td width="20%">7.</td>
                            <td width="140%" align="">Krishi Kalyan Cess @(Applicable Rate)</td>
                            <td width="140%">{$k_k_c}</td>
                        </tr>    
                        <tr>
                            <td width="20%"></td>
                            <td align="right" width="140%">Total </td>
                            <td width="140%">{$total}</td>
                        </tr> 
                        <tr>
                            <td colspan="3">Reimbursement of the faculty Airfare, Local travel and Stay expenses may please be added as per the<div> actuals</div></td>
                        </tr>       
                        <tr>
                            <td width="20%">8.</td>
                            <td width="140%">Sponsor Organization</td>
                            <td width="140%">{$proformaInvoiceBean->billing_account}</td>
                        </tr>
                        <tr>
                            <td width="20%">9.</td>
                            <td width="140%">Kind Attention</td>
                            <td width="140%">{$proformaInvoiceBean->kind_attention_c}</td>
                        </tr>        
                        <tr>
                            <td width="20%"><strong>8</strong></td>
                            <td width="140%"><strong>PAN NO: AAATA2442A</strong></td>
                            <td width="140%"><strong>SERVICE TAX REGD NO: AAATA2442AST001</strong></td>
                        </tr>                                           
                    </tbody>
                </table>

        <br>
        <span style="font-size:28px;" align="left">We will be grateful if you could send the payment to the undersigned, favoring “ADMINISTRATIVE STAFF COLLEGE OF INDIA “ payable at Hyderabad or alternatively you could remit th'e payment by Direct Transfer to our Bank account as detailed below, at the earliest under intimation to us. 
        </span>
            <br>
            <div>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td colspan="2">BANK PARTICULARS</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>State Bank of Hyderabad</td>
                        </tr>
                        <tr>
                            <td>Address line 1</td>
                            <td>6-3-1092, Ist floor, A Block</td>
                        </tr>
                        <tr>
                            <td>Address line 2</td>
                            <td>Raj Bhavan Road Branch, (Bellavista)</td>
                        </tr>
                        <tr>
                            <td>Address line 3</td>
                            <td>Hyderabad – 500 082</td>
                        </tr>
                        <tr>
                            <td>Beneficiary Account Name</td>
                            <td>Administrative Staff College of India</td>
                        </tr>
                        <tr>
                            <td>Bank Account Number</td>
                            <td>62090698675</td>
                        </tr>
                        <tr>
                            <td>Bank MICR No</td>
                            <td>500004008</td>
                        </tr>
                        <tr>
                            <td>NEFT IFSC Code</td>
                            <td>SBHY0020063</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
                *Please Note: It is mandatory to mention our Program Code and your Organization Name while<br>remitting the fee through Bank Transfer / Wire Transfer.
            
            <br><br>
            <span style="font-size:30px">V Naga Swapna</span>
            </div>
EOD;

        $pdf->writeHTML($html, true, false, false, false, ''); 
        $pdf->Output('custom/modules/AOS_Quotes/quote.pdf', 'F');
    }

    public function ictpOff($id)
    {
        require_once 'include/Sugarpdf/Sugarpdf.php';

        // create the pdf and save to file system
        $pdf = new Sugarpdf();
        $pdf->AddPage();

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$id);
        $ap = $proformaInvoiceBean->get_linked_beans('project_aos_quotes_1');

        $participants = json_decode(html_entity_decode($proformaInvoiceBean->participant_list_c));
        $i = array_keys($participants);

        $participants = array_map(function($o,$i){

                                return '<div>'.++$i.'. '.$o->name.'</div>';
                             }, $participants,$i
                    );    
        $no_of_participants = count($participants);

        $participants = implode('', $participants);
        // echo $participants;exit();

        $pdf->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $pdf->Ln();

        $image_file = K_PATH_IMAGES.'company_logo.png';
        $pdf->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $fee_per_day = number_format($proformaInvoiceBean->programme_fee_c, 2, '.', '');
        $tax_amt = number_format($proformaInvoiceBean->tax_amount, 2, '.', '');

        $s_b_c = number_format($proformaInvoiceBean->s_b_c, 2, '.', '');
        $k_k_c = number_format($proformaInvoiceBean->k_k_c, 2, '.', '');
        $total = number_format($proformaInvoiceBean->total_amt, 2, '.', '');

        $now = date('d-M-Y');
        $html = <<<EOD
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr><td align="center" style="font-size:35px"><b>ADMINISTRATIVE STAFF COLLEGE OF INDIA</b></td></tr>
          <tr><td align="center" style="font-size:30px">Bella Vista, Hyderabad - 500 082, Telangana, India</td></tr>
          <tr><td align="center" style="font-size:30px">Phone: 0091-040- 66533086, Tele. Fax: 0091-040- 23317237</td></tr>
          <tr><td align="center" style="font-size:30px">e-mail: fo@asci.org.in</td></tr>
          </table>

          
              <div>
            <table style="font-size:30px"   >
                <tbody>
                    <tr>
                        <td align="left">
                            <div>{$ap[0]->assigned_user_name}</div>
                            <div> Programmes Officer</div>
                        </td>
                        <td align="right">Date: {$now}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <strong style="font-size:30px"><u>PROFORMA INVOICE FOR ICTP OFF CAMPUS (IN INR)</u></strong>
            <br><br>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td width="20%">1.</td>
                            <td width="140%">No. of participants</td>
                            <td width="140%">{$no_of_participants}</td>
                        </tr>                   
                        <tr>
                            <td width="20%">2.</td>
                            <td width="140%">Program Code</td>
                            <td width="140%"></td>
                        </tr>    
                        <tr>
                            <td width="20%">3.</td>
                            <td width="140%">Title of the Program</td>
                            <td width="140%">{$proformaInvoiceBean->name}</td>
                        </tr>
                        <tr>
                            <td width="20%">4.</td>
                            <td width="140%">Fee per day Rs.”Amount” for minimum of 25 participants </td>
                            <td width="140%">{$fee_per_day}</td>
                        </tr>       
                        <tr>
                            <td width="20%">5.</td>
                            <td width="140%">Service Tax on the above @(Applicable Rate)</td>
                            <td width="140%">{$tax_amt}</td>
                        </tr>                                   
                        <tr>
                            <td width="20%">6.</td>
                            <td width="140%" align="">Swachh Bharat Cess @(Applicable R e)at</td>
                            <td width="140%">{$s_b_c}</td>
                        </tr>  
                        <tr>
                            <td width="20%">7.</td>
                            <td width="140%" align="">Krishi Kalyan Cess @(Applicable Rate)</td>
                            <td width="140%">{$k_k_c}</td>
                        </tr>    
                        <tr>
                            <td width="20%"></td>
                            <td align="right" width="140%">Total </td>
                            <td width="140%">{$total}</td>
                        </tr> 
                        <tr>
                            <td colspan="3">Reimbursement of the faculty Airfare, Local travel and Stay expenses may please be added as per the<div> actuals</div></td>
                        </tr>       
                        <tr>
                            <td width="20%">8.</td>
                            <td width="140%">Sponsor Organization</td>
                            <td width="140%">{$proformaInvoiceBean->billing_account}</td>
                        </tr>
                        <tr>
                            <td width="20%">9.</td>
                            <td width="140%">Kind Attention</td>
                            <td width="140%">{$proformaInvoiceBean->kind_attention_c}</td>
                        </tr>        
                        <tr>
                            <td width="20%"><strong>8</strong></td>
                            <td width="140%"><strong>PAN NO: AAATA2442A</strong></td>
                            <td width="140%"><strong>SERVICE TAX REGD NO: AAATA2442AST001</strong></td>
                        </tr>                                           
                    </tbody>
                </table>

        <br>
        <span style="font-size:28px;" align="left">We will be grateful if you could send the payment to the undersigned, favoring “ADMINISTRATIVE STAFF COLLEGE OF INDIA “ payable at Hyderabad or alternatively you could remit th'e payment by Direct Transfer to our Bank account as detailed below, at the earliest under intimation to us. 
        </span>
            <br>
            <div>
                <table cellpadding="4" border="1" style="font-size:30px">
                    <tbody>
                        <tr>
                            <td colspan="2">BANK PARTICULARS</td>
                        </tr>
                        <tr>
                            <td>Bank Name</td>
                            <td>State Bank of Hyderabad</td>
                        </tr>
                        <tr>
                            <td>Address line 1</td>
                            <td>6-3-1092, Ist floor, A Block</td>
                        </tr>
                        <tr>
                            <td>Address line 2</td>
                            <td>Raj Bhavan Road Branch, (Bellavista)</td>
                        </tr>
                        <tr>
                            <td>Address line 3</td>
                            <td>Hyderabad – 500 082</td>
                        </tr>
                        <tr>
                            <td>Beneficiary Account Name</td>
                            <td>Administrative Staff College of India</td>
                        </tr>
                        <tr>
                            <td>Bank Account Number</td>
                            <td>62090698675</td>
                        </tr>
                        <tr>
                            <td>Bank MICR No</td>
                            <td>500004008</td>
                        </tr>
                        <tr>
                            <td>NEFT IFSC Code</td>
                            <td>SBHY0020063</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
                *Please Note: It is mandatory to mention our Program Code and your Organization Name while<br>remitting the fee through Bank Transfer / Wire Transfer.
            
            <br><br>
            <span style="font-size:30px">V Naga Swapna</span>
            </div>
EOD;
// print_r(error_get_last());exit();

        $pdf->writeHTML($html, true, false, false, false, ''); 
        $pdf->Output('custom/modules/AOS_Quotes/quote.pdf', 'F');
    }
}

?> 
