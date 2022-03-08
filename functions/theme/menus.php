<?php
	$icon_menus = ['social_menu'];

	// Main Nav
	register_nav_menus(array (
		'main_menu' => 'Main Menu',
		'footer_menu' => 'Footer Menu',
		'social_menu' => 'Social Menu',
	));

	//Add Icons to Nav Menu
	function nav_menu_icons($items, $args) {
		if(in_array($args->theme_location, $icon_menus)) {            
			foreach($items as &$item) {
				$icon = inline_svg(get_field('icon', $item));

				if($icon) {
					$item->title = $icon . '<span class="sr-only">' . $item->title . '</span>';
				}
			}

			return $items;
		}
		else {
			return $items;
		}
	}
	add_filter('wp_nav_menu_objects', 'nav_menu_icons', 10, 2);

	// Sub Menu
	function main_sub_menu($items, $args) {
		if($args->theme_location == 'main_menu') {            
			foreach($items as &$item) {
				if(in_array('menu-item-has-children', $item->classes)) {
					$item->title = '<span class="sub">' . $item->title . inline_svg(get_template_directory_uri() . '/src/img/chevron.svg') . '</span>';
				}
			}

			return $items;
		}
		else {
			return $items;
		}
	}
	add_filter('wp_nav_menu_objects', 'main_sub_menu', 10, 2);

?>