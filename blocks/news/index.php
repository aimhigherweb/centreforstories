<?php
/**
 * Block Name: News Block
 * 
 */

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

	$block_classes = [$styles['block']];

	$cta = get_field('cta');
	$post_data = cfs_get_news(limit: 3);
	$news = $post_data['posts'];
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		<?php echo get_field('eyebrow'); ?>
	</p>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<ul class="<?php echo classes([$styles['feed']]); ?>">
		<li>
			<div class="<?php echo classes([$styles['content']]); ?>">
				<?php echo get_field('content'); ?>
			</div>
			<?php if(check_field_value([$cta])): ?>
				<a 
					href="<?php echo $cta['url']; ?>" 
					class="<?php echo classes([$styles['cta']]); ?>"
					target="<?php echo $cta['target']; ?>"
				>
					<?php echo $cta['title']; ?>
					<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
				</a>
			<?php endif; ?>
		</li>
		<?php foreach($news as $news_item): ?>
			<li>
				<?php
					get_template_part(
						'parts/news_block/index',
						null,
						array (
							'post' => $news_item
						)
					);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>