<?php

    function cfs_get_events($featured = false, $limit = 9) {
        global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;
        $meta_query = false;

        if(isset($search_query, $search_query['page'])) {
            $page = $search_query['page'];
        }

        if($featured) {
            $meta_query = array(
                array(
                  'key' => Tribe__Events__Featured_Events::FEATURED_EVENT_KEY,
                  'value' => true,
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
        );

        $post_query = new WP_Query($post_args);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'events' => $post_query->posts,
        );
    }

    function cfs_event_date($event, $format = 'short', $time = false) {
        $start = '';
        $end = '';
        $start_time = false;
        $end_time = false;

        $start_date = tribe_get_start_date($event, false, 'j');
        $end_date = tribe_get_end_date($event, false, 'j');
        

        if($format == 'long') {
            $start_month = tribe_get_start_date($event, false, 'F');
            $end_month = tribe_get_end_date($event, false, 'F');
        }
        else {
            $start_month = tribe_get_start_date($event, false, 'M');
            $end_month = tribe_get_end_date($event, false, 'M');            
        }

        if($time == true) {
            $start_time = tribe_get_start_date($event_id, true, 'g:i a');
            $end_time = tribe_get_end_date($event_id, true, 'g:i a');
        }
        
        $start = $start_month . ' <span>' . $start_date . '</span>';
        $end = $end_month . ' <span>' . $end_date . '</span>'; 

        return array(
            'start' => $start,
            'end' => $end,
            'start_time' => $start_time,
            'end_time' => $end_time,
        );
    }

    function cfs_join_date($date_object) {
        $start = $date_object['start'];
        $end = $date_object['end'];
        $start_time = $date_object['start_time'];
        $end_time = $date_object['end_time'];

        $date = $start . ' <span>-</span> ' . $end;

        if($start_time && $end_time) {
            $date = $start . ' ' . $start_time . ' - ' . $end . ' ' . $end_time;
        }

        if($start == $end) {
            $date = $start;

            if($start_time) {
                $date = $start . ', ' . $start_time . ' - ' . $end_time;
            }
        }

        return $date;
    }

?>