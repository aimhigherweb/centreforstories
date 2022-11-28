<?php
	$name = get_bloginfo('name');
	$address = get_field('address', 'option');
	$phone = get_field('phone', 'option');
	$email = get_field('email', 'option');
	$charity_logo = get_field('logo', 'option');

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

<div id="popup"  class="<?php echo classes([$styles['popup']]); ?>">
	<button class="<?php echo classes([$styles['close']]); ?>" onclick="togglePopup('popup')">
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/cross.svg'); ?>
		<span class="sr-only">Toggle Popup</span>
	</button>
	<div class="<?php echo classes([$styles['content']]); ?>">
		<?php dynamic_sidebar('aoc'); ?>
	</div>
</div>