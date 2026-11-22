<?php
// Registers the default fields of each post type shown in REST, by what it supports.
wp_register_core_post_type_supports_fields();
$post = wp_list_pluck( wp_get_registered_entity_fields( 'postType', 'post' ), 'id' );
$page = wp_list_pluck( wp_get_registered_entity_fields( 'postType', 'page' ), 'id' );
return array( in_array( 'excerpt', $post, true ), in_array( 'excerpt', $page, true ), in_array( 'parent', $page, true ) );
