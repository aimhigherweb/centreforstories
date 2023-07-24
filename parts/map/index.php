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
			'env' => 'production'
		)
	);

	$map = $args['map'];
	$map_classes = [$styles['map']];
	$name = '';

	$pin = '';

	if(check_array_field($args, 'pin')) {
		$pin = '/pin-s+f9aa4f(' . $map['lng'] . ',' . $map['lat'] . ')';
	}

	if(check_array_field($args, 'class')) {
		$map_classes[] = $args['class'];
	}

	if(check_array_field($args, 'name')) {
		$name = $args['name'];
	}

	$map_details = array(
		'lat' => $map['lat'],
		'lng' => $map['lng'],
		'zoom' => $map['zoom'],
		'api_key' => get_theme_mod('mapbox_api_key'),
		'pin' => $pin,
	);	
?>

<?php if(
	check_array_field($map_details, 'lat') &&
	check_array_field($map_details, 'lng') &&
	check_array_field($map_details, 'zoom') &&
	check_array_field($map_details, 'api_key')
): ?>
	<figure class="<?php echo classes($map_classes); ?>">
		<a
			href="<?php echo $args['map_link']; ?>" 
			target="_blank" 
			rel="noopener"
		>
			<picture>
				<source
					srcset="<?php echo map_image(size: '640x640', map: $map_details); ?>"
					media="(max-width: 640px)"
				/>
				<source
					srcset="<?php echo map_image(size: '800x800', map: $map_details); ?>"
					media="(max-width: 800px)"
				/>
				<source
					srcset="<?php echo map_image(size: '1000x1000', map: $map_details); ?>"
					media="(max-width: 1000px)"
				/>
				<source
					srcset="<?php echo map_image(size: '1280x1280', map: $map_details); ?>"
					media="(min-width: 1000px)"
				/>
				<img 
					class="<?php echo classes([$styles['image']]); ?>" 
					src="<?php echo map_image(size: '1280x1280', map: $map_details); ?>" 
					alt="Linked map for <?php echo $name; ?>" 
				/>
			</picture>
		</a>
	</figure>
<?php endif; ?>