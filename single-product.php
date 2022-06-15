<?php
/**
 * Single Product
 *
 *
 * @package Centre for Stories
 * @version 1.6.4
 */
	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'product',
			'class' => 'product',
			'custom_page_header' => true
		)
	);

?>