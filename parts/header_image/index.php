<?php
	$data = fetch_styles(__DIR__);

	$feature = get_the_post_thumbnail_url(get_the_ID(), 'header_feature');
	$feature_caption = get_the_post_thumbnail_caption();

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

<?php if(has_post_thumbnail()): ?>

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