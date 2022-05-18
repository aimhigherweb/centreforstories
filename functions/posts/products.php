<?php
	function cfs_order_featured( $orderby, $query ) {
		global $wpdb;

		if ( 'featured_products' == $query->get( 'orderby' ) ) {
			$featured_product_ids = (array) wc_get_featured_product_ids();
			if ( count( $featured_product_ids ) ) {
				$string_of_ids = '(' . implode( ',', $featured_product_ids ) . ')';
				$orderby       = "( {$wpdb->posts}.ID IN {$string_of_ids} ) " . $query->get( 'order' );
			}
		}

		return $orderby;
	}
	add_filter( 'posts_orderby', 'cfs_order_featured', 10, 2 );

	function cfs_get_products($featured = false, $limit = 9, $tickets = false, $events = false) {
		global $query_string;

		wp_parse_str( $query_string, $search_query );
		$page = 1;
		$featured_query = false;
		$tax_query = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'event-ticket',
				'include_children' => true,
				'operator' => 'NOT IN'
			)
		);
		$meta_query = false;

		if(isset($search_query, $search_query['page'])) {
			$page = $search_query['page'];
		}

		if($featured) {
            $featured_query = wc_get_featured_product_ids();
        }

		if($tickets === 'include') {
			$tax_query = false;
		}
		else if($tickets) {
			$tax_query = array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => 'event-ticket',
					'include_children' => true,
					'operator' => 'IN'
				)
			);
		}

		if($events && is_array($events)) {
			// $meta_query = array(
            //     array(
            //       'key' => Tribe__Events__Featured_Events::FEATURED_EVENT_KEY,
            //       'value' => true,
            //     )
            // );
		}
		else if ($events) {
			$meta_query = array(
                array(
                  'key' => '_tribe_wooticket_for_event',
                  'value' => $events,
				  'compare' => 'IN'
                )
            );
		}

		$post_args = array(
			'post_type' => 'product',
			'posts_per_page' => $limit,
			'paged' => $page,
			'post__in' => $featured_query,
			'tax_query' => $tax_query,
			'orderby' => 'featured_products',
			'meta_query' => $meta_query,
		);

		$post_query = new WP_Query($post_args);

		return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'products' => $post_query->posts,
        );
	}

	function cfs_get_event_ticket ($event_id) {
		$product_data = cfs_get_products(false, -1, true, $event_id);

		$products = [];

		foreach ($product_data['products'] as $product) {
			array_push($products, wc_get_product($product->ID));
		}

		return $products;
	}

?>