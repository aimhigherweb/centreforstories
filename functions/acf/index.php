<?php

	require_once(__DIR__ . '/options.php');
	require_once(__DIR__ . '/menu_icons.php');
	require_once(__DIR__ . '/theme_colours.php');

	function aimhigher_google_maps_acf() {
		acf_update_setting('google_api_key', get_theme_mod('google_maps_api_key'));
	}
	add_action('acf/init', 'aimhigher_google_maps_acf');
?>