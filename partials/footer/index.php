<?php
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	$name = get_bloginfo('name');
	$address = get_field('address', 'option');
	$phone = get_field('phone', 'option');
	$email = get_field('email', 'option');
	$charity_logo = get_field('logo', 'option');

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

<footer class="<?php echo classes([$styles['footer']]); ?>">
	<?php if (is_active_sidebar('aoc')) : ?>
		<div class="<?php echo classes([$styles['aoc']]); ?>">
			<?php dynamic_sidebar('aoc'); ?>
		</div>
	<?php endif; ?>
	<div class="<?php echo classes([$styles['copyright']]); ?>">
		<a 
			class="<?php echo classes([$styles['logo']]); ?>" 
			href="/"
		>
			<?php 
				if(preg_match('/\.svg$/', $logo)) {
					echo inline_svg($logo);
				} 
				else {
					echo '<img src="' . $logo . '" />';
				}
			?>
		</a>
		<?php 
			if(preg_match('/\.svg$/', $charity_logo)) {
				echo inline_svg($charity_logo);
			} 
			else {
				echo '<img src="' . $charity_logo . '" />';
			}
		?>
		<p>© <?php echo date("Y"); ?> <?php echo $name; ?></p>
	</div>
	<nav class="<?php echo classes([$styles['nav']]); ?>">
		<ul>
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'footer_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
			<li class="label menu-item menu-item-has-children">
				<span class="section">Contact Us</span>
				<ul class="sub-menu">
					<?php if(check_field_value($phone)): ?>
						<li>
							<address>
								<a
									target="_blank"
									href="tel:<?php echo preg_replace('/(\s|\(|\))+/', '', $phone); ?>"
								>
									<?php echo $phone; ?>
								</a>
							</address>
						</li>
					<?php endif; ?>
					<?php if(check_field_value($email)): ?>
						<li>
							<address>
								<a
									target="_blank"
									href="mailto:<?php echo $email; ?>"
								>
									<?php echo $email; ?>
								</a>
							</address>
						</li>
					<?php endif; ?>
					<li>
						<nav class="<?php echo classes([$styles['social']]); ?>">
							<ul>
								<?php 
									wp_nav_menu(array(
										'theme_location' => 'social_menu',
										'container' => false,
										'items_wrap' => '%3$s'
									));
								?>
							</ul>
						</nav>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
	
	<nav class="<?php echo classes([$styles['social']]); ?>">
		<ul>
			<?php 
				wp_nav_menu(array(
					'theme_location' => 'social_menu',
					'container' => false,
					'items_wrap' => '%3$s'
				));
			?>
		</ul>
	</nav>

	<p class="<?php echo classes([$styles['aimhigher']]); ?>">Website by <a href="https://aimhigherweb.design" target="_blank" rel="nofollow">AimHigher Web</a></p>
</footer>