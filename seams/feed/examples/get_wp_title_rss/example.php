<?php
// The feed's title: the site name, with the page's title after a separator on archives and searches; filtered by get_wp_title_rss.
update_option( 'blogname', 'Tea Notes' );
$term = wp_insert_term( 'Green', 'category' );
wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_category' => array( $term['term_id'] ) ) );
guide_go( '/?feed=rss2' );
$home = get_wp_title_rss();
guide_go( '/?feed=rss2&cat=' . $term['term_id'] );
return array( $home, get_wp_title_rss() );
