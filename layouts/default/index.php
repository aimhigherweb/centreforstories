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
?>

<h1>
	<?php echo get_the_title(); ?>
</h1>

<div class="<?php echo $styles['content']; ?>">
	<?php echo the_content(); ?>
</div>