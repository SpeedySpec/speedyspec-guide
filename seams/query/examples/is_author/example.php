<?php
// Whether the main query is for an author archive, optionally of given authors by ID, nicename or name.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( '/?author=1' );
return array( is_author(), is_author( 'admin' ), is_author( 2 ) );
