<?php
// Ajax handler that sends the HTML of an Add menu items box for a post type or taxonomy, for boxes shown later.
$sent = json_decode( guide_ajax( 'wp_ajax_menu_get_metabox', array( 'item-type' => 'post_type', 'item-object' => 'page' ) ), true );
return array( $sent['replace-id'] ?? null, isset( $sent['markup'] ) );
