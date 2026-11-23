<?php
// Prints the Comments box of a published post: its comments list, loaded by Ajax, with the Add Comment button.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) ) );
return str_contains( guide_render( fn() => post_comment_meta_box( $post ) ), 'add-new-comment' );
