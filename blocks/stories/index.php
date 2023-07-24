<?php
/**
 * Block Name: Stories Block
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
			'env' => 'production'
		)
	);

	$block_classes = [$styles['block']];

	$fetch_type = get_field('fetch_type');
	$category = false;
	$post_in = false;

	if(check_array_field($fetch_type, 'value')) {
		$fetch_type = $fetch_type['value'];
	}

	if($fetch_type == 'collections') {
		$cat = get_term_by(
			'id',
			get_field('collections'),
			'collection'
		);

		$category = $cat->slug;
	}
	else if($fetch_type == 'select') {
		$post_in = get_field('select');
	}

	$story_data = cfs_get_stories(
		limit: 3,
		category: $category,
		post_in: $post_in
	);
	$stories = $story_data['posts'];
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<?php if($stories): ?>
		<ul class="<?php echo classes([$styles['feed']]); ?>">
			<?php foreach($stories as $story): ?>
				<li class="<?php echo classes([$styles['story']]); ?>">
					<?php
						get_template_part(
							'parts/story_block/index',
							null,
							array (
								'story' => $story,
							)
						);
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>