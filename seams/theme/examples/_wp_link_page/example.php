<?php
// The opening link tag to one page of a split post; '' for the current page's link... the opening anchor for page i.
$id = wp_insert_post( array( 'post_title' => 'Long', 'post_status' => 'publish', 'post_content' => 'one<!--nextpage-->two' ) );
guide_go( "/?p=$id" );
the_post();
return _wp_link_page( 2 );
