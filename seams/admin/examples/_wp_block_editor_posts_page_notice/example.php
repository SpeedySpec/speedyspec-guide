<?php
// Adds the block editor's notice that the page being edited is the posts page.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Blog', 'post_status' => 'publish' ) );
update_option( 'page_for_posts', $page );
$GLOBALS['post'] = get_post( $page );
_wp_block_editor_posts_page_notice();
return str_contains( implode( '', wp_scripts()->get_data( 'wp-notices', 'after' ) ?: array() ), 'latest posts' );
