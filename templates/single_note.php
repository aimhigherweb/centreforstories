<?php
/**
* Template Name: Single Notes Page
*
 * @package Centre for Stories
 * @version 1.0
 */

$note = get_post( intval($_GET['ldnt_id']) );

	get_template_part(
		'partials/layout/index',
		null, 
			array(
				'template' => 'note',
				'page_id' => $note->ID,
				'custom_page_header' => true,
				'title' => $note->post_title,
				'excerpt' => $note->post_content,
			)
	);

?>