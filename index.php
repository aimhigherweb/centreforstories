<?php
/**
 * The main template file
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */
 
	if($wp_query->is_posts_page) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'blog',
				'page_id' => get_option('page_for_posts')
			)
		);
	}
	else {
		get_template_part('partials/layout/index');
	}

?>
