<?php

	$url = $args['url'];

	preg_match(
		'/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/',
		$url,
		$matches
	);

	$id = $matches[1];

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

<figure class="<?php echo classes([$styles['video']]); ?>">
	<iframe
		src="<?php echo 'https://www.youtube.com/embed/' . $id; ?>" 
		title="YouTube video player" 
		frameborder="0" 
		allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
		allowfullscreen
	></iframe>
</figure>
