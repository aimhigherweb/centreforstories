<?php

	$header_pages = [
		'page', 'post', 'story', 'tribe_events'
	];

	$header_locations = [];

	foreach ($header_pages as $opt) {
		array_push(
			$header_locations,
			array (
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => $opt,
				),
			)
		);
	}

	acf_add_local_field_group(array(
		'key' => 'group_626882ab914aa',
		'title' => 'Header Content',
		'fields' => array(
			array(
				'key' => 'field_626882ce982cd',
				'label' => 'Header Content',
				'name' => 'header_content',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 0,
			),
			array(
				'key' => 'field_6268918869bc5',
				'label' => 'Eyebrow Heading',
				'name' => 'eyebrow',
				'type' => 'link',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
			),
		),
		'location' => $header_locations,
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
	
?>