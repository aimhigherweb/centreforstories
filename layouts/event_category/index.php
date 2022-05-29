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
			'env' => 'dev'
		)
	);

	$category = get_queried_object();
	$cat_child = get_term_children($category->term_id, $category->taxonomy);
	$sub = [];
	$current = false;
	$query = false;

	foreach($cat_child as $child) {
		$term = get_term_by('id', $child, $category->taxonomy);
		$sub[] = $term;

		preg_match(
			"/^(?:[a-z]|-)+-(\d{4})$/",
			$term->slug,
			$matches
		);

		$year = intval($matches[1]);

		if($year > $current) {
			$current = $year;
		}
	}

	if($current) {
		$query = array(
			false,
			9,
			$category->slug . '-' . $current
		);
	}

	if(!$sub) {
		foreach(get_term_children($category->parent, $category->taxonomy) as $child) {
			$sub[] = get_term_by('id', $child, $category->taxonomy);
		}
	}
?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'class' => $styles['header'],
				'taxonomy' => true
			)
		);
	?>
	<div class="<?php echo classes([$styles['feed']]); ?>">
		<?php
			get_template_part(
				'parts/events_feed/index',
				null,
				array(
					'query' => $query,
				)
			);
		?>
	</div>
	<h2>Archives</h2>
	<ul>
		<?php foreach($sub as $cat):
			if ($cat->term_id !== $category->term_id) :	?>
				<li>
					<a href="<?php echo get_term_link($cat); ?>">
						<?php echo $cat->name; ?>
					</a>
				</li>
			<?php endif;
		endforeach; ?>
	</ul>
</div>