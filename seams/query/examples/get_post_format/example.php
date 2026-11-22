<?php
// A post's format slug, from its post_format term; false for standard or when the type doesn't support formats.
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
$id = wp_insert_post( array( 'post_title' => 'Short', 'post_status' => 'publish' ) );

$standard = get_post_format( $id );
set_post_format( $id, 'aside' );
return array( $standard, get_post_format( $id ) );
