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
		foreach(array_keys($_POST) as $item) {
			WC()->cart->add_to_cart(
				$item,
				$_POST[$item]
			);
		}
	}

	$tickets = $args['tickets'];

	$cart = WC()->cart->get_cart_contents();

	$existing_tickets = array();
	$content = '';

	if($cart) {
		foreach($cart as $item) {
			$existing_tickets[$item['product_id']] = $item['quantity'];
		}

		$content = '<p>Your cart already contains tickets to this event, any changes you make to quantities or ticket types will update the items in the cart.</p>';
	}

?>


<div class="wp-block <?php echo classes([$styles['tickets']]); ?>">
	<h2>Tickets</h2>
	<?php echo $content; ?>
	<form
		action=""
		method="post"
		enctype="multipart/form-data"
	>
		<ul>
			<?php foreach($tickets as &$ticket): 
				$value = 0;

				if($existing_tickets[$ticket->id]) {
					$value = $existing_tickets[$ticket->id];
				}
			?>
				<li>
					<p class="<?php echo classes([$styles['ticket']]); ?>">
						<?php echo $ticket->name; ?>
					</p>
					<p class="<?php echo classes([$styles['price']]); ?>">
						<?php if($ticket->get_price()) {
							echo '<span>$ </span>' . $ticket->get_price();
						}
						else {
							echo 'Free';
						} ?>
					</p>
					
					<label
						class="sr-only"
						for="quantity_<?php echo $ticket->id; ?>"
					>
						Quantity of <?php echo $ticket->name; ?> tickets
					</label>
					<input
						type="number" 
						id="quantity_<?php echo $ticket->id; ?>" 
						step="1" 
						min="0" 
						max="<?php echo $ticket->get_stock_quantity(); ?>" 
						name="<?php echo $ticket->id; ?>" 
						value="<?php echo $value; ?>" 
						inputmode="numeric" 
						autocomplete="off"
					/>
				</li>
			<?php endforeach; ?>
		</ul>
		<button type="submit">Add to Cart</button>
	</form>
</div>