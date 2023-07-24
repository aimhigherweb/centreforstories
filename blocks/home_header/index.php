<?php
/**
 * Block Name: Home Header Section
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

	$image = get_field('image');
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	
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
	<figure class="<?php echo classes([$styles['image']]); ?>">
		<picture>
			<source
				srcset="<?php echo $image['sizes']['block_image_small']; ?>"
				media="(max-width: 640px)"
			/>
			<?php if(check_array_field($image['sizes'], 'banner_image')): ?>
				<source
					srcset="<?php echo $image['sizes']['banner_image']; ?>"
					media="(min-width: 640px)"
				/>
			<?php endif; ?>
			<source
				srcset="<?php echo $image['sizes']['block_image']; ?>"
				media="(min-width: 640px)"
			/>
			
			<img
				alt="<?php echo $image['alt'] ?>"
				src="<?php echo $image['url'] ?>"
			/>
		</picture>
		<figcaption>
			<div class="<?php echo classes([$styles['logo']]); ?>">
				<?php 
					if(preg_match('/\.svg$/', $logo)) {
						echo inline_svg($logo);
					} 
					else {
						echo '<img src="' . $logo . '" />';
					}
				?>
			</div>
			<span><?php echo wp_get_attachment_caption($image['ID']); ?></span>
		</figcaption>
	</figure>
</div>