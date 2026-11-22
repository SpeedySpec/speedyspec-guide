<?php
// The current post's trackback URL; filtered by trackback_url.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return get_trackback_url();
