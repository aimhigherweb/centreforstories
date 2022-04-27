<?php

	if(isset($args, $args['env'])) {
		$env = $args['env'];
	}

	if(isset($args, $args['dir'])) {
		$dir = $args['dir'];
	}

	if(isset($args, $args['name'])) {
		$name = $args['name'];
	}

	preg_match('/(\w+)$/', get_template_directory(), $theme);

	$theme_regex = '/themes.' . $theme[1] . '(.+)$/';

	preg_match($theme_regex, $dir, $folder);

	$css_file =  $folder[1] . '/' . $name . '.module.css';	

	if($env == 'production'):
?>

	<style>
		<?php include __DIR__ . '/..'  . $css_file; ?>
	</style>

<?php else: ?>

	<link
		rel="stylesheet" 
		href="<?php echo '/wp-content/themes/' . $theme[1] . $css_file; ?>" 
	/>

<?php endif; ?>