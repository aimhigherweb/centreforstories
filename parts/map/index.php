<?php
	$data = fetch_styles(__DIR__);

	$template = $data['template'];
	$styles = $data['styles'];

	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'dev'
		)
	);

	$map = $args['map'];

	$api_key = get_theme_mod('mapbox_api_key');

	$pin = '';

	if($args['pin']) {
		$pin = '/pin-s+f9aa4f(' . $map['lng'] . ',' . $map['lat'] . ')';
	}

	$map_image = 'https://api.mapbox.com/styles/v1/aimhigher/cl2gxmea6000715nzoi13wg7v/static' . $pin . '/' . $map['lng'] . ',' . $map['lat'] . ',' . $map['zoom'] . ',0/800x800?access_token=' . $api_key;
?>

<figure class="<?php echo classes([$styles['map']]); ?>">
	<a
		href="<?php echo $args['map_link']; ?>" 
		target="_blank" 
		rel="noopener"
	>
		<img 
			class="<?php echo classes([$styles['image']]); ?>" 
			src="<?php echo $map_image; ?>" 
			alt="Linked map for <?php echo $args['name']; ?>" 
		/>
	</a>
</figure>