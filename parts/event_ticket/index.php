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

	if($_POST) {
		// dump($_POST);
		foreach(array_keys($_POST) as $item) {
			if(!preg_match('/^price_/', $item)) {
				$item_price = 'price_' . $item;
				$cart_item_data = array();
				$variation = array();

				if(check_array_field($_POST, $item_price)) {
					$cart_item_data['pwyw_price'] = $_POST[$item_price];
				}

				// dump($item);
				// dump($variation);

				WC()->cart->add_to_cart(
					product_id: $item,
					quantity: $_POST[$item],
					cart_item_data: $cart_item_data
				);
			}			
		}

		$woocommerce->cart->calculate_totals();
	}

	$tickets = $args['tickets'];
	$event = $args['event'];

	$cart = WC()->cart->get_cart_contents();

	$existing_tickets = array();
	$content = '';

	if($cart) {
		foreach($cart as $item) {
			$existing_tickets[$item['product_id']] = array(
				'quantity' => $item['quantity'],
				'price' => check_array_field($item, 'pwyw_price') ? $item['pwyw_price'] : false
			);
		}

		$content = '<p>Your cart already contains tickets to this event, any changes you make to quantities or ticket types will update the items in the cart.</p>';
	}

?>


<div id="tickets" class="wp-block <?php echo classes([$styles['tickets']]); ?>">
	<h2>Tickets</h2>
	<?php echo $content; ?>
	<?php if(tribe_events_has_soldout($event)): ?>
		<p>This event has sold out.</p>
	<?php else: ?>
		<form
			action=""
			method="post"
			enctype="multipart/form-data"
		>
			<ul>
				<?php foreach($tickets as &$ticket): 
					$value = 0;
					$price = display_price(cfs_product_price($ticket));
					$pwyw = false;
					$suggested_price = false;

					if(is_array($price)) {
						$pwyw = true;
						$suggested_price = $ticket->get_meta('_suggested_price')[0];
					}

					if(check_array_field($existing_tickets, $ticket->get_id())) {
						$value = $existing_tickets[$ticket->get_id()]['quantity'];
						$suggested_price = $existing_tickets[$ticket->get_id()]['price'];
					}
				?>
					<li>
						<p class="<?php echo classes([$styles['ticket']]); ?>">
							<?php echo $ticket->get_name(); ?>
						</p>
						<p class="<?php echo classes([$styles['price']]); ?>">
							<?php echo $price; ?>
						</p>
						<?php if($pwyw): ?>
							<label
								class="sr-only"
								for="price_<?php echo $ticket->get_id(); ?>"
							>
								Price for <?php echo $ticket->get_name(); ?> tickets
							</label>
							<span class="<?php echo classes([$styles['pwyw']]); ?>">
								<span>$</span>
								<input
									type="number" 
									id="price_<?php echo $ticket->get_id(); ?>" 
									step="0.01" 
									min="<?php echo $price[0]; ?>" 
									max="<?php echo $price[1]; ?>" 
									name="price_<?php echo $ticket->get_id(); ?>" 
									value="<?php echo $suggested_price; ?>" 
									inputmode="decimal" 
									
									autocomplete="off"
								/>
							</span>
						<?php endif; ?>
						
						<label
							class="sr-only"
							for="quantity_<?php echo $ticket->get_id(); ?>"
						>
							Quantity of <?php echo $ticket->get_name(); ?> tickets
						</label>
						<input
							type="number" 
							id="quantity_<?php echo $ticket->get_id(); ?>" 
							step="1" 
							min="0" 
							max="<?php echo $ticket->get_stock_quantity(); ?>" 
							name="<?php echo $ticket->get_id(); ?>" 
							value="<?php echo $value; ?>" 
							inputmode="numeric" 
							autocomplete="off"
						/>
					</li>
				<?php endforeach; ?>
			</ul>
			<button type="submit">
				<?php if(check_field_value([$existing_tickets])): ?>
					Update Cart
				<?php else: ?>
					Add to Cart
				<?php endif; ?>
			</button>
		</form>
	<?php if(check_field_value([$existing_tickets])): ?>
		<a href="/cart" class="<?php echo classes([$styles['cta']]); ?>">
			View Cart
		</a>
	<?php endif; ?>
	<?php endif; ?>
</div>