<?php
// Registers the theme's block patterns, such as Large text and Links area; on init.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_register_block_pattern();
return array_values( array_filter( wp_list_pluck( WP_Block_Patterns_Registry::get_instance()->get_all_registered(), 'name' ), fn( $n ) => str_starts_with( $n, 'twentytwentyone/' ) ) );
