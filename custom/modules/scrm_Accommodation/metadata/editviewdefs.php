<?php
$module_name = 'scrm_Accommodation';
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
            'name' => 'project_scrm_accommodation_1_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'accommodation_type_c',
            'studio' => 'visible',
            'label' => 'LBL_ACCOMMODATION_TYPE',
          ),
          1 => 
          array (
            'name' => 'location_c',
            'studio' => 'visible',
            'label' => 'LBL_LOCATION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'type_of_room_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE_OF_ROOM',
          ),
          1 => 
          array (
            'name' => 'guest_type_c',
            'studio' => 'visible',
            'label' => 'LBL_GUEST_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'extra_bed_c',
            'label' => 'LBL_EXTRA_BED',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'no_of_adults_c',
            'label' => 'LBL_NO_OF_ADULTS',
          ),
          1 => 
          array (
            'name' => 'no_of_children_c',
            'label' => 'LBL_NO_OF_CHILDREN',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'check_in_c',
            'label' => 'LBL_CHECK_IN',
          ),
          1 => 
          array (
            'name' => 'check_out_c',
            'label' => 'LBL_CHECK_OUT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'room_no_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO',
          ),
          1 => 
          array (
            'name' => 'room_no_bv_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_BV',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'room_no_ndc_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_NDC',
          ),
          1 => 
          array (
            'name' => 'room_no_cpc_new_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_CPC_NEW',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'hotel_room_no_c',
            'label' => 'LBL_HOTEL_ROOM_NO',
          ),
          1 => 
          array (
            'name' => 'hotel_name_c',
            'label' => 'LBL_HOTEL_NAME',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'room_no_cpc_old_c',
            'studio' => 'visible',
            'label' => 'LBL_ROOM_NO_CPC_OLD',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'participant_list_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTICIPANT_LIST',
          ),
          1 => 
          array (
            'name' => 'participants_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTICIPANTS',
          ),
        ),
        11 => 
        array (
          0 => '',
          1 => '',
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'scrm_partners_scrm_accommodation_1_name',
            'displayParams' => 
              array (
                'initial_filter' => '&faculty_type_c_advanced="+(this.form.{$fields.guest_type_c.name}.value == "Faculty" ? "ASCI Faculty" : (this.form.{$fields.guest_type_c.name}.value == "Guest Faculty" ? "Guest Faculty": ""))+"',
             ),
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'personal_details_c',
            'studio' => 'visible',
            'label' => 'LBL_PERSONAL_DETAILS',
          ),
          1 => 
          array (
            'name' => 'family_members_c',
            'studio' => 'visible',
            'label' => 'LBL_FAMILY_MEMBERS',
          ),
        ),
        14 => 
        array (
          0 => 'description',
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
