<?php

	$item = $args['story'];

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

	$excerpt = get_the_excerpt($item->ID);

	if(get_field('header_content', $item->ID)) {
		$excerpt = get_field('header_content', $item->ID);
	}

	$collection = get_the_terms($item, 'collection');

	if($collection) {
		$collection = $collection[0]->name;
	}
	
?>

<div class="<?php echo classes([$styles['block']]); ?>">
	<div class="<?php echo classes([$styles['image']]); ?>">
		<img  
			src="<?php echo $image_src; ?>" 
			alt="<?php echo alt_text($item->featured_image); ?>" 
		/>
	</div>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		<?php echo $collection; ?>
	</p>
	<h2 class="<?php echo classes([$styles['title']]); ?>">
		<?php echo $item->post_title; ?>
	</h2>

	<p class="<?php echo classes([$styles['excerpt']]); ?>">
		<?php echo $excerpt; ?>
	</p>
	<a href="<?php echo get_permalink( $item ); ?>" class="<?php echo classes([$styles['cta']]); ?>">
		<span>Read More</span>
		<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
	</a>
</div>