<?php
// Registers the Pages and Post formats pattern categories; on init.
guide_theme( 'twentytwentyfive' );
twentytwentyfive_pattern_categories();
return WP_Block_Pattern_Categories_Registry::get_instance()->get_registered( 'twentytwentyfive_page' )['description'];
