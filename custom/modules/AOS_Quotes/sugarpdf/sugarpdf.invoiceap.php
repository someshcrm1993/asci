<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
ob_start();
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/Sugarpdf/Sugarpdf.php');

class AOS_QuotesSugarpdfinvoiceap extends Sugarpdf
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

    /**
     * Main content
     */
    function display()
    {
        global $sugar_config;
// set margins
        if ($currency_id == "-99") {
            setlocale(LC_MONETARY, 'en_US');
        }else{
            setlocale(LC_MONETARY, 'en_IN');
        }
        
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $proformaInvoiceBean = BeanFactory::getBean('AOS_Quotes',$_REQUEST['id']);
        $ap = $proformaInvoiceBean->get_linked_beans('project_aos_quotes_1');
        $userBean = BeanFactory::getBean('Users','5eb35c29-8944-28f5-3f1c-59436623fb2e');
        $participants = json_decode(html_entity_decode($proformaInvoiceBean->participant_list_c));
        $i = array_keys($participants);

        $participants = array_map(function($o,$i){
                                $list = ++$i.'. '.$o->name." ";
                                // if($i%2 == 0){$list .="|";}
                                return $list;
                             }, $participants,$i
                    );    
        $no_of_participants = count($participants);

        $participants = implode('', $participants);
        // echo $participants;exit();
        
        $this->AddPage();
        $this->SetFont(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN);
        $this->Ln();

        $image_file = K_PATH_IMAGES.'company_logo.png';
        $this->Image($image_file, 30, 10, 45, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        $fee_per_day = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->programme_fee_c,2)));
        $fee_per_day_non_res = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->programme_fee_non_res_c,2)));
        $tax_amt = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->tax_amount,2)));
		/* Added by ashvin
		   Date:13-11-2018
		   Reason: If the grand total amount is in minus, a line should be displayed below ‘Grand total’(in the same cell) saying ‘Refund to client’
		   Ticket Id:3784
		   Start
		*/		
		$refundToClient="";
		
		if((int)$proformaInvoiceBean->total_amount<0){
			
			$refundToClient='<tr>
				<td colspan="3" align="right" width="100%">
					Refund to Client&nbsp;
				</td>
				<td colspan="1" align="right" width="100%">
					'.str_replace('-','',$total_amt).'
				</td>
			</tr>';
		}	
        $f = 0;
        if ($fee_per_day != 0 && $fee_per_day != '0') {
            $fee_details = "
                            <tr>
                                <td width='20%'>5.</td>
                                <td width='140%'>Fee for residential participants</td>
                                <td width='140%'>{$fee_per_day}</td>
                            </tr>               
            "; 
            $f = 1;           
        }

        if ($fee_per_day_non_res != 0 && $fee_per_day_non_res != '0'){
            if ($f == 1) {
                $fee_details .= "
                            <tr>
                                <td width='20%'>6.</td>
                                <td width='140%'>Fee for non residential participants</td>
                                <td width='140%'>{$fee_per_day_non_res}</td>
                            </tr>               
                "; 
            }else{
                $fee_details = "
                            <tr>
                                <td width='20%'>5.</td>
                                <td width='140%'>Fee for non residential participants</td>
                                <td width='140%'>{$fee_per_day_non_res}</td>
                            </tr>               
                ";
            }
        }

        $discount_amount = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->discount_amount,2)));
        $discount_in_per = $proformaInvoiceBean->discount_in_per_c == '' ? 0 : $proformaInvoiceBean->discount_in_per_c;
        $discount_in_per = number_format($discount_in_per, 2);
        $discount_table = '';
        // print_r($discount_in_per_c);exit();
        if ($f == 1) {
            $count = 7;
        }else{
            $count = 6;
        }

        if ($discount_in_per != 0) {
            $discount_table = '
                <tr>
                    <td width="20%">'.$count.'.</td>
                    <td align="" width="140%">
                        Discount '.$discount_in_per.'%
                    </td>
                    <td width="140%">
                        '.$discount_amount.'
                    </td>                
                </tr>      
            ';
        }
        $cgst = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->cgst_c,2)));
        $sgst = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->sgst_c,2)));
        $igst = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->igst_c,2)));
        $ugst = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->ugst_c,2)));
        $currency_id = $proformaInvoiceBean->currency_id;
        $billing_address_state = $proformaInvoiceBean->billing_address_state;
        
          
      
            $igst_rate = 18;
            $cgst_rate = 9;
            $sgst_rate = 9;
            $ugst_rate = 9;
        


        $invoice_table = '<table width="100%" border="1" style="font-size:30px" cellpadding="0">
                        <tr>
                            <td>Tax Description</td>
                            <td>Tax Rate %</td>
                            <td>Tax Amount</td>
                        </tr>';

        
        if (strpos($proformaInvoiceBean->tax_type_c,'CGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td>
                       Central GST (CGST)
                    </td>
                    <td>
                       $cgst_rate
                    </td>
                    <td>
                       $cgst
                    </td>
                </tr>
            ";
        }

        if (strpos($proformaInvoiceBean->tax_type_c, 'SGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td>
                       State GST (SGST)
                    </td>
                    <td>
                       $sgst_rate
                    </td>
                    <td>
                       $sgst
                    </td>
                </tr>
            ";
        }

        if (strpos($proformaInvoiceBean->tax_type_c, 'IGST') !== false) {
            $invoice_table .= "
                <tr>
                    <td>
                       Integrated GST (IGST)
                    </td>
                    <td>
                        $igst_rate
                    </td>
                    <td>
                       $igst
                    </td>
                </tr>
            ";
        }

        if (strpos($proformaInvoiceBean->tax_type_c, 'UGST') !== false) {
            $invoice_table .= "
               <tr>
                    <td>
                       UGST
                    </td>
                    <td>
                        $ugst_rate
                    </td>
                    <td>
                       $ugst
                    </td>
                </tr>
            ";
        }     

        $invoice_table .= '</table>';

        $supplementry_invice = '';
        if ($discount_table == '') {
            $count1 = $count;            
        }else{
            $count1 = ++$count;
        }

        $count2 = ++$count1;
        $count3 = ++$count2;
        $count4 = ++$count3;

        if ($proformaInvoiceBean->invoice_type_c == 'Supplementary') {
            $supplementry_invice = "
                        <tr>
                            <td width='20%'>".++$count.".</td>
                            <td width='140%'>Accommodation</td>
                            <td width='140%'>{$proformaInvoiceBean->accommodation_c}</td>
                        </tr>
                        <tr>
                            <td width='20%'>".++$count.".</td>
                            <td width='140%'>Living Allowance</td>
                            <td width='140%'>{$proformaInvoiceBean->living_allowance_c}</td>
                        </tr>
                        <tr>
                            <td width='20%'>".++$count.".</td>
                            <td width='140%'>Other Reimbursement</td>
                            <td width='140%'>{$proformaInvoiceBean->other_reimbursement_c}</td>
                        </tr>
            ";        
            $count1 = ++$count;
            $count2 = ++$count1;
            $count3 = ++$count2;
            $count4 = ++$count3;        }           

        $total = money_format('%!n',str_replace(',','',number_format((float)$proformaInvoiceBean->total_amount,2)));
        $pcode = @$ap[0]->programme_id_c;
        $bankDetailsGenerate = '';
        if($currency_id == "-99"){
            foreach ($sugar_config['bank']['inr'] as $key => $value) {
                $bankDetailsGenerate .= "<tr>";
                $bankDetailsGenerate .= "<td>";
                $bankDetailsGenerate .= $key;
                $bankDetailsGenerate .= "</td>";
                $bankDetailsGenerate .= "<td>";
                $bankDetailsGenerate .= $value;
                $bankDetailsGenerate .= "</td>";
                $bankDetailsGenerate .= "</tr>";
            }
        }
        else if($currency_id == "5d3103c2-4a19-b7bf-75da-592586ee4aec"){
            $currency_name = 'US $&nbsp;';
            $currency_word = 'US Dollars';
            $bankDetailsGenerate = '';
            foreach ($sugar_config['bank']['usd'] as $key => $value) {
                $bankDetailsGenerate .= "<tr>";
                if (strpos($key,'Correspondent Bank') !== false && strpos($key,'Chips') === false && strpos($key,'Fedwire') === false) {
                    $bankDetailsGenerate .= '<td rowspan="3">';
                    $bankDetailsGenerate .= $key;
                    $bankDetailsGenerate .= '</td>';
                }else{
                    if (strpos($key,'Correspondent Bank') === false){
                        $bankDetailsGenerate .= '<td>';
                        $bankDetailsGenerate .= $key;
                        $bankDetailsGenerate .= '</td>';  
                    }
                }

                $bankDetailsGenerate .= '<td>';
                $bankDetailsGenerate .= $value;
                $bankDetailsGenerate .= '</td>';
                $bankDetailsGenerate .= '</tr>';
            }
        }

        $now = date('d-M-Y');
        // $count++;
        if ($discount_table == '') {
            $count = 7;
        }
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
                            <div>{$userBean->name}</div>
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
                            <td width="140%">{$pcode}</td>
                        </tr>    
                        <tr>
                            <td width="20%">4.</td>
                            <td width="140%">Title of the Program</td>
                            <td width="140%">{$ap[0]->name}</td>
                        </tr>
                        {$fee_details}
                        {$discount_table}
                        <tr>
                            <td width="20%">{$count}.</td>
                            <td colspan="1" width="140%">
                                {$invoice_table}
                            </td>
                            <td width="140%">{$tax_amt}</td>
                        </tr>    
                        {$supplementry_invice}
                        <tr>
                            <td width="20%"></td>
                            <td width="140%" align="right">Total </td>
                            <td width="140%">{$total}</td>
                        </tr>       
                        <tr>
                            <td width="20%">{$count1}.</td>
                            <td width="140%">Sponsor Organization</td>
                            <td width="140%">{$proformaInvoiceBean->billing_account}</td>
                        </tr>
                        <tr>
                            <td width="20%">{$count2}.</td>
                            <td width="140%">Kind Attention</td>
                            <td width="140%">{$proformaInvoiceBean->kind_attention_c}</td>
                        </tr>        
                        <tr>
                            <td width="20%"><strong>{$count3}.</strong></td>
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
                    {$bankDetailsGenerate}
                    </tbody>
                </table>
            </div>
            
                *Please Note: It is mandatory to mention our Program Code and your Organization Name while<br>remitting the fee through Bank Transfer / Wire Transfer.
            
            <br><br>
            <div style="font-size:30px">{$userBean->name}</div>
            </div>
EOD;
// print_r(error_get_last());exit();

        $this->writeHTML($html, true, false, false, false, '');      
        
    }

    /**
     * Build filename
     */
    function buildFileName()
    {
        $this->fileName = 'example.pdf';
    }

    /**
     * This method draw an horizontal line with a specific style.
     */
    protected function drawLine()
    {
        $this->Cell(20, 10, $date->format('d.m.Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');   
        $this->Cell(20, 10, 'Creator', 0, false, 'C', 0, '', 0, false, 'T', 'M'); 
        $this->Cell(20, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
