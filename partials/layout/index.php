<?php
/**
 * The main layout
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	require_once ( ABSPATH . '/wp-admin/includes/file.php' );
	
	$logo = wp_get_attachment_image_src(get_theme_mod( 'custom_logo' ), 'full')[0];
	$layout = 'default';
	$page_id = get_the_ID();
	$category = null;
	
	$data = fetch_styles(__DIR__);
	
	$template = $data['template'];
	$styles = $data['styles'];

	$class = [$styles['body']];

	$title = wp_get_document_title();
	
	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'dev'
		)
	);

	if(check_array_field($args, 'page_id')) {
		$page_id = $args['page_id'];
		$title = get_the_title($page_id);
	}

	if(check_array_field($args, 'template')) {
		$layout = $args['template'];
	}

	if(
		check_array_field($args, 'class')
		&& check_array_field($styles, $args['class'])
	) {
		array_push($class, $styles[$args['class']]);
	}

	$gtm_tag = get_theme_mod('gtm_tag_id');

	$style = '';

	$colour = get_field('page_colour', $page_id);

	if($colour) {
		$style = '--page_colour: ' . $colour . ';';
	}
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

		<title><?php echo $title; ?></title>

		<link rel="icon" href="<?php echo $logo; ?>" type="image/svg+xml">

		<?php get_template_part('partials/dev-styles/index'); ?>

	</head>

	<body
		class="<?php echo classes($class); ?>" 
		style="<?php echo $style; ?>"
	>
		<?php if($gtm_tag) : ?>
			<!-- Google Tag Manager (noscript) -->
				<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_tag; ?>"
				height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<!-- End Google Tag Manager (noscript) -->
		<?php endif; ?>
		<?php get_template_part('partials/header/index'); ?>

		<main id="main" class="<?php echo classes([$styles['main']]); ?>">
			<?php 
				if(!check_array_field($args, 'custom_page_header')) {
					get_template_part('parts/page_header/index', null, array('page_id' => $page_id));
				}
			?>
			<?php get_template_part('layouts/' . $layout . '/index'); ?>
		</main>

		<?php get_template_part('partials/footer/index'); ?>
		<?php wp_footer(); ?>
		<script src="<?php echo get_template_directory_uri(); ?>/src/js/main.js"></script>
	</body>
</html>