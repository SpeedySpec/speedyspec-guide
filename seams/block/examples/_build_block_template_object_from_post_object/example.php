<?php
// A WP_Block_Template from a wp_template post and its theme term and meta, or an error when no theme is given.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$id = wp_insert_post( array( 'post_type' => 'wp_template', 'post_name' => 'my-tpl', 'post_title' => 'Mine', 'post_status' => 'publish', 'tax_input' => array( 'wp_theme' => array( 'twentytwentyfive' ) ) ) );
$template = _build_block_template_object_from_post_object( get_post( $id ), array( 'wp_theme' => 'twentytwentyfive' ) );
return array( $template->id, _build_block_template_object_from_post_object( get_post( $id ) )->get_error_code() );
