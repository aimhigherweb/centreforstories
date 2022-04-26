<?php
/**
 * Block Name: Address Block
 * 
 */
	$address = get_field('address', 'option');
	$phone = get_field('phone', 'option');
	$email = get_field('email', 'option');
?>
<?php if(check_field_value([$phone])): ?>

	<address>
		<a
			target="_blank"
			href="tel:<?php echo preg_replace('/(\s|\(|\))+/', '', $phone); ?>"
		>
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/icons/phone.svg'); ?>
			<?php echo $phone; ?>
		</a>
	</address>

<?php endif; ?>

<?php if(check_field_value([$email])): ?>

	<address>
		<a
			target="_blank"
			href="mailto:<?php echo $email; ?>"
		>
			<?php echo inline_svg(get_template_directory_uri() . '/src/img/email.svg'); ?>
			<?php echo $email; ?>
		</a>
	</address>

<?php endif; ?>

<?php if(check_field_value([$address, $address['line_1']])): ?>

	<h2><?php echo get_bloginfo('name'); ?></h2>

	<address>
		<?php echo $address['line_1']; ?><br/>
		<?php if($address['line_2']) : ?>
			<?php echo $address['line_2']; ?><br/>
		<?php endif; ?>
		<span>
			<?php echo $address['suburb']; ?>
			<?php echo $address['state']; ?>
			<?php echo $address['post_code']; ?>
		</span>
	</address>

<?php endif; ?>