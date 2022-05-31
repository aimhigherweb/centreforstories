<?php

	function aimhigher_news_posts() {
		$singular = 'News';
		$plural = 'News';

		$posts = get_post_type_object('post');
		$labels = $posts->labels;

		$labels->name = $plural;
		$labels->singular_name = $singular;
		$labels->add_new = 'Add ' . $singular;
		$labels->add_new_item = 'Add ' . $singular;
		$labels->edit_item = 'Edit ' . $singular;
		$labels->new_item = $singular;
		$labels->view_item = 'View ' . $singular;
		$labels->search_items = 'Search ' . $plural;
		$labels->not_found = 'No ' . $plural . ' found';
		$labels->not_found_in_trash = 'No ' . $plural . ' found in Trash';
		$labels->all_items = 'All ' . $plural;
		$labels->menu_name = $plural;
		$labels->name_admin_bar = $plural;

		$posts->menu_icon = 'dashicons-megaphone';
	}

	add_action( 'init', 'aimhigher_news_posts' );

	apply_filters( 'excerpt_length',  40);

	apply_filters( 'excerpt_more', '...' );

	function cfs_get_news($limit = 8) {    
		global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;

        if(isset($search_query, $search_query['page'])) {
            $page = $search_query['page'];
        }

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish', 
			'orderby' => 'publish_date', 
			'order' => 'ASC',
			'posts_per_page' => $limit,
            'paged' => $page,
		);

		$post_query = new WP_Query($args);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'posts' => $post_query->posts,
        );
    }

?>