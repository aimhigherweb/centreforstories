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
?>

<div class="<?php echo $styles['content']; ?>">
	<?php
		get_template_part(
			'parts/map/index',
			null,
			array(
				'pin' => $venue->geolocation->overwrite_coordinates,
				'map' => array(
					'lat' => $venue->geolocation->latitude,
					'lng' => $venue->geolocation->longitude,
					'zoom' => 14,
				),
				'map_link' => $venue->directions_link,
				'name' => $venue->post_title,
				'class' => $styles['map'],
			)
		);
	?>
	<?php get_template_part('parts/page_header/index'); ?>
	<?php get_template_part('parts/header_image/index'); ?>
	<p class="<?php echo classes([$styles['date']]); ?>">
		<?php echo $date_time; ?>
	</p>
	<?php echo the_content(); ?>
</div>