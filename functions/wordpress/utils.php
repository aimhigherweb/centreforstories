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

	function dump($args) {
		echo '<pre>';
        var_dump($args);
        echo '</pre>';
	}

	function format_price($price) {
		$decimals = 2;

		if(fmod($price, 1) == 0) {
			$decimals = 0;
		}

		return '<span>$</span>' . number_format($price, $decimals, '.',	',');
	}

	function display_price($price) {
		$number = false;

		if(is_array($price)) {
			$number = format_price($price[0]) . ' - ' . format_price($price[1]);
		}
		else {
			$number =  format_price($price);
		}

		return $number;
	}

?>