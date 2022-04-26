<?php

	// Custom Widget Areas
	if ( function_exists('register_sidebar') ) {     
		global $widgets;

		foreach ($widgets as $widget) {

			require_once(__DIR__ . '/' . $widget . '/index.php');

			register_sidebar(array_merge(
				array(
					'before_widget' => '<div class="%2$s widget_' . $widget . '">',
					'after_widget' => '</div>',
				),
				$widget_vars
			));				
		}
	}

?>