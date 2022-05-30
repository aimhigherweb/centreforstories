<?php

	acf_add_local_field_group(array(
		'key' => 'group_6294d856980fd',
		'title' => 'Block - Donations',
		'fields' => array(
			array(
				'key' => 'field_6294d895d21fd',
				'label' => 'Disclaimer',
				'name' => 'disclaimer',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Centre for Stories Public Fund is a tax-deductible fund listed on the Australian Government Register of Cultural Organisations maintained under Subdivision 30-B of the Income Tax Assessment Act 1997.',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/donations-block',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

?>