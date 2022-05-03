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

?>

<div class="<?php echo classes([$styles['image']]); ?>">
	<img  
		src="<?php echo wp_get_attachment_image_src($event['featured_image'], 'event_feed_block')[0]; ?>" 
		alt="<?php echo get_post_meta($event['featured_image'], '_wp_attachment_image_alt', TRUE); ?>" 
	/>
</div>
<h3 class="<?php echo classes([$styles['title']]); ?>">
	<a href="/event/<?php echo $event['post_name'] ?>">
		<?php echo $event['post_title']; ?>
	</a>
</h3>
<p class="<?php echo classes([$styles['date']]); ?>">
	<?php echo $date; ?>
	<?php
		if($event['repeating']) {
			echo inline_svg(get_template_directory_uri() . '/src/img/repeat.svg');
		}
	?>
</p>
<p class="<?php echo classes([$styles['excerpt']]); ?>">
	<?php echo $event['excerpt']; ?>
</p>