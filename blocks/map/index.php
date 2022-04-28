<?php
/**
 * Block Name: Map Block
 * 
 */
	
?>


<?php 
	get_template_part(
		'parts/map/index',
		null,
		array(
			'map' => get_field('map'),
			'pin' => get_field('show_pin'),
			'map_link' => get_field('map_link'),
			'map_name' => get_field('name'),
		)
	); 
?>