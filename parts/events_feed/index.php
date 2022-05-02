<?php
	global $query_string;

	wp_parse_str( $query_string, $search_query );

	$page = 1;

	if(isset($search_query, $search_query['page'])) {
		$page = $search_query['page'];
	}

	$post_args = array(
		'post_type' => $search_query['post_type'],
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => 9,
		'paged' => $page,
	);

	$post_query = new WP_Query($post_args);
	$events = $post_query->posts;
	$pages = $post_query->max_num_pages;

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

?>


<?php if($events): ?>
	<ul class="<?php echo classes([$styles['feed']]); ?>">
		<?php foreach($events as $event): 
			$start_date = tribe_get_start_date($event->ID, false, 'j');
			$end_date = tribe_get_end_date($event->ID, false, 'j');
			$start_month = tribe_get_start_date($event->ID, false, 'M');
			$end_month = tribe_get_end_date($event->ID, false, 'M');
			$start = $start_month . ' <span>' . $start_date . '</span>';
			$end = $end_month . ' <span>' . $end_date . '</span>';
			$date = $start . ' - ' . $end;
			$excerpt = get_field('header_content', $event->ID);
			
			if($start == $end) {
				$date = $start;
			}

			if(!check_field_value([$excerpt])) {
				$excerpt = get_the_excerpt($event->ID);
			}
		?>
			<li class="<?php echo classes([$styles['event']]); ?>">
				<img 
					class="<?php echo classes([$styles['image']]); ?>" 
					src="<?php echo get_the_post_thumbnail_url($event->ID, 'event_feed_block'); ?>" alt="<?php echo $feature_alt; ?>" 
				/>
				<h3 class="<?php echo classes([$styles['title']]); ?>">
					<a href="/event/<?php $product->post_name ?>">
						<?php echo $event->post_title; ?>
					</a>
				</h3>
				<p class="<?php echo classes([$styles['date']]); ?>"><?php echo $date; ?></p>
				<p class="<?php echo classes([$styles['excerpt']]); ?>">
					<?php echo $excerpt; ?>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>Looks like we don't have any upcoming events</p>
<?php endif; ?>

<?php

	if($pages > 1) {
		get_template_part(
			'parts/modules',
			null,
			array(
				'page' => $page,
				'pages' => $pages,
			)
		);
	}

?>