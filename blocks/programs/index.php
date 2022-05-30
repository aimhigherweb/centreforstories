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
	</div>
	<?php if( have_rows('blocks') ): ?>
		<ul>
		<?php while( have_rows('blocks') ): the_row(); 
			$cta = get_sub_field('cta');
			$image = get_sub_field('image');
		?>
			<li class="<?php echo classes([$styles['program']]); ?>">
				<h3 class="<?php echo classes([$styles['subheading']]); ?>">
					<?php the_sub_field('heading'); ?>
				</h3>
				<p><?php the_sub_field('content'); ?></p>
				<div class="<?php echo classes([$styles['image']]); ?>">
					<?php if(check_array_field($image, 'sizes')): ?>
						<img
							alt="<?php echo $image['alt'] || ''; ?>"
							src="<?php echo $image['sizes']['program_block']; ?>"
						/>
					<?php endif; ?>
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
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</div>