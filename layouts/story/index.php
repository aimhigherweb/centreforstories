<?php
	$data = fetch_styles(__DIR__);

	$format = get_field('format');
	$children = false;
	$audio = false;
	$video = false;

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

	switch ($format) {
		case 'video':
			$video = array(
				'url' => get_field('youtube'),
				'file' => get_field('video'),
				'captions' => get_field('caption'),
			);
			break;
		case 'audio':
			$audio = array(
				'url' => get_field('soundcloud'),
				'file' => get_field('audio'),
				'caption' => get_field('caption'),
			);
			break;
	}

	if(check_field_value([$audio, $audio['url']])) {
		$children = load_template_part(
			'parts/soundcloud/index',
			null,
			$audio
		);
	}
	
	if(check_field_value([$audio, $audio['file']])) {
		$template_part = load_template_part(
			'parts/audio/index',
			null,
			$audio
		);

		if($children) {
			$children = $children . $template_part;
		}
		else {
			$children = $template_part;
		}
	}

?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'children' => $children,
			)
		);
	?>
	<?php get_template_part('parts/header_image/index'); ?>
	<?php echo the_content(); ?>
	<?php 
		if(check_field_value([$video, $video['url']])) {
			get_template_part(
				'parts/youtube/index',
				null,
				$video
			);
		}
	?>
	<?php 
		if(check_field_value([$video, $video['file']])) {
			get_template_part(
				'parts/video/index',
				null,
				$video
			);
		}
	?>
</div>