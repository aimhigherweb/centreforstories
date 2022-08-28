<?php
/**
 * 404 page
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */


	$page_data = get_page_by_path($_SERVER["REQUEST_URI"]);

	if($page_data && get_page_template_slug($page_data)) {
		get_template_part(str_replace('.php', '', get_page_template_slug($page_data)));
	}
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