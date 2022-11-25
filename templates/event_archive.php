<?php
/**
* Template Name: Event Archive Page
*
 * @package Centre for Stories
 * @version 1.0
 */

	$page_data = get_page_by_path(current_page());

	get_template_part(
		'partials/layout/index',
		null, 
		array(
			'template' => 'event_archive',
			'class' => 'event_feed',
			'custom_page_header' => true,
			'page_id' => $page_data->ID,
		)
	);

?>