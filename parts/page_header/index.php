<?php
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

	$excerpt = get_field('header_content');

	if(!check_field_value([$excerpt])) {
		$excerpt = get_the_excerpt();
	}

?>

<header class="<?php echo classes([$styles['header']]); ?>">
	<p class="<?php echo classes([$styles['eyebrow']]); ?>"><?php echo get_field('eyebrow'); ?></p>
	<h1 class="<?php echo classes([$styles['title']]); ?>">
		<?php echo get_the_title(); ?>
	</h1>
	<div class="<?php echo classes([$styles['excerpt']]); ?>">
		<?php echo $excerpt; ?>
	</div>
</header>