<?php

    function cfs_get_festivals() {        
		$args = array(
			'taxonomy' => 'tribe_events_cat',
			'include_children' => false,
			'hide_empty' => false,
			'parent' => false,
			'orderby' => 'name',
			'order' => 'ASC',
		);

		$festivals = get_terms($args);

		$festival_data = [];

		foreach($festivals as $festival) {
			$festival->image = get_field('image', $festival);
			$festival_data[] = $festival;
		}

        return $festival_data;
    }

?>