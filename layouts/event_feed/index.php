<?php
	$event_id = get_the_ID();
	$page = get_page_by_path('events');

	$featured = cfs_get_events(true, 1);

	if($featured) {
		$featured = $featured['events'][0];
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

	$featured = false;

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
	<?php if($featured):
		$start_date = tribe_get_start_date($featured->ID, false, 'j');
		$end_date = tribe_get_end_date($featured->ID, false, 'j');
		$start_month = tribe_get_start_date($featured->ID, false, 'M');
		$end_month = tribe_get_end_date($featured->ID, false, 'M');
		$start = $start_month . ' <span>' . $start_date . '</span>';
		$end = $end_month . ' <span>' . $end_date . '</span>';
		$date = $start . ' - ' . $end;
		$excerpt = get_field('header_content', $featured->ID);
		
		if($start == $end) {
			$date = $start;
		}

		if(!check_field_value([$excerpt])) {
			$excerpt = get_the_excerpt($featured->ID);
		}	
	?>
		<div class="<?php echo classes([$styles['featured']]); ?>">
			<img 
				class="<?php echo classes([$styles['image']]); ?>" 
				src="<?php echo get_the_post_thumbnail_url($featured->ID, 'event_feed_block'); ?>" alt="<?php echo $feature_alt; ?>" 
			/>
			<h3 class="<?php echo classes([$styles['title']]); ?>">
				<a href="/event/<?php $featured->post_name ?>">
					<?php echo $featured->post_title; ?>
				</a>
			</h3>
			<p class="<?php echo classes([$styles['date']]); ?>"><?php echo $date; ?></p>
			<p class="<?php echo classes([$styles['excerpt']]); ?>">
				<?php echo $excerpt; ?>
			</p>
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