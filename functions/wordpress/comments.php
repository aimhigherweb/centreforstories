<?php

	// Disable comments
    // Removes from admin menu
    function aimhigher_remove_admin_menus() {
        remove_menu_page( 'edit-comments.php' );
    }
    add_action( 'admin_menu', 'aimhigher_remove_admin_menus' );
    
    // Removes from post and pages
    function remove_comment_support() {
        remove_post_type_support( 'post', 'comments' );
        remove_post_type_support( 'page', 'comments' );
    }
    add_action('init', 'remove_comment_support', 100);

    // Removes from admin bar
    function aimhigher_admin_bar_render() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
    add_action( 'wp_before_admin_bar_render', 'aimhigher_admin_bar_render' );

?>