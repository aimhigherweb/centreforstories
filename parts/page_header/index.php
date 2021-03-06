<?php

	$id = get_the_ID();

	if(check_array_field($args, 'page_id')) {
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
	$graphic = false;
	$eyebrow = get_field('eyebrow');
	$header_classes = [$styles['header']];

	if(check_array_field($args, 'class')) {
		$header_classes[] = $args['class'];
	}

	if(!check_field_value($excerpt)) {
		$excerpt = get_the_excerpt(post: $id);
	}

	if(!check_field_value($eyebrow)) {
		$eyebrow = 'Centre for Stories';
	}

	if(check_array_field($args, 'title')) {
		$title = $args['title'];
	}

	if(array_key_exists('excerpt', $args) && $args['excerpt'] !== false) {
		$excerpt = $args['excerpt'];
	}

	if(check_array_field($args, 'graphic')) {
		$graphic = $args['graphic'];
	}

?>

<header class="<?php echo classes($header_classes); ?>">
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		<?php echo $eyebrow; ?>
	</p>
	<h1 class="<?php echo classes([$styles['title']]); ?>">
		<?php echo $title; ?>
	</h1>
	<div class="<?php echo classes([$styles['excerpt']]); ?>">
		<?php echo $excerpt; ?>
	</div>
	<?php 
		if(check_array_field($args, 'children')) {
			echo $args['children'];
		}
	?>
	<?php if($graphic) : ?>
		<div class="<?php echo classes([$styles['graphic']]); ?>">
			<?php echo inline_svg($graphic); ?>
		</div>
	<?php endif; ?>
</header>