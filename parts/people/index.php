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

	$people_data = $args['people_data'];
?>

<ul class="<?php echo classes([$styles['people']]); ?>">
	<?php foreach($people_data as $person): ?>
		<li id="<?php echo check_array_field($person, 'id') ? $person['id'] : ''; ?>" class="<?php echo classes([$styles['profile']]); ?>">
			<div class="<?php echo classes([$styles['image']]); ?>">
				<?php if(check_array_field($person, 'image') && check_array_field($person['image'], 'sizes')): ?>
					<img
						alt="<?php echo $person['image']['alt'] || ''; ?>"
						src="<?php echo $person['image']['sizes']['people_block']; ?>"
					/>
				<?php elseif(check_array_field($person, 'image_url')): ?>
					<img
						alt="<?php echo $person['image_alt'] || ''; ?>"
						src="<?php echo $person['image_url']; ?>"
					/>
				<?php endif; ?>
			</div>
			<details>
				<summary>
					<h3><?php echo $person['name']; ?></h3>
					<?php if(check_array_field($person, 'role')): ?>
						<p class="<?php echo classes([$styles['role']]); ?>"><?php echo $person['role']; ?></p>
					<?php endif; ?>
					
					<span class="<?php echo classes([$styles['toggle']]); ?>">
						<span class="<?php echo classes([$styles['expand']]); ?>">
							<span class="sr-only">Expand Bio</span>
						</span>
						<span class="<?php echo classes([$styles['collapse']]); ?>">
							<span class="sr-only">Collapse Bio</span>
						</span>
					</span>
				</summary>
				<p><?php echo $person['bio']; ?></p>
			</details>
		</li>
	<?php endforeach; ?>
</ul>
