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
			'has_archive'   => true,
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



?>