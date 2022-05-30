<?php

	$url = $args['url'];


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



<figure class="<?php echo classes([$styles['audio']]); ?>">
	<iframe
		width="100%" 
		height="166" 
		scrolling="no" 
		frameborder="no" 
		allow="autoplay"
  		src="https://w.soundcloud.com/player/?url=<?php echo urlencode($url); ?>"
	></iframe>
	<?php if(check_array_field($args, 'caption')) : ?>
		<figcaption class="<?php echo classes([$styles['caption']]); ?>">
			<?php echo $args['caption']; ?>
		</figcaption>
	<?php endif; ?>
</figure>