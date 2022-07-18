<?php

	function aimhigher_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	add_action( 'after_setup_theme', 'aimhigher_add_woocommerce_support' );

	function cfs_product_price($item) {
		$price = $item->get_price();

		if(check_field_value([
			$item->get_meta('_min_price'),
			$item->get_meta('_maximum_price'),
		])) {
			$price = [
				$item->get_meta('_min_price'),
				$item->get_meta('_maximum_price')
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

	// Move Donation form above cart totals
	remove_action('woocommerce_proceed_to_checkout', 'wdgk_donation_form_front_html');
	remove_action('woocommerce_before_checkout_form', 'wdgk_add_donation_on_checkout_page');

	if(function_exists('wdgk_get_wc_donation_setting')) {
		$donation_product = false;
		$donation_cart = false;
		$donation_checkout = false;
		$donation_options = wdgk_get_wc_donation_setting();
		if (isset($donation_options['Product'])) {
			$donation_product = $donation_options['Product'];
		}
		if (isset($donation_options['Cart'])) {
			$donation_cart = $donation_options['Cart'];
		}
		if (isset($options['Checkout'])) {
			$donation_checkout = $donation_options['Checkout'];
		}
		if (!empty($donation_product) && $donation_cart == 'on') {
			add_action( 'woocommerce_cart_collaterals', 'wdgk_donation_form_front_html', 5 );
		}
		if (!empty($donation_product) && $donation_checkout == 'on') {
			add_action('woocommerce_before_order_notes', 'wdgk_add_donation_on_checkout_page');
		}
	}

	

	

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


function cfs_add_account_links( $menu_links ){
 	$new_links = array( 
		'courses' => 'Courses',
		'notes' => 'Notes'
	);
	$position = 1;

	$menu_links = array_merge(
		array_slice($menu_links, 0, $position), 
		$new_links, 
		array_slice($menu_links, $position)
	);
 
	return $menu_links;
}

add_filter ( 'woocommerce_account_menu_items', 'cfs_add_account_links' );
 

function cfs_account_hook_endpoint( $url, $endpoint, $value, $permalink ){
	$custom_pages = ['courses', 'notes'];

	if( in_array($endpoint, $custom_pages) ) {
		$url = site_url() . '/' . $endpoint;
	}

	return $url;
}

add_filter( 'woocommerce_get_endpoint_url', 'cfs_account_hook_endpoint', 10, 4 );

?>