<?php

	function load_template_part($template_name, $part_name = null, $args = array()) {
		
		ob_start();
		get_template_part($template_name, $part_name, $args);
		$var = ob_get_contents();
		ob_end_clean();

		return $var;
	}

?>