<?php
	$event_id = get_the_ID();
	$page = get_page_by_path('events');

	$featured = cfs_get_events(
		featured: true,
		limit: 1
	);
	$featured = false;
	$venue = false;
	$tag = false;
	$series = true;

	// dump($featured);

	if($featured && $featured['venue']) {
		$venue = tribe_get_venue_object($featured['venue']);
		$featured = false;
	}
	else if($featured && $featured['tag'] && count($featured['tag']) > 0) {
		$tag = get_term_by('name', $featured['tag'][0], 'post_tag');
		$featured = false;
	}
	else if($featured && count($featured['events']) <= 0) {
		$featured = false;
	}
	else if($featured) {
		$event = $featured['events'][0];
		$date = cfs_event_date(event: $event->ID);
		$featured = array(
			'post_title' => $event->post_title,
			'post_name'	=> $event->post_name,
			'featured_image' => get_post_thumbnail_id($event->ID),
			'start_date' => $date['start'],
			'end_date' => $date['end'],
			'excerpt' => get_the_excerpt($event->ID),
			'events' => array($event),
		);
	}

	$data = fetch_styles(__DIR__);
	$template = $data['template'];
	$styles = $data['styles']; 

	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'dev'
		)
	);


	$title = false;

	if($venue) {
		$title = 'Upcoming Events - ' . $venue->post_title;
		$series = false;
	}

	if($tag) {
		$title = 'Upcoming Events - #' . $tag->name;
		$series = false;
	}

?>

<div>
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'page_id' => $page->ID,
				'title' => $title
			)
		);
	?>
	<?php
	 if($featured): ?>
		<div class="<?php echo classes([$styles['featured']]); ?>">
			<?php
				get_template_part(
					'parts/event_block/index',
					null,
					array (
						'event' => $featured,
					)
				);
			?>
		</div>
	<?php endif; ?>
	<?php
		get_template_part(
			'parts/events_feed/index',
			null,
			array (
				'featured' => $featured,
				'query' => array(
					'series' => $series
				)
			)
		);
	?>
	<h2>Past Events</h2>
	<a href="/events/past" class="<?php echo classes([$styles['past']]); ?>">
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
		Events Archive
	</a>
	<?php echo page_content($page->ID); ?>
</div>