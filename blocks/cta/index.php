<?php
/**
 * Block Name: CTA Block
 * 
 */
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];

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
	$newsletter = false;

	$block_classes = [$styles['block']];

	if(check_field_value(get_field('colour')) && get_field('colour') !== '#f0eee9') {
		$block_classes[] = 'colour';
	}	

	if(check_field_value([get_field('newsletter_signup'), get_theme_mod('newsletter_form_shortcode')])) {
		$block_classes[] = 'newsletter';

		$newsletter = true;
	}
	else {
		$block_classes[] = $styles['image_block'];
	}
?>


<div 
	class="<?php echo classes($block_classes); ?> wp-block" 
	style="--block_colour: <?php echo get_field('colour'); ?>;"
	data-newsletter="<?php echo $newsletter ? 'true' : 'false'; ?>"
>
	<div class="<?php echo classes([$styles['container']]); ?>">
		<?php if(get_field('logo')): ?>
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
		<?php endif; ?>
		<h2 class="<?php echo classes([$styles['heading']]); ?>">
			<?php echo get_field('heading'); ?>
		</h2>
		<div class="<?php echo classes([$styles['content']]); ?>">
			<?php echo get_field('content'); ?>
		</div>
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
		<?php if($newsletter): ?>
			<div class="<?php echo classes([$styles['news_signup']]); ?>">
				<?php echo do_shortcode(get_theme_mod('newsletter_form_shortcode'));?>
			</div>
		<?php endif; ?>
	</div>

	<?php if($newsletter) : ?>
		<div class="<?php echo classes([$styles['image']]); ?>">
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/envelope.svg'); ?>
		</div>
	<?php else : ?>
		<picture class="<?php echo classes([$styles['image']]); ?>">
			<source
				srcset="<?php echo $image['sizes']['block_image_small']; ?>"
				media="(max-width: 640px)"
			/>
			<source
				srcset="<?php echo $image['sizes']['block_image']; ?>"
				media="(min-width: 640px)"
			/>
			<img
				alt="<?php echo $image['alt'] ?>"
				src="<?php echo $image['url'] ?>"
			/>
		</picture>
	<?php endif; ?>
</div>