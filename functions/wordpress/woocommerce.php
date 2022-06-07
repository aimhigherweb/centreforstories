<?php

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

?>