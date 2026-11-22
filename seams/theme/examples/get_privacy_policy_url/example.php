<?php
// The privacy policy page's URL, '' when it isn't published; filtered by privacy_policy_url.
$page = wp_insert_post( array( 'post_title' => 'Privacy', 'post_type' => 'page', 'post_status' => 'publish' ) );
$none = get_privacy_policy_url();
update_option( 'wp_page_for_privacy_policy', $page );
return array( $none, get_privacy_policy_url() );
