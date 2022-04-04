<?php

	class CSS_Modules {
		protected $path;
		
		public function set_path(string $path) : void {
			$this->path = $path;
		}

		public function styles(string $file) : array {
			$json = file_get_contents(trailingslashit($this->path) . "{$file}.module.scss.json");
			$classes = json_decode($json);

			return (array) $classes;
		}
	}

	function fetch_styles($dir, $template) {
		$modules = new CSS_Modules();
		$modules->set_path($dir);
       
        return $modules->styles($template);
    }

?>