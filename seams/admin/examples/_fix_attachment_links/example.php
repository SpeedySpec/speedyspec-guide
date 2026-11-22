<?php
// Rewrites links in a published post's content from its attachments' old ?attachment_id= URLs to their permalinks, when pretty permalinks are on.
$GLOBALS['wp_rewrite']->set_permalink_structure( '/%postname%/' );
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$a = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg', 'post_parent' => $post ), 'lake.jpg' );
wp_update_post( array( 'ID' => $post, 'post_content' => '<a href="' . home_url( "/?attachment_id=$a" ) . '" rel="attachment wp-att-' . $a . '">Lake</a>' ) );
_fix_attachment_links( $post );
return get_post_field( 'post_content', $post );
