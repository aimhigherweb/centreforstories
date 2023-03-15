<?php
/**
* Template Name: Attendee Registration Page
*
 * @package Centre for Stories
 * @version 1.0
 */

	$page_data = get_page_by_path(current_page());

	// dump(current_page());

	// dump($page_data);

	// dump($wp_query);

	get_template_part(
		'partials/layout/index',
		null, 
		array(
			'template' => 'attendee_registration',
			'page_id' => $page_data->ID,
		)
	);

?>