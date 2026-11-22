<?php
// Registers the theme's pattern categories (unless registered) and its patterns from inc/patterns, both filtered; on init, before the default patterns.
guide_theme( 'twentytwentytwo' );
function guide_first_two_patterns( $patterns ) {
	return array_slice( $patterns, 0, 2 );
}
add_filter( 'twentytwentytwo_block_patterns', 'guide_first_two_patterns' );
twentytwentytwo_register_block_patterns();
$registry = WP_Block_Patterns_Registry::get_instance();
return array( $registry->is_registered( 'twentytwentytwo/footer-default' ), $registry->is_registered( 'twentytwentytwo/footer-logo' ), WP_Block_Pattern_Categories_Registry::get_instance()->get_registered( 'twentytwentytwo_pages' )['label'] );
