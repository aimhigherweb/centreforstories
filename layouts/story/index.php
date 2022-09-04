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
	$collection_data = false;
	$archived = false;

	if(check_array_field($args, 'page_id')) {
		$page_id = $args['page_id'];
	}

	if(check_array_field($search_query, 'collection') && $search_query['collection'] == 'archived') {
		$archived = true;
	}

	$collection_data = cfs_get_story_collections($archived);
	$collection_slugs = $collection_data['collections'];
	$collections = $collection_data['terms'];

	// dump($collection_slugs);

	$story_data = cfs_get_stories(collections: $collection_slugs);
	$stories = $story_data['posts'];
	$page = $story_data['page'];
	$pages = $story_data['pages'];
	$header_image = false;
	

	$header_args = array(
		'title' => get_the_title($args['page_id']),
		'excerpt' => get_field('header_content', $args['page_id']),
		'class' => $styles['header']
	);

	// dump($search_query);

	if(check_array_field($search_query, 'collection') && get_queried_object()) {
		$collection_page = $search_query['collection'];
		$collection_data = get_queried_object();

		$header_args['title'] = 'Stories - ' . $collection_data->name;
		$header_args['excerpt'] = $collection_data->description;
		$header_image = get_field('image', $collection_data);
	}
	else {
		$page_id = get_page_by_path( '/stories' )->ID;
		$header_args['page_id'] = $page_id;
	}

	$content_classes = [$styles['content']];

	if($archived) {
		$content_classes[] = $styles['archived'];
		$page_id = get_page_by_path( '/stories' )->ID;
	}

	// dump($header_image);

?>

<div class="<?php echo classes($content_classes); ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			$header_args
		);
	?>
	<?php if(!$archived): ?>
		<?php 
			get_template_part(
				'parts/header_image/index',
				null,
				array(
					'page_id' => $page_id,
					'image' => $header_image,
				)
			); 
		?>
	<?php endif; ?>
	<ul class="<?php echo classes([$styles['filters']]); ?>">
		
		<?php foreach($collections as $type): ?>
			<li>
				<ul>
					
					<li class="<?php echo classes([$styles['collection_type']]); ?>">
						<?php echo $type['name']; ?>s:
					</li>
					<li>
						<a
							class="<?php echo classes([$styles['collection']]); ?>"
							href="/stories"
						>
							All Stories
						</a>
					</li>
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
	<?php else: ?>
		<p>Looks like we don't have any stories in that category</p>
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
	<?php if($archived): ?>
		<a href="/stories" class="<?php echo classes([$styles['past']]); ?>">
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
			Featured Collections
		</a>
	<?php else: ?>
		<a href="/stories/archived" class="<?php echo classes([$styles['past']]); ?>">
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_long.svg'); ?>
			Story Archive
		</a>
	<?php endif;?>
	<?php echo page_content($page_id); ?>
	
</div>