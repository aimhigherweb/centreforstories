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
	$pages = $args['pages']

?>

<ul class="<?php echo classes([$styles['pagination']]); ?>">
	<li class="<?php echo classes([$styles['prev']]); ?>">
		<?php if($page > 1): ?>
			<a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>?page=<?php echo $page - 1; ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
				Previous
			</a>
		<?php else: ?>
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			Previous
		<?php endif; ?>
	</li>
	<?php $i = 0;
		while($i < $pages): 
		$i++; ?>
		<li class="<?php echo classes([$styles['page']]); ?>">
			<a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>?page=<?php echo $i; ?>">
				<?php echo $i; ?>
			</a>
		</li>
	<?php endwhile; ?>
	<li class="<?php echo classes([$styles['next']]); ?>">
		<?php if($page < $pages): ?>
			<a href="<?php echo strtok($_SERVER["REQUEST_URI"], '?'); ?>?page=<?php echo $page + 1; ?>">
				Next
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		<?php else: ?>
			Next
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
		<?php endif; ?>
	</li>
</ul>