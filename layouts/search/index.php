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

	$results = $wp_query->posts;
	$query = 'Showing ' . count($results) . ' results for <em>' . get_search_query() . '</em>';
	
?>

<div class="<?php echo $styles['content']; ?>">
	<?php 
		get_template_part(
			'parts/page_header/index',
			null,
			array(
				'title' => 'Search Results',
				'excerpt' => $query
			)
		);
	?>
	<form class="<?php echo classes([$styles['search']]); ?>" name="page-search" method="get" role="search" action="/">
		<label class="sr-only" for="header-search">Enter term or phrase to search for</label>
		<input id="page-search" type="search" name="s" value="<?php echo get_search_query(); ?>" />
		<button type="submit">
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/search.svg'); ?>
			<span class="sr-only">Search Site</span>
		</button>
	</form>
	<?php if($results): ?>
		<ul class="<?php echo classes([$styles['results']]); ?>">
			<?php foreach($results as $result): 
				$title = highlight_search($result->post_title);
				$excerpt = highlight_search(get_the_excerpt($result->ID));
			?>
				<li>
					<h2 class="<?php echo classes([$styles['page_title']]); ?>">
						<a href="<?php echo get_permalink($result->ID); ?>">
							<?php echo $title; ?>
						</a>
					</h2>
					<div class="<?php echo classes([$styles['excerpt']]); ?>">
						<?php echo $excerpt; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Looks like there's no results for that, try searching for something else.</p>
	<?php endif; ?>
</div>