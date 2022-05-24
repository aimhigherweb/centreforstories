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

	foreach($cat_child as $child) {
		$sub[] = get_term_by('id', $child, $category->taxonomy);
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
				array ()
			);
		?>
	</div>
	<h2>Archives</h2>
	<ul>
		<?php foreach($sub as $cat): ?>
			<li>
				<a href="<?php echo get_term_link($cat); ?>">
					<?php echo $cat->name; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>