<?php
/**
* Template Name: Story Archive Page
*
 * @package Centre for Stories
 * @version 1.0
 */

	$page_data = get_page_by_path($_SERVER["REQUEST_URI"]);

	get_template_part(
		'partials/layout/index',
		null, 
		array(
			'template' => 'story',
			'custom_page_header' => true,
			'page_id' => $page_data->ID,
			'story_archive' => true
		)
	);

?>