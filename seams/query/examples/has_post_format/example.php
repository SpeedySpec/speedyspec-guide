<?php
// Whether a post has a format, or one of the given ones.
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
$id = wp_insert_post( array( 'post_title' => 'Short', 'post_status' => 'publish' ) );

set_post_format( $id, 'aside' );
return array( has_post_format( '', $id ), has_post_format( 'aside', $id ), has_post_format( array( 'gallery', 'video' ), $id ) );
