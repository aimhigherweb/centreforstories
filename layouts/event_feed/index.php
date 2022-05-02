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

	

?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'class' => $styles['header'],
				'page_id' => $page->ID
			)
		);
	?>
	<?php
		get_template_part(
			'parts/events_feed/index'
		);
	?>
</div>