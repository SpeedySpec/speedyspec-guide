<?php
// The name of the user who last edited the current post (_edit_last); filtered by the_modified_author.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
update_post_meta( $id, '_edit_last', 1 );
return get_the_modified_author();
