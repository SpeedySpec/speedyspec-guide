<?php
// Prints the Revisions box: the post's revisions with links to compare them.
$id = wp_insert_post( array( 'post_title' => 'Tea', 'post_content' => 'One', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $id, 'post_content' => 'Two' ) );
return str_contains( guide_render( fn() => post_revisions_meta_box( get_post( $id ) ) ), 'post-revisions' );
