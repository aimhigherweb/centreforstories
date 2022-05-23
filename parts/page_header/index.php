<?php

	$id = get_the_ID();

	if(check_field_value([$args, $args['page_id']])) {
		$id = $args['page_id'];
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

	$excerpt = get_field('header_content', $id);
	$title = get_the_title($id);

	if(check_field_value([$args, $args['taxonomy']])) {
		$tax = get_queried_object();
		$title = $tax->name;
		$excerpt = $tax->description;
	}

	if(!check_field_value([$excerpt])) {
		$excerpt = get_the_excerpt($id);
	}

?>

<header class="<?php echo classes([$styles['header'], $args['class']]); ?>">
	<p class="<?php echo classes([$styles['eyebrow']]); ?>"><?php echo get_field('eyebrow'); ?></p>
	<h1 class="<?php echo classes([$styles['title']]); ?>">
		<?php echo $title; ?>
	</h1>
	<div class="<?php echo classes([$styles['excerpt']]); ?>">
		<?php echo $excerpt; ?>
	</div>
	<?php 
		if(check_field_value([$args, $args['children']])) {
			echo $args['children'];
		}
	?>
</header>