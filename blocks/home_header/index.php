<?php
/**
 * Block Name: Home Header Section
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

	$image = get_field('image');

	dump($image);
	
?>

<div 
	class="<?php echo classes([$styles['block']]); ?> wp-block" 
>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		<?php echo get_field('eyebrow'); ?>
	</p>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<figure>
		<picture class="<?php echo classes([$styles['image']]); ?>">
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
		<figcaption class="<?php echo classes([$styles['caption']]); ?>">
			
		</figcaption>
	</figure>
</div>