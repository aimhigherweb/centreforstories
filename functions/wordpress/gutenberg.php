<?php
	$colours = [
		[
			'name'  => 'Forest',
			'slug'  => 'forest',
			'color' => '#174f45',
		],
		[
			'name'  => 'Currant',
			'slug'  => 'currant',
			'color' => '#6b140f',
		],
		[
			'name'  => 'Navy',
			'slug'  => 'navy',
			'color' => '#283753',
		],
		[
			'name'  => 'Seafoam',
			'slug'  => 'seafoam',
			'color' => '#d4e5fb',
		],
		[
			'name'  => 'Lavender',
			'slug'  => 'lavender',
			'color' => '#e3c5e5',
		],
		[
			'name'  => 'White',
			'slug'  => 'white',
			'color' => '#ffffff',
		],
		[
			'name'  => 'Grey Light Warm',
			'slug'  => 'grey_light_warm',
			'color' => '#f0eee9',
		],
		[
			'name'  => 'Marigold',
			'slug'  => 'marigold',
			'color' => '#f9aa4f',
		],
		[
			'name'  => 'Magenta',
			'slug'  => 'magenta',
			'color' => '#c13481',
		],
		[
			'name'  => 'Blue',
			'slug'  => 'blue',
			'color' => '#189aca',
		],
		[
			'name'  => 'Black',
			'slug'  => 'black',
			'color' => '#000000',
		],
		[
			'name'  => 'Green',
			'slug'  => 'green',
			'color' => '#174f45',
		],
		[
			'name'  => 'Red',
			'slug'  => 'red',
			'color' => '#6b140f',
		],
		[
			'name'  => 'Pink',
			'slug'  => 'pink',
			'color' => '#c13481',
		],
		[
			'name'  => 'Yellow',
			'slug'  => 'yellow',
			'color' => '#f9aa4f',
		],
		[
			'name'  => 'Primary',
			'slug'  => 'primary',
			'color' => '#189aca',
		],
		[
			'name'  => 'Neutral',
			'slug'  => 'neutral',
			'color' => '#111827',
		],
		[
			'name'  => 'Good',
			'slug'  => 'good',
			'color' => '#22c55e',
		],
		[
			'name'  => 'Success',
			'slug'  => 'success',
			'color' => '#22c55e',
		],
		[
			'name'  => 'Warning',
			'slug'  => 'warning',
			'color' => '#f59e0b',
		],
		[
			'name'  => 'Fail',
			'slug'  => 'fail',
			'color' => '#ef4444',
		],
		[
			'name'  => 'Error',
			'slug'  => 'error',
			'color' => '#ef4444',
		],
	];
	
	// Add Custom Gutenberg config
	function custom_gutenberg_styles() {
		global $colours;
		// Add custom editor styles
		add_theme_support('editor-styles');
		add_editor_style('editor.css');

		// Disable custom colours
		add_theme_support( 'disable-custom-colors' );

		// Disable gradients
		add_theme_support( '__experimental-editor-gradient-presets', array() );
		add_theme_support( '__experimental-disable-custom-gradients' );

		// Disable Custom font sizes
		add_theme_support('disable-custom-font-sizes');

		// Add custom colour palette
		add_theme_support('editor-color-palette', $colours);
	}
	add_action( 'after_setup_theme', 'custom_gutenberg_styles' );    
?>