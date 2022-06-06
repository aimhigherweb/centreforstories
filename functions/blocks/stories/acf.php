<?php

	acf_add_local_field_group(array(
		'key' => 'group_62950dc648135',
		'title' => 'Block - Stories',
		'fields' => array(
			array(
				'key' => 'field_62950dc6556d7',
				'label' => 'Heading',
				'name' => 'heading',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
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
			array(
				'key' => 'field_6298b7d5a1eab_type',
				'label' => 'Which Stories?',
				'name' => 'fetch_type',
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
					'collection' => 'Same Collection',
					'recent' => 'Recent Stories',
					'select' => 'Select Stories',
					'collections' => 'Select Collection'
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'story',
				'layout' => 'vertical',
				'return_format' => 'array',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_6295164178a06',
				'label' => 'Collections',
				'name' => 'collections',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_6298b7d5a1eab_type',
							'operator' => '==',
							'value' => 'collections',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'collection',
				'field_type' => 'select',
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
				'allow_null' => 0,
			),
			array(
				'key' => 'field_629e150a836ac',
				'label' => 'Select Stories',
				'name' => 'select',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_6298b7d5a1eab_type',
							'operator' => '==',
							'value' => 'select',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'story',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'multiple' => 1,
				'return_format' => 'id',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/stories-block',
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

?>