<?php

// Set the default color palette for certain fields
function set_default_colour_palette() {
	global $page_colours;
	?>
		<style>
			.iris-picker .iris-square {
				display: none;
			}

			.iris-picker .iris-slider {
				display: none;
			}
		</style>
		<script>
			const colours = <?php echo json_encode($page_colours); ?>;
			acf.add_filter('color_picker_args', function( args, $field ){

				if ( 'field_page_colour' === $field[0]['dataset']['key'] ) {
					args.palettes = colours.map(({color}) => color);
				}

				return args;
			});
		</script>
	<?php
}

add_action('acf/input/admin_footer', 'set_default_colour_palette');


if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_6254f6ea2bf45',
		'title' => 'Page Colour',
		'fields' => array(
			array(
				'key' => 'field_page_colour',
				'label' => 'Page Colour',
				'name' => 'page_colour',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#283753',
				'enable_opacity' => 0,
				'return_format' => 'string',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 1,
	));
	
	endif;		

?>