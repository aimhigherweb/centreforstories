<?php

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