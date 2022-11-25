<?php
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

	$page_id = get_option('page_for_posts');
	$page_data = get_page($page_id);
	$post_data = cfs_get_news(limit: 8);
	$pages = $post_data['pages'];
	$page = $post_data['page'];
	$news = $post_data['posts'];


	$feed_classes = [$styles['feed']];

	if($page == 1) {
		$feed_classes[] = $styles['first_page'];
	}
?>


<div class="<?php echo classes([$styles['content']]); ?>">
	<?php if($news): ?>
		<ul class="<?php echo classes($feed_classes); ?>">
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
	<?php else: ?>
		<p>Looks like we don't have any news</p>
	<?php endif; ?>


	<?php
		if($pages > 1) {
			get_template_part(
				'parts/pagination/index',
				null,
				array(
					'page' => $page,
					'pages' => $pages,
				)
			);
		}

	?>

	<?php echo page_content($page_id); ?>
</div>