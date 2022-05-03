<?php
	$event_id = get_the_ID();
	$page = get_page_by_path('events');

	$featured = cfs_get_events(true, 1);

	if($featured) {
		$event = $featured['events'][0];
		$date = cfs_event_date($event->ID, 'short');
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
?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'class' => $styles['header'],
				'page_id' => $page->ID
			)
		);
	?>
	<?php if($featured): ?>
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
			)
		);
	?>
</div>