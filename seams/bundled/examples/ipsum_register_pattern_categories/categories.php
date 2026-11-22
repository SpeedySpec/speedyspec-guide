<?php
// Registers the Pages and Post formats pattern categories; on init.
guide_theme( 'ipsum' );
ipsum_register_pattern_categories();
$registry = WP_Block_Pattern_Categories_Registry::get_instance();
return array( $registry->get_registered( 'ipsum_page' )['label'], $registry->get_registered( 'ipsum_post-format' )['label'] );
