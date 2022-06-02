<?php

	$event = $args['event'];

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

	$date = cfs_join_date(array(
		'start' => $event['start_date'],
		'end' => $event['end_date'],
	));

	$image_src = wp_get_attachment_image_src($event['featured_image'], 'event_feed_block');

	if(check_array_field($image_src, 0)) {
		$image_src = $image_src[0];
	}

	

?>

<div class="<?php echo classes([$styles['image']]); ?>">
	<img  
		src="<?php echo $image_src; ?>" 
		alt="<?php echo alt_text($event['featured_image']); ?>" 
	/>
</div>
<h3 class="<?php echo classes([$styles['title']]); ?>">
	<?php if(check_array_field($event, 'repeating')) : ?>
		<button onclick="expandRepeatingEvents(<?php echo '`' . $args['event_id'] . '`, ' . '`' . $args['feed'] . '`'; ?>)">
			<?php echo $event['post_title']; ?>
		</button>
	<?php else : ?>
		<a href="/event/<?php echo $event['post_name'] ?>">
			<?php echo $event['post_title']; ?>
		</a>
	<?php endif; ?>
</h3>
<p class="<?php echo classes([$styles['date']]); ?>">
	<?php echo $date; ?>
	<?php
		if(check_array_field($event, 'repeating')) {
			echo inline_svg(get_template_directory_uri() . '/src/img/repeat.svg');
		}
	?>
</p>
<p class="<?php echo classes([$styles['excerpt']]); ?>">
	<?php echo $event['excerpt']; ?>
</p>
<?php if(check_array_field($event, 'repeating')) : ?>
	<div class="<?php echo classes([$styles['repetitions']]); ?>">
		<ul>
			<?php foreach($event['events'] as $version) : ?>
				<li>
					<a href="/events/<?php echo $version->post_name ?>">
						<?php echo cfs_join_date(cfs_event_date($version->ID)); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>