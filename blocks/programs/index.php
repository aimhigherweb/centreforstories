<?php
/**
 * Block Name: Programs Block
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

	$block_classes = [$styles['block']];
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>"></h2>
</div>