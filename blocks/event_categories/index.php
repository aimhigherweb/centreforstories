<?php
/**
 * Block Name: Festivals Block
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

	$festivals = cfs_get_festivals();
	
?>

<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
>
	<p class="<?php echo classes([$styles['eyebrow']]); ?>">
		Festivals
	</p>
	<ul>
		<?php foreach($festivals as $festival): ?>
			<li class="<?php echo classes([$styles['festival']]); ?>">
				<h2 class="<?php echo classes([$styles['heading']]); ?>"><?php echo $festival->name; ?></h2>
				<div class="<?php echo classes([$styles['festival_block']]); ?>">
					<img  
						src="<?php echo wp_get_attachment_image_src($festival->image['ID'], 'festival_block')[0]; ?>" 
						alt="<?php echo alt_text($festival->image['ID']); ?>" 
					/>
					<p><?php echo $festival->description; ?></p>
					<a
						href="/events/category/<?php echo $festival->slug; ?>"
					>
						<span class="sr-only">Go to the <?php echo $festival->name ?> page</span>
						<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
					</a>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>