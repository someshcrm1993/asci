<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AjaxCall{

    protected $msg = true;
    protected $data = array();
    public function __construct(){
        
    }
    public function getParticipantWrtProg($pid,$currency){
        global $db;
        $participantquery = $db->query("SELECT concat(COALESCE(c.first_name,''),' ',COALESCE(c.last_name,'')) as name,c.id,pcs.programme_fee_c,pcs.usd_c,pcs.euro_c,pcs.programme_fee_non_res_c,pcs.euro_non_res_c,pcs.usd_non_res_c, cc.type_c,cc.nomination_status_c FROM contacts c join project_contacts_2_c pc on pc.project_contacts_2contacts_idb = c.id join project p on p.id =  pc.project_contacts_2project_ida join project_cstm pcs on pcs.id_c = p.id join contacts_cstm cc on cc.id_c = c.id WHERE p.id = '".$pid."' and p.deleted = 0 and pc.deleted = 0 and c.deleted = 0 and cc.nomination_status_c !='Rejected' and cc.nomination_status_c !='Dropped Out'");
        $data = array();
        $accommodations_participant_query = $db->query("
            SELECT 
                GROUP_CONCAT(scrm_accommodation_cstm.participants_c) as participant_json
            FROM scrm_accommodation_cstm 
            JOIN scrm_accommodation ON scrm_accommodation.id = scrm_accommodation_cstm.id_c
            JOIN project_scrm_accommodation_1_c ON project_scrm_accommodation_1_c.project_scrm_accommodation_1scrm_accommodation_idb = scrm_accommodation_cstm.id_c
            JOIN project ON project.id = project_scrm_accommodation_1_c.project_scrm_accommodation_1project_ida
            WHERE project.id = '{$pid}' 
            AND scrm_accommodation.deleted = '0'");
        $acp = $db->fetchByAssoc($accommodations_participant_query);
        // print_r($acp['participant_json']);exit();
        $i = 0;
        while($participantrow = $db->fetchByAssoc($participantquery)){
            if (strpos($acp['participant_json'], $participantrow['id']) == false) {

                $data['name'][] = $participantrow['name'].",".$participantrow['id'];
                if ($currency == "-99") {
                    $data['programme_fee_c'][] = $participantrow['programme_fee_c'];
                }else if ($currency == "41ae018e-238a-8ed8-d615-592513e171a5") {
                    $data['programme_fee_c'][] = $participantrow['euro_c'];
                }else if ($currency == "5d3103c2-4a19-b7bf-75da-592586ee4aec") {
                    $data['programme_fee_c'][] = $participantrow['usd_c'];
                }else{
                    $data['programme_fee_c'][] = $participantrow['programme_fee_c'];
                }

                if ($currency == "-99") {
                    $data['programme_fee_non_res_c'][] = $participantrow['programme_fee_non_res_c'];
                }else if ($currency == "41ae018e-238a-8ed8-d615-592513e171a5") {
                    $data['programme_fee_non_res_c'][] = $participantrow['euro_non_res_c'];
                }else if ($currency == "5d3103c2-4a19-b7bf-75da-592586ee4aec") {
                    $data['programme_fee_non_res_c'][] = $participantrow['usd_non_res_c'];
                }else{
                    $data['programme_fee_non_res_c'][] = $participantrow['programme_fee_non_res_c'];
                }
                if (is_null($data['programme_fee_non_res_c'][$i])) {
                    $data['programme_fee_non_res_c'][$i] = 0;
                }

                if (is_null($data['programme_fee_c'][$i])) {
                    $data['programme_fee_c'][$i] = 0;
                }
                $i++;
                $data['type_c'][] = $participantrow['type_c'];
                $data['nomination_status_c'][] = $participantrow['nomination_status_c'];              
                }
        }

        if(empty($data)){
            $this->msg = false;
        }
        return array('Success'=>$this->msg,'data'=>$data,'query'=>"SELECT concat(COALESCE(c.first_name,''),' ',COALESCE(c.last_name,'')) as name,c.id,pcs.programme_fee_c, cc.type_c FROM contacts c join project_contacts_2_c pc on pc.project_contacts_2contacts_idb = c.id  join project p on p.id =  pc.project_contacts_2project_ida join project_cstm pcs on pcs.id_c = p.id join contacts_cstm cc on cc.id_c = c.id where p.id = '".$pid."' and p.deleted = 0 and pc.deleted = 0 and c.deleted = 0");
    }
    
    public function getParticipantWrtProgAndOrg($pid,$oid,$currency){
        global $db;
        $participantquery = $db->query("SELECT concat(COALESCE(c.first_name,''),' ',COALESCE(c.last_name,'')) as name,c.id,pcs.programme_fee_c,pcs.usd_c,pcs.euro_c,pcs.programme_fee_non_res_c,pcs.euro_non_res_c,pcs.usd_non_res_c, cc.type_c,cc.nomination_status_c FROM contacts c join  project_contacts_2_c pc on pc.project_contacts_2contacts_idb = c.id  join project p on p.id =  pc.project_contacts_2project_ida join project_cstm pcs on pcs.id_c = p.id join contacts_cstm cc on cc.id_c = c.id join accounts a on a.id = cc.account_id_c where p.id = '$pid' and a.id = '$oid' and a.deleted = 0 and p.deleted = 0 and pc.deleted = 0 and c.deleted = 0 and cc.nomination_status_c !='Rejected' and cc.nomination_status_c !='Dropped Out'");
        $data = array();
        $i=0;
        while($participantrow = $db->fetchByAssoc($participantquery)){
            $data['name'][] = $participantrow['name'].",".$participantrow['id'];
            if ($currency == "-99") {
                $data['programme_fee_c'][] = $participantrow['programme_fee_c'];
            }else if ($currency == "41ae018e-238a-8ed8-d615-592513e171a5") {
                $data['programme_fee_c'][] = $participantrow['euro_c'];
            }else if ($currency == "5d3103c2-4a19-b7bf-75da-592586ee4aec") {
                $data['programme_fee_c'][] = $participantrow['usd_c'];
            }else{
                $data['programme_fee_c'][] = $participantrow['programme_fee_c'];
            }

            if ($currency == "-99") {
                $data['programme_fee_non_res_c'][] = $participantrow['programme_fee_non_res_c'];
            }else if ($currency == "41ae018e-238a-8ed8-d615-592513e171a5") {
                $data['programme_fee_non_res_c'][] = $participantrow['euro_non_res_c'];
            }else if ($currency == "5d3103c2-4a19-b7bf-75da-592586ee4aec") {
                $data['programme_fee_non_res_c'][] = $participantrow['usd_non_res_c'];
            }else{
                $data['programme_fee_non_res_c'][] = $participantrow['programme_fee_non_res_c'];
            }
            if (is_null($data['programme_fee_non_res_c'][$i])) {
                $data['programme_fee_non_res_c'][$i] = 0;
            }

            if (is_null($data['programme_fee_c'][$i])) {
                $data['programme_fee_c'][$i] = 0;
            }
            $i++;
            $data['type_c'][] = $participantrow['type_c'];
            $data['nomination_status_c'][] = $participantrow['nomination_status_c'];

        }
        if(empty($data)){
            $this->msg = false;
        }
        $discount = false;
        if ($pid) {
                $projectBean = BeanFactory::getBean('Project',$pid);

                if (strtotime(date('Y-m-d')) <= strtotime($projectBean->ebd_date_c)) {
                    $discount = true;
                }
        }

        return array('Success'=>$this->msg,'data'=>$data,'query'=>"SELECT concat(c.first_name,' ',c.last_name) as name,c.id,pcs.programme_fee_c FROM contacts c join  project_contacts_2_c pc on pc.project_contacts_2contacts_idb = c.id  join project p on p.id =  pc.project_contacts_2project_ida join project_cstm pcs on pcs.id_c = p.id join contacts_cstm cc on cc.id_c = c.id join accounts a on a.id = cc.account_id_c where p.id = '$pid' and a.id = '$oid' and a.deleted = 0 and p.deleted = 0 and pc.deleted = 0 and c.deleted = 0",'result'=>$currency=='-99','discount'=>$discount);
    }

    public function getOrganisationAddr($oid){
        global $db;
        $organisationquery = $db->query("SELECT * FROM accounts a join accounts_cstm ac on a.id = ac.id_c where a.deleted = 0 and a.id = '$oid'");
        $data = array();
        while($organisationrow = $db->fetchByAssoc($organisationquery)){
            $data['billing_address_street'][] = $organisationrow['billing_address_street'];
            $data['billing_address_city'][] = $organisationrow['billing_address_city'];
            $data['billing_address_state'][] = $organisationrow['billing_address_state'];
            $data['billing_address_postalcode'][] = $organisationrow['billing_address_postalcode'];
            $data['billing_address_country'][] = $organisationrow['billing_address_country'];
            $data['client1_gst_c'][] = $organisationrow['client1_gst_c'];
        }
        if(empty($data)){
            $this->msg = false;
        }
        return array('Success'=>$this->msg,'data'=>$data);
    }

    public function getSelfSponsorOrganisationAddr($oid){
        global $db;
        $organisationquery = $db->query("SELECT * FROM contacts c join contacts_cstm cc on c.id = cc.id_c where c.deleted = 0 and c.id = '$oid'");
        $data = array();
        while($organisationrow = $db->fetchByAssoc($organisationquery)){
            $data['billing_address_street'][] = $organisationrow['primary_address_street'];
            $data['billing_address_city'][] = $organisationrow['primary_address_city'];
            $data['billing_address_state'][] = $organisationrow['primary_address_state'];
            $data['billing_address_postalcode'][] = $organisationrow['primary_address_postalcode'];
            $data['billing_address_country'][] = $organisationrow['primary_address_country'];
            $data['client1_gst_c'][] = $organisationrow['client1_gst_c'];
        }
        if(empty($data)){
            $this->msg = false;
        }
        return array('Success'=>$this->msg,'data'=>$data);
    }

    public function getBlockedRooms($dataA = array())
    {
        $projectBean = BeanFactory::getBean('Project',$dataA['pid']);
        // print_r($projectBean->room_no_bv_c);exit();
        
        $participantsBean = $projectBean->get_linked_beans('project_contacts_2', 'Contacts', array(), 0, -1, 0, "nomination_status_c='Accepted'");
        if (count($participantsBean)>0) {
            $createAccommodation = true;
        }else{
            $createAccommodation = false;
        }

        $response = array();
        $response['cpc_new'] = $projectBean->room_no_cpc_new_c;
        $response['cpc_old'] = $projectBean->room_no_cpc_old_c;
        $response['bv'] = $projectBean->room_no_bv_c;
        $response['ndc'] = $projectBean->room_no_ndc_c;
        $response['start_date'] = $projectBean->start_date_c;
        $response['end_date'] = $projectBean->end_date_c;
        $this->msg = true;
        
        return array('Success'=>$this->msg,'data'=>$response,'createAccommodation'=>$createAccommodation);            
    }

    public function getCRAccommodations($dataA = '')
    {
        global $db;
        
        $start_date = date_create_from_format('d-m-Y', $dataA['start_date']);
        $start_date = date_format($start_date, 'Y-m-d');
        if ($start_date == '') {
            $start_date = date('Y-m-d');
        }

        $end_date = date_create_from_format('d-m-Y', $dataA['end_date']);
        $end_date = date_format($end_date, 'Y-m-d');
        if ($end_date == '') {
            $end_date = date('Y-m-d');
        }

        $result = $db->query("SELECT count(*) as count,b1.cr_no_c from project_cstm as b1 inner join project as b2 on b1.id_c = b2.id where ((b1.start_date_c <= '$end_date' and b1.end_date_c >= '$start_date') or (b1.start_date_c <= '$start_date' and b1.end_date_c >= '$start_date')) and b2.deleted = 0 group by b1.cr_no_c");


        //fetch accommodations configuration
        $accommodations = $db->query("SELECT * from scrm_accommodation_configurations_cstm");
        $accommodations_result = $db->fetchByAssoc($accommodations);
        $response = array();
        $cpc_audi = 0;
        $cpc_edp = 0;
        $cpc_cr1 = 0;
        $cpc_cr2 = 0;
        $cpc_cr3 = 0;
        $cpc_cr4 = 0;
        $bv1 = 0;
        $bv2 = 0;
        $bv3 = 0;
        $bv4 = 0;
        $response['book'] = true;
        $book = 0;
        while ($resultData = $db->fetchByAssoc($result)) {
            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'Auditorium') !== false) {
                $cpc_audi = $cpc_audi + $resultData['count'];
                $book = $response['cpc-audi'] = "NA"; 
                
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'EDP') !== false) {
                $cpc_edp = $cpc_edp + $resultData['count'];
                $book = $response['cpc-edp'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'CPC CR I') !== false) {
                $cpc_cr1 = $cpc_cr1 + $resultData['count'];
                $book = $response['cpc-cr1'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'CPC CR II') !== false) {
                $cpc_cr2 = $cpc_cr2 + $resultData['count'];
                $book = $response['cpc-cr2'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'CPC CR III') !== false) {
                $cpc_cr3 = $cpc_cr3 + $resultData['count'];
                $book = $response['cpc-cr3'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'CPC CR IV') !== false) {
                $cpc_cr4 = $cpc_cr4 + $resultData['count'];
                $book = $response['cpc-cr4'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'BV CR I') !== false) {
                $bv1 = $bv1 + $resultData['count'];
                $book = $response['bv1'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'BV CR II') !== false) {
                $bv2 = $bv2 + $resultData['count'];
                $book = $response['bv2'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'BV CR III') !== false) {
                $bv3 = $bv3 + $resultData['count'];
                $book = $response['bv3'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'BV CR IV') !== false) {
                $bv4 = $bv4 + $resultData['count'];
                $book = $response['bv4'] = "NA"; 
            }

            if (isset($resultData['cr_no_c']) && strpos($resultData['cr_no_c'], 'BV CR V') !== false) {
                $bv4 = $bv4 + $resultData['count'];
                $book = $response['bv5'] = "NA"; 
            }

            foreach ($dataA['cr_no'] as $key => $value) {
                if (strpos($resultData['cr_no_c'], $value) !== false) {
                    if ($response['book']) {
                        $response['book'] = ($book == "NA" ? false : true);
                    }

                }
            }

        }
        $this->msg = true;
        return array('Success'=>$this->msg,'data'=>$response,'data_cr'=>implode(',', $dataA['cr_no']));

    }

    public function getAccommodations($dataA = '')
    {
        global $db;

        $date = date_create_from_format('d-m-Y H.i', $dataA['datetime']);
        $date = date_format($date, 'Y-m-d H.i');
        if ($date == '') {
            $date = date('Y-m-d H.i');
        }


        $result = $db->query("SELECT count(*) as count,b1.type_of_room_c,b1.guest_type_c,GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where b1.check_in_c <= '{$date}' and b1.check_out_c >= '{$date}' and b1.location_c like '%{$dataA['location']}%' and b2.deleted = 0 group by b1.type_of_room_c,b1.guest_type_c");

        //fetch accommodations configuration
        $accommodations = $db->query("SELECT * from scrm_accommodation_configurations_cstm");
        $accommodations_result = $db->fetchByAssoc($accommodations);

        //success true or false 
        $this->msg = true;
        
        //add data to be sent as response
        $response = array();
        $response['book'] = true;
        $response['rooms_available'] = 0;

        if (isset($dataA['location'])) {
            switch ($dataA['location']) {
                case 'CPC_NEW':
                case 'CPC_OLD':
                    $response['location'] = 'cpc';
                    if (isset($dataA['location']) && $dataA['location'] == 'CPC_NEW') {
                        $response['cpc_new_total'] = $accommodations_result['cpc_new_block_c'];
                    }else if(isset($dataA['location']) && $dataA['location'] == 'CPC_OLD'){
                        $response['cpc_old_total'] = $accommodations_result['cpc_old_block_c'];
                    }
                    while ($resultData = $db->fetchByAssoc($result)) {
                        if ($resultData['type_of_room_c'] == 'Single Room') {
                            if ($resultData['location_c'] == 'CPC_OLD') {
                                $bookOld = $response['cpc_old_single'] = ($accommodations_result['cpc_old_single_occupancy_c'] - $resultData['count']);
                            }else{
                                $book = $response['cpc_new_single'] = ($accommodations_result['cpc_new_single_occupancy_c'] - $resultData['count']);
                            }
                        }
                        
                        if ($resultData['type_of_room_c'] == 'Double Room') {
                            if ($resultData['location_c'] == 'CPC_OLD') {
                                $book = $response['cpc_old_double'] = ($accommodations_result['cpc_old_double_occupancy_c'] - $resultData['count']);
                            }else{
                                $book = $response['cpc_new_double'] = ($accommodations_result['cpc_new_double_occupancy_c'] - $resultData['count']);
                            }
                        }
                        
                        if ($resultData['type_of_room_c'] == 'Reserved') {
                            if ($resultData['location_c'] == 'CPC_OLD') {
                                if ($resultData['guest_type_c'] == 'Other') {
                                    $book = $response['cpc_old_reservation_req'] = ($accommodations_result['cpc_old_r_a_r_r_c'] - $resultData['count']);
                                }else{
                                    $book = $response['cpc_old_reservation_stds'] = ($accommodations_result['cpc_old_reserved_students_c'] - $resultData['count']);
                                }

                            }else{
                                $book = $response['cpc_new_reservation_req'] = ($accommodations_result['cpc_new_r_a_r_r_c'] - $resultData['count']);
                            }       
                        }

                        //check booking status 
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] != '' && ($dataA['type_of_room'] == $resultData['type_of_room_c']) && ($dataA['location'] == $resultData['location_c']) && isset($dataA['guest_type']) && $dataA['guest_type'] == $resultData['guest_type_c']) {
                            
                            if ($book != 'done') {    
                                $response['rooms_booked'] = $resultData['rooms_booked'];
                                $response['rooms_available'] = $book > 0 ? $book : 0;
                                $response['book'] = $book > 0; 
                            }
                            $book = 'done';

                        }
                        if ($resultData['location_c'] == 'CPC_OLD' && $dataA['location'] == 'CPC_OLD') {
                            $response['cpc_old_total'] = $response['cpc_old_total'] - $resultData['count'];
                        }else{
                            $response['cpc_new_total'] = $response['cpc_new_total'] - $resultData['count'];
                        }

                    }
                    
                    if (!isset($response['cpc_new_reservation_req']) && isset($dataA['location']) && $dataA['location'] == 'CPC_NEW' && isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && isset($dataA['guest_type']) && $dataA['guest_type'] == 'Other') {

                        $response['cpc_new_reservation_req'] = $accommodations_result['cpc_new_r_a_r_r_c'];
                        $response['rooms_booked'] = "0";
                        $response['rooms_available'] = 0;
                        $response['book'] = false; 
                    }

                    if (!isset($response['cpc_new_reservation_stds']) && isset($dataA['location']) && $dataA['location'] == 'CPC_NEW' && isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && isset($dataA['guest_type']) && $dataA['guest_type'] == 'Student') {

                        $response['cpc_new_reservation_stds'] = $accommodations_result['cpc_new_reserved_students_c'];
                        $response['rooms_booked'] = "0";
                        $response['rooms_available'] = 0;
                        $response['book'] = false; 
                    }

                    if (!isset($response['cpc_old_reservation_req']) && isset($dataA['location']) && $dataA['location'] == 'CPC_OLD' && isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && isset($dataA['guest_type']) && $dataA['guest_type'] == 'Other') {

                        $response['cpc_old_reservation_req'] = $accommodations_result['cpc_old_r_a_r_r_c'];
                        $response['rooms_booked'] = "0";
                        $response['rooms_available'] = $accommodations_result['cpc_old_r_a_r_r_c'];
                        $response['book'] = true;
                    }

                    if (!isset($response['cpc_old_reservation_req']) && isset($dataA['location']) && $dataA['location'] == 'CPC_OLD' && isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && isset($dataA['guest_type']) && $dataA['guest_type'] == 'Student') {

                        $response['cpc_old_reservation_req'] = $accommodations_result['cpc_new_reserved_students_c'];
                        $response['rooms_booked'] = "0";
                        $response['rooms_available'] = $accommodations_result['cpc_new_reserved_students_c'];
                        $response['book'] = true;
                    }

                    if ($result->num_rows == 0) {
                        if (!isset($response['cpc_new_single']) && $dataA['location'] == 'CPC_NEW') {
                            $response['cpc_new_single'] = $accommodations_result['cpc_new_single_occupancy_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Single Room' && $dataA['location'] == 'CPC_NEW') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['cpc_new_single'];
                            }
                        }

                        if (!isset($response['cpc_new_double']) && $dataA['location'] == 'CPC_NEW') {
                            $response['cpc_new_double'] = $accommodations_result['cpc_new_double_occupancy_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Double Room' && $dataA['location'] == 'CPC_NEW') {
                                $response['rooms_booked'] = '';
                                $response['book'] = false;
                                $response['rooms_available'] = $response['cpc_new_double'];
                            }
                        }

                        if (!isset($response['cpc_old_single']) && $dataA['location'] == 'CPC_OLD') {
                            $response['cpc_old_single'] = $accommodations_result['cpc_old_single_occupancy_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Single Room' && $dataA['location'] == 'CPC_OLD') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['cpc_old_single'];
                            }
                        }

                        if (!isset($response['cpc_old_double']) && $dataA['location'] == 'CPC_OLD') {
                            $response['cpc_old_double'] = $accommodations_result['cpc_old_double_occupancy_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Double Room' && $dataA['location'] == 'CPC_OLD') {
                                $response['rooms_booked'] = '';
                                $response['book'] = false;
                                $response['rooms_available'] = $response['cpc_old_double'];
                            }
                        }

                        if (!isset($response['cpc_new_reservation_req']) && $dataA['location'] == 'CPC_NEW') {
                            $response['cpc_new_reservation_req'] = $accommodations_result['cpc_new_r_a_r_r_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && $dataA['location'] == 'CPC_NEW') {
                                $response['rooms_booked'] = '';
                                $response['book'] = false;
                                $response['rooms_available'] = 0;
                            }
                        }

                        if (!isset($response['cpc_old_reservation_req']) && $dataA['location'] == 'CPC_OLD') {
                            $response['cpc_old_reservation_req'] = $accommodations_result['cpc_old_r_a_r_r_c'];
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && $dataA['location'] == 'CPC_OLD' && $dataA['guest_type_c'] == 'Other') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['cpc_old_reservation_req'];
                            }
                        }

                        if (!isset($response['cpc_old_reservation_stds']) && $dataA['location'] == 'CPC_OLD') {
                            $response['cpc_old_reservation_stds'] = $accommodations_result['cpc_old_reserved_students_c'];
                            // print_r($dataA);exit();
                            if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved' && $dataA['location'] == 'CPC_OLD' && $dataA['guest_type'] == 'Student') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['cpc_old_reservation_stds'];
                            }
                        }
                        $response['cpc_old_mdp_allocable'] = @$response['cpc_old_single'] + @$response['cpc_old_double'];
                        $response['cpc_new_mdp_allocable'] = @$response['cpc_new_single'] + @$response['cpc_new_double'];
                    }else{
                        if (isset($dataA['location']) && $dataA['location'] == "CPC_NEW") {
                            if (!isset($response['cpc_new_single'])) {
                                $response['cpc_new_single'] = $accommodations_result['cpc_new_single_occupancy_c'];
                            }

                            if (!isset($response['cpc_new_double'])) {
                                $response['cpc_new_double'] = $accommodations_result['cpc_new_double_occupancy_c'];
                            }
                            $response['cpc_new_mdp_allocable'] = @$response['cpc_new_single'] + @$response['cpc_new_double'];
                        }

                        if (isset($dataA['location']) && $dataA['location'] == "CPC_OLD") {
                            if (!isset($response['cpc_old_single'])) {
                                $response['cpc_old_single'] = $accommodations_result['cpc_old_single_occupancy_c'];
                            }

                            if (!isset($response['cpc_old_double'])) {
                                $response['cpc_old_double'] = $accommodations_result['cpc_old_double_occupancy_c'];
                            }
                             $response['cpc_old_mdp_allocable'] = @$response['cpc_old_single'] + @$response['cpc_old_double'];
                        }
                       

                    } 

                    break;

                case 'Bella Vista':

                    $response['location'] = 'bv';
                    $response['bv_total'] = $accommodations_result['bv_total_c'];
                    while ($resultData = $db->fetchByAssoc($result)) {
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Single Room') {
                           $book = $response['bv_single'] = ($accommodations_result['bv_single_occupancy_rooms_c'] - $resultData['count']); 
                        }else if(isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Double Room') {
                           $book = $response['bv_double'] = ($accommodations_result['bv_double_occupancy_rooms_c'] - $resultData['count']);
                        }      
                        
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved') {
                            $book = $response['bv_guest_fac'] = ($accommodations_result['bv_rooms_reserved_guest_fac_c'] - $resultData['count']); 
                        }

                        //check booking status 
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] != '' && ($dataA['type_of_room'] == $resultData['type_of_room_c'])) {
                            if ($book != 'done') {
                                $response['rooms_booked'] = $resultData['rooms_booked'];
                                $response['rooms_available'] = $book > 0 ? "".$book."" : "0";
                                $response['book'] = $book > 0; 
                            }

                            $book = 'done';

                        }

                        $response['bv_total'] = ($response['bv_total'] - $resultData['count']);  
                    }
                    // print_r($response);exit();

                    if (!isset($response['bv_single'])) {
                        $response['bv_single'] = $accommodations_result['bv_single_occupancy_rooms_c'];
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Single Room') {
                            $response['rooms_booked'] = '';
                            $response['rooms_available'] = "".$response['bv_single']."";
                        }
                    }

                    if (!isset($response['bv_double'])) {
                        $response['bv_double'] = $accommodations_result['bv_double_occupancy_rooms_c'];
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Double Room') {
                            $response['rooms_booked'] = '';
                            $response['rooms_available'] = "".$response['bv_double']."";
                        }
                    }

                    if (!isset($response['bv_guest_fac'])) {
                        $response['bv_guest_fac'] = $accommodations_result['bv_rooms_reserved_guest_fac_c'];
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] == 'Reserved') {
                            $response['rooms_booked'] = '';
                            $response['rooms_available'] = "".$response['bv_rooms_reserved_guest_fac_c']."";
                        }
                    }                   
                    $response['bv_mdp_participants'] = $response['bv_single'] + $response['bv_double'];
                    break;
                case 'NDC':
                    $response['location'] = 'ndc';
        
                    while ($resultData = $db->fetchByAssoc($result)) {
                        if (isset($resultData['guest_type_c']) && $resultData['guest_type_c'] == 'Guest Faculty') {
                            $book = $response['ndc_guest_rooms'] = ($accommodations_result['ndc_hotel_guest_rooms_c'] - $resultData['count']);
                           
                        }else if(isset($resultData['guest_type_c']) && $resultData['guest_type_c'] == 'DG') {
                            $book = $response['ndc_dg_rooms'] = ($accommodations_result['ndc_reserved_for_dg_c'] - $resultData['count']);
                        }else if(isset($resultData['guest_type_c']) && $resultData['guest_type_c'] == 'Faculty') {
                            $book = $response['ndc_reserved_fac'] = ($accommodations_result['ndc_reserved_for_faculty_c'] - $resultData['count']);
                        }    
                        //check booking status 
                        if (isset($dataA['type_of_room']) && $dataA['type_of_room'] != '' && ($dataA['type_of_room'] == $resultData['type_of_room_c'])) {
                            if ($book != 'done') {
                                $response['rooms_booked'] = $resultData['rooms_booked'];
                                $response['rooms'] = $response['book'] > 0 ? $response['book'] : 0;
                                $response['book'] = $book > 0; 
                            }

                            $book = 'done';

                        }
                    }

                    if (!isset($response['ndc_guest_rooms'])) {
                        $response['ndc_guest_rooms'] = $accommodations_result['ndc_hotel_guest_rooms_c'];
                        if (isset($dataA['guest_type_c']) && $dataA['guest_type_c'] == 'Guest Faculty') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['ndc_guest_rooms'];
                        }
                    }

                    if (!isset($response['ndc_dg_rooms'])) {
                        $response['ndc_dg_rooms'] = $accommodations_result['ndc_reserved_for_dg_c'];
                        if (isset($dataA['guest_type_c']) && $dataA['guest_type_c'] == 'DG') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['ndc_dg_rooms'];

                        }
                    } 

                    if (!isset($response['ndc_reserved_fac'])) {
                        $response['ndc_reserved_fac'] = $accommodations_result['ndc_reserved_for_faculty_c'];
                        if (isset($dataA['guest_type_c']) && $dataA['guest_type_c'] == 'Faculty') {
                                $response['rooms_booked'] = '';
                                $response['rooms_available'] = $response['ndc_reserved_fac'];

                        }                  
                    }     
                    break;         
                default:
                    //success true or false 
                    $this->msg = false;
                    break;
            }

        }

        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT count(*) as count,b1.type_of_room_c,b1.guest_type_c,GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where b1.check_in_c <= '{$date}' and b1.check_out_c >= '{$date}' and b1.location_c like '%{$dataA['location']}%' and b2.deleted = 0 group by b1.type_of_room_c,b1.guest_type_c");   
    }

    public function getAccommodationsRooms($dataA = '')
    {
        global $db;

        $date = date_create_from_format('d-m-Y H.i', $dataA['datetime']);
        $date = date_format($date, 'Y-m-d H.i');
        if ($date == '') {
            $date = date('Y-m-d H.i');
        }

        $dateCO = date_create_from_format('d-m-Y H.i', $dataA['datetimeCO']);
        $dateCO = date_format($dateCO, 'Y-m-d H.i');
        if ($dateCO == '') {
            $dateCO = date('Y-m-d H.i');
        }


        $result = $db->query("SELECT count(*) as count, GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where ((b1.check_in_c <= '{$date}' and b1.check_out_c >= '{$date}') || (b1.check_in_c <= '{$dateCO}' and b1.check_out_c >= '{$dateCO}'))  and b1.location_c like '%{$dataA['location']}%' and b2.deleted = 0");

        //success true or false 
        $this->msg = true;
        
        //add data to be sent as response
        $response = array();

        if (isset($dataA['location'])) {
            switch ($dataA['location']) {
                case 'CPC_NEW':
                case 'CPC_OLD':
                    $response['location'] = 'cpc';
                    $resultData = $db->fetchByAssoc($result);
                    $response['rooms_booked'] = $resultData['rooms_booked'];

                    break;

                case 'Bella Vista':

                    $response['location'] = 'bv';
                    
                    $resultData = $db->fetchByAssoc($result);
                    $response['rooms_booked'] = $resultData['rooms_booked'];

                    break;
                case 'NDC':
                    $response['location'] = 'ndc';

                    $resultData = $db->fetchByAssoc($result);
                    $response['rooms_booked'] = $resultData['rooms_booked'];   
                    
                    break;         
                default:
                    //success true or false 
                    $this->msg = false;
                    break;
            }

        }

        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT count(*) as count, GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where ((b1.check_in_c >= '{$date}' and b1.check_out_c >= '{$date}') || (b1.check_in_c >= '{$dateCO}' and b1.check_out_c >= '{$dateCO}'))  and b1.location_c like '%{$dataA['location']}%' and b2.deleted = 0");   
    }

    public function getAccommodationsRoomsInProgramme($dataA = '')
    {
        global $db;

        $date = date_create_from_format('d-m-Y', $dataA['start']);
        $date = date_format($date, 'Y-m-d');
        if ($date == '') {
            $date = date('Y-m-d H.i');
        }

        $dateCO = date_create_from_format('d-m-Y', $dataA['end']);
        $dateCO = date_format($dateCO, 'Y-m-d');
        if ($dateCO == '') {
            $dateCO = date('Y-m-d H.i');
        }
        

        $result = $db->query("SELECT GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where (('{$date}' BETWEEN date(b1.check_in_c)  and date(b1.check_out_c) ) || ('{$dateCO}' BETWEEN date(b1.check_in_c) and date(b1.check_out_c))) and b2.deleted = 0 group by b1.location_c");

        $resultProject = $db->query("SELECT GROUP_CONCAT( b1.room_no_bv_c ) AS rooms_booked_bv, GROUP_CONCAT( b1.room_no_cpc_new_c ) AS rooms_booked_cpc_new, GROUP_CONCAT( b1.room_no_cpc_old_c ) AS rooms_booked_cpc_old, GROUP_CONCAT( b1.room_no_ndc_c ) AS rooms_booked_ndc FROM project_cstm AS b1 INNER JOIN project AS b2 ON b1.id_c = b2.id where (('{$date}' BETWEEN b1.start_date_c AND b1.end_date_c ) || ('{$dateCO}' BETWEEN b1.start_date_c AND b1.end_date_c)) and b2.deleted = 0");

        //success true or false 
        $this->msg = true;
        
        //add data to be sent as response
        $response = array();
        while ($resultData = $db->fetchByAssoc($result)) {
            if ($resultData['location_c'] == 'CPC_NEW') {
                $response['cpc_new']['booked'] = $resultData['rooms_booked'];
            }elseif ($resultData['location_c'] == 'CPC_OLD') {
                $response['cpc_old']['booked'] = $resultData['rooms_booked'];
            }elseif ($resultData['location_c'] == 'Bella Vista') {
                $response['bv']['booked'] = $resultData['rooms_booked'];
            }elseif ($resultData['location_c'] == 'NDC') {
                $response['ndc']['booked'] = $resultData['rooms_booked'];
            }
        }

        $resultProjectData = $db->fetchByAssoc($resultProject);
        $response['cpc_new']['blocked'] = $resultProjectData['rooms_booked_cpc_new'];
        $response['cpc_old']['blocked'] = $resultProjectData['rooms_booked_cpc_old'];
        $response['ndc']['blocked'] = $resultProjectData['rooms_booked_ndc'];
        $response['bv']['blocked'] = $resultProjectData['rooms_booked_bv'];

        // $resultData = $db->fetchByAssoc($result);
        // $response['rooms_booked'] = $resultData['rooms_booked'];  
        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT GROUP_CONCAT( b1.room_no_c ) as rooms_booked, b1.location_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id where (('{$date}' BETWEEN b1.check_in_c  and b1.check_out_c ) || ('{$dateCO}' BETWEEN b1.check_in_c and b1.check_out_c)) and b2.deleted = 0 group by b1.location_c",'queryProject'=>"SELECT GROUP_CONCAT( b1.room_no_bv_c ) AS rooms_booked_bv, GROUP_CONCAT( b1.room_no_cpc_new_c ) AS rooms_booked_cpc_new, GROUP_CONCAT( b1.room_no_cpc_old_c ) AS rooms_booked_cpc_old, GROUP_CONCAT( b1.room_no_ndc_c ) AS rooms_booked_ndc FROM project_cstm AS b1 INNER JOIN project AS b2 ON b1.id_c = b2.id where (('{$date}' BETWEEN b1.start_date_c AND b1.end_date_c ) || ('{$dateCO}' BETWEEN b1.start_date_c AND b1.end_date_c)) and b2.deleted = 0");   
    }

    public function getAccommodationsRoomsByProgramme($dataA = '')
    {
        global $db;

        $date = date_create_from_format('d-m-Y', $dataA['start']);
        $date = date_format($date, 'Y-m-d');
        if ($date == '') {
            $date = date('Y-m-d H.i');
        }

        $dateCO = date_create_from_format('d-m-Y', $dataA['end']);
        $dateCO = date_format($dateCO, 'Y-m-d');
        if ($dateCO == '') {
            $dateCO = date('Y-m-d H.i');
        }
        

        $result = $db->query("SELECT GROUP_CONCAT( b1.room_no_bv_c ) AS rooms_booked_bv, GROUP_CONCAT( b1.room_no_cpc_new_c ) AS rooms_booked_cpc_new, GROUP_CONCAT( b1.room_no_cpc_old_c ) AS rooms_booked_cpc_old, GROUP_CONCAT( b1.room_no_ndc_c ) AS rooms_booked_ndc, b1.location_c FROM scrm_accommodation_cstm AS b1 INNER JOIN scrm_accommodation AS b2 ON b1.id_c = b2.id INNER JOIN project_scrm_accommodation_1_c AS b3 ON b3.project_scrm_accommodation_1scrm_accommodation_idb = b1.id_c WHERE (('{$date}' BETWEEN b1.check_in_c AND b1.check_out_c ) || ('{$dateCO}' BETWEEN b1.check_in_c AND b1.check_out_c)) AND b2.deleted =0 AND b3.project_scrm_accommodation_1project_ida = '{$dataA['pid']}' group by b1.location_c");

        //success true or false 
        $this->msg = true;
        
        //add data to be sent as response
        $response = array();
        while ($resultData = $db->fetchByAssoc($result)) {
            if ($resultData['location_c'] == 'CPC_NEW') {
                $response['cpc_new']['booked'] = $resultData['rooms_booked_cpc_new'];
            }elseif ($resultData['location_c'] == 'CPC_OLD') {
                $response['cpc_old']['booked'] = $resultData['rooms_booked_cpc_old'];
            }elseif ($resultData['location_c'] == 'Bella Vista') {
                $response['bv']['booked'] = $resultData['rooms_booked_bv'];
            }elseif ($resultData['location_c'] == 'NDC') {
                $response['ndc']['booked'] = $resultData['rooms_booked_ndc'];
            }
        }

        // $resultData = $db->fetchByAssoc($result);
        // $response['rooms_booked'] = $resultData['rooms_booked'];  
        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT GROUP_CONCAT( b1.room_no_bv_c ) AS rooms_booked_bv, GROUP_CONCAT( b1.room_no_cpc_new_c ) AS rooms_booked_cpc_new, GROUP_CONCAT( b1.room_no_cpc_old_c ) AS rooms_booked_cpc_old, GROUP_CONCAT( b1.room_no_ndc_c ) AS rooms_booked_ndc, b1.location_c FROM scrm_accommodation_cstm AS b1 INNER JOIN scrm_accommodation AS b2 ON b1.id_c = b2.id INNER JOIN project_scrm_accommodation_1_c AS b3 ON b3.project_scrm_accommodation_1scrm_accommodation_idb = b1.id_c WHERE (('{$date}' BETWEEN b1.check_in_c AND b1.check_out_c ) || ('{$dateCO}' BETWEEN b1.check_in_c AND b1.check_out_c)) AND b2.deleted =0 AND b3.project_scrm_accommodation_1project_ida = '{$dataA['pid']}' group by b1.location_c");   
    }

    public function getProposalId($dataA='')
    {
        
        $proposalBean = BeanFactory::getBean('Opportunities',$dataA['scrm_work_order_opportunities_1opportunities_idb']);

        return array('asci_rpf_reference_c'=>$proposalBean->asci_rpf_reference_c,'lead_fac_1_centre_c'=>$proposalBean->lead_fac_1_centre_c,'lead_fac_2_centre_c'=>$proposalBean->lead_fac_2_centre_c,'lead_faculty_1_c'=>$proposalBean->lead_faculty_1_c,'scrm_partners_id_c'=>$proposalBean->scrm_partners_id_c,'lead_faculty_2_c'=>$proposalBean->lead_faculty_2_c,'scrm_partners_id1_c'=>$proposalBean->scrm_partners_id1_c);
    }

    public function getAccommodationsOfParticipant($dataA=array())
    {
        global $db;
        $response = array();
        $result = $db->query("SELECT room_no_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id inner join contacts_scrm_accommodation_1_c as b3 on b3.contacts_scrm_accommodation_1scrm_accommodation_idb = b1.id_c where b3.contacts_scrm_accommodation_1contacts_ida = '{$dataA['pid']}' and b2.deleted = 0");

        $resultData = $db->fetchByAssoc($result);
        if ($resultData) {
            $this->msg = true;    
        }

        $response['room_no_c'] = $resultData['room_no_c'];
        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT room_no_c from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id inner join contacts_scrm_accommodation_1_c as b3 on b3.contacts_scrm_accommodation_1scrm_accommodation_idb = b1.id_c where b3.contacts_scrm_accommodation_1contacts_ida = '{$dataA['pid']}' and b2.deleted = 0");   
    }

    public function getAccommodationsOfGuest($dataA=array())
    {
        global $db;
        $response = array();
        $result = $db->query("SELECT b1.room_no_c, b4.billing_address_street, b4.billing_address_city, b4.billing_address_state, b4.billing_address_postalcode, b4.billing_address_country from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id inner join scrm_partners_scrm_accommodation_1_c as b3 on b3.scrm_partners_scrm_accommodation_1scrm_accommodation_idb = b1.id_c left join scrm_partners as b4 on b4.id = b3.scrm_partners_scrm_accommodation_1scrm_partners_ida where b3.scrm_partners_scrm_accommodation_1scrm_accommodation_idb = '{$dataA['gid']}' and b2.deleted = 0");

        $fac = BeanFactory::getBean('scrm_Partners',$dataA['gid']);
        // print_r($fac);exit();
        $response['address']['primary_address_street'] = $fac->billing_address_street;
        $response['address']['primary_address_city'] = $fac->billing_address_city;
        $response['address']['primary_address_state'] = $fac->billing_address_state;
        $response['address']['primary_address_postalcode'] = $fac->billing_address_postalcode;
        $response['address']['primary_address_country'] = $fac->billing_address_country;
        
        $resultData = $db->fetchByAssoc($result);
        if ($resultData) {
            $this->msg = true;    
        }

        $response['room_no_c'] = $resultData['room_no_c'];
        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT b1.room_no_c, b4.billing_address_street, b4.billing_address_city, b4.billing_address_state, b4.billing_address_postalcode, b4.billing_address_country from scrm_accommodation_cstm as b1 inner join scrm_accommodation as b2 on b1.id_c = b2.id inner join scrm_partners_scrm_accommodation_1_c as b3 on b3.scrm_partners_scrm_accommodation_1scrm_accommodation_idb = b1.id_c inner join scrm_partners as b4 on b4.id = b3.scrm_partners_scrm_accommodation_1scrm_partners_ida where b3.scrm_partners_scrm_accommodation_1scrm_accommodation_idb = '{$dataA['gid']}' and b2.deleted = 0");   
    }    

    public function getTargetListName($dataA=array())
    {
        global $db;
        $response = array();
        $result = $db->query("SELECT name from prospect_lists where name = '".$dataA['title']."' and deleted = 0");
        
        $resultData = $db->fetchByAssoc($result);
        if ($resultData) {
            $duplicate = true;
            $this->msg = true;    
        }else{
            $duplicate = false;
        }

        $response['name'] = $duplicate;
        return array('Success'=>$this->msg,'data'=>$response,'query'=>"SELECT name from prospect_lists where name = '".$dataA['title']."' and deleted = 0");   
    }

    public function getProgrammeType($data)
    {
        $programme = BeanFactory::getBean('Project',$data);
        return $programme->programme_type_c;      
    }    

    public function getCheckOverlapping($data)
    {
        // print_r($data);

        global $db;
        // $timetableBean = BeanFactory::getBean('scrm_Timetable', $data['id']);

        $s = date('Y-m-d H:i', strtotime('-330 minutes', strtotime($data['start_date'])));
        $e = date('Y-m-d H:i', strtotime('-330 minutes',strtotime($data['end_date'])));
        $id = $data['id'];
        $sid = $data['sid'];

        $sessions = $db->query("
                SELECT 
                    scrm_session_information.name, scrm_session_information_cstm.start_time_c, scrm_session_information_cstm.end_time_c 
                FROM scrm_session_information
                INNER JOIN scrm_session_information_cstm ON scrm_session_information.id = scrm_session_information_cstm.id_c
                INNER JOIN scrm_timetable_scrm_session_information_1_c ON scrm_timetable_scrm_session_information_1_c.scrm_timetc7f4rmation_idb = scrm_session_information.id
                WHERE 
                    scrm_session_information.deleted = '0'
                AND scrm_timetable_scrm_session_information_1_c.deleted = '0'
                AND ((scrm_session_information_cstm.start_time_c > '{$s}' AND scrm_session_information_cstm.start_time_c < '{$e}')

                    OR 

                    (scrm_session_information_cstm.end_time_c > '{$s}' AND scrm_session_information_cstm.start_time_c < '{$e}')
                ) 
                AND scrm_timetable_scrm_session_information_1_c.scrm_timetable_scrm_session_information_1scrm_timetable_ida = '{$id}'
                AND scrm_session_information.id <> '{$sid}'

        ");


        
        $i = 0;
        $response = array();
        while ($row = $db->fetchByAssoc($sessions)) {
            
            $response[$i]['name'] = $row['name'];
            $response[$i]['start_time_c'] = date('h:i A', strtotime('+330 minutes',strtotime($row['start_time_c'])));
            $response[$i]['end_time_c'] = date('h:i A', strtotime('+330 minutes',strtotime($row['end_time_c'])));
            
            $i++;
        }

        return $response;
    }

}
$util = new AjaxCall();

$data =  array('Success'=>false,'data'=>array('Oops! Something Went Wrong'));

switch($_REQUEST['type']){

    case 'getparticipantlist':

        $pid = $_REQUEST['pid'];
        $orgid = $_REQUEST['orgid'];
        $currency = $_REQUEST['currency'];
        if (empty($currency)) {
            $currency = "-99";
        }
        if(!empty($pid) && !empty($orgid)){
           
            $data = $util->getParticipantWrtProgAndOrg($pid,$orgid,$currency);
        }else if(empty($orgid) && !empty($pid)){
            $data = $util->getParticipantWrtProg($pid,$currency);
        }

    break;
    case 'getOrganisationAddr':

        $orgid = $_REQUEST['orgid'];
        $data = $util->getOrganisationAddr($orgid);
        break;
    case 'getSelfSponsorOrganisationAddr':

        $orgid = $_REQUEST['orgid'];
        $data = $util->getSelfSponsorOrganisationAddr($orgid);
        break;
    case 'getAccommodations';
        $data = $_REQUEST;
        $data = $util->getAccommodations($data);    
    break;
    case 'getCRAccommodations';
        $data = $_REQUEST;
        $data = $util->getCRAccommodations($data);    
    break;
    case 'getProposalId';
        $data = $_REQUEST;
        $data = $util->getProposalId($data);    
    break;
    case 'getBlockedRooms';
        $data = $_REQUEST;
        $data = $util->getBlockedRooms($data);    
    break;
    case 'getAccommodationsRooms';
        $data = $_REQUEST;
        $data = $util->getAccommodationsRooms($data);    
    break;
    case 'getAccommodationsRoomsInProgramme';
        $data = $_REQUEST;
        $data = $util->getAccommodationsRoomsInProgramme($data);    
    break;
    case 'getAccommodationsRoomsByProgramme';
        $data = $_REQUEST;
        $data = $util->getAccommodationsRoomsByProgramme($data);    
    break;
    case 'getAccommodationsOfParticipant';
        $data = $_REQUEST;
        $data = $util->getAccommodationsOfParticipant($data);    
    break;
    case 'getAccommodationsOfGuest';
        $data = $_REQUEST;
        $data = $util->getAccommodationsOfGuest($data);    
    break; 
    case 'getProgrammeType';
        $data = $_REQUEST['pid'];
        $data = $util->getProgrammeType($data);    
    break;
    case 'getTargetListName';
        $data = $_REQUEST;
        $data = $util->getTargetListName($data);    
    break;            
    case 'getparticipantlistAccommodation':
        $data = $_REQUEST['pid'];
        $data = $util->getParticipantWrtProg($data);    

    break;
    case 'getCheckOverlapping':
        $data = $_REQUEST;
        $data = $util->getCheckOverlapping($data);    

    break;


    default:  $data = array('Success'=>false,'data'=>array());

}

echo json_encode($data);