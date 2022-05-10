<?php

	$product_data = cfs_get_products(false, 6);
	$pages = $product_data['pages'];
	$page = $product_data['page'];
	$products = $product_data['products'];

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

<?php if($products): ?>
	<ul class="<?php echo classes([$styles['feed']]); ?>">
		<?php foreach($products as $product): ?>
			
			<li class="<?php echo classes([$styles['product']]); ?>">
				<?php
					get_template_part(
						'parts/product_block/index',
						null,
						array (
							'product' => wc_get_product($product->ID),
						)
					);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>Looks like we don't have any products</p>
<?php endif; ?>

<?php

	if($pages > 1) {
		get_template_part(
			'parts/modules',
			null,
			array(
				'page' => $page,
				'pages' => $pages,
			)
		);
	}

?>