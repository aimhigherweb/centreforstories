<?php
/**
 * Block Name: Standard Block
 * 
 */

	$data = fetch_styles(__DIR__);

	$template = $data['template'];
	$styles = $data['styles'];

	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'dev'
		)
	);

	$cta = get_field('cta');
	$image = get_field('image');

	$image_classes = [$styles['image']];
	$block_classes = [$styles['block']];

	if(get_field('graphic')) {
		array_push($image_classes, $styles['graphic']);
	}

	if(check_field_value(get_field('colour')) && get_field('colour') !== '#f0eee9') {
		array_push($block_classes, 'colour');
	}
	
?>
