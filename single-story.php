<?php
/**
 * Single Story
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */


	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'single_story',
			'class' => 'story',
			'custom_page_header' => true
		)
	);

?>