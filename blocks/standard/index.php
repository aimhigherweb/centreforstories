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

	if(get_field('graphic')) {
		array_push($image_classes, $styles['graphic']);
	}
	
?>


<div class="<?php echo classes([$styles['block']]); ?> wp-block">
	<div class="<?php echo classes([$styles['container']]); ?>">
		<p class="<?php echo classes([$styles['eyebrow']]); ?>">
			<?php echo get_field('eyebrow'); ?>
		</p>
		<h2 class="<?php echo classes([$styles['heading']]); ?>">
			<?php echo get_field('heading'); ?>
		</h2>
		<div class="<?php echo classes([$styles['content']]); ?>">
			<?php echo get_field('content'); ?>
		</div>
		<?php if(check_field_value([$cta])): ?>
			<a 
				href="<?php echo $cta['url']; ?>" 
				class="<?php echo classes([$styles['cta']]); ?>"
				target="<?php echo $cta['target']; ?>"
			>
				<?php echo $cta['title']; ?>
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		<?php endif; ?>
	</div>

	<picture class="<?php echo classes($image_classes); ?>">
		<source
			srcset="<?php echo $image['sizes']['block_image_small']; ?>"
			media="(max-width: 640px)"
		/>
		<source
			srcset="<?php echo $image['sizes']['block_image']; ?>"
			media="(min-width: 640px)"
		/>
		<img
			alt="<?php echo $image['alt'] ?>"
			src="<?php echo $image['url'] ?>"
		/>
	</picture>
</div>