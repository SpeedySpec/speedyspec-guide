<?php
// Users through WP_User_Query: by role, search, meta and fields, ordered by login by default; the site's members only.
$grace = guide_user();
guide_user( 'alan', 'author' );
return array( wp_list_pluck( get_users(), 'user_login' ), get_users( array( 'role' => 'editor', 'fields' => 'user_login' ) ), get_users( array( 'search' => 'al*', 'fields' => 'ID' ) ) != array(), count( get_users( array( 'role__not_in' => array( 'administrator' ) ) ) ) );
