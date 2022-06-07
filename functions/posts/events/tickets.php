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

?>