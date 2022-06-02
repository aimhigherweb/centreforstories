<?php
	global $query_string;

	wp_parse_str( $query_string, $search_query );

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

	$page_id = get_the_ID();
	$collection_page = false;

	if(check_array_field($args, 'page_id')) {
		$page_id = $args['page_id'];
	}

	$story_data = cfs_get_stories();

	$collections = cfs_get_story_collections();

	if(check_array_field($search_query, 'collection')) {
		$collection_page = $search_query['collection'];
	}

?>

<div class="<?php echo $styles['content']; ?>">
	<ul class="<?php echo classes([$styles['filters']]); ?>">
		<?php foreach($collections as $type): ?>
			<li>
				<ul>
					<li class="<?php echo classes([$styles['collection_type']]); ?>"><?php echo $type['name']; ?>s:</li>
					<?php foreach($type['terms'] as $collection):
						$current = $collection->slug == $collection_page ? $styles['current'] : '';
					?>
						<li>
							<a
								class="<?php echo classes([$styles['collection'], $current]); ?>"
								href="<?php echo $collection->permalink; ?>"
							>
								<?php echo $collection->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php echo page_content($page_id); ?>
</div>