<?php
// The IDs of users with no role on the site.
$grace = guide_user();
$GLOBALS['wpdb']->insert( $GLOBALS['wpdb']->users, array( 'user_login' => 'norole', 'user_email' => 'n@example.org', 'user_registered' => '2026-01-01' ) );
$id = $GLOBALS['wpdb']->insert_id;
update_user_meta( $id, 'guide_capabilities', array() );
return wp_get_users_with_no_role() == array( $id );
