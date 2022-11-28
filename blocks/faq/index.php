<?php
/**
 * Block Name: CTA Block
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
?>


<details class="<?php echo classes([$styles['details']]); ?>">
	<summary>
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
		<?php echo get_field('heading'); ?>
	</summary>
	<div class="<?php echo classes([$styles['content']]); ?>">
		<InnerBlocks />
	</div>
</details>