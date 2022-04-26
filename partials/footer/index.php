<?php
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	$name = get_bloginfo('name');
	$address = get_field('address', 'option');
	$phone = get_field('phone', 'option');
	$email = get_field('email', 'option');
?>

<footer class="footer">
		<div>
			<a class="logo" href="/">
				<?php 
				if(preg_match('/\.svg$/', $logo)) {
					echo inline_svg($logo);
				} 
				else {
					echo '<img src="' . $logo . '" />';
				}
			?>
			</a>
			<p>©
				<?php echo date("Y"); ?>
				<?php echo $name; ?>.
			</p>
			<nav class="legal">
				<ul>
					<?php 
					wp_nav_menu(array(
						'theme_location' => 'legal_menu',
						'container' => false,
						'items_wrap' => '%3$s'
					));
				?>
				</ul>
			</nav>
		</div>
		<nav>
			<ul>
				<?php 
				wp_nav_menu(array(
					'theme_location' => 'footer_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
			</ul>
		</nav>

	<p class="copyright">Website by <a href="https://aimhigherweb.design" target="_blank" rel="nofollow">AimHigher Web</a></p>
</footer>