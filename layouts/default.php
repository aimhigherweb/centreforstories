<h1
	class="<?php echo get_field('hidden_title') ? 'sr-only' : ''; ?>"
>
	<?php echo get_the_title(); ?>
</h1>

<div class="content">
	<?php echo the_content(); ?>
</div>