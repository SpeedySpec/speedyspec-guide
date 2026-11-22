<?php
// Loads the theme's block patterns and their category; on init.
guide_theme( 'twentytwenty' );
twentytwenty_register_block_patterns();
return array_values( array_filter( wp_list_pluck( WP_Block_Patterns_Registry::get_instance()->get_all_registered(), 'name' ), fn( $n ) => str_starts_with( $n, 'twentytwenty/' ) ) );
