<?php
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	$name = get_bloginfo('name');	
	
	$data = fetch_styles(__DIR__);

	$template = $data['template'];
	$styles = $data['styles'];

	$nav_class = [$styles['nav']];

	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'dev'
		)
	);

	if(is_user_logged_in()) {
		array_push($nav_class, $styles['loggedIn']);
	}

	$cart_items = WC()->cart->get_cart_contents_count();
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
	
	<nav id="main-menu" class="<?php echo classes(array_merge([$styles['main']], $nav_class)); ?>">
		<button class="<?php echo $styles['hamburger']; ?>" onclick="toggleMenu()">
			<span class="<?php echo $styles['open']; ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/hamburger.svg'); ?>
			</span>
			<span class="<?php echo $styles['close']; ?>">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/cross.svg'); ?>
			</span>
			<span class="sr-only">Toggle Menu</span>
		</button>
		<ul class="<?php echo classes([$styles['main_menu']]); ?>">
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'main_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
			<li class="<?php echo classes([$styles['search']]); ?>">
				<form name="header-search" method="get" role="search" action="/">
					<label class="sr-only" for="header-search">Enter term or phrase to search for</label>
					<input id="header-search" type="search" name="s" />
					<button type="submit">
						<?php echo inline_svg(get_template_directory_uri() . '/src/img/search.svg'); ?>
						<span class="sr-only">Search Site</span>
					</button>
				</form>
			</li>
		</ul>

		<ul class="<?php echo classes([$styles['utility_mobile'], $styles['utility_nav']]); ?>">
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'utility_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
		</ul>
	</nav>

	<nav class="<?php echo classes(array_merge([$styles['utility']], $nav_class)); ?>">
		<ul class="<?php echo classes([$styles['utility_nav']]); ?>">
			<?php
				if($cart_items > 0) : ?>
					<li>
						<a href="/cart">
							<?php echo inline_svg(get_template_directory_uri() . '/src/img/cart.svg'); ?>
							<span>Cart</span>
						</a>
					</li>
				<?php endif;
			?>
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