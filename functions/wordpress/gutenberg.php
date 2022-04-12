<?php	
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