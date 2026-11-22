<?php
// Hooked to init: registers the active theme's (and parent's) patterns from their patterns folders, with their categories, keywords and template types.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
_register_theme_block_patterns();
return count( array_filter( array_keys( wp_list_pluck( WP_Block_Patterns_Registry::get_instance()->get_all_registered(), 'name', 'name' ) ), fn( $n ) => str_starts_with( $n, 'twentytwentyfive/' ) ) ) > 10;
