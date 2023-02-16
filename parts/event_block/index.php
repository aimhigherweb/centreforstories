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

	$tickets = cfs_get_event_ticket($event['events'][0]->ID);
	$ticket_message = false;

	if($tickets && !check_array_field($event, 'repeating')) {
		$tickets = $tickets[0]->stock_quantity;

		if($tickets == 0) {
			$ticket_message = 'Sold Out';
		}
		else if($tickets  < 5) {
			$ticket_message = 'Almost Gone';
		}
	}

	$tags = wp_get_post_terms($event['events'][0]->ID, 'post_tag');

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
			<?php if($ticket_message): ?>
				<span class="<?php echo classes([$styles['label']]); ?>">
					<?php echo $ticket_message; ?>
				</span>
			<?php endif; ?>
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

<div class="<?php echo classes([$styles['excerpt']]); ?>">
	<p><?php echo $event['excerpt']; ?></p>
	<?php if($tags): ?>
		<ul class="<?php echo classes([$styles['tags']]); ?>">
			<?php foreach($tags as $tag): ?>
				<li class="<?php echo classes([$styles['tag']]); ?>">
					<a href="/events/tag/<?php echo $tag->slug; ?>">
						<?php echo '#' . $tag->name; ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
<?php if(check_array_field($event, 'repeating')) : ?>
	<div class="<?php echo classes([$styles['repetitions']]); ?>">
		<ul>
			<?php foreach($event['events'] as $version) : 
				$repeat_tickets = cfs_get_event_ticket($version->ID);
				$repeat_tickets_message = false;

				if($repeat_tickets) {
					$repeat_tickets_message = $repeat_tickets[0]->stock_quantity;

					if($repeat_tickets == 0) {
						$repeat_tickets_message = 'Sold Out';
					}
					else if($repeat_tickets  < 5) {
						$repeat_tickets_message = 'Almost Gone';
					}
					else {
						$repeat_tickets_message = false;
					}
				}	
			?>
				<li>
					<a href="/events/<?php echo $version->post_name ?>">
						<?php echo cfs_join_date(cfs_event_date($version->ID)); ?>
						<?php if($repeat_tickets_message): ?>
							<?php echo ' - ' . $repeat_tickets_message; ?>
						<?php endif; ?>
						
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
