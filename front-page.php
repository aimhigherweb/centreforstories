<?php
/**
 * Home template
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	get_template_part(
		'partials/layout', 
		null, 
		array(
			'class' => 'home',
			'template' => 'home'
		)
	);

?>
