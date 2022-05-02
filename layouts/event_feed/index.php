<?php

	$event_id = get_the_ID();

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

	var_dump($post);

?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'class' => $styles['header']
			)
		);
	?>
	<?php echo the_content(); ?>
</div>