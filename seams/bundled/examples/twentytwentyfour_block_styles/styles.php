<?php
// Registers the theme's block styles: Arrow icon for Details, Pill for Post Terms, Checkmark for List, With arrow for Navigation Link and With asterisk for Heading; on init.
guide_theme( 'twentytwentyfour' );
twentytwentyfour_block_styles();
$styles = WP_Block_Styles_Registry::get_instance()->get_all_registered();
return array_map( fn( $s ) => array_keys( $s ), array_intersect_key( $styles, array_flip( array( 'core/details', 'core/post-terms', 'core/list', 'core/navigation-link', 'core/heading' ) ) ) );
