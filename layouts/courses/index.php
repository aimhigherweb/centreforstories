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

	$page = get_page_by_path($_SERVER["REQUEST_URI"]);

	$courses = $wp_query->posts;

?>

<div class="<?php echo $styles['content']; ?>">
	<div class="<?php echo classes([$styles['content']]); ?>">
		<?php if($courses): ?>
			<ul class="<?php echo classes([$styles['feed']]); ?>">
				<?php foreach($courses as $course): ?>
					<li>
						<?php
							get_template_part(
								'parts/course_block/index',
								null,
								array (
									'course' => $course
								)
							);
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p>Looks like we don't have any courses</p>
		<?php endif; ?>
	<?php echo page_content($page->ID); ?>
</div>