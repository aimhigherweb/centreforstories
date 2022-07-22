<?php
	$data = fetch_styles(__DIR__);

	$feature = get_the_post_thumbnail_url(get_the_ID(), 'header_feature');
	$feature_caption = get_the_post_thumbnail_caption();
	$feature_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

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

<div class="<?php echo $styles['content']; ?>">
	<?php get_template_part('parts/header_image/index'); ?>
	<p class="<?php echo classes([$styles['date']]); ?>">
		<?php echo get_the_date('F j, Y'); ?>
	</p>
	<?php echo the_content(); ?>
	<?php if (is_active_sidebar('news_cta')) : ?>
		<?php dynamic_sidebar('news_cta'); ?>
	<?php endif; ?>
</div>