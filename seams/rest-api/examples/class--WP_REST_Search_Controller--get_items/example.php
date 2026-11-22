<?php
// The search controller: /wp/v2/search finds content across types through a search handler, post by default, or term or post-format by the type argument, each result with its id, title, url, type and subtype.
wp_insert_post( array( 'post_title' => 'Gardening tips', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Garden page', 'post_type' => 'page', 'post_status' => 'publish' ) );
$all = guide_rest( 'GET', '/wp/v2/search', array( 'search' => 'garden' ) )[1];
$pages = guide_rest( 'GET', '/wp/v2/search', array( 'search' => 'garden', 'subtype' => 'page' ) )[1];
return array( array_column( $all, 'subtype' ), array_column( $pages, 'title' ), guide_rest( 'GET', '/wp/v2/search', array( 'type' => 'nope' ) )[1]['code'] );
