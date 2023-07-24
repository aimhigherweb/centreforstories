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
			'env' => 'production'
		)
	);

	$excerpt = get_field('header_content', $id);
	$title = get_the_title($id);
	$graphic = false;
	$eyebrow = get_field('eyebrow', $id);
	$header_classes = [$styles['header']];

	if(check_array_field($args, 'class')) {
		$header_classes[] = $args['class'];
	}

	if(!check_field_value($excerpt)) {
		$excerpt = get_the_excerpt(post: $id);
	}

	if(check_array_field($args, 'title')) {
		$title = $args['title'];
	}

	if(check_array_field($args, 'excerpt')) {
		$excerpt = $args['excerpt'];
	}

	if(check_array_field($args, 'graphic')) {
		$graphic = $args['graphic'];
	}

	if(is_array($eyebrow)) {
		if($eyebrow['title'] && $eyebrow['url']) {
			$eyebrow = '<a href="' . $eyebrow['url'] . '">' . $eyebrow['title'] . '</a>';
		}
		else {
			$eyebrow = $eyebrow['url'];
		}
	}
	else if(!check_field_value($eyebrow)) {
		$eyebrow = '<a href="/">Centre for Stories</a>';
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