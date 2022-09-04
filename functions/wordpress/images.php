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

	add_filter( 'big_image_size_threshold', '__return_false' );

    // Custom Image Sizes
	global $image_sizes;

	foreach ($image_sizes as $size) {
		$crop = false;

		if(array_key_exists('crop', $size)) {
			$crop = $size['crop'];
		}

		add_image_size( $size['name'], $size['width'], $size['height'], $crop );
	}

	// Shortcut to get alt text
	function alt_text($image_id = false) {
		if($image_id) {
			$image_id = get_post_thumbnail_id();
		}

		$alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
       
        return $alt;
       
    }

?>