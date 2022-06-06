<?php
/**
 * Block Name: Course Block
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

	$cta = get_field('cta');
	$image = get_field('image');
	
?>

<div 
	class="<?php echo classes([$styles['block']]); ?> wp-block" 
>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
	<?php echo get_field('eyebrow'); ?>
	</p>
	<h2 class="<?php echo classes([$styles['heading']]); ?>">
		<?php echo get_field('heading'); ?>
	</h2>
	<div>
		
		<div class="<?php echo classes([$styles['content']]); ?>">
			
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
		</div>
	</div>
</div>