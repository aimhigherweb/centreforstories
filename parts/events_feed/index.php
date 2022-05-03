<?php
	$event_data = cfs_get_events();
	$pages = $event_data['pages'];
	$page = $event_data['page'];
	$events = $event_data['events'];
	$featured = $args['featured'];

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

	if(!check_field_value([$featured])) {
		array_push($feed_classes, $styles['featured']);
	}
	
	if($featured) {
		$events = array_filter($events, function($event) use ($featured) {
			return $event->ID !== $featured->ID;
		});
	}

?>


<?php if($events): ?>
	<ul class="<?php echo classes($feed_classes); ?>">
		<?php foreach($events as $event): 

			$start_date = tribe_get_start_date($event->ID, false, 'j');
			$end_date = tribe_get_end_date($event->ID, false, 'j');
			$start_month = tribe_get_start_date($event->ID, false, 'M');
			$end_month = tribe_get_end_date($event->ID, false, 'M');
			$start = $start_month . ' <span>' . $start_date . '</span>';
			$end = $end_month . ' <span>' . $end_date . '</span>';
			$date = $start . ' - ' . $end;
			$excerpt = get_field('header_content', $event->ID);
			
			if($start == $end) {
				$date = $start;
			}

			if(!check_field_value([$excerpt])) {
				$excerpt = get_the_excerpt($event->ID);
			}
		?>
			<li class="<?php echo classes([$styles['event']]); ?>">
				<?php
					get_template_part(
						'parts/event_block/index',
						null,
						array (
							'event' => $event,
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
			'parts/modules',
			null,
			array(
				'page' => $page,
				'pages' => $pages,
			)
		);
	}

?>