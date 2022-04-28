<?php

	require_once(__DIR__ . '/options.php');
	require_once(__DIR__ . '/menu_icons.php');
	require_once(__DIR__ . '/theme_colours.php');

	function aimhigher_google_maps_acf() {
		acf_update_setting('google_api_key', 'AIzaSyBI-TzKHC4wxEcioAjH2zb2paZaquEcp1c');
	}
	add_action('acf/init', 'aimhigher_google_maps_acf');
?>