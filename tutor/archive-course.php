<?php
/**
 * Course template
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'courses',
			'page_id' => get_page_by_path($_SERVER["REQUEST_URI"])->ID
		)
	);

?>