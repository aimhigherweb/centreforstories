<?php

	// Add Mapbox API key
	function aimhigher_mapbox_key ($wp_customize){
		$wp_customize->add_section('mapbox_api_section', array(
			'title'          => 'Mapbox API Key'
		));

		$wp_customize->add_setting('mapbox_api_key', array(
			'default'        => '',
		) );

		$wp_customize->add_control( 'mapbox_api_key', array(
			'type' => 'text',
			'section' => 'mapbox_api_section',
			'label' => __( 'Enter Mapbox API Key' ),
		) );

	}
	add_action('customize_register', 'aimhigher_mapbox_key');

?>