<?php

	function load_template_part($template_name, $part_name = null, $args = array()) {
		
		ob_start();
		get_template_part($template_name, $part_name, $args);
		$var = ob_get_contents();
		ob_end_clean();

		return $var;
	}

	function page_content($page) {
		$content = get_the_content(null, null, $page);

		echo apply_filters('the_content', $content);
	}

?>