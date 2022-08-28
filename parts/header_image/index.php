<?php
	$data = fetch_styles(__DIR__);

	$feature = get_the_post_thumbnail_url(get_the_ID(), 'header_feature');
	$feature_caption = get_the_post_thumbnail_caption();

	// dump($args);

	if(check_array_field($args, 'image') && $args['image'] !== false) {
		$feature = wp_get_attachment_image_url($args['image']['ID'], 'header_feature');
		$feature_caption = wp_get_attachment_caption($args['image']['ID']);
	}

	if(check_array_field($args, 'page_id') && $args['page_id'] !== false) {
		$feature = get_the_post_thumbnail_url($args['page_id'], 'header_feature');
		$feature_caption = get_the_post_thumbnail_caption($args['page_id']);
	}

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

<?php if($feature): ?>

	<figure class="<?php echo classes([$styles['feature']]); ?>">
		<img 
			class="<?php echo classes([$styles['image']]); ?>" 
			src="<?php echo $feature; ?>" alt="<?php echo alt_text(); ?>" 
		/>
		<?php if(check_field_value($feature_caption)) : ?>
			<figcaption class="<?php echo classes([$styles['caption']]); ?>">
				<?php echo $feature_caption; ?>
			</figcaption>
		<?php endif; ?>
	</figure>

<?php endif; ?>