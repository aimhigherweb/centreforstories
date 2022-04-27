<?php
/**
 * Single Blog Post
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'post',
			'class' => 'post'
		)
	);

?>