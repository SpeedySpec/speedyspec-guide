<?php
// A page by ID; deprecated alias of get_post() in effect.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
return get_page( $a )->post_title;
