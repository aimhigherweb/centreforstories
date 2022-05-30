<?php

    function cfs_get_donations() {        
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