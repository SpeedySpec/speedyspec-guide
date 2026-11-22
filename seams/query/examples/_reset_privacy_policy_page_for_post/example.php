<?php
// Hooked to before_delete_post: when the privacy policy page is deleted, clears its setting.
$page = wp_insert_post( array( 'post_title' => 'Privacy', 'post_type' => 'page' ) );
update_option( 'wp_page_for_privacy_policy', $page );
_reset_privacy_policy_page_for_post( $page );
return get_option( 'wp_page_for_privacy_policy' );
