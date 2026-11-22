<?php
// Hooked to wp_robots: adds noindex on embed views.
$id = wp_insert_post( array( 'post_title' => 'E', 'post_status' => 'publish' ) );
guide_go( "/?p=$id&embed=true" );
return wp_robots_noindex_embeds( array() );
