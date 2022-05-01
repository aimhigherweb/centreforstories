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

?>