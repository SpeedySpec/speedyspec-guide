<?php
// Installs WordPress: creates the tables, the options and the admin user, the default content and the roles; gives the URL, user ID and password.
global $wpdb;
$result = wp_install( 'Guide Site', 'admin', 'admin@example.org', true, '', 'a strong password here' );
return array( $result['user_id'], get_option( 'blogname' ), get_option( 'admin_email' ), get_option( 'blog_public' ) );
