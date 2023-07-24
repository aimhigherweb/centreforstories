<?php
	$style_data = fetch_styles(__DIR__);

	$template = $style_data['template'];
	$styles = $style_data['styles'];

	get_template_part(
		'parts/modules',
		null,
		array(
			'name' => $template,
			'dir' => __DIR__,
			'env' => 'production'
		)
	);

	global $post;
	$currentPost = $post;

	$method_map = array(
		'lesson' => 'tutor_lesson_content',
		'assignment' => 'tutor_assignment_content',
	);

	$content_id = tutor_utils()->get_post_id();
	$course_id = tutor_utils()->get_course_id_by_subcontent( $content_id );
	$contents = tutor_utils()->get_course_prev_next_contents_by_id($content_id);
	$previous_id = $contents->previous_id;
	$next_id = $contents->next_id;

	$enable_spotlight_mode = tutor_utils()->get_option( 'enable_spotlight_mode' );
	extract(array('context' => 'lesson'));

	function tutor_course_single_sidebar( $echo = true, $context='desktop' ) {
		ob_start();
		tutor_load_template( 'single.lesson.lesson_sidebar', array('context' => $context) );
		$output = apply_filters( 'tutor_lesson/single/lesson_sidebar', ob_get_clean() );

		if ( $echo ) {
			echo tutor_kses_html( $output );
		}

		return $output;
	}
?>

<div class="<?php echo $styles['content']; ?>">

	<?php get_template_part('tutor/templates/single/lesson/lesson_sidebar'); ?>

	<?php get_template_part('tutor/templates/single/lesson/content'); ?>

</div>