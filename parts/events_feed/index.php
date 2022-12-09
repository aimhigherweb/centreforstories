<?php
	$event_data = false;

	if(check_array_field($args, 'query')) {
		// $event_data = cfs_get_events(
		// 	past: $args['query']['past'] ?? null,
		// 	future: $args['query']['future'] ?? null,
		// 	limit: $args['query']['limit'] ?? null,
		// 	featured: $args['query']['featured'] ?? null,
		// 	category: $args['query']['category'] ?? null,
		// 	tag: $args['query']['tag'] ?? null,
		// 	series: $args['query']['series'] ?? null,
		// );

		$event_data = call_user_func_array('cfs_get_events', $args['query']);
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


	// dump($events);
	
?>


<?php if($events): ?>
	<ul class="<?php echo classes($feed_classes); ?>">
		<?php foreach($events as $event): 
			$id = $event['post_name'] . rand();	

			// dump($event);
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