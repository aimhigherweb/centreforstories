<?php

	function aimhigher_acf_blocks_init() {
		global $blocks;

		if(function_exists('acf_register_block')) {

			foreach ($blocks as $block) {

				require_once(__DIR__ . '/' . $block . '/index.php');

				acf_register_block(array_merge(
					array(
						'name' => $block . '_block',
						'render_template' => get_theme_file_path('/blocks/' . $block . '/index.php'),
					),
					$block_vars,
				));				
			}
			
		}
	}
	add_action('acf/init', 'aimhigher_acf_blocks_init');


	if( function_exists('acf_add_local_field_group') ) {

		foreach ($blocks as $block) {

			require_once(__DIR__ . '/' . $block . '/acf.php');
			
		}

	}

?>