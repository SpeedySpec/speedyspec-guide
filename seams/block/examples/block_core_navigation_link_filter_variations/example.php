<?php
// Hooked to get_block_type_variations: gives the Navigation Link block a variation per post type and taxonomy shown in navigation.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/navigation-link' );
return wp_list_pluck( block_core_navigation_link_filter_variations( array(), $type ), 'name' );
