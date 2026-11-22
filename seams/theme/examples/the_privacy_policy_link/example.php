<?php
// Prints the privacy policy link with markup before and after.
$page = wp_insert_post( array( 'post_title' => 'Privacy', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'wp_page_for_privacy_policy', $page );
return guide_render( fn() => the_privacy_policy_link( '<p>', '</p>' ) );
