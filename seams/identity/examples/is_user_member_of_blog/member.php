<?php
// Whether a user belongs to a site (the current one by default); on a single site every existing user does.
$grace = guide_user();
$GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->users, array( 'user_login' => 'outsider', 'user_email' => 'out@example.org', 'user_registered' => '2026-01-01' ) );
$out = $GLOBALS['wpdb']->insert_id;
return array( is_user_member_of_blog( $grace ), is_user_member_of_blog( $out ), is_user_member_of_blog() );
