<?php
$module_name = 'scrm_Travel_Details';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_contact_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'guest_type_c',
            'studio' => 'visible',
            'label' => 'LBL_GUEST_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'project_scrm_travel_details_1_name',
          ),
          1 => 
          array (
            'name' => 'programme_code_c',
            'label' => 'LBL_PROGRAMME_CODE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_travel_details_1_name',
            'displayParams' => 
            array (
              'required' => true,
              'initial_filter' => '&project_contacts_2_name_advanced="+encodeURIComponent(document.getElementById("project_scrm_travel_details_1_name").value)+"',
            ),
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'scrm_partners_scrm_travel_details_1_name',
          ),
        ),
        4 => 
        array (
          0 => 'phone_mobile',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'mode_of_travel_c',
            'studio' => 'visible',
            'label' => 'LBL_MODE_OF_TRAVEL',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'starting_city_c',
            'label' => 'LBL_STARTING_CITY',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'train_name_c',
            'label' => 'LBL_TRAIN_NAME',
          ),
          1 => 
          array (
            'name' => 'train_number_c',
            'label' => 'LBL_TRAIN_NUMBER',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'flight_name_c',
            'label' => 'LBL_FLIGHT_NAME',
          ),
          1 => 
          array (
            'name' => 'flight_number_c',
            'label' => 'LBL_FLIGHT_NUMBER',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'departure_train_name_c',
            'label' => 'LBL_DEPARTURE_TRAIN_NAME',
          ),
          1 => 
          array (
            'name' => 'departure_train_number_c',
            'label' => 'LBL_DEPARTURE_TRAIN_NUMBER',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'departure_flight_name_c',
            'label' => 'LBL_DEPARTURE_FLIGHT_NAME',
          ),
          1 => 
          array (
            'name' => 'departure_flight_number_c',
            'label' => 'LBL_DEPARTURE_FLIGHT_NUMBER',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'arrival_date_time_c',
            'label' => 'LBL_ARRIVAL_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'departure_date_time_c',
            'label' => 'LBL_DEPARTURE_DATE_TIME ',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'destination_station_c',
            'studio' => 'visible',
            'label' => 'LBL_DESTINATION_STATION',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'destination_airport_c',
            'label' => 'LBL_DESTINATION_AIRPORT',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'departure_from_ascii_c',
            'label' => 'LBL_DEPARTURE_FROM_ASCII',
          ),
          1 => '',
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'room_number_c',
            'label' => 'LBL_ROOM_NUMBER',
          ),
        ),
        16 => 
        array (
          0 => 'description',
          1 => 'assigned_user_name',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
          1 => 
          array (
            'name' => 'alt_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'alt',
              'copy' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'local_drop_date_time_c',
            'label' => 'LBL_LOCAL_DROP_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'local_drop_date_time_dep_c',
            'label' => 'LBL_LOCAL_DROP_DATE_TIME_DEP',
          ),
        ),
      ),
    ),
  ),
);
?>
