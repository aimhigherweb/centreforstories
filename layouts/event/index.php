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
	$start_date = tribe_get_start_date($event_id, false, 'F j');
	$end_date = tribe_get_end_date($event_id, false, 'F j');
	$year = tribe_get_start_date($event_id, false, 'Y');
	$start_time = tribe_get_start_date($event_id, true, 'g:i a');
	$end_time = tribe_get_end_date($event_id, true, 'g:i a');
	$date = $start_date . ' - ' . $end_date;
	$date_time = $start_date . ' ' . $start_time . ' - ' . $end_date . ' ' . $end_time;

	if($start_date == $end_date) {
		$date = $start_date;
		$date_time = $start_date . ', ' . $start_time . ' - ' . $end_time;
	}

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
		<?php echo $date_time; ?>
	</p>
	<?php echo the_content(); ?>
</div>