<?php

    // Allow SVG
    add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

        global $wp_version;
        
        $filetype = wp_check_filetype( $filename, $mimes );
        
        return [
            'ext'             => $filetype['ext'],
            'type'            => $filetype['type'],
            'proper_filename' => $data['proper_filename']
        ];
        
    }, 10, 4 );

    function cc_mime_types( $mimes ){
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter( 'upload_mimes', 'cc_mime_types' );

    function fix_svg() {
        echo '<style>
            .attachment-266x266, .thumbnail img {
                width: 100% !important;
                height: auto !important;
            }
            </style>';
    }
    add_action( 'admin_head', 'fix_svg' );

	// Fetch and inline SVG Function
    function inline_svg($svg_path) {
        $svg_fetch = wp_remote_get($svg_path);
        $svg_body = '';

        if(is_array($svg_fetch) && $svg_fetch['response']['code'] == '200'){
            $svg_body = wp_remote_retrieve_body($svg_fetch);
        }
       
        return $svg_body;
       
    }


?>