<?php

	$product = $args['product'];

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

<div class="<?php echo classes([$styles['image']]); ?>">
	<img  
		src="<?php echo get_the_post_thumbnail_url($product->id, 'event_feed_block'); ?>" 
		alt="<?php echo alt_text(get_post_thumbnail_id($product->id)); ?>" 
	/>
</div>
<h3 class="<?php echo classes([$styles['title']]); ?>">
	<a href="/product/<?php echo $product->get_slug(); ?>">
		<?php echo $product->get_name(); ?>
	</a>
</h3>
<p class="<?php echo classes([$styles['price']]); ?>">
	<?php if($product->get_price()) {
		echo '<span>$ </span>' . $product->get_price();
	}
	else {
		echo 'Free';
	} ?>
</p>
<a 
	href="<?php $product->add_to_cart_url(); ?>"
	class="<?php echo classes([$styles['cart']]); ?>"
>
	Add to Cart
</a>