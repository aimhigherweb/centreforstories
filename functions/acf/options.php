<?php

	// Add Business Details Page
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Business Details',
			'menu_title'	=> 'Business Details',
			'menu_slug' 	=> 'business-details',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}

	// Business Details Options
	if( function_exists('acf_add_local_field_group') ):
		// Options - Business Info
		acf_add_local_field_group(array(
			'key' => 'aimhigher_business_info',
			'title' => 'Business Info',
			'fields' => array(
				array(
					'key' => 'aimhigher_business_info_field_phone',
					'label' => 'Phone Number',
					'name' => 'phone',
					'type' => 'text',
					'wrapper' => array(
						'width' => '51',
						'class' => '',
						'id' => '',
					),
				),
				array(
					'key' => 'aimhigher_business_info_field_email',
					'label' => 'Email Address',
					'name' => 'email',
					'type' => 'text',
					'wrapper' => array(
						'width' => '51',
						'class' => '',
						'id' => '',
					),
				),
				array(
					'key' => 'aimhigher_business_info_field_address',
					'label' => 'Address',
					'name' => 'address',
					'type' => 'group',
					'wrapper' => array(
						'width' => '51',
						'class' => '',
						'id' => '',
					),
					'layout' => 'block',
					'sub_fields' => array(
						array(
							'key' => 'aimhigher_business_info_field_line_1',
							'label' => 'Address Line 1',
							'name' => 'line_1',
							'type' => 'text',
						),
						array(
							'key' => 'aimhigher_business_info_field_line_2',
							'label' => 'Address Line 2',
							'name' => 'line_2',
							'type' => 'text',
						),
						array(
							'key' => 'aimhigher_business_info_field_suburb',
							'label' => 'Suburb',
							'name' => 'suburb',
							'type' => 'text',
						),
						array(
							'key' => 'aimhigher_business_info_field_state',
							'label' => 'State',
							'name' => 'state',
							'type' => 'text',
						),
						array(
							'key' => 'aimhigher_business_info_field_post_code',
							'label' => 'Post Code',
							'name' => 'post_code',
							'type' => 'text',
						),
					),
				),
				array(
					'key' => 'aimhigher_business_info_field_charity_logos',
					'label' => 'Charity Logo',
					'name' => 'logo',
					'type' => 'image',
					'required' => 0,
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'business-details',
					),
				),
			),
			'style' => 'seamless',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'active' => true,
		));

	endif;

?>