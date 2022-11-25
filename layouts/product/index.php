<?php
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

	$product = wc_get_product();
	$price = display_price(cfs_product_price($product));

	$children = '<p class="' . $styles['price'] . '"><span>Price: </span>' . $price . '</p>';
	$cart = WC()->cart->get_cart_contents();
	$existing_items = false;

	if($cart) {
		foreach($cart as $item) {
			if($item['product_id'] == $product->get_id()) {
				$existing_items = $item['quantity'];
			}
		}
	}
	
?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'children' => $children,
				'excerpt' => ''
			)
		);
	?>
	<?php get_template_part('parts/header_image/index'); ?>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php wc_get_template_part( 'content', 'single-product' ); ?>
		

		<div class="<?php echo classes([$styles['atc']]); ?> wp-block">
			<h2>Add to Cart</h2>
			<p class="<?php echo $styles['cart_price']; ?>">
				<?php echo $price; ?>
			</p>
			<?php if($existing_items): ?>
				<p>Looks like you've already got this in your cart.</p>
				<a class="<?php echo classes([$styles['cta']]); ?>" href="/cart">
					View your cart
				</a>
			<?php else: ?>
				<?php do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' ); ?>
			<?php endif; ?>
		</div>


	<?php endwhile; ?>

</div>