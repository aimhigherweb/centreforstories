<?php
/**
 * Display Topics and Lesson lists for learn
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
	$post_id = get_the_ID();
	if ( ! empty( $_POST['lesson_id'] ) ) {
		$post_id = sanitize_text_field( $_POST['lesson_id'] );
	}
	$currentPost = $post;
	$_is_preview = get_post_meta( $post_id, '_is_preview', true );
	$course_id   = 0;
	if ( $post->post_type === 'tutor_quiz' ) {
		$course    = tutor_utils()->get_course_by_quiz( get_the_ID() );
		$course_id = $course->ID;
	} elseif ( $post->post_type === 'tutor_assignments' ) {
		$course_id = tutor_utils()->get_course_id_by( 'assignment', $post->ID );
	} elseif ( $post->post_type === 'tutor_zoom_meeting' ) {
		$course_id = get_post_meta( $post->ID, '_tutor_zm_for_course', true );
	} else {
		$course_id = tutor_utils()->get_course_id_by( 'lesson', $post->ID );
	}

	$user_id                      = get_current_user_id();
	$enable_qa_for_this_course    = get_post_meta( $course_id, '_tutor_enable_qa', true ) == 'yes';
	$enable_q_and_a_on_course     = tutor_utils()->get_option( 'enable_q_and_a_on_course' ) && $enable_qa_for_this_course;
	$is_enrolled                  = tutor_utils()->is_enrolled( $course_id );
	$is_instructor_of_this_course = tutor_utils()->is_instructor_of_this_course( $user_id, $course_id );
	$is_user_admin                = current_user_can( 'administrator' );
?>

	<nav id="lesson_sidebar" class="tutor_lesson_sidebar">
		<button class="sidebar_toggle" onclick="toggleLessonSidebar()">
			<span class="open">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/hamburger.svg'); ?>
			</span>
			<span class="close">
				<?php echo inline_svg(get_template_directory_uri() . '/src/img/cross.svg'); ?>
			</span>
			<span class="sr-only">Toggle Lesson Sidebar</span>
		</button>
		<ul class="topics">
			<?php
			$topics = tutor_utils()->get_topics( $course_id );
			if ( $topics->have_posts() ) :
				while ( $topics->have_posts() ) :
					$topics->the_post();
					$topic_id       = get_the_ID();
					$topic_summery  = get_the_content();
					$total_contents = tutor_utils()->count_completed_contents_by_topic( $topic_id );
					$num_lessons = $total_contents['contents'];
					$num_lessons_complete = $total_contents['completed'];
				?>

					<li>
						<p><?php the_title(); ?></p>
						<p><?php echo $topic_summery; ?></p>
						<p>
							<?php echo $num_lessons_complete . '/' . $num_lessons; ?>
							<span class="sr-only"> Lessons Completed</span>
						</p>

						<?php
							$lessons = tutor_utils()->get_course_contents_by_topic( get_the_ID(), -1 );
							$is_enrolled = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );

							?>
							<ul>
								<?php while ( $lessons->have_posts() ) :
									$lessons->the_post();

									$icon = 'file.svg';
									$video = tutor_utils()->get_video_info();
									$play_time = false;
									$is_completed_lesson = tutor_utils()->is_completed_lesson();

									switch($post->post_type) {
										case 'tutor_quiz':
											$icon = 'quiz.svg';
											break;
										case 'tutor_assignments':
											$icon = 'assignment.svg';
											break;
									}

									if ( $video ) {
										$icon = 'video.svg';
										$play_time = $video->playtime;
									}

								?>

									<li>
										<a href="<?php echo get_permalink( $post->ID ); ?>" >
											<?php echo inline_svg(get_template_directory_uri() . '/src/img/' . $icon); ?>
											<?php echo $post->post_title; ?>
										</a>

										<?php if ($play_time) : ?>
											<span class="tutor-fs-7 tutor-color-secondary">
												<?php echo tutor_utils()->get_optimized_duration( $play_time ); ?>
											</span>
										<?php endif; ?>

										<input
											id="<?php echo $post->ID; ?>"
											<?php echo $is_completed_lesson ? 'checked' : ''; ?> 
											type='checkbox' 
											class='tutor-form-check-input tutor-form-check-circle' 
											disabled 
											readonly 
										/>
										<label for="<?php echo $post->ID; ?>" class="sr-only">
											<?php echo $is_completed_lesson ? 'Lesson is completed' : 'Lesson is not completed'; ?>
										</label>
										
									</li>

								<?php endwhile;	?>
							</ul>
						<?php $lessons->reset_postdata(); ?>
					</li>
				<?php endwhile;

				$topics->reset_postdata();
				wp_reset_postdata();
			endif; ?>
		</ul>
	</nav>