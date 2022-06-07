<?php
/**
 * The main template file
 *
 *
 * @package Centre for Stories
 * @version 1.0
 */

	// dump($wp_query->is_posts_page);
	// dump(is_category());
	// dump(is_tag());
	// dump(is_archive(  ));
	// dump(get_the_ID());
	// dump(get_page_by_path('stories'));
	// dump(strtok($_SERVER["REQUEST_URI"], '/'));

	
	
 
	if($wp_query->is_posts_page) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'blog',
				'page_id' => get_option('page_for_posts')
			)
		);
	}
	else if (is_archive()) {		
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => get_post_type(),
				'page_id' => get_page_by_path(strtok($_SERVER["REQUEST_URI"], '/'))
			)
		);
	}
	else if(is_shop()) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'shop',
			)
		);
	}
	else if(is_search()) {
		get_template_part(
			'partials/layout/index', 
			null, 
			array(
				'template' => 'search',
				'custom_page_header' => true
			)
		);
	}
  	else {
		get_template_part('partials/layout/index');
	}

?>
