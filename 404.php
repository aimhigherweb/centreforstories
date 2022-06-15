<?php
/**
 * 404 page
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

// dump($wp_query);

	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => '404',
			'title' => '404 - Page not found'
		)
	);

?>

<!-- 

http://localhost:3000/courses/the-art-and-science-of-storytelling/lesson/a-moment-i-will-never-forget-is/

 -->