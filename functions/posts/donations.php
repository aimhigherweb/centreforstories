<?php

    function cfs_get_donations() {   
		wp_reset_query();
		     
		$args = array(
			'post_type' => 'product',
			'orderby' => 'name',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => ['donation'],
					'include_children' => true,
					'operator' => 'IN'
				),
				array(
					'taxonomy' => 'product_tag',
					'field' => 'slug',
					'terms' => ['hidden'],
					'include_children' => true,
					'operator' => 'NOT IN'
				)
			)
		);

		$donation_data = new WP_Query($args);
		$donations = [];

		foreach($donation_data->posts as $donation) {
			$donations[] = wc_get_product($donation->ID);
		}

        return $donations;
    }

?>