<?php
/**
 * Display the content
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	global $post;
	global $previous_id;
	global $next_id;

	$attachments = count(tutor_utils()->get_attachments());

	// Get the ID of this content and the corresponding course
	$course_content_id = get_the_ID();
	$course_id         = tutor_utils()->get_course_id_by_subcontent( $course_content_id );
	$course_link = get_the_permalink( $course_id );
	$course_stats = tutor_utils()->get_course_completed_percent( $course_id, 0, true );
	
	$_is_preview = get_post_meta( $course_content_id, '_is_preview', true );
	$content_id  = tutor_utils()->get_post_id( $course_content_id );
	$contents    = tutor_utils()->get_course_prev_next_contents_by_id( $content_id );
	$previous_id = $contents->previous_id;
	$next_id     = $contents->next_id;

	$prev_is_preview = get_post_meta( $previous_id, '_is_preview', true );
	$next_is_preview = get_post_meta( $next_id, '_is_preview', true );
	$is_enrolled = tutor_utils()->is_enrolled( $course_id );
	$is_public = get_post_meta( $course_id, '_tutor_is_public_course', true );
	$best_watch_time = tutor_utils()->get_lesson_reading_info( get_the_ID(), 0, 'video_best_watched_time' );
	$course_stats = tutor_utils()->get_course_completed_percent( $course_id, 0, true );

	$prev_is_locked = !($is_enrolled || $prev_is_preview || $is_public);
	$next_is_locked = !($is_enrolled || $next_is_preview || $is_public);	

	$jsonData                                 = array();
	$jsonData['post_id']                      = get_the_ID();
	$jsonData['best_watch_time']              = 0;
	$jsonData['autoload_next_course_content'] = (bool) get_tutor_option( 'autoload_next_course_content' );

	
	if ( $best_watch_time > 0 ) {
		$jsonData['best_watch_time'] = $best_watch_time;
	}

	if(!$is_enrolled) {
		wp_redirect( $course_link, 301 );
	}
?>

	<!-- Course Progress -->
	<div class="course_progress">
		<label for="course_progress">
			<span class="sr-only">Course Progress</span>
			<?php echo $course_stats['completed_percent'] . '%'; ?> completed
		</label>
		<progress
			id="course_progress"
			max="100"
			min="0"
			value="<?php echo $course_stats['completed_percent']; ?>"
		>
			<?php echo $course_stats['completed_percent'] . '%'; ?>
		</progress>
	</div>

	<ul class="pagination">
		<li class="return_course">
			<a href="<?php echo $course_link; ?>">
				Return to Course Page
			</a>
		</li>
		<?php if(!$prev_is_locked) : ?>
			<li>
				<a href="<?php echo get_the_permalink( $previous_id ); ?>">
					<span>Previous Lesson</span>
				</a>
			</li>
		<?php endif; ?>
		<?php if(!$next_is_locked) : ?>
			<li>
				<a href="<?php echo get_the_permalink( $next_id ); ?>">
					<span>Next Lesson</span>
				</a>
			</li>
		<?php endif; ?>
	</ul>

	<?php
		$video_info = tutor_utils()->get_video_info();
		$source_key = is_object($video_info) && 'html5' !== $video_info->source ? 'source_'.$video_info->source : null;
		$has_source = (is_object($video_info) && $video_info->source_video_id) || (isset($source_key) ? $video_info->$source_key : null);
	?>

	<div class="lesson_content">
		
		<!-- Load Lesson Video -->
		<?php		
			if ($has_source) : ?>
				<input
					type="hidden" 
					id="tutor_video_tracking_information" 
					value="<?php echo esc_attr( json_encode( $jsonData ) ); ?>"
				/>
				<?php tutor_lesson_video();
			endif;
		?>

		<h2><?php _e( 'About Lesson', 'tutor' ); ?></h2>
		<?php the_content(); ?>

		<?php if($attachments) : ?>
			<h2><?php _e( 'Exercise Files', 'tutor' ); ?></h2>
			<?php get_tutor_posts_attachments(); ?>
		<?php endif; ?>

		<?php tutor_lesson_mark_complete_html(); ?>
	</div>
