<?php
/**
 * Block Name: Story Collections Block
 * 
 */

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

	$cta = get_field('cta');
	$image = get_field('image');
	$collections = get_field('collections');

	if(is_array($collections)) {
		$collections = array_slice(get_field('collections'), 0, 4);
	}
	else {
		$collections = [];
	}

	
	
?>


<div 
	class="<?php echo classes([$styles['block']]); ?> wp-block" 
>
	<div>
		<h2 class="<?php echo classes([$styles['heading']]); ?>">
			<?php echo get_field('heading'); ?>
		</h2>
		<div class="<?php echo classes([$styles['content']]); ?>">
			<?php echo get_field('content'); ?>
		</div>
		<?php if(check_field_value([$cta])): ?>
			<a 
				href="<?php echo $cta['url']; ?>" 
				class="<?php echo classes([$styles['cta']]); ?>"
				target="<?php echo $cta['target']; ?>"
			>
				<?php echo $cta['title']; ?>
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/arrow_circle.svg'); ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="<?php echo classes([$styles['container']]); ?>">
		<p class="<?php echo classes([$styles['eyebrow']]); ?>">
			<?php echo get_field('eyebrow'); ?>
		</p>
		<ul class="<?php echo classes([$styles['collections']]); ?>">
			<?php foreach($collections as $collection):
				$image = get_field('image', $collection);
				
				if($image) {
					$image = $image['sizes']['block_graphic'];
				}
			?>
				<li class="<?php echo classes([$styles['collection']]); ?>">
					<div class="<?php echo classes([$styles['image']]); ?>">
						<img
							src="<?php echo $image; ?>"
							alt=""
						/>
					</div>
					<h3>
						<a href="<?php echo get_term_link($collection); ?>">
							<?php echo $collection->name; ?>
						</a>
					</h3>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>