<?php

	//Stop Inlining width and height for images
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); 
	add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
	function remove_thumbnail_dimensions( $html ) { 
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); 
		return $html;
	}

	// Support Featured Images
    add_theme_support( 'post-thumbnails' );

    // Custom Image Sizes
	global $image_sizes;

	foreach ($image_sizes as $size) {
		add_image_size( $size['name'], $size['width'], $size['height'], $size['crop'] );
	}

?>