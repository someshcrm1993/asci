<?php
$GLOBALS['app_list_strings']['type_list']=array (
  'Hot' => 'Hot',
  'Warm' => 'Warm',
  'Cold' => 'Cold',
);
$app_strings['LBL_GROUPTAB3_1440738985'] = 'Sales';

$app_strings['LBL_GROUPTAB4_1440738985'] = 'Marketing';
$app_list_strings['record_type_display']['Leads']='Lead';
$app_list_strings['parent_type_display']['Leads']='Enquiry';
$app_list_strings['record_type_display_notes']['Leads']='Lead';
$GLOBALS['app_list_strings']['source_list']=array (
  '' => '',
  'Facebook' => 'Facebook',
  'Twitter' => 'Twitter',
  'Portal' => 'Portal',
  'Call' => 'Call',
  'Inbound_Email' => 'Inbound Email',
);
$GLOBALS['app_list_strings']['approval_status_dom']=array (
  '' => '',
  'Not Approved' => 'Not Approved',
  'Pending_Approval' => 'Pending Approval',
  'Approved' => 'Approved',
);




#$GLOBALS['app_list_strings']['teams_list']=array (
#  '' => '',
#  'Support_Group' => 'Support Group',
#  'Sales_Group' => 'Sales Group',
#);
$new_teams_array=array(
   ''=>'',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from securitygroups where deleted='0'");
while($row=$db->fetchRow($result)){$new_teams_array[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['teams_list']=$new_teams_array; 




$GLOBALS['app_list_strings']['escalation_level_list']=array (
  '' => '',
  'Level1' => 'Level 1',
  'Level2' => 'Level 2',
  'Level3' => 'Level 3',
);
$GLOBALS['app_list_strings']['escalation_minutes_level1_list']=array (
  '' => '',
  5 => '5',
  10 => '10',
  15 => '15',
  30 => '30',
  45 => '45',
  60 => '60',
);
$GLOBALS['app_list_strings']['escalation_minutes_level2_c_list']=array (
  '' => '',
  10 => '10',
  15 => '15',
  30 => '30',
  45 => '45',
  60 => '60',
);

/*
$GLOBALS['app_list_strings']['email_template_1_list']=array (
  '' => '',
  'Update_Custome' => 'Update Customer on the Issue',
  'Quote_Price' => 'Quote Price Negotiation',
  'Quote_Approved' => 'Quote Approved',
  'Quote_Not_Approved' => 'Quote Not Approved',
  'New_Quote' => 'New Quote for Approval',
  'Welcome_To_SimpleWorks' => 'Welcome To SimpleWorks',
  'Deadline_missed' => 'Deadline missed',
  'Case_Closure' => 'Case Closure',
  'Joomla_Account' => 'Joomla Account Creation',
  'Case_Creation' => 'Case Creation',
  'Contact_Case' => 'Contact Case Update',
  'User_Case_Update' => 'User Case Update',
  'System_password' => 'System-generated password email',
  'Forgot_Password_email' => 'Forgot Password email',
  'Event_Invite_Template' => 'Event Invite Template',
);
*/

$new_email_templates_array=array(
   ''=>'',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from email_templates where deleted='0'");
while($row=$db->fetchRow($result)){$new_email_templates_array[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['email_template_1_list']=$new_email_templates_array; 




$GLOBALS['app_list_strings']['country_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['state_list']=array (
  '' => '',
  'Maharashta' => 'Maharashtra',
);
$GLOBALS['app_list_strings']['city_c_list']=array (
  '' => '',
  'Mumbai' => 'Mumbai',
);
$GLOBALS['app_list_strings']['quarter_list']=array (
  '' => '',
  1 => 'Q1',
  2 => 'Q2',
  3 => 'Q3',
  4 => 'Q4',
);

$GLOBALS['app_list_strings']['role1_0']=array (
  '' => '',
  'Marketing Manager' => 'Marketing Manager',
  'Support Rep' => 'Support Rep',
  'Support Manager' => 'Support Manager',
  'Sales Manager' => 'Sales Manager',
  'Sales Rep' => 'Sales Rep',
);

$GLOBALS['app_list_strings']['lead_simplecrm_status_list']=array (
  '' => '',
  'In_Review' => 'In Review',
  'Qualified' => 'Qualified',
  'Not_Qualified' => 'Not Qualified',
);
$GLOBALS['app_list_strings']['lead_partner_status_list']=array (
  '' => '',
  'In_Review' => 'In Review',
  'Accepted' => 'Accepted',
  'Rejected' => 'Rejected',
);
$GLOBALS['app_list_strings']['status_list']=array (
  '' => '',
  'New' => 'New',
  'Open' => 'Open - Close in 1 Month',
  'Open3' => 'Open - Close in 3 Month',
  'Open6' => 'Open - Close in 6 Month',
  'Converted' => 'Converted to Customer',
  'Dead' => 'Dead',
);
$GLOBALS['app_list_strings']['case_type_dom']=array (
  'Minor_Defect' => 'Service Request',
  'Defect' => 'Claim',
  'Change_Request' => 'Complaint',
  'Product_Enhancement_Request' => 'General Feedback',
  'Pre_Sales_Related' => 'Pre Sales Related',
  'Other' => 'Other',
);

$GLOBALS['app_list_strings']['type_0']=array (
  'HL' => 'Home Loan',
  'CL' => 'Car Loan',
  'SL' => 'Student Loan',
);

$GLOBALS['app_list_strings']['loan_type_list']=array (
  '' => '',
  'HL' => 'Home Loan',
  'CL' => 'Car Loan',
  'SL' => 'Student Loan',
);
$GLOBALS['app_list_strings']['region_list']=array (
  '' => '',
  'Asia' => 'Asia',
  'Europe' => 'Europe',
  'Africa' => 'Africa',
);
$GLOBALS['app_list_strings']['country_0']=array (
  '' => '',
  'Asia_China' => 'China',
  'Asia_India' => 'India',
  'Asia_Iraq' => 'Iraq',
  'Asia_SaudiArabia' => 'Saudi Arabia',
  'Asia_Turkey' => 'Turkey',
  'Europe_Ukraine' => 'Ukraine',
  'Europe_Italy' => 'Italy',
  'Europe_Spain' => 'Spain',
  'Europe_England' => 'England',
  'Africa_SouthAfrica' => 'South Africa',
);
$GLOBALS['app_list_strings']['category_list']=array (
  '' => '',
  'Hot' => 'Hot',
  'Warm' => 'Warm',
  'Cold' => 'Cold',
);
$app_list_strings['moduleList']['Accounts']='Organisations';
$app_list_strings['moduleList']['Opportunities']='Proposals';
$app_list_strings['moduleList']['Leads']='Enquiries';
$app_list_strings['moduleListSingular']['Accounts']='Organisation';
$app_list_strings['moduleListSingular']['Opportunities']='Proposal';
$app_list_strings['moduleListSingular']['Leads']='Enquiry';
$app_list_strings['record_type_display']['Accounts']='Organisation';
$app_list_strings['parent_type_display']['Accounts']='Organisation';
$app_list_strings['record_type_display_notes']['Accounts']='Organisation';
$app_list_strings['moduleList']['AOS_Quotes']='Proforma Invoice';
$app_list_strings['moduleListSingular']['AOS_Quotes']='Proforma Invoice';
$app_list_strings['moduleList']['Project']='Programmes';
$app_list_strings['moduleList']['scrm_Partner_Contacts']='Contacts';
$app_list_strings['moduleListSingular']['Project']='Programme';
$app_list_strings['moduleListSingular']['scrm_Partner_Contacts']='Contact';
$app_list_strings['moduleListSingular']['scrm_Partners']='Faculty';
$GLOBALS['app_list_strings']['lead_source_dom']=array (
  '' => '',
  'Snail Mail' => 'Snail Mail',
  'Brochures' => 'Brochures',
  'Cold Call' => 'Cold Call',
  'Existing Customer' => 'Existing Customer',
  'Self Generated' => 'Self Generated',
  'Employee' => 'Employee',
  'Partner' => 'Partner',
  'Direct Mail' => 'Direct Mail',
  'Conference' => 'Conference',
  'Web Site' => 'Web Site',
  'Word of mouth' => 'Word of mouth',
  'Email' => 'Email',
  'Campaign' => 'Campaign',
  'Facebook' => 'Facebook',
  'Twitter' => 'Twitter',
  'Other' => 'Other',
);
$GLOBALS['app_list_strings']['t_shirt_size_list']=array (
  ''=>'',
  'M'=>'M',
  'L'=>'L',
  'XL'=>'XL',
  'XXL'=>'XXL',
  'XXXL'=>'XXXL',
);
$GLOBALS['app_list_strings']['programme_group_type_list']=array (
  ''=>'',
  'General Management'=>'General Management',
  'Functional'=>'Functional',
  'Area Sectoral'=>'Area Sectoral',
  'Others'=>'Others',
);
$GLOBALS['app_list_strings']['overseas_tour_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['new_regular_list']=array (
  '' => '',
  'New' => 'New',
  'Regular/Repeat Program' => 'Regular/Repeat Program',
);
$GLOBALS['app_list_strings']['nominee_position_list']=array (
  '' => '',
  'CEO' => 'CEO',
  'Sr. level' => 'Sr. level',
  'Md. Level' => 'Md. Level',
  'Jr. Level' => 'Jr. Level',
);
$GLOBALS['app_list_strings']['items_list']=array (
  '' => '',
  'Docketring' => 'Docket Files/ ring-binder',
  'CF' => 'Certificate Folders',
  'PD' => 'Pen drives',
  'PR' => 'Paper Reams',
  'Envelopes' => 'Envelopes',
  'GS' => 'General stationery',
  'SK' => 'Special Kits',
);
$GLOBALS['app_list_strings']['general_stationery_list']=array (
  '' => '',
  'Pens' => 'Pens',
  'Pencils' => 'Pencils',
  'Erasers' => 'Erasers',
  'Markers' => 'Markers',
);
$GLOBALS['app_list_strings']['organisation_activity_list']=array (
  ''=>'',
  'Manufacturing'=>'Manufacturing',
  'Service'=>'Service',
  'Non-Banking finance'=>'Non-Banking finance', 
  'Non-profit'=>'Non-profit',
  'Others'=>'Others',
);

$GLOBALS['app_list_strings']['visit_names_list']=array (
  '' => '',
  'GF' => 'Golconda Fort Sound and Light',
  'RFC' => 'Ramoji Film City',
  'CT' => 'City Tour',
  'SCV' => 'Shilparamam Craft Village',
  'AH' => 'Anantagiri Hills',
  'other' => 'Other',
);
$GLOBALS['app_list_strings']['faculty_type_list']=array (
  '' => '',
  'ASCI Faculty' => 'ASCI Faculty',
  'Guest Faculty' => 'Guest Faculty',
);
$GLOBALS['app_list_strings']['destination_station_list']=array (
  '' => '',
  'Secunderabad' => 'Secunderabad',
  'Nampally' => 'Nampally',
  'Begumpet' => 'Begumpet',
);
$GLOBALS['app_list_strings']['events_list']=array (
  '' => '',
  'HT' => 'High Tea',
  'FD' => 'Farewell Dinner',
  'GT' => 'DG’s Get Together',
  'GTD' => 'DG’s get together & Dinner',
  'ET' => 'Addl evening tea (CR)',
  'other' => 'Other',
);
$GLOBALS['app_list_strings']['total_expected_revenue_list']=array (
  '' => '',
  'INR' => 'INR',
  'USD' => 'USD',
  'Euro' => 'Euro',
);
$GLOBALS['app_list_strings']['calendar_type_list']=array (
  '' => '',
  '5dw' => '5 day week',
  '6dw' => '6 day week',
);
$GLOBALS['app_list_strings']['fee_currency_list']=array (
  '' => '',
  'INR' => 'INR',
  'USD' => 'USD',
  'Euro' => 'Euro',
);
$GLOBALS['app_list_strings']['programme_status_0']=array (
  '' => '',
  'Awarded' => 'Awarded',
  'NA' => 'Not-awarded',
);
$GLOBALS['app_list_strings']['proposal_calendar_type']=array (
  '' => '',
  '5dw' => '5 day week',
  '6dw' => '6 day week',
);
$GLOBALS['app_list_strings']['proposal_status_asci_list']=array (
  '' => '',
  'Awarded' => 'Awarded',
  'Under negotiation' => 'Under negotiation',
  'Others' => 'Others',
);
$GLOBALS['app_list_strings']['proposal_programme_type']=array (
  '' => '',
  'ICTP-On Campus' => 'ICTP-On Campus',
  'ICTP-Off Campus' => 'ICTP-Off Campus',
  'Sponsored' => 'Sponsored',
  'Workshop ON Campus' => 'Workshop ON Campus',
  'Workshop OFF Campus' => 'Workshop OFF Campus',
);
$app_list_strings['moduleList']['Contacts']='Nominations';
$app_list_strings['moduleListSingular']['Contacts']='Nomination';
$app_list_strings['record_type_display']['Contacts']='Nomination';
$app_list_strings['parent_type_display']['Contacts']='Nomination';
$app_list_strings['record_type_display_notes']['Contacts']='Nomination';
$GLOBALS['app_list_strings']['day_list']=array (
  '' => '',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from scrm_partners where deleted='0' order by date_entered");
$faculty['']='';
while($row=$db->fetchRow($result)){$faculty[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['faculty_name_list']=$faculty; 



$fYear = date('Y') + 4;
$year_array = array(''=>'');
for($i=2012;$i<$fYear;$i++){
  $j = $i+1;
  $label = "$i - $j";
  $year_array[$i] = $label;
}
$GLOBALS['app_list_strings']['programme_year_list']=$year_array;
$GLOBALS['app_list_strings']['participant_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['faculty_id_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['cr_no_list']=array (
  '' => '',
  'CPC Auditorium' => 'CPC Auditorium',
  'CPC EDP Room' => 'CPC EDP Room',
  'CPC CR I' => 'CPC CR I',
  'CPC CR II' => 'CPC CR II',
  'CPC CR III' => 'CPC CR III',
  'CPC CR IV' => 'CPC CR IV',
  'BV CR I' => 'BV CR I',
  'BV CR II' => 'BV CR II',
  'BV CR III' => 'BV CR III',
  'BV CR IV' => 'BV CR IV',
  'BV CR V' => 'BV CR V',
);
$GLOBALS['app_list_strings']['document_status_dom']=array (
  'Active' => 'Active',
  'Draft' => 'Draft',
  'Expired' => 'Expired',
  'Under Review' => 'Under Review',
  'Pending' => 'Pending',
);
$GLOBALS['app_list_strings']['room_no_list']=array (
);
$GLOBALS['app_list_strings']['accommodation_type_list']=array (
  '' => '',
  'Executive Hostel' => 'Executive Hostel',
  'Hotel' => 'Hotel',
);
$GLOBALS['app_list_strings']['location_list']=array (
  '' => '',
  'Bella Vista' => 'Bella Vista',
  'NDC' => 'NDC',
  'CPC_NEW' => 'CPC New',
  'CPC_OLD' => 'CPC Old',
);
$GLOBALS['app_list_strings']['programme_status_list']=array (
  '' => '',
  'Proposal Stage' => 'Proposal Stage',
  'Offered' => 'Offered',
  'Not Offered' => 'Not Offered',
  'Cancelled' => 'Cancelled',
  'Deferred' => 'Deferred',
  'Conducted' => 'Conducted',
);
$GLOBALS['app_list_strings']['user_status_dom']=array (
  'Active' => 'Active',
  'Inactive' => 'Inactive',
);
$GLOBALS['app_list_strings']['type_1']=array (
  '' => '',
  'Bus' => 'Bus',
  'Airport' => 'Airport',
);
$GLOBALS['app_list_strings']['type_2']=array (
  '' => '',
  'Residential' => 'Residential',
  'NonResidential' => 'Non Residential',
);
$GLOBALS['app_list_strings']['venue_list']=array (
  'CR' => 'CR',
  'Hotel' => 'Hotel',
);

$GLOBALS['app_list_strings']['invoice_status_dom']=array (
  '' => '',
  'Paid' => 'Paid',
  'Unpaid' => 'Unpaid',
  'Cancelled' => 'Cancelled',
  'Refund' => 'Refund',
  'PartiallyPaid' => 'Partially Paid',
);
$GLOBALS['app_list_strings']['bv_accommodation_list']=array (
  '' => '',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
  9 => '9',
  10 => '10',
  11 => '11',
  12 => '12',
  '12A' => '12A',
  14 => '14',
  15 => '15',
  16 => '16',
  17 => '17',
  18 => '18',
  19 => '19',
  20 => '20',
  21 => '21',
  101 => '101',
  102 => '102',
  103 => '103',
  104 => '104',
  105 => '105',
  106 => '106',
  107 => '107',
  108 => '108',
  109 => '109',
  110 => '110',
  111 => '111',
  112 => '112',
  113 => '113',
  114 => '114',
  115 => '115',
  116 => '116',
  117 => '117',
  118 => '118',
  119 => '119',
  120 => '120',
  121 => '121',
  122 => '122',
  123 => '123',
  124 => '124',
  201 => '201',
  202 => '202',
  203 => '203',
  204 => '204',
  205 => '205',
  206 => '206',
  207 => '207',
  208 => '208',
  209 => '209',
  210 => '210',
  211 => '211',
  212 => '212',
  213 => '213',
  214 => '214',
  215 => '215',
  216 => '216',
  217 => '217',
  218 => '218',
  219 => '219',
  220 => '220',
  221 => '221',
  222 => '222',
  223 => '223',
  224 => '224',
  301 => '301',
  302 => '302',
  303 => '303',
  304 => '304',
  305 => '305',
  306 => '306',
  307 => '307',
  308 => '308',
  309 => '309',
  310 => '310',
  311 => '311',
  312 => '312',
  314 => '314',
  313 => '313',
  315 => '315',
  316 => '316',
  317 => '317',
  318 => '318',
  319 => '319',
  320 => '320',
  321 => '321',
  322 => '322',
  323 => '323',
  324 => '324',
);
$GLOBALS['app_list_strings']['asci_proposal_outcome_list']=array (
  '' => '',
  'UN' => 'Under negotiation',
  'Awarded' => 'Awarded',
  'NA' => 'Not Awarded',
  'Closed' => 'Closed',
  'Others' => 'Others',
);
$app_list_strings['moduleList']['scrm_Admin_Arranges']='Admin Arrangements';
$app_list_strings['moduleListSingular']['scrm_Admin_Arranges']='Admin Arrangement';
$GLOBALS['app_list_strings']['room_no_ndc_list']=array (
  '' => '',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
);

$GLOBALS['app_list_strings']['room_no_cpc_list']=array (
  '' => '',
);

$GLOBALS['app_list_strings']['room_no_ndc_0']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['gender_0']=array (
  '' => '',
  'Male' => 'Male',
  'Female' => 'Female',
);
$GLOBALS['app_list_strings']['guest_type_0']=array (
    '' => '',
  'ASCI Faculty' => 'ASCI Faculty',
  'Guest Faculty' => 'Guest Faculty',
  'Participant' => 'Participant',
);
$GLOBALS['app_list_strings']['type_of_room_list']=array (
  '' => '',
  'Double Occupancy Room' => 'Double Occupancy Room',
  'Single Occupancy Room' => 'Single Occupancy Room',
  'Reserved' => 'Reserved',
  'Self' => 'Self Accommodation',
);
$GLOBALS['app_list_strings']['accommodation_list']=array (
  '' => '',
  'CPCNew' => 'CPC New',
  'CPCOld' => 'CPC Old',
  'BV' => 'BV',
);
$GLOBALS['app_list_strings']['cpc_accommodations_list']=array (
  '' => '',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
  9 => '9',
  10 => '10',
  11 => '11',
  12 => '12',
  13 => '13',
  14 => '14',
  19 => '19',
  20 => '20',
  21 => '21',
  22 => '22',
  23 => '23',
  24 => '24',
  25 => '25',
  26 => '26',
  27 => '27',
  'CR2' => 'CR2',
  106 => '106',
  107 => '107',
  108 => '108',
  109 => '109',
  110 => '110',
  111 => '111',
  112 => '112',
  113 => '113',
  114 => '114',
  115 => '115',
  116 => '116',
  117 => '117',
  118 => '118',
  119 => '119',
  120 => '120',
  121 => '121',
  122 => '122',
  123 => '123',
  124 => '124',
  125 => '125',
  126 => '126',
  127 => '127',
  128 => '128',
  129 => '129',
  130 => '130',
  131 => '131',
  132 => '132',
  133 => '133',
  'CR3' => 'CR3',
  206 => '206',
  207 => '207',
  208 => '208',
  209 => '209',
  210 => '210',
  211 => '211',
  212 => '212',
  213 => '213',
  214 => '214',
  215 => '215',
  216 => '216',
  217 => '217',
  218 => '218',
  219 => '219',
  220 => '220',
  221 => '221',
  222 => '222',
  223 => '223',
  224 => '224',
  225 => '225',
  226 => '226',
  227 => '227',
  228 => '228',
  229 => '229',
  230 => '230',
  231 => '231',
  232 => '232',
  233 => '233',
  234 => '234',
);
$GLOBALS['app_list_strings']['room_no_cpc_new_c_list']=array (
  '' => '',
  101 => '101',
  102 => '102',
  103 => '103',
  104 => '104',
  105 => '105',
  106 => '106',
  107 => '107',
  108 => '108',
  109 => '109',
  110 => '110',
  111 => '111',
  112 => '112',
  113 => '113',
  114 => '114',
  115 => '115',
  116 => '116',
  117 => '117',
  201 => '201',
  202 => '202',
  203 => '203',
  204 => '204',
  205 => '205',
  206 => '206',
  207 => '207',
  208 => '208',
  209 => '209',
  210 => '210',
  211 => '211',
  212 => '212',
  213 => '213',
  214 => '214',
  215 => '215',
  216 => '216',
  217 => '217',
  301 => '301',
  302 => '302',
  303 => '303',
  304 => '304',
  305 => '305',
  306 => '306',
  307 => '307',
  308 => '308',
  309 => '309',
  310 => '310',
  311 => '311',
  312 => '312',
  313 => '313',
  314 => '314',
  315 => '315',
  316 => '316',
  317 => '317',
);
$GLOBALS['app_list_strings']['area_subjects_list']=array (
  '' => '',
  'Management Development Programme (MDP)' => 'Management Development Programme (MDP)',
  'Public Policy, Governance And Performance' => 'Public Policy, Governance And Performance',
  'Poverty And Rural Development' => 'Poverty And Rural Development',
  'Healthcare Management' => 'Healthcare Management',
  'Education Studies' => 'Education Studies',
  'Energy' => 'Energy',
  'Environment' => 'Environment',
  'Gender Studies' => 'Gender Studies',
  'Health Studies' => 'Health Studies',
  'Human Resources' => 'Human Resources',
  'Information Technology' => 'Information Technology',
  'Infrastructure Development' => 'Infrastructure Development',
  'International Trade and Finance, Industry, Macro-economic Policy and Public Finance' => 'International Trade and Finance, Industry, Macro-economic Policy and Public Finance',
  'Marketing' => 'Marketing',
  'Money, Banking, Corporate Finance and Governance' => 'Money, Banking, Corporate Finance and Governance',
  'Procurement, Operations, Materials and Project Management and Information Systems' => 'Procurement, Operations, Materials and Project Management and Information Systems',
  'Strategic Management' => 'Strategic Management',
  'Technology Policy, Management and Innovation' => 'Technology Policy, Management and Innovation',
  'Urban Governance' => 'Urban Governance',
);
$GLOBALS['app_list_strings']['lead_fac_1_centre_list']=array (
  '' => '',
  'Economics And Finance' => 'Economics And Finance',
  'Energy, Environment, Urban Governance And Infrastructure Development' => 'Energy, Environment, Urban Governance And Infrastructure Development',
  'Healthcare Management' => 'Healthcare Management',
  'Human Development' => 'Human Development',
  'Innovation And Technology' => 'Innovation And Technology',
  'Management Studies' => 'Management Studies',
  'Poverty And Rural Development' => 'Poverty And Rural Development',
  'Public Policy, Governance And Performance' => 'Public Policy, Governance And Performance',
);
$GLOBALS['app_list_strings']['memento_items_c_list']=array (
  '' => '',
  'OS' => 'Office Set',
  'PS' => 'Peacock Set',
  'Bidri' => 'Bidri',
  'OM' => 'Other Memento',
  'SC' => 'Silver Coin',
);
$GLOBALS['app_list_strings']['events_list']=array (
  '' => '',
  'HT' => 'High Tea',
  'FD' => 'Farewell Dinner',
  'GT' => 'DG’s Get Together',
  'GTD' => 'DG’s get together & Dinner',
  'ET' => 'Addl evening tea (CR)',
  'other' => 'Other',
  'WP' => 'Welcome Party',
);
$GLOBALS['app_list_strings']['prospect_list_type_dom']=array (
  'default' => 'Default',
  'exempt_address' => 'Suppression List - By Email Address',
  'test' => 'Test',
);
$GLOBALS['app_list_strings']['sector_list']=array (
  '' => '',
  'Agriculture and allied' => 'Agriculture and allied',
  'Aviation' => 'Aviation',
  'Banks & Insurance' => 'Banks & Insurance',
  'Consultancy' => 'Consultancy',
  'CPSU' => 'CPSU',
  'Defence allied departments' => 'Defence allied departments',
  'Departments' => 'Departments',
  'Educational Institutions' => 'Educational Institutions',
  'Energy' => 'Energy',
  'Exports and Imports Mining' => 'Exports and Imports Mining',
  'FMCG' => 'FMCG',
  'Hospitality' => 'Hospitality',
  'Law/ Legal' => 'Law/ Legal',
  'Logistic Services' => 'Logistic Services',
  'Manufacturing/ Construction/ Infrastructure' => 'Manufacturing/ Construction/ Infrastructure',
  'Media/ Fashion' => 'Media/ Fashion',
  'Metals' => 'Metals',
  'Others' => 'Others',
  'Pharma/ Bio-Tech' => 'Pharma/ Bio-Tech',
  'Port/Shipping' => 'Port/Shipping',
  'Railways' => 'Railways',
  'Retail' => 'Retail',
  'Surface Transportation' => 'Surface Transportation',
  'Telecom' => 'Telecom',
  'Trading' => 'Trading',
  'ULBs' => 'ULBs',
);

$GLOBALS['app_list_strings']['participants_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['currency_list']=array (
);

$GLOBALS['app_list_strings']['rating_list']=array (
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
);

$GLOBALS['app_list_strings']['attend_asci_programmes_list']=array (
);
$GLOBALS['app_list_strings']['programme_objective_list']=array (
  '' => '',
  'programmeObjective1' => 'Programme Objective 1',
  'programmeObjective2' => 'Programme Objective 2',
  'programmeObjective3' => 'Programme Objective 3',
);
$GLOBALS['app_list_strings']['programme_objective_rating']=array (
  1 => '1',
  2 => '2',
  3 => '3',
);

$GLOBALS['app_list_strings']['session_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['feedback_prog_relevance_list']=array (
  '' => '',
  'High' => 'High',
  'Med' => 'Med',
  'Low' => 'Low',
  'VeryLow' => 'Very Low',
);

$GLOBALS['app_list_strings']['feedback_requests_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);

$GLOBALS['app_list_strings']['feedback_status_list']=array (
  '' => '',
  'Accepted' => 'Accepted',
  'Rejected' => 'Rejected',
);
$app_list_strings['moduleList']['AOS_Contracts']='Custom Reports';
$app_list_strings['moduleListSingular']['AOS_Contracts']='Custom Report';
$GLOBALS['app_list_strings']['lead_status_dom']=array (
  '' => '',
  'Converted' => 'Converted',
  'Dead' => 'Dead',
  'New' => 'New',
  'Pending-Follow up by Email' => 'Pending-Follow up by Email',
);
$GLOBALS['app_list_strings']['nomination_status_list']=array (
  '' => '',
  'Nomination Received' => 'Nomination Received',
  'Commitment' => 'Commitment',
  'Screened by PO' => 'Screened by PO',
  'Accepted' => 'Accepted by PD',
  'Rejected' => 'Rejected',
  'Dropped Out' => 'Dropped Out',
);
$GLOBALS['app_list_strings']['programme_type_list']=array (
  '' => '',
  'Announced' => 'Announced',
  'ICTP-On Campus' => 'ICTP-On Campus',
  'ICTP-Off Campus' => 'ICTP-Off Campus',
  'Long Duration' => 'Long Duration',
  'Seminar' => 'Seminar',
  'Sponsored' => 'Sponsored',
  'Workshop ON Campus' => 'Workshop ON Campus',
  'Workshop OFF Campus' => 'Workshop OFF Campus',
);

$GLOBALS['app_list_strings']['center_pd_list']=array (
  '' => '',
  'Center1' => 'Center1',
  'Center2' => 'Center2',
  'Center3' => 'Center3',
);

$GLOBALS['app_list_strings']['area_pd_list']=array (
  '' => '',
  'Education Studies' => 'Education Studies',
  'Energy' => 'Energy',
  'Environment' => 'Environment',
  'Gender Studies' => 'Gender Studies',
  'Health Studies' => 'Health Studies',
  'Human Resources' => 'Human Resources',
  'Information Technology' => 'Information Technology',
  'Infrastructure Development' => 'Infrastructure Development',
  'International Trade and Finance, Industry, Macro-economic Policy and Public Finance' => 'International Trade and Finance, Industry, Macro-economic Policy and Public Finance',
  'Marketing' => 'Marketing',
  'Money, Banking, Corporate Finance and Governance' => 'Money, Banking, Corporate Finance and Governance',
  'Procurement, Operations, Materials and Project Management and Information Systems' => 'Procurement, Operations, Materials and Project Management and Information Systems',
  'Strategic Management' => 'Strategic Management',
  'Technology Policy, Management and Innovation' => 'Technology Policy, Management and Innovation',
  'Urban Governance' => 'Urban Governance',
);
$app_list_strings['moduleList']['scrm_Feedback_Sessions']='Programme Sessions Feedback';
$app_list_strings['moduleList']['scrm_Feedback_Objective']='Programme Objective Feedback';
$app_list_strings['moduleListSingular']['scrm_Feedback_Sessions']='Programme Sessions Feedback';
$app_list_strings['moduleListSingular']['scrm_Feedback_Objective']='Programme Objective Feedback';
$app_list_strings['moduleList']['SecurityGroups']='Centres';
$app_list_strings['moduleListSingular']['SecurityGroups']='Centre';
$GLOBALS['app_list_strings']['organisation_type_list']=array (
  '' => '',
  'Central Government' => 'Central Government',
  'Foreign' => 'Foreign',
  'International' => 'International',
  'Other' => 'Other',
  'Private' => 'Private',
  'PSU' => 'PSU',
  'State Government' => 'State Government',
);
$app_list_strings['moduleList']['scrm_Partners']='Faculty';
$GLOBALS['app_list_strings']['approval_airo_list']=array (
  '' => '',
  'Conference Room' => 'Conference Room',
  'Group Photograph' => 'Group Photograph',
  'Special event' => 'Special event',
  'PC & LCD' => 'PC & LCD',
  'Audio Recording-1' => 'Audio Recording-1',
  'Audio Recording-2' => 'Audio Recording-2',
  'Video Recording-1' => 'Video Recording-1',
  'Video Recording-2' => 'Video Recording-2',
  'Yoga' => 'Yoga',
  'Mementoes Item/Set' => 'Mementoes',
  'Stationery Item/Set' => 'Stationery',
  'Sightseeing Visit name' => 'Sightseeing',
  'Social/Recreational Event' => 'Social/Recreational',
  'Industry/Educational Visits Organisation' => 'Industry/Educational Visits',
);
$GLOBALS['app_list_strings']['asci_proposal_status_list']=array (
  '' => '',
  'EOI' => 'EOI submitted',
  'PUPSWF' => 'Proposal Under preparation',
  'MTDFF' => 'Marked to DOTP for Fee Approval',
  'ASC' => 'Approved',
  'SubmittedtoClient' => 'Submitted to Client',
  'RPAS' => 'Revised proposal Approved',
  'Submitted' => 'Submitted',
);
$GLOBALS['app_list_strings']['guest_type_list']=array (
  '' => '',
  'Participants' => 'Participants',
  'Guest Faculty' => 'Guest Faculty',
  'Faculty' => 'Faculty',
);
$GLOBALS['app_list_strings']['nationality_field_list']=array (
  '' => '',
  'Indian' => 'Indian',
  'ForeignNation' => 'Foreign Nation',
);
$GLOBALS['app_list_strings']['payment']=array (
  '' => '',
  'Cash' => 'Cash',
  'Cheque' => 'Cheque',
  'DD' => 'DD',
  'NEFT' => 'NEFT/RTGS',
  'Online Payment' => 'Online Payment',
);
$GLOBALS['app_list_strings']['client_type_list']=array (
  '' => '',
  'Registered Dealer' => 'Registered Dealer',
  'Un-Registered Dealer' => 'Un-Registered Dealer',
  'Government Department' => 'Government Department',
);
$GLOBALS['app_list_strings']['special_note_list']=array (
  'No' => 'No',
  'Yes' => 'Yes',
);
$GLOBALS['app_list_strings']['tax_type_list']=array (
  '' => '',
  'IGST' => 'IGST',
  'CGST' => 'CGST',
  'SGST' => 'SGST',
  'UGST' => 'UTGST',
);
$GLOBALS['app_list_strings']['tax_type_0']=array (
  '' => '',
  'Regular' => 'Regular',
  'Special' => 'Special',
);
$GLOBALS['app_list_strings']['stage_proforma_list']=array (
  'Draft-Proforma Invoice' => 'Draft-Proforma Invoice',
  'PO Verified' => 'PO Verified',
  'FOEXE Reviewed & confirmed' => 'FOEXE Reviewed & confirmed',
  'FOEXE Reviewed but not confirmed' => 'FOEXE Reviewed but not confirmed',
  'Approved by PO' => 'Approved by PO',
  'Proforma sent to client' => 'Proforma sent to client',
  'Ready to invoice' => 'Ready to invoice',
  'Cancelled' => 'Cancelled',
  'Closed for updates' => 'Closed for updates',
);
$GLOBALS['app_list_strings']['stage_list']=array (
  'Draft-Tax Invoice' => 'Draft-Tax Invoice',
  'FO Approved' => 'FO Approved',
  'Cancelled' => 'Cancelled',
  'Closed for updates' => 'Closed for updates',
);
$GLOBALS['app_list_strings']['bank_list']=array (
  'India' => 'India',
  'Foreign' => 'Foreign',
);
$GLOBALS['app_list_strings']['document_category_dom']=array (
  '' => '',
  'Brochure' => 'Brochure',
  'Feedback' => 'Feedback',
  'Flyers' => 'Flyers',
  'LOPs' => 'LOPs',
  'Others' => 'Others',
  'Participant Certificate' => 'Participant Certificate',
  'Passport' => 'Passport',
  'Photograph' => 'Photograph',
  'Proposal' => 'Proposal',
  'TaxInvoice' => 'Tax Invoice',
  'TimeTable' => 'Time Table',
  'Utilisation Certificate' => 'Utilisation Certificate',
  'Visa' => 'Visa',
  'Work Order' => 'Work Order',
);
$GLOBALS['app_list_strings']['mode_of_travel_list']=array (
  'Flight' => 'Flight',
  'Train' => 'Train',
  'Local' => 'Local',
);

$GLOBALS['app_list_strings']['yes_no_list']=array (
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['yes_no_blank_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
/*$GLOBALS['app_list_strings']['faculty_name_list']=array (
  '' => '',
  'c33e8d63-2685-466c-cb92-5a02c5eb8ef9' => ' K V Nanda Kishore',
  'd0213ddb-09a7-b880-9eba-5a7d37881865' => 'A B Prasad',
  '175b4fac-a9f8-8064-0bf9-5a9ce1358579' => 'A C Reddi',
  '7b60052c-dea4-157a-6cd2-5a02c4f072be' => 'A K Saxena',
  'ccb98cf6-51b6-dd64-2b89-59e0560793d1' => 'A P V N Sarma',
  '57f5eb8b-5f83-daff-4814-5a7d376f3117' => 'A S Rao',
  '7b5ee192-ce5a-dedb-446d-59d8554e9ba4' => 'Abhirama Krishna',
  'b83a4a2b-cc68-970c-64e2-5a81245c1799' => 'Advait',
  '74ae15dd-a811-ae6f-3e15-59ef151ae87d' => 'AjitPandit',
  'e95ab7c7-dcc3-9544-a4bc-59ef1144d732' => 'Akhilesh Awasthy',
  '2c4b0b8f-c030-81b0-83ec-59d88c78d49f' => 'Ambika Prasad Nanda',
  '5c97702d-71c3-2470-bb47-5a53151d03df' => 'Anil Yendluri',
  '9ef740e2-3987-a6e4-aaa6-5a097ed1acb5' => 'Arindam Das',
  '90aa2144-13c3-5015-66a3-59e05659b87d' => 'AshitaAllamraju',
  '9603fd6f-8834-ddd9-2c65-59e0566e8979' => 'Ashutosh Murti',
  'd94671d6-6fe9-595d-7d12-59e056b4d24f' => 'Ashwani Lohani',
  '438ae188-9ed5-6d47-a848-59e056f65c85' => 'Avik Sinha',
  'b90baf68-3089-0738-025c-5a9ce2e771e4' => 'B Janardhan Reddy',
  '4bc9eba0-ea36-0590-5e61-5a9ce2515c93' => 'B Kalyan Chakravarthy',
  '66ac1d2e-a75d-b9a3-febf-59fc2d480d15' => 'B Kinnera Murthy',
  '5bde394c-f1b3-aa81-618b-59e0568d841b' => 'B Lakshmi',
  'e44231cc-67ca-af9f-4e54-5a7936132863' => 'B N V Parthasarathi',
  'd4591cef-a6e2-24d7-5fd7-5a9ce3b9e6fa' => 'B S Chandra Murthy',
  'c3a54a96-cd84-c63b-f8cf-59df175b2bd7' => 'B S Chetty',
  '844ea6da-d939-33f9-a70b-5a8123303d5a' => 'B Srinivas',
  '73f3b456-4dde-9015-3d7d-5a61db7ea570' => 'B U K Reddy',
  '29ddcdd1-0801-2b00-f773-59e0543e4e70' => 'B V N Sachendra',
  'd71a5f40-c959-6298-594e-59f0550779d2' => 'B.Karunakar',
  'c0bbd18d-f5a0-5946-39f7-59e0540e4176' => 'Balbir Singh',
  'ee57d9f9-43b6-d4ee-b577-59cb892feef7' => 'Barun Mitra',
  '4e948c58-591d-02a5-1432-59e0545762e2' => 'Bhawna Gulati Muradia',
  '9a7dc7a1-1000-d976-8c7b-5a041e6ef8e4' => 'Bhuvaneswari Ravi',
  '48616f8f-9811-af72-641d-59cb89fd541c' => 'Binod Chandra Mishra',
  'e589a06d-ac5c-27c0-dabe-59e0561dd2bd' => 'C S Rama Lakshmi',
  '562342f1-89f8-7f72-fd90-5a9e65e8bc2f' => 'Ch Mohan Rao',
  '1e3de6bd-e8da-0fd5-4951-5a9ce306905e' => 'Ch V Tulasi',
  'c5c888a0-9b43-f009-a270-59cb866ebce8' => 'Chiranjiv Choudhary',
  'a2865868-6801-4277-2d80-5a5314d64f84' => 'Col M Rajgopal',
  'a2ff988f-73a1-932e-d695-5a9ce4fb0d99' => 'D Balasubramanian',
  'e0a846de-efa8-373b-6c44-5a9ce5038bdf' => 'D Padmalal',
  '6a400e32-6f58-df98-3ef5-59e056256455' => 'D Padmalal',
  '1535057c-e02c-063f-1b45-59e054ac576b' => 'D Rama Rao',
  '686d0382-eab1-7743-fd64-5a9ce6383567' => 'Deepak Raghu',
  '151866c5-223c-5cad-725f-59e054c86fdd' => 'Devender Madan',
  '870f726d-121c-ca06-099d-59e056ab4a45' => 'Dimple Grover',
  '5d9686d5-27d9-81e5-acd3-5a041eed62a4' => 'Dipesh Dipu',
  '1bef017c-a4e0-16df-7303-59f0551de23f' => 'Dr.P.Swati',
  '39af8398-c17b-33e6-4216-59d88d05d02b' => 'Dushyant Mahadik',
  '2d2d7013-ab74-bb8e-241f-59e0541d6fa7' => 'FS Haque',
  '6880e0e2-b5f7-6f2d-68cd-59e0564b91b1' => 'G Mohan',
  '370c75f3-f2a6-df46-f3d6-59e054026480' => 'G Ravi Kumar',
  '5d89cc60-8fe4-c5bc-24aa-59d88f39dcce' => 'G.V. Balaram',
  'a81b0859-cf29-7eb8-a8c3-5a02c597a89d' => 'Ganesh Ramamurthi',
  '60f37312-ad64-89b9-d5fc-5a9ce8102b64' => 'Gaurav Bhel',
  '437c95fc-5c0f-dc53-bd45-59e056b28ad2' => 'Harish Dua',
  'c6b3bc39-c792-e403-fb1e-5a9ce940702d' => 'Harkesh Kumar Mittal',
  '5fb1610f-e723-4c98-0c23-59e056d057a8' => 'Harsh Sharma',
  'c036f5ae-4f5c-0b21-7d16-59e056de7be4' => 'Humera Anjum',
  '517244dc-7966-d598-9996-59e05680e1fe' => 'I Y R Krishna Rao',
  '533a5cbb-ac5c-e1a5-d43c-5a9ce9de67d1' => 'Ivaturi Vijaya Kumar',
  '79df0b8a-688b-ab8c-d4a0-59e0564eacc5' => 'J Swarnalatha',
  '424ed050-0651-54ef-dbd8-5a9ce6bbadff' => 'Jagjeet Singh',
  '2eb726a8-2a2a-d093-7419-5a9ceaf9c437' => 'Janaki Ram',
  'ed473f9e-bd11-51ec-0cf1-59e0565aa82c' => 'Jayant Kumar Mohapatra',
  'b0b91db1-92ab-8ef7-e694-5a9cea642f4b' => 'Jibitesh Rath',
  '5eac4110-1e58-5bfc-3e9a-59e056d5bc2b' => 'Joy Elamon',
  '1e1c749f-06a2-a0e6-dd7d-59e05656fb01' => 'K B Chari',
  '6ce28bb2-a5d6-84f2-7537-59e05656cb18' => 'K Kameswara Rao',
  'c01da20a-5041-91e9-64fa-5a9d2bcc4f6c' => 'K Manicka Raj, IAS',
  '6f49c80c-c457-e539-eb42-5a000228a876' => 'K Padmanabhaiah',
  'c10688af-de16-1c18-af3f-5a61ddf52e3e' => 'K R Raghavan',
  '39d09a26-d379-d5aa-5903-5a9d2b284f9b' => 'K Sudakshina',
  'eab5421f-594b-4718-df32-5a9d2b996754' => 'K V S G Murali Krishna',
  'a292d2cd-70ef-ad0e-e6d9-59fc36246bb9' => 'K V S Sarma',
  '184f2446-15aa-856d-5afb-59d88f126a97' => 'K. Venugopala Rao',
  '2dc99008-e9e4-3eb0-ad73-5a0007984462' => 'Kamal Kumar',
  'cb1f0804-3647-a749-24a7-5a9d2b9ae1ed' => 'Kesavarapu Srinivas',
  '16a69e31-a54f-ab6d-4cb9-5a9e652f7c37' => 'Kiran Kumar Sharma',
  'bd7cdea9-febe-9eeb-f5b3-59d8556dd7e9' => 'KSS Rau',
  'dcd28922-88ee-51f8-92aa-5a097eb70961' => 'Lalita Anand',
  '443f0e25-ddb1-c7f7-edd5-5a04313a841c' => 'M Chandra Sekhar',
  'b80dd5d8-7268-8696-b92f-5a00095efe57' => 'M M Sharma',
  '122f0d13-dbb1-883b-17f6-59e056a906ef' => 'M Raja Shekar Reddy',
  '829c1cc8-5f44-136e-4bf1-59e056e78c60' => 'M S Raghavendra',
  '97eb449c-ffef-2498-a879-5a9ce6e24de2' => 'M S Ratnamani',
  '602f0276-fe85-7ce1-8373-5a041e615dfb' => 'M V Anjali',
  'c130f38a-5337-ed76-f841-5a0004ead847' => 'M V Krishna Rao',
  '6cf31be4-c3b4-bcbb-1679-59e054da8639' => 'M V S Rami Reddy',
  '790921db-38a9-1abb-d512-59e054fe3790' => 'M Vasanth Kumar',
  'bf208600-46c0-cafa-ce77-59fc366fd555' => 'M Y S Prasad',
  'da57d36d-88a6-109b-a7fc-5a9d2bfe7ad3' => 'Maj Gen (Retd) Dr R Siva ',
  'dcf07ac7-b3f8-490f-3912-59e08ac4c4ac' => 'Major Shiva Kiran',
  '85bc3ca5-1b12-a450-5193-59e054c42693' => 'Malini Chakravarty',
  '6c368397-28d6-165b-1c2d-59d857730c9e' => 'Mary Elliot',
  'a7dcbb80-cb84-93f2-220c-5a000454ca41' => 'Md. Ali Rafath',
  'e8c384ec-6e94-b262-c457-59e05434d4d9' => 'Mubeen Rafat',
  'c400d496-4af8-e622-fb0f-5a041ed1ef94' => 'MV Anjali',
  'c15ec884-d63b-f0e7-5ba9-59e0564808b4' => 'N R Bhusnurmath',
  '931eea86-a8da-a939-5120-59e054fd647f' => 'N Satyanarayana',
  '979bbfd3-9806-934a-32b5-5a7949a044f6' => 'N V Satyanarayana',
  'f19dfc8d-7dfe-ff0a-37ed-59e088096e56' => 'Naveenchandra N Srivastav',
  '4cf241b1-2c9c-fac0-740f-59d889fb1ac8' => 'Neeraj Kapoor',
  '31090bf3-b878-45fd-58be-5a5313af9a60' => 'Nikhil Gupta',
  'b8466a86-2d49-c58e-638e-59e054bd0c63' => 'Nirmala Apsingikar',
  'ce9140b9-ce8c-bf6a-251e-59e0541f9aaa' => 'Nirmalya Bagchi',
  '7d2b33ca-6b76-8e43-366b-59ef147942ac' => 'Nitin Marjara ',
  '8a04f798-3dfb-6601-7aab-5a9d2c72cd90' => 'P G Sastry',
  'd35895f6-6427-8efa-9d87-59d6334bdceb' => 'P Nihalani',
  'b26ee3af-8f6f-b1b1-a6a6-5a9d2c78ba43' => 'P S R K Prasad',
  '9e7ff727-c985-bc05-63b3-59e0561df4d9' => 'P Shahaida',
  'f1f2fc38-4cb1-5771-0ce6-59df174fc3d5' => 'P Subhashini',
  'b60a74d7-520a-daff-47a5-5a9d2c519c95' => 'Palaniappan Meyyappan',
  '7793deab-ed73-e0a2-69d1-59e089c3e4cd' => 'Pankaj Kumar Sampat',
  '9ca5b5a7-81e1-7382-efc1-5a097e912994' => 'Paramita Dasgupta',
  '9fe65a5c-25cf-5335-a700-5a8121349e6e' => 'Pavan Palle',
  'b763bc49-40cb-31e6-af8d-59e054eb22bd' => 'Pinaki Chakraborty',
  '3c9fc60e-d021-1722-1eb1-59d763e46610' => 'Prabhati Pati',
  '7d8d7813-901c-6852-d60a-59ef154ea9c0' => 'Prasanna Rao',
  '26c2e1f4-e625-2e60-259e-59e0544807ba' => 'R Sobha',
  '974bcfb6-e443-31b8-0a5e-5a9d2c56c9b3' => 'Rajeev Chourey',
  '7b9c55e0-00ea-53b6-7c09-59fffbf4f96d' => 'Rajen Habib Khwaja, IAS',
  '69002a1c-c57a-9863-afe3-59e0542cdff3' => 'Rajkiran V Bilolikar',
  '50d9a920-59b8-903a-14c6-5a7937ac5f5b' => 'Randip Singh Jagpal',
  '89256967-ced3-29d6-81ef-5a7d3666d343' => 'Rebecca Mathai',
  '87410159-913c-fc68-0764-59e05427a723' => 'Reshmy Nair',
  '8a6f9495-4e33-0a7d-e009-59ef1519c6da' => 'Rohit Bajaj',
  'c2efe1d5-98fb-c7fa-03b6-59e05419eef7' => 'S Chatterjee',
  '9caa1866-a989-00b5-3ef6-5a9d2c05c467' => 'S Chinnam Reddy',
  'e7c1a78e-aff4-5b72-3df4-5a2e53759905' => 'S M Ahmed',
  'd221d3cb-c02d-45fd-ebc6-59d633f55a68' => 'S M Jamdar',
  'b35064c3-d11b-2e90-9f58-59e0566ab5f1' => 'S Snehalatha',
  '470cd842-4056-4ccc-f4cc-5a2e521b7a2e' => 'S Sunderrajan',
  'b53bb718-bc15-b700-14c9-5a2772e2a724' => 'S Thirumalai',
  'b9a90438-f296-ff65-fd79-59d88c5b3667' => 'S. M. Jamdar',
  'afc63c3d-3c58-1e6e-5e42-59d88b81aadb' => 'S.K.Joshi',
  'ec295385-8fa1-ba7b-05e6-59e0561a2912' => 'Sachin Chowdhry',
  'ba8507df-0756-7c28-3e8c-5a02c532c071' => 'Samba Murthy',
  'c75c51be-320e-f27f-b63d-5a9d2c025245' => 'Sanganagouda Dhawalgi',
  '44bbd296-4dfc-baae-e202-59d889e6b249' => 'Sangram Keshari Mohapatra',
  '5b6a015f-7c54-001b-c177-59e056c17ccd' => 'Sanjay Kothari',
  '333fab5c-dd49-310a-dfee-59e054bba737' => 'Sanjay Kumar Gupta',
  'e45633a3-307d-1dd5-043d-59ef14e56eaf' => 'Sanjeev Mehra',
  'cedcbc27-22cd-86a7-0515-59d88fee2317' => 'Saswat Kishore Mishra',
  '6024e3c3-a6ff-e2c1-8a25-59cb88deed59' => 'SBL Mishra,',
  '3cf013dc-af50-22f4-0066-5a9d2d2922ec' => 'Shalini Narayanan',
  'c99ccd52-4f06-5a64-754c-59d88f0f4ae1' => 'Shri Manoj Pant',
  'dc449399-da89-2cf0-b844-5a2772a2f5b1' => 'Sistla Venkateswarlu',
  '7dcf022b-f17d-766f-64e1-5a9d2d882eb3' => 'Soman Roy Burman',
  '4db200c4-3b2d-41a4-f799-59e05635d584' => 'Sreerupa Sengupta',
  'afeb2234-5015-508a-79f9-5a793707a0f9' => 'Srikant Maram',
  'c7b25840-6bb9-e0f3-c2c7-59e0560d46fe' => 'Srilekha Ravvarapu',
  'b00e42ef-0977-c8fc-29b7-5a9d2df3e0f7' => 'Srinivas Chaganti',
  '83b5c662-cdca-9ad1-ca43-5a7d378d2d0c' => 'Srinivasan Sundarrajan',
  'c4c0a842-3400-f5cb-5e5e-5a9d2d7ea9fc' => 'Subhadra Jalali',
  '2d47a21e-f662-8c56-bd07-59e0540b3c9f' => 'Subodh Kandamuthan',
  'dfd5e030-adde-9220-ea8e-5a9d2d43812c' => 'Subrata Sarkar',
  '73a28819-aaf4-f824-5aa1-59e080a79af0' => 'Sudarsanam Padam',
  '6a9cc313-2c69-ebf2-cdec-59ef150b750f' => 'Sudhir Bharti',
  '398df164-b6fb-be46-1775-5a9d2d6580e6' => 'Sumitro Kar',
  '3250846f-7ff1-37b0-daed-59fc36feb3d2' => 'Surendra Kumar',
  '365add63-8723-14f6-c7b1-59e056f97671' => 'Sutanuka Dev Roy',
  'f242b313-acf1-487e-60b1-5a9d2d43d3d7' => 'T Babji',
  '83529286-ca50-9b37-7639-5a278c8ee740' => 'T Jagannadham',
  '1bdb257a-9451-04ef-220d-59e054b15924' => 'TEC Vidya Sagar',
  '5f0c7e51-f919-4d4f-eacf-5a61dd603fd3' => 'Thomas Samson',
  '11ef2701-e653-6641-9045-59e05666adcc' => 'Tripti Pande Desai',
  '1dbc72f7-1deb-8d43-4562-59e05656b75a' => 'Urfi Prasad',
  '5bd49d47-ea3b-980e-cf2e-59e05445e2b8' => 'Usha Ramachandra',
  'c13a1d2d-f5e2-f39e-b41a-5a27bca89977' => 'V C Vivekanandan',
  '12b93776-3583-9100-1d75-5a9d2e09aa89' => 'V P Dimri',
  '2a39c69f-013d-2bd1-0a7f-59e056de69d3' => 'V Ravindran',
  '10ab6b70-1c97-46d5-bb52-5a9d2ecd01bd' => 'V S Raman',
  '1eaad701-226f-717e-868e-59e05659bf6d' => 'V Srinivas Chary',
  '657f840b-6b5e-3a73-a18e-5a9d2ebf01ac' => 'V Srinivasa Rao',
  '8354c99b-3a78-0d6c-93c7-5a27b3bec9ed' => 'V Udaya Bhaskar',
  'cf3bab05-4fd0-4d47-2ee3-59e71c36b2a1' => 'V. Bhaskar',
  '2e8d32fe-364d-bedc-2d38-59e056735f4e' => 'Valli Manickam',
  '88867480-9c85-4e03-18cb-5a04313e37a3' => 'Vasavi Narla',
  '7936a467-5fb9-ec2f-6cdb-5a9d2e216892' => 'Venkatesh Bangaruswamy',
  'b5c49a23-e326-233e-9d5b-5a000abee730' => 'Venkateswar Rao',
  'de4cda65-3526-b2d4-ef76-5a9ce6e1fe26' => 'Vijaya Nagesh',
  '518da698-6697-2f71-a1a1-5a04316e28bf' => 'Vijaya Venkataraman',
  '1b00c505-f53a-389f-5245-5a9d2edba2dc' => 'Vikram Kashyap',
  '957ca381-e8dd-9e4b-32ec-5a9d2e6d4c3b' => 'Vikramaditya Duggal',
  '8cd3b83c-0561-e6b8-75ff-5a9d2e7c132c' => 'Vilas A Tonapi',
  '1c9c0e63-cdb1-5a72-2e30-59e054049e06' => 'Vilas Shah',
  'ec2c1197-05ae-0088-39c1-5a02c4229125' => 'Vineet Rastogi',
  '1137712b-98b3-8b8b-bab7-59e054d54110' => 'Vinod Kumar Agarwal',
  '80aa670c-8a1c-2840-931f-5a9d2e09de33' => 'Vinod Ramanarayanan',
  'ccc4cdbc-5363-7292-027a-5a9d2f8dfa97' => 'Vipin Singh',
  'e93dc082-14ca-d3d4-aafc-59ef1124e0f0' => 'Vishal Pandya ',
  '98e34621-d127-922d-e0f9-5a02c5df912e' => 'Vishvanathan',
  '6be60490-cd21-486c-9c5a-59e054ad2717' => 'Y Malini Reddy',
  '1bba4a29-b213-07c6-c7eb-5a041ef42b0b' => 'Y Subramanyam',
  '32309f99-c3eb-be63-acf9-59fc36466ee6' => 'Y V N Krishna Murthy',
  '11c4bc91-4a18-5c36-4cab-5a02c5c35be1' => 'Yasmin Aghai',
  'e32a0b40-a08c-c2fb-a972-5a0005eee096' => 'Yogita Rana',
);
$GLOBALS['app_list_strings']['faculty_name_list']=array (
  '' => '',
  'c33e8d63-2685-466c-cb92-5a02c5eb8ef9' => ' K V Nanda Kishore',
  'd0213ddb-09a7-b880-9eba-5a7d37881865' => 'A B Prasad',
  '175b4fac-a9f8-8064-0bf9-5a9ce1358579' => 'A C Reddi',
  '7b60052c-dea4-157a-6cd2-5a02c4f072be' => 'A K Saxena',
  'ccb98cf6-51b6-dd64-2b89-59e0560793d1' => 'A P V N Sarma',
  '57f5eb8b-5f83-daff-4814-5a7d376f3117' => 'A S Rao',
  '7b5ee192-ce5a-dedb-446d-59d8554e9ba4' => 'Abhirama Krishna',
  'b83a4a2b-cc68-970c-64e2-5a81245c1799' => 'Advait',
  '74ae15dd-a811-ae6f-3e15-59ef151ae87d' => 'AjitPandit',
  'e95ab7c7-dcc3-9544-a4bc-59ef1144d732' => 'Akhilesh Awasthy',
  '2c4b0b8f-c030-81b0-83ec-59d88c78d49f' => 'Ambika Prasad Nanda',
  '5c97702d-71c3-2470-bb47-5a53151d03df' => 'Anil Yendluri',
  '9ef740e2-3987-a6e4-aaa6-5a097ed1acb5' => 'Arindam Das',
  '90aa2144-13c3-5015-66a3-59e05659b87d' => 'AshitaAllamraju',
  '9603fd6f-8834-ddd9-2c65-59e0566e8979' => 'Ashutosh Murti',
  'd94671d6-6fe9-595d-7d12-59e056b4d24f' => 'Ashwani Lohani',
  '438ae188-9ed5-6d47-a848-59e056f65c85' => 'Avik Sinha',
  'b90baf68-3089-0738-025c-5a9ce2e771e4' => 'B Janardhan Reddy',
  '4bc9eba0-ea36-0590-5e61-5a9ce2515c93' => 'B Kalyan Chakravarthy',
  '66ac1d2e-a75d-b9a3-febf-59fc2d480d15' => 'B Kinnera Murthy',
  '5bde394c-f1b3-aa81-618b-59e0568d841b' => 'B Lakshmi',
  'e44231cc-67ca-af9f-4e54-5a7936132863' => 'B N V Parthasarathi',
  'd4591cef-a6e2-24d7-5fd7-5a9ce3b9e6fa' => 'B S Chandra Murthy',
  'c3a54a96-cd84-c63b-f8cf-59df175b2bd7' => 'B S Chetty',
  '844ea6da-d939-33f9-a70b-5a8123303d5a' => 'B Srinivas',
  '73f3b456-4dde-9015-3d7d-5a61db7ea570' => 'B U K Reddy',
  '29ddcdd1-0801-2b00-f773-59e0543e4e70' => 'B V N Sachendra',
  'd71a5f40-c959-6298-594e-59f0550779d2' => 'B.Karunakar',
  'c0bbd18d-f5a0-5946-39f7-59e0540e4176' => 'Balbir Singh',
  'ee57d9f9-43b6-d4ee-b577-59cb892feef7' => 'Barun Mitra',
  '4e948c58-591d-02a5-1432-59e0545762e2' => 'Bhawna Gulati Muradia',
  '9a7dc7a1-1000-d976-8c7b-5a041e6ef8e4' => 'Bhuvaneswari Ravi',
  '48616f8f-9811-af72-641d-59cb89fd541c' => 'Binod Chandra Mishra',
  'e589a06d-ac5c-27c0-dabe-59e0561dd2bd' => 'C S Rama Lakshmi',
  '562342f1-89f8-7f72-fd90-5a9e65e8bc2f' => 'Ch Mohan Rao',
  '1e3de6bd-e8da-0fd5-4951-5a9ce306905e' => 'Ch V Tulasi',
  'c5c888a0-9b43-f009-a270-59cb866ebce8' => 'Chiranjiv Choudhary',
  'a2865868-6801-4277-2d80-5a5314d64f84' => 'Col M Rajgopal',
  'a2ff988f-73a1-932e-d695-5a9ce4fb0d99' => 'D Balasubramanian',
  'e0a846de-efa8-373b-6c44-5a9ce5038bdf' => 'D Padmalal',
  '6a400e32-6f58-df98-3ef5-59e056256455' => 'D Padmalal',
  '1535057c-e02c-063f-1b45-59e054ac576b' => 'D Rama Rao',
  '686d0382-eab1-7743-fd64-5a9ce6383567' => 'Deepak Raghu',
  '151866c5-223c-5cad-725f-59e054c86fdd' => 'Devender Madan',
  '870f726d-121c-ca06-099d-59e056ab4a45' => 'Dimple Grover',
  '5d9686d5-27d9-81e5-acd3-5a041eed62a4' => 'Dipesh Dipu',
  '1bef017c-a4e0-16df-7303-59f0551de23f' => 'Dr.P.Swati',
  '39af8398-c17b-33e6-4216-59d88d05d02b' => 'Dushyant Mahadik',
  '2d2d7013-ab74-bb8e-241f-59e0541d6fa7' => 'FS Haque',
  '6880e0e2-b5f7-6f2d-68cd-59e0564b91b1' => 'G Mohan',
  '370c75f3-f2a6-df46-f3d6-59e054026480' => 'G Ravi Kumar',
  '5d89cc60-8fe4-c5bc-24aa-59d88f39dcce' => 'G.V. Balaram',
  'a81b0859-cf29-7eb8-a8c3-5a02c597a89d' => 'Ganesh Ramamurthi',
  '60f37312-ad64-89b9-d5fc-5a9ce8102b64' => 'Gaurav Bhel',
  '437c95fc-5c0f-dc53-bd45-59e056b28ad2' => 'Harish Dua',
  'c6b3bc39-c792-e403-fb1e-5a9ce940702d' => 'Harkesh Kumar Mittal',
  '5fb1610f-e723-4c98-0c23-59e056d057a8' => 'Harsh Sharma',
  'c036f5ae-4f5c-0b21-7d16-59e056de7be4' => 'Humera Anjum',
  '517244dc-7966-d598-9996-59e05680e1fe' => 'I Y R Krishna Rao',
  '533a5cbb-ac5c-e1a5-d43c-5a9ce9de67d1' => 'Ivaturi Vijaya Kumar',
  '79df0b8a-688b-ab8c-d4a0-59e0564eacc5' => 'J Swarnalatha',
  '424ed050-0651-54ef-dbd8-5a9ce6bbadff' => 'Jagjeet Singh',
  '2eb726a8-2a2a-d093-7419-5a9ceaf9c437' => 'Janaki Ram',
  'ed473f9e-bd11-51ec-0cf1-59e0565aa82c' => 'Jayant Kumar Mohapatra',
  'b0b91db1-92ab-8ef7-e694-5a9cea642f4b' => 'Jibitesh Rath',
  '5eac4110-1e58-5bfc-3e9a-59e056d5bc2b' => 'Joy Elamon',
  '1e1c749f-06a2-a0e6-dd7d-59e05656fb01' => 'K B Chari',
  '6ce28bb2-a5d6-84f2-7537-59e05656cb18' => 'K Kameswara Rao',
  'c01da20a-5041-91e9-64fa-5a9d2bcc4f6c' => 'K Manicka Raj, IAS',
  '6f49c80c-c457-e539-eb42-5a000228a876' => 'K Padmanabhaiah',
  'c10688af-de16-1c18-af3f-5a61ddf52e3e' => 'K R Raghavan',
  '39d09a26-d379-d5aa-5903-5a9d2b284f9b' => 'K Sudakshina',
  'eab5421f-594b-4718-df32-5a9d2b996754' => 'K V S G Murali Krishna',
  'a292d2cd-70ef-ad0e-e6d9-59fc36246bb9' => 'K V S Sarma',
  '184f2446-15aa-856d-5afb-59d88f126a97' => 'K. Venugopala Rao',
  '2dc99008-e9e4-3eb0-ad73-5a0007984462' => 'Kamal Kumar',
  'cb1f0804-3647-a749-24a7-5a9d2b9ae1ed' => 'Kesavarapu Srinivas',
  '16a69e31-a54f-ab6d-4cb9-5a9e652f7c37' => 'Kiran Kumar Sharma',
  'bd7cdea9-febe-9eeb-f5b3-59d8556dd7e9' => 'KSS Rau',
  'dcd28922-88ee-51f8-92aa-5a097eb70961' => 'Lalita Anand',
  '443f0e25-ddb1-c7f7-edd5-5a04313a841c' => 'M Chandra Sekhar',
  'b80dd5d8-7268-8696-b92f-5a00095efe57' => 'M M Sharma',
  '122f0d13-dbb1-883b-17f6-59e056a906ef' => 'M Raja Shekar Reddy',
  '829c1cc8-5f44-136e-4bf1-59e056e78c60' => 'M S Raghavendra',
  '97eb449c-ffef-2498-a879-5a9ce6e24de2' => 'M S Ratnamani',
  '602f0276-fe85-7ce1-8373-5a041e615dfb' => 'M V Anjali',
  'c130f38a-5337-ed76-f841-5a0004ead847' => 'M V Krishna Rao',
  '6cf31be4-c3b4-bcbb-1679-59e054da8639' => 'M V S Rami Reddy',
  '790921db-38a9-1abb-d512-59e054fe3790' => 'M Vasanth Kumar',
  'bf208600-46c0-cafa-ce77-59fc366fd555' => 'M Y S Prasad',
  'da57d36d-88a6-109b-a7fc-5a9d2bfe7ad3' => 'Maj Gen (Retd) Dr R Siva ',
  'dcf07ac7-b3f8-490f-3912-59e08ac4c4ac' => 'Major Shiva Kiran',
  '85bc3ca5-1b12-a450-5193-59e054c42693' => 'Malini Chakravarty',
  '6c368397-28d6-165b-1c2d-59d857730c9e' => 'Mary Elliot',
  'a7dcbb80-cb84-93f2-220c-5a000454ca41' => 'Md. Ali Rafath',
  'e8c384ec-6e94-b262-c457-59e05434d4d9' => 'Mubeen Rafat',
  'c400d496-4af8-e622-fb0f-5a041ed1ef94' => 'MV Anjali',
  'c15ec884-d63b-f0e7-5ba9-59e0564808b4' => 'N R Bhusnurmath',
  '931eea86-a8da-a939-5120-59e054fd647f' => 'N Satyanarayana',
  '979bbfd3-9806-934a-32b5-5a7949a044f6' => 'N V Satyanarayana',
  'f19dfc8d-7dfe-ff0a-37ed-59e088096e56' => 'Naveenchandra N Srivastav',
  '4cf241b1-2c9c-fac0-740f-59d889fb1ac8' => 'Neeraj Kapoor',
  '31090bf3-b878-45fd-58be-5a5313af9a60' => 'Nikhil Gupta',
  'b8466a86-2d49-c58e-638e-59e054bd0c63' => 'Nirmala Apsingikar',
  'ce9140b9-ce8c-bf6a-251e-59e0541f9aaa' => 'Nirmalya Bagchi',
  '7d2b33ca-6b76-8e43-366b-59ef147942ac' => 'Nitin Marjara ',
  '8a04f798-3dfb-6601-7aab-5a9d2c72cd90' => 'P G Sastry',
  'd35895f6-6427-8efa-9d87-59d6334bdceb' => 'P Nihalani',
  'b26ee3af-8f6f-b1b1-a6a6-5a9d2c78ba43' => 'P S R K Prasad',
  '9e7ff727-c985-bc05-63b3-59e0561df4d9' => 'P Shahaida',
  'f1f2fc38-4cb1-5771-0ce6-59df174fc3d5' => 'P Subhashini',
  'b60a74d7-520a-daff-47a5-5a9d2c519c95' => 'Palaniappan Meyyappan',
  '7793deab-ed73-e0a2-69d1-59e089c3e4cd' => 'Pankaj Kumar Sampat',
  '9ca5b5a7-81e1-7382-efc1-5a097e912994' => 'Paramita Dasgupta',
  '9fe65a5c-25cf-5335-a700-5a8121349e6e' => 'Pavan Palle',
  'b763bc49-40cb-31e6-af8d-59e054eb22bd' => 'Pinaki Chakraborty',
  '3c9fc60e-d021-1722-1eb1-59d763e46610' => 'Prabhati Pati',
  '7d8d7813-901c-6852-d60a-59ef154ea9c0' => 'Prasanna Rao',
  '26c2e1f4-e625-2e60-259e-59e0544807ba' => 'R Sobha',
  '974bcfb6-e443-31b8-0a5e-5a9d2c56c9b3' => 'Rajeev Chourey',
  '7b9c55e0-00ea-53b6-7c09-59fffbf4f96d' => 'Rajen Habib Khwaja, IAS',
  '69002a1c-c57a-9863-afe3-59e0542cdff3' => 'Rajkiran V Bilolikar',
  '50d9a920-59b8-903a-14c6-5a7937ac5f5b' => 'Randip Singh Jagpal',
  '89256967-ced3-29d6-81ef-5a7d3666d343' => 'Rebecca Mathai',
  '87410159-913c-fc68-0764-59e05427a723' => 'Reshmy Nair',
  '8a6f9495-4e33-0a7d-e009-59ef1519c6da' => 'Rohit Bajaj',
  'c2efe1d5-98fb-c7fa-03b6-59e05419eef7' => 'S Chatterjee',
  '9caa1866-a989-00b5-3ef6-5a9d2c05c467' => 'S Chinnam Reddy',
  'e7c1a78e-aff4-5b72-3df4-5a2e53759905' => 'S M Ahmed',
  'd221d3cb-c02d-45fd-ebc6-59d633f55a68' => 'S M Jamdar',
  'b35064c3-d11b-2e90-9f58-59e0566ab5f1' => 'S Snehalatha',
  '470cd842-4056-4ccc-f4cc-5a2e521b7a2e' => 'S Sunderrajan',
  'b53bb718-bc15-b700-14c9-5a2772e2a724' => 'S Thirumalai',
  'b9a90438-f296-ff65-fd79-59d88c5b3667' => 'S. M. Jamdar',
  'afc63c3d-3c58-1e6e-5e42-59d88b81aadb' => 'S.K.Joshi',
  'ec295385-8fa1-ba7b-05e6-59e0561a2912' => 'Sachin Chowdhry',
  'ba8507df-0756-7c28-3e8c-5a02c532c071' => 'Samba Murthy',
  'c75c51be-320e-f27f-b63d-5a9d2c025245' => 'Sanganagouda Dhawalgi',
  '44bbd296-4dfc-baae-e202-59d889e6b249' => 'Sangram Keshari Mohapatra',
  '5b6a015f-7c54-001b-c177-59e056c17ccd' => 'Sanjay Kothari',
  '333fab5c-dd49-310a-dfee-59e054bba737' => 'Sanjay Kumar Gupta',
  'e45633a3-307d-1dd5-043d-59ef14e56eaf' => 'Sanjeev Mehra',
  'cedcbc27-22cd-86a7-0515-59d88fee2317' => 'Saswat Kishore Mishra',
  '6024e3c3-a6ff-e2c1-8a25-59cb88deed59' => 'SBL Mishra,',
  '3cf013dc-af50-22f4-0066-5a9d2d2922ec' => 'Shalini Narayanan',
  'c99ccd52-4f06-5a64-754c-59d88f0f4ae1' => 'Shri Manoj Pant',
  'dc449399-da89-2cf0-b844-5a2772a2f5b1' => 'Sistla Venkateswarlu',
  '7dcf022b-f17d-766f-64e1-5a9d2d882eb3' => 'Soman Roy Burman',
  '4db200c4-3b2d-41a4-f799-59e05635d584' => 'Sreerupa Sengupta',
  'afeb2234-5015-508a-79f9-5a793707a0f9' => 'Srikant Maram',
  'c7b25840-6bb9-e0f3-c2c7-59e0560d46fe' => 'Srilekha Ravvarapu',
  'b00e42ef-0977-c8fc-29b7-5a9d2df3e0f7' => 'Srinivas Chaganti',
  '83b5c662-cdca-9ad1-ca43-5a7d378d2d0c' => 'Srinivasan Sundarrajan',
  'c4c0a842-3400-f5cb-5e5e-5a9d2d7ea9fc' => 'Subhadra Jalali',
  '2d47a21e-f662-8c56-bd07-59e0540b3c9f' => 'Subodh Kandamuthan',
  'dfd5e030-adde-9220-ea8e-5a9d2d43812c' => 'Subrata Sarkar',
  '73a28819-aaf4-f824-5aa1-59e080a79af0' => 'Sudarsanam Padam',
  '6a9cc313-2c69-ebf2-cdec-59ef150b750f' => 'Sudhir Bharti',
  '398df164-b6fb-be46-1775-5a9d2d6580e6' => 'Sumitro Kar',
  '3250846f-7ff1-37b0-daed-59fc36feb3d2' => 'Surendra Kumar',
  '365add63-8723-14f6-c7b1-59e056f97671' => 'Sutanuka Dev Roy',
  'f242b313-acf1-487e-60b1-5a9d2d43d3d7' => 'T Babji',
  '83529286-ca50-9b37-7639-5a278c8ee740' => 'T Jagannadham',
  '1bdb257a-9451-04ef-220d-59e054b15924' => 'TEC Vidya Sagar',
  '5f0c7e51-f919-4d4f-eacf-5a61dd603fd3' => 'Thomas Samson',
  '11ef2701-e653-6641-9045-59e05666adcc' => 'Tripti Pande Desai',
  '1dbc72f7-1deb-8d43-4562-59e05656b75a' => 'Urfi Prasad',
  '5bd49d47-ea3b-980e-cf2e-59e05445e2b8' => 'Usha Ramachandra',
  'c13a1d2d-f5e2-f39e-b41a-5a27bca89977' => 'V C Vivekanandan',
  '12b93776-3583-9100-1d75-5a9d2e09aa89' => 'V P Dimri',
  '2a39c69f-013d-2bd1-0a7f-59e056de69d3' => 'V Ravindran',
  '10ab6b70-1c97-46d5-bb52-5a9d2ecd01bd' => 'V S Raman',
  '1eaad701-226f-717e-868e-59e05659bf6d' => 'V Srinivas Chary',
  '657f840b-6b5e-3a73-a18e-5a9d2ebf01ac' => 'V Srinivasa Rao',
  '8354c99b-3a78-0d6c-93c7-5a27b3bec9ed' => 'V Udaya Bhaskar',
  'cf3bab05-4fd0-4d47-2ee3-59e71c36b2a1' => 'V. Bhaskar',
  '2e8d32fe-364d-bedc-2d38-59e056735f4e' => 'Valli Manickam',
  '88867480-9c85-4e03-18cb-5a04313e37a3' => 'Vasavi Narla',
  '7936a467-5fb9-ec2f-6cdb-5a9d2e216892' => 'Venkatesh Bangaruswamy',
  'b5c49a23-e326-233e-9d5b-5a000abee730' => 'Venkateswar Rao',
  'de4cda65-3526-b2d4-ef76-5a9ce6e1fe26' => 'Vijaya Nagesh',
  '518da698-6697-2f71-a1a1-5a04316e28bf' => 'Vijaya Venkataraman',
  '1b00c505-f53a-389f-5245-5a9d2edba2dc' => 'Vikram Kashyap',
  '957ca381-e8dd-9e4b-32ec-5a9d2e6d4c3b' => 'Vikramaditya Duggal',
  '8cd3b83c-0561-e6b8-75ff-5a9d2e7c132c' => 'Vilas A Tonapi',
  '1c9c0e63-cdb1-5a72-2e30-59e054049e06' => 'Vilas Shah',
  'ec2c1197-05ae-0088-39c1-5a02c4229125' => 'Vineet Rastogi',
  '1137712b-98b3-8b8b-bab7-59e054d54110' => 'Vinod Kumar Agarwal',
  '80aa670c-8a1c-2840-931f-5a9d2e09de33' => 'Vinod Ramanarayanan',
  'ccc4cdbc-5363-7292-027a-5a9d2f8dfa97' => 'Vipin Singh',
  'e93dc082-14ca-d3d4-aafc-59ef1124e0f0' => 'Vishal Pandya ',
  '98e34621-d127-922d-e0f9-5a02c5df912e' => 'Vishvanathan',
  '6be60490-cd21-486c-9c5a-59e054ad2717' => 'Y Malini Reddy',
  '1bba4a29-b213-07c6-c7eb-5a041ef42b0b' => 'Y Subramanyam',
  '32309f99-c3eb-be63-acf9-59fc36466ee6' => 'Y V N Krishna Murthy',
  '11c4bc91-4a18-5c36-4cab-5a02c5c35be1' => 'Yasmin Aghai',
  'e32a0b40-a08c-c2fb-a972-5a0005eee096' => 'Yogita Rana',
);*/
$GLOBALS['app_list_strings']['budget_sight_seeing_list']=array (
  '' => '',
  'Golkonda Sound & Light Show' => 'Sound & Light Show - Golconda Fort',
  'Ramoji Film City' => 'Ramoji Film City',
  'City Tour' => 'City Tour',
  'Others' => 'Others Visits',
);