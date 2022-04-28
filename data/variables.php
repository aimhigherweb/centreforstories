<?php

	$menu_list = array (
		'main_menu' => 'Main Menu',
		'footer_menu' => 'Footer Menu',
		'social_menu' => 'Social Menu',
		'utility_menu' => 'Utility Menu',
	);

	$icon_menus = array('social_menu', 'utility_menu');

	$blocks = array(
		'address',
		'map',
		'cta',
		'standard'
	);

	$widgets = array(
		'aoc'
	);

	$image_sizes = [
		array(
			'name' => 'header_feature',
			'width' => 488,
			'height' => 520,
		),
		array(
			'name' => 'block_graphic',
			'width' => 384,
			'height' => 384,
		),
		array(
			'name' => 'block_image',
			'width' => 850,
			'height' => 850,
		),
		array(
			'name' => 'block_image_small',
			'width' => 640,
			'height' => 640,
		)
	];

	$custom_info = [
		array(
			'default' => 'GTM-XXXXXX',
			'name' => 'gtm_tag_id',
			'type' => 'text',
			'label' => 'Enter Google Tag Manager ID',
		),
		array(
			'default' => '',
			'name' => 'mapbox_api_key',
			'type' => 'text',
			'label' => 'Enter Mapbox API Key',
		),
		array(
			'default' => '',
			'name' => 'google_maps_api_key',
			'type' => 'text',
			'label' => 'Enter Google Maps API Key',
		),
	];

	$page_colours = [
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
	];

	$other_colours = [
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

	$colours = array_merge($page_colours, $other_colours);

?>