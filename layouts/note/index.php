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
			'env' => 'production'
		)
	);
	
?>


<?php 
	get_template_part(
		'parts/page_header/index',
		null,
		array(
			'excerpt' => '',
			'title' => 'Note: ' . $args['title']
		)
	);
?>

<div class="<?php echo $styles['content']; ?>">
	
	<?php echo the_content(); ?>
</div>