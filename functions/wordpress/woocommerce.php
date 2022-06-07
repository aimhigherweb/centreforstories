<?php

	function cfs_product_price($item) {
		$price = $item->get_price();

		if(check_field_value([
			$item->get_meta('_min_price'),
			$item->get_meta('_max_price'),
		])) {
			$price = [
				$item->get_meta('_min_price')[0],
				$item->get_meta('_max_price')[0]
			];
		}

		return $price;
	}

	// Calculate Custom price for PWYW items
	function cfs_custom_price_cart( $cart_object ) {  
		if( !WC()->session->__isset( "reload_checkout" )) {
			foreach ( $cart_object->cart_contents as $key => $value ) {
				if( isset( $value["pwyw_price"] ) ) {
					$value['data']->set_price($value["pwyw_price"]);
				}
			}  
		}  
	}
	add_action( 'woocommerce_before_calculate_totals', 'cfs_custom_price_cart', 99 );


	// Remove Related Products
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	// Remove Featured Image
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	// Remove Product title
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

	// Remove product meta
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

	// Remove price
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

	// Remove add to cart
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

	// Link to product/event in cart
	function cfs_event_title_cart( $title, $values, $cart_item_key ) {
		$product = wc_get_product($values['product_id']);
		$ticket_meta = get_post_meta( $values['product_id'] );

		if ( array_key_exists( '_tribe_wooticket_for_event', $ticket_meta ) ) {
			$event_id = absint( $ticket_meta[ '_tribe_wooticket_for_event' ][0] );
	
			if ( $event_id ) {
				$title = sprintf(
					'%s for <a href="%s"><strong>%s</strong></a>', 
					$title, 
					get_permalink( $event_id ), 
					get_the_title( $event_id ) 
				);
			}
		}
		else {
			$title = sprintf(
				'<a href="%s"><strong>%s</strong></a>', 
				'/product/' . $product->get_slug(), 
				$product->get_name()
			);
		}
	
	return $title;
}

add_filter( 'woocommerce_cart_item_name', 'cfs_event_title_cart', 10, 3 );

?>