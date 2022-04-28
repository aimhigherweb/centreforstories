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

	$map_details = array(
		'lat' => $map['lat'],
		'lng' => $map['lng'],
		'zoom' => $map['zoom'],
		'api_key' => $api_key,
		'pin' => $pin,
	);

	function map_image($size = '800x800', $map) {
        return 'https://api.mapbox.com/styles/v1/aimhigher/cl2gxmea6000715nzoi13wg7v/static' . $map['pin'] . '/' . $map['lng'] . ',' . $map['lat'] . ',' . $map['zoom'] . ',0/' . $size . '?access_token=' . $map['api_key'];
    }
	
?>

<figure class="<?php echo classes([$styles['map']]); ?>">
	<a
		href="<?php echo $args['map_link']; ?>" 
		target="_blank" 
		rel="noopener"
	>
		<picture>
			<source
				srcset="<?php echo map_image('640x640', $map_details); ?>"
				media="(max-width: 640px)"
			/>
			<source
				srcset="<?php echo map_image('800x800', $map_details); ?>"
				media="(max-width: 800px)"
			/>
			<source
				srcset="<?php echo map_image('1000x1000', $map_details); ?>"
				media="(max-width: 1000px)"
			/>
			<source
				srcset="<?php echo map_image('1280x1280', $map_details); ?>"
				media="(min-width: 1000px)"
			/>
			<img 
				class="<?php echo classes([$styles['image']]); ?>" 
				src="<?php echo map_image('1280x1280', $map_details); ?>" 
				alt="Linked map for <?php echo $args['name']; ?>" 
			/>
		</picture>
	</a>
</figure>