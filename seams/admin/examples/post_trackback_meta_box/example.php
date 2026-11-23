<?php
// Prints the Send Trackbacks box: the URLs to ping and those already pinged.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
return str_contains( guide_render( fn() => post_trackback_meta_box( $post ) ), 'name="trackback_url"' );
