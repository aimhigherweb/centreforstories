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

	$image = $product->get_image_id();


?>

<div class="<?php echo classes([$styles['image']]); ?>">
	<img  
		src="<?php echo wp_get_attachment_image_src($image, 'event_feed_block')[0]; ?>" 
		alt="<?php echo alt_text(get_post_thumbnail_id($image)); ?>" 
	/>
</div>
<h3 class="<?php echo classes([$styles['title']]); ?>">
	<a href="/product/<?php echo $product->get_slug(); ?>">
		<?php echo $product->get_name(); ?>
	</a>
</h3>
<p class="<?php echo classes([$styles['price']]); ?>">
	<?php echo display_price(cfs_product_price($product)); ?>
</p>
<a 
	href="<?php echo $product->add_to_cart_url(); ?>"
	class="<?php echo classes([$styles['cart']]); ?>"
>
	Add to Cart
</a>