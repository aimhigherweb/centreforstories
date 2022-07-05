<?php

	get_template_part(
		'partials/layout/index', 
		null, 
		array(
			'template' => 'shop',
			'page_id' => wc_get_page_id('shop'),
		)
	);

?>