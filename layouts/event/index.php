<?php
	$event_id = get_the_ID();

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

	$cost = tribe_get_cost( $event_id, true );
	$date = cfs_join_date(cfs_event_date($event_id, 'short', true));
	$venue = tribe_get_venue_object(tribe_get_venue_id());
	$organisers = [];
	$children = false;

	$link = $venue->directions_link;

	if(!get_field('directions', tribe_get_venue_id())) {
		$link = false;
	}

	foreach(tribe_get_organizer_ids() as &$organiser) {
		array_push($organisers, tribe_get_organizer_object($organiser));
	}

	if($organisers) {
		$children = '<h2 class="' . $styles['feature_heading'] . '">Featuring</h2><ul class="' . $styles['feature_list'] . '">';

		foreach($organisers as &$organiser) {
			$children .= '<li><span>' . $organiser->post_title . '</span>';

			if(has_post_thumbnail($organiser->ID)) {
				$children .= '<img src="' . get_the_post_thumbnail_url($organiser->ID) . '" />';
			}

			$children .= '</li>';
		}

		$children .= '</ul>';
	}

	$tickets = cfs_get_event_ticket($event_id);

?>

<div class="<?php echo $styles['content']; ?>">
	<?php
		get_template_part(
			'parts/map/index',
			null,
			array(
				'pin' => get_field('pin', tribe_get_venue_id()),
				'map' => array(
					'lat' => $venue->geolocation->latitude,
					'lng' => $venue->geolocation->longitude,
					'zoom' => get_field('zoom', tribe_get_venue_id()),
				),
				'map_link' => $venue->directions_link,
				'name' => $venue->post_title,
				'class' => $styles['map'],
			)
		);
	?>
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'children' => $children,
				'class' => $styles['header']
			)
		);
	?>
	<p class="<?php echo classes([$styles['date']]); ?>">
		<?php echo $date; ?>
	</p>
	<?php echo the_content(); ?>
	<?php if(tribe_events_has_tickets($event_id) && !tribe_is_past_event($event_id)): ?>
		<?php 
			get_template_part(
				'parts/event_ticket/index',
				null,
				array(
					'tickets' => $tickets
				)
			);
		?>
	<?php endif; ?>
</div>