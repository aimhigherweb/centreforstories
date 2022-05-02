<?php

	// Set the default color palette for certain fields
	function set_default_colour_palette() {
		global $page_colours, $background_colours;

		?>
			<style>
				.iris-picker {
					height: 20px !important;
				}

				.iris-picker .iris-square {
					display: none;
				}

				.iris-picker .iris-slider {
					display: none;
				}
			</style>
			<script>
				const colours = <?php echo json_encode($page_colours); ?>;
				const backgroundColours = <?php echo json_encode($background_colours); ?>;
				const colourFields = [
					'field_page_colour', 
					'field_block_colour'
				];
				const backgroundFields = [
					'field_block_colour'
				]

				acf.add_filter('color_picker_args', function( args, $field ){
					if ( colourFields.includes($field[0]['dataset']['key'])) {
						if(backgroundFields.includes($field[0]['dataset']['key'])) {
							args.palettes = [...colours, ...backgroundColours].map(({color}) => color);
						}
						else {
							args.palettes = colours.map(({color}) => color);
						}
					}

					return args;
				});
			</script>
		<?php
	}

	add_action('acf/input/admin_footer', 'set_default_colour_palette');

?>