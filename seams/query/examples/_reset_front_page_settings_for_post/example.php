<?php
// Hooked to before_delete_post and wp_trash_post: when the front page or posts page is deleted, resets the reading settings; unsticks deleted posts.
$page = wp_insert_post( array( 'post_title' => 'Home', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page );
_reset_front_page_settings_for_post( $page );
return array( get_option( 'show_on_front' ), get_option( 'page_on_front' ) );
