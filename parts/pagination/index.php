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

	$page = $args['page'];
	$pages = $args['pages'];
	$query_pagination = check_array_field($args, 'query');
	


	preg_match(
		"/^\/((?:\w|\/|-)+?)(?:\/page)?(?:\/\d+)?\/?\??$/",
		$_SERVER["REQUEST_URI"],
		$path_matches
	);

	if(!check_array_field($path_matches, 1)) {
		preg_match(
			"/^\/((?:\w|\/|-)+?)(?:\/\?page=\d+)?\/?\??$/",
			$_SERVER["REQUEST_URI"],
			$path_matches
		);
	}

	if(!check_array_field($path_matches, 1)) {
		$path_matches = [
			1 => str_replace(
				'/?' . $_SERVER['QUERY_STRING'],
				'',
				$_SERVER['REQUEST_URI']
			)
		];
	}

	parse_str($_SERVER['QUERY_STRING'], $page_query);	

	$path = $path_matches[1];
	$max_pages = 10;
	$range = 3;
	$page_path = $path . '/page/';

	if($query_pagination) {
		$page_path = $path . '/';
	}
?>

<ul class="<?php echo classes([$styles['pagination']]); ?>">
	<?php if($page > 1): ?>
		<li class="<?php echo classes([$styles['prev']]); ?>">
			<a href="<?php echo build_pagination(
				page_number: $page - 1,
				is_query: $query_pagination,
				path: $page_path,
				page_query: $page_query
			); ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
				Previous
			</a>
		</li>
	<?php endif; ?>
	<?php $i = 0;
		while($i < $pages):
		$page_classes = [$styles['page']];
		$i++; 
		if(
			$pages <= $max_pages ||
			$i == 1 ||
			$i == $pages ||
			($i > $page - $range && $i < $page + $range)
		): 
			if($i == $page) {
				$page_classes[] = $styles['current'];
			}
		?>
			<li class="<?php echo classes($page_classes); ?>">
				<a
					href="<?php echo build_pagination(
						page_number: $i,
						is_query: $query_pagination,
						path: $page_path,
						page_query: $page_query
					); ?>"
						>
					<?php echo $i; ?>
				</a>
			</li>
		<?php elseif(
			$pages > $max_pages &&
			($i == $page - $range || $i == $page + $range)
		): ?>
			<li class="<?php echo classes([$styles['page']]); ?>">...</li>
		<?php endif;
		endwhile; ?>
	<?php if($page < $pages): ?>
		<li class="<?php echo classes([$styles['next']]); ?>">
			<a href="<?php echo build_pagination(
						page_number: $page + 1,
						is_query: $query_pagination,
						path: $page_path,
						page_query: $page_query
					); ?>">
				Next
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		</li>
	<?php endif; ?>
</ul>
