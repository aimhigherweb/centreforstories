<?php
	$event_data = false;

	if(check_array_field($args, 'query')) {
		$event_data = cfs_get_events(
			past: $args['query']['past'] ?? null,
			future: $args['query']['future'] ?? null,
			limit: $args['query']['limit'] ?? null,
			featured: $args['query']['featured'] ?? null,
			category: $args['query']['category'] ?? null,
			tag: $args['query']['tag'] ?? null,
		);
	}
	else {
		$event_data = cfs_get_events();
	}

	$pages = $event_data['pages'];
	$page = $event_data['page'];
	$events = $event_data['events'];

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

	$feed_classes = [$styles['feed']];

	$events_object = array();

	foreach($events as $event) {
		// var_dump($events_object);
		if(check_array_field($events_object, $event->post_title)) {
			$details = $events_object[$event->post_title]['events'];

			array_push($details, $event);

			$events_object[$event->post_title]['events'] = $details;
			$events_object[$event->post_title]['end_date'] = cfs_event_date($event->ID)['end'];
			$events_object[$event->post_title]['repeating'] = true;
		}
		else {
			$date = cfs_event_date($event->ID);
			$details = array(
				'post_title' => $event->post_title,
				'post_name'	=> $event->post_name,
				'featured_image' => get_post_thumbnail_id($event->ID),
				'start_date' => $date['start'],
				'end_date' => $date['end'],
				'excerpt' => get_the_excerpt($event->ID),
				'events' => array($event),
			);

			$events_object[$event->post_title] = $details;
		}
	}
?>


<?php if($events_object): ?>
	<ul class="<?php echo classes($feed_classes); ?>">
		<?php foreach($events_object as $event): 
			$id = $event['post_name'] . rand();	
		?>
			<li id="<?php echo $id; ?>" class="<?php echo classes([$styles['event']]); ?>">
				<?php
					get_template_part(
						'parts/event_block/index',
						null,
						array (
							'event' => $event,
							'event_id' => $id,
							'feed' => $styles['feed'],
						)
					);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>Looks like we don't have any upcoming events</p>
<?php endif; ?>

<?php

	if($pages > 1) {
		get_template_part(
			'parts/pagination/index',
			null,
			array(
				'page' => $page,
				'pages' => $pages,
				'query' => true
			)
		);
	}

?>