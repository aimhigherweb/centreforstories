<?php
	global $menu_list;
	// Main Nav
	register_nav_menus($menu_list);
	
	//Add Icons to Nav Menu
	function nav_menu_icons($items, $args) {
		global $icon_menus;

		if(in_array($args->theme_location, $icon_menus)) {            
			foreach($items as &$item) {
				$icon = inline_svg(get_field('icon', $item));

				if($icon) {
					$item->title = $icon . '<span>' . $item->title . '</span>';
				}
			}

			return $items;
		}
		else {
			return $items;
		}
	}
	add_filter('wp_nav_menu_objects', 'nav_menu_icons', 10, 2);

	//Add labels to footer menu
	function nav_menu_headings($items, $args) {
		if($args->theme_location == 'footer_menu') {            
			foreach($items as &$item) {
                if(in_array('menu-item-has-children', $item->classes)) {
                    $item->title = '<span class="section">' . $item->title . '</span>';
                }
            }

			return $items;
		}
		else {
			return $items;
		}
	}
	add_filter('wp_nav_menu_objects', 'nav_menu_headings', 10, 2);

?>