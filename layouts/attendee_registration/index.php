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

<div class="<?php echo $styles['content']; ?>">
	<?php get_template_part('parts/header_image/index'); ?>
	<div class="<?php echo classes([$styles['registration_form']]); ?>">
		<?php echo do_shortcode('[tribe_attendee_registration]');?>
	</div>
</div>