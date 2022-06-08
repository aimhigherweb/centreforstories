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

	var_dump(tribe_context()->get( 'view' ));

	// dump(tribe_is_past());

	$view = tribe_context()->get( 'view' );
	
	if ($view == 'single-event') {
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
	else if (tribe_is_event_category()) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'event_category',
				'class' => 'festival',
				'custom_page_header' => true
			)
		);
	}
	else if (tribe_is_past()) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'event_archive',
				'class' => 'event_feed',
				'custom_page_header' => true,
				'page_id' => get_page_by_path('events')->ID
			)
		);
	}
	else if (tribe_is_event_query()) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'event_feed',
				'class' => 'event_feed',
				'custom_page_header' => true,
				'page_id' => get_page_by_path('events')->ID
			)
		);
	}

?>

