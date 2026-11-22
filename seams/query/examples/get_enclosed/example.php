<?php
// The enclosure URLs recorded for a post; filtered by get_enclosed.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
add_post_meta( $id, 'enclosure', "http://a.test/x.mp3\n123\naudio/mpeg" );
return get_enclosed( $id );
