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
			'env' => 'production'
		)
	);

?>



<figure class="<?php echo classes([$styles['audio']]); ?>">
	<iframe 
		src="https://w.soundcloud.com/player/?url=<?php echo urlencode($url); ?>&amp;color=%238494b4&amp;auto_play=false&amp;hide_related=true&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=false" 
		width="100%" 
		height="166" 
		frameborder="no" 
		scrolling="no"
	></iframe>

	<?php if(check_array_field($args, 'caption')) : ?>
		<figcaption class="<?php echo classes([$styles['caption']]); ?>">
			<?php echo $args['caption']; ?>
		</figcaption>
	<?php endif; ?>
</figure>