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
		$string = false;

		if(fmod($price, 1) == 0) {
			$decimals = 0;
		}

		if($price == 0) {
			$string = 'Free';
		}
		else {
			$string = '<span>$</span>' . number_format($price, $decimals, '.',	',');
		}

		return $string;
	}

	function display_price($price) {
		$number = false;

		if(is_array($price)) {
			if(!is_numeric($price[1])) {
				$number = format_price($price[0]) . '+';
			}
			else if(!is_numeric($price[0])) {
				$number = '<' . format_price($price[1]);
			}
			else {
				$number = format_price($price[0]) . ' - ' . format_price($price[1]);
			}
		}
		else {
			$number =  format_price($price);
		}

		return $number;
	}

	function highlight_search($result) {
		$keys = implode('|', array_filter(explode(' ', get_search_query())));

		return preg_replace(
			'/(' . $keys .')/iu', 
			'<mark>\0</mark>', 
			$result
		);
	}

?>