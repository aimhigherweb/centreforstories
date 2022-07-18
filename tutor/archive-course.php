<?php
/**
 * Course template
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */
 

 $page_path = preg_replace('/(^\/)|(\/$)/', '', $_SERVER["REQUEST_URI"]);
 $page = get_page_by_path($page_path);

 if(!$page) {
	$wp_query->set_404();
    status_header(404);
 }

	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'courses',
			'page_id' => $page->ID
		)
	);

?>
