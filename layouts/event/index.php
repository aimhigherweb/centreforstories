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
			'env' => 'production'
		)
	);

	$cost = tribe_get_cost( $event_id, true );
	$date = cfs_join_date(cfs_event_date(
		event: $event_id, 
		time: true,
	));
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

	$people_data = [];

	if($organisers) {
		$children = '<h2 class="' . $styles['feature_heading'] . '">Featuring</h2><ul class="' . $styles['feature_list'] . '">';

		foreach($organisers as &$organiser) {
			$person_data = array(
				'image_url' => get_the_post_thumbnail_url($organiser->ID, 'people_block'),
				'image_alt' => get_the_post_thumbnail_caption($organiser->ID),
				'name' => $organiser->post_title,
				'bio' => $organiser->post_content,
				'id' => $organiser->ID
			);

			$children .= '<li><span class="' . $styles['tooltip'] . '">' . $organiser->post_title . '</span>';

			if(has_post_thumbnail($organiser->ID)) {
				$children .= '<a href="' . $_SERVER["REQUEST_URI"] . '#' . $organiser->ID . '"><img src="' . get_the_post_thumbnail_url($organiser->ID) . '" /><span class="sr-only">See more about ' . $organiser->post_title . '</span></a>';
			}

			$children .= '</li>';

			$people_data[] = $person_data;
		}

		

		$children .= '</ul>';
	}

	$tickets = cfs_get_event_ticket($event_id);
?>

<div class="<?php echo $styles['content']; ?>">
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
	<p class="<?php echo classes([$styles['venue']]); ?>">
		<?php echo $venue->post_title; ?>
	</p>
	<ul class="<?php echo classes([$styles['calendars']]); ?>">
		<li>
			
			<a href="<?php echo tribe_get_single_ical_link(); ?>" target="_blank">Add to Calendar</a>
		</li>
		<li>
			<a href="<?php echo tribe_get_gcal_link(); ?>" target="_blank">Add to Google Calendar</a>
		</li>
	</ul>
	<?php echo the_content(); ?>
	<?php if($organisers): ?>
		<?php 
			get_template_part(
				'parts/people/index',
				null,
				array(
					'people_data' => $people_data
				)
			);
		?>
	<?php endif; ?>
	<?php if(tribe_events_has_tickets($event_id) && !tribe_is_past_event(tribe_get_event($event_id))): ?>
		<?php 
			get_template_part(
				'parts/event_ticket/index',
				null,
				array(
					'tickets' => $tickets,
					'event' => $event_id,
				)
			);
		?>
	<?php endif; ?>
	<?php
	// get_post_meta( tribe_get_venue_id(), '_VenueShowMap', true ) &&
	// get_post_meta($event_id, '_EventShowMap', true)
		if(
			get_post_meta( tribe_get_venue_id(), '_VenueShowMap', true ) &&
			get_post_meta($event_id, '_EventShowMap', true) &&
			get_post_meta(tribe_get_venue_id(), '_VenueLat', true)
		) {
			get_template_part(
				'parts/map/index',
				null,
				array(
					'pin' => get_field('pin', tribe_get_venue_id()),
					'map' => array(
						'lat' => get_post_meta(tribe_get_venue_id(), '_VenueLat', true),
						'lng' => get_post_meta(tribe_get_venue_id(), '_VenueLng', true),
						'zoom' => get_field('zoom', tribe_get_venue_id()),
					),
					'map_link' => $venue->directions_link,
					'name' => $venue->post_title,
					'class' => $styles['map'],
				)
			);
		}
	?>
	<?php 
		if(get_field('cta_shortcode')) :
			echo do_shortcode(get_field('cta_shortcode'));
		elseif (is_active_sidebar('event_cta')) :
			dynamic_sidebar('event_cta'); 
		endif; ?>
</div>