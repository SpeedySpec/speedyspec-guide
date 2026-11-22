<?php
// Whether a post's password must be given: it has one and the visitor's cookie doesn't match; filtered by post_password_required.
$locked = wp_insert_post( array( 'post_title' => 'L', 'post_status' => 'publish', 'post_password' => 'pw' ) );
$no = post_password_required( $locked );
require_once ABSPATH . WPINC . '/class-phpass.php';
$hasher = new PasswordHash( 8, true );
return array( $no, post_password_required( wp_insert_post( array( 'post_title' => 'Open', 'post_status' => 'publish' ) ) ) );
