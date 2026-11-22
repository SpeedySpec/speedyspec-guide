<?php
// A link to the privacy policy page, '' when there is none; filtered by the_privacy_policy_link.
$page = wp_insert_post( array( 'post_title' => 'Privacy', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'wp_page_for_privacy_policy', $page );
return get_the_privacy_policy_link();
