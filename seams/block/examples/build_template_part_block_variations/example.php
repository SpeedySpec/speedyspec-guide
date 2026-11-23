<?php
// All the Template Part block's variations: by area and by template part.
switch_theme( 'twentytwentyfive' );
$GLOBALS['_wp_theme_features']['block-templates'] = true;
$names = wp_list_pluck( build_template_part_block_variations(), 'name' );
sort( $names );
return array_slice( $names, 0, 4 );
