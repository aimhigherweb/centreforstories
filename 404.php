<?php
/**
 * 404 page
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

//  dump($wp_query->query['post_type'] == 'tribe_events' && check_array_field($wp_query->query, 'tribe_events'));
//  dump($wp_query->query['post_type'] == 'tribe_events');
//  dump($wp_query->query['tribe_events']);
//  dump($wp_query->query['post_type']);
//  dump($wp_query);


	$page_data = get_page_by_path(current_page());

	if($page_data && get_page_template_slug($page_data)) {
		get_template_part(str_replace('.php', '', get_page_template_slug($page_data)));
	}
	// else if($wp_query->query['post_type'] == 'tribe_events' && check_array_field($wp_query->query, 'tribe_events')) {
	// 	get_template_part('layouts/event/index');
	// }
	else {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => '404',
				'title' => '404 - Page not found'
			)
		);
	}

?>