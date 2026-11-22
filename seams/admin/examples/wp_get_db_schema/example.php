<?php
// The CREATE TABLE statements of WordPress's tables for a scope: all, blog, global or ms_global.
$schema = wp_get_db_schema( 'blog' );
return array( str_contains( $schema, 'CREATE TABLE guide_posts' ), str_contains( $schema, 'CREATE TABLE guide_users' ) );
