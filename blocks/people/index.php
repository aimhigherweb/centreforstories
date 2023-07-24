<?php
/**
 * Block Name: Team Block
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
	$people_data = [];

	if( have_rows('profiles') ) {
		while( have_rows('profiles') ) {
			the_row();

			$person_data = array(
				'image' => get_sub_field('image'),
				'name' => get_sub_field('name'),
				'role' => get_sub_field('role'),
				'bio' => get_sub_field('bio'),
			);

			$people_data[] = $person_data;
		}
	}
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	
</div>