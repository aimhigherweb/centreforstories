<?php
/**
 * Block Name: Donations Block
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

	$donations = cfs_get_donations();
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">Donate</h2>
	<ul>
		<?php foreach($donations as $donation): ?>
			<li class="<?php echo classes([$styles['donation']]); ?>">
				<h3 class="<?php echo classes([$styles['eyebrow']]); ?>">
					<?php echo $donation->post_title; ?>
				</h3>
				<p class="<?php echo classes([$styles['price']]); ?>">
					<?php if(check_field_value([
						get_post_meta($donation->id, '_min_price'),
						get_post_meta($donation->id, '_maximum_price')
					])): ?>
						<?php echo display_price([
							get_post_meta($donation->id, '_min_price')[0],
							get_post_meta($donation->id, '_maximum_price')[0]
						]); ?>
					<?php elseif(check_field_value($donation->price)): ?>
						<?php echo display_price($donation->price); ?>
					<?php else: ?>
						Free
					<?php endif; ?>
				</p>
				<p><?php echo $donation->short_description; ?></p>
				<a
					href="/products/<?php echo $donation->slug; ?>"
					class="<?php echo classes([$styles['cta']]); ?>"
				>
					Donate
					<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<p class="<?php echo classes([$styles['disclaimer']]); ?>"><?php echo get_field('disclaimer'); ?></p>
</div>