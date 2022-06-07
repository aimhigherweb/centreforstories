<?php

	// Add category to tickets in WooCommerce
	add_action( 'event_tickets_after_save_ticket', function($event_id, $ticket){
		
		// The slug of the product category to assign to the ticket product
		$category_to_add = "Event Ticket";

		if ( ! empty( $ticket ) && isset( $ticket->ID ) ) {
			wp_add_object_terms( $ticket->ID, $category_to_add, 'product_cat' );
		}

	}, 10, 2 );

	// Initialise WooCommerce cart if not logged in or if not already initialised
	function cfs_init_cart($template) {
		$session_templates = array(
			'index.php', 
			'tribe/events/v2/default-template.php'
		);
		
		$parts = explode('/', $template);
		
		if (
            in_array(
                 $parts[count($parts) - 1], 
                 $session_templates
            )
            && !is_user_logged_in()
        ) {
		    global $woocommerce;

            if(!$woocommerce->session->has_session()) {
                $woocommerce->session->set_customer_session_cookie(true);
            }
		}
		
		return $template;
	}
		
	add_filter('template_include', 'cfs_init_cart');
 
	function cfs_event_title_cart( $title, $values, $cart_item_key ) {
			$ticket_meta = get_post_meta( $values['product_id'] );

			if ( array_key_exists( '_tribe_wooticket_for_event', $ticket_meta ) ) {
				$event_id = absint( $ticket_meta[ '_tribe_wooticket_for_event' ][0] );
		
				if ( $event_id ) {
					$title = sprintf(
						'%s for <a href="%s" target="_blank"><strong>%s</strong></a>', 
						$title, 
						get_permalink( $event_id ), 
						get_the_title( $event_id ) 
					);
				}
			}
		
		return $title;
	}

	add_filter( 'woocommerce_cart_item_name', 'cfs_event_title_cart', 10, 3 );

?>