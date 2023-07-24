<?php
/**
 * Block Name: Testimonials Block
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
	<?php if( have_rows('testimonials') ): ?>
		<ul>
		<?php while( have_rows('testimonials') ): the_row(); 
			$image = get_sub_field('image');
		?>
			<li class="<?php echo classes([$styles['testimonial']]); ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/quotes.svg'); ?>
				<blockquote>
					<?php echo get_sub_field('testimonial'); ?>
					<cite>- <?php the_sub_field('person'); ?></cite>
				</blockquote>
				<div class="<?php echo classes([$styles['image']]); ?>">
					<?php if(check_array_field($image, 'sizes')): ?>
						<img
							alt="<?php echo $image['alt'] || ''; ?>"
							src="<?php echo $image['sizes']['event_feed_block']; ?>"
						/>
					<?php endif; ?>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</div>