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
    // add_image_size( 'product_thumbnail', 250, 200, array('center', 'center') );

?>