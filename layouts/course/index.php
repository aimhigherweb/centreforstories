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

	$course_nav_item = apply_filters( 
		'tutor_course/single/nav_items', 
		tutor_utils()->course_nav_items(), 
		get_the_ID() 
	);
    $topics = tutor_utils()->get_topics();

    $in_cart = tutor_utils()->is_course_added_to_cart(tutor_utils()->get_course_product_id(), true);
    $is_enrolled = apply_filters( 'tutor_alter_enroll_status', tutor_utils()->is_enrolled() );
?>

<div class="<?php echo $styles['content']; ?>">
	<?php get_template_part('parts/header_image/index'); ?>

    <?php echo the_content(); ?>

    <?php tutor_utils()->has_video_in_single() && tutor_course_video(); ?>

    <h2>Course Outline</h2>
    <?php if ( $topics->have_posts() ) :  ?>
        <ul>
            <?php foreach($topics->posts as $topic) : ?>
                <li>
                    <strong><?php echo $topic->post_title; ?></strong> - <?php echo $topic->post_content; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?> 

    <div class="wp-block course_purchase">
        <?php if ( $is_enrolled ) : ?>
            <h2>Course Enrolment</h2>
        <?php else : ?>
            <h2>Purchase Course</h2>
        <?php endif; ?>
        <?php if ( !$is_enrolled && $in_cart ) : ?>
            <p>This course is already in your cart.</p>
        <?php endif; ?>
        <?php tutor_load_template('single.course.course-entry-box'); ?>
        <div class="update-info">
            <i class="tutor-icon-clock-line"></i> Last Updated: 
            <span class="date">
                <?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_modified_date() ) ); ?>
            </span>
        </div>
    </div>
</div>