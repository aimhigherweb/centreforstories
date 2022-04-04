<?php
/**
 * The main layout
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	require_once ( ABSPATH . '/wp-admin/includes/file.php' );
	
	$template = 'default';
	$class = '';
	$page_id = get_the_ID();
	$category = null;

	if(isset($args, $args['template'])) {
		$template = $args['template'];
	}

	if(isset($args, $args['class'])) {
		$class = $args['class'];
	}

	$gtm_tag = get_theme_mod('gtm_tag_id');
?>

<!DOCTYPE html>
<html lang="en-AU">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge" />
		<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
		<base href="<?php echo get_site_url(); ?>" />
		
		<?php if($gtm_tag) : ?>
			<!-- Google Tag Manager -->
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer', '<?php echo $gtm_tag; ?>');</script>
			<!-- End Google Tag Manager -->
		<?php endif; ?>

		<?php wp_head(); ?>

		<title><?php echo wp_get_document_title(); ?></title>

		<?php get_template_part('partials/dev-styles'); ?>

	</head>

	<body class="<?php echo $class; ?>">
		<?php if($gtm_tag) : ?>
			<!-- Google Tag Manager (noscript) -->
				<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_tag; ?>"
				height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php endif; ?>
		<?php get_template_part('partials/header/index'); ?>

		<main id="main">

			<?php get_template_part('layouts/' . $template); ?>
		</main>

		<?php get_template_part('partials/footer'); ?>
		<?php wp_footer(); ?>
		<script src="<?php echo get_template_directory_uri(); ?>/src/js/main.js"></script>
	</body>
</html>