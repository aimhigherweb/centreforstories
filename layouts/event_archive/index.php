<?php
	$event_id = get_the_ID();
	$page = get_page_by_path('events');

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

	
?>

<div class="<?php echo classes([$styles['content']]); ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'class' => $styles['header'],
				'page_id' => $page->ID,
				'title' => 'Past Events'
			)
		);
	?>
	<?php
		get_template_part(
			'parts/events_feed/index',
			null,
			array(
				'query' => array(
					'past' => true,
					'future' => false,
				)
			)
		);
	?>
	<h2>Upcoming Events</h2>
	<a href="/events" class="<?php echo classes([$styles['future']]); ?>">
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
		Future Events
	</a>
</div>