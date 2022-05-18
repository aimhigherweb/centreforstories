<?php

	function remove_plugin_styles_tutor_lms(){
		wp_dequeue_style( 'tutor' );
	}
	add_action( 'wp_enqueue_scripts', 'remove_plugin_styles_tutor_lms', 999 );

?>