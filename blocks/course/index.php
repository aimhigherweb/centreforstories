<?php
/**
 * Block Name: Course Block
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

	$cta = get_field('cta');
	$image = get_field('image');
	$testimonial = get_field('testimonial');
	
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
	<div class="<?php echo classes([$styles['container']]); ?>">
		<div class="<?php echo classes([$styles['content']]); ?>">
			<p class="<?php echo classes([$styles['subtitle']]); ?>">
				<?php echo get_field('subtitle'); ?>
			</p>
			<div class="<?php echo classes([$styles['testimonial']]); ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/quotes.svg'); ?>
				<blockquote>
					<?php echo $testimonial['quote']; ?>
					<cite>- <?php echo $testimonial['name']; ?></cite>
				</blockquote>
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
	</div>
</div>