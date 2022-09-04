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
	$query = array(
		'past' => true,
		'future' => true,
		'limit' => -1
	);
	$title = $category->name;
	$excerpt = $category->description;
	$graphic = get_field('graphic', $category);

	foreach($cat_child as $child) {
		$term = get_term_by('id', $child, $category->taxonomy);
		$sub[] = $term;

		preg_match(
			"/^(?:[a-z]|-)+-(\d{4})$/",
			$term->slug,
			$matches
		);

		$year = intval($matches[1]);

		if(!$current) {
			$current = $year;
		}
		else if($year > $current) {
			$current = $year;
		}
	}

	if($current) {
		$query['category'] = $category->slug . '-' . $current;
	}

	if(!$sub) {
		foreach(get_term_children($category->parent, $category->taxonomy) as $child) {
			$sub[] = get_term_by('id', $child, $category->taxonomy);
		}

		$parent = get_term_by('id', $category->parent, $category->taxonomy);
		$title = $parent->name;
		$excerpt = $parent->description;
		$graphic = get_field('graphic', $parent);

		preg_match(
			"/^(?:[a-z]|-)+-(\d{4})$/",
			$category->slug,
			$matches
		);

		$current = intval($matches[1]);
	}

	
?>

<div>
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'title' => $title,
				'excerpt' => $excerpt,
				'graphic' => $graphic
			)
		);
	?>
	<h2 class="<?php echo classes([$styles['heading']]); ?>"><?php echo $current; ?></h2>
	<div class="<?php echo classes([$styles['feed']]); ?>">
		<?php
			get_template_part(
				'parts/events_feed/index',
				null,
				array(
					'query' => $query,
					'featured' => true,
				)
			);
		?>
	</div>
	<h2>Past Events</h2>
	<ul class="<?php echo classes([$styles['archives']]); ?>">
		<?php foreach($sub as $cat):
			if ($cat->term_id !== $category->term_id) :	?>
				<li>
					<a href="<?php echo get_term_link($cat); ?>">
						<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
						<?php echo $cat->name; ?>
					</a>
				</li>
			<?php endif;
		endforeach; ?>
	</ul>
</div>