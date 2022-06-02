<?php
    function cfs_get_events(
            $featured = false, 
            $limit = 9, 
            $category = false, 
            $children = true, 
            $past = false,
            $future = true,
            $type = 'tribe_events',
        ) {

        global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;
        $meta_query = false;
        $tax_query = false;
        $post_query = false;
        $date_query = false;

        if(isset($search_query, $search_query['page'])) {
            $page = $search_query['page'];
        }

        if(!$type && isset($search_query, $search_query['post_type'])) {
            $type = $search_query['post_type'];
        }

        if(isset($search_query, $search_query['tribe_events_cat']) && ! $category) {
            $category = [$search_query['tribe_events_cat']];
        }

        if($past || $future) {
            $date_query = array(
                'relation' => 'OR'
            );
        }

        if($past) {
            $date_query = set_query(
                $date_query, 
                array(
                    'key' => '_EventStartDate',
                    'value' => date('Y-m-d'),
                    'type' => 'date',
                    'compare' => '<='
                )
            );
        }

        if($future) {
            $date_query = set_query(
                $date_query, 
                array(
                    'key' => '_EventStartDate',
                    'value' => date('Y-m-d'),
                    'type' => 'date',
                    'compare' => '>='
                )
            );
        }

        if($date_query) {
            $meta_query = set_query(
                $meta_query,
                $date_query
            );
        }


        if($category) {
            $tax_query = set_query(
                $tax_query, 
                array(
                    'taxonomy' => 'tribe_events_cat',
                    'field' => 'slug',
                    'terms' => $category,
                    'include_children' => true,
                    'operator' => 'IN'
                )
            );
        }

        if($featured) {
            $meta_query = set_query(
                $meta_query, 
                array(
                    'key' => Tribe__Events__Featured_Events::FEATURED_EVENT_KEY,
                    'value' => true,
                )
            );
        }

        $post_args = array(
            'post_type' => $type,
            'posts_per_page' => $limit,
            'paged' => $page,
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => '_EventStartDate',
            'tax_query' => $tax_query,
            'meta_query' => $meta_query
        );

        $post_query = new WP_Query($post_args);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'events' => $post_query->posts,
        );
    }

?>