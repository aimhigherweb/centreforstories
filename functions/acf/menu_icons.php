<?php
	$icon_menus = array('social_menu');
	$menu_locations = [];

	foreach ($icon_menus as $opt) {
		$location = 'location/' . $opt;
		array_push(
			$menu_locations,
			array (
				array(
					'param' => 'nav_menu_item',
					'operator' => '==',
					'value' => $location,
				),
			)
		);
	}

	if( function_exists('acf_add_local_field_group') ):

		// Social Menu Icons
		acf_add_local_field_group(array(
			'key' => 'group_61b083a9d1829_menu_icons',
			'title' => 'Menu Icons',
			'fields' => array(
				array(
					'key' => 'field_61b083bbe6676_menu_icon',
					'label' => 'Icon',
					'name' => 'icon',
					'type' => 'image',
					'required' => 0,
					'return_format' => 'url',
					'preview_size' => 'medium',
					'library' => 'all',
					'mime_types' => 'svg',
				),
			),
			'location' => $menu_locations
		));
	endif;
    
?>