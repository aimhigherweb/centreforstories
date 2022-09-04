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
		'standard',
		'event_categories',
		'donations',
		'programs',
		'news',
		'stories',
		'testimonials',
		'team',
		'partners',
		'course',
		'home_header',
		'events',
		'story_collections',
		'faq',
		'blocks',
		'people'
	);

	$widgets = array(
		'aoc',
		'event_cta',
		'news_cta',
		'story_cta',
	);

	$image_sizes = [
		array(
			'name' => 'header_feature',
			'width' => 805.2,
			'height' => 858,
			'crop' => true,
		),
		array(
			'name' => 'block_graphic',
			'width' => 633.6,
			'height' => 633.6,
		),
		array(
			'name' => 'block_image',
			'width' => 1387.5,
			'height' => 1387.5,
		),
		array(
			'name' => 'block_image_small',
			'width' => 1056,
			'height' => 1056,
		),
		array(
			'name' => 'event_feed_block',
			'width' => 576,
			'height' => 478.5,
			'crop' => true
		),
		array(
			'name' => 'people_block',
			'width' => 660,
			'height' => 577.5,
			'crop' => true
		),
		array(
			'name' => 'festival_block',
			'width' => 825,
			'height' => 429,
			'crop' => true
		),
		array(
			'name' => 'program_block',
			'width' => 239.25,
			'height' => 239.25,
			'crop' => true
		),
		array(
			'name' => 'partner_block',
			'width' => 495,
			'height' => 198,
		),
		array(
			'name' => 'course_block',
			'width' => 1419,
			'height' => 940.5,
			'crop' => true
		),
		array(
			'name' => 'banner_image',
			'width' => 1419,
			'height' => 940.5,
			'crop' => true
		),
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
		array(
			'default' => '',
			'name' => 'newsletter_form_shortcode',
			'type' => 'text',
			'label' => 'Enter the shortcode for the newsletter signup form',
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

	$background_colours = [
		[
			'name'  => 'Grey Light Warm',
			'slug'  => 'grey_light_warm',
			'color' => '#f0eee9',
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

	$colours = array_merge($page_colours, $background_colours, $other_colours);

?>