<?php

	//Custom Login Logo
    function my_custom_login_logo() { 
        ?> 
        <style type="text/css"> 
            body.login div#login h1 a {
                background-image: url('https://aimhigherweb.design/img/logo.png');
                background-position: center;
                background-size: contain;
                padding-bottom: 30px; 
                width: 100%;
            } 
        </style>
        <?php 
    } add_action( 'login_enqueue_scripts', 'my_custom_login_logo' );

    //Upload logo to customise area
    function custom_logo_setup() {
        $defaults = array(
            'height'      => 50,
            'width'       => 120,
            'flex-height' => true,
            'flex-width'  => true,
        );
        add_theme_support( 'custom-logo', $defaults );
    }
    add_action( 'after_setup_theme', 'custom_logo_setup' );

	 // Add Google Tag Manager Tag
	 function custom_ga_gtm_tags ($wp_customize){
        $wp_customize->add_section('ga_gtm_section', array(
            'title'          => 'Google Analytics'
        ));

        $wp_customize->add_setting('gtm_tag_id', array(
            'default'        => ' GTM-XXXXXX',
        ) );

        $wp_customize->add_control( 'gtm_tag_id', array(
            'type' => 'text',
            'section' => 'ga_gtm_section',
            'label' => __( 'Enter Google Tag Manager ID' ),
        ) );

    }
    add_action('customize_register', 'custom_ga_gtm_tags');

?>