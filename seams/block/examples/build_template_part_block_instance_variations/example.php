<?php
// The Template Part block's variations, one per template part of the theme.
switch_theme( 'twentytwentyfive' );
$GLOBALS['_wp_theme_features']['block-templates'] = true;
return array_slice( wp_list_pluck( build_template_part_block_instance_variations(), 'name' ), 0, 3 );
