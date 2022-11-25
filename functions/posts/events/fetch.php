<?php
    function cfs_get_events(
            $featured = false, 
            $limit = 9, 
            $category = false, 
            $children = true, 
            $past = false,
            $future = true,
            $type = 'tribe_events',
            $tag = false,
            $venue = false
        ) {
        wp_reset_query();

        global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;
        $meta_query = false;
        $tax_query = false;
        $post_query = false;
        $date_query = false;
        $order = 'ASC';

        if(isset($search_query, $search_query['page'])) {
            $page = $search_query['page'];
        }

        if(isset($search_query, $search_query['paged'])) {
			$page = $search_query['paged'];
		}

        if(!$type && isset($search_query, $search_query['post_type'])) {
            $type = $search_query['post_type'];
        }

        if(isset($search_query, $search_query['tribe_events_cat']) && ! $category) {
            $category = [$search_query['tribe_events_cat']];
        }

        if(isset($search_query, $search_query['tag']) && ! $tag) {
            $tag = [$search_query['tag']];
        }

        if(isset($search_query, $search_query['tribe_venue']) && ! $venue) {
            $venue = [$search_query['tribe_venue']];
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

            if(!$future) {
                $order = 'DESC';
            }
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

        if($tag) {
            $tax_query = set_query(
                $tax_query, 
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $tag,
                    'include_children' => true,
                    'operator' => 'IN'
                )
            );
        }

        if($venue) {
            $venues = get_posts(array(
                'post_name__in' => $venue,
                'post_type' => 'tribe_venue',
                'posts_per_page' => 1
            ));

            $venue = $venues[0]->ID;

            $meta_query = set_query(
                $meta_query, 
                array(
                    'key' => '_EventVenueID',
                    'value' => $venue,
                    'compare' => 'LIKE'
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
            'order' => $order,
            'meta_key' => '_EventStartDate',
            'tax_query' => $tax_query,
            'meta_query' => $meta_query,
            'ignore_sticky_posts' => true,
        );

        $post_query = new WP_Query($post_args);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'events' => $post_query->posts,
            'venue' => $venue,
            'tag' => $tag
        );
    }

?>