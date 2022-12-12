<?php

	function aimhigher_custom_cta_block($atts, $content = '') { 
		ob_start();
		
		$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];	

		$data = fetch_styles(TEMPLATEPATH . '/blocks/cta');

		$template = $data['template'];
		$styles = $data['styles'];

		get_template_part(
			'parts/modules',
			null,
			array(
				'name' => $template,
				'dir' => TEMPLATEPATH . '/blocks/cta',
				'env' => 'dev'
			)
		);

		$cta = get_field('cta');
	?>


	<div 
		class="<?php echo classes([$styles['image_block'], $styles['block'], ]); ?> wp-block colour"
		style="--block_colour: #174f45;"
	>
		<div class="<?php echo classes([$styles['container']]); ?>">
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
			<h2 class="<?php echo classes([$styles['heading']]); ?>">
				<?php echo $atts['title']; ?>
			</h2>
			<div class="<?php echo classes([$styles['content']]); ?>">
				<?php echo $content; ?>
			</div>
			<a 
				href="<?php echo $atts['url']; ?>" 
				class="<?php echo classes([$styles['cta']]); ?>"
			>
				<?php echo $atts['name']; ?>
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		</div>

		<picture class="<?php echo classes([$styles['image']]); ?>">
			<source
				srcset="<?php echo wp_get_attachment_image_src($atts['image'], 'block_image_small')[0]; ?>"
				media="(max-width: 640px)"
			/>
			<source
				srcset="<?php echo wp_get_attachment_image_src($atts['image'],'block_image')[0]; ?>"
				media="(min-width: 640px)"
			/>
			<img
				alt="<?php echo alt_text($atts['image']); ?>"
				src="<?php echo wp_get_attachment_image_src($atts['image'])[0]; ?>"
			/>
		</picture>
	</div>

		<?php 
		
		$content = ob_get_clean();

		return $content;
	}
	add_shortcode('cta', 'aimhigher_custom_cta_block');

?>