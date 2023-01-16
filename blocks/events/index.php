<?php
/**
 * Block Name: Events Block
 * 
 */

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

	$block_classes = [$styles['block']];
	$featured = get_field('featured');

	$event_data = cfs_get_events(
		limit: 3,
		featured: $featured,
	);
	$events = $event_data['events'];	

	// dump($events);
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		<?php echo get_field('eyebrow'); ?>
	</p>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<ul class="<?php echo classes([$styles['feed']]); ?>">
		<?php foreach($events as $event): ?>
			<li class="<?php echo classes([$styles['event']]); ?>">
				<?php
					get_template_part(
						'parts/event_block/index',
						null,
						array (
							'event' => $event,
							'feed' => $styles['feed'],
						)
					);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
	<p>
		<a href="/events" class="<?php echo classes([$styles['cta']]); ?>">
			More from the Archive
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
		</a>
	</p>
</div>