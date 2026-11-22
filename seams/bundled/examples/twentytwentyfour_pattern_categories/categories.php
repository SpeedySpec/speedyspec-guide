<?php
// Registers the Pages pattern category; on init.
guide_theme( 'twentytwentyfour' );
twentytwentyfour_pattern_categories();
return WP_Block_Pattern_Categories_Registry::get_instance()->get_registered( 'twentytwentyfour_page' )['label'];
