<?php

	acf_add_local_field_group(array(
		'key' => 'group_626b332c9538f',
		'title' => 'Story',
		'fields' => array(
			array(
				'key' => 'field_626b33356cd44',
				'label' => 'Story Format',
				'name' => 'format',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'audio' => 'Audio',
					'video' => 'Video',
					'written' => 'Written',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'written',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_626b33786cd45',
				'label' => 'Story Recording',
				'name' => 'audio',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'audio',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_626b34996cd46',
				'label' => 'SoundCloud URL',
				'name' => 'soundcloud',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'audio',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_626b34bc6cd47',
				'label' => 'Story Recording',
				'name' => 'video',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'video',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_626b34d66cd48',
				'label' => 'YouTube URL',
				'name' => 'youtube',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'video',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_626e5f2964bce',
				'label' => 'Media Caption',
				'name' => 'caption',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'audio',
						),
					),
					array(
						array(
							'field' => 'field_626b33356cd44',
							'operator' => '==',
							'value' => 'video',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'story',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

	acf_add_local_field_group(array(
		'key' => 'group_626b4c92dc757',
		'title' => 'Story Collections',
		'fields' => array(
			array(
				'key' => 'field_626b4c9ad0736',
				'label' => 'Long Description',
				'name' => 'description',
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
				'media_upload' => 1,
				'delay' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'collection',
				),
			),
		),
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