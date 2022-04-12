<?php
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	$name = get_bloginfo('name');	
	
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
?>

<header class="<?php echo $styles['header']; ?>">
	<a class="<?php echo $styles['logo']; ?>" href="/">
		<?php 
			if(preg_match('/\.svg$/', $logo)) {
				echo inline_svg($logo);
			} 
			else {
				echo '<img src="' . $logo . '" />';
			}
		?>
	</a>
	
	<nav class="<?php echo $styles['main']; ?>">
		<button class="<?php echo $styles['hamburger']; ?>" onclick="toggleMenu()">
			<span class="<?php echo $styles['open']; ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/hamburger.svg'); ?>
			</span>
			<span class="<?php echo $styles['close']; ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/cross.svg'); ?>
			</span>
			<span class="sr-only">Toggle Menu</span>
		</button>
		<ul>
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'main_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
		</ul>

		<ul class="<?php echo $styles['utility_mobile']; ?>">
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'utility_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
		</ul>
	</nav>

	<nav class="<?php echo $styles['utility']; ?>">
		<ul>
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'utility_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
		</ul>
	</nav>
</header>