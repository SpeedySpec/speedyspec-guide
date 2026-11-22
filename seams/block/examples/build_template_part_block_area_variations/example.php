<?php
// The Template Part block's variations, one per area.
switch_theme( 'twentytwentyfive' );
return wp_list_pluck( build_template_part_block_area_variations( array() ), 'name' );
