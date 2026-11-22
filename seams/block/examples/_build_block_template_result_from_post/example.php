<?php
// A WP_Block_Template from a wp_template or wp_template_part post, with its source, origin and hooked blocks.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
$id = wp_insert_post( array( 'post_type' => 'wp_template', 'post_name' => 'my-tpl', 'post_title' => 'Mine', 'post_status' => 'publish', 'tax_input' => array( 'wp_theme' => array( 'twentytwentyfive' ) ) ) );
$template = _build_block_template_result_from_post( get_post( $id ) );
return array( $template->id, $template->source, $template->type );
