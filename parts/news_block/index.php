<?php

	$item = $args['post'];

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

	$image_src = get_the_post_thumbnail_url($item->ID, 'event_feed_block');

	if(check_array_field($image_src, 0)) {
		$image_src = $image_src[0];
	}
	
?>

<div class="<?php echo classes([$styles['block']]); ?>">
	<div class="<?php echo classes([$styles['image']]); ?>">
		<img  
			src="<?php echo $image_src; ?>" 
			alt="<?php echo alt_text($item->featured_image); ?>" 
		/>
	</div>
	<p class="<?php echo classes([$styles['date']]); ?>">
		<?php the_time( 'F j, Y' ); ?>
	</p>
	<h3 class="<?php echo classes([$styles['title']]); ?>">
		<?php echo $item->post_title; ?>
	</h3>

	<p class="<?php echo classes([$styles['excerpt']]); ?>">
		<?php echo get_the_excerpt($item->ID); ?>
	</p>
	<a href="<?php echo get_permalink( $item ); ?>" class="<?php echo classes([$styles['cta']]); ?>">
		<span>Read More</span>
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
	</a>
</div>