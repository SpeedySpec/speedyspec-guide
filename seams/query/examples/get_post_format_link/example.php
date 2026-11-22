<?php
// The archive URL of a post format, or false when there are no posts of it.
$id = wp_insert_post( array( 'post_title' => 'Q', 'post_status' => 'publish' ) );
set_post_format( $id, 'quote' );
return array( get_post_format_link( 'quote' ), get_post_format_link( 'video' ) );
