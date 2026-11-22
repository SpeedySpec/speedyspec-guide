<?php
// Whether the main query is for any archive: date, author, term, or post type archive.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
guide_go( '/?cat=1' );
$cat = is_archive();
guide_go( "/?p=$id" );
return array( $cat, is_archive() );
