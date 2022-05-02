<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @package Centre for Stories
 * @version 1.0
 */

	// use Tribe\Events\Views\V2\Template_Bootstrap;


	// echo tribe( Template_Bootstrap::class )->get_view_html();

	if ($wp_query->tribe_is_event) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'event',
				'class' => 'event',
				'custom_page_header' => true
			)
		);
	}

?>

