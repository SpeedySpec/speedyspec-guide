<?php
// Public, viewable post types except attachments; wp_sitemaps_post_types filters them.
register_post_type( 'post', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_post_type( 'attachment', array( 'public' => true, 'rewrite' => false, 'query_var' => false ) );
register_post_type( 'guide_private', array( 'public' => false, 'rewrite' => false, 'query_var' => false ) );
$before = array_keys( ( new WP_Sitemaps_Posts() )->get_object_subtypes() );
add_filter( 'wp_sitemaps_post_types', fn( $types ) => array() );
return array( $before, ( new WP_Sitemaps_Posts() )->get_object_subtypes() );
