<?php

	// Hide the widget titles
	add_filter('widget_title','my_widget_title'); 

	function my_widget_title($t) {
		return null;
	}

?>