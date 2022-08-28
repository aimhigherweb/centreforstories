<?php
/**
 * Block Name: Team Block
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
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<?php if( have_rows('profiles') ): ?>
		<ul>
		<?php while( have_rows('profiles') ): the_row();
			$image = get_sub_field('image');
		?>
			<li class="<?php echo classes([$styles['profile']]); ?>">
				<div class="<?php echo classes([$styles['image']]); ?>">
					<?php if(check_array_field($image, 'sizes')): ?>
						<img
							alt="<?php echo $image['alt'] || ''; ?>"
							src="<?php echo $image['sizes']['event_feed_block']; ?>"
						/>
					<?php endif; ?>
				</div>
				<details>
					<summary>
						<h3><?php the_sub_field('name'); ?></h3>
						<p class="<?php echo classes([$styles['role']]); ?>"><?php the_sub_field('role'); ?></p>
						<span class="<?php echo classes([$styles['toggle']]); ?>">
							<span class="<?php echo classes([$styles['expand']]); ?>">
								<span class="sr-only">Expand Bio</span>
							</span>
							<span class="<?php echo classes([$styles['collapse']]); ?>">
								<span class="sr-only">Collapse Bio</span>
							</span>
						</span>
					</summary>
					<p><?php the_sub_field('bio'); ?></p>
				</details>
				
				
				
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</div>