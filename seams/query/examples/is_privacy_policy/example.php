<?php
// Whether the main query is for the privacy policy page.
$page = wp_insert_post( array( 'post_title' => 'Privacy', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'wp_page_for_privacy_policy', $page );
guide_go( "/?page_id=$page" );
return array( is_privacy_policy(), is_page() );
