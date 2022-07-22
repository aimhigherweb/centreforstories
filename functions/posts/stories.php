<?php

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
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'stories/collections',
					// 'hierarchical' => true,
					'pages' => true,
					'with_front' => false
				),
				'public' => true,
				'publicly_queryable' => true,
			)
		);
	};
	add_action('init', 'create_stories_collections');

	// Custom Tags
	function create_stories_tags() {
		register_taxonomy(
			'tag',
			array('story'),
			array(
				'labels' => array(
					'name'              => 'Tags',
					'singular_name'     => 'tag',
				),
				'show_ui' =>  true,
				'show_admin_column' => true,
				'show_in_rest' => true,
				'has_archive' => false,
				'rewrite' => array(
					'slug' => 'stories/tags',
					'with_front' => false
				),
				'public' => true,
				'publicly_queryable' => true,
			)
		);
	};
	add_action('init', 'create_stories_tags');

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

	function cfs_get_stories($limit = 9, $category = false, $post_in = false) {    
		wp_reset_query();
		global $query_string;
        wp_parse_str( $query_string, $search_query );

        $page = 1;
		$offset = 0;
		$tax_query = false;

        if(isset($search_query, $search_query['paged'])) {
            $page = $search_query['paged'];
        }

		if(isset($search_query, $search_query['collection']) && !$category) {
            $category = [$search_query['collection']];
        }

		if($post_in) {
			$category = false;
		}

		if($category) {
            $tax_query = array(
				array(
                    'taxonomy' => 'collection',
                    'field' => 'slug',
                    'terms' => $category,
                    'include_children' => true,
                    'operator' => 'IN'
                )
			);
        }

		$args = array(
			'post_type' => 'story',
			'post_status' => 'publish', 
			'post__in' => $post_in,
			'orderby' => 'post_date', 
			'order' => 'DESC',
			'posts_per_page' => $limit,
            'paged' => $page,
			'ignore_sticky_posts' => true,
			'tax_query' => $tax_query,
			
		);

		// dump($args);

		$story_query = new WP_Query($args);

        return array(
            'page' => $page,
            'pages' => $story_query->max_num_pages,
            'posts' => $story_query->posts,
        );
    }

	function cfs_get_story_collections() {
		wp_reset_query();

		$terms = get_terms(array(
			'taxonomy' => 'collection',
			'hide_empty' => true,
		));

		// $terms = get_terms(
		// 	'collection',
		// 	array( 
		// 		'post_types' => 'series', 
		// 		'orderby' => 'post_date', 
		// 		'order' => 'DESC' 
		// 	)
		// );

		$term_data = array();

		foreach($terms as $term) {
			$type = get_field('collection_type', $term);

			$term->permalink = get_term_link($term);

			if(!$type) {
				$type = array(
					'value' => 'story',
					'label' => 'Story Collection'
				);
			}
			
			if(!check_array_field($term_data, $type['value'])) {
				$term_data[$type['value']] = array(
					'name' => $type['label'],
					'terms' => array()
				);
			}

			$term_data[$type['value']]['terms'][] = $term;
		}

		// dump($terms);

		return $term_data;
	}


?>