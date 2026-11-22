<?php
// Registers the theme's pattern categories (unless registered) and its patterns from inc/patterns, both filtered; on init, before the default patterns.
guide_theme( 'twentytwentytwo' );
add_filter( 'twentytwentytwo_block_patterns', fn( $patterns ) => array_slice( $patterns, 0, 2 ) );
twentytwentytwo_register_block_patterns();
$registry = WP_Block_Patterns_Registry::get_instance();
return array( $registry->is_registered( 'twentytwentytwo/footer-default' ), $registry->is_registered( 'twentytwentytwo/footer-logo' ), WP_Block_Pattern_Categories_Registry::get_instance()->get_registered( 'twentytwentytwo_pages' )['label'] );
