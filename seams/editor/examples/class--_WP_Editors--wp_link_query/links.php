<?php
// Published posts of public types for the link dialog, newest first, by title, with their permalink and type label; wp_link_query_args and wp_link_query filter the query and results.
guide_post( array( 'post_title' => 'First', 'post_date' => '2026-01-01 00:00:00' ) );
guide_post( array( 'post_title' => 'Second', 'post_date' => '2026-02-01 00:00:00' ) );
wp_insert_post( array( 'post_title' => 'Page', 'post_type' => 'page', 'post_status' => 'publish', 'post_date' => '2026-03-01 00:00:00' ) );
$all = _WP_Editors::wp_link_query();
return array( wp_list_pluck( $all, 'title' ), $all[0]['info'], wp_list_pluck( _WP_Editors::wp_link_query( array( 's' => 'Second' ) ), 'title' ) );
