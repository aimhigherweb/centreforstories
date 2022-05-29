<?php

    function cfs_get_events(
            $featured = false, 
            $limit = 9, 
            $category = false, 
            $children = true, 
            $past = false
        ) {

        global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;
        $meta_query = false;
        $tax_query = false;

        if(isset($search_query, $search_query['page'])) {
            $page = $search_query['page'];
        }

        if(isset($search_query, $search_query['tribe_events_cat']) && ! $category) {
            $category = [$search_query['tribe_events_cat']];
        }

        if($featured) {
            $meta_query = array(
                array(
                  'key' => Tribe__Events__Featured_Events::FEATURED_EVENT_KEY,
                  'value' => true,
                )
            );
        }

        if($category) {
            $tax_query = array(
				array(
					'taxonomy' => 'tribe_events_cat',
					'field' => 'slug',
					'terms' => $category,
					'include_children' => true,
					'operator' => 'IN'
				)
			);
        }

        

        $post_args = array(
            'post_type' => $search_query['post_type'],
            'posts_per_page' => $limit,
            'paged' => $page,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => '_EventStartDate',
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
        );

        $post_query = new WP_Query($post_args);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'events' => $post_query->posts,
        );
    }

?>