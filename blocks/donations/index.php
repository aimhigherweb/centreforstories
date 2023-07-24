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
			'env' => 'production'
		)
	);

	$block_classes = [$styles['block']];

	$donations = cfs_get_donations();
	$cta = get_field('cta');
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">Donate</h2>
	<ul>
		<?php foreach($donations as $donation): ?>
			<li class="<?php echo classes([$styles['donation']]); ?>">
				<h3 class="<?php echo classes([$styles['eyebrow']]); ?>">
					<?php echo $donation->get_name(); ?>
				</h3>
				<p class="<?php echo classes([$styles['price']]); ?>">
				<?php echo display_price(cfs_product_price($donation)); ?>
				</p>
				<p><?php echo $donation->get_short_description(); ?></p>
				<a
					href="/products/<?php echo $donation->get_slug(); ?>"
					class="<?php echo classes([$styles['cta']]); ?>"
				>
					Donate
					<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php if(check_field_value([$cta])): ?>
			<a 
				href="<?php echo $cta['url']; ?>" 
				class="<?php echo classes([$styles['main_cta']]); ?>"
				target="<?php echo $cta['target']; ?>"
			>
				<?php echo $cta['title']; ?>
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		<?php endif; ?>
	<p class="<?php echo classes([$styles['disclaimer']]); ?>"><?php echo get_field('disclaimer'); ?></p>
</div>