<?php

	function aimhigher_stories_post_type() {
		$singular = 'Story';
		$plural = 'Stories';
		$description = 'Collections of audio, video and written stories';
		$icon = 'dashicons-format-status';

		$labels = array(
		'name'               => _x( $plural, 'post type general name' ),
		'singular_name'      => _x( $singular, 'post type singular name' ),
		'add_new'            => _x( 'Add New', $singular ),
		'add_new_item'       => __( 'Add New ' . $singular ),
		'edit_item'          => __( 'Edit ' . $singular ),
		'new_item'           => __( 'New ' . $singular ),
		'all_items'          => __( 'All ' . $plural ),
		'view_item'          => __( 'View ' . $singular ),
		'search_items'       => __( 'Search ' . $plural ),
		'not_found'          => __( 'No ' . $plural . ' found' ),
		'not_found_in_trash' => __( 'No ' . $plural . ' found in the Trash' ), 
		'menu_name'          => $plural
		);

		$args = array(
			'labels'        => $labels,
			'description'   => $description,
			'public'        => true,
			'show_in_rest' => true,
			'has_archive'   => 'stories',
			'menu_icon' => $icon,
			'supports' => array(
				'editor',
				'title',
				'thumbnail',
				'revisions',
				'custom-fields',
				'excerpt'
			),
			'rewrite' => array(
				'slug' => 'stories/%collection%',
				'with_front' => false
			),
			'taxonomies' => array('collection')
		);

		register_post_type( 'story', $args ); 
  }

  add_action( 'init', 'aimhigher_stories_post_type' );


	// Custom Collections
	function create_stories_collections() {
		register_taxonomy(
			'collection',
			array('story'),
			array(
				'labels' => array(
					'name'              => 'Collections',
					'singular_name'     => 'Collection',
				),
				'show_ui' =>  true,
				'show_admin_column' => true,
				'show_in_rest' => true,
				'rewrite' => array(
					'slug' => 'stories/collections',
					'with_front' => false
				),
				'public' => true,
				'publicly_queryable' => true,
			)
		);
	};
	add_action('init', 'create_stories_collections');


	// Change Permalink Structure
	function change_story_permalink($post_link, $id = 0) {
        $post = get_post($id);

        if(is_object($post) && $post->post_type == 'story') {
			$terms = wp_get_object_terms($post->ID, 'collection');

			if($terms && $terms[0]) {

				return str_replace('%collection%', $terms[0]->slug, $post_link);
			}
        }

        return $post_link;
    }
    add_filter('post_type_link', 'change_story_permalink', 1, 3);

	// function story_pages_rewrite() {     
    //     // Story
    //     add_rewrite_rule(
    //         'stories/([^/]+)/([^/]+)/?$',
    //         'index.php?post_type=story&name=$matches[2]',
    //         'bottom'
    //     );              
    // };
    // add_action('init', 'story_pages_rewrite');

	function cfs_get_stories($limit = 9) {    
		global $query_string;

        wp_parse_str( $query_string, $search_query );
        $page = 1;
		$offset = 0;

        if(isset($search_query, $search_query['paged'])) {
            $page = $search_query['paged'];
        }

		// if(get_option('sticky_posts')) {
		// 	if($page == 1) {
		// 		// $limit = $limit - 1;
		// 	}
		// 	else {
		// 		// $offset = 1;
		// 	}
		// }

		$args = array(
			'post_type' => 'story',
			'post_status' => 'publish', 
			'orderby' => 'post_date', 
			'order' => 'DESC',
			'posts_per_page' => $limit,
            'paged' => $page,
			// 'ignore_sticky_posts' => true,
			'offset' => $offset
		);

		$post_query = new WP_Query($args);

		// dump($post_query);

        return array(
            'page' => $page,
            'pages' => $post_query->max_num_pages,
            'posts' => $post_query->posts,
        );
    }

	function cfs_get_story_collections() {
		$terms = get_terms(array(
			'taxonomy' => 'collection',
			'hide_empty' => true,
		));

		$term_data = array();

		foreach($terms as $term) {
			$type = get_field('collection_type', $term);

			$term->permalink = str_replace(
				'/collections/',
				'/',
				get_term_link($term),
			);

			if(!check_array_field($term_data, $type['value'])) {
				$term_data[$type['value']] = array(
					'name' => $type['label'],
					'terms' => array()
				);
			}

			$term_data[$type['value']]['terms'][] = $term;
		}

		return $term_data;
	}


?>