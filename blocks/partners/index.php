<?php
/**
 * Block Name: Partners Block
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
			'env' => 'production'
		)
	);

	$block_classes = [$styles['block']];
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<div class="<?php echo classes([$styles['content']]); ?>">
			<?php echo get_field('content'); ?>
		</div>
	<ul class="<?php echo classes([$styles['gallery']]); ?>">
		<?php foreach(get_field('logos') as $logo): ?>
			<li>
				<img
					alt="<?php echo alt_text($logo); ?>"
					src="<?php echo wp_get_attachment_image_url($logo, 'partner_block'); ?>"
				/>
			</li>
		<?php endforeach; ?>
	</ul>
</div>