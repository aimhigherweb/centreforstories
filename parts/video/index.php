<?php

	$file = $args['file'];

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
	<video controls>
		<source
			src="<?php echo $file['url'] ?>"
			type="<?php echo $file['mime_type']?>"
		/>
		<p>Sorry, your browser doesn't support this video.</p>
	</video>
</figure>
