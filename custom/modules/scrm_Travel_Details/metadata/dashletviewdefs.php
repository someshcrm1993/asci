<?php
$dashletData['scrm_Travel_DetailsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'guest_type_c' => 
  array (
    'default' => '',
  ),
  'arrival_date_time_c' => 
  array (
    'default' => '',
  ),
  'mode_of_travel_c' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['scrm_Travel_DetailsDashlet']['columns'] = array (
  'full_name' => 
  array (
    'type' => 'fullname',
    'studio' => 
    array (
      'listview' => false,
    ),
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => false,
    'name' => 'full_name',
  ),
  'project_scrm_travel_details_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_PROJECT_SCRM_TRAVEL_DETAILS_1_FROM_PROJECT_TITLE',
    'id' => 'PROJECT_SCRM_TRAVEL_DETAILS_1PROJECT_IDA',
    'width' => '10%',
    'default' => true,
    'name' => 'project_scrm_travel_details_1_name',
  ),
  'name' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'guest_type_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_GUEST_TYPE',
    'width' => '10%',
    'name' => 'guest_type_c',
  ),
  'room_number_c' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_ROOM_NUMBER',
    'width' => '10%',
    'name' => 'room_number_c',
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
    'name' => 'date_entered',
  ),
  'mode_of_travel_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_MODE_OF_TRAVEL',
    'width' => '10%',
    'name' => 'mode_of_travel_c',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'departure_flight_train_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEPARTURE_FLIGHT_TRAIN_NAME',
    'width' => '10%',
    'name' => 'departure_flight_train_name_c',
  ),
  'starting_city_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_STARTING_CITY',
    'width' => '10%',
    'name' => 'starting_city_c',
  ),
  'departure_flight_number_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEPARTURE_FLIGHT_NUMBER',
    'width' => '10%',
    'name' => 'departure_flight_number_c',
  ),
  'departure_flight_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEPARTURE_FLIGHT_NAME',
    'width' => '10%',
    'name' => 'departure_flight_name_c',
  ),
  'arrival_date_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_ARRIVAL_DATE_TIME',
    'width' => '10%',
    'name' => 'arrival_date_time_c',
  ),
  'destination_airport_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DESTINATION_AIRPORT',
    'width' => '10%',
    'name' => 'destination_airport_c',
  ),
  'train_number_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_TRAIN_NUMBER',
    'width' => '10%',
    'name' => 'train_number_c',
  ),
  'local_drop_date_time_dep_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_LOCAL_DROP_DATE_TIME_DEP',
    'width' => '10%',
    'name' => 'local_drop_date_time_dep_c',
  ),
  'departure_from_ascii_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_DEPARTURE_FROM_ASCII',
    'width' => '10%',
    'name' => 'departure_from_ascii_c',
  ),
  'departure_date_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_DEPARTURE_DATE_TIME ',
    'width' => '10%',
    'name' => 'departure_date_time_c',
  ),
  'contacts_scrm_travel_details_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_TRAVEL_DETAILS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_TRAVEL_DETAILS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => false,
    'name' => 'contacts_scrm_travel_details_1_name',
  ),
  'flight_train_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_FLIGHT_TRAIN_NAME',
    'width' => '10%',
    'name' => 'flight_train_name_c',
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
  'train_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_TRAIN_NAME',
    'width' => '10%',
    'name' => 'train_name_c',
  ),
  'dep_flight_train_number_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEP_FLIGHT_TRAIN_NUMBER',
    'width' => '10%',
    'name' => 'dep_flight_train_number_c',
  ),
  'departure_train_number_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEPARTURE_TRAIN_NUMBER',
    'width' => '10%',
    'name' => 'departure_train_number_c',
  ),
  'destination_station_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_DESTINATION_STATION',
    'width' => '10%',
    'name' => 'destination_station_c',
  ),
  'departure_train_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_DEPARTURE_TRAIN_NAME',
    'width' => '10%',
    'name' => 'departure_train_name_c',
  ),
);
